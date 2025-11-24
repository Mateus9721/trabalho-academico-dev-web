<?php

$action = $_GET['action'] ?? 'novo';
$id = $_GET['id'] ?? null;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameStore</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php include 'nav.php'; ?>
    <main>
        <h2><?= $action == 'editar' ? 'Editar Jogo' : 'Cadastro de novo jogo' ?></h2>       
        <form id="form_jogo">
            <label for="jogo">Capa (nome da imagem)</label>
            <input type="text" id="jogo" value="<?= htmlspecialchars($_GET['jogo'] ?? '') ?>" required>

            <label for="titulo">Título</label>
            <input type="text" id="titulo" value="<?= htmlspecialchars($_GET['titulo'] ?? '') ?>" required>

            <label for="genero">Gênero</label>
            <input type="text" id="genero" value="<?= htmlspecialchars($_GET['genero'] ?? '') ?>" required>

            <label for="preco">Preço (R$)</label>
            <input type="number" id="preco" step="0.01" value="<?= htmlspecialchars($_GET['preco'] ?? '') ?>" required>

            <label for="ano">Ano de Lançamento</label>
            <input type="number" id="ano" min="1970" max="2099" step="1" value="<?= htmlspecialchars($_GET['ano'] ?? '') ?>" required>

            <button type="submit">
                <?= $action == 'editar' ? 'Salvar Alterações' : 'Cadastrar Jogo' ?>
            </button>
        </form>
    </main>
    <div id="modalOverlay" class="modal-overlay">
    <div class="modal">
        <h3 id="modalMessage">Mensagem aqui</h3>
        <button id="btnModalOK">OK</button>
    </div>
</div>
    <script>
        window.JOGO_ACTION = "<?= $action ?>";
        window.JOGO_ID = "<?= $id ?>";
    </script>
    <?php include 'footer.php'; ?>
    <script src="js/tema.js"></script>
    <script src="js/jogo.js"></script>
</body>
</html>
