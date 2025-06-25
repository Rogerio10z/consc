<?php
require_once 'verifica_admin.php';
require 'conexao_socars.php';

// Pega todas as marcas para popular o select
$marcas = $pdo->query("SELECT * FROM marca")->fetchAll(PDO::FETCH_ASSOC);

// Pega o filtro da marca pela URL (GET)
$filtroMarca = $_GET['id_marca'] ?? '';

$sql = "SELECT mo.id, mo.nome_modelo, mo.preco, mo.motor, ma.nome_marca, mo.imagem
        FROM modelo mo 
        INNER JOIN marca ma ON ma.id = mo.id_marca";
        
// Se tiver filtro, adiciona condição WHERE
$params = [];
if ($filtroMarca) {
    $sql .= " WHERE ma.id = :id_marca";
    $params[':id_marca'] = $filtroMarca;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$modelos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<body>
    <link rel="stylesheet" href="carros_admin.css">
    <link rel="stylesheet" href="style.css">
   
    
<h1>Todos os Carros</h1>
<div class="top-bar">
    <a href="home.php"><button>Retornar à página principal</button></a>
    
    <form method="GET" action="">
        <label for="marca">Filtrar por marca:</label>
        <select name="id_marca" id="marca" onchange="this.form.submit()">
            <option value="">Todas as marcas</option>
            <?php foreach($marcas as $marca): ?>
                <option value="<?= $marca['id'] ?>" <?= ($marca['id'] == $filtroMarca) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($marca['nome_marca']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>
</div>


<div class="carros-container">
    <?php foreach ($modelos as $modelo): ?>

    <div class="card">
        <img src="<?php echo htmlspecialchars($modelo['imagem']); ?>" alt="Imagem do modelo" width="200">
        <h3><?php echo htmlspecialchars($modelo['nome_modelo']); ?></h3>
        <p><strong>Preço:</strong> R$ <?php echo htmlspecialchars($modelo['preco']); ?></p>
        <p><strong>Motor:</strong> <?php echo htmlspecialchars($modelo['motor']); ?></p>
        <p><strong>Marca:</strong> <?php echo htmlspecialchars($modelo['nome_marca']); ?></p>
        <a href="modelo_info.php?id=<?php echo $modelo['id']; ?>">
            <button type="button">Ver Mais</button>
        </a><br><br>
        <a href="edit.php?id=<?php echo $modelo['id']; ?>">
            <button type="button">Editar</button>
        </a><br><br>
        <a href="delete.php?id=<?php echo $modelo['id']; ?>">
            <button type="button">Deletar</button>
        </a>
    </div>
</div>

   
<?php endforeach; ?>

</body>
</html>
<script>
window.addEventListener('pageshow', function(event) {
    if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
        // Se foi acessado via cache do histórico, força recarregar
        window.location.reload();
    }
});
</script>
