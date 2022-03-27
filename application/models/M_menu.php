<?php
class M_menu extends CI_Model{

	function get_all_menu(){
		$hsl = $this->db->query("SELECT * FROM menu a INNER JOIN jenis b ON a.id_jenis = b.id_jenis");
		return $hsl;
	}

  function get_all_jenis(){
		$hsl = $this->db->query("SELECT * FROM jenis ORDER BY jenis_menu");
		return $hsl;
	}

	function simpan_menu($kode_menu, $id_jenis, $nama_menu, $satuan, $harga_jual, $deskripsi, $id_user, $gambar, $stok){ 
    $kode_menu = strtoupper($kode_menu);
    $harga_jual = str_replace(',','', $harga_jual);

 		$hsl = $this->db->query("INSERT INTO menu(kode_menu, id_jenis, nama_menu, satuan, harga_jual, deskripsi, id_user, photo, stok) values ('$kode_menu','$id_jenis', '$nama_menu', '$satuan', '$harga_jual', '$deskripsi', '$id_user', '$gambar', '$stok')");
		return $hsl;
	}

	function update_menu($kode_menu, $nama_menu, $nama_menu1, $satuan, $id_jenis, $harga_jual, $deskripsi, $id_user, $gambar, $stok){
    $harga_jual = str_replace(',','', $harga_jual);
    $hsl=1;
    if($gambar==""){
      if($nama_menu<>$nama_menu1){
        $h  = $this->db->get_where('menu', ['nama_menu' => $nama_menu])->row_array();
        if(!$h){
          $this->db->query("UPDATE menu set 
            nama_menu     = '$nama_menu',
            satuan        = '$satuan',
            id_jenis      = '$id_jenis',
            harga_jual      = '$harga_jual',
            deskripsi     = '$deskripsi',
            id_user   = '$id_user',
            stok      = '$stok',
          WHERE kode_menu = '$kode_menu'");
        }else{
          $hsl=2;
        }
      }else{
        $this->db->query("UPDATE menu set 
          satuan        = '$satuan',
          id_jenis      = '$id_jenis',
          harga_jual      = '$harga_jual',
          deskripsi     = '$deskripsi',
          id_user   = '$id_user',
          stok      = '$stok',
        WHERE kode_menu = '$kode_menu'");
      }
    }else{
      $this->db->query("UPDATE menu set 
        satuan        = '$satuan',
        id_jenis      = '$id_jenis',
        harga_jual      = '$harga_jual',
        deskripsi     = '$deskripsi',
        id_user   = '$id_user',
        photo = '$gambar',
        stok = '$stok'
      WHERE kode_menu = '$kode_menu'");
    }
    return $hsl;
	}

	function hapus_menu($kodeMenu){
    $h = $this->db->get_where('menu', ['kode_menu' => $kodeMenu])->row_array();
    $photo_makanan = $h['photo'];

    $this->db->where('kode_menu', $kodeMenu);
    $this->db->delete('menu');
    if($photo_makanan!="food.jpg"){unlink('assets/images/'.$photo_makanan);}
		// return $hsl;
	}
	
}