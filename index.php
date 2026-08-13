<?php

require_once __DIR__ . "/conexao/conecta.php";


$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql = "SELECT * FROM produtos WHERE id_produto = $id";

$result = mysqli_query($conexao, $sql);

$produto = mysqli_fetch_assoc($result);

// transforma em array
$produto = mysqli_fetch_assoc($result);


?>

<!DOCTYPE html>
<html lang="pt-br">

<?php include 'includes/head.php'; ?>
<!-- css -->
<link rel="stylesheet" href="custom/css/index.css">

<body>

    <?php include 'includes/header.php'; ?>



    <!-- INICIO Carrosel -->

    <?php
    $sql_carrosel = "SELECT produtos.*, plataforma.nome AS nome_pla FROM produtos INNER JOIN plataforma ON produtos.id_plataforma = plataforma.id_plataforma WHERE produtos.id_produto IN (11, 15, 19) ORDER BY RAND();";
    $result_carrosel = mysqli_query($conexao, $sql_carrosel);
    ?>

    <section id="carrosel">

        <div id="carouselExampleCaptions" class="carousel slide carousel-fade">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">

                <?php
                $first = true;
                while ($produto = mysqli_fetch_assoc($result_carrosel)) {
                ?>

                    <div class="carousel-item <?php echo $first ? 'active' : ''; ?>">

                        <a href="produtos.php?id=<?php echo $produto['id_produto']; ?>" class="banner-link">

                            <div class="position">

                                <img src="img/jogos/<?php echo $produto['imagem']; ?>" class="d-block w-100">

                            </div>

                            <div class="carousel-caption">

                                <h5><?php echo $produto['nome']; ?></h5>
                                <h6>Promoção Imperdivel, garanta já</h6>

                                <div class="price-area">

                                    <?php if ((int)$produto['promocao'] === 1 && (float)$produto['desconto'] > 0 && (float)$produto['preco_promocao'] > 0 && (float)$produto['preco_promocao'] < (float)$produto['preco_venda']) { ?>
                                        <span class="badge-desconto">
                                            -<?php echo (int)$produto['desconto']; ?>%
                                        </span>
                                    <?php } ?>

                                    <div class="price-info">

                                        <?php if ((int)$produto['promocao'] === 1 && (float)$produto['desconto'] > 0 && (float)$produto['preco_promocao'] > 0 && (float)$produto['preco_promocao'] < (float)$produto['preco_venda']) { ?>
                                            <small class="preco-antigo">
                                                R$ <?php echo number_format($produto['preco_venda'], 2, ',', '.'); ?>
                                            </small>
                                        <?php } ?>

                                        <span class="preco-atual">
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


                            </div>
                        </a>
                    </div>

                <?php
                    $first = false;
                }
                ?>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <!-- SETA ESQUERDA -->
                    <i class="fa-solid fa-circle-chevron-left c-gradient"></i>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <!-- SETA DIREITA -->
                    <i class="fa-solid fa-circle-chevron-right c-gradient"></i>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>


    </section>
    <!-- FIM CARROSEL -->

    <?php
    $sql_categoria = "SELECT * FROM categorias LIMIT 9";
    $result_categoria = mysqli_query($conexao, $sql_categoria);
    ?>

    <!-- Inicio categoria -->

    <section id="categoria">

        <div class="container">

            <div class="categorias">

                <?php while ($categoria = mysqli_fetch_assoc($result_categoria)) { ?>

                    <?php
                    $icone = "fa-gamepad";

                    switch ($categoria['nome']) {
                        case 'Fantasia':
                            $icone = 'fa-dragon';
                            break;
                        case 'Aventura':
                            $icone = 'fa-map';
                            break;
                        case 'RPG':
                            $icone = 'fa-hat-wizard';
                            break;
                        case 'Corrida':
                            $icone = 'fa-car';
                            break;
                        case 'Soulslike':
                            $icone = 'fa-skull';
                            break;
                        case 'Terror':
                            $icone = 'fa-ghost';
                            break;
                        case 'Tiro':
                            $icone = 'fa-crosshairs';
                            break;
                        case 'Luta':
                            $icone = 'fa-hand-fist';
                            break;

                        case 'Sobrevivência':
                            $icone = 'fa-heartbeat';
                            break;
                    }
                    ?>

                    <a href="catalogo.php?categoria=<?php echo $categoria['id_categoria']; ?>" class="categoria-item">
                        <i class="fa-solid <?php echo $icone; ?>"></i>
                        <span><?php echo $categoria['nome']; ?></span>
                    </a>

                <?php } ?>

            </div>

        </div>

    </section>

    <!-- fim catergoria -->
    <!-- inicio cards -->


    <!-- SONY -->
    <section id="cardsony">
        <div class="container">


            <div class="area">
                <!-- plataforma/slogan -->
                <div class="d-flex align-items-center gap-2">

                    <h2>Playstation<i class="fa-brands fa-playstation fs-3"></i></h2>


                </div>

                <p>Entre em mundos épicos com a força PlayStation.</p>

            </div>



            <?php
            $sql = "SELECT produtos.*, plataforma.nome AS nome_pla FROM produtos INNER JOIN plataforma  ON produtos.id_plataforma = plataforma.id_plataforma WHERE produtos.id_plataforma IN (4, 5, 6, 7)LIMIT 4;";
            $result = mysqli_query($conexao, $sql);
            ?>

            <div class="games">
                <?php while ($produto = mysqli_fetch_assoc($result)) { ?>
                    <!-- 1 -->
                    <div class="card h-100">
                        <div class="position-relative">

                            <img src="img/jogos/<?php echo $produto['imagem']; ?>" class="card-img-top">

                            <button class="btn-favorito" data-id="<?php echo $produto['id_produto']; ?>">
                                <i class="fa-regular fa-heart"></i>
                            </button>

                        </div>

                        <!-- img -->

                        <!-- text -->
                        <div class="card-body">
                            <h5 class="card-title fs-4"><?php echo $produto['nome']; ?></h5>

                            <div class=" d-flex gap-1 fs-4 mb-3">

                                <p class="card-text"><?php echo $produto['nome_pla']; ?></p>

                            </div>

                            <div class="mt-auto d-flex justify-content-between align-items-center">

                                <div class="d-flex align-items-center gap-2">

                                    <?php if ((int)$produto['promocao'] === 1 && (float)$produto['desconto'] > 0 && (float)$produto['preco_promocao'] > 0 && (float)$produto['preco_promocao'] < (float)$produto['preco_venda']) { ?>
                                        <span class="badge-desconto-card-sony">
                                            -<?php echo (int)$produto['desconto']; ?>%
                                        </span>
                                    <?php } ?>

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

                                <!-- Comprar -->
                                <a href="produtos.php?id=<?php echo $produto['id_produto']; ?>" class="btn btn-sm badge-desconto-card-sony">
                                    <i class="fa-solid fa-cart-arrow-down"></i> Comprar
                                </a>

                            </div>

                        </div>

                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- XBOX -->
        <section id="cardxbox">
            <div class="container">


                <div class="area">
                    <!-- plataforma/slogan -->
                    <div class="d-flex align-items-center gap-2">

                        <h2 class="bg-success border border-success">Xbox<i class="fa-brands fa-xbox fs-3"></i></h2>


                    </div>

                    <p>Seu universo gamer começa aqui, no poder do Xbox.</p>

                </div>

                <?php
                $sql = "SELECT produtos.*, plataforma.nome AS nome_pla FROM produtos INNER JOIN plataforma  ON produtos.id_plataforma = plataforma.id_plataforma WHERE produtos.id_plataforma IN (1,17,19) ORDER BY RAND() LIMIT 4;";
                $result = mysqli_query($conexao, $sql);
                ?>
                <div class="games">
                    <?php while ($produto = mysqli_fetch_assoc($result)) { ?>
                        <div class="card h-100">
                            <div class="position-relative">

                                <img src="img/jogos/<?php echo $produto['imagem']; ?>" class="card-img-top">

                                <button class="btn-favorito" data-id="<?php echo $produto['id_produto']; ?>">
                                    <i class="fa-regular fa-heart"></i>
                                </button>

                            </div>
                            <!-- text -->
                            <div class="card-body">
                                <h5 class="card-title fs-4"><?php echo $produto['nome']; ?></h5>
                                <div class="d-flex gap-1 fs-4 mb-3">

                                    <p class="card-text"><?php echo $produto['nome_pla']; ?></p>

                                </div>
                                <div class="mt-auto d-flex justify-content-between align-items-center">

                                    <div class="d-flex align-items-center gap-2">

                                        <?php if ((int)$produto['promocao'] === 1 && (float)$produto['desconto'] > 0 && (float)$produto['preco_promocao'] > 0 && (float)$produto['preco_promocao'] < (float)$produto['preco_venda']) { ?>
                                            <span class="badge-desconto-card-xbox">
                                                -<?php echo (int)$produto['desconto']; ?>%
                                            </span>
                                        <?php } ?>

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

                                    <!-- Comprar -->
                                    <a href="produtos.php?id=<?php echo $produto['id_produto']; ?>" class="btn btn-sm badge-desconto-card-xbox">
                                        <i class="fa-solid fa-cart-arrow-down"></i> Comprar
                                    </a>

                                </div>



                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>



        </section>
        <!-- NINTENDo -->
        <section id="cardnintendo">
            <div class="container">


                <div class="area">
                    <!-- plataforma/slogan -->
                    <div class="d-flex align-items-center gap-2">

                        <h2 class="bg-danger border border-danger">Nintendo<i class="bi bi-nintendo-switch fs-3">
                                <path
                                    d="M9.34 8.005c0-4.38.01-7.972.023-7.982C9.373.01 10.036 0 10.831 0c1.153 0 1.51.01 1.743.05 1.73.298 3.045 1.6 3.373 3.326.046.242.053.809.053 4.61 0 4.06.005 4.537-.123 4.976-.022.076-.048.15-.08.242a4.14 4.14 0 0 1-3.426 2.767c-.317.033-2.889.046-2.978.013-.05-.02-.053-.752-.053-7.979m4.675.269a1.62 1.62 0 0 0-1.113-1.034 1.61 1.61 0 0 0-1.938 1.073 1.9 1.9 0 0 0-.014.935 1.63 1.63 0 0 0 1.952 1.107c.51-.136.908-.504 1.11-1.028.11-.285.113-.742.003-1.053M3.71 3.317c-.208.04-.526.199-.695.348-.348.301-.52.729-.494 1.232.013.262.03.332.136.544.155.321.39.556.712.715.222.11.278.123.567.133.261.01.354 0 .53-.06.719-.242 1.153-.94 1.03-1.656-.142-.852-.95-1.422-1.786-1.256" />
                                <path
                                    d="M3.425.053a4.14 4.14 0 0 0-3.28 3.015C0 3.628-.01 3.956.005 8.3c.01 3.99.014 4.082.08 4.39.368 1.66 1.548 2.844 3.224 3.235.22.05.497.06 2.29.07 1.856.012 2.048.009 2.097-.04.05-.05.053-.69.053-7.94 0-5.374-.01-7.906-.033-7.952-.033-.06-.09-.063-2.03-.06-1.578.004-2.052.014-2.26.05Zm3 14.665-1.35-.016c-1.242-.013-1.375-.02-1.623-.083a2.81 2.81 0 0 1-2.08-2.167c-.074-.335-.074-8.579-.004-8.907a2.85 2.85 0 0 1 1.716-2.05c.438-.176.64-.196 2.058-.2l1.282-.003v13.426Z" />
                                </svg>
                            </i></h2>


                    </div>

                    <p>Nintendo: mundos mágicos esperando por você explorar.</p>

                </div>
                <?php
                $sql = "SELECT produtos.*, plataforma.nome AS nome_pla FROM produtos INNER JOIN plataforma  ON produtos.id_plataforma = plataforma.id_plataforma WHERE produtos.id_plataforma IN (2,8,9,10) ORDER BY RAND() LIMIT 4;";
                $result = mysqli_query($conexao, $sql);
                ?>
                <div class="games">
                    <?php while ($produto = mysqli_fetch_assoc($result)) { ?>
                        <!-- 1 -->
                        <div class="card h-100">

                            <div class="position-relative">

                                <img src="img/jogos/<?php echo $produto['imagem']; ?>" class="card-img-top">

                                <button class="btn-favorito" data-id="<?php echo $produto['id_produto']; ?>">
                                    <i class="fa-regular fa-heart"></i>
                                </button>

                            </div>
                            <!-- text -->
                            <div class="card-body">
                                <h5 class="card-title fs-4"><?php echo $produto['nome']; ?></h5>
                                <div class="d-flex gap-1 fs-4 mb-3">

                                    <p class="card-text"><?php echo $produto['nome_pla']; ?></p>

                                </div>
                                <div class="mt-auto d-flex justify-content-between align-items-center">

                                    <div class="d-flex align-items-center gap-2">

                                        <?php if ((int)$produto['promocao'] === 1 && (float)$produto['desconto'] > 0 && (float)$produto['preco_promocao'] > 0 && (float)$produto['preco_promocao'] < (float)$produto['preco_venda']) { ?>
                                            <span class="badge-desconto-card-nintendo">
                                                -<?php echo (int)$produto['desconto']; ?>%
                                            </span>
                                        <?php } ?>

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

                                    <!-- Comprar -->
                                    <a href="produtos.php?id=<?php echo $produto['id_produto']; ?>" class="btn btn-sm badge-desconto-card-nintendo">
                                        <i class="fa-solid fa-cart-arrow-down"></i> Comprar
                                    </a>

                                </div>


                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>



        </section>



    </section>

    <!-- fim cards -->

    <!-- CUPOM -->
    <!-- CUPONS -->
    <section id="cupom" class="py-5">

        <div class="container">

            <div id="carouselCupom"
                class="carousel slide"
                data-bs-ride="carousel"
                data-bs-interval="4000">

                <!-- Indicadores -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselCupom" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#carouselCupom" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#carouselCupom" data-bs-slide-to="2"></button>
                    <button type="button" data-bs-target="#carouselCupom" data-bs-slide-to="3"></button>
                </div>

                <div class="carousel-inner">

                    <div class="carousel-item active">
                        <img src="img/Cupom/cupomdark.png" class="d-block w-100" alt="">
                    </div>

                    <div class="carousel-item">
                        <img src="img/Cupom/@edupereira019.png" class="d-block w-100" alt="">
                    </div>

                    <div class="carousel-item">
                        <img src="img/Cupom/blue.png" class="d-block w-100" alt="">
                    </div>

                    <div class="carousel-item">
                        <img src="img/Cupom/biketech.png" class="d-block w-100" alt="">
                    </div>

                </div>

                <button class="carousel-control-prev"
                    type="button"
                    data-bs-target="#carouselCupom"
                    data-bs-slide="prev">

                    <i class="fa-solid fa-circle-chevron-left"></i>

                </button>

                <button class="carousel-control-next"
                    type="button"
                    data-bs-target="#carouselCupom"
                    data-bs-slide="next">

                    <i class="fa-solid fa-circle-chevron-right"></i>

                </button>

            </div>

        </div>

    </section>

    <!-- fim cCupom -->


    <?php include 'includes/rodape.php'; ?>


    <!-- JAVA -->

    <script>
        document.querySelectorAll(".btn-favorito").forEach(btn => {

            btn.addEventListener("click", function(e) {

                e.preventDefault();

                this.classList.toggle("ativo");

                const icon = this.querySelector("i");

                if (this.classList.contains("ativo")) {
                    icon.classList.remove("fa-regular");
                    icon.classList.add("fa-solid");
                } else {
                    icon.classList.remove("fa-solid");
                    icon.classList.add("fa-regular");
                }

            });

        });
    </script>

</body>

</html>
