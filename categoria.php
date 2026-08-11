<?php

require_once __DIR__ . "/conexao/conecta.php";

$id_categoria = isset($_GET['categoria']) ? (int) $_GET['categoria'] : 0;
$busca = isset($_GET['busca']) ? trim($_GET['busca']) : '';
$busca_sql = mysqli_real_escape_string($conexao, $busca);
$nome_categoria = 'Catálogo';

if ($id_categoria > 0) {
    $sql_categoria = "SELECT nome FROM categorias WHERE id_categoria = $id_categoria AND status = 1 LIMIT 1";
    $result_categoria = mysqli_query($conexao, $sql_categoria);

    if ($categoria_selecionada = mysqli_fetch_assoc($result_categoria)) {
        $nome_categoria = $categoria_selecionada['nome'];
    } else {
        $id_categoria = 0;
    }
}

$where_produtos = "produtos.status = 1 AND produtos.nome LIKE '%$busca_sql%'";

if ($id_categoria > 0) {
    $where_produtos .= " AND produtos.id_categoria = $id_categoria";
}

$id_plataforma = isset($_GET['plataforma']) ? (int) $_GET['plataforma'] : 0;
if ($id_plataforma > 0) {
    $where_produtos .= " AND produtos.id_plataforma = $id_plataforma";
}

$sql_count = "SELECT COUNT(*) AS quantidade FROM produtos WHERE $where_produtos";
$result_count = mysqli_query($conexao, $sql_count);
$linha = mysqli_fetch_assoc($result_count);
$quantidade = $linha['quantidade'];

$parametros_paginacao = '&categoria=' . $id_categoria . '&busca=' . urlencode($busca);
if ($id_plataforma > 0) {
    $parametros_paginacao .= '&plataforma=' . $id_plataforma;
}

if (isset($_GET['pagina']) && !empty($_GET['pagina'])) {

    $paginaAtual = $_GET['pagina'];
} else {

    $paginaAtual = 1;
}

$url = "?pagina=";

//quantidade de produtos por pagina
$paginaQuantidade = 8;

//valor inicial para a clausa limit
$valorInicial = ($paginaAtual * $paginaQuantidade) - $paginaQuantidade;

$paginaFinal = max(1, ceil($quantidade / $paginaQuantidade));

$paginaInicial = 1;
$paginaProxima = $paginaAtual + 1;
$paginaAnterior = $paginaAtual - 1;
?>


<!DOCTYPE html>
<html lang="pt-br">


<?php include 'includes/head.php'; ?>

<!-- css -->
<link rel="stylesheet" href="custom/css/catalogo.css">

