<?php

# conexao com o banco de dados #

require_once __DIR__ . "/../../conexao/conecta.php";


// filtros
$status = $_POST['status'];
$categoria = $_POST['categoria'];
$desenvolvedora = $_POST['desenvolvedora'];
$plataforma = $_POST['plataforma'];


## CAmpo de busca
$nome = mysqli_real_escape_string($conexao, $_POST['nome']);

?>

<table class="table">
    <?php

    $sql = "SELECT produtos.id_produto, produtos.status , produtos.nome , produtos.id_desenvolvedora, desenvolvedora.nome 'desenvolvedora', plataforma.nome 'plataforma', categorias.nome 'categoria' FROM produtos join desenvolvedora on produtos.id_desenvolvedora = desenvolvedora.id_desenvolvedora join plataforma on produtos.id_plataforma = plataforma.id_plataforma join categorias on produtos.id_categoria = categorias.id_categoria WHERE 1=1";
    // a função mysqli_query() realiza conexão com o banco de dados e executa o comando sql


    //filtro status
    if ($status != '') {
        $sql .= " AND produtos.status = $status ";
    }

    //filtro categoria
    if ($categoria != '') {
        $sql .= " AND produtos.id_categoria = $categoria";
    }

    //filtro desenvolvedora
    if ($desenvolvedora != '') {
        $sql .= " AND produtos.id_desenvolvedora = $desenvolvedora ";
    }

    //filtro plataforma
    if ($plataforma != '') {
        $sql .= " AND produtos.id_plataforma = $plataforma ";
    }

    //filtro busca por nome
    $sql .= " AND produtos.nome LIKE '%$nome%'";


    $query = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($query) > 0) {
    ?>
        <thead>

            <tr>

                <th>id</th>
                <th>Nome</th>
                <th>Desenvolvedora</th>
                <th>Plataforma</th>
                <th>Categoria</th>
                <th>Status</th>
                <th>Ações</th>

            </tr>

        </thead>

        <tbody class="">

            <?php

            foreach ($query as $produtos) {

            ?>

                <tr style="vertical-align: middle;">

                    <td><?php echo $produtos['id_produto'] ?></td>

                    <td><?php echo $produtos['nome'] ?></td>

                    <td><?php echo $produtos['desenvolvedora']; ?></td>

                    <td><?php echo $produtos['plataforma']; ?></td>

                    <td><?php echo $produtos['categoria']; ?></td>

                    <td>
                        <?php
                        if ($produtos['status'] == 1) {

                            echo '<span class="badge text-bg-success">Ativo</span>';
                        } else {

                            echo '<span class="badge text-bg-danger">Inativo</span>';
                        }

                        ?>
                    </td>



                    <td>
                        <a href="Editar.php?id_produto=<?php echo $produtos['id_produto'] ?>" class="btn btn-outline-success btn-sm" title="Editar">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <!-- <a href="#" class="btn btn-outline-danger btn-sm" title="Excluir">
                            <i class="bi bi-trash"></i>
                        </a> -->

                        <form action="acoes.php" method="post" class="d-inline">

                        <button type="submit" class="btn btn-outline-danger btn-sm" title="Excluir" name="deletar_produto" value="<?php echo $produtos['id_produto'] ?>" onclick="return confirm('Tem certeza que deseja excluir o produto: <?php echo $produtos['nome'] ?>?')">

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