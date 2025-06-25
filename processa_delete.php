<?php
require_once 'verifica_admin.php';
require_once 'conexao_socars.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($id == 1) {
        echo "<script>
                alert('Impossível deletar Administrador Principal.');
                window.location.href = 'lista_admin.php';
              </script>";
        exit;
    }

    $stmt = $pdo->prepare("DELETE FROM usuario WHERE id = :id AND acesso = 'admin'");

    $stmt->execute(['id' => $id]);

    if ($stmt->rowCount() > 0) {
        echo "<script>
                alert('Administrador removido com sucesso.');
                window.location.href = 'lista_admin.php';
              </script>";
    } else {
        echo "<script>
                alert('Erro: o administrador não foi encontrado ou não tem permissão para ser removido.');
                window.location.href = 'lista_admin.php';
              </script>";
    }
    exit;
}
?>
