<?php

# Conexão com banco de dados #
require_once __DIR__ . "/../../conexao/conecta.php";

# Iniciando uma sessão #
if (!isset($_SESSION)) {

    session_start();
}
################## Cadastrando novos produtos #################################
if (isset($_POST['cadastrar']) && $_POST['cadastrar'] == 'cadastrar_produto') {

    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $id_produto = mysqli_real_escape_string($conexao, $_POST['produtos']);
    $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
    $id_plataforma = mysqli_real_escape_string($conexao, $_POST['plataforma']);
    // $data_cadastro = mysqli_real_escape_string($conexao, $_POST['data_cadastro']);
    $id_desenvolvedora = mysqli_real_escape_string($conexao, $_POST['desenvolvedora']);
    $status = mysqli_real_escape_string($conexao, $_POST['status']);
    $id_categoria = mysqli_real_escape_string($conexao, $_POST['categorias']);
    $promocao = intval($_POST['promocao']);
    $tipo = mysqli_real_escape_string($conexao, $_POST['tipo']);
    $estoque = intval($_POST['estoque']);
    $custo = floatval(str_replace(',', '.', $_POST['custo']));
    $preco_venda = mysqli_real_escape_string($conexao, $_POST['preco_venda']);
    $desconto = floatval(str_replace(',', '.', $_POST['desconto']));
    $lucro = floatval(str_replace(',', '.', $_POST['lucro']));
    $preco_promocao = mysqli_real_escape_string($conexao, $_POST['preco_promocao']);
    $data_criacao = mysqli_real_escape_string($conexao, $_POST['data_criacao']);
    $codigo = trim($_POST['codigo']);
    $data_fim_promocao = mysqli_real_escape_string($conexao, $_POST['data_fim_promocao']);
    $classificacao = mysqli_escape_string($conexao, $_POST['classificacao']);

    $gpu_m = $_POST['gpu_m'];
    $os_m = $_POST['os_m'];
    $armazenamento_m = $_POST['armazenamento_m'];
    $cpu_m = $_POST['cpu_m'];
    $ram_m = $_POST['ram_m'];
    $placa_s_m = $_POST['placa_s_m'];
    $directx_m = $_POST['directx_m'];

    $gpu_r = $_POST['gpu_r'];
    $os_r = $_POST['os_r'];
    $armazenamento_r = $_POST['armazenamento_r'];
    $cpu_r = $_POST['cpu_r'];
    $ram_r = $_POST['ram_r'];
    $placa_s_r = $_POST['placa_s_r'];
    $directx_r = $_POST['directx_r'];

    // Salvando os requisitos mínimos e recomendados como JSON para armazenar no banco de dados
    $requisitos_minimos = json_encode([
        'so' => $os_m,
        'armazenamento' => $armazenamento_m,
        'processador' => $cpu_m,
        'memoria' => $ram_m,
        'gpu' => $gpu_m,
        'som' => $placa_s_m,
        'directx' => $directx_m


    ], JSON_UNESCAPED_UNICODE);

    $requisitos_recomendados = json_encode([
        'so' => $os_r,
        'armazenamento' => $armazenamento_r,
        'processador' => $cpu_r,
        'memoria' => $ram_r,
        'gpu' => $gpu_r,
        'som' => $placa_s_r,
        'directx' => $directx_r
    ], JSON_UNESCAPED_UNICODE);



    // cálculo real no backend
    $preco_venda = $custo + ($custo * ($lucro / 100));

    if ($promocao == 1) {
        $preco_promocao = $preco_venda - ($preco_venda * ($desconto / 100));
    } else {
        $desconto = 0;
        $preco_promocao = 0;
    }

    // fallback caso JS falhe e o código venha vazio
    if (empty($codigo)) {
        $codigo = strtoupper(bin2hex(random_bytes(8)));
    }

    // imagem principal
    $foto = basename($_FILES['foto']['name']);
    $tmp1 = $_FILES['foto']['tmp_name'];
    $final1 = "../../img/Jogos/" . $foto;

    if (!empty($foto)) {
        move_uploaded_file($tmp1, $final1);
    }

    // imagem 2
    $foto2 = basename($_FILES['foto2']['name']);
    $tmp2 = $_FILES['foto2']['tmp_name'];
    $final2 = "../../img/Jogos/" . $foto2;

    if (!empty($foto2)) {
        move_uploaded_file($tmp2, $final2);
    }

    // imagem 3
    $foto3 = basename($_FILES['foto3']['name']);
    # salvando um caminho tmeporario na pasta 'TMP' #
    $tmp3 = $_FILES['foto3']['tmp_name'];
    # criando o caminho para pasta final #
    $final3 = "../../img/Jogos/" . $foto3;

    if (!empty($foto3)) {
        # movendo a imagem da pasta tmp para a pasta images #
        move_uploaded_file($tmp3, $final3);
    }

    // imagem 4
    $foto4 = basename($_FILES['foto4']['name']);
    # salvando um caminho tmeporario na pasta 'TMP' #
    $tmp4 = $_FILES['foto4']['tmp_name'];
    # criando o caminho para pasta final #
    $final4 = "../../img/Jogos/" . $foto4;

    if (!empty($foto4)) {
        # movendo a imagem da pasta tmp para a pasta images #
        move_uploaded_file($tmp4, $final4);
    }

    // imagem de fundo
    $foto_bg = basename($_FILES['foto_bg']['name']);
    $tmp_bg = $_FILES['foto_bg']['tmp_name'];
    $final_bg = "../../img/Jogos/" . $foto_bg;

    if (!empty($foto_bg)) {
        move_uploaded_file($tmp_bg, $final_bg);
    }


    // INSERT


    $sql = "INSERT INTO produtos (id_plataforma, id_categoria, id_desenvolvedora, nome, descricao, tipo,custo, preco_venda, desconto, promocao, lucro, preco_promocao, estoque, data_criacao, imagem, imagem2, imagem3, imagem4, codigos, status, data_fim_promocao, classificacao, imagem_bg, requisitos_minimos, requisitos_recomendados) VALUES ($id_plataforma, $id_categoria, $id_desenvolvedora, '$nome', '$descricao', '$tipo','$custo', '$preco_venda', '$desconto', '$promocao', '$lucro', '$preco_promocao','$estoque', '$data_criacao', '$foto', '$foto2', '$foto3', '$foto4','$codigo', 1, '$data_fim_promocao', '$classificacao', '$foto_bg', '$requisitos_minimos', '$requisitos_recomendados')";


    if (mysqli_query($conexao, $sql)) {

        header('Location: index.php');
    } else {

        die('ERRO: ' . $sql . '<br>' . mysqli_error($conexao));
    }
}


