<?php


## conexao com o banco de dados
require_once __DIR__ . "/../conexao/conecta.php";

## Iniciando uma sessão
if (!isset($_SESSION)) {
    session_start();
}


##verificar se chegou usuario e senha para comparar as infomações do banco de dados
if (isset($_POST['usuario']) && $_POST['usuario'] != '' && isset($_POST['senha']) && $_POST['senha'] != '') {
    $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    $sql = "SELECT * FROM funcionarios WHERE usuario = '$usuario' AND senha = '$senha'";

    $query = mysqli_query($conexao, $sql);
    $funcionarios = mysqli_fetch_array($query);

    //echo $funcionarios['usuario'];

    if (isset($funcionarios)) 
    {
        $_SESSION['ID'] = $funcionarios['id_funcionario'];
        $_SESSION['USER'] = $funcionarios['usuario'];
        $_SESSION['TYPE'] = $funcionarios['tipo_acesso'];
        $_SESSION['NAME'] = $funcionarios['nome'];

        header("Location: Admin.php");
        exit;
    } 
    else 
    {
        $_SESSION['loginERRO'] =  "Usuário ou senha inválidos";

        header("Location: Index.php");
        exit;
    }

} 
else 
{
    $_SESSION['loginVazio'] =  "Informe um usuário e senha";

    header("Location: Index.php");
    exit;
}
