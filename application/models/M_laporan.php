<?php
class M_laporan extends CI_Model
{

  function get_all_laporan()
  {
    $akses = $this->session->userdata('id_role');
    $id   = $this->session->userdata('id_user');

    if ($akses == 2) {
      $hsl = $this->db->query("SELECT * FROM menu a INNER JOIN detail_jual b ON a.kode_menu=b.kode_menu INNER JOIN master_jual c ON c.nofak_jual=b.nofak_jual INNER JOIN user d ON d.id_user=c.id_user ORDER BY c.nofak_jual, c.tgl_jual");
    } else {
      $hsl = $this->db->query("SELECT * FROM menu a INNER JOIN detail_jual b ON a.kode_menu=b.kode_menu INNER JOIN master_jual c ON c.nofak_jual=b.nofak_jual INNER JOIN user d ON d.id_user=c.id_user WHERE c.id_user='$id' ORDER BY c.nofak_jual, c.tgl_jual");
    }
    return $hsl;
  }

  function get_laporan()
  {

    $this->db->select('*');
    $this->db->from('menu');
    $this->db->join('detail_jual', 'detail_jual.kode_menu=menu.kode_menu');
    $this->db->join('master_jual', 'master_jual.nofak_jual=detail_jual.nofak_jual');
    $this->db->join('user', 'user.id_user=master_jual.id_user');
    // $this->db->where('user.pengguna_hak_akses', '3');
    // $this->db->where('master_jual.tgl_jual >=', date_format($tglDari, 'Y-m-d'));
    // $this->db->where('master_jual.tgl_jual <=', $tglSampai);
    // $this->db->where('master_jual.tgl_jual BETWEEN "'. date('Y-m-d', strtotime($tglDari)). '" AND "'. date('Y-m-d', strtotime($tglSampai)).'"');
    return $this->db->get();
  }

  function get_all_pengguna()
  {
    // $all_pengguna = "CALL p_pengguna()";
    $all_pengguna = "SELECT * FROM user WHERE id_role ='3' ORDER BY nama";
    $query = $this->db->query($all_pengguna);
    return $query;
  }

  function get_pengguna_nama($id_user)
  {
    $nama = "SELECT * FROM user WHERE id_user='$id_user' ORDER BY id_user";
    $d = $this->db->query($nama)->num_rows();
    if ($d > 0) {
      $d = $this->db->query($nama)->row_array();
      echo $d['nama'];
    }
  }
}
