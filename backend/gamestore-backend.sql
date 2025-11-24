CREATE DATABASE gamestore
    CHARACTER SET = utf8mb4
    COLLATE = utf8mb4_unicode_ci;

USE gamestore;

CREATE TABLE jogos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jogo TEXT,
    titulo VARCHAR(255) NOT NULL,
    genero VARCHAR(100) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    ano INT NOT NULL
);

INSERT INTO jogos (jogo, titulo, genero, preco, ano) VALUES
('./imagens/battlefield 6.webp', 'Battlefield 6', 'FPS', 299.90, 2025),
('./imagens/Grand_Theft_Auto_VI.png', 'Grand Theft Auto VI', 'Ação/Aventura', 399.90, 2025),
('./imagens/ea fc 26.webp', 'EA Sports FC 26', 'Esporte', 349.90, 2026),
('./imagens/Elden_Ring_capa.jpg', 'Elden Ring', 'RPG/Ação', 249.90, 2022),
('./imagens/resident evil 9.jpg', 'Resident Evil 9', 'Terror/Ação', 299.90, 2025);
