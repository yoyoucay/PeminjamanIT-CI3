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


  public function insPeminjaman()
  {
    $session = $this->session->userdata();

    $idCreate = $session['idUser'];
    $sEmpID = $session['sEmpID'];

    $data = array(
      'sReqNum' => $this->generateReqNum(),
      'sEmpID' => $sEmpID,
      'sKdBrg' => $this->input->post('sKdBrg'),
      'decReqQty' => $this->input->post('decReqQty'),
      'dtReqStart' => $this->input->post('dtReqStart'),
      'dtReqEnd' => $this->input->post('dtReqEnd'),
      'iStatus' => 1,
      'iCreateBy' => $idCreate,
    );

    $inserted = $this->General_M->insPeminjaman($data); // Call model method to insert data

    // // TODO : Debug
    // echo json_encode(array('success' => false, 'message' => $this->db->last_query()));
    // return;

    if ($inserted) {
      echo json_encode(array('success' => true));
    } else {
      echo json_encode(array('success' => false));
    }
  }

  public function DTable_Get_Peminjaman()
  {
    header('Content-Type: application/json');

    $list = $this->General_M->get_datatablesPeminjaman();
    $data = array();

    $no = $_POST['start'];

    foreach ($list as $list_items) {
      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $list_items->sReqNum;
      $row[] = $list_items->sName;
      $row[] = $list_items->decReqQty;
      $row[] = $list_items->dtReqStart;
      $row[] = $list_items->dtReqEnd;
      $row[] = $list_items->sNameApp;
      $row[] = $this->getStatusReq($list_items->iStatus);
      $row[] = '<button onClick="editRow(' . $list_items->idReq . ')" class="btn btn-info btn-xs">Edit</button>
                <button onClick="deleteRow(' . $list_items->idReq . ')" class="btn btn-danger btn-xs">Delete</button>';
      $row[] = $list_items->idReq;
      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->General_M->count_all('peminjaman'),
      "recordsFiltered" => $this->General_M->count_filtered('peminjaman'),
      "data" => $data,
    );

    echo json_encode($output);
  }

  function getStatusReq($iStatus)
  {
    $msg = '';
    switch ($iStatus) {
      case 1:
        $msg = 'Waiting';
        break;
      case 2:
        $msg = 'Approved';
        break;
      case 3:
        $msg = 'Complete';
        break;

      case 0:
        $msg = 'Rejected';
        break;

      default:
        break;
    }

    return $msg;
  }

  public function getBarangs()
  {
    $items = $this->General_M->getBarang();
    echo json_encode($items);
  }

  public function getUsers()
  {
    $items = $this->General_M->getUser();
    echo json_encode($items);
  }

  function generateReqNum($length = 8)
  {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';

    for ($i = 0; $i < $length; $i++) {
      $code .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $code;
  }
}