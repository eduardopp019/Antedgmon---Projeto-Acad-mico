<?php 

## Iniciando uma sessão
if (!isset($_SESSION)) 
{
    session_start();
}


unset($_SESSION['USER'], $_SESSION['TYPE']);

$_SESSION['LogOff'] = "Deslogado com sucesso!"; 

header("Location: Index.php");

?>