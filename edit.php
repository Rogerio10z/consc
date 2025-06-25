<?php

require_once 'verifica_admin.php';
require 'conexao_socars.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM modelo WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $modelo = $stmt->fetch( );

    if(!$modelo) {
        echo "Modelo não encontrado.";
        exit;
    }
}   else {
        echo "ID não especificado.";
        exit;
    }

// Buscar todas as marcas
$marcas = $pdo->query("SELECT * FROM marca")->fetchAll(PDO::FETCH_ASSOC);

// Buscar todas as categorias
$categorias = $pdo->query("SELECT * FROM categoria")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome_modelo = $_POST['nome_modelo'];
    $ano = $_POST['ano'];
    $cor = $_POST['cor'];
    $preco = $_POST['preco'];
    $motor = $_POST['motor'];
    $descricao = $_POST['descricao'];
    $id_marca = $_POST['id_marca'];
    $id_categoria = $_POST['id_categoria'];

    if($_FILES['imagem']['name']) {
        $imagem = $_FILES['imagem']['name'];
        $caminho_imagem = 'uploads/' . basename($imagem);
        move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_imagem);
    }   else{
            $caminho_imagem = $modelo['imagem'];
    }
    $sql = "UPDATE  modelo SET nome_modelo = :nome_modelo, ano = :ano, cor = :cor, preco = :preco,
    motor = :motor, descricao = :descricao, imagem = :imagem, id_marca = :id_marca, id_categoria = :id_categoria
    WHERE id = :id";
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
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
    if ($stmt->execute()) {
    echo "<script>
                alert('Modelo atualizado com sucesso.');
                window.history.go(-2);
              </script>";
        exit;
} else {
    echo "Erro ao atualizar o modelo.";
}
}
?>

<form id="modelo" method="POST" enctype="multipart/form-data" action="edit.php?id=<?php echo $modelo['id']; ?>">

<div style = "display: flex; align-items: center; gap: 10px;">
        <div>
            <label>Marca:</label><br>
            <select name="id_marca" required>
            <option value="">Selecione a marca</option>
                <?php foreach($marcas as $marca): ?>
                <option value="<?= $marca['id'] ?>" 
                    <?= $marca['id'] == $modelo['id_marca'] ? 'selected' : '' ?>>
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

    <div style="display: flex; align-items: center; gap: 10px;">
        <div>
            <label>Categoria:</label><br>
            <select name="id_categoria" required>
            <option value="">Selecione a Categoria</option>
                <?php foreach($categorias as $categoria): ?>
                <option value="<?= $categoria['id'] ?>"
                <?= $categoria['id'] == $modelo['id_categoria'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($categoria['nome_categoria']) ?>
            </option>
            <?php endforeach; ?>
            </select>

        </div>
        <div><br>
            <a href="cadastrar_categoria.php">
                <button type="button">Cadastrar nova categoria</button>
            </a>
        </div>
    </div>
    <br>
    
    <label>Nome do Modelo:</label><br>
    <input type="text" name="nome_modelo" value="<?php echo htmlspecialchars($modelo['nome_modelo']); ?>" required><br><br>

    <label>Ano:</label><br>
    <input type="number" name="ano" value="<?php echo htmlspecialchars($modelo['ano']); ?>" required><br><br>


    <label>Cor:</label><br>
    <input type="text" name="cor" value="<?php echo htmlspecialchars($modelo['cor']); ?>" required><br><br>

    <label>Preço:</label><br>
    <input type="number" step="0.01" name="preco" value="<?php echo htmlspecialchars($modelo['preco']); ?>" required><br><br>

    <label>Motor:</label><br>
    <input type="text" name="motor" value="<?php echo htmlspecialchars($modelo['motor']); ?>" required><br><br>

    <label>Descrição:</label><br>
    <input type="text" name="descricao" value="<?php echo htmlspecialchars($modelo['descricao']); ?>" required><br><br>

    <label>Imagem do carro (Se quiser alteraração):</label><br>
    <input type="file" name="imagem" ><br><br>   

    <button type="submit">Salvar alterações</button> <br><br>
</form>


