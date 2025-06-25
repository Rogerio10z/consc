<?php

require_once 'verifica_admin.php';
require 'conexao_socars.php';

// Buscar todas as marcas
$marcas = $pdo->query("SELECT * FROM marca")->fetchAll(PDO::FETCH_ASSOC);

// Buscar todas as categorias
$categorias = $pdo->query("SELECT * FROM categoria")->fetchAll(PDO::FETCH_ASSOC);

// Cadastrar modelo ao enviar o form
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome_modelo = $_POST['nome_modelo'];
    $ano = $_POST['ano'];
    $cor = $_POST['cor'];
    $preco = $_POST['preco'];
    $motor = $_POST['motor'];
    $descricao = $_POST['descricao'];
    $id_marca = $_POST['id_marca'];
    $id_categoria = $_POST['id_categoria'];

    // Processar a imagem
    $imagem = $_FILES['imagem']['name'];
    $caminho_imagem = 'uploads/' . basename($imagem);

if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_imagem)) {
    //Inserir no banco de dados
    if (empty($id_marca) || empty($id_categoria)) {
    die("Selecione uma marca e uma categoria válidas.");
}

    $sql = "INSERT INTO modelo (nome_modelo, ano, cor, preco, motor, descricao, imagem, id_marca, id_categoria)
            VALUES (:nome_modelo, :ano, :cor, :preco, :motor, :descricao, :imagem, :id_marca, :id_categoria)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nome_modelo', $nome_modelo);
    $stmt->bindParam(':ano', $ano, PDO::PARAM_INT);
    $stmt->bindParam(':cor', $cor);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':motor', $motor);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':imagem', $caminho_imagem);
    $stmt->bindParam(':id_marca', $id_marca, PDO::PARAM_INT);
    $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
        
    if ($stmt->execute()) {
        echo "<script>
                alert('Modelo cadastrado com sucesso!');
                window.location.href = 'carros_admin.php';
              </script>";
        exit;
    } else {
        echo "<script>
                alert('Erro ao cadastrar o modelo.');
                window.history.back();
              </script>";
        exit;
    }
}
}
?>

<form method="POST" action="cadastrar_modelo.php" enctype="multipart/form-data">

<div style="display: flex; align-items: center; gap: 10px;">
        <div>
            <label>Marca:</label><br>
            <select name="id_marca" required>
                <option value="">Selecione a marca</option>
                <?php foreach($marcas as $marca): ?>
                    <option value="<?= $marca['id'] ?>">
                        <?= htmlspecialchars($marca['nome_marca']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div><br>
            <a href="cadastrar_marca.php">
                <button type="button">Cadastrar nova marca</button>
            </a>
        </div>
    </div>
    <br>
    </div>
    <br>
    
    <label>Nome do Modelo:</label><br>
    <input type="text" name="nome_modelo" required><br><br>

    <label>Ano:</label><br>
    <input type="number" name="ano" required><br><br>

    <label>Cor:</label><br>
    <input type="text" name="cor" required><br><br>

    <label>Preço:</label><br>
    <input type="number" step="0.01" name="preco" required><br><br>

    <label>Motor:</label><br>
    <input type="text" name="motor" required><br><br>

    <label>Descrição:</label><br>
    <input type="text" name="descricao" required><br><br>

    <label>Imagem do carro:</label><br>
    <input type="file" name="imagem" required><br><br>

    <button type="submit">Cadastrar Modelo</button>

</form>
