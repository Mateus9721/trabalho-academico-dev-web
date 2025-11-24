function atualizarTabela() {
  fetch('http://localhost/trabalho-academico-dev-web/backend/api.php?resource=jogos')
    .then(res => res.json())
    .then(jogos => {
      const tbody = document.getElementById('corpo-tabela-jogos');
      tbody.innerHTML = '';
      jogos.forEach(jogo => {
        tbody.innerHTML += `
          <tr>
            <td>${jogo.jogo ? `<img src="${jogo.jogo}" alt="${jogo.titulo}" style="width:120px; height:auto;">` : 'N/A'}</td>
            <td>${jogo.titulo}</td>
            <td>${jogo.genero}</td>
            <td>R$ ${Number(jogo.preco).toFixed(2).replace('.', ',')}</td>
            <td>${jogo.ano}</td>
            <td>${jogo.id}</td>
            <td>
              <button style="background-color:#d4a017; width:100%; margin-bottom:5px;"
                onclick="window.location.href='jogo_form.php?action=editar&id=${jogo.id}&jogo=${encodeURIComponent(jogo.jogo)}&titulo=${encodeURIComponent(jogo.titulo)}&genero=${encodeURIComponent(jogo.genero)}&preco=${encodeURIComponent(jogo.preco)}&ano=${encodeURIComponent(jogo.ano)}'">
                Editar
              </button>
              <button style="background-color:#b30000; width:100%;" onclick="deleteJogo(${jogo.id})">
                Deletar
              </button>
            </td>
          </tr>`;
      });
    });
}