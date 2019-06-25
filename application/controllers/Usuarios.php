<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

  public function __construct() {
    parent::__construct();

    if(!$this->session->userdata('logado')) {
			$this->session->set_flashdata('erro_login', '<div class="alert alert-danger" role="alert">Você precisa realizar o login!</div>');
			redirect('login');
		}	

    // Carregando o model usuarios_model
    $this->load->model('usuarios_model');

    // Carregando o helper security
    $this->load->helper('security');

    // Carregando o helper form
    $this->load->helper('form');

    // Carregando o helper form_validation
    $this->load->library('form_validation');

  }

  // Index
  public function index() {
    $this->listar();
  }

  // Lista usuários
  public function listar() {
    // Parâmetros
    $data['titulo_site'] = 'Crud Usuários';
    $data['titulo_pagina'] = 'Usuários';
    $data['usuarios'] = $this->usuarios_model->getUsuarios();

    // View
    $this->load->view('template/html-head', $data);
    $this->load->view('template/header');
    $this->load->view('template/aside');
    $this->load->view('usuarios/usuarios_view');
    $this->load->view('template/footer');
    $this->load->view('template/html-footer');
  }

  // Novo usuário
  public function adicionar() {
    // Parâmetros
    $data['titulo_site'] = 'Crud Usuários';
    $data['titulo_pagina'] = 'Cadastrar Usuário';
    
		$this->form_validation->set_rules('nome', 'NOME', 'required|min_length[3]');   

		$this->form_validation->set_rules('email', 'E-MAIL', 'required|valid_email', 
			array('valid_email'=>'Você deve passar um E-MAIL válido!'));   
		
		$this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[6]|max_length[8]', 
			array(
				'required'=>'Você deve passar uma senha',
				'min_length'=>'A senha deve ter no mínimo 6 caracteres',
				'max_length'=>'A senha deve ter no máximo 8 caracteres'
      ));   
      
		$this->form_validation->set_rules('senha2', 'Repitir Senha', 'required|matches[senha]',
			array(
				'required'=>'O campo REPETIR SENHA é obrigatório.',
				'matches'=>'A senha não confere!'
			));	

		// Verificando se as regras foram atendidas
		if($this->form_validation->run()) {
      /* Teste
      echo '<pre>';
      print_r($this->input->post());
      */

      // Salvar no banco
      $dados['nome'] = $this->input->post('nome');
      $dados['email'] = $this->input->post('email');
      $dados['senha'] = do_hash($this->input->post('senha'));  // do_hash Will use SHA1 by default.
      $dados['ativo'] = 1;

      $this->usuarios_model->doInsert($dados);
      redirect('usuarios', 'refresh');

		} else {

			// View
      $this->load->view('template/html-head', $data);
      $this->load->view('template/header');
      $this->load->view('template/aside');
      $this->load->view('usuarios/adicionar_view');
      $this->load->view('template/footer');
      $this->load->view('template/html-footer');
		}
    
  }

  // Editar usuário
  public function editar($id=NULL) {

    if(!$id) {
      $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Erro, você deve passar uma id de usuário</div>');
      redirect('usuarios');
    } 

    $query = $this->usuarios_model->getUsuarioById($id);

    if(!$query) {
      $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Erro, usuário não localizado, tente novamente!</div>');
      redirect('usuarios');
    }

    $this->form_validation->set_rules('nome', 'NOME', 'trim|required|min_length[6]');
    $this->form_validation->set_rules('email', 'E-MAIL', 'trim|required|valid_email');

    if($this->form_validation->run()) {
      // Salvando no banco
      $dados['nome'] = $this->input->post('nome');
      $dados['email'] = $this->input->post('email');

      $this->usuarios_model->doUpdate($dados, ['id'=> $this->input->post('id')]);
      redirect('usuarios', 'refresh');

    } else {
      $data['titulo_site'] = 'Crud Usuários';
      $data['titulo_pagina'] = 'Editar Usuário';
      $data['query'] = $query;
      
      /* Teste
        echo '<pre>';
        print_r($data['query']);
        exit;
      */  
  
      $this->load->view('template/html-head', $data);
      $this->load->view('template/header');
      $this->load->view('template/aside');
      $this->load->view('usuarios/editar_view');
      $this->load->view('template/footer');
      $this->load->view('template/html-footer');
    }
  }

  // Deletar usuário
  public function deletar($id=NULL) {
    if(!$id) {
      $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Erro, você deve passar uma id de usuário</div>');
      redirect('usuarios');
    }

    $query =  $this->usuarios_model->getUsuarioById($id);

    if(!$query) {
      $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Erro, o usuário não foi localizado, tente novamente.</div>');
      redirect('usuarios');
    }

    // Verifica se o usuário está logado
    if($query->email == $this->session->userdata('email')) {
      $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Erro, não é permitido apagar o usuário logado no sistema.</div>');
      redirect('usuarios');
    }

    // Deletar o usuário
    if($this->usuarios_model->doDelete(['id'=> $query->id])){
      $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Usuário foi deletado com sucesso!</div>');
    } else {
      $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Erro ao apagar usuário</div>');
    }
      redirect('usuarios');
  }

  public function ativo($id=NULL) {
    if(!$id) {
      $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Erro, você deve passar uma id de usuário</div>');
      redirect('usuarios');
    }

    $query =  $this->usuarios_model->getUsuarioById($id);

    if(!$query) {
      $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Erro, o usuário não foi localizado, tente novamente.</div>');
      redirect('usuarios');
    }

    // Verifica se o usuário está logado
    if($query->email == $this->session->userdata('email')) {
      $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Erro, não é permitido mudar status de usuário logado no sistema.</div>');
      redirect('usuarios');
    }

    // Mudar Status
    $dados['ativo'] = 1;
    $this->usuarios_model->doUpdate($dados, ['id' => $query->id]);
    $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Usuário ativado com sucesso!</div>');
    redirect('usuarios');
  }

  public function inativo($id=NULL) {
    if(!$id) {
      $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Erro, você deve passar uma id de usuário</div>');
      redirect('usuarios');
    }

    $query =  $this->usuarios_model->getUsuarioById($id);

    if(!$query) {
      $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Erro, o usuário não foi localizado, tente novamente.</div>');
      redirect('usuarios');
    }

    // Verifica se o usuário está logado
    if($query->email == $this->session->userdata('email')) {
      $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Erro, não é permitido mudar status de usuário logado no sistema.</div>');
      redirect('usuarios');
    }

    // Mudar Status
    $dados['ativo'] = 0;
    $this->usuarios_model->doUpdate($dados, ['id' => $id]);
    $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Usuário desativado com sucesso!</div>');
    redirect('usuarios');

  }
}