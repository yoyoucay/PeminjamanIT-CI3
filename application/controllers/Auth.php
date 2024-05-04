<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Authentication_models', 'Auth_M');
        $this->load->model('User_models', 'User_M');
        $this->load->library('session');
        $this->load->helper(array('url', 'html', 'form', 'date'));
    }


    public function index()
    {
        echo 'INDEX AUTH';
        die();
    }

    public function login()
    {

        if ($this->Auth_M->is_LoggedIn()) {
            redirect('dashboard');
        }

        $data['title'] = 'Login - Peminjaman IT';
        $data['content'] = $this->load->view('Auth/login', null, true);

        if (isset($_POST['btnSignIn'])) {
            $this->form_validation->set_rules('empid', 'Emp. ID', 'required|callback_checkEmpId');
            $this->form_validation->set_rules('password', 'Password', 'required|callback_checkPassword');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('warning', 'Employee ID atau password salah! ');
                $this->load->view('layout', $data);
            } else {
                $user = $this->Auth_M->getDataUser('sEmpID', $this->input->post('empid'));
                try {
                    $this->Auth_M->reloadSessionData($user['sEmpID']);
                } catch (\Throwable $th) {
                    die('Failed when set session data!');
                }
                redirect('dashboard');
            }
        } else {
            $this->load->view('layout', $data);
        }
    }

    public function checkEmpId($empid)
    {
        // Check email pada saat login
        if (!$this->Auth_M->getDataUser('sEmpID', $empid)) {
            $this->session->set_flashdata('error', 'Sorry, we couldnt find your account');
            return false;
        }
        return true;
    }

    public function checkPassword($password)
    {
        $user = $this->Auth_M->getDataUser('sEmpID', $this->input->post('empid'));

        if (!$user) {
            return FALSE;
        }

        // die(var_dump($this->Auth_M->checkPassword($user['username'], $password)));
        if (!$this->Auth_M->checkPassword($user['sEmpID'], $password)) {
            $this->session->set_flashdata('error', 'Sorry, we couldnt find your account');
            return false;
        }

        return true;
    }

    public function generatePass()
    {

        $data['title'] = 'GPass - Peminjaman IT';
        $data['content'] = $this->load->view('tools/gpass', null, true);
        if (isset($_POST['btnGenerate'])) {
            // die(var_dump($this->input->post('password')));
            $pass = $this->encryption->encrypt($this->input->post('password'));
            echo 'Pass : ' . $pass;
            die();
        }
        $this->load->view('layout', $data);
    }



    public function logout()
    {
        // Destroy session and logout user
        $this->session->unset_userdata('logged_in');
        redirect('login'); // Redirect to login page after logout
    }
}
