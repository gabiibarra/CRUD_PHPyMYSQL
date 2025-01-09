<?php
include("conexion.php");
$con = connection();

$sql = "SELECT * FROM usuario";
$query = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/CSS.css">    
    <title>USUARIOS</title>
</head>
<body>
    <section class="form-db">
        <div>
            <form action="create.php" method="POST"> 
                <h1>Agregar nuevo usuario</h1>
                <input class="user" type="text" name="name" placeholder="Nombre" required>
                <input class="user" type="text" name="password" placeholder="Cotraseña" required>
                <input class="user" type="text" name="rol" placeholder="Rol" required>
                <input class = "btn" type="submit" value="Agregar">
            </form>
        </div>
        <h1>Usuarios registrados</h1>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Contraseña</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($query)): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['password'] ?></td>
                            <td><?= $row['rol'] ?></td>
                            <td class="actions">
                                <a name="action" href="update.php?id=<?= $row['id'] ?>&type=user">Editar</a>
                                <a name="action" href="delete.php?id=<?= $row['id'] ?>&type=user">Eliminar</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
    </section>
</body>
</html>