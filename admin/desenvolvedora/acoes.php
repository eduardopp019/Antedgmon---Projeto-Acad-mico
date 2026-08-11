<?php

# Conexão com banco de dados #

require_once __DIR__ . "/../../conexao/conecta.php";

# Iniciando uma sessão #

if(!isset($_SESSION))
{

    session_start();

}

# ==================== cadstrando uma nova desenvolvedora ======================= #
if (isset($_POST['cadastrar']) && $_POST['cadastrar'] == 'cadastrar_desenvolvedora') 
{
    $desenvolvedora = mysqli_real_escape_string($conexao, $_POST['desenvolvedora']);  

    $sql = "INSERT INTO desenvolvedora VALUES (0, '$desenvolvedora', NOW(), 1)";

    try
    {

        if (mysqli_query($conexao, $sql))
        {

            // header('Location: index.php');
            
            $_SESSION['mensagem'] = "Desenvolvedora cadastrada com sucesso!";


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

# ==================== cadstrando uma nova desenvolvedora ======================= #
if (isset($_POST['editar']) && $_POST['editar'] == 'editar_desenvolvedora') 
{
    $id = mysqli_real_escape_string($conexao, $_POST['id_desenvolvedora']);
    $desenvolvedora = mysqli_real_escape_string($conexao, $_POST['desenvolvedora']);
    $status = mysqli_real_escape_string($conexao, $_POST['status']);  

    $sql = "UPDATE desenvolvedora SET nome = '$desenvolvedora', status = $status WHERE id_desenvolvedora = $id";

    try
    {

        if (mysqli_query($conexao, $sql))
        {

            // header('Location: index.php');
            
            $_SESSION['mensagem'] = "Desenvolvedora atualizada com sucesso!";


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

################## Deletar desenvolvedoras #################################
if (isset($_POST['deletar_desenvolvedora'])) {

    $id = $_POST['deletar_desenvolvedora'];

    $sql = "DELETE FROM desenvolvedora WHERE id_desenvolvedora = $id";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['mensagem'] = "Desenvolvedora excluída com sucesso!";
        header('Location: index.php');
    } else {

        $_SESSION['mensagem'] = "Erro ao excluir desenvolvedora!";
        header('Location: index.php');
    }
}
