<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>
    <h1>Essa é a home. Logado com sucesso!</h1>
    <p>Bem-vindo, <?php echo $_SESSION['usuario']; ?>!</p>
    <form action="logout.php" method="POST">
        <button type="submit">Sair</button>
    </form>
</body>
</html>
