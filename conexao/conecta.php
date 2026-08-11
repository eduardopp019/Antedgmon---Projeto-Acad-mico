<?php 

    $servidor = "localhost";

    $usuario = "root";

    $senha = "";

    $banco = "antedgmon";


    // criar conexao

    $conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

    if (mysqli_connect_errno())
        {

            die("F conexão:" . mysqli_connect_error());

        }

?>