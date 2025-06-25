<?php
session_start();
require 'conexao_socars.php'; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome_usuario = $_POST['nome_usuario']; 
    $email_usuario = $_POST['email_usuario'];
    $senha_usuario = $_POST['senha_usuario'];
    $acesso_usuario = 'cliente';

    $validade = "SELECT * FROM usuario WHERE email = :email_usuario"; 
    $stmt = $pdo->prepare($validade); 
    $stmt ->bindParam(':email_usuario', $email_usuario); 
    $stmt-> execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC); 

    if ($usuario) {
        // REDIRECIONAMENTO
        header('Location: login.php');
        exit;
    } else {
        $senha_hash = password_hash($senha_usuario, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuario (nome, email, senha, acesso) VALUES (:nome_usuario, :email_usuario, :senha_usuario, :acesso)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':nome_usuario', $nome_usuario);
        $stmt->bindParam(':email_usuario', $email_usuario);
        $stmt->bindParam(':senha_usuario', $senha_hash);
        $stmt->bindParam(':acesso', $acesso_usuario);
        
        if ($stmt->execute()) {
            $_SESSION['nome'] = $nome_usuario;
            $_SESSION['email'] = $email_usuario;
            $_SESSION['acesso'] = $acesso_usuario;
            header('Location: home.php');
        } else {
            echo "Erro!";
        }

    }
    
}
?>

<!DOCTYPE html>
<html>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="login-cadastro.css">
    <link rel="stylesheet" href="style.css">
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

</html>
