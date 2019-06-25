<main role="main" class="col-md-9 col-lg-10 px-4 mt-3">
  <h1 class="h3"><?= $titulo_pagina ?></h1>

  <!-- Button -->
  <div class="row">
    <div class="col-12">
      <a class="btn btn-primary" href="<?= base_url('usuarios/adicionar') ?>" title="Novo Usuário">Novo Usuário</a>
    </div>  
  </div>  

  <!-- FlashData -->
  <div class="row">
    <div class="mx-auto col-lg-10 mt-3">
      <?= $this->session->flashdata('msg'); ?>
    </div>  
  </div>  


  <!-- Table -->
  <div class="row">
    <div class="col-lg-10 mx-auto mt-4">
      <table class="table table-hover" id="tabela-listar">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">E-mail</th>
            <th scope="col">Ativo</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody> 
          <?php
          foreach($usuarios as $usuario) {
          ?>
          <tr>
            <td><?= $usuario->id ?></td>
            <td><?= $usuario->nome ?></td>
            <td class="text-break"><?= $usuario->email ?></td>
            <td><?= $usuario->ativo ? '<span class="badge badge-success">Sim</span>':'<span class="badge badge-danger">Não</span>' ?></td>
            <td>
              <a href="<?= base_url('usuarios/editar/'.$usuario->id) ?>" class="btn btn-inverse-info hover-white">Editar</a>
              <a href="<?= base_url('usuarios/deletar/'.$usuario->id) ?>" class="btn btn-inverse-info hover-white">Deletar</a>
              <?php if($usuario->ativo) { ?>
              <a href="<?= base_url('usuarios/inativo/'.$usuario->id) ?>" class="btn btn-inverse-info hover-white">Desativar</a>    
              <?php } else { ?>
              <a href="<?= base_url('usuarios/ativo/'.$usuario->id) ?>" class="btn btn-inverse-info hover-white">Ativar</a>      
              <?php } ?>
            </td>
          </tr>
          <?php  
          } 
          ?>      
        </tbody>
      </table>
    </div>
  </div>