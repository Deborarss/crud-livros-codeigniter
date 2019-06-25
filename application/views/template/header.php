<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand text-primary font-weight-bold" href="#">Dashboard</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mx-auto">
      <li class="nav-item mr-4">
        <a class="nav-link text-primary font-weight-500" href="<?= base_url('livros') ?>" title="Livros">Livros</a>
      </li>
      <li class="nav-item mr-4">
        <a class="nav-link text-primary font-weight-500" href="<?= base_url('usuarios') ?>" title="Usuários">Usuários</a>
      </li>
      <li class="nav-item mr-4">
        <?php 
        if($this->session->userdata('logado')) { ?>
        <a class="nav-link text-primary font-weight-500" href="<?= base_url('login/sair') ?>" title="Sair">Sair</a>  
        <?php } else { ?>
        <a class="nav-link text-primary font-weight-500" href="<?= base_url('login') ?>" title="Logar">Logar</a>  
        <?php } ?>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Procurar" aria-label="Procurar">
      <button class="btn btn-outline-primary my-2 my-sm-0 no-focus" type="submit">Procurar</button>
    </form>
  </div>
</nav>