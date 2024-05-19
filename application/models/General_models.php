<?php

defined('BASEPATH') or exit('No direct script access allowed');

class General_models extends CI_Model
{
    var $timeNow;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Authentication_models');

        date_default_timezone_set('Asia/Jakarta');
        $this->timeNow = date('Y-m-d H:i:s');
    }

    public function getUser()
    {
        // Fetch items from the database
        $query = $this->db->get('tb_user');
        return $query->result();
    }

    public function getBarang()
    {
        // Fetch items from the database
        $query = $this->db->get('tb_brg');
        return $query->result();
    }

    function insPeminjaman($data)
    {
        $this->db->insert('tb_request', $data);

        // $this->db->set('decQty', 'decQty - ' . $data['decReqQty'], false);
        // $this->db->where('sKode', $data['sKdBrg']);
        // $this->db->update('tb_brg');

        return ($this->db->affected_rows() > 0);
    }

    public function updPeminjamanById($id, $newData)
    {
        // Update data in your database table
        // Example SQL update query
        $this->db->where('idReq', $id);
        $this->db->update('tb_request', $newData);

        // Return true if update was successful, false otherwise
        return $this->db->affected_rows() > 0;
    }

    public function check_current_password($idUser, $current_password) {
        $this->db->where('idUser', $idUser);
        $user = $this->db->get('tb_user')->row();
        $old_password = $this->encryption->decrypt($user->sPassword);
        // echo $current_password;
        // echo $old_password;
        // die();
        if ($current_password == $old_password) {
            return true;
        }
        return false;
    }

    public function update_password($idUser, $new_password) {
        $this->db->where('idUser', $idUser);
        $this->db->update('tb_user', ['sPassword' => $new_password]);
    }

    public function get_datatablesPeminjaman()
    {
        $this->_get_datatables_Peminjaman();
        if ($_POST["length"] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();
        return $query->result();
    }

    public function _get_datatables_Peminjaman()
    {
        // Query Datatables for Part

        $column_order = array(null, 'sReqNum', 'sName', 'decReqQty', 'dtReqStart', 'dtReqEnd', 'sNameApp', 'iStatus');
        $column_search = array('sReqNum', 'sName', 'decReqQty', 'dtReqStart', 'dtReqEnd', 'sNameApp', 'iStatus');

        $this->db->select('*');
        $this->db->from('vrequest');
        $this->db->where('sEmpID', $this->session->userdata('sEmpID'));

        $i = 0;

        foreach ($column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function count_all($category = NULL)
    {

        switch ($category) {
            case 'peminjaman':
                $this->db->from('vrequest');
                break;

            default:
                # code...
                break;
        }
        // $this->db->from('tbl_item');
        return $this->db->count_all_results();
    }

    public function count_filtered($category)
    {
        switch ($category) {
            case 'peminjaman':
                $this->_get_datatables_Peminjaman();
                break;

            default:
                # code...
                break;
        }

        // $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function countData($type)
    {
        $count = null;
        switch ($type) {
            case 'user':
                $this->db->from('tb_user');
                $count = $this->db->count_all_results();
                break;

            case 'allReq':
                $this->db->from('tb_request');
                $this->db->where('iStatus != 0');
                $count = $this->db->count_all_results();
                break;

            case 'nonCompleteReq':
                $this->db->from('tb_request');
                $this->db->where('iStatus = 2');
                $count = $this->db->count_all_results();
                break;

            case 'completeReq':
                $this->db->from('tb_request');
                $this->db->where('iStatus = 3');
                $count = $this->db->count_all_results();
                break;

            default:
                # code...
                break;
        }

        return $count;
    }
}