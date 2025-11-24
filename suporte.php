<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameStore - Suporte</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <?php include 'nav.php'; ?> 
    <main>
        <h2>Suporte GameStore</h2>
        <p>Como podemos ajudar?</p>
        <p>envie sua mensagem a equipe de suporte.</p>
        <form id="form">
            <label for="id_nome">Nome do cliente:</label><br>
            <input type="text" name="nome" id="id_nome"><br><br>
            <label for="id_email">Email do cliente:</label><br>
            <input type="text" name="email" id="id_email"><br><br>
            <label for = "id_cpf">CPF:</label><br>
            <input type="text" name="cpf" id="id_cpf"><br><br>
            <label for="id_assunto">Assunto:</label><br>
            <input type="text" name="assunto" id="id_assunto"><br><br>
            <label for="id_mensagem">Mensagem:</label><br>
            <textarea name="mensagem" id="id_mensagem"></textarea><br><br>
            <button type="submit">Enviar</button>
        </form>
    </main>
    <?php include 'footer.php'; ?>  
    <script src="./JS/validacao.js"></script>
    <script src="JS/tema.js"></script>
</body>
</html>
