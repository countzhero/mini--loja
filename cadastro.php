<?php
// cadastro.php: o CONTROLE.
// Pede os dados ao modelo (banco.php) e chama a visão (tela.php).
require __DIR__ . '/banco.php';

$produtos = listarProdutos();

require __DIR__ . '/tela.php';
