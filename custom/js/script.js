document.getElementById('foto').addEventListener('change', function (event) {

    let foto = event.target.files[0];

    if (foto) {

        document.getElementById('imagem').src = URL.createObjectURL(foto);

    }

})

document.getElementById('foto2').addEventListener('change', function (event) {

    let foto2 = event.target.files[0];

    if (foto2) {

        document.getElementById('imagem2').src = URL.createObjectURL(foto2);

    }

})
document.getElementById('foto3').addEventListener('change', function (event) {

    let foto3 = event.target.files[0];

    if (foto3) {

        document.getElementById('imagem3').src = URL.createObjectURL(foto3);

    }

})
document.getElementById('foto4').addEventListener('change', function (event) {

    let foto4 = event.target.files[0];

    if (foto4) {

        document.getElementById('imagem4').src = URL.createObjectURL(foto4);

    }

})
document.getElementById('foto_bg').addEventListener('change', function (event) {

    let foto_bg = event.target.files[0];

    if (foto_bg) {

        document.getElementById('imagem_bg').src = URL.createObjectURL(foto_bg);

    }

})

function calcularValores() {

    let custo = parseFloat(document.getElementById('custo').value.replace(',', '.')) || 0;
    let margem = parseFloat(document.getElementById('margem').value) || 0;
    let desconto = parseFloat(document.getElementById('desconto').value) || 0;

    // preço de venda
    let precoVenda = custo * (1 + (margem / 100));

    // desconto
    let valorDesconto = precoVenda * (desconto / 100);

    // preço promoção
    let precoPromo = precoVenda - valorDesconto;

    document.getElementById('preco_venda').value = precoVenda.toFixed(2);
    document.getElementById('preco_promocao').value = precoPromo.toFixed(2);
}

document.getElementById('custo').addEventListener('keyup', calcularValores);
document.getElementById('margem').addEventListener('keyup', calcularValores);
document.getElementById('desconto').addEventListener('keyup', calcularValores);



// limitar caracteres pelo tipo do produto, gerar automaticamente o código do produto
document.addEventListener("DOMContentLoaded", function () {
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

    function calcularValores() {
        let valorCusto = parseFloat(custo.value.replace(",", ".")) || 0;
        let valorLucro = parseFloat(lucro.value.replace(",", ".")) || 0;
        let valorDesconto = parseFloat(desconto.value.replace(",", ".")) || 0;

        // preço normal
        let venda = valorCusto + (valorCusto * (valorLucro / 100));
        precoVenda.value = venda.toFixed(2).replace(".", ",");

        // preço promoção
        if (promocao.value === "1") {
            let promocional = venda - (venda * (valorDesconto / 100));
            precoPromocao.value = promocional.toFixed(2).replace(".", ",");
            desconto.disabled = false;
        } else {
            desconto.value = "";
            precoPromocao.value = "";
            desconto.disabled = true;
        }
    }

    tipo.addEventListener("change", function () {
        gerarCodigoAleatorio(this.value);
    });

    custo.addEventListener("input", calcularValores);
    lucro.addEventListener("input", calcularValores);
    desconto.addEventListener("input", calcularValores);
    promocao.addEventListener("change", calcularValores);

    desconto.disabled = true;


    if (tipo.value !== "") 
    {
        gerarCodigoAleatorio(tipo.value);
    }

});






