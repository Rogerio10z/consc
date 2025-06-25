<?php
require 'conexao_socars.php';

// Pega o ID da URL
$id = $_GET['id'];

// Verifica se o ID existe
if (!$id) {
    die('ID do modelo não fornecido.');
}

$sql = "SELECT mo.*, ma.nome_marca
        FROM modelo mo 
        INNER JOIN marca ma ON ma.id = mo.id_marca
        WHERE mo.id = :id";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$modelo = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt-br">
<body>
    <div>
        <h1><?php echo htmlspecialchars($modelo['nome_modelo']); ?></h1>
        <img src="<?php echo htmlspecialchars($modelo['imagem']); ?>" alt="Imagem do modelo" width="200">
        <p><strong>Ano:</strong> <?php echo htmlspecialchars($modelo['ano']); ?></p>
        <p><strong>Cor:</strong> <?php echo htmlspecialchars($modelo['cor']); ?></p>
        <p><strong>Preço:</strong> R$ <?php echo htmlspecialchars($modelo['preco']); ?></p>
        <p><strong>Motor:</strong> <?php echo htmlspecialchars($modelo['motor']); ?></p>
        <p><strong>Marca:</strong> <?php echo htmlspecialchars($modelo['nome_marca']); ?></p>
        <p><strong>Descrição:</strong> <?php echo htmlspecialchars($modelo['descricao']); ?></p><br><br>
        <button onclick="history.back()">Retornar</button>
    </div>
</body>
</html>
