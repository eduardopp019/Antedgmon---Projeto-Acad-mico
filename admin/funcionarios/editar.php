<?php

# conexao com o banco de dados #

require_once __DIR__ . "/../../conexao/conecta.php";

//if (!isset($_SESSION)) {
//    session_start();
//}

include_once "../Usuario_Admin.php";

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
                if (isset($_GET['id_funcionario']) &&  $_GET['id_funcionario'] != '') {

                    $id = $_GET['id_funcionario'];

                    $sql = "SELECT * FROM funcionarios WHERE id_funcionario = $id";
                    $query = mysqli_query($conexao, $sql);
                    $funcionario = mysqli_fetch_assoc($query);

                ?>


                    <div class="card">

                        <div class="card-header d-flex justify-content-between">

                            <h4 class="m-0">Editar Funcionário</h4>

                            <a href="index.php" class="btn btn-info btn-sm">

                                <i class="bi bi-arrow-left-short"></i>
                                Voltar
                            </a>

                        </div>

                        <div class="card-body">

                            <form action="acoes.php" method="post" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-1">

                                        <?php
                                        if ($funcionario['foto'] != '') {
                                            echo '<img src="../../images/' . $funcionario['foto'] . '" alt="Foto do Funcionario" class="foto_fun img-fluid justify-content-center " id="imagem" >
                                                    ';
                                        } else {
                                            echo '<img src="../../assets/img/placeholder-funcionario.png" alt="Foto do funcionario" class="foto_fun img-fluid justify-content-center " id="imagem" >';
                                        }
                                        ?>

                                    </div>

                                    <div class="col-3">

                                        <label for="foto"><strong class="text-danger">*</strong>Sua Foto:</label>
                                        <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                                        <small class="current-file">Arquivo atual: <?= htmlspecialchars($funcionario['foto'] ?: 'nenhum') ?></small>

                                    </div>

                                    <div class="col-4">
                                        <label for="nome"><strong class="text-danger">*</strong>Nome:</label>
                                        <input type="text" name="nome" id="nome" class="form-control" maxlength="40" value="<?php echo $funcionario['nome'] ?>" required>
                                    </div>

                                    <div class="col-4 ">

                                        <label for="social">Nome Social:</label>
                                        <input type="text" name="social" id="social" class="form-control" maxlength="40" value="<?php echo $funcionario['nome_social'] ?>">

                                    </div>

                                    <hr class="mt-3">

                                    <div class="col-4">

                                        <label for="cargo"><strong class="text-danger">*</strong>Cargo:</label>
                                        <select name="cargo" id="cargo" class="form-control" required>

                                            <option value="">-- Selecionar --</option>

                                            <?php

                                            $sql_cargo = "SELECT id_cargo, nome FROM cargo WHERE status =1";

                                            $query_cargo = mysqli_query($conexao, $sql_cargo);

                                            foreach ($query_cargo as $cargo) {

                                            ?>
                                                <option value="<?php echo $cargo['id_cargo'] ?>"

                                                    <?php if ($funcionario['id_cargo'] == $cargo['id_cargo']) echo 'selected' ?>>
                                                    <?php echo $cargo['nome'] ?>

                                                </option>
                                            <?php } ?>


                                        </select>



                                    </div>

                                    <div class="col-4">

                                        <label for="RG"><strong class="text-danger">*</strong>RG:</label>

                                        <input type="text" name="rg" id="rg" class="form-control" placeholder="xx.xxx.xxx-x..." maxlength="12" required data-mask="00.000.000-A" value="<?php echo $funcionario['rg'] ?>">

                                    </div>

                                    <div class="col-4">

                                        <label for="cpf"><strong class="text-danger">*</strong>CPF:</label>

                                        <input type="text" name="cpf" id="cpf" class="form-control" maxlength="14" placeholder="xxx.xxx.xxx-xx..." required data-mask="000.000.000-00" value="<?php echo $funcionario['cpf'] ?>">

                                    </div>

                                    <div class="col-4">

                                        <label for="cep"><strong class="text-danger">*</strong>CEP:</label>
                                        <input type="text" name="cep" id="cep" class="form-control" placeholder="xxxxx-xxx..." maxlength="9" required data-mask="00000-000" value="<?php echo $funcionario['cep'] ?>">

                                    </div>

                                    <div class="col-4">

                                        <label for="endereco"><strong class="text-danger">*</strong>Endereço:</label>
                                        <input type="text" name="endereco" id="endereco" class="form-control" placeholder="Avenida Miguel Ignácio Curi, 111, Itaquera, São Paulo..." maxlength="70" required value="<?php echo $funcionario['endereco'] ?>">

                                    </div>

                                    <div class="col-4">

                                        <label for="uf"><strong class="text-danger">*</strong>Estado:</label>
                                        <select name="uf" id="uf" class="form-control" required>
                                            <option value="">Selecione o estado</option>
                                            <option value="AC" <?php if ($funcionario['estado'] == 'AC') echo 'selected' ?>>AC</option>
                                            <option value="AL" <?php if ($funcionario['estado'] == 'AL') echo 'selected' ?>>AL</option>
                                            <option value="AP" <?php if ($funcionario['estado'] == 'AP') echo 'selected' ?>>AP</option>
                                            <option value="AM" <?php if ($funcionario['estado'] == 'AM') echo 'selected' ?>>AM</option>
                                            <option value="BA" <?php if ($funcionario['estado'] == 'BA') echo 'selected' ?>>BA</option>
                                            <option value="CE" <?php if ($funcionario['estado'] == 'CE') echo 'selected' ?>>CE</option>
                                            <option value="DF" <?php if ($funcionario['estado'] == 'DF') echo 'selected' ?>>DF</option>
                                            <option value="ES" <?php if ($funcionario['estado'] == 'ES') echo 'selected' ?>>ES</option>
                                            <option value="GO" <?php if ($funcionario['estado'] == 'GO') echo 'selected' ?>>GO</option>
                                            <option value="MA" <?php if ($funcionario['estado'] == 'MA') echo 'selected' ?>>MA</option>
                                            <option value="MT" <?php if ($funcionario['estado'] == 'MT') echo 'selected' ?>>MT</option>
                                            <option value="MS" <?php if ($funcionario['estado'] == 'MS') echo 'selected' ?>>MS</option>
                                            <option value="MG" <?php if ($funcionario['estado'] == 'MG') echo 'selected' ?>>MG</option>
                                            <option value="PA" <?php if ($funcionario['estado'] == 'PA') echo 'selected' ?>>PA</option>
                                            <option value="PB" <?php if ($funcionario['estado'] == 'PB') echo 'selected' ?>>PB</option>
                                            <option value="PR" <?php if ($funcionario['estado'] == 'PR') echo 'selected' ?>>PR</option>
                                            <option value="PE" <?php if ($funcionario['estado'] == 'PE') echo 'selected' ?>>PE</option>
                                            <option value="PI" <?php if ($funcionario['estado'] == 'PI') echo 'selected' ?>>PI</option>
                                            <option value="RJ" <?php if ($funcionario['estado'] == 'RJ') echo 'selected' ?>>RJ</option>
                                            <option value="RN" <?php if ($funcionario['estado'] == 'RN') echo 'selected' ?>>RN</option>
                                            <option value="RS" <?php if ($funcionario['estado'] == 'RS') echo 'selected' ?>>RS</option>
                                            <option value="RO" <?php if ($funcionario['estado'] == 'RO') echo 'selected' ?>>RO</option>
                                            <option value="RR" <?php if ($funcionario['estado'] == 'RR') echo 'selected' ?>>RR</option>
                                            <option value="SC" <?php if ($funcionario['estado'] == 'SC') echo 'selected' ?>>SC</option>
                                            <option value="SP" <?php if ($funcionario['estado'] == 'SP') echo 'selected' ?>>SP</option>
                                            <option value="SE" <?php if ($funcionario['estado'] == 'SE') echo 'selected' ?>>SE</option>
                                            <option value="TO" <?php if ($funcionario['estado'] == 'TO') echo 'selected' ?>>TO</option>
                                        </select>

                                    </div>

                                    <div class="col-4">

                                        <label for="cidade"><strong class="text-danger">*</strong>Cidade:</label>
                                        <input type="text" name="cidade" id="cidade" class="form-control" placeholder="Piracicaba..." maxlength="40" value="<?php echo $funcionario['cidade'] ?>" required>

                                    </div>

                                    <div class="col-4">

                                        <label for="bairro"><strong class="text-danger">*</strong>Bairro:</label>
                                        <input type="text" name="bairro" id="bairro" class="form-control" placeholder="Artemis..." maxlength="30" value="<?php echo $funcionario['bairro'] ?>" required>

                                    </div>

                                    <div class="col-4">

                                        <label for="numero"><strong class="text-danger">*</strong>Número:</label>
                                        <input type="text" name="numero" id="numero" class="form-control" maxlength="6" value="<?php echo $funcionario['numero'] ?>" required></input>



                                    </div>

                                    <div class="col-4">

                                        <label for="complemento">Complemento:</label>
                                        <input type="text" name="complemento" id="complemento" class="form-control" placeholder="Casa..." maxlength="100" value="<?php echo $funcionario['complemento'] ?>">


                                    </div>

                                    <div class="col-4">

                                        <label for="sexo"><strong class="text-danger">*</strong>Sexo:</label>
                                        <select name="sexo" id="sexo" class="form-control" required>

                                            <option value="F" <?php if ($funcionario['sexo'] == 'F') echo 'selected' ?>>Feminino</option>
                                            <option value="M" <?php if ($funcionario['sexo'] == 'M') echo 'selected' ?>>Masculino</option>
                                            <option value="N" <?php if ($funcionario['sexo'] == 'N') echo 'selected' ?>>Não iformado</option>

                                        </select>


                                    </div>

                                    <div class="col-4">

                                        <label for="estado-civil"><strong class="text-danger">*</strong>Estado Civil:</label>
                                        <select name="estado-civil" id="estado-civil" class="form-control" required>

                                            <option value="solteiro(a)" <?php if ($funcionario['estado_civil'] == 'solteiro(a)') echo 'selected' ?>>Solteiro(a)</option>
                                            <option value="casado(a)" <?php if ($funcionario['estado_civil'] == 'casado(a)') echo 'selected' ?>>Casado(a)</option>
                                            <option value="separado(a)" <?php if ($funcionario['estado_civil'] == 'separado(a)') echo 'selected' ?>>Separado(a)</option>
                                            <option value="divorciado(a)" <?php if ($funcionario['estado_civil'] == 'divorciado(a)') echo 'selected' ?>>Divorciado(a)</option>
                                            <option value="viuvo(a)" <?php if ($funcionario['estado_civil'] == 'viuvo(a)') echo 'selected' ?>>Viuvo(a)</option>


                                        </select>

                                    </div>

                                    <div class="col-4">

                                        <label for="datanascimento"><strong class="text-danger">*</strong>Data Nascimento:</label>

                                        <input type="date" name="datanascimento" id="datanascimento" class="form-control" value="<?php echo $funcionario['data_nascimento'] ?>" required>

                                    </div>

                                    <div class="col-4">

                                        <label for="status">Status:</label>
                                        <select name="status" id="status" class="form-control">

                                            <option value="1" <?php if ($funcionario['status'] == '1') echo 'selected' ?>>Ativo</option>
                                            <option value="0" <?php if ($funcionario['status'] == '0') echo 'selected' ?>>Inativo</option>



                                        </select>


                                    </div>

                                    <div class="col-4">

                                        <label for="email"><strong class="text-danger">*</strong>Email:</label>
                                        <input type="email" name="email" id="email" class="form-control" maxlength="50" value="<?php echo $funcionario['email'] ?>" required>

                                    </div>

                                    <div class="col-4">

                                        <label for="senha"><strong class="text-danger">*</strong>Senha:</label>
                                        <input type="text" name="senha" id="senha" class="form-control" maxlength="8" value="<?php echo $funcionario['senha'] ?>" required>

                                    </div>

                                    <div class="col-4   ">

                                        <label for="usuario"><strong class="text-danger">*</strong>Usuario:</label>
                                        <input type="text" name="usuario" id="usuario" class="form-control" maxlength="15" value="<?php echo $funcionario['usuario'] ?>" required>

                                    </div>

                                    <div class="col-4">

                                        <label for="salario"><strong class="text-danger">*</strong>Salário:</label>
                                        <input type="text" name="salario" id="salario" class="form-control" placeholder="R$ 0,00" value="<?php echo $funcionario['salario'] ?>">

                                    </div>

                                    <div class="col-4">

                                        <label for="telefone"><strong class="text-danger">*</strong>Telefone Redidencial:</label>
                                        <input type="text" name="telefone" id="telefone" class="form-control" placeholder="(xx)xxxx-xxxx..." data-mask="(00)0000-0000" value="<?php echo $funcionario['telefone_residencial'] ?>">

                                    </div>

                                    <div class="col-4   ">

                                        <label for="telefone_c"><strong class="text-danger">*</strong>Telefone Celular:</label>
                                        <input type="text" name="telefone_c" id="telefone_c" class="form-control" placeholder="(xx)xxxxx-xxxx..." required data-mask="(00)00000-0000" value="<?php echo $funcionario['telefone_celular'] ?>">

                                    </div>

                                    <div class="col-4">

                                        <label for="tipo-acesso"><strong class="text-danger">*</strong>Tipo de Acesso:</label>
                                        <select name="tipo-acesso" id="tipo-acesso" class="form-control">

                                            <option value="0" <?php if ($funcionario['tipo_acesso'] == '0') echo 'selected' ?>>Administrador</option>
                                            <option value="1" <?php if ($funcionario['tipo_acesso'] == '1') echo 'selected' ?>>Usuario Comum</option>


                                        </select>


                                    </div>
                                    <div class="col-12 mt-2 mt-2">
                                        <input type="hidden" name="editar" value="editar_funcionario">
                                        <input type="hidden" name="id_funcionario" value="<?php echo $id ?>">
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

    <!-- Máscara para o campo salário -->
    <script>
        document.getElementById("salario").addEventListener("input", function() {
            let valor = this.value;

            // Remove tudo que não for número
            valor = valor.replace(/\D/g, "");

            if (valor.length === 0) {
                this.value = "";
                return;
            }

            // Converte para número com 2 casas
            let numero = parseFloat(valor) / 100;

            // Formata pt-BR com milhar e vírgula
            this.value = numero.toLocaleString("pt-BR", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        });
    </script>


</body>

</html>
