<?php

# conexao com o banco de dados #

require_once __DIR__ . "/../../conexao/conecta.php";


// filtros
$status = $_POST['status'];

$sexo = $_POST['sexo'];

## CAmpo de busca
$nome = mysqli_real_escape_string($conexao, $_POST['nome']);



?>

<table class="table">
    <?php

    $sql = "SELECT * FROM clientes WHERE 1=1";

    //filtro status
    if ($status != '') {
        $sql .= " AND clientes.status = $status ";
    }

    //filtro sexo
    if (!empty($sexo)) {
        $sql .= " AND clientes.sexo = '$sexo'";
    }

    //filtro busca por nome
    $sql .= " AND clientes.nome LIKE '%$nome%'";



    // a função mysqli_query() realiza conexão com o banco de dados e executa o comando sql
    $query = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($query) > 0) {
    ?>
        <thead>

            <tr>

                <th>id</th>
                <th>Nome</th>
                <th>Usuário</th>
                <th>Cidade</th>
                <th>Status</th>
                <th>Data Cadastro</th>
                <th>Ações</th>

            </tr>

        </thead>

        <tbody class="">

            <?php

            foreach ($query as $clientes) {

            ?>

                <tr style="vertical-align: middle;">

                    <td><?php echo $clientes['id_cliente'] ?></td>

                    <td><?php echo $clientes['nome'] ?></td>

                    <td><?php echo $clientes['usuario'] ?></td>

                    <td><?php echo $clientes['cidade']; ?></td>

                    <td><?php
                        if ($clientes['status'] == 1) {

                            echo '<span class="badge text-bg-success">Ativo</span>';
                        } else {

                            echo '<span class="badge text-bg-danger">Inativo</span>';
                        }

                        ?></td>

                    <td><?php echo date('d/m/Y', strtotime($clientes['data_cadastro'])) ?></td>

                    <td>
                        <a href="Editar.php?id_cliente=<?php echo $clientes['id_cliente'] ?>" class="btn btn-outline-success btn-sm" title="Editar">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <!-- <a href="#" class="btn btn-outline-danger btn-sm" title="Excluir">
                            <i class="bi bi-trash"></i>
                        </a> -->

                        <form action="acoes.php" method="post" class="d-inline">

                        <button type="submit" class="btn btn-outline-danger btn-sm" title="Excluir" name="deletar_cliente" value="<?php echo $clientes['id_cliente'] ?>" onclick="return confirm('Tem certeza que deseja excluir o Cliente: <?php echo $clientes['nome'] ?>?')">

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