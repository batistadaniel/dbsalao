<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header("Location: home.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/style.css">
    <title>salao</title>
</head>
<body>
    <main id="forms" class="forms">
        <section id="form-login" class="form-login">
            <form action="processa.php" method="post">
                <h2>Login</h2>
                <input type="hidden" name="acao" value="cadastro">
                <label for="email">Email:</label>
                <input type="email" id="email-login" name="email" required>
                <label for="senha">Senha:</label>
                <input type="password" id="senha-login" name="senha" required>
                <button class="btn btn-login" type="submit">Entrar</button>
                <button class="btn btn-cad" onclick="mudarForm()" type="button">Cadastre-se</button>
            </form>
        </section>

        <section id="form-cad" class="form-cad hidden">
            <form action="processa.php" method="post">
                <h2>Cadastro</h2>
                <input type="hidden" name="acao" value="cadastro">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
                <button class="btn btn-login" onclick="mudarForm()" type="button">Login</button>
                <button class="btn btn-cad" type="submit">Cadastrar</button>
            </form>
        </section>
    </main>
    
    <script src="src/js/script.js" defer></script>
</body>
</html>