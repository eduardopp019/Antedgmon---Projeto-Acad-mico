<?php


## conexao com o banco de dados
require_once __DIR__ . "/../conexao/conecta.php";

## Iniciando uma sessão
if (!isset($_SESSION)) {
    session_start();
}


##Verificando se existe usuario logafo para permitir acesso ao painel administrativo
if (!isset($_SESSION['USER'])) 
{
    $_SESSION['naoAutorizado'] = "Você não tem acesso a essa pagina!";
    header("Location: ../Index.php");
    exit;

} 



?>
