const action = window.JOGO_ACTION;
const jogoId = window.JOGO_ID;

if (action === "editar" && jogoId) {
    fetch(`http://localhost/trabalho-academico-dev-web/backend/api.php?resource=jogos&id=${jogoId}`)
        .then(res => res.json())
        .then(data => {
            document.getElementById("titulo").value = data.titulo;
            document.getElementById("genero").value = data.genero;
            document.getElementById("ano").value = data.ano;
            document.getElementById("preco").value = data.preco;
            document.getElementById("jogo").value = data.jogo;
        })
        .catch(() => {
            
            if (action === "editar") {
                document.getElementById("modalMessage").innerText = "Erro ao carregar dados do jogo.";
                document.getElementById("modalOverlay").style.display = "flex";
            }
        });
}

document.getElementById("form_jogo").addEventListener("submit", async function(e) {
    e.preventDefault();

    const payload = {
        titulo: document.getElementById("titulo").value,
        genero: document.getElementById("genero").value,
        ano: document.getElementById("ano").value,
        preco: document.getElementById("preco").value,
        jogo: document.getElementById("jogo").value
    };

    let url = "http://localhost/trabalho-academico-dev-web/backend/api.php?resource=jogos";
    let method = "POST";

    if (action === "editar") {
        method = "PUT";
        url += `&id=${jogoId}`;
    }

    try {
        const response = await fetch(url, {
            method,
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(payload)
        });

        const result = await response.json();

        document.getElementById("modalMessage").innerText = result.message || "Operação concluída.";
        document.getElementById("modalOverlay").style.display = "flex";

    } catch {
        document.getElementById("modalMessage").innerText =
            action === "editar" ? "Erro ao atualizar jogo." : "Erro ao cadastrar jogo.";
        document.getElementById("modalOverlay").style.display = "flex";
    }
});

document.getElementById("btnModalOK").addEventListener("click", function() {
    window.location.href = "http://localhost/trabalho-academico-dev-web/loja.php";
});
