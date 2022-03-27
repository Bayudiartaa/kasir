<?php
class M_login extends CI_Model{
  function cekadmin($u,$p){
      $hasil=$this->db->query("SELECT * FROM user WHERE nama='$u' AND password='$p'");
      return $hasil;
  }

}
