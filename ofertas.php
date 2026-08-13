<?php

require_once __DIR__ . '/conexao/conecta.php';

$busca = isset($_GET['busca']) ? trim($_GET['busca']) : '';
$busca_sql = mysqli_real_escape_string($conexao, $busca);
$pagina_atual = isset($_GET['pagina']) ? max(1, (int) $_GET['pagina']) : 1;
$por_pagina = 12;

$condicao_oferta = "produtos.status = 1
    AND produtos.promocao = 1
    AND produtos.desconto > 0
    AND produtos.preco_promocao > 0
    AND produtos.preco_promocao < produtos.preco_venda
    AND produtos.nome LIKE '%$busca_sql%'";

$sql_total = "SELECT COUNT(*) AS quantidade FROM produtos WHERE $condicao_oferta";
$resultado_total = mysqli_query($conexao, $sql_total);
$quantidade = (int) mysqli_fetch_assoc($resultado_total)['quantidade'];
$total_paginas = max(1, (int) ceil($quantidade / $por_pagina));
$pagina_atual = min($pagina_atual, $total_paginas);
$inicio = ($pagina_atual - 1) * $por_pagina;

$sql = "SELECT produtos.*, plataforma.nome AS nome_plataforma
        FROM produtos
        INNER JOIN plataforma ON plataforma.id_plataforma = produtos.id_plataforma
        WHERE $condicao_oferta
        ORDER BY produtos.desconto DESC, produtos.id_produto DESC
        LIMIT $inicio, $por_pagina";
$resultado = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">

<?php include 'includes/head.php'; ?>
<link rel="stylesheet" href="custom/css/catalogo.css">

<body>
    <?php include 'includes/header.php'; ?>

    <section id="catalogo">
        <div class="container py-4">
            <div class="w-100 text-center">
                <h2 class="mb-4 c-gradient fs-1">Ofertas</h2>
            </div>

            <div class="d-flex justify-content-center mb-4">
                <form action="ofertas.php" method="GET" class="d-flex input-group w-50">
                    <input type="search" class="form-control me-2" name="busca"
                        value="<?php echo htmlspecialchars($busca, ENT_QUOTES, 'UTF-8'); ?>"
                        placeholder="Buscar oferta">
                    <button class="btn btn-outline-primary" type="submit" aria-label="Buscar oferta">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>

            <div class="row g-3">
                <?php if (mysqli_num_rows($resultado) === 0) { ?>
                    <p class="text-center">Nenhuma oferta encontrada no momento.</p>
                <?php } ?>

                <?php while ($produto = mysqli_fetch_assoc($resultado)) { ?>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="card h-100">
                            <a href="produtos.php?id=<?php echo (int) $produto['id_produto']; ?>" class="text-decoration-none text-white">
                                <div class="position-relative">
                                    <img src="img/Jogos/<?php echo htmlspecialchars($produto['imagem'], ENT_QUOTES, 'UTF-8'); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($produto['nome'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <span class="badge bg-success position-absolute top-0 start-0 m-2">-<?php echo (int) $produto['desconto']; ?>%</span>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title"><?php echo htmlspecialchars($produto['nome'], ENT_QUOTES, 'UTF-8'); ?></h6>
                                    <p class="card-text"><?php echo htmlspecialchars($produto['nome_plataforma'], ENT_QUOTES, 'UTF-8'); ?></p>
                                    <div class="mt-auto">
                                        <span class="text-decoration-line-through opacity-75 me-2">R$ <?php echo number_format($produto['preco_venda'], 2, ',', '.'); ?></span>
                                        <span class="fw-bold">R$ <?php echo number_format($produto['preco_promocao'], 2, ',', '.'); ?></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <?php if ($total_paginas > 1) { ?>
                <nav class="mt-4" aria-label="Paginação das ofertas">
                    <ul class="pagination justify-content-center">
                        <?php for ($pagina = 1; $pagina <= $total_paginas; $pagina++) { ?>
                            <li class="page-item <?php echo $pagina === $pagina_atual ? 'active' : ''; ?>">
                                <a class="page-link" href="ofertas.php?pagina=<?php echo $pagina; ?>&busca=<?php echo urlencode($busca); ?>"><?php echo $pagina; ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            <?php } ?>
        </div>
    </section>

    <?php include 'includes/rodape.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
