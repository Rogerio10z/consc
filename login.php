<?php
session_start();
require 'conexao_socars.php';

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $email = $_POST['email_usuario'];
    $senha = $_POST['senha_usuario'];

    $sql = "SELECT * FROM usuario WHERE email = :email_usuario";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email_usuario', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($senha, $user['senha'])) {
        $_SESSION['nome'] = $user['nome'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['acesso'] = $user['acesso'];

        header('Location: home.php');
        exit;
    } else {
        echo 'Dados Inválidos!';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="login-cadastro.css">
    <link rel="stylesheet" href="style.css">
    <title>Formulário de Login</title>
</head>
<body>
    <section>
        <div class="form-box">
            <h2>Login</h2>
            <form action="login.php" method="post">
                <label for="email">E-mail:</label><br>
                <input type="email" name="email_usuario" required><br>

                <label for="senha">Senha:</label><br>
                <input type="password" name="senha_usuario" required><br>

                <input type="submit" value="Entrar" class="btn">
            </form>
            <div class="form-text">
                <a href="registro_user.php">
                    Deseja se cadastrar?
                </a>
            </div>
        </div>
    </section>
</body>
</html>
