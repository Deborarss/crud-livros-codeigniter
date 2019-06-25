<main>
  <div class="container">
    <div class="row">
      <div class="col-12">  
      <h1 class="h3 my-4">Livros</div> 
   
        <div class="row">
          <?php foreach($livros as $livro) { ?> 
            <div class="col-6 font-875">
            <div class="card mb-3" style="max-width: 540px;">
              <div class="row no-gutters">
                <div class="col-md-4">
                  <img src="<?= base_url('upload/'.$livro->img) ?>" class="card-img" alt="<?= $livro->titulo ?>">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title"><?= $livro->titulo ?></h5>
                    <p class="card-text"><?= $livro->resumo ?></p>
                  </div> <!-- ./card-body -->
                </div>
              </div> <!-- ./row no-gutters -->
            </div>
          </div> <!-- .col -->
          <?php } ?>

        </div> <!-- ./row -->
      
    
  