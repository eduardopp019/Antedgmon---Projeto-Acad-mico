<?php

// A busca usa o catálogo para disponibilizar os mesmos filtros em toda a loja.
$parametros = $_GET;
unset($parametros['pagina']);

$destino = 'catalogo.php';
if (!empty($parametros)) {
    $destino .= '?' . http_build_query($parametros);
}

header('Location: ' . $destino);
exit;
