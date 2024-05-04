<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Authentication_models extends CI_Model 
{
    public function __construct(){
        parent::__construct();
        $this->load->model('General_models');

        date_default_timezone_set('Asia/Jakarta');
        $this->timeNow = date('Y-m-d H:i:s');
    }

    public function is_LoggedIn()
    {
        // menguji session
        if($this->session->userdata('logged_in') == NULL || $this->session->userdata('logged_in') == FALSE){
            return false;
        }
        return true;
    }

    public function is_Admin()
    {
        // menguji session
        if($this->session->userdata('role') == 'user' || $this->session->userdata('role') != 'admin'){
            return false;
        }
        return true;
    }

    public function getDataUser($key, $value)
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where($key, $value);
        $query = $this->db->get();
        // die(var_dump($this->db->last_query()));
        
        if(!empty($query->row_array())){
            return $query->row_array();
        }        
        return false;
    }

    public function checkPassword($sEmpID, $sPassword)
    {
        if ($this->getDataUser('sEmpID', $sEmpID)) {
            $raw = $this->getDataUser('sEmpID', $sEmpID)['sPassword'];
            $decrypted = $this->encryption->decrypt($raw);
            if ($sPassword == $decrypted) {
                return true;
            }
        }
        return false;
    }   

    public function createAccount()
    {
        $id_wallet = NULL;
        $username = $this->input->post('regist_username');
        if ($id_wallet = $this->createWallet($username)) {
            $data = array(
                'username'      => $this->input->post('regist_username'),
                'email'         => $this->input->post('regist_email'),
                'fullname'      => $this->input->post('regist_fullname'),
                'password'      => $this->encryption->encrypt($this->input->post('regist_password2')),
                'kode_wallet'   => $id_wallet,
                'code_token'    => random_string('alnum', 20),
                'role'          => 'user',     
            );
            return $this->db->insert('tbl_user', $data);
        }elseif ($id_wallet == NULL) {
            die('Failed to create wallet');
        }
    }

    public function searchAccount($keyword)
    {
      $this->db->select('*');
      $this->db->where('sEmpID', $keyword);
      $query = $this->db->get('tb_user');

    //   die($this->db->last_query());
      if (!empty($query->row_array())) {
        $result = $query->row_array(); 
        return $result; 
      }
      return FALSE;
    }

        
    public function reloadSessionData($username = NULL){
        if ($username != NULL) {
            $user = $this->Authentication_models->getDataUser('sEmpID', $username);
        }elseif ($username == NULL) {
            $user = $this->Authentication_models->getDataUser('sEmpID', $this->input->post('empid'));
        }        
        // Get Global Settings Configuration From database.
        // $settings = $this->User_models->getGlobSettings();

        // die(var_dump($user));

        if($user != NULL):
            $dataUser = array(
                'idUser'            => $user['idUser'],
                'sEmpID'            => $user['sEmpID'],
                'sFullName'             => $user['sFullname'],
                'sRole'                 => $user['sRole'],
                'logged_in'             => true,
            );
        elseif ($user == NULL):
            return FALSE;
        endif;

        $this->session->set_userdata($dataUser);
        return TRUE;
    }

                        
}


/* End of file Authentication_models_model.php and path /application/models/Authentication/Authentication_models_model.php */