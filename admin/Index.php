<?php

## Iniciando uma sessão
if (!isset($_SESSION)) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Antedgmon-Login</title>

    <meta name="author" content="Eduardo Pereira">

    <!-- FontAwesome (icones) -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- icones bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.s">

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- css -->
    <link rel="stylesheet" href="../custom/css/login.css">



</head>

<body>
    <div class="icon-cascade" id="cascadeContainer"></div>
    <div class="login-container">

        <main class="form-signin text-center">
            <div class="card card-login p-4">
                <div class="card-body">
                    <h2 class="text-center mb-4 c-gradient fs-1">Login</h2>

                    <form action="Login.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label small">Usuário</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                <input type="text" class="form-control mb-2" name="usuario" placeholder="Usuário" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small">Senha</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" class="form-control" name="senha" placeholder="Senha" required>
                            </div>
                        </div>

                        <button type="submit" class="entrar btn btn-login w-68 mb-3 c-gradient">
                            ENTRAR NA CONTA
                        </button>
                    </form>
                </div>

                <div class="pt-2 c-gradient">
                    <?php
                    ///VAZIO
                    if (isset($_SESSION['loginVazio'])) {

                        echo $_SESSION['loginVazio'];
                        unset($_SESSION['loginVazio']);
                    }
                    //ERRO
                    if (isset($_SESSION['loginERRO'])) {

                        echo $_SESSION['loginERRO'];
                        unset($_SESSION['loginERRO']);
                    }
                    //NAO AUTORIZADO
                    if (isset($_SESSION['naoAutorizado'])) {

                        echo $_SESSION['naoAutorizado'];
                        unset($_SESSION['naoAutorizado']);
                    }


                    //NAO ADM
                    if (isset($_SESSION['naoADM'])) {
                        echo $_SESSION['naoADM'];
                        unset($_SESSION['naoADM']);
                    }

                    //lOGoff
                    if (isset($_SESSION['LogOff'])) {
                        echo $_SESSION['LogOff'];
                        unset($_SESSION['LogOff']);
                    }



                    ?>
                </div>


                <div class="copy text-center mt-2 text-secondary" style="font-size: 0.8rem;">
                    &copy; 2026 Antedgmon Sua Loja de Games. Todos os direitos reservados.
                </div>
            </div>


    </div>
    
    </main>

    <!-- JQUERY CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <!-- JAVA -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- cascata -->
    <script>
        function createIcons() {
            const container = document.getElementById('cascadeContainer');
            const iconCount = 100; // Quantidade de ícones na tela

            for (let i = 0; i < iconCount; i++) {
                const icon = document.createElement('i');
                icon.className = 'fa-solid fa-gamepad falling-icon';

                // Posição horizontal aleatória (0 a 100%)
                icon.style.left = Math.random() * 100 + 'vw';

                // Atraso aleatório para não caírem todos juntos
                icon.style.animationDelay = Math.random() * 5 + 's';

                // Velocidade aleatória (entre 3 e 8 segundos)
                icon.style.animationDuration = (Math.random() * 5 + 3) + 's';

                // Tamanho aleatório para dar profundidade
                icon.style.opacity = Math.random() * 0.3;
                icon.style.fontSize = (Math.random() * 1 + 1) + 'rem';

                container.appendChild(icon);
            }
        }

        // Inicia a cascata ao carregar a página
        createIcons();
    </script>
</body>
