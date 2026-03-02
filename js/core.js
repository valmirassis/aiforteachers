$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

document.addEventListener('DOMContentLoaded', function() {
    // Override Bootstrap's collapse transition duration (default is 350ms)
    var style = document.createElement('style');
    style.innerHTML = `
        .collapse,
        .collapsing {
            transition-duration: 1s !important; /* 1 segundo */
        }
    `;
    document.head.appendChild(style);
});

function copyREA() {
    const texto = document.getElementById('resultado-ajax').innerText;

    navigator.clipboard.writeText(texto)
        .then(() => {
            alert('Conteúdo copiado com sucesso!');
        })
        .catch(err => {
            console.error('Erro ao copiar:', err);
        });
}

function copyREA2(collapseId) {
    const texto = document.getElementById(collapseId).innerText;
    navigator.clipboard.writeText(texto)
        .then(() => {
            alert('Conteúdo copiado com sucesso!');
        })
        .catch(err => {
            console.error('Erro ao copiar:', err);
        });
}