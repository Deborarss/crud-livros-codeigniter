<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block sidebar pl-0">
      <div >
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link text-purple " href="<?= base_url('livros') ?>" title="Livros">Livros</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-purple " href="<?= base_url('usuarios') ?>" title="Usuários">Usuários</a>
          </li>
          <li class="nav-item">
            <?php
            if($this->session->userdata('logado')) { ?>
            <a class="nav-link text-purple " href="<?= base_url('login/sair') ?>" title="Sair">Sair</a>
            <?php } else { ?>
            <a class="nav-link text-purple " href="<?= base_url('login') ?>" title="Logar">Logar</a>  
            <?php } ?>
          </li>
        </ul>
      </div> 
    </nav>
