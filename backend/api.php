<?php
// api.php
// API RESTful para gerenciamento de jogos

// 1. Cabeçalhos e Configuração
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Inclui o arquivo de conexão (PDO + MySQL)
include_once 'dbconfig.php';
$pdo = getDbConnection();
$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents("php://input"), true);
$resource = $_GET['resource'] ?? '';
$id = $_GET['id'] ?? null;
include_once 'jogos_dao.php';

if ($resource === 'jogos') {
    switch ($method) {
        case 'GET':
            echo json_encode($id ? getJogoById($pdo, $id) : getJogos($pdo));
            break;
        case 'POST':
            echo json_encode(createJogo($pdo, $data));
            break;
        case 'PUT':
            if ($id) echo json_encode(updateJogo($pdo, $id, $data));
            else { http_response_code(400); echo json_encode(["message" => "ID obrigatório para atualizar"]); }
            break;
        case 'DELETE':
            if ($id) echo json_encode(deleteJogo($pdo, $id));
            else { http_response_code(400); echo json_encode(["message" => "ID obrigatório para deletar"]); }
            break;
        default:
            http_response_code(405); echo json_encode(["message" => "Método não permitido"]);
    }
} else {
    http_response_code(404); echo json_encode(["message" => "Recurso não encontrado"]);
}
