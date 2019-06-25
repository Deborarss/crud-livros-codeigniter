<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

  public function __construct() {
    parent::__construct();

    $this->load->model('site_model');
  }

  public function index() {
    
    $data['titulo_site'] = 'Catálogo de Livros';
    $data['titulo_pagina'] = 'Catálogo de Livros feito em PHP utilizando CodeIgniter 3';
    $data['livros'] = $this->site_model->getLivros();

    $this->load->view('frontend/template/html-head', $data);  
    $this->load->view('frontend/template/header');  
    $this->load->view('frontend/site/site_view');   
    $this->load->view('frontend/template/footer');  
    $this->load->view('frontend/template/html-footer');  
    
  }

}