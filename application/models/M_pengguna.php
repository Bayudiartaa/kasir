<?php
class M_pengguna extends CI_Model{

	function get_all_pengguna(){
    // $all_pengguna = "CALL p_pengguna()";
    $all_pengguna = "SELECT * FROM user ORDER BY nama";
		$query = $this->db->query($all_pengguna);
		return $query;	
	}

	function get_all_pengguna_cetak(){
		$hsl=$this->db->query("SELECT * FROM user");
		return $hsl;
	}

  // Pengguna Simpan
	function simpan_pengguna($nama, $password, $email, $akses, $gambar){
		$hsl=$this->db->query("INSERT INTO user (nama, password, email, id_role, photo) VALUES ('$nama', '$email', '$password', '$email', '$akses','$gambar')");
		return $hsl;
	}

  // Pengguna Simpan tampa Gambar
	function simpan_pengguna_tanpa_gambar($nama, $password,$email, $akses, $gambar){
		$hsl = $this->db->query("INSERT INTO user (nama,password, email,id_role, photo) VALUES ('$nama','$password','$email', '$akses', '$gambar')");
		return $hsl;
	}

	// Update penggunan tanpa password dan gambar
  function update_pengguna_tanpa_pass_dan_gambar($kode, $nama, $nama1, $email, $email1, $id_role){
    if($nama== $nama1 && $email==$email1){
      $hsl = $this->db->query("UPDATE user SET
        nama       = '$nama',
        id_role  = '$id_role' 
      WHERE id_user     = '$kode'");
    }else if($nama<> $nama1 && $email==$email1){
      $h = $this->db->get_where('user', ['nama' => $nama])->row_array();
      if(!$h){
        $hsl = $this->db->query("UPDATE user SET
          nama       = '$nama',
          id_role  = '$id_role' 
        WHERE id_user     = '$kode'");
      }
    }else if($nama== $nama1 && $email<>$email1){
      $h = $this->db->get_where('user', ['email' => $email])->row_array();
      if(!$h){
        $hsl = $this->db->query("UPDATE user SET
          nama       = '$nama',

          email      = '$email',
          id_role  = '$id_role' 
        WHERE id_user     = '$kode'");
      }
    }else{
      $h = $this->db->get_where('user', ['nama' => $nama])->row_array();
      
      $i = $this->db->get_where('user', ['email' => $email])->row_array();
      if(!$h && !$i){
        $hsl = $this->db->query("UPDATE user SET
          nama       = '$nama',
          email      = '$email',
          id_role  = '$id_role' 
        WHERE id_user     = '$kode'");
      }
    }
    return $hsl;
	}

  // Update pengguna tanpa Gambar tetapi menggunakan Password
  function update_pengguna_tanpa_gambar($kode, $nama, $nama1, $email, $email1, $password, $id_role){
    if($nama== $nama1 && $email==$email1){
      $hsl = $this->db->query("UPDATE user SET
        password   = '$password',
        nama       = '$nama',
        id_role  = '$id_role' 
      WHERE id_user     = '$kode'");
    }else if($nama<>$nama1 && $email==$email1){
      $h = $this->db->get_where('user', ['nama' => $nama])->row_array();
      if(!$h){
        $hsl = $this->db->query("UPDATE user SET
          nama       = '$nama',
          password   = '$password',

          id_role  = '$id_role' 
        WHERE id_user     = '$kode'");
      }
    }else if($nama== $nama1 && $email<>$email1){
      $h = $this->db->get_where('user', ['email' => $email])->row_array();
      if(!$h){
        $hsl = $this->db->query("UPDATE user SET
          nama       = '$nama',
          password   = '$password',

          email      = '$email',
          id_role  = '$id_role' 
        WHERE id_user     = '$kode'");
      }
    }else{
      $h = $this->db->get_where('user', ['nama' => $nama])->row_array();
      
      $i = $this->db->get_where('user', ['email' => $email])->row_array();
      if(!$h && !$i){
        $hsl = $this->db->query("UPDATE user SET
          password   = '$password',
          nama       = '$nama',

          email      = '$email',
          id_role  = '$id_role' 
        WHERE id_user     = '$kode'");
      }
    
    }
    return $hsl;
	}
  
  // Update pengguna dengan gambar tetapi tidak menggunakan password
  function update_pengguna_tanpa_pass($kode, $nama, $email,$nama1, $email1, $id_role, $gambar){
    $d = $this->db->get_where('user',['id_user'=>$kode])->row_array();
    $photo = $d['photo'];

    $hsl=1;
    if($nama== $nama1 && $email==$email1){
      $this->db->query("UPDATE user SET 
        nama       = '$nama',
        id_role  = '$id_role',
        photo      = '$gambar' 
      WHERE id_user     = '$kode'");
      if($photo!='favicon.png'){unlink('assets/images/'.$photo);}
    }else if($nama<> $nama1 && $email==$email1){
      $d = $this->db->get_where('user',['id_user'=>$kode])->num_rows();
      if($d==1){
        unlink('assets/images/'.$gambar);
        $hsl=2;
      }else{
        $this->db->query("UPDATE user SET 
          nama       = '$nama',
          id_role  = '$id_role',
          photo      = '$gambar' 
        WHERE id_user     = '$kode'");
        if($photo!='favicon.png'){unlink('assets/images/'.$photo);}
      }
    }else if($nama== $nama1 && $email<>$email1){
      $h = $this->db->get_where('user', ['email' => $email])->row_array();
      if($d==1){
        unlink('assets/images/'.$gambar);
        $hsl=2;
      }else{
        $this->db->query("UPDATE user SET 
          nama       = '$nama',
          email      = '$email',

          id_role  = '$id_role',
          photo      = '$gambar' 
        WHERE id_user     = '$kode'");
        if($photo!='favicon.png'){unlink('assets/images/'.$photo);}
        
      }
    }else{
      $h = $this->db->get_where('user', ['nama' => $nama])->row_array();
      
      $i = $this->db->get_where('user', ['email' => $email])->row_array();
      if(!$h && !$i){ 
        $this->db->query("UPDATE user SET 
          nama       = '$nama',
         
         email      = '$email',

          id_role  = '$id_role',
          photo      = '$gambar' 
        WHERE id_user     = '$kode'");
        if($photo!='favicon.png'){unlink('assets/images/'.$photo);}
      }else{
        unlink('assets/images/'.$gambar);
        $hsl=2;
      }
    }
		return $hsl;
	}

  // Update semua
  function update_pengguna($kode, $nama, $nama1, $password, $email, $email1, $id_role, $gambar){
    $d = $this->db->get_where('user',['id_user'=>$kode])->row_array();
    $photo_makanan = $d['photo'];

		$hsl = $this->db->query("UPDATE user SET 
      nama       = '$nama',
      password   = md5('$password'),
      email      = '$email',
      id_role  = '$id_role',
      photo      = '$gambar' 
    WHERE id_user     = '$kode'");
    unlink('assets/images/'.$photo_makanan);

		return $hsl;
	}
	//END UPDATE PENGGUNA//

	function hapus_pengguna($kode){
    $d = $this->db->get_where('jenis',['id_user'=>$kode])->row_array();

    $e = $this->db->get_where('menu',['id_user'=>$kode])->row_array();

    $f = $this->db->get_where('master_jual',['id_user'=>$kode])->row_array();

    $hsl=1;
    if($d || $e || $f){
      $hsl=2;
    }else{
      $this->db->where('id_user', $kode);
      $this->db->delete('user');
    }
		return $hsl;
	}

	function getusername($id){
		$hsl = $this->db->query("SELECT * FROM user where id_user = '$id'");
		return $hsl;
	}

	function resetpass($id,$pass){
		$hsl = $this->db->query("UPDATE user SET password = '$pass' WHERE id_user = '$id'");
		return $hsl;
	}

	function get_pengguna_login($kode){
		$hsl = $this->db->query("SELECT * FROM user WHERE id_user = '$kode'");
		return $hsl;
	}

  

}