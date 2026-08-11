<?php

# Conexão com banco de dados #
require_once __DIR__ . "/../../conexao/conecta.php";

# Iniciando uma sessão #
if (!isset($_SESSION)) {

    session_start();
}
################## Cadastrando novos funcionarios #################################
if (isset($_POST['cadastrar']) && $_POST['cadastrar'] == 'cadastrar_funcionario') {

    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $id_cargo = mysqli_real_escape_string($conexao, $_POST['cargo']);
    $nome_social = mysqli_real_escape_string($conexao, $_POST['social']);
    $data_nascimento = mysqli_real_escape_string($conexao, $_POST['datanascimento']);
    $sexo = mysqli_real_escape_string($conexao, $_POST['sexo']);
    $estado_civil = mysqli_real_escape_string($conexao, $_POST['estado-civil']);
    $cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
    $rg = mysqli_real_escape_string($conexao, $_POST['rg']);
    $endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);
    $complemento = mysqli_real_escape_string($conexao, $_POST['complemento']);
    $bairro = mysqli_real_escape_string($conexao, $_POST['bairro']);
    $cidade = mysqli_real_escape_string($conexao, $_POST['cidade']);
    $estado = mysqli_real_escape_string($conexao, $_POST['uf']);
    $cep = mysqli_real_escape_string($conexao, $_POST['cep']);
    $telefone_residencial = mysqli_real_escape_string($conexao, $_POST['telefone']);
    $telefone_celular = mysqli_real_escape_string($conexao, $_POST['telefone-c']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    // $status = mysqli_real_escape_string($conexao, $_POST['status']);
    // $data_cadastro = mysqli_real_escape_string($conexao, $_POST['data_cadastro']);
    $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);
    $tipo_acesso = mysqli_real_escape_string($conexao, $_POST['tipo-acesso']);
    // $foto = mysqli_real_escape_string($conexao, $_POST['foto']);
    $id_funcionario = mysqli_real_escape_string($conexao, $_POST['id_funcionario']);
    $salario = str_replace('.', '', $_POST['salario']);   // remove milhar
    $salario = str_replace(',', '.', $salario);           // troca decimal
    $salario = floatval($salario);
    $numero = mysqli_real_escape_string($conexao, $_POST['numero']);



    // enviando foto para o servidor
    # salvando nome do arquivo #
    $foto = basename($_FILES['foto']['name']);

    # salvando um caminho tmeporario na pasta 'TMP' #
    $tmp = $_FILES['foto']['tmp_name'];
    # criando o caminho para pasta final #
    $final = "../../images/" . $foto;
    # movendo a imagem da pasta tmp para a pasta images #
    move_uploaded_file($tmp, $final);


    // INSERT

    $sql = "INSERT INTO funcionarios VALUES (0, $id_cargo ,'$nome', '$nome_social', '$data_nascimento', '$sexo', '$estado_civil', '$cpf', '$rg', '$salario', '$endereco', '$numero', '$complemento', '$bairro', '$cidade', '$estado', '$cep', '$telefone_residencial', '$telefone_celular', '$email', 1, NOW(), '$usuario', '$senha', $tipo_acesso, '$foto')";

    if (mysqli_query($conexao, $sql)) {

        header('Location: index.php');
    } else {

        die('ERRO: ' . $sql . '<br>' . mysqli_error($conexao));
    }
}


################## Atualizar novos funcionarios #################################
if (isset($_POST['editar']) && $_POST['editar'] == 'editar_funcionario') {

    $id_funcionario = mysqli_real_escape_string($conexao, $_POST['id_funcionario']);
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $id_cargo = mysqli_real_escape_string($conexao, $_POST['cargo']);
    $nome_social = mysqli_real_escape_string($conexao, $_POST['social']);
    $data_nascimento = mysqli_real_escape_string($conexao, $_POST['datanascimento']);
    $sexo = mysqli_real_escape_string($conexao, $_POST['sexo']);
    $estado_civil = mysqli_real_escape_string($conexao, $_POST['estado-civil']);
    $cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
    $rg = mysqli_real_escape_string($conexao, $_POST['rg']);
    $endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);
    $complemento = mysqli_real_escape_string($conexao, $_POST['complemento']);
    $bairro = mysqli_real_escape_string($conexao, $_POST['bairro']);
    $cidade = mysqli_real_escape_string($conexao, $_POST['cidade']);
    $estado = mysqli_real_escape_string($conexao, $_POST['uf']);
    $cep = mysqli_real_escape_string($conexao, $_POST['cep']);
    $telefone = mysqli_real_escape_string($conexao, $_POST['telefone']);
    $telefone_c = mysqli_real_escape_string($conexao, $_POST['telefone_c']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $status = mysqli_real_escape_string($conexao, $_POST['status']);
    // $data_cadastro = mysqli_real_escape_string($conexao, $_POST['data_cadastro']);
    $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);
    $tipo_acesso = mysqli_real_escape_string($conexao, $_POST['tipo-acesso']);
    // $foto = mysqli_real_escape_string($conexao, $_POST['foto']);
    $salario = str_replace('.', '', $_POST['salario']);   // remove milhar
    $numero = mysqli_real_escape_string($conexao, $_POST['numero']);

    // enviando foto para o servidor
    # salvando nome do arquivo #
    $foto = basename($_FILES['foto']['name']);

    # salvando um caminho tmeporario na pasta 'TMP' #
    $tmp = $_FILES['foto']['tmp_name'];
    # criando o caminho para pasta final #
    $final = "../../images/" . $foto;
    # movendo a imagem da pasta tmp para a pasta images #
    move_uploaded_file($tmp, $final);




    // INSERT

    $sql = "UPDATE funcionarios SET id_cargo = $id_cargo, nome = '$nome', nome_social = '$nome_social', data_nascimento = '$data_nascimento', sexo = '$sexo', estado_civil = '$estado_civil', cpf = '$cpf', rg = '$rg', salario = '$salario', endereco = '$endereco', numero = '$numero', complemento = '$complemento', bairro = '$bairro', cidade = '$cidade', estado = '$estado', cep = '$cep', telefone_residencial = '$telefone', telefone_celular = '$telefone_c', email = '$email', status = $status, usuario = '$usuario', senha = '$senha', tipo_acesso = $tipo_acesso";


    if (!empty($foto)) {
        $sql .= ", foto = '$foto'";
    }

    //complementando update cp, a clausa where
    $sql .= " WHERE id_funcionario = $id_funcionario";


    try {
        if (mysqli_query($conexao, $sql)) {

            //header('Location: index.php');
            $_SESSION['msg'] = "Funcionário atualizado com sucesso!";
        } else {

            //die('ERRO: ' . $sql . '<br>' . mysqli_error($conexao));
            $_SESSION['msg'] = "Erro ao atualizar funcionário: ";
        }
    } catch (mysqli_sql_exception) {
        $_SESSION['msg'] = "Erro ao atualizar";
    }
    header('Location: index.php');
}


################## Deletar funcionarios #################################
if (isset($_POST['deletar_funcionario'])) {

    $id = $_POST['deletar_funcionario'];

    $sql = "DELETE FROM funcionarios WHERE id_funcionario = $id";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['mensagem'] = "Funcionário excluído com sucesso!";
        header('Location: index.php');
    } else {

        $_SESSION['mensagem'] = "Erro ao excluir funcionário!";
        header('Location: index.php');
    }
}
