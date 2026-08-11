<?php

# Conexão com banco de dados #
require_once __DIR__ . "/../../conexao/conecta.php";


# Iniciando uma sessão #
if (!isset($_SESSION)) {

    session_start();
}
################## Cadastrando novos clientes #################################
if (isset($_POST['cadastrar']) && $_POST['cadastrar'] == 'cadastrar_cliente') {

    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $id_cliente = mysqli_real_escape_string($conexao, $_POST['id_cliente']);
    $data_nascimento = mysqli_real_escape_string($conexao, $_POST['datanascimento']);
    $sexo = mysqli_real_escape_string($conexao, $_POST['sexo']);
    $cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
    $rg = mysqli_real_escape_string($conexao, $_POST['rg']);
    $endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);
    $complemento = mysqli_real_escape_string($conexao, $_POST['complemento']);
    $bairro = mysqli_real_escape_string($conexao, $_POST['bairro']);
    $cidade = mysqli_real_escape_string($conexao, $_POST['cidade']);
    $estado = mysqli_real_escape_string($conexao, $_POST['uf']);
    $cep = mysqli_real_escape_string($conexao, $_POST['cep']);

    $telefone = mysqli_real_escape_string($conexao, $_POST['telefone']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    // $status = mysqli_real_escape_string($conexao, $_POST['status']);
    // $data_cadastro = mysqli_real_escape_string($conexao, $_POST['data_cadastro']);
    $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    // $foto = mysqli_real_escape_string($conexao, $_POST['foto']);


    $numero = mysqli_real_escape_string($conexao, $_POST['numero']);


    // INSERT

    $sql = "INSERT INTO clientes VALUES (0, '$nome', '$email', '$senha', NOW(), '$usuario', '$rg','$data_nascimento',  '$telefone', '$cpf', 1, '$endereco', '$cidade', '$bairro', '$sexo', '$numero', '$complemento', '$cep', '$estado')";

    if (mysqli_query($conexao, $sql)) {

        header('Location: index.php');
    } else {

        die('ERRO: ' . $sql . '<br>' . mysqli_error($conexao));
    }
}

################## Atualizando clientes #################################
if (isset($_POST['editar']) && $_POST['editar'] == 'editar_cliente') {

    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $id_cliente = mysqli_real_escape_string($conexao, $_POST['id_cliente']);
    $data_nascimento = mysqli_real_escape_string($conexao, $_POST['datanascimento']);
    $sexo = mysqli_real_escape_string($conexao, $_POST['sexo']);
    $cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
    $rg = mysqli_real_escape_string($conexao, $_POST['rg']);
    $endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);
    $complemento = mysqli_real_escape_string($conexao, $_POST['complemento']);
    $bairro = mysqli_real_escape_string($conexao, $_POST['bairro']);
    $cidade = mysqli_real_escape_string($conexao, $_POST['cidade']);
    $estado = mysqli_real_escape_string($conexao, $_POST['uf']);
    $cep = mysqli_real_escape_string($conexao, $_POST['cep']);

    $telefone = mysqli_real_escape_string($conexao, $_POST['telefone']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $status = mysqli_real_escape_string($conexao, $_POST['status']);
    // $data_cadastro = mysqli_real_escape_string($conexao, $_POST['data_cadastro']);
    $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    // $foto = mysqli_real_escape_string($conexao, $_POST['foto']);


    $numero = mysqli_real_escape_string($conexao, $_POST['numero']);


    // INSERT

    $sql = "UPDATE clientes SET id_cliente='$id_cliente', nome='$nome', email='$email', senha='$senha', usuario='$usuario', rg='$rg', data_nascimento='$data_nascimento', telefone='$telefone', cpf='$cpf', status = $status, endereco='$endereco', cidade='$cidade', bairro='$bairro', sexo='$sexo', numero='$numero', complemento='$complemento' WHERE id_cliente= $id_cliente";

    if (mysqli_query($conexao, $sql)) {

        header('Location: index.php');
    } else {

        die('ERRO: ' . $sql . '<br>' . mysqli_error($conexao));
    }
}

################## Deletar clientes #################################
if (isset($_POST['deletar_cliente'])) {

    $id = $_POST['deletar_cliente'];

    $sql = "DELETE FROM clientes WHERE id_cliente = $id";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['mensagem'] = "Cliente excluído com sucesso!";
        header('Location: index.php');
    } else {

        $_SESSION['mensagem'] = "Erro ao excluir cliente!";
        header('Location: index.php');
    }
}
