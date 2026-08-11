<?php 
//retornar o caminho da url apos o nome do host
  $url_parcial = $_SERVER['REQUEST_URI'];

  //0=""
  //1="Info_52"
  //2="antedgmon"
  //3="admin"
  $caminhos = explode('/', $url_parcial);


  $url = "http://" . $_SERVER['HTTP_HOST'] . "/" .$caminhos[1] . "/" . $caminhos[2];
?>

<link rel="stylesheet" href="<?php echo $url; ?>/custom/css/admin-dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jim+Nightshade&display=swap" rel="stylesheet">

<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">


  <a class="navbar-brand col-md-3 col-lg-2 px-3" href="<?php echo $url ?>/admin/Admin.php">
    <span id="namelogo">Antedgmon</span>
  </a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="<?php echo $url?>/admin/LogOff.php">Sair</a>
    </div>
  </div>

</header>
