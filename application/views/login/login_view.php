<main role="main" class="col-md-9 col-lg-10 px-4">
  <div class="row">
    <div class="col-md-7 col-lg-3 mx-auto"> 
      <?= $this->session->flashdata('erro_login'); ?>
      <?= '<p>'.validation_errors('<div class="alert alert-danger mt-2" role="alert">','</div>').'</p>'; ?>
    </div>
  </div>
  
  <form method="POST" action="" class="form-signin text-center mt-5"> 
    <h1 class="h3 mb-4 text-primary"><?= $titulo_pagina ?></h1>
    <label for="email" class="sr-only">E-Mail</label>
    <input type="email" name="email" class="form-control input-focus-primary mb-2" placeholder="E-mail" autofocus required>
    <label for="senha" class="sr-only">Senha</label>
    <input type="password" name="senha" class="form-control input-focus-primary" placeholder="Senha" autofocus required>
    <input type="submit" value="Logar" class="btn btn-primary mt-4 btn-block">
  </form>