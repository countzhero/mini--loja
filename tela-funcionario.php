<?php // tela-funcionario.php: a VISÃO da área do funcionário. Só o HTML ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Mini Loja · Funcionário</title>
</head>
<body>
  <p><a href="index.html">← Página inicial</a></p>
  <h1>Área do funcionário</h1>

  <?php if ($erro): ?>
    <p style="color: firebrick"><strong>Não deu:</strong> <?= htmlspecialchars($erro) ?></p>
  <?php endif; ?>
  <?php if ($aviso): ?>
    <p style="color: green"><?= htmlspecialchars($aviso) ?></p>
  <?php endif; ?>

  <h2>Cadastrar funcionário</h2>
  <form method="post" action="funcionario.php">
    <label for="nome">Nome</label>
    <input id="nome" name="nome" required value="<?= htmlspecialchars($nome ?? '') ?>">

    <label for="email">E-mail</label>
    <input id="email" name="email" type="email" required value="<?= htmlspecialchars($email ?? '') ?>">

    <!-- type="password" esconde o que a pessoa digita -->
    <label for="senha">Senha (8 caracteres ou mais)</label>
    <input id="senha" name="senha" type="password" minlength="8" required>

    <button type="submit">Cadastrar</button>
  </form>
</body>
</html>
