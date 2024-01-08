<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Example</title>
    <link rel="stylesheet" href="style.css">

    <script>
        function eliminarUsuario(usuarioId) {
            var confirmacion = confirm("¿Estás seguro de que deseas eliminar este usuario?");
            
            if (confirmacion) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "eliminar.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        document.getElementById("fila-" + usuarioId).remove();
                    }
                };
                xhr.send("id=" + usuarioId);
            }
        }
    </script>
</head>
<body>
    
    <center>
    <form method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" required>
        <label for="email">E-mail:</label>
        <input type="email" name="email" required>
        <label for="dni">DNI:</label>
        <input type="text" name="dni" required>
        <button type="submit" name="agregar_usuario">Agregar Usuario</button>
    </form>
    </center>

    <center><table border="1">
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>DNI</th>
            <th>Acciones</th>
        </tr>
        <?php 
        include('gestion.php');
        if (isset($_POST['agregar_usuario'])) {
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $email = $_POST['email'];
            $dni = $_POST['dni'];

            agregarUsuario($nombre, $apellidos, $email, $dni);
        }

        $usuarios = obtenerUsuarios();
        foreach ($usuarios as $usuario) : ?>
            <tr id="fila-<?php echo $usuario['id']; ?>">
                <td><?php echo $usuario['nombre']; ?></td>
                <td><?php echo $usuario['apellidos']; ?></td>
                <td><?php echo $usuario['email']; ?></td>
                <td><?php echo $usuario['dni']; ?></td>
                <td>
                    <a href="editar.php?id=<?php echo $usuario['id']; ?>">Editar</a> |
                    <a href="#" onclick="eliminarUsuario(<?php echo $usuario['id']; ?>)">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table></center>


    
</body>
</html>
