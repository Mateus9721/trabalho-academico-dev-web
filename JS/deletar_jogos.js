function deleteJogo(id) {
    if (!confirm("Tem certeza que deseja excluir este jogo?")) {
        return;
    }

    fetch(`http://localhost/trabalho-academico-dev-web/backend/api.php?resource=jogos&id=${id}`, {
        method: "DELETE"
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message || "Jogo excluído.");
        window.location.reload(); 
    })
    .catch(err => {
        alert("Erro ao excluir o jogo.");
        console.error(err);
    });
}
