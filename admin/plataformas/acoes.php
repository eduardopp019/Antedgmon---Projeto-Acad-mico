<?php

# Conexão com banco de dados #

require_once __DIR__ . "/../../conexao/conecta.php";

# Iniciando uma sessão #

if(!isset($_SESSION))
{

    session_start();

}

# ==================== cadstrando um novo plataforma ======================= #
if (isset($_POST['cadastrar']) && $_POST['cadastrar'] == 'cadastrar_plataforma') 
{
    $plataformas = mysqli_real_escape_string($conexao, $_POST['plataforma']);  

    $sql = "INSERT INTO plataforma VALUES (0, '$plataformas', NOW(), 1)";

    try
    {

        if (mysqli_query($conexao, $sql))
        {

            // header('Location: index.php');
            
            $_SESSION['mensagem'] = "Plataforma cadastrada com sucesso!";


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

# ==================== editando uma plataforma ======================= #
if (isset($_POST['editar']) && $_POST['editar'] == 'editar_plataforma') 
{
    $id = mysqli_real_escape_string($conexao, $_POST['id_plataforma']);
    $plataformas = mysqli_real_escape_string($conexao, $_POST['plataforma']);
    $status = mysqli_real_escape_string($conexao, $_POST['status']);

    $sql = "UPDATE plataforma SET nome = '$plataformas', status = $status WHERE id_plataforma = $id";

    try
    {

        if (mysqli_query($conexao, $sql))
        {

            // header('Location: index.php');
            
            $_SESSION['mensagem'] = "Plataforma atualizada com sucesso!";


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

################## Deletar plataformas #################################
if (isset($_POST['deletar_plataforma'])) {

    $id = $_POST['deletar_plataforma'];

    $sql = "DELETE FROM plataforma WHERE id_plataforma = $id";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['mensagem'] = "Plataforma excluída com sucesso!";
        header('Location: index.php');
    } else {

        $_SESSION['mensagem'] = "Erro ao excluir plataforma!";
        header('Location: index.php');
    }
}
