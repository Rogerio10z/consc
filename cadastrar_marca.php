<?php
require_once 'verifica_admin.php';
require 'conexao_socars.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome_marca = $_POST['nome_marca'];

    $sql = "INSERT INTO marca (nome_marca) VALUES (:nome_marca)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome_marca', $nome_marca);

    if ($stmt->execute()) {
        header("Location: cadastrar_modelo.php?sucesso=categoria");
        exit();
    } else {
        header("Location: cadastrar_marca.php?erro=categoria");
     exit();
    }
}
?>

<form method="POST" action="">
    <label>Nome da Marca:</label><br>
    <input type="text" name="nome_marca" required><br><br>
    <button type="submit">Cadastrar Marca</button>
</form>
<?php
require 'conexao_socars.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome_marca = $_POST['nome_marca'];

    $sql = "INSERT INTO marca (nome_marca) VALUES (:nome_marca)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome_marca', $nome_marca);

    if ($stmt->execute()) {
        header("Location: cadastrar_modelo.php?sucesso=categoria");
        exit();
    } else {
        header("Location: cadastrar_marca.php?erro=categoria");
     exit();
    }
}
?>

<form method="POST" action="">
    <label>Nome da Marca:</label><br>
    <input type="text" name="nome_marca" required><br><br>
    <button type="submit">Cadastrar Marca</button>
</form>
