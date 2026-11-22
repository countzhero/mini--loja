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

  <h2><?= !empty($produto['id']) ? 'Editar produto' : 'Novo produto' ?></h2>

  <?php if ($erro): ?>
    <p style="color: firebrick"><strong>Foto recusada:</strong> <?= htmlspecialchars($erro) ?></p>
  <?php endif; ?>
  <!-- NOVO: sem o enctype, o arquivo não viaja (chega só o nome dele) -->
  <form method="post" action="cadastro.php" enctype="multipart/form-data">
    <!-- o id escondido diz ao controle qual produto editar (vazio = produto novo) -->
    <input type="hidden" name="id" value="<?= $produto['id'] ?? '' ?>">

    <label for="nome">Nome</label>
    <input id="nome" name="nome" required value="<?= htmlspecialchars($produto['nome'] ?? '') ?>">

    <label for="preco">Preço (R$)</label>
    <input id="preco" name="preco" type="number" step="0.01" min="0" required value="<?= $produto['preco'] ?? '' ?>">

    <label for="imagem">Foto do produto</label>
    <input id="imagem" name="imagem" type="file" accept="image/jpeg, image/png, image/webp">
    <small>JPG, PNG ou WEBP, até 2 MB.</small>

    <button type="submit"><?= !empty($produto['id']) ? 'Salvar alterações' : 'Cadastrar' ?></button>
    <?php if (!empty($produto['id'])): ?>
      <a href="cadastro.php">Cancelar</a>
    <?php endif; ?>
  </form>

  <?php $produtos = $produtos ?? []; ?>
  <h2>Produtos (<?= count($produtos) ?>)</h2>
  <ul>
    <?php foreach ($produtos as $item): ?>
      <li>
        <?php if ($item['imagem']): ?>
          <img src="uploads/<?= htmlspecialchars($item['imagem']) ?>" alt="" width="60">
        <?php else: ?>
          <span>📦 sem foto</span>
        <?php endif; ?>
        <?= htmlspecialchars($item['nome']) ?> · R$ <?= number_format($item['preco'], 2, ',', '.') ?>
        <a href="cadastro.php?editar=<?= $item['id'] ?>">Editar</a>
        <form method="post" action="cadastro.php" style="display: inline">
          <button name="excluir" value="<?= $item['id'] ?>">Excluir</button>
        </form>
      </li>
    <?php endforeach; ?>
  </ul>
</body>
</html>
