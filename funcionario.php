<?php
// funcionario.php: o CONTROLE da área do funcionário.
// Recebe o cadastro, confere, pede ao modelo (banco.php) e chama a visão (tela-funcionario.php).
require __DIR__ . '/banco.php';

// começa sem aviso
$erro = '';
$aviso = '';

// o formulário foi enviado? confere tudo antes de gravar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = strtolower(trim($_POST['email'] ?? ''));
    $senha = $_POST['senha'] ?? '';

    if ($nome === '') {
        $erro = 'Escreva o seu nome.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = 'Esse e-mail não parece um e-mail.';
    } elseif (strlen($senha) < 8) {
        $erro = 'A senha precisa de 8 caracteres ou mais.';
    } elseif (buscarFuncionario($email)) {
        $erro = 'Esse e-mail já tem cadastro.';
    } else {
        // password_hash embaralha a senha de um jeito que não tem volta
        inserirFuncionario($nome, $email, password_hash($senha, PASSWORD_DEFAULT));
        $aviso = 'Cadastro feito, ' . $nome . '! Na versão 2, você vai usar esse e-mail para entrar.';
    }
}

require __DIR__ . '/tela-funcionario.php';
