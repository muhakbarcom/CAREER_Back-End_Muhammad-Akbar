<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterUserController extends CI_Controller
{


  function __construct()
  {
    // Construct the parent class
    parent::__construct();

    //cek session
    if ($this->session->userdata('EMAIL') == '') {
      $res = array(
        'status' => 'error',
        'message' => 'Sesi habis, Silahkan login terlebih dahulu'
      );

      echo json_encode($res);
      die();
    }
  }

  public function index()
  {
  }

  // please make a crud for this controller
  // create a new user
  public function create()
  {
    $EMAIL = $this->input->post('EMAIL');
    $PASSWORD = $this->input->post('PASSWORD');
    $FULL_NAME = $this->input->post('FULL_NAME');

    //hash password
    $PASSWORD = password_hash($PASSWORD, PASSWORD_DEFAULT);

    $data = array(
      'EMAIL' => $EMAIL,
      'PASSWORD' => $PASSWORD,
      'FULL_NAME' => $FULL_NAME,
      'CREATED_DT' => date('Y-m-d H:i:s'),
      'CREATED_BY' => 'SYSTEM',
    );


    try {
      $this->db->insert('tb_m_user', $data);
      $response = array(
        'status' => 'success',
        'message' => 'Data berhasil disimpan'
      );
    } catch (Exception $e) {
      $response = array(
        'status' => 'error',
        'message' => 'Data gagal disimpan'
      );
    }

    echo json_encode($response);
  }

  // get all user
  public function getAll()
  {
    $this->db->select('*');
    $this->db->from('tb_m_user');
    $query = $this->db->get();

    $response = array(
      'status' => 'success',
      'message' => 'Data berhasil diambil',
      'data' => $query->result()
    );

    echo json_encode($response);
  }

  // get user by id
  public function getById($id)
  {
    $this->db->select('*');
    $this->db->from('tb_m_user');
    $this->db->where('ID', $id);
    $query = $this->db->get();

    $response = array(
      'status' => 'success',
      'message' => 'Data berhasil diambil',
      'data' => $query->result()
    );

    echo json_encode($response);
  }

  // update user by id
  public function update($id)
  {
    $EMAIL = $this->input->post('EMAIL');
    $PASSWORD = $this->input->post('PASSWORD');
    $FULL_NAME = $this->input->post('FULL_NAME');

    //hash password
    $PASSWORD = password_hash($PASSWORD, PASSWORD_DEFAULT);

    $data = array(
      'EMAIL' => $EMAIL,
      'PASSWORD' => $PASSWORD,
      'FULL_NAME' => $FULL_NAME,
      'UPDATED_DT' => date('Y-m-d H:i:s'),
      'UPDATED_BY' => 'SYSTEM',
    );

    $this->db->where('ID', $id);
    try {
      $this->db->update('tb_m_user', $data);
      $response = array(
        'status' => 'success',
        'message' => 'Data berhasil diupdate'
      );
    } catch (Exception $e) {
      $response = array(
        'status' => 'error',
        'message' => 'Data gagal diupdate'
      );
    }

    echo json_encode($response);
  }

  // delete user by id
  public function delete($id)
  {
    $this->db->where('ID', $id);
    try {
      $this->db->delete('tb_m_user');
      $response = array(
        'status' => 'success',
        'message' => 'Data berhasil dihapus'
      );
    } catch (Exception $e) {
      $response = array(
        'status' => 'error',
        'message' => 'Data gagal dihapus'
      );
    }

    echo json_encode($response);
  }
}

/* End of file MasterUserController.php */
