<?php
require_once __DIR__ . '/conexao/conecta.php';

$busca = trim($_GET['busca'] ?? '');
$busca_sql = mysqli_real_escape_string($conexao, $busca);
$plataforma_id = (int) ($_GET['plataforma'] ?? 0);
$categoria_id = (int) ($_GET['categoria'] ?? 0);
$desenvolvedora_id = (int) ($_GET['desenvolvedora'] ?? 0);
$grupo_plataforma = $_GET['grupo_plataforma'] ?? '';
$ordem = $_GET['ordem'] ?? 'recentes';
$titulo_catalogo = 'Catálogo';

if ($categoria_id > 0) {
    $categoria_titulo_resultado = mysqli_query($conexao, "SELECT nome FROM categorias WHERE id_categoria = $categoria_id AND status = 1 LIMIT 1");
    if ($categoria_titulo = mysqli_fetch_assoc($categoria_titulo_resultado)) {
        $titulo_catalogo = $categoria_titulo['nome'];
    }
}

$ordens = [
    'recentes' => 'produtos.id_produto DESC',
    'menor_preco' => 'CASE WHEN produtos.promocao = 1 AND produtos.preco_promocao > 0 THEN produtos.preco_promocao ELSE produtos.preco_venda END ASC',
    'maior_preco' => 'CASE WHEN produtos.promocao = 1 AND produtos.preco_promocao > 0 THEN produtos.preco_promocao ELSE produtos.preco_venda END DESC'
];
$ordem = $ordens[$ordem] ?? $ordens['recentes'];

$filtros = ["produtos.status = 1", "produtos.nome LIKE '%$busca_sql%'"];
if ($plataforma_id > 0) $filtros[] = "produtos.id_plataforma = $plataforma_id";
if ($categoria_id > 0) $filtros[] = "produtos.id_categoria = $categoria_id";
if ($desenvolvedora_id > 0) $filtros[] = "produtos.id_desenvolvedora = $desenvolvedora_id";
if ($grupo_plataforma === 'pc') $filtros[] = "EXISTS (SELECT 1 FROM plataforma p_menu WHERE p_menu.id_plataforma = produtos.id_plataforma AND p_menu.nome LIKE '%Steam%')";
if ($grupo_plataforma === 'playstation') $filtros[] = "EXISTS (SELECT 1 FROM plataforma p_menu WHERE p_menu.id_plataforma = produtos.id_plataforma AND p_menu.nome LIKE '%PlayStation%')";
if ($grupo_plataforma === 'xbox') $filtros[] = "EXISTS (SELECT 1 FROM plataforma p_menu WHERE p_menu.id_plataforma = produtos.id_plataforma AND p_menu.nome LIKE '%Xbox%')";
if ($grupo_plataforma === 'switch') $filtros[] = "EXISTS (SELECT 1 FROM plataforma p_menu WHERE p_menu.id_plataforma = produtos.id_plataforma AND (p_menu.nome LIKE '%Nintendo%' OR p_menu.nome LIKE '%Switch%'))";
$where = implode(' AND ', $filtros);

$por_pagina = 12;
$total = (int) mysqli_fetch_assoc(mysqli_query($conexao, "SELECT COUNT(*) AS total FROM produtos WHERE $where"))['total'];
$total_paginas = max(1, (int) ceil($total / $por_pagina));
$pagina = min(max(1, (int) ($_GET['pagina'] ?? 1)), $total_paginas);
$inicio = ($pagina - 1) * $por_pagina;

$produtos = mysqli_query($conexao, "SELECT produtos.*, plataforma.nome AS nome_plataforma FROM produtos INNER JOIN plataforma ON plataforma.id_plataforma = produtos.id_plataforma WHERE $where ORDER BY $ordem LIMIT $inicio, $por_pagina");
$plataformas = mysqli_query($conexao, 'SELECT id_plataforma, nome FROM plataforma WHERE status = 1 ORDER BY nome');
$categorias = mysqli_query($conexao, 'SELECT id_categoria, nome FROM categorias WHERE status = 1 ORDER BY nome');
$desenvolvedoras = mysqli_query($conexao, 'SELECT id_desenvolvedora, nome FROM desenvolvedora WHERE status = 1 ORDER BY nome');

