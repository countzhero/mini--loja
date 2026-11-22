<?php // tela.php: a VISÃO. Só o HTML; as variáveis vêm do cadastro.php ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Mini Loja</title>
</head>
<body>
  <p><a href="index.html">← Página inicial</a></p>
  <h1>Mini Loja</h1>

  <?php $produtos = $produtos ?? []; ?>
  <h2>Produtos (<?= count($produtos) ?>)</h2>
  <ul>
    <?php foreach ($produtos as $item): ?>
      <li><?= htmlspecialchars($item['nome']) ?> · R$ <?= number_format($item['preco'], 2, ',', '.') ?></li>
    <?php endforeach; ?>
  </ul>
</body>
</html>
