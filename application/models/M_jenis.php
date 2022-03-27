<?php
class M_jenis extends CI_Model{
	
  function get_all_jenis(){
		$hsl = $this->db->query("SELECT * FROM jenis ORDER BY jenis_menu");
		return $hsl;
	}
  
	function simpan_jenis($jenis_menu, $id_user){ 
    $this->db->query("INSERT INTO jenis(jenis_menu, id_user) values ('$jenis_menu', '$id_user')");
    // return $hsl;

}

	function update_jenis($idJenis,$jenis_menu){
		$hsl=$this->db->query("UPDATE jenis SET jenis_menu ='$jenis_menu' where id_jenis ='$idJenis'");
		return $hsl;
	}
  
	function hapus_jenis($idJenis){
		$hsl = $this->db->query("DELETE FROM jenis WHERE id_jenis = '$idJenis'");
		return $hsl;
	}
	
  function get_all_jenis_cetak(){
		$hsl=$this->db->query("SELECT * FROM jenis ORDER BY jenis_menu");
		return $hsl;
	}
}