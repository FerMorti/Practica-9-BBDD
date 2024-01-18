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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $dni = $_POST['DNI'];

    $sql = "SELECT * FROM usuarios WHERE nombre=:nombre AND dni=:dni";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        session_start(); 
        $_SESSION['nombre_usuario'] = $nombre;  
        header("location: Index.php");
    } else {
        echo "Login fallido";
    }
}
?>
