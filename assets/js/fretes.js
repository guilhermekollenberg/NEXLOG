// Botão para adicionar produtos
const botaoAdicionar = document.getElementById('adicionar-produto');

const listaProdutos = document.getElementById('lista-produtos');

botaoAdicionar.addEventListener('click', function () {

    // Copiar o primeiro campo de produto
    const novoProduto = listaProdutos.firstElementChild.cloneNode(true);

    // Limpar os campos
    novoProduto.querySelector('select').selectedIndex = 0;
    novoProduto.querySelector('input').value = '';

    // Criar botão para remover produto
    const botaoRemover = document.createElement('button');

    botaoRemover.type = 'button';
    botaoRemover.textContent = 'Remover produto';
    botaoRemover.classList.add('remover-produto');

    // Adicionar botão ao novo produto
    novoProduto.appendChild(botaoRemover);

    // Adicionar produto à lista
    listaProdutos.appendChild(novoProduto);

});

// Remover produto
listaProdutos.addEventListener('click', function (evento) {

    if (evento.target.classList.contains('remover-produto')) {

        evento.target.parentElement.remove();

    }

});