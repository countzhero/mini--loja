<?php
// cadastro.php: o CONTROLE.
// Recebe o formulário, pede ao modelo (banco.php) e chama a visão (tela.php).
require __DIR__ . '/banco.php';

// clicou em "Excluir"? apaga e volta para a página limpa
if (isset($_POST['excluir'])) {
    excluirProduto((int) $_POST['excluir']);
    header('Location: cadastro.php');
    exit;
}

// o formulário foi enviado? grava o produto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $preco = (float) ($_POST['preco'] ?? 0);
    inserirProduto($nome, $preco);

    // volta para a página limpa: assim o F5 não cadastra de novo
    header('Location: cadastro.php');
    exit;
}

$produtos = listarProdutos();

require __DIR__ . '/tela.php';
