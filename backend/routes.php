<?php
// routes.php
// Roteamento principal para a API RESTful baseada em Query String.

$response = array();

// 1. Verifica se o recurso é 'jogos'
if ($resource !== 'jogos') {
    http_response_code(404);
    $response = array("message" => "Recurso não encontrado ou ausente. Use ?resource=jogos");
} else {
    // 2. Roteia com base no método HTTP e na presença do ID
    switch ($method) {
        case 'GET':
            // Rota: GET api.php?resource=jogos ou GET api.php?resource=jogos&id=2
            if ($id) {
                $response = getJogoById($pdo, $id);
            } else {
                $response = getJogos($pdo);
            }
            break;
            
        case 'POST':
            // Rota: POST api.php?resource=jogos (ID não deve estar na query string para criação)
            if ($id) {
                http_response_code(405); // Método POST não deve ter ID no caminho/query
                $response = array("message" => "Método não permitido para esta rota. Use POST api.php?resource=jogos.");
            } else {
                $response = createJogo($pdo, $data);
            }
            break;

        case 'PUT':
            // Rota: PUT api.php?resource=jogos&id=2 (ID é obrigatório na query string)
            if ($id) {
                $response = updateJogo($pdo, $id, $data);
            } else {
                http_response_code(400);
                $response = array("message" => "ID do jogo é obrigatório na query string para o método PUT (ex: ?resource=jogos&id=123).");
            }
            break;
            
        case 'DELETE':
            // Rota: DELETE api.php?resource=jogos&id=2 (ID é obrigatório na query string)
            if ($id) {
                $response = deleteJogo($pdo, $id);
            } else {
                http_response_code(400);
                $response = array("message" => "ID do jogo é obrigatório na query string para o método DELETE (ex: ?resource=jogos&id=123).");
            }
            break;

        default:
            http_response_code(405); // Method Not Allowed
            $response = array("message" => "Método não permitido para este recurso.");
            break;
    }
}

// 3. Retorna a Resposta como JSON
echo json_encode($response);
?>