################## Editar produtos #################################
if (isset($_POST['editar']) && $_POST['editar'] == 'editar_produto') {

    $id_produto = mysqli_real_escape_string($conexao, $_POST['id_produto']);
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
    $id_plataforma = mysqli_real_escape_string($conexao, $_POST['plataforma']);
    // $data_cadastro = mysqli_real_escape_string($conexao, $_POST['data_cadastro']);
    $id_desenvolvedora = mysqli_real_escape_string($conexao, $_POST['desenvolvedora']);
    $status = mysqli_real_escape_string($conexao, $_POST['status']);
    $id_categoria = mysqli_real_escape_string($conexao, $_POST['categorias']);
    $promocao = intval($_POST['promocao']);
    $tipo = mysqli_real_escape_string($conexao, $_POST['tipo']);
    $estoque = intval($_POST['estoque']);
    $custo = floatval(str_replace(',', '.', $_POST['custo']));
    $preco_venda = mysqli_real_escape_string($conexao, $_POST['preco_venda']);
    $desconto = floatval(str_replace(',', '.', $_POST['desconto']));
    $lucro = floatval(str_replace(',', '.', $_POST['lucro']));
    $preco_promocao = mysqli_real_escape_string($conexao, $_POST['preco_promocao']);
    $data_criacao = mysqli_real_escape_string($conexao, $_POST['data_criacao']);
    $codigo = trim($_POST['codigo']);
    $data_fim_promocao = mysqli_real_escape_string($conexao, $_POST['data_fim_promocao']);
    $classificacao = mysqli_escape_string($conexao, $_POST['classificacao']);

    $gpu_m = $_POST['gpu_m'];
    $os_m = $_POST['os_m'];
    $armazenamento_m = $_POST['armazenamento_m'];
    $cpu_m = $_POST['cpu_m'];
    $ram_m = $_POST['ram_m'];
    $placa_s_m = $_POST['placa_s_m'];
    $directx_m = $_POST['directx_m'];

    $gpu_r = $_POST['gpu_r'];
    $os_r = $_POST['os_r'];
    $armazenamento_r = $_POST['armazenamento_r'];
    $cpu_r = $_POST['cpu_r'];
    $ram_r = $_POST['ram_r'];
    $placa_s_r = $_POST['placa_s_r'];
    $directx_r = $_POST['directx_r'];

    // Salvando os requisitos mínimos e recomendados como JSON para armazenar no banco de dados
    $requisitos_minimos = json_encode([
        'so' => $os_m,
        'armazenamento' => $armazenamento_m,
        'processador' => $cpu_m,
        'memoria' => $ram_m,
        'gpu' => $gpu_m,
        'som' => $placa_s_m,
        'directx' => $directx_m


    ], JSON_UNESCAPED_UNICODE);

    $requisitos_recomendados = json_encode([
        'so' => $os_r,
        'armazenamento' => $armazenamento_r,
        'processador' => $cpu_r,
        'memoria' => $ram_r,
        'gpu' => $gpu_r,
        'som' => $placa_s_r,
        'directx' => $directx_r
    ], JSON_UNESCAPED_UNICODE);


    // cálculo real no backend
    $preco_venda = $custo + ($custo * ($lucro / 100));

    if ($promocao == 1) {
        $preco_promocao = $preco_venda - ($preco_venda * ($desconto / 100));
    } else {
        $desconto = 0;
        $preco_promocao = 0;
    }

    // fallback caso JS falhe e o código venha vazio
    if (empty($codigo)) {
        $codigo = strtoupper(bin2hex(random_bytes(8)));
    }

    // imagem principal
    $foto = basename($_FILES['foto']['name']);
    $tmp1 = $_FILES['foto']['tmp_name'];
    $final1 = "../../img/Jogos/" . $foto;

    if (!empty($foto)) {
        move_uploaded_file($tmp1, $final1);
    }

    // imagem 2
    $foto2 = basename($_FILES['foto2']['name']);
    $tmp2 = $_FILES['foto2']['tmp_name'];
    $final2 = "../../img/Jogos/" . $foto2;

    if (!empty($foto2)) {
        move_uploaded_file($tmp2, $final2);
    }

    // imagem 3
    $foto3 = basename($_FILES['foto3']['name']);
    # salvando um caminho tmeporario na pasta 'TMP' #
    $tmp3 = $_FILES['foto3']['tmp_name'];
    # criando o caminho para pasta final #
    $final3 = "../../img/Jogos/" . $foto3;

    if (!empty($foto3)) {
        # movendo a imagem da pasta tmp para a pasta images #
        move_uploaded_file($tmp3, $final3);
    }

    // imagem 4
    $foto4 = basename($_FILES['foto4']['name']);
    # salvando um caminho tmeporario na pasta 'TMP' #
    $tmp4 = $_FILES['foto4']['tmp_name'];
    # criando o caminho para pasta final #
    $final4 = "../../img/Jogos/" . $foto4;

    if (!empty($foto4)) {
        # movendo a imagem da pasta tmp para a pasta images #
        move_uploaded_file($tmp4, $final4);
    }

    // imagem de fundo
    $foto_bg = basename($_FILES['foto_bg']['name']);
    $tmp_bg = $_FILES['foto_bg']['tmp_name'];
    $final_bg = "../../img/Jogos/" . $foto_bg;

    if (!empty($foto_bg)) {
        move_uploaded_file($tmp_bg, $final_bg);
    }



    // INSERT

    $sql = "UPDATE produtos SET id_plataforma = $id_plataforma, id_categoria = $id_categoria, id_desenvolvedora = $id_desenvolvedora, nome = '$nome', descricao = '$descricao', tipo = '$tipo', custo = '$custo', preco_venda = '$preco_venda', desconto = '$desconto', promocao = $promocao, lucro = '$lucro', preco_promocao = '$preco_promocao', estoque = '$estoque', data_criacao = '$data_criacao', codigos = '$codigo', status = $status, data_fim_promocao ='$data_fim_promocao', classificacao = '$classificacao', requisitos_minimos = '$requisitos_minimos', requisitos_recomendados = '$requisitos_recomendados'";


    if (!empty($foto)) {
        $sql .= ", imagem = '$foto'";
    }

    if (!empty($foto2)) {
        $sql .= ", imagem2 = '$foto2'";
    }

    if (!empty($foto3)) {
        $sql .= ", imagem3 = '$foto3'";
    }

    if (!empty($foto4)) {
        $sql .= ", imagem4 = '$foto4'";
    }

    if (!empty($foto_bg)) {
        $sql .= ", imagem_bg = '$foto_bg'";
    }


    //complementando update cp, a clausa where
    $sql .= " WHERE id_produto = $id_produto";

    try {
        if (mysqli_query($conexao, $sql)) {

            //header('Location: index.php');
            $_SESSION['msg'] = "Produto atualizado com sucesso!";
        } else {

            //die('ERRO: ' . $sql . '<br>' . mysqli_error($conexao));
            $_SESSION['msg'] = "Erro ao atualizar produto: ";
        }
    } catch (mysqli_sql_exception) {
        $_SESSION['msg'] = "Erro ao atualizar";
    }
    header('Location: index.php');
}

################## Deletar produtos' #################################
if (isset($_POST['deletar_produto'])) {

    $id = $_POST['deletar_produto'];

    $sql = "DELETE FROM produtos WHERE id_produto = $id";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['mensagem'] = "Produto excluído com sucesso!";
        header('Location: index.php');
    } else {

        $_SESSION['mensagem'] = "Erro ao excluir produto!";
        header('Location: index.php');
    }
}
