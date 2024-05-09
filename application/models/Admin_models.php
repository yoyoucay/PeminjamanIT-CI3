<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin_models extends CI_Model
{
    function insBarang($data)
    {
        return $this->db->insert('tb_brg', $data);
    }

    public function updBarangById($id, $newData)
    {
        // Update data in your database table
        // Example SQL update query
        $this->db->where('idBrg', $id);
        $this->db->update('tb_brg', $newData);

        // Return true if update was successful, false otherwise
        return $this->db->affected_rows() > 0;
    }

    public function deleteBarangById($id)
    {
        // Delete data from your database table
        // Example SQL delete query
        $this->db->where('idBrg', $id);
        $this->db->delete('tb_brg');

        // Return true if deletion was successful, false otherwise
        return $this->db->affected_rows() > 0;
    }

    public function getData($table, $key, $value)
    {
        $query = $this->db->get_where($table, array($key => $value));
        if (!empty($query->row_array())) {
            return $query->row_array();
            // die($query->row_array());
        }
        return false;
    }

    public function getAllData($table)
    {
        $query = $this->db->get($table);
        if (!empty($query->result_array())) {
            return $query->result_array();
            // die($query->row_array());
        }

        return false;
    }
    // DATATABLES QUERY FUNCTION
    public function get_datatablesBrg()
    {
        $this->_get_datatables_Brg();
        if ($_POST["length"] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();
        return $query->result();
    }

    public function _get_datatables_Brg()
    {
        // Query Datatables for Part

        $column_order = array(null, 'sKode', 'sName', 'decQty', 'sType');
        $column_search = array('sKode', 'sName', 'decQty', 'sType');

        $this->db->select('*');
        $this->db->from('tb_brg');

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
            case 'barang':
                $this->db->from('tb_brg');
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
            case 'barang':
                $this->_get_datatables_Brg();
                break;

            default:
                # code...
                break;
        }

        // $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

}


/* End of file Admin_model.php and path /application/models/Admin_model.php */

