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

// o formulário foi enviado? com id é edição; sem id é produto novo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) ($_POST['id'] ?? 0);
    $nome = trim($_POST['nome'] ?? '');
    $preco = (float) ($_POST['preco'] ?? 0);

    if ($id > 0) {
        atualizarProduto($id, $nome, $preco);
    } else {
        inserirProduto($nome, $preco);
    }

    // volta para a página limpa: assim o F5 não grava de novo
    header('Location: cadastro.php');
    exit;
}

// clicou em "Editar"? busca o produto para preencher o formulário
$produto = null;
if (isset($_GET['editar'])) {
    $produto = buscarProduto((int) $_GET['editar']);
}

$produtos = listarProdutos();

require __DIR__ . '/tela.php';
