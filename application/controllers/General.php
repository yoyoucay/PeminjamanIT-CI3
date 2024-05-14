<?php

defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

    $resultChartReq = $this->db->select('SUM(decReqQty) as decReqQty, sKdBrg, sName')
      ->from('vrequest')
      ->where('iStatus = 2')
      ->group_by('sKdBrg')
      ->get()
      ->result_array();

      $resultChartStock = $this->db->select('*')
      ->from('vstock')
      ->get()
      ->result_array();

    $data['count'] = array(
      'userReg' => $this->General_M->countData('user'),
      'allReq' => $this->General_M->countData('allReq'),
      'nonComplete' => $this->General_M->countData('nonCompleteReq'),
      'complete' => $this->General_M->countData('completeReq'),
      'chartReq' => $resultChartReq,
      'chartStock' => $resultChartStock,
    );

    $data['title'] = 'Dashboard - Peminjaman IT';
    $data['content'] = $this->load->view('General/dashboard', $data['count'], true);
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

    $dtReqStart = DateTime::createFromFormat('d-m-Y', $this->input->post('dtReqStart'));
    $dtReqStart = $dtReqStart->format('Y-m-d H:i:s');

    $dtReqEnd = DateTime::createFromFormat('d-m-Y', $this->input->post('dtReqEnd'));
    $dtReqEnd = $dtReqEnd->format('Y-m-d H:i:s');

    $data = array(
      'sReqNum' => $this->generateReqNum(),
      'sEmpID' => $sEmpID,
      'sKdBrg' => $this->input->post('sKdBrg'),
      'decReqQty' => $this->input->post('decReqQty'),
      'dtReqStart' => $dtReqStart,
      'dtReqEnd' => $dtReqEnd,
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

  public function cancelPeminjaman()
  {
    if ($this->input->is_ajax_request()) {

      $session = $this->session->userdata();

      $idUser = $session['idUser'];
      $idReq = $this->input->post('id');

      $data = array(
        'iStatus' => 0,
        'iModifyBy' => $idUser,
        'dtModify' => date("Y-m-d H:i:s")
      );

      // Call model method to delete data
      $result = $this->General_M->updPeminjamanById($idReq, $data);

      if ($result) {
        // Data deleted successfully
        $response['status'] = 'success';
        $response['message'] = 'Peminjaman telah dibatalkan!';
      } else {
        // Error deleting data
        $response['status'] = 'error';
        $response['message'] = 'Pembatalan peminjaman telah gagal!';
      }

      // Send JSON response back to the client
      echo json_encode($response);
    } else {
      // Redirect or show an error page for non-AJAX requests
      show_404();
    }
  }

  public function changePassword()
  {
    $this->form_validation->set_rules('current_password', 'Current Password', 'required');
    $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[4]');
    $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

    $data = $this->session->userdata();

    if ($this->form_validation->run() == FALSE) {
      $data['title'] = 'Ganti Password - Peminjaman IT';
      $data['content'] = $this->load->view('General/change-password', null, true);
      $this->load->view('layout', $data);
    } else {
      $user_id = $this->session->userdata('idUser');
      $current_password = $this->input->post('current_password');
      $new_password = $this->encryption->encrypt($this->input->post('new_password'));

      if ($this->General_M->check_current_password($user_id, $current_password)) {
        $this->General_M->update_password($user_id, $new_password);
        $this->session->set_flashdata('success', 'Password berhasil diganti!');
        redirect('password');
      } else {
        $this->session->set_flashdata('error', 'Password tidak cocok dengan password lama!');
        redirect('password');
      }
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
      $row[] = date("d-m-Y", strtotime($list_items->dtReqStart));
      $row[] = date("d-m-Y", strtotime($list_items->dtReqEnd));
      $row[] = $list_items->sNameApp;
      $row[] = $this->getStatusReqBtn($list_items->iStatus, $list_items->sEmpApp);
      $row[] = ($list_items->iStatus != 0 && $list_items->iStatus != 3) ? '<button onClick="rejectRow(' . $list_items->idReq . ')" class="btn btn-danger btn-xs">Cancel</button>' : 'N/A';

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

  function getStatusReqBtn($iStatus, $sEmpApp = null)
  {
    $msg = '';
    switch ($iStatus) {
      case 1:
        $msg = '<div class="bg-primary text-white text-center my-4">Waiting</div>';
        break;
      case 2:
        $msg = '<div class="bg-success text-white text-center my-4">Approve</div>';
        break;
      case 3:
        $msg = '<div class="bg-info text-white text-center my-4">Complete</div>';
        break;

      case 0:
        if ($sEmpApp != null) {
          $msg = '<div class="bg-danger text-white text-center my-4">Rejected</div>';
        } else {
          $msg = '<div class="bg-danger text-white text-center my-4">Canceled</div>';
        }

        break;

      default:
        break;
    }

    return $msg;
  }

  function getStatusReq($iStatus, $sEmpApp = null)
  {
    $msg = '';
    switch ($iStatus) {
      case 1:
        $msg = 'Waiting';
        break;
      case 2:
        $msg = 'Approve';
        break;
      case 3:
        $msg = 'Complete';
        break;

      case 0:
        if ($sEmpApp != null) {
          $msg = 'Rejected';
        } else {
          $msg = 'Canceled';
        }

        break;

      default:
        break;
    }
    return $msg;
  }

  public function exportToExcel()
  {
    // Load PhpSpreadsheet library

    $spreadsheet = new Spreadsheet();

    $spreadsheet->getProperties()->setCreator("Infineon Technologies.")
      ->setLastModifiedBy("Ramadhan Wijaya")
      ->setTitle("Export Report - " . date('d-m-Y'))
      ->setSubject("Export Report PeminjamanIT")
      ->setDescription("Export report Bulanan");

    // Get active sheet
    $sheet = $spreadsheet->getActiveSheet();

    // Define headers
    $headers = ['Req. Num', 'Loan Items', 'Qty Req.', 'Start Loan', 'Finish Loan', 'ID Admin', 'Admin', 'Status'];

    $column = 'A';
    foreach ($headers as $header) {
      $sheet->setCellValue($column . '1', $header);
      $column++;
    }

    $data = $this->db->select('sReqNum,sKdBrg,decReqQty,dtReqStart,dtReqEnd,sEmpID, sNameApp,iStatus')
      ->from('vrequest')
      ->get()
      ->result_array();

    // Set data rows
    $row = 2;

    $newData = [];
    foreach ($data as $object) {
      $object['iStatus'] = $this->getStatusReq($object['iStatus'], $object['sEmpID']); // Replace 'new_value' with the desired new value
      array_push($newData, $object);
    }

    foreach ($newData as $row_data) {
      $column = 'A';
      foreach ($row_data as $cell_data) {
        $sheet->setCellValue($column . $row, $cell_data);
        $column++;
      }
      $row++;
    }

    // Set headers for Excel file
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="exported_data.xlsx"');
    header('Cache-Control: max-age=0');

    // Save Excel file to output
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
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