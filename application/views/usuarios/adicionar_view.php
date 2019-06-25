<main role="main" class="col-md-9 col-lg-10 px-4 mt-3">
		<h1 class="h3"><?= $titulo_pagina ?></h1>

    <!-- Breadcrumb -->
    <div class="row">
      <div class="col-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('usuarios') ?>" class="text-primary">Usuários</a></li>
            <li class="breadcrumb-item active" aria-current="page">Novo Usuário</li>
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
        echo form_open();   // action
      
          // Input Nome 
          echo '<div class="form-group mt-2">';
          echo form_label('Nome:', 'nome');
          echo form_input(['type'=>'text','name'=>'nome', 'id'=>'nome', 'class'=>'form-control input-focus-primary', 'autocomplete'=>'off'], set_value('nome'));
          echo '</div>';

          // Input Email
          echo '<div class="form-group mt-2">';
          echo form_label('E-mail:', 'email');
          echo form_input(['type'=>'email','name'=>'email', 'id'=>'email', 'class'=>'form-control input-focus-primary', 'autocomplete'=>'off'], set_value('email'));
          echo '</div>';

          // Input Senha
          echo '<div class="form-group mt-2">';
          echo form_label('Senha:', 'senha');
          echo form_input(['type'=>'password','name'=>'senha', 'id'=>'senha', 'class'=>'form-control input-focus-primary', 'autocomplete'=>'off']);
          echo '</div>';

          // Input Repetir Senha
          echo '<div class="form-group mt-2">';
          echo form_label('Repetir Senha:', 'rep_senha');
          echo form_input(['type'=>'password','name'=>'senha2', 'id'=>'rep_senha', 'class'=>'form-control input-focus-primary', 'autocomplete'=>'off']);
          echo '</div>';


          // Input Submit
          echo form_submit('submit', 'Cadastrar', ['class'=>'btn btn-primary btn-block mt-4 no-focus']);

        echo form_close();
      ?>
    </div>
  </section>