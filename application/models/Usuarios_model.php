<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

  public function doInsert($dados=null) {
    if(is_array($dados)) {
      $this->db->insert('usuarios', $dados);
    }
  }

  public function getUsuarioById($id=NULL) {

    if($id) {
      $this->db->where('id', $id);
      $this->db->limit(1);
      return $this->db->get('usuarios')->row();
    }
  }

  public function doUpdate($dados=NULL, $condicao=NULL) {
    if(is_array($dados) && $condicao) {
      $this->db->update('usuarios', $dados, $condicao);
    }
  }

  public function getUsuarios() {
    return $this->db->get('usuarios')->result();
  }

  public function doDelete($condicao=NULL) {
    if($condicao) {
      $this->db->delete('usuarios', $condicao);
      return TRUE;
    } else {
      return FALSE;
    }
  }

}