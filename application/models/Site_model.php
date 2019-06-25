<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_model extends CI_Model {

  public function getLivros() {

    $this->db->where('ativo', 1);
    return $this->db->get('livros')->result();

  }

}