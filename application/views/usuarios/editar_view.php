<main role="main" class="col-md-9 col-lg-10 px-4 mt-3">
  <h1 class="h3"><?= $titulo_pagina ?></h1>

  <!-- Breadcrumb -->
  <div class="row">
    <div class="col-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('usuarios') ?>" class="text-primary">Usuários</a></li>
          <li class="breadcrumb-item active" aria-current="page">Editar Usuário</li>
        </ol>
      </nav>
    </div>
  </div>

  <!-- Validation Errors -->
  <div class="row">
      <div class="col-sm-7 col-lg-5 mx-auto">
				<?php
					echo '<p>'.validation_errors('<div class="alert alert-danger" role="alert">', '</div>').'</p>';
				?>
      </div>
    </div>

  <!-- Form -->
  <section class="row">
    <div class="col-sm-7 col-lg-5 mx-auto">
      <?php
      /* Teste
        echo '<pre>';
        print_r($query);
      */
        echo form_open();
          // Nome
          echo '<div class="form-group mt-2">';
            echo form_label('Nome:', 'nome');
            echo form_input(['type'=>'text', 'name'=>'nome', 'id'=>'nome', 'value'=>$query->nome,'class'=>'form-control', 'autocomplete'=>'off'], set_value('valor'));
          echo '</div>';
          // Email
          echo '<div class="form-group mt-2">';
            echo form_label('E-mail:', 'email');
            echo form_input(['type'=>'email', 'name'=>'email', 'id'=>'email', 'value'=>$query->email, 'class'=>'form-control', 'autocomplete'=>'off']);
          echo '</div>'; 
          // ID
          echo form_hidden('id', $query->id); 
          // Submit
          echo '<div class="form-group mt-2">';
            echo form_submit(['name'=>'submit', 'value'=>'Atualizar', 'class'=>'btn btn-primary btn-block mt-2']);
          echo '</div>';  
          
        echo form_close(); 
      ?>
    </div>
  </section>