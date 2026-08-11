<?php

# conexao com o banco de dados #

require_once __DIR__ . "/../../conexao/conecta.php";

## Filtros

$sexo = $_POST['sexo'];
$cargo = $_POST['cargo'];
$status = $_POST['status'];
$cidade = $_POST['cidade'];

## CAmpo de busca
$nome = mysqli_real_escape_string($conexao, $_POST['nome']);

?>

<table class="table">

    <?php

    $sql = "SELECT funcionarios.id_funcionario, funcionarios.status , funcionarios.nome , funcionarios.id_cargo, funcionarios.nome_social, funcionarios.usuario , funcionarios.tipo_acesso , funcionarios.data_cadastro  ,cargo.nome 'cargo' , funcionarios.foto FROM funcionarios join cargo on funcionarios.id_cargo = cargo.id_cargo WHERE 1=1";

    // FIltro de sexo
    if (!empty($sexo)) {
        $sql .= " AND funcionarios.sexo = '$sexo'";
    }

    //filtro status
    if ($status != '') {
        $sql .= " AND funcionarios.status = $status";
    }

    //filtro cargo
    if ($cargo != '') {
        $sql .= " AND funcionarios.id_cargo = $cargo";
    }

    //filtro cidade
    if (!empty($cidade)) {
        $sql .= " AND funcionarios.cidade = '$cidade'";
    }

    //filtro busca por nome
    $sql .= " AND (funcionarios.nome LIKE '%$nome%' OR funcionarios.nome_social LIKE '%$nome%')";



    // a função mysqli_query() realiza conexão com o banco de dados e executa o comando sql

    $query = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($query) > 0) {
    ?>

        <thead>

            <tr>

                <th>id</th>
                <th>Foto</th>
                <th>Nome</th>
                <th>Cargo</th>
                <th>Data Cadastro</th>
                <th>Status</th>
                <th>Ações</th>

            </tr>

        </thead>

        <tbody class="">

            <?php

            foreach ($query as $funcionarios) {

            ?>

                <tr style="vertical-align: middle;">

                    <td><?php echo $funcionarios['id_funcionario'] ?></td>

                    <td>
                        <?php

                        if ($funcionarios['foto'] == '') {
                            echo '<img src="../../assets/img/placeholder-funcionario.png" alt="" class="rounded-circle" style="width: 50px; aspect-ratio: 1/1; object-fit: cover;" alt="">';
                        } else {
                            echo '<img src="../../images/' . $funcionarios['foto'] . '" alt="" class="rounded-circle" style="width: 50px; aspect-ratio: 1/1; object-fit: cover;" alt="">';
                        }

                        ?>
                    </td>
                    <td>
                        <?php

                        if (!empty($funcionarios['nome_social'])) 
                        {
                            echo $funcionarios['nome_social'];
                        } 
                        else 
                        {
                            echo $funcionarios['nome'];
                        }

                        ?>
                    </td>
                    <td><?php echo $funcionarios['cargo']; ?></td>

                    <td><?php echo date('d/m/Y', strtotime($funcionarios['data_cadastro'])) ?></td>

                    <td><?php
                        if ($funcionarios['status'] == 1) {

                            echo '<span class="badge text-bg-success">Ativo</span>';
                        } else {

                            echo '<span class="badge text-bg-danger">Inativo</span>';
                        }

                        ?></td>



                    <td>
                        <a href="Editar.php?id_funcionario=<?php echo $funcionarios['id_funcionario'] ?>" class="btn btn-outline-success btn-sm" title="Editar">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <!-- <a href="#" class="btn btn-outline-danger btn-sm" title="Excluir">
                            <i class="bi bi-trash"></i>
                        </a> -->

                        <form action="acoes.php" method="post" class="d-inline">

                        <button type="submit" class="btn btn-outline-danger btn-sm" title="Excluir" name="deletar_funcionario" value="<?php echo $funcionarios['id_funcionario'] ?>" onclick="return confirm('Tem certeza que deseja excluir o funcionário: <?php echo $funcionarios['nome_social'] ?>?')">

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