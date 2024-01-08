<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Editar Usuario</title>
</head>
<body>

<?php
include('gestion.php');

if (isset($_GET['id'])) {
    $usuarioId = $_GET['id'];
    $usuario = obtenerUsuarioPorId($usuarioId);

    if ($usuario) {
        if (isset($_POST['guardar_cambios'])) {
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $email = $_POST['email'];
            $dni = $_POST['dni'];

            actualizarUsuario($usuarioId, $nombre, $apellidos, $email, $dni);
            header('Location: index.php');
            exit();
        }
?>
        <center><form method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>
            <label for="apellidos">Apellidos:</label>
            <input type="text" name="apellidos" value="<?php echo $usuario['apellidos']; ?>" required>
            <label for="email">E-mail:</label>
            <input type="email" name="email" value="<?php echo $usuario['email']; ?>" required>
            <label for="dni">DNI:</label>
            <input type="text" name="dni" value="<?php echo $usuario['dni']; ?>" required>
            <button type="submit" name="guardar_cambios">Guardar Cambios</button>
        </form></center>
<?php
    } else {
        echo "Usuario no encontrado.";
    }
} else {
    echo "ID de usuario no proporcionado.";
}
?>

</body>
</html>
