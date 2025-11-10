document.addEventListener("DOMContentLoaded", () => {
  const botao = document.getElementById("toggle-tema");

  const temaSalvo = localStorage.getItem("tema");
  if (temaSalvo === "claro") {
    document.body.classList.add("tema-claro");
    botao.textContent = "🌙 Escuro";
  }

  botao.addEventListener("click", () => {
    document.body.classList.toggle("tema-claro");

    const temaAtual = document.body.classList.contains("tema-claro") ? "claro" : "escuro";
    localStorage.setItem("tema", temaAtual);
    botao.textContent = temaAtual === "claro" ? "🌙 Escuro" : "🌞 Claro";
  });
});
