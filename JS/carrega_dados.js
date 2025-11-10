const tabelaCorpo = document.getElementById('tabela-jogos');
const urlDados = 'DADOS/loja.json';

function carregarJogosDaLoja() {
  fetch(urlDados)
    .then(response => {
      if (!response.ok) {
        throw new Error(`Erro ao buscar dados: ${response.statusText}`);
      }
      return response.json();
    })
    .then(jogos => {
      renderizarJogos(jogos);
    })
    .catch(error => {
      console.error('Erro ao carregar loja.json:', error);
      tabelaCorpo.innerHTML = `<tr><td colspan="5">Erro ao carregar os jogos.</td></tr>`;
    });
}

function renderizarJogos(jogos) {
  let htmlJogos = '';
  jogos.forEach(jogo => {
    htmlJogos += `
      <tr>
        <td><img src="${jogo.imagem}" alt="${jogo.titulo}" width="70"></td>
        <td>${jogo.titulo}</td>
        <td>${jogo.genero}</td>
        <td>${jogo.preco}</td>
        <td>${jogo.ano}</td>
      </tr>
    `;
  });
  tabelaCorpo.innerHTML = htmlJogos;
}

carregarJogosDaLoja();
