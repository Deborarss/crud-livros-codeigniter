<main role="main" class="col-md-9 col-lg-10 px-4 mt-2">
	<h1 class="h3 "><?= $titulo_pagina ?></h1>

	<!-- Novo Livro -->
	<div class="row">
		<div class="col-12">
			<a href="<?= base_url('livros/adicionar') ?>" class="btn btn-primary no-focus mt-2" title="Novo Livro">Novo Livro</a>
		</div>
	</div>

	<!-- Flashdata -->
	<div class="row">
		<div class="col-sm-7 col-lg-5 mx-auto mt-3">
			<?= $this->session->flashdata('msg'); ?>
		</div>  
  </div> 

	<!-- Table -->
	<section class="row">
		<div class="col-12 mt-4">
			<table class="table table-hover" id="tabela-listar">
				<thead>
					<tr>
						<th class="col-1" scope="col">Img</th>
						<th class="col-4" scope="col">Título</th>
						<th class="col-3" scope="col">Autor</th>
						<th class="col-1" scope="col">Preço</th>
						<th class="col-1" scope="col">Status</th>
						<th class="col-2" scope="col">Ações</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($livros as $livro) { ?>
						<tr>
							<th scope="row"><img src="<?= base_url('upload/'.$livro->img) ?>" class="img-thumbnail" alt="<?= $livro->titulo ?>"></th>
							<td><?= $livro->titulo ?></td>
							<td><?= $livro->autor ?></td>
							<td><?= formataMoeda($livro->preco) ?></td>
							<td><?= $livro->ativo == 1 ? '<span class="badge badge-success">Sim</span>' : '<span class="badge badge-danger">Não</span>' ?></td>
							<td>
								<a href="<?= base_url('livros/editar/'.$livro->id) ?>" class="btn text-primary"	title="Editar">
									<i class="fas fa-edit"></i>
								</a>
								<a href="<?= base_url('livros/deletar/'.$livro->id) ?>" class="btn text-danger" title="Deletar">
									<i class="fas fa-trash"></i>
								</a>
								<?php if($livro->ativo == 1) { ?> 
									<a href="<?= base_url('livros/desativar/'.$livro->id) ?>" class="btn text-warning" title="Desativar">
										<i class="fas fa-times"></i>
									</a>
								<?php } else { ?>
									<a href="<?= base_url('livros/ativar/'.$livro->id) ?>" class="btn text-success" title="Ativar">
										<i class="fas fa-check"></i>
									</a>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</section>
	