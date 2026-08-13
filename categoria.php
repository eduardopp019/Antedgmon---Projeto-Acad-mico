<?php

// Mantém URLs antigas de categoria funcionando, usando o catálogo como a
// página única dos produtos e evitando duas versões diferentes dos filtros.
$parametros = $_GET;
$destino = 'catalogo.php';

if (!empty($parametros)) {
    $destino .= '?' . http_build_query($parametros);
}

header('Location: ' . $destino);
exit;
