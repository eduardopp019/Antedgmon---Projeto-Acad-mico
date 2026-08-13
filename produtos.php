<?php

require_once __DIR__ . "/conexao/conecta.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;


$sql = "SELECT produtos.*, plataforma.nome AS plataforma_nome, categorias.nome AS categoria_nome, desenvolvedora.nome AS desenvolvedora_nome FROM produtos INNER JOIN plataforma ON produtos.id_plataforma = plataforma.id_plataforma INNER JOIN categorias ON produtos.id_categoria = categorias.id_categoria INNER JOIN desenvolvedora ON produtos.id_desenvolvedora = desenvolvedora.id_desenvolvedora WHERE produtos.id_produto = $id";


$result = mysqli_query($conexao, $sql);
// transforma em array
$produto = mysqli_fetch_assoc($result);

if (!$produto) {
    echo "Produto não encontrado";
    exit;
}

$tem_promocao = $produto
    && (int)$produto['promocao'] === 1
    && (float)$produto['desconto'] > 0
    && (float)$produto['preco_promocao'] > 0
    && (float)$produto['preco_promocao'] < (float)$produto['preco_venda'];

// Só mostra o contador se a promoção tiver data válida e ainda não tiver acabado.
$data_fim_promocao = trim((string)($produto['data_fim_promocao'] ?? ''));
$fim_promocao_timestamp = false;

if ($data_fim_promocao !== '' && $data_fim_promocao !== '0000-00-00') {
    $fim_promocao = DateTime::createFromFormat('!Y-m-d', $data_fim_promocao);

    if ($fim_promocao && $fim_promocao->format('Y-m-d') === $data_fim_promocao) {
        $fim_promocao->setTime(23, 59, 59);
        $fim_promocao_timestamp = $fim_promocao->getTimestamp();
    }
}

$exibir_contador_promocao = $tem_promocao
    && $fim_promocao_timestamp !== false
    && $fim_promocao_timestamp > time();

$min = json_decode($produto['requisitos_minimos'], true);
$rec = json_decode($produto['requisitos_recomendados'], true);

// Produtos parecidos: a categoria tem prioridade e a plataforma complementa a lista.
$categoria_atual = (int)$produto['id_categoria'];
$plataforma_atual = (int)$produto['id_plataforma'];
$sql_relacionados = "SELECT produtos.*, plataforma.nome AS plataforma_nome
    FROM produtos
    INNER JOIN plataforma ON produtos.id_plataforma = plataforma.id_plataforma
    WHERE produtos.status = 1
      AND produtos.id_produto != $id
      AND (produtos.id_categoria = $categoria_atual OR produtos.id_plataforma = $plataforma_atual)
    ORDER BY
      CASE WHEN produtos.id_categoria = $categoria_atual THEN 0 ELSE 1 END,
      CASE WHEN produtos.id_plataforma = $plataforma_atual THEN 0 ELSE 1 END,
      produtos.id_produto DESC
    LIMIT 12";
$produtos_relacionados = mysqli_query($conexao, $sql_relacionados);


