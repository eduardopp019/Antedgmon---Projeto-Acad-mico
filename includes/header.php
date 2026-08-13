<link rel="stylesheet" href="custom/css/menu.css">
<!-- INICIO TOPO -->
<header id="TOPO" class="sticky-top shadow-sm">
    <nav class="navbar navbar-dark">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center w-100">

                <div class="d-flex align-items-center">

                    <button class="navbar-toggler border-0 shadow-none me-2"
                        type="button"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasScrolling">

                        <i class="fa-solid fa-bars c-gradient"></i>

                    </button>

                    <a href="index.php"
                        class="navbar-brand d-flex align-items-center mb-0">

                        <i class="fa-brands fa-gg me-2 c-gradient"></i>

                        <span id="namelogo" class="fw-bold text-white">
                            Antedgmon
                        </span>

                    </a>

                </div>

                <div class="login-btn-wrapper d-none d-lg-block">

                    <a href="admin/Index.php"
                        class="btn c-gradient-bg rounded-pill px-4 fw-bold">

                        <i class="fa-solid fa-user me-2"></i>

                        Login

                    </a>

                </div>

            </div>

            <div class="w-100 mt-3">

                <form
                    action="busca.php"
                    method="GET"
                    class="search-form mx-auto">

                    <div class="input-group">

                        <input
                            class="form-control"
                            type="search"
                            name="busca"
                            placeholder="Buscar jogo ou palavra-chave">

                        <button class="btn c-gradient-bg">

                            <i class="fa-solid fa-magnifying-glass"></i>

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </nav>
</header>

<div class="offcanvas offcanvas-start bg-dark text-white" data-bs-scroll="false" data-bs-backdrop="true"
    tabindex="-1" id="offcanvasScrolling">
    <div class="offcanvas-header border-bottom border-secondary">
        <h5 class="offcanvas-title" id="offcanvasScrollingLabel">
            <i class="fa-brands fa-gg me-2 c-gradient"></i>Menu
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="navbar-nav fs-5">
            <li class="nav-item mb-2"><a href="index.php" class="nav-link text-white py-2">
                    <i class="fa-solid fa-house me-2"></i> Home
                </a></li>
            <li class="nav-item mb-2"><a href="catalogo.php" class="nav-link text-white py-2">
                    <i class="fa-solid fa-gamepad me-2"></i> Catálogo
                </a></li>
            <li class="nav-item mb-2"><a href="ofertas.php" class="nav-link text-white py-2">
                    <i class="fa-solid fa-fire me-2"></i> Ofertas
                </a></li>
            <hr class="border-secondary">

            <div class="platcat">
                <li><a href="catalogo.php?grupo_plataforma=pc" class="nav-link py-1"><i class="fa-brands fa-windows me-2"></i>PC</a></li>
                <li><a href="catalogo.php?grupo_plataforma=playstation" class="nav-link py-1"><i class="fa-brands fa-playstation me-2"></i>PlayStation</a></li>
                <li><a href="catalogo.php?grupo_plataforma=xbox" class="nav-link py-1"><i class="fa-brands fa-xbox me-2"></i>Xbox</a></li>
                <li><a href="catalogo.php?grupo_plataforma=switch" class="nav-link py-1"><i class="bi bi-nintendo-switch me-2"></i>Switch</a></li>

            </div>

            <hr class="border-secondary">

            <li class="nav-item">
                <details class="menu-filtro">
                    <summary>Plataformas <i class="fa-solid fa-chevron-down"></i></summary>
                    <ul class="list-unstyled mt-2">
                        <?php if (isset($conexao)) {
                            $menu_plataformas = mysqli_query($conexao, "SELECT id_plataforma, nome FROM plataforma WHERE status = 1 ORDER BY nome");
                            while ($menu_plataforma = mysqli_fetch_assoc($menu_plataformas)) { ?><li><a href="catalogo.php?plataforma=<?php echo (int) $menu_plataforma['id_plataforma']; ?>" class="nav-link py-1 menu-subitem"><?php echo htmlspecialchars($menu_plataforma['nome'], ENT_QUOTES, 'UTF-8'); ?></a></li><?php }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } ?>
                    </ul>
                </details>
            </li>
            <hr class="border-secondary">
            <li class="nav-item">
                <details class="menu-filtro">
                    <summary>Desenvolvedoras <i class="fa-solid fa-chevron-down"></i></summary>
                    <ul class="list-unstyled mt-2">
                        <?php if (isset($conexao)) {
                            $menu_desenvolvedoras = mysqli_query($conexao, "SELECT id_desenvolvedora, nome FROM desenvolvedora WHERE status = 1 ORDER BY nome");
                            while ($menu_desenvolvedora = mysqli_fetch_assoc($menu_desenvolvedoras)) { ?><li><a href="catalogo.php?desenvolvedora=<?php echo (int) $menu_desenvolvedora['id_desenvolvedora']; ?>" class="nav-link py-1 menu-subitem"><?php echo htmlspecialchars($menu_desenvolvedora['nome'], ENT_QUOTES, 'UTF-8'); ?></a></li><?php }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        } ?>
                    </ul>
                </details>
            </li>
            <hr class="border-secondary">
            <li class="nav-item">
                <details class="menu-filtro">
                    <summary>Categorias <i class="fa-solid fa-chevron-down"></i></summary>
                    <ul class="list-unstyled mt-2">
                        <?php if (isset($conexao)) {
                            $menu_categorias = mysqli_query($conexao, "SELECT id_categoria, nome FROM categorias WHERE status = 1 ORDER BY nome");
                            while ($menu_categoria = mysqli_fetch_assoc($menu_categorias)) { ?><li><a href="catalogo.php?categoria=<?php echo (int) $menu_categoria['id_categoria']; ?>" class="nav-link py-1 menu-subitem"><?php echo htmlspecialchars($menu_categoria['nome'], ENT_QUOTES, 'UTF-8'); ?></a></li><?php }
                                                                                                                                                                                                                                                                                                                                                                                                                                                            } ?>
                    </ul>
                </details>
            </li>

            <hr class="border-secondary">

            <li class="nav-item mt-3">
                <a href="admin/Index.php"
                    class="btn w-100 rounded-pill fw-bold c-gradient-bg text-trasparent">
                    <i class="fa-solid fa-user me-2"></i>
                    Login
                </a>
            </li>

        </ul>
    </div>
</div>
<!-- FIM TOPO -->