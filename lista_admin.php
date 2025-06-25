
<?php
require_once 'conexao_socars.php';
require_once 'verifica_admin.php';
require 'processa_delete.php';

$dados = $pdo->query("SELECT * FROM usuario WHERE acesso = 'admin' OR acesso = 'admin_principal'")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="lista_admin.css">
    <title>Lista de Administradores</title>
</head>
<body>
    <table>
        <caption>Lista de Administradores</caption>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>ID</th>
                <th>Deletar</th>
            </tr>
        </thead>     
        <tbody>
            <?php foreach ($dados as $dado): ?>
                <tr>
                    <td><?= htmlspecialchars($dado['nome']) ?></td>
                    <td><?= htmlspecialchars($dado['email']) ?></td>
                    <td><?= $dado['id'] ?></td>
                    <td>
                        <a href="processa_delete.php?id=<?= $dado['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este administrador?')">
                            <button>Excluir</button>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br><br>
    <a href="home.php">
        <button>Retornar</button>
    </a>
</body>
</html>
<script>
window.addEventListener('pageshow', function(event) {
    if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
        // Se foi acessado via cache do histórico, força recarr.
        // egar
        window.location.reload();
    }
});
</script>
