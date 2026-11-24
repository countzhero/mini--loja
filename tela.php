<?php
$logado = $logado ?? false;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Mini Loja</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>

    <p>
        <a href="index.html">← Página inicial</a>
    </p>

    <h1>Mini Loja</h1>

    <?php if ($logado): ?>

        <p>
            Olá,
            <strong><?= htmlspecialchars($logado) ?></strong>!

            ·
            <a href="funcionario.php">
                Área do funcionário
            </a>

            ·
            <a href="funcionario.php?sair=1">
                Sair
            </a>
        </p>

    <?php else: ?>

        <p>
            É funcionário?
            <a href="funcionario.php">
                Entre
            </a>
            para cadastrar produtos.
        </p>

    <?php endif; ?>

    <?php if ($logado): ?>

        <h2>
            <?= !empty($produto['id'])
                ? 'Editar produto'
                : 'Novo produto' ?>
        </h2>

        <?php if ($erro): ?>

            <p class="alert alert-erro">
                <strong>Foto recusada:</strong>
                <?= htmlspecialchars($erro) ?>
            </p>

        <?php endif; ?>

        <form
            method="post"
            action="cadastro.php"
            enctype="multipart/form-data"
        >

            <input
                type="hidden"
                name="id"
                value="<?= $produto['id'] ?? '' ?>"
            >

            <label for="nome">
                Nome
            </label>

            <input
                id="nome"
                name="nome"
                required
                value="<?= htmlspecialchars($produto['nome'] ?? '') ?>"
            >

            <label for="preco">
                Preço (R$)
            </label>

            <input
                id="preco"
                name="preco"
                type="number"
                step="0.01"
                min="0"
                required
                value="<?= $produto['preco'] ?? '' ?>"
            >

            <?php if (!empty($produto['imagem'])): ?>

                <p>
                    Foto atual:

                    <img
                        src="uploads/<?= htmlspecialchars($produto['imagem']) ?>"
                        alt="Produto"
                        width="60"
                    >
                </p>

            <?php endif; ?>

            <label for="imagem">
                <?= !empty($produto['id'])
                    ? 'Trocar a foto (só se quiser)'
                    : 'Foto do produto' ?>
            </label>

            <input
                id="imagem"
                name="imagem"
                type="file"
                accept="image/jpeg,image/png,image/webp"
            >

            <small>
                JPG, PNG ou WEBP, até 2 MB.
            </small>

            <button type="submit">
                <?= !empty($produto['id'])
                    ? 'Salvar alterações'
                    : 'Cadastrar' ?>
            </button>

            <?php if (!empty($produto['id'])): ?>
                <a href="cadastro.php">
                    Cancelar
                </a>
            <?php endif; ?>

        </form>

    <?php endif; ?>

    <?php $produtos = $produtos ?? []; ?>

    <h2>
        Produtos (<?= count($produtos) ?>)
    </h2>

    <ul>

        <?php foreach ($produtos as $item): ?>

            <li>

                <?php if ($item['imagem']): ?>

                    <img
                        src="uploads/<?= htmlspecialchars($item['imagem']) ?>"
                        alt="Produto"
                        width="60"
                    >

                <?php else: ?>

                    <span>
                        📦 Sem foto
                    </span>

                <?php endif; ?>

                <?= htmlspecialchars($item['nome']) ?>
                ·
                R$
                <?= number_format($item['preco'], 2, ',', '.') ?>

                <?php if ($logado): ?>

                    <a href="cadastro.php?editar=<?= $item['id'] ?>">
                        Editar
                    </a>

                    <form
                        method="post"
                        action="cadastro.php"
                        style="display:inline"
                    >

                        <button
                            name="excluir"
                            value="<?= $item['id'] ?>"
                        >
                            Excluir
                        </button>

                    </form>

                <?php endif; ?>

            </li>

        <?php endforeach; ?>

    </ul>

</body>
</html>