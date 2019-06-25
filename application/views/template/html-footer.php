 <!-- jQuery -->
 <script src="<?= base_url('dist/js/jquery.slim.min.js') ?>"></script>

 <!-- Popper -->
 <script src="<?= base_url('dist/js/popper.min.js') ?>"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?= base_url('dist/js/bootstrap.js') ?>"></script>

<!-- Data Tables -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
    $('#tabela-listar').DataTable({
      language: {
        "sEmptyTable": "Nenhum registro encontrado",
        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
        "sInfoPostFix": "",
        "sInfoThousands": ".",
        "sLengthMenu": "_MENU_ resultados por página",
        "sLoadingRecords": "Carregando...",
        "sProcessing": "Processando...",
        "sZeroRecords": "Nenhum registro encontrado",
        "sSearch": "Pesquisar",
        "oPaginate": {
            "sNext": "Próximo",
            "sPrevious": "Anterior",
            "sFirst": "Primeiro",
            "sLast": "Último"
        },
        "oAria": {
            "sSortAscending": ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
        }
      }
    });

    // Mudar Imagem Livro
    $('.btn-trocar-imagem').on('click', function() {
      $('.input-file-form-livros').prop('disabled', false);
      $('.img-livro').addClass('d-none');
    });
  });
</script>

</body>
</html>