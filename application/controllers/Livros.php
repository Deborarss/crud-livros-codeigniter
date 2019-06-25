<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Livros extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		
		if(!$this->session->userdata('logado')) {
			$this->session->set_flashdata('erro_login', '<div class="alert alert-danger mt-2" role="alert">Você precisa realizar o login!</div>');
			redirect('login');
		}	

		// Carregando o model livros_model.php
		$this->load->model('livros_model');

		// Carregando o helper
		$this->load->helper('funcoes_helper', 'funcoes');

		// Carregando o helper form
		$this->load->helper('form');

		// Carregando a library form_validation
		$this->load->library('form_validation');
	}

	public function index() {
		$this->listar();
	}

	public function listar() {
		// Parâmetros
		$data['titulo_site'] = 'Crud Livros';
		$data['titulo_pagina'] = 'Lista de Livros';
		$data['livros'] = $this->livros_model->getLivros();

		// View
		$this->load->view('template/html-head', $data);
		$this->load->view('template/header');
		$this->load->view('template/aside');
		$this->load->view('livros/livros_view');
		$this->load->view('template/footer');
		$this->load->view('template/html-footer');
	}

	public function adicionar() {

		$this->form_validation->set_rules('titulo', 'Título', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('autor', 'Autor', 'trim|required');
		$this->form_validation->set_rules('preco', 'Preço', 'trim|required');
		$this->form_validation->set_rules('resumo', 'Resumo', 'trim|required');

		if($this->form_validation->run()) {
			/* Teste
				echo '<pre>';
				print_r($this->input->post());
			*/

			// Upload da imagem
			$config['upload_path'] = './upload/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = 2048;
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload', $config);

			if(!$this->upload->do_upload('foto_livro')) {

				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">'.$this->upload->display_errors().'</div>');
				redirect('livros/adicionar','refresh');				

			} else {

				/* Teste
					echo '<pre>';
					print_r($this->upload->data());
					exit;
				*/

				$inputAdicionar['titulo'] = $this->input->post('titulo');
				$inputAdicionar['autor'] = $this->input->post('autor');
				$inputAdicionar['preco'] = $this->input->post('preco');
				$inputAdicionar['resumo'] = $this->input->post('resumo');
				$inputAdicionar['ativo'] = $this->input->post('ativo');
				$inputAdicionar['img'] = $this->upload->data('file_name');

				$this->livros_model->addLivro($inputAdicionar);
				$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Livro cadastrado com sucesso!</div>');
				redirect('livros','refresh');
			}	

		} else {
			// Parâmetros
			$data['titulo_site'] = 'Crud Livros';
			$data['titulo_pagina'] = 'Adicionar Livros';

			// View
			$this->load->view('template/html-head', $data);
			$this->load->view('template/header');
			$this->load->view('template/aside');
			$this->load->view('livros/adicionar_view');
			$this->load->view('template/footer');
			$this->load->view('template/html-footer');
		}
	
	}

	public function editar($id=NULL) {

		if(!$id) {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Você precisa selecionar um livro.</div>');
			redirect('livros', 'refresh');
		}

		$query = $this->livros_model->getLivroById($id);

		if(!$query) {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Livro não encontrado.</div>');
			redirect('livros', 'refresh');
		}

		$this->form_validation->set_rules('titulo', 'Título', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('autor', 'Autor', 'trim|required');
		$this->form_validation->set_rules('preco', 'Preço', 'trim|required');
		$this->form_validation->set_rules('resumo', 'Resumo', 'trim|required');

		if($this->form_validation->run()) {

			/* Teste
				echo '<pre>';
				print_r($this->input->post());
			*/

			// Nome da Imagem
			$nome_imagem = NULL;

			// Upload da Imagem
			$config['upload_path'] = './upload/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = 2048;
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload', $config);

			if($this->upload->do_upload('foto_livro')) {
				$nome_imagem = $this->upload->data('file_name');				
			}	
		
			$inputEditar['titulo'] = $this->input->post('titulo');
			$inputEditar['autor'] = $this->input->post('autor');
			$inputEditar['preco'] = $this->input->post('preco');
			$inputEditar['resumo'] = $this->input->post('resumo');
			$inputEditar['ativo'] = $this->input->post('ativo');

			if($nome_imagem) {
				$inputEditar['img'] = $nome_imagem;
			}

			$this->livros_model->updateLivro($inputEditar, ['id' => $this->input->post('id_livro')]);
			$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Livro atualizado com sucesso!</div>');
			redirect('livros', 'refresh');

		} else {
			// Parâmetros
			$data['titulo_site'] = 'Crud Livros';
			$data['titulo_pagina'] = 'Editar Livros';
			$data['query'] = $query;

			// View
			$this->load->view('template/html-head', $data);
			$this->load->view('template/header');
			$this->load->view('template/aside');
			$this->load->view('livros/editar_view');
			$this->load->view('template/footer');
			$this->load->view('template/html-footer');
		}
	
	}

	public function deletar($id=NULL) {
		
		if(!$id) {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Você precisa selecionar um livro.</div>');
			redirect('livros', 'refresh');
		}

		$query = $this->livros_model->getLivroById($id);

		if(!$query) {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Livro não encontrado.</div>');
			redirect('livros', 'refresh');
		}

		$this->livros_model->delLivro($query->id);
		$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Livro deletado com sucesso!</div>');
		redirect('livros', 'refresh');
	}

	public function ativar($id=NULL) {

		if(!$id) {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Você precisa selecionar um livro.</div>');
			redirect('livros', 'refresh');
		}

		$query = $this->livros_model->getLivroById($id);

		if(!$query) {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Livro não encontrado.</div>');
			redirect('livros', 'refresh');
		}

		$this->livros_model->updateLivro(['ativo' => 1], ['id' => $query->id]);
		$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Livro está ativo!</div>');
		redirect('livros', 'refresh');
	}

	public function desativar($id=NULL) {

		if(!$id) {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Você precisa selecionar um livro.</div>');
			redirect('livros', 'refresh');
		}

		$query = $this->livros_model->getLivroById($id);

		if(!$query) {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Livro não encontrado.</div>');
			redirect('livros', 'refresh');
		}
		$this->livros_model->updateLivro(['ativo' => 0], ['id' => $query->id]);
		$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Livro está desativo!</div>');
		redirect('livros', 'refresh');
	}

}
