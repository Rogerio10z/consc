<?php
require 'conexao_socars.php';

// Pega todas as marcas para popular o select
$marcas = $pdo->query("SELECT * FROM marca")->fetchAll(PDO::FETCH_ASSOC);

// Pega o filtro da marca pela URL (GET)
$filtroMarca = $_GET['id_marca'] ?? '';

// Monta a consulta base
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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="carros.css">
    <link rel="stylesheet" href="carros_admin.css">
</head>

       <nav>
      <div class="container nav-container">
        <a href="" class="logo"><img src="logo.png" alt="" /></a>
        <ul class="nav-link">
          <li><a href="index.html" style="--i: 1"></a>Inicio</li>
          <li><a href="index.html#Modelos" style="--i: 2">Modelos</a></li>
          <li><a href="carros.php" style="--i: 3">Carros</a></li>
          <li><a href="index.html#Contatos" style="--i: 4">Contatos</a></li>
        </ul>
        <div class="btn-all">
          <a href="login.php"> <div class="btn-login"><button>Login</button></div></a>
          <a href="registro_user.php"><div class="btn-cadastro"><button>Cadastre-se</button></div></a>
        </div>
      </div>
    </nav>

    <div class="titlecarros"><h1>Todos os Carros</h1></div>

<br><br>

<!-- Formulário para filtro -->
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
        <img src="<?= htmlspecialchars($modelo['imagem']) ?>" alt="Imagem do modelo">
        <h3><?= htmlspecialchars($modelo['nome_modelo']) ?></h3>
        <p><strong>Ano:</strong> <?= date('Y') ?></p>
        <p><strong>Preço:</strong> R$ <?= number_format($modelo['preco'], 2, ',', '.') ?></p>
        <p><strong>Motor:</strong> <?= htmlspecialchars($modelo['motor']) ?></p>
        <p><strong>Marca:</strong> <?= htmlspecialchars($modelo['nome_marca']) ?></p>
        <a href="modelo_info.php?id=<?= $modelo['id'] ?>">
            <button type="button">Ver Detalhes</button>
        </a>
    </div>
    
<?php endforeach; ?>


</body>
</html>
