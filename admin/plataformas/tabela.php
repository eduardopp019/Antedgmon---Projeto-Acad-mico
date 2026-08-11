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

    $sql = "SELECT * FROM plataforma WHERE 1=1";

    //filtro status
    if ($status != '') {
        $sql .= " AND plataforma.status = $status ";
    }


    //filtro busca por nome
    $sql .= " AND plataforma.nome LIKE '%$nome%'";

    // a função mysqli_query() realiza conexão com o banco de dados e executa o comando sql

    $query = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($query) > 0) {
    ?>
        <thead>

            <tr>

                <th>id</th>
                <th>Plataforma</th>
                <th>Data Cadastro</th>
                <th>Status</th>
                <th>Ações</th>

            </tr>

        </thead>

        <tbody>


            <?php

            foreach ($query as $plataformas) {

            ?>


                <tr>

                    <td><?php echo $plataformas['id_plataforma'] ?></td>
                    <td><?php echo $plataformas['nome'] ?></td>

                    <td><?php
                        if ($plataformas['status'] == 1) {

                            echo '<span class="badge text-bg-success">Ativo</span>';
                        } else {

                            echo '<span class="badge text-bg-danger">Inativo</span>';
                        }

                        ?></td>

                    <td><?php echo date('d/m/Y', strtotime($plataformas['data_cadastro'])) ?></td>

                    <td>
                        <a href="Editar.php?id_plataforma=<?php echo $plataformas['id_plataforma'] ?>" class="btn btn-outline-success btn-sm" title="Editar">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <!-- <a href="#" class="btn btn-outline-danger btn-sm" title="Excluir">
                            <i class="bi bi-trash"></i>
                        </a> -->

                        <form action="acoes.php" method="post" class="d-inline">

                        <button type="submit" class="btn btn-outline-danger btn-sm" title="Excluir" name="deletar_plataforma" value="<?php echo $plataformas['id_plataforma'] ?>" onclick="return confirm('Tem certeza que deseja excluir a plataforma: <?php echo $plataformas['nome'] ?>?')">

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