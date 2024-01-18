<?php
$dsn = 'mysql:host=localhost;dbname=crud_example';
$usuario_bd = 'root';
$contrasena_bd = '';

try {
    $pdo = new PDO($dsn, $usuario_bd, $contrasena_bd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Error de conexión a la base de datos: ' . $e->getMessage());
}

function agregarUsuario($nombre, $apellidos, $email, $dni) {
    global $pdo;
    $stmt = $pdo->prepare('INSERT INTO usuarios (nombre, apellidos, email, dni) VALUES (?, ?, ?, ?)');
    $stmt->execute([$nombre, $apellidos, $email, $dni]);
}

function obtenerUsuarios() {
    global $pdo;
    $stmt = $pdo->query('SELECT * FROM usuarios');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function obtenerUsuarioPorId($id) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function actualizarUsuario($id, $nombre, $apellidos, $email, $dni) {
    global $pdo;
    $stmt = $pdo->prepare('UPDATE usuarios SET nombre = ?, apellidos = ?, email = ?, dni = ? WHERE id = ?');
    $stmt->execute([$nombre, $apellidos, $email, $dni, $id]);
}
?>
