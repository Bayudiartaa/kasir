
<?php
class M_log extends CI_Model{

	function get_all_log(){
		$hsl = $this->db->query("SELECT * FROM log ORDER BY tanggal DESC");
		return $hsl;
	}
	
  function update_log($id_user, $pengunjung_id, $nama){
 		if($nama=="Belum Ada Pengguna"){
      $nm = $this->db->get_where("user",['id_user'=> $id_user])->row_array();
      if($nm){
        $pengguna_nama = $nm['nama'];
        
        $this->db->set('nama', $pengguna_nama);
        $this->db->where('penggunjung_id', $pengunjung_id);
        $this->db->where('nama', 'Belum Ada Pengguna');
        $this->db->update('log');
      }else{
        $akses = $this->session->userdata('id_role');
        if($akses == 2){
          $pengguna_id    = $this->session->userdata('id_user');
          $pengguna_nama  = $this->session->userdata('nama');
        }else{
          $id = $this->db->get_where("master_jual",['nofak_jual'=> $id_user])->row_array();
          $pengg = $id['id_user'];

          $id1 = $this->db->get_where("user",['id_user'=>$pengg])->row_array();
          $pengguna_nama = $id1['nama'];
        }

        $this->db->set('id_user', $pengguna_id);
        $this->db->set('nama', $pengguna_nama);
        $this->db->where('penggunjung_id', $pengunjung_id);
        $this->db->where('nama', 'Belum Ada Pengguna');
        $this->db->update('log');

      }

      return $pengguna_nama;
    }
	}

//   function update_log2($pengguna_id){
//     if($nama=="Belum Ada Pengguna"){
//      $nm = $this->db->get_where("x_tbl_pengguna",['pengguna_id'=>$pengguna_id])->row_array();
//      if($nama){
//        $pengguna_nama = $nm['pengguna_nama'];
       
//        $this->db->set('pengguna_nama', $pengguna_nama);
//        $this->db->where('pengunjung_id', $pengunjung_id);
//        $this->db->where('pengguna_nama', '');
//        $this->db->update('log');
//      }else{
//        $id = $this->db->get_where("tbl_master_jual",['nofak_jual'=>$pengguna_id])->row_array();
//        $pengg = $id['pengguna_id'];

//        $id1 = $this->db->get_where("x_tbl_pengguna",['pengguna_id'=>$pengg])->row_array();
//        $pengguna_nama = $id1['pengguna_nama'];

//        $this->db->set('pengguna_id', $pengg);
//        $this->db->set('pengguna_nama', $pengguna_nama);
//        $this->db->where('pengunjung_id', $pengunjung_id);
//        $this->db->where('pengguna_nama', '');
//        $this->db->update('log');

//      }

//      return $pengguna_nama;
//    }
//  }

	function get_log_cetak(){
		$hsl=$this->db->query("SELECT * FROM log ORDER BY penggunjung_id DESC");
		return $hsl;
	}

  function hapus_log($pengunjung_id){
		$hsl = $this->db->query("DELETE FROM log WHERE penggunjung_id = '$pengunjung_id'");
		return $hsl;
	}

}