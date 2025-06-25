<?php

require_once 'verifica_admin.php';
require 'conexao_socars.php';

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $nome_admin = $_POST['nome_admin'];
    $email_admin = $_POST['email_admin'];   
    $senha_admin = $_POST['senha_admin'];
    $acesso = 'admin';

    $sql = "SELECT * FROM usuario WHERE email = :email"; 
    $stmt = $pdo->prepare($sql); 
    $stmt ->bindParam(':email', $email_admin); 
    $stmt-> execute();
    $verifica =  $stmt->fetch(PDO::FETCH_ASSOC); 

    if($verifica){
       echo "<script>
                alert('Email já cadastrado. Redirecionando para login.');
                window.location.href = 'login.php';
            </script>";
        exit;
    } else {
    $senha_cript = password_hash($senha_admin, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuario (nome, email, senha, acesso) VALUES 
    (:nome, :email, :senha, :acesso)";
    $stmt = $pdo->prepare($sql);

    $stmt-> bindParam(':nome', $nome_admin);
    $stmt-> bindParam(':email', $email_admin);
    $stmt-> bindParam(':senha', $senha_cript);
    $stmt-> bindParam(':acesso', $acesso);

    if ($stmt -> execute()){
        echo "<script>
                alert('Administrador cadastrado com Sucesso!');
                 window.location.href = 'home.php';
            </script>"; 
    } else {
        echo "Erro ao cadastrar usuário.";   
        }
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="login-cadastro.css">
    <title>Formulário de Cadastro</title>
</head>
<body>
        <section>
        <div class="form-box">
            <h2>Registro de Usuário</h2>
            <form action="registro_user.php" method="post">
                <label for="nome">Nome:</label>
                <input type="text" name="nome_usuario" required>

                <label for="email">E-mail:</label>
                <input type="email" name="email_usuario" required>

                <label for="senha">Senha:</label>
                <input type="password" name="senha_usuario" required>

                <input type="submit" value="Cadastrar" class="btn">
            </form>
            <div class="form-text">
                <a href="login.php">Já tem conta? Entrar</a>
            </div>
        </div>
    </section>
</body>
</html>


