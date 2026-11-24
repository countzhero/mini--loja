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

    <div class="container">

        <header class="header-content">
            <h1>Mini Loja</h1>
            <p>
                Gerenciamento de produtos e estoque da loja.
            </p>
        </header>

        <main class="main-content">

            <nav class="navigation-links">

                <a href="index.html">
                    ← Página Inicial
                </a>

                <?php if ($logado): ?>

                    <a href="funcionario.php">
                        Área do Funcionário
                    </a>

                    <a href="funcionario.php?sair=1">
                        Sair
                    </a>

                <?php endif; ?>

            </nav>

            <?php if ($logado): ?>

                <section class="card">

                    <p>
                        Olá,
                        <strong><?= htmlspecialchars($logado) ?></strong>!
                    </p>

                    <h2>
                        <?= !empty($produto['id'])
                            ? 'Editar Produto'
                            : 'Novo Produto' ?>
                    </h2>

                    <?php if ($erro): ?>

                        <div class="alert alert-erro">
                            <strong>Foto recusada:</strong>
                            <?= htmlspecialchars($erro) ?>
                        </div>

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
                            </p>

                            <img
                                src="uploads/<?= htmlspecialchars($produto['imagem']) ?>"
                                alt="Produto"
                                width="60"
                            >

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
                                Cancelar edição
                            </a>

                        <?php endif; ?>

                    </form>

                </section>

            <?php else: ?>

                <section class="card">

                    <p>
                        É funcionário?
                        <a href="funcionario.php">
                            Entre
                        </a>
                        para cadastrar produtos.
                    </p>

                </section>

            <?php endif; ?>

            <?php $produtos = $produtos ?? []; ?>

            <section class="card">

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

                            <span>
                                <?= htmlspecialchars($item['nome']) ?>
                                ·
                                R$ <?= number_format($item['preco'], 2, ',', '.') ?>
                            </span>

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

            </section>

        </main>

    </div>

</body>
</html>