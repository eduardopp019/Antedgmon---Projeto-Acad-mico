<?php

# Conexão com banco de dados #

require_once __DIR__ . "/../../conexao/conecta.php";

# Iniciando uma sessão #

if(!isset($_SESSION))
{

    session_start();

}

# ==================== cadstrando um novo cargo ======================= #
if (isset($_POST['cadastrar']) && $_POST['cadastrar'] == 'cadastrar_cargo') 
{
    $cargo = mysqli_real_escape_string($conexao, $_POST['cargo']);  
    $observacao = mysqli_real_escape_string($conexao, $_POST['observacao']);

    $sql = "INSERT INTO cargo VALUES (0, '$cargo', 1, NOW(), '$observacao')";

    try
    {

        if (mysqli_query($conexao, $sql))
        {

            // header('Location: index.php');
            
            $_SESSION['mensagem'] = "Cargo cadastrado com sucesso!";


        }
        else
        {

            // die('Erro: ' . $sql . "<br>" . mysqli_error($conexao));

            $_SESSION['mensagem'] = 'Erro ao cadastrar!';
        }

    }
    catch(mysqli_sql_exception)
    {

        $_SESSION['mensagem'] = 'Erro ao cadastrar!';

    }
    
    header('Location: Inserir.php');
}

# ==================== atualizando cargo ======================= #
if (isset($_POST['editar']) && $_POST['editar'] == 'editar_cargo') 
{
    $id = mysqli_real_escape_string($conexao, $_POST['id_cargo']);
    $cargo = mysqli_real_escape_string($conexao, $_POST['cargo']);  
    $observacao = mysqli_real_escape_string($conexao, $_POST['observacao']);
    $status = mysqli_real_escape_string($conexao, $_POST['status']);

    $sql = "UPDATE cargo SET id_cargo = $id, nome = '$cargo', observacao = '$observacao', status = $status WHERE id_cargo = $id";

    try
    {

        if (mysqli_query($conexao, $sql))
        {

            // header('Location: index.php');
            
            $_SESSION['mensagem'] = "Cargo atualizado com sucesso!";


        }
        else
        {

            // die('Erro: ' . $sql . "<br>" . mysqli_error($conexao));

            $_SESSION['mensagem'] = 'Erro ao atualizar!';
        }

    }
    catch(mysqli_sql_exception)
    {

        $_SESSION['mensagem'] = 'Erro ao atualizar!';

    }
    
    header('Location: Inserir.php');
}

################## Deletar cargo #################################
if (isset($_POST['deletar_cargo'])) {

    $id = $_POST['deletar_cargo'];

    $sql = "DELETE FROM cargo WHERE id_cargo = $id";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['mensagem'] = "Cargo excluído com sucesso!";
        header('Location: index.php');
    } else {

        $_SESSION['mensagem'] = "Erro ao excluir cargo!";
        header('Location: index.php');
    }
}
