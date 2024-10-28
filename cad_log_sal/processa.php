<?php
session_start();
require 'conexao.php';

//Verifica se o método da requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Filtra e valida os dados do formulario
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

    //Verifica se os campos foram preenchidos
    if (empty($nome) || empty($email) || empty($senha)) {
        $_SESSION['msg'] = "<p class='msg'>Por favor, preencha tudo.</p>";
        header("Location: index.php");
        exit(); //Encerra o script para evitar execução adicional
    }

    //Verifica se o email já está cadastrado
    $query_verifica_email = "SELECT id FROM usuarios WHERE email = '$email'";
    $resultado_verifica_email = mysqli_query($conexao, $query_verifica_email);

    if ((mysqli_num_rows($resultado_verifica_email) > 0)) {
        $_SESSION['msg'] = "<p class='msg'>Email já cadastrado.</p>";
        header("location: index.php");
        exit();
    }

    //Se tudo estiver correto insere o novo usuário no banco de dados
    $create_user = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
    $created_user = mysqli_query($conexao, $create_user);

    if ($created_user) {
        $_SESSION['msg'] = "<p class='msg' style='color:green'>Usuário cadastrado com sucesso.</p>";
        header("location: index.php");
    } else {
        $_SESSION['msg'] = "<p class='msg'>Erro ao cadastrar usuário</p>";
        header("location: index.php");
    }
} else {
    //Redireciona para a página cadastro caso o método da requisição não seja POST
    header("Location: index.php");
}





// Verifica se o usuário já está logado
if (isset($_SESSION['login'])) {
    // Se a ação de logout for solicitada
    if (isset($_GET['logout'])) {
        unset($_SESSION['login']);
        session_destroy();
        header('Location: index.php');
        exit();
    }
    // Inclui a página inicial se o usuário estiver logado
    include('home.php');
    exit();
}

// Processa o login se o formulário for enviado
if (isset($_POST['acao'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

    // Usa consultas preparadas para evitar SQL Injection
    $verifica = "SELECT * FROM usuarios WHERE email= '$email' AND senha = '$senha'";
    $resultado = mysqli_query($conexao, $verifica);

    if ($resultado->num_rows > 0) {
        $_SESSION['login'] = $email;
        header('Location: home.php');
        exit();
    } else {
        $error_message = "E-mail ou senha inválidos!";
    }
}

// Inclui a página de login se o usuário não estiver logado
include('index.php');
?>
