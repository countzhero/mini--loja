<?php // tela-funcionario.php ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Mini Loja · Funcionário</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">

        <header class="header-content">
            <h1>Área do Funcionário</h1>
            <p>
                Autenticação e gerenciamento de funcionários da loja.
            </p>
        </header>

        <main class="main-content">

            <nav class="navigation-links">

                <a href="index.html">
                    ← Página Inicial
                </a>

                <?php if (!empty($logado)): ?>

                    <a href="cadastro.php">
                        Cadastrar Produtos
                    </a>

                    <a href="funcionario.php?sair=1">
                        Sair
                    </a>

                <?php endif; ?>

            </nav>

            <?php if ($erro): ?>

                <div class="alert alert-erro">
                    <strong>Não deu:</strong>
                    <?= htmlspecialchars($erro) ?>
                </div>

            <?php endif; ?>

            <?php if ($aviso): ?>

                <div class="alert alert-sucesso">
                    <?= htmlspecialchars($aviso) ?>
                </div>

            <?php endif; ?>

            <?php if (!empty($logado)): ?>

                <section class="card">

                    <h2>Funcionário Logado</h2>

                    <p>
                        Olá,
                        <strong><?= htmlspecialchars($logado) ?></strong>!
                    </p>

                </section>

            <?php else: ?>

                <section class="card">

                    <h2>Entrar</h2>

                    <form method="post" action="funcionario.php">

                        <input
                            type="hidden"
                            name="acao"
                            value="entrar"
                        >

                        <label for="email-entrar">
                            E-mail
                        </label>

                        <input
                            id="email-entrar"
                            name="email"
                            type="email"
                            required
                        >

                        <label for="senha-entrar">
                            Senha
                        </label>

                        <input
                            id="senha-entrar"
                            name="senha"
                            type="password"
                            required
                        >

                        <button type="submit">
                            Entrar
                        </button>

                    </form>

                </section>

            <?php endif; ?>

            <?php if (isset($podeCadastrar) && $podeCadastrar): ?>

                <section class="card">

                    <h2>

                        <?= !empty($logado)
                            ? 'Cadastrar Funcionário'
                            : 'Primeiro Acesso: Cadastre o Administrador' ?>

                    </h2>

                    <form method="post" action="funcionario.php">

                        <input
                            type="hidden"
                            name="acao"
                            value="cadastrar"
                        >

                        <label for="nome">
                            Nome
                        </label>

                        <input
                            id="nome"
                            name="nome"
                            required
                        >

                        <label for="email">
                            E-mail
                        </label>

                        <input
                            id="email"
                            name="email"
                            type="email"
                            required
                        >

                        <label for="senha">
                            Senha (8 caracteres ou mais)
                        </label>

                        <input
                            id="senha"
                            name="senha"
                            type="password"
                            minlength="8"
                            required
                        >

                        <button type="submit">
                            Cadastrar
                        </button>

                    </form>

                </section>

            <?php endif; ?>

        </main>

    </div>

</body>
</html>