function linkFiltro($valores) {
    return 'catalogo.php?' . http_build_query(array_filter($valores, fn($valor) => $valor !== '' && $valor !== 0 && $valor !== null));
}
$base = ['busca' => $busca, 'plataforma' => $plataforma_id, 'categoria' => $categoria_id, 'desenvolvedora' => $desenvolvedora_id, 'ordem' => $_GET['ordem'] ?? 'recentes'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<?php include 'includes/head.php'; ?>
<link rel="stylesheet" href="custom/css/catalogo.css">
<body>
<?php include 'includes/header.php'; ?>

<section id="catalogo"><div class="container py-4">
    <div class="w-100 text-center"><h2 class="mb-4 c-gradient fs-1"><?php echo htmlspecialchars($titulo_catalogo, ENT_QUOTES, 'UTF-8'); ?></h2></div>
    <div class="d-flex justify-content-center mb-4">
        <form action="catalogo.php" method="GET" class="d-flex input-group w-50">
            <input type="hidden" name="plataforma" value="<?php echo $plataforma_id; ?>">
            <input type="hidden" name="categoria" value="<?php echo $categoria_id; ?>">
            <input type="hidden" name="desenvolvedora" value="<?php echo $desenvolvedora_id; ?>">
            <input type="hidden" name="ordem" value="<?php echo htmlspecialchars($_GET['ordem'] ?? 'recentes'); ?>">
            <input type="search" class="form-control me-2" name="busca" value="<?php echo htmlspecialchars($busca, ENT_QUOTES, 'UTF-8'); ?>" placeholder="Buscar jogo ou palavra-chave">
            <button class="btn btn-outline-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>

    <form action="catalogo.php" method="GET" class="catalogo-filtros">
        <input type="hidden" name="busca" value="<?php echo htmlspecialchars($busca, ENT_QUOTES, 'UTF-8'); ?>">
        <label class="filtro-seletor"><span>Plataforma</span><select name="plataforma" onchange="this.form.submit()"><option value="">Todas as plataformas</option><?php while ($item = mysqli_fetch_assoc($plataformas)) { ?><option value="<?php echo (int) $item['id_plataforma']; ?>" <?php echo $plataforma_id === (int) $item['id_plataforma'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($item['nome']); ?></option><?php } ?></select></label>
        <label class="filtro-seletor"><span>Categoria</span><select name="categoria" onchange="this.form.submit()"><option value="">Todas as categorias</option><?php while ($item = mysqli_fetch_assoc($categorias)) { ?><option value="<?php echo (int) $item['id_categoria']; ?>" <?php echo $categoria_id === (int) $item['id_categoria'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($item['nome']); ?></option><?php } ?></select></label>
        <label class="filtro-seletor"><span>Desenvolvedora</span><select name="desenvolvedora" onchange="this.form.submit()"><option value="">Todas as desenvolvedoras</option><?php while ($item = mysqli_fetch_assoc($desenvolvedoras)) { ?><option value="<?php echo (int) $item['id_desenvolvedora']; ?>" <?php echo $desenvolvedora_id === (int) $item['id_desenvolvedora'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($item['nome']); ?></option><?php } ?></select></label>
        <label class="filtro-seletor"><span>Ordenar</span><select name="ordem" onchange="this.form.submit()"><option value="recentes" <?php echo ($_GET['ordem'] ?? 'recentes') === 'recentes' ? 'selected' : ''; ?>>Mais recentes</option><option value="menor_preco" <?php echo ($_GET['ordem'] ?? '') === 'menor_preco' ? 'selected' : ''; ?>>Menor preço</option><option value="maior_preco" <?php echo ($_GET['ordem'] ?? '') === 'maior_preco' ? 'selected' : ''; ?>>Maior preço</option></select></label>
        <a class="limpar-filtros" href="catalogo.php">Limpar</a>
    </form>

    <p class="text-center text-light mb-3"><?php echo $total; ?> produto<?php echo $total === 1 ? '' : 's'; ?> encontrado<?php echo $total === 1 ? '' : 's'; ?></p>
    <div class="row g-3">
        <?php if (mysqli_num_rows($produtos) === 0) { ?><div class="col-12"><div class="no-results"><h3>Nenhum produto encontrado</h3><p>Tente alterar os filtros.</p></div></div><?php } ?>
        <?php while ($produto = mysqli_fetch_assoc($produtos)) { $promo = (int) $produto['promocao'] === 1 && (float) $produto['desconto'] > 0 && (float) $produto['preco_promocao'] > 0 && (float) $produto['preco_promocao'] < (float) $produto['preco_venda']; ?>
        <div class="col-md-3"><div class="card h-100"><a href="produtos.php?id=<?php echo (int) $produto['id_produto']; ?>" class="catalogo-card-link text-decoration-none text-white"><div class="position position-relative"><img src="img/jogos/<?php echo htmlspecialchars($produto['imagem']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($produto['nome']); ?>"><?php if ($promo) { ?><span class="badge bg-success position-absolute top-0 start-0 m-2">-<?php echo (int) $produto['desconto']; ?>%</span><?php } ?></div><div class="card-body d-flex flex-column"><h6 class="card-title"><?php echo htmlspecialchars($produto['nome']); ?></h6><p class="card-text"><?php echo htmlspecialchars($produto['nome_plataforma']); ?></p><div class="mt-auto"><?php if ($promo) { ?><span class="text-decoration-line-through opacity-75 me-2">R$ <?php echo number_format($produto['preco_venda'], 2, ',', '.'); ?></span><?php } ?><span class="fw-bold">R$ <?php echo number_format($promo ? $produto['preco_promocao'] : $produto['preco_venda'], 2, ',', '.'); ?></span></div></div></a></div></div>
        <?php } ?>
    </div>

    <?php if ($total_paginas > 1) { ?><nav class="mt-4" aria-label="Paginação do catálogo"><ul class="pagination justify-content-center"><?php for ($i = 1; $i <= $total_paginas; $i++) { ?><li class="page-item <?php echo $i === $pagina ? 'active' : ''; ?>"><a class="page-link" href="<?php echo linkFiltro(array_merge($base, ['pagina' => $i])); ?>"<?php echo $i === $pagina ? ' aria-current="page"' : ''; ?>><?php echo $i; ?></a></li><?php } ?></ul></nav><?php } ?>
</div></section>
<?php include 'includes/rodape.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body></html>
