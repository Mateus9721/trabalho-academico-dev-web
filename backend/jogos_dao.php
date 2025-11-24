<?php
// jogos_dao.php
// Funções CRUD para a tabela 'jogos'

// Buscar todos os jogos
function getJogos(PDO $pdo) {
    $stmt = $pdo->query("SELECT * FROM jogos ORDER BY id DESC");
    return $stmt->fetchAll();
}

// Buscar jogo por ID
function getJogoById(PDO $pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM jogos WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

// Criar novo jogo
function createJogo(PDO $pdo, $data) {
    try {
        $stmt = $pdo->prepare("INSERT INTO jogos (jogo, titulo, genero, preco, ano) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['jogo'] ?? '',
            $data['titulo'] ?? '',
            $data['genero'] ?? '',
            $data['preco'] ?? 0,
            $data['ano'] ?? 0
        ]);
        return ["message" => "Jogo cadastrado com sucesso!", "id" => $pdo->lastInsertId()];
    } catch (Exception $e) {
        http_response_code(500);
        return ["message" => "Erro ao cadastrar jogo: " . $e->getMessage()];
    }
}

// Atualizar jogo existente
function updateJogo(PDO $pdo, $id, $data) {
    try {
        $stmt = $pdo->prepare("UPDATE jogos SET jogo = ?, titulo = ?, genero = ?, preco = ?, ano = ? WHERE id = ?");
        $stmt->execute([
            $data['jogo'] ?? '',
            $data['titulo'] ?? '',
            $data['genero'] ?? '',
            $data['preco'] ?? 0,
            $data['ano'] ?? 0,
            $id
        ]);
        return ["message" => "Jogo atualizado com sucesso!"];
    } catch (Exception $e) {
        http_response_code(500);
        return ["message" => "Erro ao atualizar jogo: " . $e->getMessage()];
    }
}

// Deletar jogo
function deleteJogo(PDO $pdo, $id) {
    try {

        // 1. Apaga o jogo desejado
        $stmt = $pdo->prepare("DELETE FROM jogos WHERE id = ?");
        $stmt->execute([$id]);

        // 2. Reorganiza os IDs para evitar buracos
        $pdo->exec("
            SET @count = 0;
            UPDATE jogos SET id = (@count := @count + 1) ORDER BY id;
            ALTER TABLE jogos AUTO_INCREMENT = 1;
        ");

        return ["message" => "Jogo deletado e IDs reorganizados com sucesso!"];

    } catch (Exception $e) {

        http_response_code(500);
        return ["message" => "Erro ao deletar jogo: " . $e->getMessage()];

    }
}
?>
