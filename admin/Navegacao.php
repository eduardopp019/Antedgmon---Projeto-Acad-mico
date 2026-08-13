<?php
// Caminho base funciona tanto no XAMPP (/info_52/antedgmon)
// quanto no dominio publico, onde o projeto esta na raiz.
$script_path = parse_url($_SERVER['SCRIPT_NAME'], PHP_URL_PATH);
$admin_pos = stripos($script_path, '/admin/');
$url = $admin_pos === false ? '' : rtrim(substr($script_path, 0, $admin_pos), '/');

$caminho_atual = rtrim(strtolower(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)), '/');
$pagina_atual = basename($caminho_atual);
$secoes_menu = ['cargos', 'funcionarios', 'categorias', 'plataformas', 'produtos', 'clientes', 'desenvolvedora'];
$secao_atual = $pagina_atual === 'admin.php'
  ? 'inicio'
  : (in_array($pagina_atual, $secoes_menu, true) ? $pagina_atual : basename(dirname($caminho_atual)));
?>

<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-3">
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span>OPÇÕES</span>
    </h6>

    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link<?= $secao_atual === 'inicio' ? ' active' : '' ?>" href="<?php echo $url ?>/admin/Admin.php">
          <i class="bi bi-house-door-fill"></i>
          Início
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link<?= $secao_atual === 'cargos' ? ' active' : '' ?>" href="<?php echo $url ?>/admin/cargos">
          <i class="bi bi-person-fill-gear"></i>
          Cargos
        </a>
      </li>
      <?php if ($_SESSION['TYPE'] == '0') { ?>
        <li class="nav-item">
          <a class="nav-link<?= $secao_atual === 'funcionarios' ? ' active' : '' ?>" href="<?php echo $url ?>/admin/funcionarios">
            <i class="bi bi-person-vcard-fill"></i>
            Funcionários
          </a>
        </li>
      <?php } ?>

      <li class="nav-item">
        <a class="nav-link<?= $secao_atual === 'categorias' ? ' active' : '' ?>" href="<?php echo $url ?>/admin/categorias">
          <i class="bi bi-stack"></i>
          Categorias
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link<?= $secao_atual === 'plataformas' ? ' active' : '' ?>" href="<?php echo $url ?>/admin/plataformas">
          <i class="bi bi-laptop"></i>
          Plataformas
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link<?= $secao_atual === 'produtos' ? ' active' : '' ?>" href="<?php echo $url ?>/admin/produtos">
          <i class="bi bi-archive-fill"></i>
          Produtos
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link<?= $secao_atual === 'clientes' ? ' active' : '' ?>" href="<?php echo $url ?>/admin/clientes">
          <i class="bi bi-people-fill"></i>
          Clientes
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link<?= $secao_atual === 'desenvolvedora' ? ' active' : '' ?>" href="<?php echo $url ?>/admin/desenvolvedora">
          <i class="bi bi-code-slash"></i>
          Desenvolvedora
        </a>
      </li>
    </ul>
  </div>
</nav>
