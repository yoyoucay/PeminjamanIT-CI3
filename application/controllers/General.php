<?php

defined('BASEPATH') or exit('No direct script access allowed');
// require './vendor/autoload.php';

class General extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('General_models', 'General_M');
    $this->load->model('Authentication_models', 'Auth_M');
    $this->load->model('User_models', 'User_M');
    $this->load->library('session');
    $this->load->helper(array('url', 'html', 'form', 'date'));

    if (!$this->Auth_M->is_LoggedIn()) {
      redirect('login');
    } elseif ($this->Auth_M->is_LoggedIn()) {
      $this->Auth_M->reloadSessionData($this->session->userdata('username'));
    }
  }

  public function index()
  {
    $this->vDashboard();
  }

  public function vDashboard()
  {
    $data = $this->session->userdata();

    // die(var_dump($data));

    $data['title'] = 'Dashboard - Peminjaman IT';
    $data['content'] = $this->load->view('General/dashboard', null, true);
    $this->load->view('layout', $data);
  }

  public function peminjaman()
  {
    $data = $this->session->userdata();

    // die(var_dump($data));

    $data['title'] = 'Peminjaman - Peminjaman IT';
    $data['content'] = $this->load->view('General/peminjaman', null, true);
    $this->load->view('layout', $data);
  }
}