<body>

    <?php include 'includes/header.php'; ?>

    <!-- INICIO CATALAGO -->
    <section id="catalogo">
        <div class="container py-4">
            <div class="w-100 text-center">
                <h2 class="mb-4 c-gradient fs-1"><?php echo htmlspecialchars($nome_categoria, ENT_QUOTES, 'UTF-8'); ?></h2>
            </div>

            <!-- Barra de busca -->
            <div class="d-flex justify-content-center mb-4">

                <form action="categoria.php" method="GET" class="d-flex input-group w-50">

                    <input type="hidden" name="categoria" value="<?php echo $id_categoria; ?>">

                    <input type="search" class="form-control me-2" name="busca" value="<?php echo isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : ''; ?>" placeholder="Buscar jogo ou palavra-chave">

                    <button class="btn btn-outline-primary" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>

            </div>

            <!-- Filtros -->
            <div class="dropdown d-flex flex-wrap justify-content-center gap-2 mb-4">
                <?php
                $sql = "SELECT * FROM plataforma WHERE plataforma.status = 1";
                $result = mysqli_query($conexao, $sql);
                ?>
                <!-- 1 -->
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Plataforma
                </button>
                <ul class="dropdown-menu">
                    <?php while ($plataforma = mysqli_fetch_assoc($result)) { ?>
                        <li><a class="dropdown-item" href="catalogo.php?plataforma=<?php echo $plataforma['id_plataforma']; ?>"><?php echo $plataforma['nome']; ?></a></li>
                    <?php } ?>
                </ul>
                <?php
                $sql = "SELECT * FROM categorias WHERE categorias.status = 1";
                $result = mysqli_query($conexao, $sql);
                ?>
                <!-- 2 -->
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Categoria
                </button>
                <ul class="dropdown-menu">
                    <?php while ($categoria = mysqli_fetch_assoc($result)) { ?>
                        <li><a class="dropdown-item" href="#"><?php echo $categoria['nome']; ?></a></li>
                    <?php } ?>
                </ul>
                <!-- 3 -->
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Desenvolovedora
                </button>
                <?php
                $sql = "SELECT * FROM desenvolvedora WHERE desenvolvedora.status = 1";
                $result = mysqli_query($conexao, $sql);
                ?>
                <ul class="dropdown-menu">
                    <?php while ($desenvolvedora = mysqli_fetch_assoc($result)) { ?>
                        <li><a class="dropdown-item" href="#"><?php echo $desenvolvedora['nome']; ?></a></li>
                    <?php } ?>
                </ul>
                <!-- 7 -->
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Preço
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Mais Barato</a></li>
                    <li><a class="dropdown-item" href="#">Mais Caro</a></li>

                </ul>

            </div>

            <!-- Resultados -->
            <div class="row g-3">
                <!-- PRE VENDAS -->

                <?php
                $sql =
                    "SELECT produtos.*, plataforma.nome AS nome_pla, categorias.nome AS nome_cat FROM produtos INNER JOIN plataforma ON produtos.id_plataforma = plataforma.id_plataforma INNER JOIN categorias ON produtos.id_categoria = categorias.id_categoria WHERE produtos.id_categoria = 20 ORDER BY RAND()LIMIT 4;";

                $result = mysqli_query($conexao, $sql);
                ?>

                <!-- Card 1 -->

                <div class="row g-3">

                    <!-- Jogos Diversos -->
                    <?php


                    $sql = "SELECT produtos.*, plataforma.nome AS nome_pla FROM produtos INNER JOIN plataforma ON produtos.id_plataforma = plataforma.id_plataforma WHERE $where_produtos ORDER BY produtos.id_produto LIMIT $valorInicial, $paginaQuantidade";

                    $result = mysqli_query($conexao, $sql);

                    ?>

                    <?php while ($produto = mysqli_fetch_assoc($result)) { ?>
                        <div class="col-md-3">


                            <div class="card h-100">
                                <a href="produtos.php?id=<?php echo $produto['id_produto']; ?>" class="text-decoration-none text-white">
                                    <div class="position">
                                        <img src="img/jogos/<?php echo $produto['imagem']; ?>" class="card-img-top">
                                    </div>
                                    <div class="card-body d-flex flex-column">

                                        <h6 class="card-title"><?php echo $produto['nome']; ?></h6>

                                        <p class="card-text"><?php echo $produto['nome_pla']; ?></p>


                                        <div class="mt-auto d-flex justify-content-between align-items-center">



                                            <?php
                                            if ((int)$produto['promocao'] === 1 && (float)$produto['desconto'] > 0 && (float)$produto['preco_promocao'] > 0 && (float)$produto['preco_promocao'] < (float)$produto['preco_venda']) {
                                            ?>
                                                <span class="badge bg-success me-1">
                                                    -<?= (int)$produto['desconto']; ?>%
                                                </span>
                                            <?php
                                            }
                                            ?>




                                            <span class="fw-bold">
                                                R$
                                                <?php
                                                if ((int)$produto['promocao'] === 1 && (float)$produto['desconto'] > 0 && (float)$produto['preco_promocao'] > 0 && (float)$produto['preco_promocao'] < (float)$produto['preco_venda']) {
                                                    echo number_format($produto['preco_promocao'], 2, ',', '.');
                                                } else {
                                                    echo number_format($produto['preco_venda'], 2, ',', '.');
                                                }
                                                ?>
                                            </span>


                                        </div>
                                    </div>
                                </a>

                            </div>
                        </div>
                    <?php } ?>
                </div>
                <br>
                

                <!-- Mudar Pagina -->
                <nav aria-label="paginacao">
                    <ul class="pagination justify-content-center">
                        <?php if ($paginaAtual != $paginaInicial) { ?>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo $url . $paginaInicial . $parametros_paginacao ?>">Início</a>
                            </li>
                        <?php } ?>

                        <?php if ($paginaAtual >= 2) { ?>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo $url . $paginaAnterior . $parametros_paginacao ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if ($paginaAtual != $paginaFinal) { ?>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo $url . $paginaProxima . $parametros_paginacao ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>

                            <li class="page-item">
                                <a class="page-link" href="<?php echo $url . $paginaFinal . $parametros_paginacao ?>">Final</a>
                            </li>
                        <?php } ?>


                    </ul>
                </nav>
                <!-- FIM mudar pagina -->
            </div>
        </div>

    </section>
    <!-- FIM CATALAGO -->
    <!-- INICIO RODAPÉ -->
    <section id="rodape" class="py-5">
        <div class="container">
            <div class="fundo-rodape p-4 p-md-5 mb-4">
                <div class="row gy-4">

                    <div class="col-lg-3 col-md-6 d-flex flex-column justify-content-between">
                        <div>
                            <div class="logo-rodape mb-4">
                                <i class="fa-brands fa-gg fa-2x me-2"></i>
                                <span class="fw-bold text-uppercase fs-5">Antedgmon</span>
                            </div>
                        </div>
                        <div class="rodape-info-idioma d-flex gap-2 mt-auto">
                            <a href="#" class="btn btn-sm btn-light-custom"><i class="fa-solid fa-language me-1"></i>
                                Português</a>
                            <a href="#" class="btn btn-sm btn-light-custom"><i class="fa-solid fa-flag me-1"></i>
                                Brasil</a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <h5 class="fw-bold mb-3">Institucional</h5>
                        <ul class="list-unstyled lista-area">
                            <li><a href="#">Sobre</a></li>
                            <li><a href="#">Carreiras</a></li>
                            <li><a href="#">Seu jogo na Antedgmon</a></li>
                            <li><a href="#">Antedgmon Co-op</a></li>
                            <li><a href="#">Segurança</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <h5 class="fw-bold mb-3">Ajuda</h5>
                        <ul class="list-unstyled lista-area">
                            <li><a href="#">Suporte</a></li>
                            <li><a href="#">Termos de uso</a></li>
                            <li><a href="#">Política de reembolso</a></li>
                            <li><a href="#">Política de privacidade</a></li>
                            <li><a href="#">Procon/SP</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex justify-content-md-end align-items-start">
                        <div class="social-media">
                            <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-discord"></i></a>
                        </div>
                    </div>

                </div>
            </div>

            <hr class="opacity-25 my-4">
            <div class="row align-items-center gy-3" id="copy">
                <div class="col-md-6">
                    <div class="logo-rodape mb-0">
                        <i class="fa-brands fa-gg me-2 c-gradient"></i>
                        <span class="fw-bold text-uppercase c-gradient">Antedgmon</span>
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0 small opacity-75 c-gradient">&copy; 2026 Antedgmon. Todos os direitos reservados.
                        Desenvolvido
                        por Eduardo Pereira.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- FIM rodape -->

    <!-- bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

</body>
