<?php

require_once __DIR__ . "/conexao/conecta.php";


$sql = "SELECT * FROM produtos LIMIT 4";
$result = mysqli_query($conexao, $sql);
// transforma em array
$produto = mysqli_fetch_assoc($result);

$sql_count = "SELECT COUNT(*) AS quantidade FROM produto";
$result_count = mysqli_query($conexao, $sql_count);
$linha = mysqli_fetch_assoc($result_count);
$quantidade = $linha['quantidade'];

if (isset($_GET['pagina']) && !empty($_GET['pagina'])) {

    $paginaAtual = $_GET['pagina'];

} else {

    $paginaAtual = 1;
}

$url = "?pagina=";

//quantidade de produtos por pagina
$paginaQuantidade = 3;

//valor inicial para a clausa limit
$valorInicial = ($paginaAtual * $paginaQuantidade) - $paginaQuantidade;

$paginaFinal = ceil($quantidade / $paginaQuantidade);

$paginaInicial = 1;
$paginaProxima = $paginaAtual + 1;
$paginaAnterior = $paginaAtual - 1;


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Antedgmon-Produto</title>

    <meta name="author" content="Eduardo Pereira">

    <!-- FontAwesome (icones) -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- icones bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.s">

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- css -->
    <link rel="stylesheet" href="custom/css/produtos.css">



</head>

