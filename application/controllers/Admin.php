<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Authentication_models', 'Auth_M');
        $this->load->model('Admin_models');
        if (!$this->Auth_M->is_LoggedIn()) {
            redirect('login');
        } elseif ($this->Auth_M->is_LoggedIn() && ($this->Auth_M->is_Admin() == true)) {
            $this->Auth_M->reloadSessionData($this->session->userdata('sEmpID'));
        } else {
            redirect('dashboard');
        }
    }

    public function index()
    {

    }

    public function request()
    {
        $data = $this->session->userdata();

        // die(var_dump($data));

        $data['title'] = 'Permintaan - Peminjaman IT';
        $data['content'] = $this->load->view('Admin/request', null, true);
        $this->load->view('layout', $data);
    }

    public function barang()
    {
        $data = $this->session->userdata();

        // die(var_dump($data));

        $data['title'] = 'Barang - Peminjaman IT';
        $data['content'] = $this->load->view('Admin/barang', null, true);
        $this->load->view('layout', $data);
    }

    public function account()
    {
        $data = $this->session->userdata();

        // die(var_dump($data));

        $data['title'] = 'Akun - Peminjaman IT';
        $data['content'] = $this->load->view('Admin/account', null, true);
        $this->load->view('layout', $data);
    }


}

/* End of file Admin.php and path /application/controllers/Admin.php */


