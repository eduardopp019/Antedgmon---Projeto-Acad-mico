<?php

# conexao com o banco de dados #

require_once __DIR__ . "/../../conexao/conecta.php";

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
                ?>

                <div class="card">

                    <div class="card-header d-flex justify-content-between">

                        <h4 class="m-0">Novo Funcionário</h4>

                        <a href="index.php" class="btn btn-info btn-sm">

                            <i class="bi bi-arrow-left-short"></i>
                            Voltar
                        </a>

                    </div>

                    <div class="card-body">

                        <form action="acoes.php" method="post" enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-1">

                                    <img src="../../assets/img/placeholder-funcionario.png" alt="" style="max-width: 90px;" name="imagem-fun" id="imagem-fun">

                                </div>

                                <div class="col-3">

                                    <label for="foto"><strong class="text-danger">*</strong>Sua Foto:</label>
                                    <input type="file" name="foto" id="foto" class="form-control" accept="image/*" required>

                                </div>

                                <div class="col-4">
                                    <label for="nome"><strong class="text-danger">*</strong>Nome:</label>
                                    <input type="text" name="nome" id="nome" class="form-control" maxlength="40" required>
                                </div>

                                <div class="col-4 ">

                                    <label for="social">Nome Social:</label>
                                    <input type="text" name="social" id="social" class="form-control" maxlength="40">

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

                                            echo '<option value="' . $cargo['id_cargo'] . '">' . $cargo['nome'] . '</option>';
                                        }

                                        ?>

                                    </select>



                                </div>

                                <div class="col-4">

                                    <label for="RG"><strong class="text-danger">*</strong>RG:</label>

                                    <input type="text" name="rg" id="rg" class="form-control" placeholder="xx.xxx.xxx-x..." maxlength="12" required data-mask="00.000.000-A">

                                </div>

                                <div class="col-4">

                                    <label for="cpf"><strong class="text-danger">*</strong>CPF:</label>

                                    <input type="text" name="cpf" id="cpf" class="form-control" maxlength="14" placeholder="xxx.xxx.xxx-xx..." required data-mask="000.000.000-00">

                                </div>

                                <div class="col-4">

                                    <label for="cep"><strong class="text-danger">*</strong>CEP:</label>
                                    <input type="text" name="cep" id="cep" class="form-control" placeholder="xxxxx-xxx..." maxlength="9" required data-mask="00000-000">

                                </div>

                                <div class="col-4">

                                    <label for="endereco"><strong class="text-danger">*</strong>Endereço:</label>
                                    <input type="text" name="endereco" id="endereco" class="form-control" placeholder="Avenida Miguel Ignácio Curi, 111, Itaquera, São Paulo..." maxlength="70" required>

                                </div>

                                <div class="col-4">

                                    <label for="uf"><strong class="text-danger">*</strong>Estado:</label>
                                    <select name="uf" id="uf" class="form-control" required>
                                        <option value="">Selecione o estado</option>
                                        <option value="AC">AC</option>
                                        <option value="AL">AL</option>
                                        <option value="AP">AP</option>
                                        <option value="AM">AM</option>
                                        <option value="BA">BA</option>
                                        <option value="CE">CE</option>
                                        <option value="DF">DF</option>
                                        <option value="ES">ES</option>
                                        <option value="GO">GO</option>
                                        <option value="MA">MA</option>
                                        <option value="MT">MT</option>
                                        <option value="MS">MS</option>
                                        <option value="MG">MG</option>
                                        <option value="PA">PA</option>
                                        <option value="PB">PB</option>
                                        <option value="PR">PR</option>
                                        <option value="PE">PE</option>
                                        <option value="PI">PI</option>
                                        <option value="RJ">RJ</option>
                                        <option value="RN">RN</option>
                                        <option value="RS">RS</option>
                                        <option value="RO">RO</option>
                                        <option value="RR">RR</option>
                                        <option value="SC">SC</option>
                                        <option value="SP">SP</option>
                                        <option value="SE">SE</option>
                                        <option value="TO">TO</option>
                                    </select>

                                </div>

                                <div class="col-4">

                                    <label for="cidade"><strong class="text-danger">*</strong>Cidade:</label>
                                    <input type="text" name="cidade" id="cidade" class="form-control" placeholder="Piracicaba..." maxlength="40" required>

                                </div>

                                <div class="col-4">

                                    <label for="bairro"><strong class="text-danger">*</strong>Bairro:</label>
                                    <input type="text" name="bairro" id="bairro" class="form-control" placeholder="Artemis..." maxlength="30" required>

                                </div>

                                <div class="col-4">

                                    <label for="numero"><strong class="text-danger">*</strong>Número:</label>
                                    <input type="text" name="numero" id="numero" class="form-control" maxlength="9999" required></input>



                                </div>

                                <div class="col-4">

                                    <label for="complemento">Complemento:</label>
                                    <input type="text" name="complemento" id="complemento" class="form-control" placeholder="Casa..." maxlength="100">

                                </div>

                                <div class="col-4">

                                    <label for="sexo"><strong class="text-danger">*</strong>Sexo:</label>
                                    <select name="sexo" id="sexo" class="form-control" required>

                                        <option value="m">Masculino</option>
                                        <option value="f">Feminino</option>
                                        <option value="n">Não informado</option>

                                    </select>


                                </div>

                                <div class="col-4">

                                    <label for="estado-civil"><strong class="text-danger">*</strong>Estado Civil:</label>
                                    <select name="estado-civil" id="estado-civil" class="form-control" required>

                                        <option value="Solteiro(a)">Solteiro(a)</option>
                                        <option value="Separado(a)">Separado(a)</option>
                                        <option value="Casado(a)">Casado(a)</option>
                                        <option value="Divorciado(a)">Divorciado(a)</option>
                                        <option value="Viuvo(a)">Viúvo(a)</option>


                                    </select>

                                </div>

                                <div class="col-4">

                                    <label for="datanascimento"><strong class="text-danger">*</strong>Data Nascimento:</label>

                                    <input type="date" name="datanascimento" id="datanascimento" class="form-control" required>

                                </div>

                                <div class="col-4">

                                    <label for="status">Status:</label>
                                    <select name="status" id="status" class="form-control" disabled>

                                        <option value="1">Ativo</option>
                                        <option value="0">Inativo</option>



                                    </select>


                                </div>

                                <div class="col-4">

                                    <label for="email"><strong class="text-danger">*</strong>Email:</label>
                                    <input type="email" name="email" id="email" class="form-control" maxlength="50" required>

                                </div>

                                <div class="col-4">

                                    <label for="senha"><strong class="text-danger">*</strong>Senha:</label>
                                    <input type="text" name="senha" id="senha" class="form-control" maxlength="8" required>

                                </div>

                                <div class="col-4   ">

                                    <label for="usuario"><strong class="text-danger">*</strong>Usuario:</label>
                                    <input type="text" name="usuario" id="usuario" class="form-control" maxlength="15" required>

                                </div>

                                <div class="col-4">

                                    <label for="salario"><strong class="text-danger">*</strong>Salário:</label>
                                    <input type="text" name="salario" id="salario" class="form-control" placeholder="R$ 0,00">

                                </div>

                                <div class="col-4">

                                    <label for="telefone"><strong class="text-danger">*</strong>Telefone Redidencial:</label>
                                    <input type="text" name="telefone" id="telefone" class="form-control" placeholder="(xx)xxxx-xxxx..." data-mask="(00)0000-0000" required>

                                </div>

                                <div class="col-4   ">

                                    <label for="telefone-c"><strong class="text-danger">*</strong>Telefone Celular:</label>
                                    <input type="text" name="telefone-c" id="telefone-c" class="form-control" placeholder="(xx)xxxxx-xxxx..." required data-mask="(00)00000-0000">

                                    <input type="submit" value="Cadastrar" class="btn btn-primary btn-sm mt-3">
                                    <input type="hidden" name="cadastrar" value="cadastrar_funcionario">
                                </div>

                                <div class="col-4">

                                    <label for="tipo-acesso"><strong class="text-danger">*</strong>Tipo de Acesso:</label>
                                    <select name="tipo-acesso" id="tipo-acesso" class="form-control">

                                        <option value="0">Administrador</option>
                                        <option value="1">Usuario Comum</option>


                                    </select>


                                </div>








                            </div>

                        </form>

                    </div>

                </div>

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