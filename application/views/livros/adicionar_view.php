<main role="main" class="col-md-9 col-lg-10 px-4 mt-2">
	<h1 class="h3"><?= $titulo_pagina ?></h1>

	<!-- Breadcrumb -->
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('livros') ?>" class="text-primary">Livros</a></li>
			<li class="breadcrumb-item active" aria-current="page">Adicionar Livro</li>
		</ol>
	</nav>

		<!-- Flashdata -->
		<div class="row">
		<div class="col-sm-7 col-lg-5 mx-auto mt-3">
			<?= $this->session->flashdata('msg'); ?>
		</div>
  </div>

	<!-- Validation Errors -->
  <div class="row">
		<div class="col-sm-7 col-lg-5 mx-auto">
			<?=
				'<p>'.validation_errors('<div class="alert alert-danger" role="alert">', '</div>').'</p>';
			?>
		</div>
  </div>

	<!-- Formulário -->
	<section class="row">
		<div class="col-sm-7 col-lg-5 mx-auto mt-4">
			<form method="POST" action="" enctype="multipart/form-data">  <!-- use enctype="multipart/form-data" when your form includes any <input type="file"> elements -->
				<div class="form-group">
					<label for="titulo">Título</label>
					<input type="text" class="form-control input-focus-primary" name="titulo" id="titulo" placeholder="Título do livro" required>
				</div>
				<div class="form-group">
					<label for="autor">Autor</label>
					<input type="text" class="form-control input-focus-primary" name="autor" id="autor" placeholder="Autor do livro" required>
				</div>
				<div class="form-group">
					<label for="preco">Preço</label>
					<input type="text" class="form-control input-focus-primary" name="preco" id="preco" placeholder="Preço do livro" required>
				</div>
				<div class="form-group">
					<label for="resumo">Resumo</label>
					<textarea class="form-control input-focus-primary" name="resumo" id="resumo" rows="5"></textarea>
				</div>
				<div class="form-group">
					<label for="ativo">Ativo</label>
					<select class="form-control input-focus-primary" name="ativo" id="ativo">
						<option value="1">Sim</option>
						<option value="0">Não</option>
					</select>
				</div>
				<div class="form-group">
					<label for="foto_livro">Foto</label>
					<input type="file" class="form-control-file" name="foto_livro" id="foto_livro" required>
				</div>
				<button type="submit" class="btn btn-primary btn-block mt-4">Cadastrar Livro</button>
			</form>
		</div>
	</section>
	