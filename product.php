<?php
include("conexion.php");
$con = connection();

$sql = "SELECT * FROM productos";
$query = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/CSS.css">        
    <title>PRODUCTOS</title>
</head>
<body>
    <section class="form-db">
        <div>
            <form action="create.php" method="POST"> 
                <h1>Agregar nuevo producto</h1>
                <input class="user" type="text" name="nombre_prod" placeholder="Nombre" required>
                <input class="user" type="text" name="precio" placeholder="Precio" required>
                <input class="btn" type="submit" value="Agregar">
            </form>
        </div>
        <h1>Productos registrados</h1>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($query)): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['nombre_prod'] ?></td>
                            <td><?= $row['precio'] ?></td>
                            <td class="actions">
                                <a name="action" href="update.php?id=<?= $row['id'] ?>&type=product">Editar</a>
                                <a name="action" href="delete.php?id=<?= $row['id'] ?>&type=product">Eliminar</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
    </section>
</body>
</html>