<body>

    <!-- INICIO TOPO -->
    <header id="TOPO">

        <nav class="navbar">
            <div class="container-fluid">
                <!-- menu hamburguer -->
                <div class="menuburger c-gradient d-flex justify-content-between ">
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i
                            class="fa-solid fa-bars"></i></button>
                    <!-- logo -->
                    <div class="logo">

                        <a href="index.php">

                            <i class="fa-brands fa-gg"></i>

                        </a>
                        <a href="index.php" class="navbar-brand">Antedgmon</a>

                    </div>
                </div>

                <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
                    id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title display-5" id="offcanvasScrollingLabel">
                            <div id="icon-menuburger">
                                <a href="index.php"><img src="img/Logo PI.png" alt=""></a>
                            </div>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav">
                            <ul class="part1">
                                <li class="nav-item">
                                    <a class="nav-link active text-white" aria-current="page" href="index.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="catalogo.php">Catálogo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Ofertas</a>
                                </li>
                            </ul>
                            <ul class="part2">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Gift Cards</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">PC</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Playstation</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Nintendo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Xbox</a>
                                </li>
                            </ul>

                        </ul>
                    </div>
                </div>

                <!-- Pesquisa -->
                <div class="d-flex alin-i ">

                    <form class="d-flex" role="search">
                        <input class="form-control me-1" type="search" placeholder="Pesquisar" aria-label="Search" />

                        <button class="btn  " type="submit">
                            <i class="fa-solid c-gradient fa-magnifying-glass"></i>
                        </button>
                    </form>

                </div>
                <!-- Login -->
                <div class="butao c-gradient">

                    <button type="button" class="btn btn-lg display-2 fw-bold">Login</button>

                </div>

            </div>

        </nav>

    </header>
    <!-- FIM TOPO -->
    <!-- INICIO GAMES -->

    <section class="name">

        <div class="game-header">
            <div class="game-logo">
                <img src="img/Jogos/ElderRIng.jpg" alt="Game Logo">
            </div>
            <div class="game-info">
                <h2 class="game-title c-gradient">Elden Ring</h2>
                <div class="d-flex gap-1 fs-4">
                    <p class="card-text">Windows</p>
                </div>
            </div>
        </div>

    </section>
    <section id="produtos" class="produtos-grid">
        <div class="d-flex">
            <!-- CARROSEL -->
            <section class="carrosel-imagem">

                <div id="carrossel-principal" class="text-center mb-4">
                    <img id="game-main-image" src="img/Jogos/ElderRIng.jpg" alt="Elden Ring screenshot"
                        style="max-width: 905px; height: auto; border-radius: 10px;" />
                </div>

                <section id="carrosel-games">
                    <div class="carrosel-thumbs">
                        <div class="thumb active"><img src="img/Jogos/ElderRIng.jpg" alt="Elden Ring screenshot"></div>
                        <div class="thumb"><img src="img/Jogos/ElderRIng/2.png" alt="Elden Ring screenshot"></div>
                        <div class="thumb"><img src="img/Jogos/ElderRIng/3.png" alt="Elden Ring screenshot"></div>
                        <div class="thumb"><img src="img/Jogos/ElderRIng/4.png" alt="Elden Ring screenshot"></div>
                    </div>
                </section>
                <!-- descricao -->
                <div id="Desc" class="desc-box">
                    <div class="desc-card">
                        <div class="desc-tag">-38%</div>
                        <div class="desc-prices">
                            <span class="desc-original">R$274,50</span>
                            <span class="desc-sale">R$169,49</span>
                        </div>
                        <div class="desc-timer">Oferta acaba em: <strong>01d 17:48:24</strong></div>
                        <p class="desc-note">Promoção sujeita à disponibilidade de estoque.</p>
                        <div class="desc-store">
                            <span>Steam</span>
                            <small>Windows</small>
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


        <!-- DETALHES e REQUISITOS -->


        <div class="game-details">
            <!-- AREA1 DETALHES -->
            <div id="area1">
                <p><strong>Lançamento:</strong> 24/02/2022</p>
                <p><strong>Desenvolvedor:</strong> FromSoftware, Inc</p>
                <p><strong>Distribuidor:</strong> Bandai Namco Entertainment</p>

                <h3>Categoria/Gênero</h3>
                <div class="tags">
                    <a href="catalogo.php">
                        <div>Ação</div>
                    </a>
                    <a href="catalogo.php">
                        <div>Fantasia</div>
                    </a>
                    <a href="catalogo.php">
                        <div>RPG</div>
                    </a>
                    <a href="catalogo.php">
                        <div>Soulslike</div>
                    </a>
                </div>

                <h3>Modo de Jogo</h3>
                <div class="tags">
                    <a href="catalogo.php">
                        <div>Cooperativo online</div>
                    </a>
                    <a href="catalogo.php">
                        <div>PVP</div>
                    </a>
                    <a href="catalogo.php">
                        <div>Um jogador</div>
                    </a>

                </div>

                <h3>Idioma</h3>

                <ul class="idiomas">
                    <li>Alemão <div class="check">✔</div>
                    </li>
                    <li>Inglês <div class="check">✔</div>
                    </li>
                    <li>Espanhol <div class="check">✔</div>
                    </li>
                    <li>Francês <div class="check">✔</div>
                    </li>
                    <li>Italiano <div class="check">✔</div>
                    </li>
                    <li>Japonês <div class="check">✔</div>
                    </li>
                    <li>Coreano <div class="check">✔</div>
                    </li>
                    <li>Polonês <div class="check">✔</div>
                    </li>
                    <li>Português (Brasil) <div class="check">✔</div>
                    </li>
                    <li>Russo <div class="check">✔</div>
                    </li>
                    <li>Tailandês <div class="check">✔</div>
                    </li>
                    <li>Chinês simplificado <div class="check">✔</div>
                    </li>
                    <li>Chinês tradicional <div class="check">✔</div>
                    </li>
                </ul>

                <div class="classificacao">
                    <div class="icon">16</div>
                    <div class="classificacao-text">
                        <strong>Classificação Indicativa</strong><br>
                        Não recomendado para menores de 16 anos<br>
                        Compras on-line, Violência
                    </div>
                </div>
            </div>
        </div>
        <!-- AREA2 REQUISITOS -->
        <div class="game-details">

            <div id="area2">
                <div id="area3">
                    <h3 class="fs-4">Sobre o jogo</h3><br>
                    <p>Levante-se, Maculado, e seja guiado pela graça para portar o poder do Anel Prístino e se
                        tornar
                        um Lorde Prístino nas Terras Intermédias.
                    </p>

                    <p class="sobre-texto extra">
                        <strong>Destaques</strong>
                        Um mundo vasto e emocionante - Um mundo vasto onde campos abertos e uma variedade de situações e
                        masmorras imensas, com complexos designs tridimensionais se conectam com fluidez. Conforme
                        explora, sinta a alegria de descobrir poderosas e desconhecidas ameaças que aguardam por você,
                        levando a um grande senso de conquista.
                    </p>

                    <button class="verMaisBtn" onclick="toggleSobre()">Ver mais</button>

                </div>
                <br>
            </div>
            <h3 class="fs-4">Requisitos do Sistema</h3><br>
            <p><strong>Mínimos:</strong></p>
            <ul>
                <li><strong>SO:</strong> <span class="valor">Windows 10 64-bit</span></li>
                <li><strong>Armazenamento:</strong> <span class="valor">60 GB de espaço livre</span></li>
                <li><strong>Processador:</strong> <span class="valor">Intel Core i5-8400 / AMD Ryzen 3
                        3300X</span>
                </li>
                <li><strong>Memória:</strong> <span class="valor">12 GB RAM</span></li>
                <li><strong>Placa de Vídeo:</strong> <span class="valor">NVIDIA GTX 1060 3GB / AMD RX 580
                        4GB</span>
                </li>
                <li><strong>Placa de som:</strong> <span class="valor">Windows-compatible audio device</span>
                </li>
                <li><strong>DirectX:</strong> <span class="valor">12</span></li>
            </ul>
            <p><strong>Recomendados:</strong></p>
            <ul>
                <li><strong>SO:</strong> <span class="valor">Windows 10 / 11</span></li>
                <li><strong>Armazenamento:</strong> <span class="valor">60 GB</span></li>
                <li><strong>Processador:</strong> <span class="valor">Intel Core i7-8700K / AMD Ryzen 5
                        3600X</span>
                </li>
                <li><strong>Memória:</strong> <span class="valor">16 GB</span></li>
                <li><strong>Placa de Vídeo:</strong> <span class="valor">NVIDIA GEFORCE GTX 1070, 8 GB / AMD
                        Radeon
                        RX Vega 56, 8 GB</span></li>
                <li><strong>Placa de som:</strong> <span class="valor">Windows-compatible audio device</span>
                </li>
                <li><strong>DirectX:</strong> <span class="valor">12</span></li>
            </ul>
        </div>







    </section>
    <!-- FIM GAMES -->
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


</body>

</html>