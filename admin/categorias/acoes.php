<?php

# Conexão com banco de dados #

require_once __DIR__ . "/../../conexao/conecta.php";

# Iniciando uma sessão #

if(!isset($_SESSION))
{

    session_start();

}

# ==================== cadstrando um novo cargo ======================= #
if (isset($_POST['cadastrar']) && $_POST['cadastrar'] == 'cadastrar_categoria') 
{
    $categoria = mysqli_real_escape_string($conexao, $_POST['categoria']);  

    $sql = "INSERT INTO categorias VALUES (0, '$categoria', 1, NOW())";

    try
    {

        if (mysqli_query($conexao, $sql))
        {

            // header('Location: index.php');
            
            $_SESSION['mensagem'] = "Categoria cadastrada com sucesso!";


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

# ==================== editando uma categoria ======================= #
if (isset($_POST['editar']) && $_POST['editar'] == 'editar_categoria') 
{
    $id = mysqli_real_escape_string($conexao, $_POST['id_categoria']);
    $categoria = mysqli_real_escape_string($conexao, $_POST['categoria']);
    $status = mysqli_real_escape_string($conexao, $_POST['status']);

    $sql = "UPDATE categorias SET nome = '$categoria', status = $status WHERE id_categoria = $id";

    try
    {

        if (mysqli_query($conexao, $sql))
        {

            // header('Location: index.php');

            $_SESSION['mensagem'] = "Categoria atualizada com sucesso!";


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

    header('Location: index.php');
}

################## Deletar categoria #################################
if (isset($_POST['deletar_categoria'])) {

    $id = $_POST['deletar_categoria'];

    $sql = "DELETE FROM categorias WHERE id_categoria = $id";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['mensagem'] = "Categoria excluída com sucesso!";
        header('Location: index.php');
    } else {

        $_SESSION['mensagem'] = "Erro ao excluir categoria!";
        header('Location: index.php');
    }
}
