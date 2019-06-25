<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Livros_model extends CI_Model {

  // Listar Livros
  public function getLivros() {
    return $this->db->get('livros')->result();
  }

  // Cadastrar Livro
  public function addLivro($dados=NULL) {
    if(is_array($dados)) {
      $this->db->insert('livros', $dados);
    }
  }

  // Pegar livro pela id
  public function getLivroById($id=NULL) {
    if($id) {
      $this->db->where('id', $id);
      $this->db->limit(1);
      return $this->db->get('livros')->row();
    }
  }

  // Atualizar Livro
  public function updateLivro($dados=NULL, $condicao=NULL) {
    if(is_array($dados) && is_array($condicao)) {
      $this->db->update('livros', $dados, $condicao);
    }
  }

  // Deletar Livro
  public function delLivro($id=NULL) {
    if($id) {
      $this->db->delete('livros', ['id' => $id]);
    }
  }
}
