<?php


## conexao com o banco de dados
require_once __DIR__ . "/../conexao/conecta.php";

## Iniciando uma sessão
if (!isset($_SESSION)) {
  session_start();
}


##Verificando se existe usuario logafo para permitir acesso ao painel administrativo
if (!isset($_SESSION['USER'])) {
  $_SESSION['naoAutorizado'] = "Você não tem acesso a essa pagina!";
  header("Location: index.php");
}



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
  <link rel="stylesheet" href="../assets/css/dashboard.min.css">
  <link rel="stylesheet" href="../assets/css/styles.min.css">
  <link rel="stylesheet" href="../custom/css/admin-dashboard.css">

  <!-- FAVICON -->
  <link rel="shortcut icon" href="../assets/img/favicon.ico" type="image/x-icon">


</head>

<body>

  <?php
  #Início TOPO
  include('Topo.php');
  #Final TOPO
  ?>

  <div class="container-fluid">
    <div class="row">
      <?php
      #Início MENU
      include('Navegacao.php');
      #Final MENU
      ?>

      <main class="ms-auto col-lg-10 px-md-4">
        <?php
        include('Log.php');
        ?>

        <?php


        require_once __DIR__ . "/../conexao/conecta.php";

        $total_produtos = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT COUNT(*) AS total FROM produtos"))['total'];
        $total_clientes = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT COUNT(*) AS total FROM clientes"))['total'];

        $total_vendas = mysqli_fetch_assoc(mysqli_query(
          $conexao,
          "SELECT COUNT(*) AS total FROM pedidos"
        ))['total'];

        $receita_total = mysqli_fetch_assoc(mysqli_query(
          $conexao,
          "SELECT COALESCE(SUM(valor_total), 0) AS total FROM pedidos"
        ))['total'];

        function imagemProdutoAdmin($arquivo)
        {
          if (empty($arquivo)) {
            return '../assets/img/placeholder-produto.jpg';
          }

          return '../img/Jogos/' . rawurlencode($arquivo);
        }

        $mais_vendido = mysqli_fetch_assoc(mysqli_query(
          $conexao,
          "SELECT produtos.nome, produtos.imagem, plataforma.nome AS plataforma,
                  COALESCE(SUM(itens_pedidos.quantidade_item), 0) AS vendas
           FROM produtos
           LEFT JOIN itens_pedidos ON itens_pedidos.id_produto = produtos.id_produto
           LEFT JOIN plataforma ON plataforma.id_plataforma = produtos.id_plataforma
           GROUP BY produtos.id_produto, produtos.nome, produtos.imagem, plataforma.nome
           ORDER BY vendas DESC, produtos.nome ASC
           LIMIT 1"
        ));

        $jogo_em_baixa = mysqli_fetch_assoc(mysqli_query(
          $conexao,
          "SELECT produtos.nome, produtos.imagem, plataforma.nome AS plataforma,
                  COALESCE(SUM(itens_pedidos.quantidade_item), 0) AS vendas
           FROM produtos
           LEFT JOIN itens_pedidos ON itens_pedidos.id_produto = produtos.id_produto
           LEFT JOIN plataforma ON plataforma.id_plataforma = produtos.id_plataforma
           GROUP BY produtos.id_produto, produtos.nome, produtos.imagem, plataforma.nome
           ORDER BY vendas ASC, produtos.nome ASC
           LIMIT 1"
        ));
        ?>

        <div>
          <?php
          if (isset($_SESSION['naoADM'])) {
            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['naoADM'] . '</div>';
            unset($_SESSION['naoADM']);
          }
          ?>

        </div>

        <div class="py-4">

          <!-- CARDS -->
          <div class="row g-3 mb-4">

            <div class="col-md-6 col-xl-3">
              <div class="card-dashboard p-3 shadow">
                <small>TOTAL DE PRODUTOS</small>
                <h2><?= $total_produtos ?></h2>
              </div>
            </div>

            <div class="col-md-6 col-xl-3">
              <div class="card-dashboard p-3 shadow">
                <small>TOTAL DE CLIENTES</small>
                <h2><?= $total_clientes ?></h2>
              </div>
            </div>

            <div class="col-md-6 col-xl-3">
              <div class="card-dashboard p-3 shadow">
                <small>TOTAL DE VENDAS</small>
                <h2><?= $total_vendas ?></h2>
              </div>
            </div>

            <div class="col-md-6 col-xl-3">
              <div class="card-dashboard p-3 shadow">
                <small>RECEITA TOTAL</small>
                <h2>R$ <?= number_format((float)$receita_total, 2, ',', '.') ?></h2>
              </div>
            </div>

          </div>

          <!-- Tabela - percentual/estoque josos -->
          <div class="row g-3 mb-4">
            <!-- Mais VEndiddos -->
            <div class="col-xl-3">
              <div class="card shadow border-0 rounded-4 h-100">
                <div class="card-header bg-white border-0 pt-3">
                  <small>Jogo Mais Vendido</small>
                </div>

                <div class="card-body d-flex align-items-center gap-3">

                  <img class="product-thumb" src="<?= imagemProdutoAdmin($mais_vendido['imagem'] ?? '') ?>"
                    alt="<?= htmlspecialchars($mais_vendido['nome'] ?? 'Produto') ?>"
                    onerror="this.onerror=null;this.src='../assets/img/placeholder-produto.jpg';"
                    style="width:150px;height:70px;object-fit:cover;border-radius:12px;">

                  <div>
                    <h5 class="fw-bold mb-1"><?= htmlspecialchars($mais_vendido['nome'] ?? 'Sem vendas') ?></h5>
                    <small class="text-muted d-block"><?= htmlspecialchars($mais_vendido['plataforma'] ?? '-') ?></small>
                    <span class="badge bg-primary mt-2"><?= (int)($mais_vendido['vendas'] ?? 0) ?> vendas</span>
                  </div>

                </div>
              </div>
            </div>

            <!-- EM baixa -->
            <div class="col-xl-3">
              <div class="card shadow border-0 rounded-4 h-100">
                <div class="card-header bg-white border-0 pt-3">
                  <small>Jogo em baixa</small>
                </div>

                <div class="card-body d-flex align-items-center gap-3">

                  <img class="product-thumb" src="<?= imagemProdutoAdmin($jogo_em_baixa['imagem'] ?? '') ?>"
                    alt="<?= htmlspecialchars($jogo_em_baixa['nome'] ?? 'Produto') ?>"
                    onerror="this.onerror=null;this.src='../assets/img/placeholder-produto.jpg';"
                    style="width:150px;height:70px;object-fit:cover;border-radius:12px;">

                  <div>
                    <h5 class="fw-bold mb-1"><?= htmlspecialchars($jogo_em_baixa['nome'] ?? 'Sem vendas') ?></h5>
                    <small class="text-muted d-block"><?= htmlspecialchars($jogo_em_baixa['plataforma'] ?? '-') ?></small>
                    <span class="badge bg-primary mt-2"><?= (int)($jogo_em_baixa['vendas'] ?? 0) ?> vendas</span>
                  </div>

                </div>
              </div>
            </div>

            <!-- Maior em estoque -->
            <?php
            $maior_estoque = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT produtos.nome,produtos.imagem,produtos.estoque,plataforma.nome AS plataforma FROM produtos INNER JOIN plataforma ON produtos.id_plataforma = plataforma.id_plataforma ORDER BY produtos.estoque DESC LIMIT 1 "));

            $menor_estoque = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT produtos.nome,produtos.imagem,produtos.estoque,plataforma.nome AS plataforma FROM produtos INNER JOIN plataforma ON produtos.id_plataforma = plataforma.id_plataforma ORDER BY produtos.estoque ASC LIMIT 1"));
            ?>

            <!-- Maior em Estoque -->
            <div class="col-xl-3">
              <div class="card shadow border-0 rounded-4 h-100">
                <div class="card-header bg-white border-0 pt-3">
                  <small>Maior em Estoque</small>
                </div>

                <div class="card-body d-flex align-items-center gap-3">
                  <img class="product-thumb" src="<?= imagemProdutoAdmin($maior_estoque['imagem']) ?>"
                    alt="<?= htmlspecialchars($maior_estoque['nome']) ?>"
                    onerror="this.onerror=null;this.src='../assets/img/placeholder-produto.jpg';"
                    style="width:70px;height:70px;object-fit:cover;border-radius:12px;">

                  <div>
                    <h5 class="fw-bold mb-1"><?= $maior_estoque['nome'] ?></h5>
                    <small class="text-muted d-block"><?= $maior_estoque['plataforma'] ?></small>
                    <span class="badge bg-success mt-2"><?= $maior_estoque['estoque'] ?> em estoque</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Menor em Estoque -->
            <div class="col-xl-3">
              <div class="card shadow border-0 rounded-4 h-100">
                <div class="card-header bg-white border-0 pt-3">
                  <small>Menor em Estoque</small>
                </div>

                <div class="card-body d-flex align-items-center gap-3">
                  <img class="product-thumb" src="<?= imagemProdutoAdmin($menor_estoque['imagem']) ?>"
                    alt="<?= htmlspecialchars($menor_estoque['nome']) ?>"
                    onerror="this.onerror=null;this.src='../assets/img/placeholder-produto.jpg';"
                    style="width:70px;height:70px;object-fit:cover;border-radius:12px;">

                  <div>
                    <h5 class="fw-bold mb-1"><?= $menor_estoque['nome'] ?></h5>
                    <small class="text-muted d-block"><?= $menor_estoque['plataforma'] ?></small>
                    <span class="badge bg-danger mt-2"><?= $menor_estoque['estoque'] ?> em estoque</span>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- TABELAS -->
          <div class="row g-3">

            <div class="col-lg-6">
              <div class="card shadow-sm">
                <div class="card-header bg-white border-0 pt-3">
                  <h5 class="fw-bold mb-0">Últimos Produtos</h5>
                </div>

                <div class="card-body">
                  <table class="table align-middle">
                    <thead>
                      <tr>
                        <th>Produto</th>
                        <th>Plataforma</th>
                        <th>Preço</th>
                        <th>Estoque</th>
                        <th>Data</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php

                      $ultimos = mysqli_query($conexao, "SELECT produtos.nome, produtos.preco_venda, produtos.preco_promocao, produtos.estoque, produtos.data_criacao, produtos.imagem, plataforma.nome AS plataforma, IF(produtos.preco_promocao > 0, produtos.preco_promocao, produtos.preco_venda) AS preco_final FROM produtos INNER JOIN plataforma ON produtos.id_plataforma = plataforma.id_plataforma ORDER BY produtos.id_produto DESC LIMIT 6
");


                      while ($produto = mysqli_fetch_assoc($ultimos)):
                      ?>
                        <tr>
                          <td>
                            <div class="d-flex align-items-center gap-2">
                              <img class="product-thumb" src="<?= imagemProdutoAdmin($produto['imagem']) ?>"
                                alt="<?= htmlspecialchars($produto['nome']) ?>"
                                onerror="this.onerror=null;this.src='../assets/img/placeholder-produto.jpg';"
                                style="width:40px;height:40px;object-fit:cover;border-radius:8px;">

                              <span><?= $produto['nome'] ?></span>
                            </div>
                          </td>

                          <div class="plataforma">
                            <td><?= $produto['plataforma'] ?></td>
                          </div>

                          <td>
                            <div class="preco">
                              R$ <?= number_format($produto['preco_final'], 2, ',', '.') ?>
                            </div>
                          </td>
                          <td><?= $produto['estoque'] ?></td>
                          <td><?= date('d/m/Y', strtotime($produto['data_criacao'])) ?></td>
                        </tr>
                      <?php endwhile; ?>

                      <style>
                        .preco {
                          font-size: 13px;
                        }

                        .table>:not(caption)>*>* {
                          font-size: 13px;
                        }
                      </style>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Estoque baixo -->
            <div class="col-lg-6">
              <div class="card shadow-sm">
                <div class="card-header bg-white border-0 pt-3">
                  <h5 class="fw-bold mb-0">Estoque Baixo</h5>
                </div>
                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Produto</th>
                        <th>Plataforma</th>
                        <th>Estoque</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $baixo = mysqli_query($conexao, "SELECT 
                            produtos.nome,
                            produtos.estoque,
                            produtos.imagem,
                            plataforma.nome AS plataforma
                        FROM produtos
                        INNER JOIN plataforma ON produtos.id_plataforma = plataforma.id_plataforma WHERE produtos.estoque <= 10 ORDER BY estoque ASC LIMIT 6");
                      foreach ($baixo as $produto):
                      ?>
                        <tr>
                          <td>
                            <div class="d-flex align-items-center gap-2">
                              <img class="product-thumb" src="<?= imagemProdutoAdmin($produto['imagem']) ?>"
                                alt="<?= htmlspecialchars($produto['nome']) ?>"
                                onerror="this.onerror=null;this.src='../assets/img/placeholder-produto.jpg';"
                                style="width:40px;height:40px;object-fit:cover;border-radius:8px;">

                              <span><?= $produto['nome'] ?></span>
                            </div>
                          </td>
                          <td><?= $produto['plataforma'] ?></td>
                          <td><?= $produto['estoque'] ?></td>
                          <td><span class="badge bg-danger">Baixo</span></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>

        </div>

      </main>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

</main>
</div>
</div>

<!-- JQUERY CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>
