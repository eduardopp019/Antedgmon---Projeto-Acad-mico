<!-- INICIO RODAPÉ -->
<section id="rodape" class="py-5">
    <div class="container">
        <div class="fundo-rodape p-4 p-md-5 mb-4">
            <div class="row gy-4">

                <div class="col-lg-3 col-md-6">
                    <div>
                        <div class="logo-rodape mb-4">
                            <i class="fa-brands fa-gg fa-2x me-2"></i>
                            <span class="fw-bold text-uppercase fs-5">Antedgmon</span>
                        </div>
                    </div>
                    <div class="rodape-info-idioma d-flex gap-2 mt-auto">
                        <a href="#" class="btn btn-sm btn-light-custom"><i class="fa-solid fa-language me-1"></i>
                            Português</a>
                        <a href="#" class="btn btn-sm btn-light-custom"><i class="fa-solid fa-flag me-1"></i>
                            Brasil</a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="fw-bold mb-3">Institucional</h5>
                    <ul class="list-unstyled lista-area">
                        <li><a href="#">Sobre</a></li>
                        <li><a href="#">Carreiras</a></li>
                        <li><a href="#">Seu jogo na Antedgmon</a></li>
                        <li><a href="#">Antedgmon Co-op</a></li>
                        <li><a href="#">Segurança</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="fw-bold mb-3">Ajuda</h5>
                    <ul class="list-unstyled lista-area">
                        <li><a href="#">Suporte</a></li>
                        <li><a href="#">Termos de uso</a></li>
                        <li><a href="#">Política de reembolso</a></li>
                        <li><a href="#">Política de privacidade</a></li>
                        <li><a href="#">Procon/SP</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 d-flex justify-content-md-end align-items-start">
                    <div class="social-media">
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-discord"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <hr class="opacity-25 my-4">
        <div class="aviso-educacional" role="note" aria-label="Informacao sobre o projeto">
            <div class="aviso-educacional__texto">
                <i class="fa-solid fa-graduation-cap" aria-hidden="true"></i>
                <p><strong>Projeto educacional</strong><span>Desenvolvido para fins de aprendizagem.</span></p>
            </div>
            <img class="aviso-educacional__logo" src="images/logo-senac.png" alt="Senac">
        </div>

        <hr class="opacity-25 my-4">
        <div class="row align-items-center gy-3" id="copy">
            <div class="col-md-6">
                <div class="logo-rodape mb-0">
                    <i class="fa-brands fa-gg me-2 c-gradient"></i>
                    <span id="namelogo" class="c-gradient">Antedgmon</span>
                </div>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="mb-0 small opacity-75 c-gradient">&copy; 2026 Antedgmon. Todos os direitos reservados.
                    Desenvolvido
                    por Eduardo Pereira.</p>
            </div>
        </div>
    </div>
</section>
<!-- FIM rodape -->

<!-- bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    (() => {
        const topo = document.getElementById('TOPO');
        const pontoParaCompactar = 140;
        const pontoParaRestaurar = 60;

        function atualizarTopo() {
            const compacto = topo.classList.contains('scrolled');

            // Usa dois limites para a mudança de altura do cabeçalho não
            // alternar a classe repetidamente no mesmo ponto da rolagem.
            if (!compacto && window.scrollY > pontoParaCompactar) {
                topo.classList.add('scrolled');
            } else if (compacto && window.scrollY < pontoParaRestaurar) {
                topo.classList.remove('scrolled');
            }
        }

        window.addEventListener('scroll', atualizarTopo, { passive: true });
        atualizarTopo();
    })();
</script>
