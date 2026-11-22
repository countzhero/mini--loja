<?php
// banco.php: o MODELO.
// Conecta no banco e guarda as funções que falam com ele. Todo o SQL mora aqui.

function conectar(): PDO
{
    // o banco é um arquivo só; se ele não existe, o PHP cria
    $pdo = new PDO('sqlite:' . __DIR__ . '/mini-loja.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // a tabela nasce sozinha na primeira vez
    $pdo->exec('CREATE TABLE IF NOT EXISTS produtos (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT NOT NULL,
        preco REAL NOT NULL
    )');

    // banco vazio? entram três produtos de exemplo, para a lista não começar em branco
    $total = $pdo->query('SELECT COUNT(*) FROM produtos')->fetchColumn();
    if ($total == 0) {
        $pdo->exec("INSERT INTO produtos (nome, preco) VALUES
            ('Placa ESP32', 39.90),
            ('Arduino Uno', 59.90),
            ('Sensor de temperatura DHT11', 12.50)");
    }

    return $pdo;
}

// R: devolve todos os produtos, em ordem alfabética
function listarProdutos(): array
{
    $pdo = conectar();
    return $pdo->query('SELECT id, nome, preco FROM produtos ORDER BY nome')->fetchAll(PDO::FETCH_ASSOC);
}