if (!$produto) {
    echo "Produto não encontrado";
    exit;
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<?php include 'includes/head.php'; ?>

<!-- css -->
<link rel="stylesheet" href="custom/css/produtos.css">


<style>
    body {
        background:
            linear-gradient(to top,
                rgba(255, 120, 0, 0.6),
                rgba(0, 0, 0, 0.95)),
            url('img/Jogos/<?php echo $produto["imagem_bg"]; ?>');

        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
</style>

<body>

    <?php include 'includes/header.php'; ?>


    <!-- INICIO GAMES -->

    <section class="name">

        <div class="game-header">
            <div class="game-logo">
                <img src="img/Jogos/<?php echo htmlspecialchars($produto['imagem']); ?>" alt="Game Logo">
            </div>
            <div class="game-info">
                <h2 class="game-title"><?php echo htmlspecialchars($produto['nome'] ?? 'Produto') ?></h2>
                <div class="d-flex gap-1 fs-4">
                    <p class="card-text"><?php echo $produto['plataforma_nome']; ?></p>
                </div>
            </div>
        </div>

    </section>
    <section id="produtos" class="produtos-grid">
        <div class="d-flex">
            <!-- CARROSEL -->
            <section class="carrosel-imagem">

                <div id="carrossel-principal" class="text-center mb-4">
                    <img id="game-main-image" class="game-main-image"
                        src="img/Jogos/<?php echo htmlspecialchars($produto['imagem']); ?>"
                        alt="<?php echo htmlspecialchars($produto['nome'] ?? 'Produto'); ?>" />
                </div>


                <?php if (!empty($produto['imagem2'])) { ?>
                    <!-- CARROSSEL DE THUMBS (só aparece se tiver imagem2) -->
                    <section id="carrosel-games">
                        <div class="carrosel-thumbs">
                            <div class="thumb active">
                                <img src="img/Jogos/<?php echo htmlspecialchars($produto['imagem']); ?>">
                            </div>
                            <div class="thumb">
                                <img src="img/Jogos/<?php echo htmlspecialchars($produto['imagem2']); ?>">
                            </div>

                            <?php if (!empty($produto['imagem3'])) { ?>
                                <div class="thumb">
                                    <img src="img/Jogos/<?php echo htmlspecialchars($produto['imagem3']); ?>">
                                </div>
                            <?php } ?>

                            <?php if (!empty($produto['imagem4'])) { ?>
                                <div class="thumb">
                                    <img src="img/Jogos/<?php echo htmlspecialchars($produto['imagem4']); ?>">
                                </div>
                            <?php } ?>
                        </div>

                    </section>

                <?php } ?>


                <br>
                <br>
                <!-- descricao -->
                <div id="Desc" class="desc-box">
                    <div class="desc-card">
                        <?php if ($tem_promocao) { ?>

                            <!-- COM PROMOÇÃO -->

                            <div class="desc-tag">
                                -<?php echo (int)$produto['desconto']; ?>%
                            </div>

                            <div class="desc-prices">
                                <span class="desc-original">
                                    R$ <?php echo number_format($produto['preco_venda'], 2, ',', '.'); ?>
                                </span>

                                <span class="desc-sale">
                                    R$ <?php echo number_format($produto['preco_promocao'], 2, ',', '.'); ?>
                                </span>
                            </div>

                            <?php if ($exibir_contador_promocao) { ?>
                                <p class="desc-timer" id="contador-oferta">
                                    Oferta acaba em:
                                    <span id="timer"></span>
                                </p>
                            <?php } ?>

                            <p class="desc-note">
                                Promoção sujeita à disponibilidade de estoque.
                            </p>

                        <?php } else { ?>

                            <!-- SEM PROMOÇÃO -->

                            <div class="desc-prices">
                                <span class="desc-sale fw-bold fs-3">
                                    R$ <?php echo number_format($produto['preco_venda'], 2, ',', '.'); ?>
                                </span>
                            </div>

                        <?php } ?>


                        <div class="desc-store">
                            <span>Plataforma</span>
                            <small><?php echo $produto['plataforma_nome']; ?></small>
                        </div>
                        <p class="desc-info">Produto ativado através de <a href="#">chave de ativação</a></p>
                        <div class="desc-actions">
                            <button class="btn btn-comprar"><i class="fa-solid fa-cart-arrow-down"></i>Comprar</button>
                            <button class="btn btn-desejo"><i class="fa-solid fa-heart"></i>Desejo</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>


    </section>



    <!-- DETALHES e REQUISITOS -->


    <section class="game-details-layout">
        <?php if ($produto['tipo'] == 0): ?>
            <div class="game-details system-requirements">
                <h3 class="fs-4">Requisitos do Sistema</h3><br>
                <p><strong>Mínimos:</strong></p>
                <ul>

                    <li>
                        <strong>SO:</strong>
                        <span class="valor"><?= $min['so'] ?></span>
                    </li>


                    <li>
                        <strong>Armazenamento:</strong>
                        <span class="valor"><?= $min['armazenamento'] ?></span>
                    </li>


                    <li>
                        <strong>Processador:</strong>
                        <span class="valor"><?= $min['processador'] ?></span>
                    </li>


                    <li>
                        <strong>Memória:</strong>
                        <span class="valor"><?= $min['memoria'] ?></span>
                    </li>


                    <li>
                        <strong>Placa de Vídeo:</strong>
                        <span class="valor"><?= $min['gpu'] ?></span>
                    </li>


                    <li>
                        <strong>Placa de Som:</strong>
                        <span class="valor"><?= $min['som'] ?></span>
                    </li>

                    <li>
                        <strong>DirectX:</strong>
                        <span class="valor"><?= $min['directx'] ?></span>
                    </li>

                </ul>
                <p><strong>Recomendados:</strong></p>
                <ul>

                    <li>
                        <strong>SO:</strong>
                        <span class="valor"><?= $rec['so'] ?></span>
                    </li>

                    <li>
                        <strong>Armazenamento:</strong>
                        <span class="valor"><?= $rec['armazenamento'] ?></span>
                    </li>

                    <li>
                        <strong>Processador:</strong>
                        <span class="valor"><?= $rec['processador'] ?></span>
                    </li>

                    <li>
                        <strong>Memória:</strong>
                        <span class="valor"><?= $rec['memoria'] ?></span>
                    </li>

                    <li>
                        <strong>Placa de Vídeo:</strong>
                        <span class="valor"><?= $rec['gpu'] ?></span>
                    </li>

                    <li>
                        <strong>Placa de Som:</strong>
                        <span class="valor"><?= $rec['som'] ?></span>
                    </li>

                    <li>
                        <strong>DirectX:</strong>
                        <span class="valor"><?= $rec['directx'] ?></span>
                    </li>

                </ul>
            </div>
        <?php endif; ?>


        <!-- AREA2 REQUISITOS -->

        <div class="game-details game-about d-flex flex-column <?= ($produto['tipo'] != 0) ? 'game-about-full' : '' ?>">

            <!-- AREA1 DETALHES -->
            <div id="area3">



                <h3 class="fs-4">Sobre o jogo</h3><br>
                <p><?php echo $produto['descricao']; ?></p>

                <h3>Categoria</h3>
                <div class="tags">
                    <a href="catalogo.php?categoria=<?php echo (int) $produto['id_categoria']; ?>">
                        <div><?php echo htmlspecialchars($produto['categoria_nome'], ENT_QUOTES, 'UTF-8'); ?></div>
                    </a>
                </div>

            </div>
            <br>
            <div id="area1">

                <p><strong>Lançamento:</strong>
                    <?php echo date('d/m/Y', strtotime($produto['data_criacao'])); ?>
                </p>

                <p><strong>Desenvolvedor:</strong> <?php echo htmlspecialchars($produto['desenvolvedora_nome']); ?></p>



                <div class="classificacao d-flex align-items-center mt-auto">
                    <div class="icon"><?php echo $produto['classificacao']; ?></div>
                    <div class="classificacao-text ms-3">
                        <div class="classificacao-text">
                            <?php
                            $idade = $produto['classificacao'];

                            if ($idade == 3) {
                                echo "Livre para todos";
                            } elseif ($idade == 10) {
                                echo "Não recomendado para menores de 10 anos";
                            } elseif ($idade == 12) {
                                echo "Não recomendado para menores de 12 anos";
                            } elseif ($idade == 14) {
                                echo "Não recomendado para menores de 14 anos";
                            } elseif ($idade == 16) {
                                echo "Não recomendado para menores de 16 anos";
                            } elseif ($idade == 18) {
                                echo "Conteúdo adulto";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- FIM GAMES -->

    <?php if ($produtos_relacionados && mysqli_num_rows($produtos_relacionados) > 0) { ?>
        <section class="produtos-relacionados" aria-labelledby="titulo-relacionados">
            <div class="relacionados-cabecalho">
                <div>
                    <span>Descubra mais</span>
                    <h2 id="titulo-relacionados">Produtos relacionados</h2>
                    <p>Mais jogos da categoria <?php echo htmlspecialchars($produto['categoria_nome'], ENT_QUOTES, 'UTF-8'); ?> e da plataforma <?php echo htmlspecialchars($produto['plataforma_nome'], ENT_QUOTES, 'UTF-8'); ?>.</p>
                </div>
                <div class="relacionados-controles">
                    <button type="button" class="relacionados-seta" id="relacionados-anterior" aria-label="Ver produtos anteriores"><i class="fa-solid fa-chevron-left"></i></button>
                    <button type="button" class="relacionados-seta" id="relacionados-proximo" aria-label="Ver próximos produtos"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>

            <div class="relacionados-janela">
                <div class="relacionados-lista" id="lista-relacionados">
                    <?php while ($relacionado = mysqli_fetch_assoc($produtos_relacionados)) {
                        $relacionado_em_promocao = (int)$relacionado['promocao'] === 1
                            && (float)$relacionado['desconto'] > 0
                            && (float)$relacionado['preco_promocao'] > 0
                            && (float)$relacionado['preco_promocao'] < (float)$relacionado['preco_venda'];
                        $preco_relacionado = $relacionado_em_promocao ? $relacionado['preco_promocao'] : $relacionado['preco_venda'];
                    ?>
                        <a class="card-relacionado" href="produtos.php?id=<?php echo (int)$relacionado['id_produto']; ?>">
                            <div class="card-relacionado-imagem">
                                <img src="img/jogos/<?php echo htmlspecialchars($relacionado['imagem'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($relacionado['nome'], ENT_QUOTES, 'UTF-8'); ?>">
                                <?php if ($relacionado_em_promocao) { ?><span>-<?php echo (int)$relacionado['desconto']; ?>%</span><?php } ?>
                            </div>
                            <div class="card-relacionado-info">
                                <h3><?php echo htmlspecialchars($relacionado['nome'], ENT_QUOTES, 'UTF-8'); ?></h3>
                                <small><?php echo htmlspecialchars($relacionado['plataforma_nome'], ENT_QUOTES, 'UTF-8'); ?></small>
                                <div class="card-relacionado-preco">
                                    <?php if ($relacionado_em_promocao) { ?><del>R$ <?php echo number_format($relacionado['preco_venda'], 2, ',', '.'); ?></del><?php } ?>
                                    <strong>R$ <?php echo number_format($preco_relacionado, 2, ',', '.'); ?></strong>
                                </div>
                            </div>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </section>
    <?php } ?>

    <?php include 'includes/rodape.php'; ?>


    <!-- JAVA -->

    <!-- CARROSEL DE IMAGENS -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const mainImage = document.getElementById('game-main-image');
            const thumbs = document.querySelectorAll('#carrosel-games .carrosel-thumbs .thumb');

            if (!mainImage || thumbs.length === 0) {
                return;
            }

            thumbs.forEach((thumb) => {
                thumb.addEventListener('click', () => {
                    const img = thumb.querySelector('img');
                    if (!img) return;

                    thumbs.forEach((t) => t.classList.remove('active'));
                    thumb.classList.add('active');

                    mainImage.src = img.src;
                    mainImage.alt = img.alt;
                });
            });
        });
    </script>

    <!-- VER MAIS -->

    <script>
        function toggleSobre() {
            let extra = document.querySelector(".extra");
            let btn = document.querySelector(".verMaisBtn");

            if (extra.style.display === "block") {
                extra.style.display = "none";
                btn.textContent = "Ver mais";
            } else {
                extra.style.display = "block";
                btn.textContent = "Ver menos";
            }
        }
    </script>


    <script>
        <?php if ($exibir_contador_promocao) { ?>

            const dataFim = <?= json_encode($data_fim_promocao . 'T23:59:59'); ?>;
            const contadorOferta = document.getElementById("contador-oferta");
            const timer = document.getElementById("timer");
            const fim = Date.parse(dataFim);
            let intervaloContador;

            function atualizarContador() {
                if (!Number.isFinite(fim) || !contadorOferta || !timer) {
                    contadorOferta?.remove();
                    clearInterval(intervaloContador);
                    return;
                }

                const diff = fim - Date.now();

                if (diff <= 0) {
                    contadorOferta.remove();
                    clearInterval(intervaloContador);
                    return;
                }

                const dias = Math.floor(diff / (1000 * 60 * 60 * 24));
                const horas = Math.floor((diff / (1000 * 60 * 60)) % 24);
                const minutos = Math.floor((diff / (1000 * 60)) % 60);
                const segundos = Math.floor((diff / 1000) % 60);

                timer.textContent =
                    dias + "d " +
                    String(horas).padStart(2, '0') + ":" +
                    String(minutos).padStart(2, '0') + ":" +
                    String(segundos).padStart(2, '0');
            }

            atualizarContador();
            intervaloContador = setInterval(atualizarContador, 1000);

        <?php } ?>
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const lista = document.getElementById('lista-relacionados');
            const anterior = document.getElementById('relacionados-anterior');
            const proximo = document.getElementById('relacionados-proximo');

            if (!lista || !anterior || !proximo) return;

            const mover = (direcao) => {
                const card = lista.querySelector('.card-relacionado');
                const largura = card ? card.getBoundingClientRect().width + 16 : 260;
                lista.scrollBy({ left: direcao * largura * 2, behavior: 'smooth' });
            };

            anterior.addEventListener('click', () => mover(-1));
            proximo.addEventListener('click', () => mover(1));
        });
    </script>



</body>

</html>
