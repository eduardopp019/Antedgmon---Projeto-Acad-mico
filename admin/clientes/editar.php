<?php

# conexao com o banco de dados #

require_once __DIR__ . "/../../conexao/conecta.php";
// if (!isset($_SESSION)) {
//     session_start();
// }

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
                if (isset($_GET['id_cliente']) &&  $_GET['id_cliente'] != '') {

                    $id = $_GET['id_cliente'];

                    $sql = "SELECT * FROM clientes WHERE id_cliente = $id";
                    $query = mysqli_query($conexao, $sql);
                    $cliente = mysqli_fetch_assoc($query);
                ?>

                    <div class="card">

                        <div class="card-header d-flex justify-content-between">

                            <h4 class="m-0">Novo Cliente</h4>

                            <a href="index.php" class="btn btn-info btn-sm">

                                <i class="bi bi-arrow-left-short"></i>
                                Voltar
                            </a>

                        </div>

                        <div class="card-body">

                            <form action="acoes.php" method="post" enctype="multipart/form-data">

                                <div class="row">



                                    <div class="col-4">
                                        <label for="nome"><strong class="text-danger">*</strong>Nome:</label>
                                        <input type="text" name="nome" id="nome" class="form-control" maxlength="40" required value="<?php echo $cliente['nome'] ?>">
                                    </div>


                                    <div class="col-4">

                                        <label for="cpf"><strong class="text-danger">*</strong>CPF:</label>

                                        <input type="text" name="cpf" id="cpf" class="form-control" maxlength="14" placeholder="xxx.xxx.xxx-xx..." required data-mask="000.000.000-00" value="<?php echo $cliente['cpf'] ?>">

                                    </div>

                                    <div class="col-4">

                                        <label for="RG">RG:</label>

                                        <input type="text" name="rg" id="rg" class="form-control" placeholder="xx.xxx.xxx-x..." maxlength="12" data-mask="00.000.000-A" value="<?php echo $cliente['rg'] ?>">

                                    </div>



                                    <hr class="mt-3">

                                    <div class="col-4">

                                        <label for="cep"><strong class="text-danger">*</strong>CEP:</label>
                                        <input type="text" name="cep" id="cep" class="form-control" placeholder="xxxxx-xxx..." maxlength="9" required data-mask="00000-000" value="<?php echo $cliente['cep'] ?>">

                                    </div>

                                    <div class="col-4">

                                        <label for="endereco"><strong class="text-danger">*</strong>Endereço:</label>
                                        <input type="text" name="endereco" id="endereco" class="form-control" placeholder="Avenida Miguel Ignácio Curi, 111, Itaquera, São Paulo..." maxlength="70" required value="<?php echo $cliente['endereco'] ?>">

                                    </div>

                                    <div class="col-4">

                                        <label for="uf"><strong class="text-danger">*</strong>Estado:</label>
                                        <select name="uf" id="uf" class="form-control" required>
                                            <option value="">Selecione o estado</option>
                                            <option value="AC" <?php if ($cliente['estado'] == 'AC') echo 'selected' ?>>AC</option>
                                            <option value="AL" <?php if ($cliente['estado'] == 'AL') echo 'selected' ?>>AL</option>
                                            <option value="AP" <?php if ($cliente['estado'] == 'AP') echo 'selected' ?>>AP</option>
                                            <option value="AM" <?php if ($cliente['estado'] == 'AM') echo 'selected' ?>>AM</option>
                                            <option value="BA" <?php if ($cliente['estado'] == 'BA') echo 'selected' ?>>BA</option>
                                            <option value="CE" <?php if ($cliente['estado'] == 'CE') echo 'selected' ?>>CE</option>
                                            <option value="DF" <?php if ($cliente['estado'] == 'DF') echo 'selected' ?>>DF</option>
                                            <option value="ES" <?php if ($cliente['estado'] == 'ES') echo 'selected' ?>>ES</option>
                                            <option value="GO" <?php if ($cliente['estado'] == 'GO') echo 'selected' ?>>GO</option>
                                            <option value="MA" <?php if ($cliente['estado'] == 'MA') echo 'selected' ?>>MA</option>
                                            <option value="MT" <?php if ($cliente['estado'] == 'MT') echo 'selected' ?>>MT</option>
                                            <option value="MS" <?php if ($cliente['estado'] == 'MS') echo 'selected' ?>>MS</option>
                                            <option value="MG" <?php if ($cliente['estado'] == 'MG') echo 'selected' ?>>MG</option>
                                            <option value="PA" <?php if ($cliente['estado'] == 'PA') echo 'selected' ?>>PA</option>
                                            <option value="PB" <?php if ($cliente['estado'] == 'PB') echo 'selected' ?>>PB</option>
                                            <option value="PR" <?php if ($cliente['estado'] == 'PR') echo 'selected' ?>>PR</option>
                                            <option value="PE" <?php if ($cliente['estado'] == 'PE') echo 'selected' ?>>PE</option>
                                            <option value="PI" <?php if ($cliente['estado'] == 'PI') echo 'selected' ?>>PI</option>
                                            <option value="RJ" <?php if ($cliente['estado'] == 'RJ') echo 'selected' ?>>RJ</option>
                                            <option value="RN" <?php if ($cliente['estado'] == 'RN') echo 'selected' ?>>RN</option>
                                            <option value="RS" <?php if ($cliente['estado'] == 'RS') echo 'selected' ?>>RS</option>
                                            <option value="RO" <?php if ($cliente['estado'] == 'RO') echo 'selected' ?>>RO</option>
                                            <option value="RR" <?php if ($cliente['estado'] == 'RR') echo 'selected' ?>>RR</option>
                                            <option value="SC" <?php if ($cliente['estado'] == 'SC') echo 'selected' ?>>SC</option>
                                            <option value="SP" <?php if ($cliente['estado'] == 'SP') echo 'selected' ?>>SP</option>
                                            <option value="SE" <?php if ($cliente['estado'] == 'SE') echo 'selected' ?>>SE</option>
                                            <option value="TO" <?php if ($cliente['estado'] == 'TO') echo 'selected' ?>>TO</option>
                                        </select>


                                    </div>

                                    <div class="col-4">

                                        <label for="cidade"><strong class="text-danger">*</strong>Cidade:</label>
                                        <input type="text" name="cidade" id="cidade" class="form-control" placeholder="Piracicaba..." maxlength="40" required value="<?php echo $cliente['cidade'] ?>">

                                    </div>

                                    <div class="col-4">

                                        <label for="bairro"><strong class="text-danger">*</strong>Bairro:</label>
                                        <input type="text" name="bairro" id="bairro" class="form-control" placeholder="Artemis..." maxlength="30" required value="<?php echo $cliente['bairro'] ?>">

                                    </div>

                                    <div class="col-4   ">

                                        <label for="numero"><strong class="text-danger">*</strong>Número:</label>
                                        <input type="text" name="numero" id="numero" class="form-control" maxlength="4" required value="<?php echo $cliente['numero'] ?>">



                                    </div>

                                    <div class="col-4">

                                        <label for="complemento">Complemento:</label>
                                        <input type="text" name="complemento" id="complemento" class="form-control" placeholder="Casa..." maxlength="100" value="<?php echo $cliente['complemento'] ?>">

                                    </div>

                                    <div class="col-4">

                                        <label for="sexo"><strong class="text-danger">*</strong>Sexo:</label>
                                        <select name="sexo" id="sexo" class="form-control" required>

                                            <option value="m" <?php if ($cliente['sexo'] == 'm') echo 'selected' ?>>Masculino</option>
                                            <option value="f" <?php if ($cliente['sexo'] == 'f') echo 'selected' ?>>Feminino</option>
                                            <option value="n" <?php if ($cliente['sexo'] == 'n') echo 'selected' ?>>Não informado</option>

                                        </select>


                                    </div>

                                    <div class="col-4">

                                        <label for="datanascimento"><strong class="text-danger">*</strong>Data Nascimento:</label>

                                        <input type="date" name="datanascimento" id="datanascimento" class="form-control" required value="<?php echo $cliente['data_nascimento'] ?>">

                                    </div>

                                    <hr class="mt-4">



                                    <div class="col-4   ">

                                        <label for="usuario"><strong class="text-danger">*</strong>Usuario:</label>
                                        <input type="text" name="usuario" id="usuario" class="form-control" maxlength="15" required value="<?php echo $cliente['usuario'] ?>">

                                    </div>

                                    <div class="col-4">

                                        <label for="email"><strong class="text-danger">*</strong>Email:</label>
                                        <input type="email" name="email" id="email" class="form-control" maxlength="50" required value="<?php echo $cliente['email'] ?>">

                                    </div>

                                    <div class="col-4">

                                        <label for="senha"><strong class="text-danger">*</strong>Senha:</label>
                                        <input type="text" name="senha" id="senha" class="form-control" maxlength="8" required value="<?php echo $cliente['senha'] ?>">

                                    </div>



                                    <div class="col-4">

                                        <label for="telefonec"><strong class="text-danger">*</strong>Telefone Celular:</label>
                                        <input type="text" name="telefone" id="telefone" class="form-control" placeholder="(xx)xxxxx-xxxx..." required data-mask="(00)00000-0000" value="<?php echo $cliente['telefone'] ?>">


                                    </div>

                                    <div class="col-4">

                                        <label for="status">Status:</label>
                                        <select name="status" id="status" class="form-control">

                                            <option value="1" <?php if ($cliente['status'] == 1) echo 'selected' ?>>Ativo</option>
                                            <option value="0" <?php if ($cliente['status'] == 0) echo 'selected' ?>>Inativo</option>



                                        </select>


                                    </div>

                                    <div class="col-12 mt-2 mt-2">
                                        <input type="hidden" name="editar" value="editar_cliente">
                                        <input type="hidden" name="id_cliente" value="<?php echo $id ?>">
                                        <input type="submit" value="Atualizar" class="botao btn btn-secondary mt-3">
                                    </div>





                                </div>

                            </form>

                        </div>

                    </div>
                <?php
                } else {
                    echo '<div class="alert alert-danger" role="alert">
                        Nenhum registro encontrado!</div>';
                }
                ?>

            </main>
        </div>
    </div>

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
</body>

</html>