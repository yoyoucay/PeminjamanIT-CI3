<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class General_models extends CI_Model 
{
    var $timeNow;

    public function __construct(){
        parent::__construct();
        $this->load->model('Authentication_models');

        date_default_timezone_set('Asia/Jakarta');
        $this->timeNow = date('Y-m-d H:i:s');
    }
}