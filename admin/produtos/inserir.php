<?php

# conexao com o banco de dados #

require_once __DIR__ . "/../../conexao/conecta.php";

##Verificando se existe usuario logado para permitir acesso ao painel administrativo
include_once "../Usuario_Comum.php";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PAINEL ADMINISTRATIVO</title>

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- CUSTOMIZAÇÃO DO TEMPLATE -->
    <link rel="stylesheet" href="../../assets/css/dashboard.min.css">
    <link rel="stylesheet" href="../../assets/css/styles.min.css">

    <!-- FAVICON -->
    <link rel="shortcut icon" href="../../assets/img/favicon.ico" type="image/x-icon">

    <!-- FontAwesome (icones) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Adicionando JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"></script>


</head>

<body>

    <?php
    #Início TOPO
    include('../Topo.php');
    #Final TOPO
    ?>

    <div class="container-fluid">
        <div class="row">
            <?php
            #Início MENU
            include('../Navegacao.php');
            #Final MENU
            ?>

            <main class="ms-auto col-lg-10 px-md-4">
                <?php
                include('../Log.php');
                ?>

                <div class="card">

                    <div class="card-header d-flex justify-content-between">

                        <h4 class="m-0">Cadastrar Produto</h4>

                        <a href="index.php" class="btn btn-info btn-sm">

                            <i class="bi bi-arrow-left-short"></i>
                            Voltar
                        </a>

                    </div>

                    <div class="card-body">

                        <form action="acoes.php" method="post" enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-12 d-flex justify-content-center flex-wrap gap-2">

                                    <img src="../../assets/img/placeholder-produtosnovos.png" alt="" style="width: 250px; height: 140px;" name="imagem" id="imagem">

                                    <img src="../../assets/img/placeholder-produtosnovos.png" alt="" style="width: 250px; height: 140px;" name="imagem2" id="imagem2">

                                    <img src="../../assets/img/placeholder-produtosnovos.png" alt="" style="width: 250px; height: 140px;" name="imagem3" id="imagem3">

                                    <img src="../../assets/img/placeholder-produtosnovos.png" alt="" style="width: 250px; height: 140px;" name="imagem4" id="imagem4">

                                    <img src="../../assets/img/placeholder-produtosnovos.png" alt="" style="width: 250px; height: 140px;" name="imagem_bg" id="imagem_bg">

                                </div>

                                <hr class="mt-3">

                                <div class="col-4">

                                    <label for="foto"><strong class="text-danger">*</strong>Imagem do Produto:</label>
                                    <input type="file" name="foto" id="foto" class="form-control" accept="image/*" required>

                                </div>

                                <div class="col-4">

                                    <label for="foto2"><strong class="text-danger">*</strong>Imagem 2:</label>
                                    <input type="file" name="foto2" id="foto2" class="form-control" accept="image/*" required>

                                </div>

                                <div class="col-4">

                                    <label for="foto3"><strong class="text-danger">*</strong>Imagem 3:</label>
                                    <input type="file" name="foto3" id="foto3" class="form-control" accept="image/*" required>

                                </div>

                                <div class="col-4">

                                    <label for="foto4"><strong class="text-danger">*</strong>Imagem 4:</label>
                                    <input type="file" name="foto4" id="foto4" class="form-control" accept="image/*" required>

                                </div>

                                <div class="col-4">

                                    <label for="foto_bg"><strong class="text-danger">*</strong>Imagem Background:</label>
                                    <input type="file" name="foto_bg" id="foto_bg" class="form-control" accept="image/*" required>

                                </div>





                                <div class="col-4">

                                    <label for="status"><strong class="text-danger">*</strong>Status:</label>
                                    <select name="status" id="status" class="form-control" disabled>

                                        <option value="1">Ativo</option>
                                        <option value="0">Inativo</option>



                                    </select>


                                </div>

                                <hr class="mt-3">



                                <div class="col-4 mt-1">

                                    <label for="plataforma"><strong class="text-danger">*</strong>Plataforma:</label>
                                    <select name="plataforma" id="plataforma" class="form-control" required>

                                        <option value="">-- Selecionar --</option>

                                        <?php

                                        $sql_plataforma = "SELECT id_plataforma, nome FROM plataforma WHERE status =1";

                                        $query_plataforma = mysqli_query($conexao, $sql_plataforma);

                                        foreach ($query_plataforma as $plataforma) {

                                            echo '<option value="' . $plataforma['id_plataforma'] . '">' . $plataforma['nome'] . '</option>';
                                        }

                                        ?>

                                    </select>



                                </div>

                                <div class="col-4 mt-1">

                                    <label for="desenvolvedora"><strong class="text-danger">*</strong>Desenvolvedora:</label>
                                    <select name="desenvolvedora" id="desenvolvedora" class="form-control" required>

                                        <option value="">-- Selecionar --</option>

                                        <?php

                                        $sql_desenvolvedora = "SELECT id_desenvolvedora, nome FROM desenvolvedora WHERE status =1";

                                        $query_desenvolvedora = mysqli_query($conexao, $sql_desenvolvedora);

                                        foreach ($query_desenvolvedora as $desenvolvedora) {

                                            echo '<option value="' . $desenvolvedora['id_desenvolvedora'] . '">' . $desenvolvedora['nome'] . '</option>';
                                        }

                                        ?>

                                    </select>



                                </div>

                                <div class="col-4 mt-1">

                                    <label for="categorias"><strong class="text-danger">*</strong>Categoria:</label>
                                    <select name="categorias" id="categorias" class="form-control" required>

                                        <option value="">-- Selecionar --</option>

                                        <?php

                                        $sql_categoria = "SELECT id_categoria, nome FROM categorias WHERE status =1";

                                        $query_categoria = mysqli_query($conexao, $sql_categoria);

                                        foreach ($query_categoria as $categoria) {

                                            echo '<option value="' . $categoria['id_categoria'] . '">' . $categoria['nome'] . '</option>';
                                        }

                                        ?>

                                    </select>



                                </div>

                                <div class="col-4">
                                    <label for="nome"><strong class="text-danger">*</strong>Nome:</label>
                                    <input type="text" name="nome" id="nome" class="form-control" maxlength="40" required>
                                </div>

                                <div class="col-4">

                                    <label for="tipo"><strong class="text-danger">*</strong>Tipo:</label>
                                    <select name="tipo" id="tipo" class="form-control" required>

                                        <option value="">Tipo de produto...</option>
                                        <option value="0">STEAM</option> <!-- 15 -->
                                        <option value="1">XBOX</option> <!-- 25 -->
                                        <option value="2">PLAYSTATION</option> <!-- 12 -->
                                        <option value="3">NINTENDO</option> <!-- 16 -->

                                    </select>


                                </div>


                                <div class="col-4">
                                    <label for="classificacao"><strong class="text-danger">*</strong>Classificação de Idade</label>
                                    <input type="text" name="classificacao" id="classificacao" class="form-control" maxlength="2" required>
                                </div>

                                <hr class="mt-3">

                                <div class="col-4">
                                    <label for="custo"><strong class="text-danger">*</strong>Custo(R$):</label>
                                    <input type="text" name="custo" id="custo" class="form-control" maxlength="40" required>
                                </div>

                                <div class="col-4">
                                    <label for="lucro"><strong class="text-danger">*</strong>Lucro(%):</label>
                                    <input type="text" name="lucro" id="lucro" class="form-control" maxlength="40" required>


                                </div>

                                <div class="col-4">
                                    <label for="data_criacao"><strong class="text-danger">*</strong>Data de Lançamento:</label>
                                    <input type="date" name="data_criacao" id="data_criacao" class="form-control" maxlength="40" required>

                                </div>

                                <div class="col-4">

                                    <label for="promocao"><strong class="text-danger">*</strong>Promoção:</label>
                                    <select name="promocao" id="promocao" class="form-control">

                                        <option value="">Produto esta na promocão?...</option>
                                        <option value="1">Sim</option>
                                        <option value="0">Não</option>

                                    </select>


                                </div>

                                <div class="col-4">
                                    <label for="desconto"><strong class="text-danger">*</strong>Desconto(%):</label>
                                    <input type="text" name="desconto" id="desconto" class="form-control" maxlength="40">
                                </div>

                                <div class="col-4">
                                    <label for="data_fim_promocao">Data do fim da promoção</label>
                                    <input type="date" name="data_fim_promocao" id="data_fim_promocao" class="form-control" maxlength="40">

                                </div>

                                <div class="col-4">
                                    <label for="preco_venda"><strong class="text-danger">*</strong>Preço de Venda(R$):</label>
                                    <input type="text" name="preco_venda" id="preco_venda" class="form-control" maxlength="40" readonly>
                                </div>

                                <div class="col-4">
                                    <label for="preco_promocao"><strong class="text-danger">*</strong>Preço em Promoção(R$):</label>
                                    <input type="text" name="preco_promocao" id="preco_promocao" class="form-control" maxlength="40" readonly>
                                </div>


                                <div class="col-4">
                                    <label for="estoque"><strong class="text-danger">*</strong>Estoque:</label>
                                    <input type="text" name="estoque" id="estoque" class="form-control" maxlength="40" required>
                                </div>




                                <div class="col-12">

                                    <label for="codigo">Codigo do Produto:</label>
                                    <input type="text" name="codigo" id="codigo" class="form-control" maxlength="40" readonly>

                                </div>
                                <div class="col-12">

                                    <label for="descricao"><strong class="text-danger">*</strong>Descrição:</label>
                                    <textarea name="descricao" id="descricao" class="form-control" rows="5" maxlength="500" required></textarea>



                                </div>

                                <hr class="mt-3">

                                <div id="requisitos-pc" class="row" style="display:none;">

                                    <!-- Minimos -->

                                    <label for="titulo" class="mb-3 fs-4">Requisitos Mínimos:</label>


                                    <div class="col-4">

                                        <label for="gpu_m">
                                            <strong class="text-danger">*</strong>Placa de Vídeo:
                                        </label>

                                        <select name="gpu_m" id="gpu_m" class="form-control">

                                            <option value="">Selecione a placa de vídeo...</option>

                                            <option value="Intel HD 4000">
                                                Intel HD 4000
                                            </option>

                                            <option value="Intel UHD 630">
                                                Intel UHD 630
                                            </option>

                                            <option value="NVIDIA GTX 660 2GB / AMD HD 7870 2GB">
                                                NVIDIA GTX 660 2GB / AMD HD 7870 2GB
                                            </option>

                                            <option value="NVIDIA GTX 760 2GB / AMD R9 270X 2GB">
                                                NVIDIA GTX 760 2GB / AMD R9 270X 2GB
                                            </option>

                                            <option value="NVIDIA GTX 770 2GB / AMD R9 280 3GB">
                                                NVIDIA GTX 770 2GB / AMD R9 280 3GB
                                            </option>

                                            <option value="NVIDIA GTX 960 2GB / AMD R9 380 4GB">
                                                NVIDIA GTX 960 2GB / AMD R9 380 4GB
                                            </option>

                                            <option value="NVIDIA GTX 970 4GB / AMD RX 470 4GB">
                                                NVIDIA GTX 970 4GB / AMD RX 470 4GB
                                            </option>

                                            <option value="NVIDIA GTX 1050 Ti 4GB / AMD RX 570 4GB">
                                                NVIDIA GTX 1050 Ti 4GB / AMD RX 570 4GB
                                            </option>

                                            <option value="NVIDIA GTX 1060 3GB / AMD RX 580 4GB">
                                                NVIDIA GTX 1060 3GB / AMD RX 580 4GB
                                            </option>

                                            <option value="NVIDIA GTX 1650 4GB / AMD RX 570 4GB">
                                                NVIDIA GTX 1650 4GB / AMD RX 570 4GB
                                            </option>

                                            <option value="NVIDIA GTX 1660 6GB / AMD RX 590 8GB">
                                                NVIDIA GTX 1660 6GB / AMD RX 590 8GB
                                            </option>

                                            <option value="NVIDIA RTX 2060 6GB / AMD RX 6600 8GB">
                                                NVIDIA RTX 2060 6GB / AMD RX 6600 8GB
                                            </option>

                                            <option value="NVIDIA RTX 3060 8GB / AMD RX 6600 XT 8GB">
                                                NVIDIA RTX 3060 8GB / AMD RX 6600 XT 8GB
                                            </option>

                                        </select>

                                    </div>

                                    <div class="col-4">

                                        <label for="os_m">
                                            <strong class="text-danger">*</strong>Sistema Operacional:
                                        </label>

                                        <select name="os_m" id="os_m" class="form-control">

                                            <option value="">Selecione o Sistema Operacional...</option>

                                            <option value="Windows 7 64-bit">
                                                Windows 7 64-bit
                                            </option>

                                            <option value="Windows 8.1 64-bit">
                                                Windows 8.1 64-bit
                                            </option>

                                            <option value="Windows 10 64-bit">
                                                Windows 10 64-bit
                                            </option>

                                            <option value="Windows 11 64-bit">
                                                Windows 11 64-bit
                                            </option>

                                            <option value="Windows 10 / 11 64-bit">
                                                Windows 10 / 11 64-bit
                                            </option>

                                        </select>

                                    </div>

                                    <div class="col-4">

                                        <label for="armazenamento_m">
                                            <strong class="text-danger">*</strong>Armazenamento:
                                        </label>

                                        <select name="armazenamento_m" id="armazenamento_m" class="form-control">

                                            <option value="">Selecione o armazenamento...</option>

                                            <option value="10 GB de espaço livre">10 GB de espaço livre</option>
                                            <option value="20 GB de espaço livre">20 GB de espaço livre</option>
                                            <option value="30 GB de espaço livre">30 GB de espaço livre</option>
                                            <option value="40 GB de espaço livre">40 GB de espaço livre</option>
                                            <option value="50 GB de espaço livre">50 GB de espaço livre</option>
                                            <option value="60 GB de espaço livre">60 GB de espaço livre</option>
                                            <option value="70 GB de espaço livre">70 GB de espaço livre</option>
                                            <option value="80 GB de espaço livre">80 GB de espaço livre</option>
                                            <option value="100 GB de espaço livre">100 GB de espaço livre</option>
                                            <option value="150 GB de espaço livre">150 GB de espaço livre</option>
                                            <option value="200 GB de espaço livre">200 GB de espaço livre</option>

                                        </select>

                                    </div>

                                    <div class="col-4">

                                        <label for="cpu_m">
                                            <strong class="text-danger">*</strong>Processador:
                                        </label>

                                        <select name="cpu_m" id="cpu_m" class="form-control">

                                            <option value="">Selecione o processador...</option>

                                            <option value="Intel Core i3-2100 / AMD FX-6300">
                                                Intel Core i3-2100 / AMD FX-6300
                                            </option>

                                            <option value="Intel Core i5-2500K / AMD FX-8350">
                                                Intel Core i5-2500K / AMD FX-8350
                                            </option>

                                            <option value="Intel Core i5-3470 / AMD FX-8350">
                                                Intel Core i5-3470 / AMD FX-8350
                                            </option>

                                            <option value="Intel Core i5-4460 / AMD FX-8350">
                                                Intel Core i5-4460 / AMD FX-8350
                                            </option>

                                            <option value="Intel Core i5-6600K / AMD Ryzen 3 1200">
                                                Intel Core i5-6600K / AMD Ryzen 3 1200
                                            </option>

                                            <option value="Intel Core i5-7400 / AMD Ryzen 3 2200G">
                                                Intel Core i5-7400 / AMD Ryzen 3 2200G
                                            </option>

                                            <option value="Intel Core i5-8400 / AMD Ryzen 3 3300X">
                                                Intel Core i5-8400 / AMD Ryzen 3 3300X
                                            </option>

                                            <option value="Intel Core i5-8600 / AMD Ryzen 5 3600">
                                                Intel Core i5-8600 / AMD Ryzen 5 3600
                                            </option>

                                            <option value="Intel Core i5-10400 / AMD Ryzen 5 3600">
                                                Intel Core i5-10400 / AMD Ryzen 5 3600
                                            </option>

                                            <option value="Intel Core i5-12400 / AMD Ryzen 5 5600">
                                                Intel Core i5-12400 / AMD Ryzen 5 5600
                                            </option>

                                            <option value="Intel Core i7-4770K / AMD Ryzen 5 1500X">
                                                Intel Core i7-4770K / AMD Ryzen 5 1500X
                                            </option>

                                            <option value="Intel Core i7-6700 / AMD Ryzen 5 2600">
                                                Intel Core i7-6700 / AMD Ryzen 5 2600
                                            </option>

                                        </select>

                                    </div>

                                    <div class="col-4">

                                        <label for="ram_m">
                                            <strong class="text-danger">*</strong>Memória:
                                        </label>

                                        <select name="ram_m" id="ram_m" class="form-control">

                                            <option value="">Selecione a memória RAM...</option>

                                            <option value="4 GB RAM">4 GB RAM</option>
                                            <option value="6 GB RAM">6 GB RAM</option>
                                            <option value="8 GB RAM">8 GB RAM</option>
                                            <option value="12 GB RAM">12 GB RAM</option>
                                            <option value="16 GB RAM">16 GB RAM</option>
                                            <option value="24 GB RAM">24 GB RAM</option>
                                            <option value="32 GB RAM">32 GB RAM</option>
                                            <option value="64 GB RAM">64 GB RAM</option>

                                        </select>

                                    </div>

                                    <div class="col-4">

                                        <label for="placa_s_m">
                                            <strong class="text-danger">*</strong>Placa de Som:
                                        </label>

                                        <select name="placa_s_m" id="placa_s_m" class="form-control">

                                            <option value="">Selecione a placa de som...</option>

                                            <option value="Windows-compatible audio device">
                                                Windows-compatible audio device
                                            </option>

                                            <option value="DirectX Compatible Sound Card">
                                                DirectX Compatible Sound Card
                                            </option>

                                            <option value="Integrated Audio">
                                                Integrated Audio
                                            </option>

                                            <option value="Onboard Sound Card">
                                                Onboard Sound Card
                                            </option>

                                            <option value="DirectX 11 Compatible Sound Card">
                                                DirectX 11 Compatible Sound Card
                                            </option>

                                            <option value="DirectX 12 Compatible Sound Card">
                                                DirectX 12 Compatible Sound Card
                                            </option>
                                        </select>

                                    </div>

                                    <div class="col-4">

                                        <label for="directx_m">
                                            <strong class="text-danger">*</strong>DirectX:
                                        </label>

                                        <select name="directx_m" id="directx_m" class="form-control">

                                            <option value="">Selecione a versão do DirectX...</option>

                                            <option value="DirectX 9.0c">DirectX 9.0c</option>
                                            <option value="DirectX 10">DirectX 10</option>
                                            <option value="DirectX 11">DirectX 11</option>
                                            <option value="DirectX 12">DirectX 12</option>

                                        </select>

                                    </div>

                                    <hr class="mt-3">

                                    <!-- Recomendados -->

                                    <label for="titulo" class="mb-3 fs-4">Requisitos Recomendados:</label>


                                    <div class="col-4">

                                        <label for="gpu_r">
                                            <strong class="text-danger">*</strong>Placa de Vídeo:
                                        </label>

                                        <select name="gpu_r" id="gpu_r" class="form-control">

                                            <option value="">Selecione a placa de vídeo...</option>

                                            <option value="NVIDIA GTX 1060 6GB / AMD RX 580 8GB">
                                                NVIDIA GTX 1060 6GB / AMD RX 580 8GB
                                            </option>

                                            <option value="NVIDIA GeForce GTX 1070 8GB / AMD Radeon RX Vega 56 8GB">
                                                NVIDIA GeForce GTX 1070 8GB / AMD Radeon RX Vega 56 8GB
                                            </option>

                                            <option value="NVIDIA GTX 1080 8GB / AMD RX 5700 XT 8GB">
                                                NVIDIA GTX 1080 8GB / AMD RX 5700 XT 8GB
                                            </option>

                                            <option value="NVIDIA RTX 2060 6GB / AMD RX 6600 XT 8GB">
                                                NVIDIA RTX 2060 6GB / AMD RX 6600 XT 8GB
                                            </option>

                                            <option value="NVIDIA RTX 2070 Super 8GB / AMD RX 6700 XT 12GB">
                                                NVIDIA RTX 2070 Super 8GB / AMD RX 6700 XT 12GB
                                            </option>

                                            <option value="NVIDIA RTX 3060 8GB / AMD RX 6600 XT 8GB">
                                                NVIDIA RTX 3060 8GB / AMD RX 6600 XT 8GB
                                            </option>

                                            <option value="NVIDIA RTX 3070 8GB / AMD RX 6800 16GB">
                                                NVIDIA RTX 3070 8GB / AMD RX 6800 16GB
                                            </option>

                                            <option value="NVIDIA RTX 3080 10GB / AMD RX 6800 XT 16GB">
                                                NVIDIA RTX 3080 10GB / AMD RX 6800 XT 16GB
                                            </option>

                                            <option value="NVIDIA RTX 4070 12GB / AMD RX 7800 XT 16GB">
                                                NVIDIA RTX 4070 12GB / AMD RX 7800 XT 16GB
                                            </option>


                                        </select>

                                    </div>

                                    <div class="col-4">

                                        <label for="os_r">
                                            <strong class="text-danger">*</strong>Sistema Operacional:
                                        </label>

                                        <select name="os_r" id="os_r" class="form-control">

                                            <option value="">Selecione o Sistema Operacional...</option>

                                            <option value="Windows 7 64-bit">
                                                Windows 7 64-bit
                                            </option>

                                            <option value="Windows 8.1 64-bit">
                                                Windows 8.1 64-bit
                                            </option>

                                            <option value="Windows 10 64-bit">
                                                Windows 10 64-bit
                                            </option>

                                            <option value="Windows 11 64-bit">
                                                Windows 11 64-bit
                                            </option>

                                            <option value="Windows 10 / 11 64-bit">
                                                Windows 10 / 11 64-bit
                                            </option>

                                        </select>

                                    </div>

                                    <div class="col-4">

                                        <label for="armazenamento_r">
                                            <strong class="text-danger">*</strong>Armazenamento:
                                        </label>

                                        <select name="armazenamento_r" id="armazenamento_r" class="form-control">

                                            <option value="">Selecione o armazenamento...</option>

                                            <option value="10 GB de espaço livre">10 GB de espaço livre</option>
                                            <option value="20 GB de espaço livre">20 GB de espaço livre</option>
                                            <option value="30 GB de espaço livre">30 GB de espaço livre</option>
                                            <option value="40 GB de espaço livre">40 GB de espaço livre</option>
                                            <option value="50 GB de espaço livre">50 GB de espaço livre</option>
                                            <option value="60 GB de espaço livre">60 GB de espaço livre</option>
                                            <option value="70 GB de espaço livre">70 GB de espaço livre</option>
                                            <option value="80 GB de espaço livre">80 GB de espaço livre</option>
                                            <option value="100 GB de espaço livre">100 GB de espaço livre</option>
                                            <option value="150 GB de espaço livre">150 GB de espaço livre</option>
                                            <option value="200 GB de espaço livre">200 GB de espaço livre</option>

                                        </select>

                                    </div>

                                    <div class="col-4">

                                        <label for="cpu_r">
                                            <strong class="text-danger">*</strong>Processador:
                                        </label>

                                        <select name="cpu_r" id="cpu_r" class="form-control">

                                            <option value="">Selecione o processador...</option>

                                            <option value="Intel Core i5-9600K / AMD Ryzen 5 3600">
                                                Intel Core i5-9600K / AMD Ryzen 5 3600
                                            </option>

                                            <option value="Intel Core i7-6700K / AMD Ryzen 5 2600">
                                                Intel Core i7-6700K / AMD Ryzen 5 2600
                                            </option>

                                            <option value="Intel Core i7-7700K / AMD Ryzen 5 3600">
                                                Intel Core i7-7700K / AMD Ryzen 5 3600
                                            </option>

                                            <option value="Intel Core i7-8700K / AMD Ryzen 5 3600X">
                                                Intel Core i7-8700K / AMD Ryzen 5 3600X
                                            </option>

                                            <option value="Intel Core i7-9700K / AMD Ryzen 7 3700X">
                                                Intel Core i7-9700K / AMD Ryzen 7 3700X
                                            </option>

                                            <option value="Intel Core i7-10700K / AMD Ryzen 7 5800X">
                                                Intel Core i7-10700K / AMD Ryzen 7 5800X
                                            </option>

                                            <option value="Intel Core i7-12700K / AMD Ryzen 7 7700X">
                                                Intel Core i7-12700K / AMD Ryzen 7 7700X
                                            </option>

                                            <option value="Intel Core i9-9900K / AMD Ryzen 9 3900X">
                                                Intel Core i9-9900K / AMD Ryzen 9 3900X
                                            </option>

                                            <option value="Intel Core i9-12900K / AMD Ryzen 9 5900X">
                                                Intel Core i9-12900K / AMD Ryzen 9 5900X
                                            </option>


                                        </select>

                                    </div>

                                    <div class="col-4">

                                        <label for="ram_r">
                                            <strong class="text-danger">*</strong>Memória:
                                        </label>

                                        <select name="ram_r" id="ram_r" class="form-control">

                                            <option value="">Selecione a memória RAM...</option>

                                            <option value="4 GB RAM">4 GB RAM</option>
                                            <option value="6 GB RAM">6 GB RAM</option>
                                            <option value="8 GB RAM">8 GB RAM</option>
                                            <option value="12 GB RAM">12 GB RAM</option>
                                            <option value="16 GB RAM">16 GB RAM</option>
                                            <option value="24 GB RAM">24 GB RAM</option>
                                            <option value="32 GB RAM">32 GB RAM</option>
                                            <option value="64 GB RAM">64 GB RAM</option>

                                        </select>

                                    </div>

                                    <div class="col-4">

                                        <label for="placa_s_r">
                                            <strong class="text-danger">*</strong>Placa de Som:
                                        </label>

                                        <select name="placa_s_r" id="placa_s_r" class="form-control">

                                            <option value="">Selecione a placa de som...</option>

                                            <option value="Windows-compatible audio device">
                                                Windows-compatible audio device
                                            </option>

                                            <option value="DirectX Compatible Sound Card">
                                                DirectX Compatible Sound Card
                                            </option>

                                            <option value="Integrated Audio">
                                                Integrated Audio
                                            </option>

                                            <option value="Onboard Sound Card">
                                                Onboard Sound Card
                                            </option>

                                            <option value="DirectX 11 Compatible Sound Card">
                                                DirectX 11 Compatible Sound Card
                                            </option>

                                            <option value="DirectX 12 Compatible Sound Card">
                                                DirectX 12 Compatible Sound Card
                                            </option>
                                        </select>

                                    </div>

                                    <div class="col-4">

                                        <label for="directx_r">
                                            <strong class="text-danger">*</strong>DirectX:
                                        </label>

                                        <select name="directx_r" id="directx_r" class="form-control">

                                            <option value="">Selecione a versão do DirectX...</option>

                                            <option value="DirectX 9.0c">DirectX 9.0c</option>
                                            <option value="DirectX 10">DirectX 10</option>
                                            <option value="DirectX 11">DirectX 11</option>
                                            <option value="DirectX 12">DirectX 12</option>

                                        </select>

                                    </div>

                                </div>



                                <div class="cadastrar">

                                    <input type="hidden" name="cadastrar" value="cadastrar_produto">
                                    <input type="submit" value="Cadastrar" class="btn btn-primary btn-sm mt-3">


                                </div>





                            </div>

                        </form>

                    </div>

                </div>

            </main>
        </div>
    </div>

    <style>
        .col-1 {
            transform: translateX(500px);
        }
    </style>

    <!-- JQUERY CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <!-- jquerymask -->
    <script src="../../assets/js/jquery.mask.js"></script>
    <!-- viacep -->
    <script src="../../assets/js/vicep.js"></script>
    <!-- java -->
    <script src="../../custom/js/script.js"></script>


    <!-- mudar valores -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const custo = document.getElementById("custo");
            const lucro = document.getElementById("lucro");
            const desconto = document.getElementById("desconto");
            const precoVenda = document.getElementById("preco_venda");
            const precoPromocao = document.getElementById("preco_promocao");

            function calcular() {

                let c = parseFloat(custo.value.replace(",", ".")) || 0;
                let l = parseFloat(lucro.value.replace(",", ".")) || 0;
                let d = parseFloat(desconto.value.replace(",", ".")) || 0;

                // preço de venda
                let venda = c + (c * l / 100);
                precoVenda.value = venda > 0 ? venda.toFixed(2).replace(".", ",") : "";

                // preço promoção
                if (d > 0) {
                    let promo = venda - (venda * d / 100);
                    precoPromocao.value = promo.toFixed(2).replace(".", ",");
                } else {
                    precoPromocao.value = "";
                }
            }

            custo.addEventListener("input", calcular);
            lucro.addEventListener("input", calcular);
            desconto.addEventListener("input", calcular);

        });

        document.addEventListener("DOMContentLoaded", function() {
            const tipo = document.getElementById("tipo");
            const codigo = document.getElementById("codigo");
            const custo = document.getElementById("custo");
            const lucro = document.getElementById("lucro");
            const precoVenda = document.getElementById("preco_venda");
            const promocao = document.getElementById("promocao");
            const desconto = document.getElementById("desconto");
            const precoPromocao = document.getElementById("preco_promocao");

            function gerarCodigoAleatorio(tipoSelecionado) {
                const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                let blocos = [];

                switch (tipoSelecionado) {
                    case "0": // Steam
                        blocos = [4, 4, 4, 3];
                        codigo.maxLength = 18;
                        break;

                    case "1": // Xbox
                        blocos = [5, 5, 5, 5, 5];
                        codigo.maxLength = 29;
                        break;

                    case "2": // Playstation
                        blocos = [4, 4, 4];
                        codigo.maxLength = 14;
                        break;

                    case "3": // Nintendo
                        blocos = [4, 4, 4, 4];
                        codigo.maxLength = 19;
                        break;

                    default:
                        codigo.value = "";
                        return;
                }

                let resultado = "";

                for (let i = 0; i < blocos.length; i++) {
                    for (let j = 0; j < blocos[i]; j++) {
                        resultado += chars.charAt(Math.floor(Math.random() * chars.length));
                    }

                    if (i < blocos.length - 1) {
                        resultado += "-";
                    }
                }

                codigo.value = resultado;
            }


            // ABILITAR E DESABILITAR CAMPOS DE DESCONTO E DATA DE PROMOÇÃO
            function calcularValores() {
                let valorCusto = parseFloat(custo.value.replace(",", ".")) || 0;
                let valorLucro = parseFloat(lucro.value.replace(",", ".")) || 0;
                let valorDesconto = parseFloat(desconto.value.replace(",", ".")) || 0;

                // preço normal
                let venda = valorCusto + (valorCusto * (valorLucro / 100));
                precoVenda.value = venda.toFixed(2).replace(".", ",");

                const dataFimPromocao = document.getElementById("data_fim_promocao");

                // preço promoção
                if (promocao.value === "1") {

                    let promocional = venda - (venda * (valorDesconto / 100));
                    precoPromocao.value = promocional.toFixed(2).replace(".", ",");

                    desconto.disabled = false;
                    dataFimPromocao.disabled = false;

                } else {

                    desconto.value = "";
                    desconto.disabled = true;

                    dataFimPromocao.value = "";
                    dataFimPromocao.disabled = true;

                    precoPromocao.value = "";
                }
            }

            tipo.addEventListener("change", function() {
                gerarCodigoAleatorio(this.value);
            });

            custo.addEventListener("input", calcularValores);
            lucro.addEventListener("input", calcularValores);
            desconto.addEventListener("input", calcularValores);
            promocao.addEventListener("change", calcularValores);


            desconto.disabled = true;
            data_fim_promocao.disabled = true;



            if (tipo.value !== "") {
                gerarCodigoAleatorio(tipo.value);
            }

        });

        document.addEventListener("DOMContentLoaded", function() {

            const tipo = document.getElementById("tipo");
            const codigo = document.getElementById("codigo");

            const custo = document.getElementById("custo");
            const lucro = document.getElementById("lucro");
            const desconto = document.getElementById("desconto");
            const promocao = document.getElementById("promocao");

            const precoVenda = document.getElementById("preco_venda");
            const precoPromocao = document.getElementById("preco_promocao");

            /* ===== GERAR CÓDIGO ===== */
            function gerarCodigo(tipoSelecionado) {
                const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                let blocos = [];

                switch (tipoSelecionado) {
                    case "0":
                        blocos = [4, 4, 4, 3];
                        break; // Steam
                    case "1":
                        blocos = [5, 5, 5, 5, 5];
                        break; // Xbox
                    case "2":
                        blocos = [4, 4, 4];
                        break; // Playstation
                    case "3":
                        blocos = [4, 4, 4, 4];
                        break; // Nintendo
                    default:
                        codigo.value = "";
                        return;
                }

                let resultado = "";
                for (let i = 0; i < blocos.length; i++) {
                    for (let j = 0; j < blocos[i]; j++) {
                        resultado += chars.charAt(Math.floor(Math.random() * chars.length));
                    }
                    if (i < blocos.length - 1) resultado += "-";
                }

                codigo.value = resultado; // ✅ AQUI o código aparece na caixa
            }

            /* ===== CALCULAR PREÇOS ===== */
            function calcular() {
                let c = parseFloat(custo.value.replace(",", ".")) || 0;
                let l = parseFloat(lucro.value.replace(",", ".")) || 0;
                let d = parseFloat(desconto.value.replace(",", ".")) || 0;

                let venda = c + (c * l / 100);
                precoVenda.value = venda ? venda.toFixed(2).replace(".", ",") : "";

                if (promocao.value === "1" && d > 0) {
                    let promo = venda - (venda * d / 100);
                    precoPromocao.value = promo.toFixed(2).replace(".", ",");
                } else {
                    precoPromocao.value = "";
                }
            }

            /* ===== EVENTOS ===== */
            tipo.addEventListener("change", () => gerarCodigo(tipo.value));
            custo.addEventListener("input", calcular);
            lucro.addEventListener("input", calcular);
            desconto.addEventListener("input", calcular);
            promocao.addEventListener("change", calcular);

        });
    </script>

    <!-- REQUISITOS APARECEM SO QUANDO O TIPO STEAM FOR SELECIONADO -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const tipo = document.getElementById("tipo");
            const requisitosPc = document.getElementById("requisitos-pc");

            function verificarTipo() {

                // Steam = 0
                if (tipo.value === "0") {

                    requisitosPc.style.display = "flex";
                    requisitosPc.style.flexWrap = "wrap";

                } else {

                    requisitosPc.style.display = "none";

                    // Limpa todos os campos dos requisitos
                    requisitosPc.querySelectorAll("select").forEach(select => {
                        select.selectedIndex = 0;
                    });

                }

            }

            tipo.addEventListener("change", verificarTipo);

            verificarTipo();

        });
    </script>



</body>

</html>