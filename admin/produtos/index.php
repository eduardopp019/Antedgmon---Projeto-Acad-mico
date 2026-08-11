<?php

# conexao com o banco de dados #

require_once __DIR__ . "/../../conexao/conecta.php";

##Verificando se existe usuario logado para permitir acesso ao painel administrativo
include_once "../Usuario_Comum.php";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PAINEL ADMINISTRATIVO</title>

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- CUSTOMIZAÇÃO DO TEMPLATE -->
    <link rel="stylesheet" href="../../assets/css/dashboard.min.css">
    <link rel="stylesheet" href="../../assets/css/styles.min.css">

    <!-- FAVICON -->
    <link rel="shortcut icon" href="../../assets/img/favicon.ico" type="image/x-icon">


</head>

<body>

    <?php
    #Início TOPO
    include('../Topo.php');
    #Final TOPO
    ?>

    <div class="container-fluid">
        <div class="row">
            <?php
            #Início MENU
            include('../Navegacao.php');
            #Final MENU
            ?>

            <main class="ms-auto col-lg-10 px-md-4">
                <?php
                include('../Log.php');
                ?>


                <div class="card">

                    <div class="card-header d-flex justify-content-between">

                        <h4 class="m-0">Produtos</h4>

                        <a href="inserir.php" class="btn btn-primary btn-sm">

                            <i class="bi bi-plus"></i>
                            Adicionar
                        </a>

                    </div>

                    <?php

                    $sql = "SELECT id_produto FROM produtos";
                    // a função mysqli_query() realiza conexão com o banco de dados e executa o comando sql

                    $query = mysqli_query($conexao, $sql);


                    ?>

                        <div class="card-body">

                            <div class="row">

                                <!-- filtro por status -->

                                <div class="col-4">

                                    <form action="">

                                        <input type="search" name="nome" id="nome" class="form-control" placeholder="Pesquise por nome..." maxlength="60">

                                    </form>

                                </div>

                                
                                <div class="col-2">
                                    <form action="">
                                        <select name="categoria" id="categoria" class="form-control" required onchange="buscar()">

                                            <option value="">-- Categorias --</option>

                                            <?php

                                            $sql_categoria = "SELECT id_categoria, nome FROM categorias WHERE status =1";

                                            $query_categoria = mysqli_query($conexao, $sql_categoria);

                                            foreach ($query_categoria as $categoria) {

                                                echo '<option value="' . $categoria['id_categoria'] . '">' . $categoria['nome'] . '</option>';
                                            }

                                            ?>

                                        </select>
                                    </form>

                                </div>

                                <div class="col-2">
                                    <form action="">
                                        <select name="desenvolvedora" id="desenvolvedora" class="form-control" required onchange="buscar()">

                                            <option value="">-- Desenvolvedoras --</option>

                                            <?php

                                            $sql_desenvolvedora = "SELECT id_desenvolvedora, nome FROM desenvolvedora WHERE status =1";

                                            $query_desenvolvedora = mysqli_query($conexao, $sql_desenvolvedora);

                                            foreach ($query_desenvolvedora as $desenvolvedora) {

                                                echo '<option value="' . $desenvolvedora['id_desenvolvedora'] . '">' . $desenvolvedora['nome'] . '</option>';
                                            }

                                            ?>

                                        </select>
                                    </form>

                                </div>

                                <div class="col-2">
                                    <form action="">
                                        <select name="plataforma" id="plataforma" class="form-control" required onchange="buscar()">

                                            <option value="">-- Plataforma --</option>

                                            <?php

                                            $sql_plataforma = "SELECT id_plataforma, nome FROM plataforma WHERE status =1";

                                            $query_plataforma = mysqli_query($conexao, $sql_plataforma);

                                            foreach ($query_plataforma as $plataforma) {

                                                echo '<option value="' . $plataforma['id_plataforma'] . '">' . $plataforma['nome'] . '</option>';
                                            }

                                            ?>

                                        </select>
                                    </form>

                                </div>
                                
                                <div class="col-1">

                                    <form action="">

                                        <select name="status" id="status " class="form-control" onchange="buscar()">

                                            <option value="">Status</option>
                                            <option value="1">Ativo</option>
                                            <option value="0">Inativo</option>

                                        </select>

                                    </form>

                                </div>

                            </div>

                        </div>
                        <!-- TABELA -->
                        <div class="card-body">

                            <div id="listar"></div>

                        </div>

                    

                </div>

            </main>
        </div>
    </div>

    <!-- FECHANDO A CONEXAO COM O BANCO -->

    <?php mysqli_close($conexao) ?>

    <!-- JQUERY CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <!-- FIltros -->
  <script>
    // FUNCAO PARA LISTAR FUNCIONARIOS

    function listar(nome, status, categoria, desenvolvedora, plataforma) {

      $('#listar').text('Carregando...');

      $.ajax({

        url: 'tabela.php',
        method: 'POST',
        data: {
          nome,
          status,
          categoria,
          desenvolvedora,
          plataforma
        },
        dataType: 'html',
        success: function(res) {
          $('#listar').html(res);
        }


      })

    }

    //funcao para realizar a busca pelos filtros
    function buscar() {

      let nome = $('#nome').val();
      let status = $('#status').val();
      let categoria = $('#categoria').val();
      let desenvolvedora = $('#desenvolvedora').val();
      let plataforma = $('#plataforma').val();


      listar(nome, status, categoria, desenvolvedora, plataforma);

    }

    // executar funcoes ao carregar os documentos

    $(document).ready(function() {

      listar(); //carregar tabela


      // função para pesquisa pelo nome
      $('#nome').keyup(function() {

        let nome = $(this).val();

        listar(nome, '', '', '', '');

      })

    });


  </script>

</body>

</html>