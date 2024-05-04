<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require './vendor/autoload.php';

class General extends CI_Controller {

    public function __construct(){
      parent::__construct();
      $this->load->model('General_models');
      $this->load->model('Authentication_models');
      $this->load->model('User_models');
      $this->load->library('session');
      $this->load->helper(array('url','html','form','date'));

      if (!$this->Authentication_models->is_LoggedIn()) {
        redirect('login');
      }elseif($this->Authentication_models->is_LoggedIn()) {
        $this->Authentication_models->reloadSessionData($this->session->userdata('username'));
      }
    }

	public function index(){
        $this->vDashboard();
    }

    public function vDashboard()
    {
      $data = $this->session->userdata();
      
      die('This is View of dashboard page');
    }
}