<?php 

    $servidor = getenv('DB_HOST') ?: "localhost";

    $usuario = getenv('DB_USER') ?: "root";

    $senha = getenv('DB_PASSWORD') ?: "";

    $banco = getenv('DB_NAME') ?: "antedgmon";


    // criar conexao

    $conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

    if (mysqli_connect_errno())
        {

            die("F conexão:" . mysqli_connect_error());

        }

?>
