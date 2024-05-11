<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Authentication_models', 'Auth_M');
        $this->load->model('Admin_models', 'Admin_M');
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

        // die(var_dump($this->uri->segment(1)));
        // die(var_dump($data));

        $data['title'] = 'Barang - Peminjaman IT';
        $data['content'] = $this->load->view('Admin/barang', null, true);
        $this->load->view('layout', $data);
    }
    public function insBarang()
    {
        $session = $this->session->userdata();

        $idUser = $session['idUser'];

        $data = array(
            'sKode' => $this->input->post('sKode'),
            'sName' => $this->input->post('sName'),
            'decQty' => $this->input->post('decQty'),
            'sType' => $this->input->post('sType'),
            'iCreateBy' => $idUser,
        );

        $inserted = $this->Admin_M->insBarang($data); // Call model method to insert data

        // // TODO : Debug
        // echo json_encode(array('success' => false, 'message' => $this->db->last_query()));
        // return;

        if ($inserted) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('success' => false));
        }
    }

    public function insAkun()
    {
        $session = $this->session->userdata();

        $idCreate = $session['idUser'];


        $sPassword = $this->input->post('sPassword');
        $data = array(
            'sEmpID' => $this->input->post('sEmpID'),
            'sFullname' => $this->input->post('sFullname'),
            'sRole' => $this->input->post('sRole'),
            'sPassword' => $sPassword != '' ? $this->encryption->encrypt($this->input->post('sPassword')) : $this->encryption->encrypt('Pass1234'),
            'iCreateBy' => $idCreate,
        );

        $inserted = $this->Admin_M->insAkun($data); // Call model method to insert data

        // // TODO : Debug
        // echo json_encode(array('success' => false, 'message' => $this->db->last_query()));
        // return;

        if ($inserted) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('success' => false));
        }
    }

    public function updBarang()
    {
        $session = $this->session->userdata();

        $idUser = $session['idUser'];

        $idBrg = $this->input->post('idBrg');

        $data = array(
            'sKode' => $this->input->post('sKode'),
            'sName' => $this->input->post('sName'),
            'decQty' => $this->input->post('decQty'),
            'sType' => $this->input->post('sType'),
            'iModifyBy' => $idUser,
            'dtModify' => date("Y-m-d H:i:s")
        );

        $inserted = $this->Admin_M->updBarangById($idBrg, $data); // Call model method to insert data

        // // TODO : Debug
        // echo json_encode(array('success' => false, 'message' => $this->db->last_query()));
        // return;

        if ($inserted) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('success' => false));
        }
    }

    public function updAkun()
    {
        $session = $this->session->userdata();

        $idUser = $session['idUser'];

        $idAkun = $this->input->post('idUser');

        $sPassword = $this->input->post('sPassword');

        if ($sPassword != "") {
            $data = array(
                'sEmpID' => $this->input->post('sEmpID'),
                'sFullname' => $this->input->post('sFullname'),
                'sRole' => $this->input->post('sRole'),
                'sPassword' => $this->encryption->encrypt($this->input->post('sPassword')),
                'iModifyBy' => $idUser,
                'dtModify' => date("Y-m-d H:i:s")
            );
        }

        if ($sPassword == "") {
            $data = array(
                'sEmpID' => $this->input->post('sEmpID'),
                'sFullname' => $this->input->post('sFullname'),
                'sRole' => $this->input->post('sRole'),
                'iModifyBy' => $idUser,
                'dtModify' => date("Y-m-d H:i:s")
            );
        }

        $inserted = $this->Admin_M->updAkunById($idAkun, $data); // Call model method to insert data

        // // TODO : Debug
        // echo json_encode(array('success' => false, 'message' => $this->db->last_query()));
        // return;

        if ($inserted) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('success' => false));
        }
    }

    public function delBarang()
    {
        if ($this->input->is_ajax_request()) {
            // Get data from AJAX request
            $idBrg = $this->input->post('id');

            // Load model (adjust the model name as needed)

            // Call model method to delete data
            $result = $this->Admin_M->deleteBarangById($idBrg);

            if ($result) {
                // Data deleted successfully
                $response['status'] = 'success';
                $response['message'] = 'Data deleted successfully.';
            } else {
                // Error deleting data
                $response['status'] = 'error';
                $response['message'] = 'Error deleting data.';
            }

            // Send JSON response back to the client
            echo json_encode($response);
        } else {
            // Redirect or show an error page for non-AJAX requests
            show_404();
        }
    }

    public function delAkun()
    {
        if ($this->input->is_ajax_request()) {
            // Get data from AJAX request
            $idUser = $this->input->post('id');

            // Load model (adjust the model name as needed)

            // Call model method to delete data
            $result = $this->Admin_M->deleteAkunById($idUser);

            if ($result) {
                // Data deleted successfully
                $response['status'] = 'success';
                $response['message'] = 'Data deleted successfully.';
            } else {
                // Error deleting data
                $response['status'] = 'error';
                $response['message'] = 'Error deleting data.';
            }

            // Send JSON response back to the client
            echo json_encode($response);
        } else {
            // Redirect or show an error page for non-AJAX requests
            show_404();
        }
    }

    public function DTable_Get_Barang()
    {
        header('Content-Type: application/json');

        $list = $this->Admin_M->get_datatablesBrg();
        $data = array();

        $no = $_POST['start'];

        foreach ($list as $list_items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list_items->sKode;
            $row[] = $list_items->sName;
            $row[] = $list_items->decQty;
            $row[] = $list_items->sType == 2 ? 'Non-Aset' : 'Aset';
            $row[] = '<button onClick="editRow(' . $list_items->idBrg . ')" class="btn btn-info btn-xs">Edit</button>
                <button onClick="deleteRow(' . $list_items->idBrg . ')" class="btn btn-danger btn-xs">Delete</button>';

            $row[] = $list_items->idBrg;
            $row[] = $list_items->sType;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Admin_M->count_all('barang'),
            "recordsFiltered" => $this->Admin_M->count_filtered('barang'),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function DTable_Get_Akun()
    {
        header('Content-Type: application/json');

        $list = $this->Admin_M->get_datatablesAkun();
        $data = array();

        $no = $_POST['start'];

        foreach ($list as $list_items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list_items->sEmpID;
            $row[] = $list_items->sFullname;
            $row[] = strtoupper($list_items->sRole);
            $row[] = '<button onClick="editRow(' . $list_items->idUser . ')" class="btn btn-info btn-xs">Edit</button>
                <button onClick="deleteRow(' . $list_items->idUser . ')" class="btn btn-danger btn-xs">Delete</button>';
            $row[] = $list_items->idUser;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Admin_M->count_all('akun'),
            "recordsFiltered" => $this->Admin_M->count_filtered('akun'),
            "data" => $data,
        );

        echo json_encode($output);
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


