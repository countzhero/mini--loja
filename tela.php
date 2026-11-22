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

  <h2>Novo produto</h2>
  <form method="post" action="cadastro.php">
    <label for="nome">Nome</label>
    <input id="nome" name="nome" required>

    <label for="preco">Preço (R$)</label>
    <input id="preco" name="preco" type="number" step="0.01" min="0" required>

    <button type="submit">Cadastrar</button>
  </form>

  <?php $produtos = $produtos ?? []; ?>
  <h2>Produtos (<?= count($produtos) ?>)</h2>
  <ul>
    <?php foreach ($produtos as $item): ?>
      <li>
        <?= htmlspecialchars($item['nome']) ?> · R$ <?= number_format($item['preco'], 2, ',', '.') ?>
        <form method="post" action="cadastro.php" style="display: inline">
          <button name="excluir" value="<?= $item['id'] ?>">Excluir</button>
        </form>
      </li>
    <?php endforeach; ?>
  </ul>
</body>
</html>
