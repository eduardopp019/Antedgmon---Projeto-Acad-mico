<?php 

## Iniciando uma sessão
if (!isset($_SESSION)) {
    session_start();
}

##verificando se o usuario logado e administrador para permitir acesso ao painel administrativo
if ($_SESSION['TYPE'] != '0') 
{
    $_SESSION['naoADM'] = "Apenas administradores podem acessar esta área!";
    header("Location: ../Admin.php");
} 

?>