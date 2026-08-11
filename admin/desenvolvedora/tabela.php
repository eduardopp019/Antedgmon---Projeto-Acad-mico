<?php

# CONEXAO BANCO DE DADOS #

require_once __DIR__ . "/../../conexao/conecta.php";


// filtros
$status = $_POST['status'];


## CAmpo de busca
$nome = mysqli_real_escape_string($conexao, $_POST['nome']);


?>

<table class="table">
    <?php

    $sql = "SELECT * FROM desenvolvedora WHERE 1=1";



    //filtro status
    if ($status != '') {
        $sql .= " AND desenvolvedora.status = $status ";
    }


    //filtro busca por nome
    $sql .= " AND desenvolvedora.nome LIKE '%$nome%'";


    // a função mysqli_query() realiza conexão com o banco de dados e executa o comando sql

    $query = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($query) > 0) {


    ?>
        <thead>

            <tr>

                <th>id</th>
                <th>Desenvolvedora</th>
                <th>Data Cadastro</th>
                <th>Status</th>
                <th>Ações</th>

            </tr>

        </thead>

        <tbody>


            <?php

            foreach ($query as $desenvolvedora) {

            ?>


                <tr>

                    <td><?php echo $desenvolvedora['id_desenvolvedora'] ?></td>
                    <td><?php echo $desenvolvedora['nome'] ?></td>

                    <td><?php echo date('d/m/Y', strtotime($desenvolvedora['data_cadastro'])) ?></td>

                    <td><?php
                        if ($desenvolvedora['status'] == 1) {

                            echo '<span class="badge text-bg-success">Ativo</span>';
                        } else {

                            echo '<span class="badge text-bg-danger">Inativo</span>';
                        }

                        ?></td>

                    

                    <td>
                        <a href="Editar.php?id_desenvolvedora=<?php echo $desenvolvedora['id_desenvolvedora'] ?>" class="btn btn-outline-success btn-sm" title="Editar">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <!-- <a href="#" class="btn btn-outline-danger btn-sm" title="Excluir">
                            <i class="bi bi-trash"></i>
                        </a> -->

                        <form action="acoes.php" method="post" class="d-inline">

                        <button type="submit" class="btn btn-outline-danger btn-sm" title="Excluir" name="deletar_desenvolvedora" value="<?php echo $desenvolvedora['id_desenvolvedora'] ?>" onclick="return confirm('Tem certeza que deseja excluir a Desenvolvedora: <?php echo $desenvolvedora['nome'] ?>?')">

                        <i class="bi bi-trash"></i>

                        </button>

                        </form>
                    </td>

                </tr>

            <?php } ?>

        </tbody>
    <?php
    } else {
        echo '<div class="alert alert-danger" role="alert">
                    Nenhum registro encontrado!</div>';
    }
    ?>
</table>