<?php
function fetchJogosFromApi(string $api_url): array {
    $jogos = [];
    $error = null;

    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        
        if (curl_errno($ch)) {
            throw new Exception("Erro cURL: " . curl_error($ch));
        }

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $data = json_decode($response, true, 512, JSON_UNESCAPED_UNICODE);

        if ($http_code === 200) {
            if (is_array($data) && count($data) > 0 && isset($data[0]['id'])) {
                $jogos = $data;
            } elseif (is_array($data) && empty($data)) {
                $error = "Nenhum jogo cadastrado na base de dados.";
            } else {
                $error = "Formato de dados inesperado da API.";
            }
        } else {
            $error_message = $data['message'] ?? "Erro HTTP: " . $http_code;
            throw new Exception("Falha ao buscar dados: " . $error_message);
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }    
    return ['jogos' => $jogos, 'error' => $error];
}

$api_url = 'http://localhost/trabalho-academico-dev-web/backend/api.php?resource=jogos';

$result = fetchJogosFromApi($api_url);
$jogos = $result['jogos'];
$error = $result['error'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameStore - Loja</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'nav.php'; ?>
    <main>
        <h2>Loja de Jogos</h2>
        <p>Confira nosso catálogo de jogos</p>
       <a href="jogo_form.php?action=novo">
    <button type="button">Cadastrar Novo Jogo</button></a>
        <table border="1" id="tabela-loja">
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Título</th>
                    <th>Gênero</th>
                    <th>Preço</th>
                    <th>Ano de lançamento</th>
                    <th>Código</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="corpo-tabela-jogos">
                <?php if ($error): ?>
                    <tr style="color: red; border: 1px solid red; padding: 10px;">
                        <td colspan="7"><p><?php echo htmlspecialchars($error); ?></p></td>
                    </tr>
                <?php elseif (!empty($jogos)): ?>
                    <?php foreach ($jogos as $jogo): ?>
                        <tr>
                            <td>
                                <?php if (!empty($jogo['jogo'])): ?>
                                    <img src="<?php echo htmlspecialchars($jogo['jogo']); ?>" 
                                         alt="<?php echo htmlspecialchars($jogo['titulo']); ?>" 
                                         style="width:120px; height:auto;">
                                <?php else: ?>
                                    N/A
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($jogo['titulo']); ?></td>
                            <td><?php echo htmlspecialchars($jogo['genero']); ?></td>
                            <td>R$ <?php echo number_format($jogo['preco'], 2, ',', '.'); ?></td>
                            <td><?php echo htmlspecialchars($jogo['ano']); ?></td>
                            <td><?php echo htmlspecialchars($jogo['id']); ?></td>
                            <td>
                                <button 
                                    style="background-color: #d4a017; width: 100%; margin-bottom: 5px;"
                                    onclick="window.location.href='jogo_form.php?action=editar&id=<?php echo $jogo['id']; ?>&jogo=<?php echo urlencode($jogo['jogo']); ?>&titulo=<?php echo urlencode($jogo['titulo']); ?>&genero=<?php echo urlencode($jogo['genero']); ?>&preco=<?php echo urlencode($jogo['preco']); ?>&ano=<?php echo urlencode($jogo['ano']); ?>'">
                                    Editar
                                </button>
                                <button
                                    style="background-color: #b30000; width: 100%;"
                                    onclick="deleteJogo(<?php echo $jogo['id']; ?>)">
                                    Deletar
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">Não foi possível carregar os jogos.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
    <?php include 'footer.php'; ?>
    <script scr="js/atualizar_loja.js"></script>
    <script src="js/tema.js"></script>
    <script src="js/deletar_jogos.js"></script>
</body>
</html>