<?php
include('gestion.php');

if (isset($_POST['id'])) {
    $usuarioId = $_POST['id'];
    eliminarUsuario($usuarioId);
}

function eliminarUsuario($id) {
    global $pdo;
    $stmt = $pdo->prepare('DELETE FROM usuarios WHERE id = ?');
    $stmt->execute([$id]);
}
?>
