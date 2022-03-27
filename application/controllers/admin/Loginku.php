<?php
class Loginku extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('M_login','m_login');
  }

  function index()
  {
    $this->load->view('admin/v_login');
  }

  function auth()
  {
    $u = strip_tags(str_replace("'", "", $this->input->post('username')));
    $p = strip_tags(str_replace("'", "", $this->input->post('password')));

    $cadmin = $this->m_login->cekadmin($u, $p);
    // echo json_encode($cadmin);
    if ($cadmin->num_rows() > 0) {
      $this->session->set_userdata('masuk', true);
      $this->session->set_userdata('user', $u);

      $xcadmin    = $cadmin->row_array();
      $idadmin    = $xcadmin['id_user'];
      $user_nama  = $xcadmin['nama'];
      $id_role    = $xcadmin['id_role'];
      $photo      = $xcadmin['photo'];

      // Membuat Session
      $this->session->set_userdata('id_user', $idadmin);
      $this->session->set_userdata('nama', $user_nama);
      $this->session->set_userdata('id_role', $id_role);
      $this->session->set_userdata('photo', $photo);

      redirect('admin/dashboard');
    } else {
      echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Username Atau Password Salah</div>');
      redirect('admin/loginku');
    }
  }

  function logout()
  {
    $this->session->sess_destroy();
    redirect('');
  }
}
