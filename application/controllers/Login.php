<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct() {
    parent::__construct();

    $this->load->model('login_model');
    $this->load->helper('security');
    $this->load->library('form_validation');
  }
  
  public function index() {

    $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
    $this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[6]');

    if($this->form_validation->run()) {
      
      $email = $this->input->post('email');
      $senha = do_hash($this->input->post('senha'));

      $login = $this->login_model->login($email, $senha);

      if($login){

        if($login->ativo == 0) {
          $this->session->set_flashdata('erro_login', '<div class="alert alert-danger mt-2" role="alert">Erro ao tentar logar, entre em contato com o administrador do sistema.</div>');
          redirect('login');
        }

        $dadosAcesso = [
          'logado' => TRUE,
          'nome' => $login->nome,
          'email' => $login->email
        ];

        $this->session->set_userdata($dadosAcesso);

        if($this->session->userdata('logado')) {
          $this->session->set_flashdata('msg_login', 
            '<div class="alert alert-success" role="alert">Seja bem vindo(a) <strong>'.$this->session->userdata('nome').'</strong></div>'
          );
          redirect('livros');

        } else {

          $this->session->set_flashdata('erro_login', '<div class="alert alert-danger" role="alert">Erro ao tentar logar no sitema</div>');
          redirect('login');
        }
      } 

      redirect('login');

    } else {

      $data['titulo_pagina'] = 'Login';
      $data['titulo_site'] = 'Login';

      // View
      $this->load->view('template/html-head', $data);
      $this->load->view('template/header');
      $this->load->view('template/aside');
      $this->load->view('login/login_view');
      $this->load->view('template/footer');
      $this->load->view('template/html-footer');
    }
   
  }

  public function sair() {
    $this->session->sess_destroy();
    redirect('login');
  }

}