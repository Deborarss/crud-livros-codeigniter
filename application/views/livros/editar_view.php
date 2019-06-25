<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mt-2">
	<h1 class="h3"><?= $titulo_pagina ?></h1>

	<!-- Breadcrumb -->
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('livros') ?>" class="text-primary">Livros</a></li>
			<li class="breadcrumb-item active" aria-current="page">Editar Livro</li>
		</ol>
	</nav>

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
		<form method="POST" action="" enctype="multipart/form-data">
			<div class="form-group">
				<label for="titulo">Título</label>
				<input type="text" class="form-control input-focus-primary" name="titulo" id="titulo" value="<?= $query->titulo ?>">
			</div>
			<div class="form-group">
				<label for="autor">Autor</label>
				<input type="text" class="form-control input-focus-primary" name="autor" id="autor" value="<?= $query->autor ?>">
			</div>
			<div class="form-group">
				<label for="preco">Preço</label>
				<input type="text" class="form-control input-focus-primary" name="preco" id="preco" value="<?= $query->preco ?>">
			</div>
			<div class="form-group">
				<label for="resumo">Resumo</label>
				<textarea class="form-control input-focus-primary" name="resumo" id="resumo" rows="5"><?= $query->resumo ?></textarea>
			</div>
			<div class="form-group">	
				<?= form_label('Ativo') ?>
				<?= form_dropdown('ativo', [1 => 'Sim', 0 => 'Não'], $query->ativo == 1 ? 1 : 0, ['class'=>'form-control input-focus-primary']); ?>
			</div>
			<div class="form-group">
				<img src="<?= base_url('upload/'.$query->img) ?>" class="img-thumbnail img-livro" alt="<?= $query->titulo ?>">
			</div>
			<div class="form-group">
				<button type="button" class="btn btn-primary no-focus my-3 btn-trocar-imagem"><i class="fa fa-upload"></i> Trocar Imagem</button>
				<input type="file" name="foto_livro" class="form-control-file input-file-form-livros" disabled>
			</div>
			<input type="hidden" name="id_livro" value="<?= $query->id ?>">
			<button type="submit" class="btn btn-primary btn-block mt-4 mb-2">Atualizar Livro</button>
		</form>
	</div>
	</section>
	