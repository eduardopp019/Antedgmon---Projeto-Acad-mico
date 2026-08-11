<?php

# conexao com o banco de dados #

require_once __DIR__ . "/../../conexao/conecta.php";

// filtros
$status = $_POST['status'];

## CAmpo de busca
$nome = mysqli_real_escape_string($conexao, $_POST['nome']);

?>



<table class="table">
    <?php

    $sql = "SELECT cargo.id_cargo, cargo.status, cargo.nome, cargo.observacao, cargo.data_cadastro FROM cargo WHERE 1=1";

    // FIltros

    //filtro status
    if ($status != '') {
        $sql .= " AND cargo.status = $status ";
    }

    //filtro busca por nome
    $sql .= " AND cargo.nome LIKE '%$nome%'";

    

    // a função mysqli_query() realiza conexão com o banco de dados e executa o comando sql
    $query = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($query) > 0) {
    ?>
        <thead>

            <tr>

                <th>id</th>
                <th>Cargo</th>
                <th>Observação</th>
                <th>Status</th>
                <th>Data Cadastro</th>
                <th>Ações</th>

            </tr>

        </thead>

        <tbody>


            <?php

            foreach ($query as $cargo) {

            ?>


                <tr>

                    <td><?php echo $cargo['id_cargo'] ?></td>
                    <td><?php echo $cargo['nome'] ?></td>
                    <td><?php echo $cargo['observacao'] ?></td>

                    <td><?php
                        if ($cargo['status'] == 1) {

                            echo '<span class="badge text-bg-success">Ativo</span>';
                        } else {

                            echo '<span class="badge text-bg-danger">Inativo</span>';
                        }

                        ?></td>

                    <td><?php echo date('d/m/Y', strtotime($cargo['data_cadastro'])) ?></td>

                    <td>
                        <a href="Editar.php?id_cargo=<?php echo $cargo['id_cargo'] ?>" class="btn btn-outline-success btn-sm" title="Editar">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <!-- <a href="#" class="btn btn-outline-danger btn-sm" title="Excluir">
                            <i class="bi bi-trash"></i>
                        </a> -->

                        <form action="acoes.php" method="post" class="d-inline">

                        <button type="submit" class="btn btn-outline-danger btn-sm" title="Excluir" name="deletar_cargo" value="<?php echo $cargo['id_cargo'] ?>" onclick="return confirm('Tem certeza que deseja excluir o Cargo: <?php echo $cargo['nome'] ?>?')">

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