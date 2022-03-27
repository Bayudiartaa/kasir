<?php
class M_transaksi extends CI_Model
{

  function get_all_transaksi()
  {
    $akses = $this->session->userdata('id_role');
    $id   = $this->session->userdata('id_user');

    if ($akses == 2) {
      $hsl = $this->db->query("SELECT * FROM master_jual a INNER JOIN user b ON a.id_user=b.id_user ORDER BY a.tgl_jual DESC, a.nofak_jual DESC");
    } else {
      $hsl = $this->db->query("SELECT * FROM master_jual a INNER JOIN user b ON a.id_user=b.id_user WHERE a.id_user='$id' ORDER BY a.tgl_jual DESC, a.nofak_jual DESC");
    }
    return $hsl;
  }

  function get_details($nofak_jual)
  {
    $hsl = $this->db->query("SELECT * FROM detail_jual a INNER JOIN menu b ON a.kode_menu=b.kode_menu WHERE a.nofak_jual='$nofak_jual' ORDER BY a.nofak_jual DESC");
    return $hsl;
  }

  function get_laporan_transaksi($id_user, $akses)
  {
    if ($id_user == "" && $akses != 3) {
      $hsl = $this->db->query("SELECT DISTINCT a.nofak_jual, c.tgl_jual, c.total_harga, c.no_meja, d.pengguna_nama FROM detail_jual a INNER JOIN menu b ON a.kode_menu=b.kode_menu INNER JOIN master_jual c ON a.nofak_jual = c.nofak_jual  INNER JOIN user d ON c.id_user = d.id_user ORDER BY a.nofak_jual DESC");
    } else {
      $hsl = $this->db->query("SELECT DISTINCT a.nofak_jual, c.tgl_jual, c.total_harga, c.no_meja, d.pengguna_nama FROM detail_jual a INNER JOIN menu b ON a.kode_menu=b.kode_menu INNER JOIN master_jual c ON a.nofak_jual = c.nofak_jual INNER JOIN user d ON c.id_user = d.id_user WHERE c.id_user = '$id_user' ORDER BY a.nofak_jual DESC");
    }
    return $hsl;
  }


  function get_all_menu()
  {
    $hsl = $this->db->query("SELECT * FROM menu ORDER BY nama_menu");
    return $hsl;
  }

  function get_all_stok()
  {
    $hsl = $this->db->query("SELECT * FROM menu ORDER BY stok");
    return $hsl;
  }

  // Transaksi Simpan
  function simpan_transaksi($tgl_jual, $total_harga, $no_meja, $condition)
  {
    $id_user = $this->session->userdata('id_user');
    $hsl = $this->db->query("INSERT INTO master_jual (tgl_jual, total_harga, no_meja, id_user, condition) VALUES ('$tgl_jual', '$total_harga', '$no_meja', '$id_user', '$condition')");
    return $hsl;
  }

  function simpan_transaksi_bayar($no_faktur, $total_bayar)
  {
    $data = array(
      'total_bayar' => $total_bayar
    );
    $this->db->where('nofak_jual', $no_faktur);
    $this->db->update('master_jual', $data);

    $hsl = $this->db->query("SELECT * FROM master_jual a INNER JOIN detail_jual b ON a.nofak_jual = b.nofak_jual INNER JOIN user c ON a.id_user = c.id_user INNER JOIN menu d ON b.kode_menu = d.kode_menu WHERE a.nofak_jual = '$no_faktur'");
    return $hsl;
  }

  function get_cetak($no_faktur)
  {
    $hsl = $this->db->query("SELECT * FROM master_jual a INNER JOIN detail_jual b ON a.nofak_jual = b.nofak_jual INNER JOIN user c ON a.id_user = c.id_user INNER JOIN menu d ON b.kode_menu = d.kode_menu WHERE a.nofak_jual = '$no_faktur'");
    return $hsl;
  }
}
