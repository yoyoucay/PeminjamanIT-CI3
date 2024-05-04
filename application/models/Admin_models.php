<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Admin_models extends CI_Model 
{
    public function getData($table, $key, $value){       
        $query = $this->db->get_where($table, array($key=>$value));
        if(!empty($query->row_array())){
            return $query->row_array();
            // die($query->row_array());
        }

        return false;
    }

    public function getAllData($table){       
        $query = $this->db->get($table);
        if(!empty($query->result_array())){
            return $query->result_array();
            // die($query->row_array());
        }

        return false;
    }

    public function updPackageProfitSpeedValues($paket, $profit, $speed)
    {
        // die(var_dump($paket));
        try {
            for ($i=1; $i <= 4; $i++) { 

                // Update Speed Values
                $data = array(
                    'value_speed'      => $speed[$i-1],
                );
          
                $this->db->where('id_speed', $i);
                $this->db->update('tbl_speed', $data);

                $data = array();

                // Update Profit Values
                $data = array(
                    'value_profit'      => $profit[$i-1],
                );
          
                $this->db->where('id_profit', $i);
                $this->db->update('tbl_profit', $data);

                $data = array();

                // Update Paket Values
                $data = array(
                    'value_paket'      => $paket[$i-1],
                );
          
                $this->db->where('id_paket', $i);
                $this->db->update('tbl_paket', $data);
            }

            return TRUE;
           
        } catch (\Throwable $th) {
            //throw $th;
        }
        

        return FALSE;
    }

    // DATATABLES QUERY FUNCTION
    public function get_datatablesAccount(){
        $this->_get_datatables_Account();
        if($_POST["length"] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        
        $query = $this->db->get();
        return $query->result();
    }

    public function _get_datatables_Account()
    {
        // Query Datatables for Part
         
        $column_order = array(null, 'id_user','username','email');
        $column_search = array('id_user','username','email');

        $this->db->select('*');
        $this->db->from('tbl_user');

        $i = 0;
     
        foreach ($column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function count_all($category = NULL){

        switch ($category) {
            case 'user':
                $this->db->from('tbl_user');
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
            case 'user':
                $this->_get_datatables_Account();
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

