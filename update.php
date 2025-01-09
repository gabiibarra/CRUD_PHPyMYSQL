<?php
include("conexion.php");
$conn = connection();

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $type = $_POST['type'];

    if ($type == 'product') {
        $name_prod = $_POST['nombre_prod'];
        $precio = $_POST['precio'];
        $sql = "UPDATE productos SET nombre_prod='$name_prod', precio='$precio' WHERE id=$id";
    } elseif ($type == 'user') {
        $name = $_POST['nombre'];
        $pass = $_POST['password'];
        $rol = $_POST['rol'];
        $sql = "UPDATE usuario SET nombre='$name', password='$pass', rol='$rol' WHERE id=$id";
    }

    if (mysqli_query($conn, $sql)) {
        if ($type == 'product') {
            header("Location: product.php");
        } else {
            header("Location: user.php");
        }
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    if (isset($_GET['id']) && isset($_GET['type'])) {
        $id = $_GET['id'];
        $type = $_GET['type'];

        if ($type == 'product') {
            $sql = "SELECT id, nombre_prod, precio FROM productos WHERE id=$id";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $name_prod = $row['nombre_prod'];
                $precio = $row['precio'];
            } else {
                echo "No se encontró el producto con ID: $id";
                exit();
            }
        } elseif ($type == 'user') {
            $sql = "SELECT id, name, password, rol FROM usuario WHERE id=$id";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $name = $row['name'];
                $pass = $row['password'];
                $rol = $row['rol'];
            } else {
                echo "No se encontró el usuario con ID: $id";
                exit();
            }
        }
    } else {
        echo "No se ha proporcionado un ID válido.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Actualizar <?= $type == 'product' ? 'Producto' : 'Usuario' ?></title>
    <link rel="stylesheet" href="CSS.css">
</head>
<body>
    <section class="form-inicio">
        <form method="post" action="">
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="type" value="<?= $type ?>">
            <?php if ($type == 'product'): ?>
                <h2>Nombre del Producto: </h2>
                <input class="user" type="text" name="nombre_prod" value="<?= $name_prod ?>"><br>
                <h2>Precio: </h2>
                <input class="user" type="text" name="precio" value="<?= $precio ?>"><br>
            <?php elseif ($type == 'user'): ?>
                <h2>Nombre:</h2>
                <input class="user" type="text" name="name" value="<?= $name ?>"><br>
                <h2>Contraseña:</h2>
                <input class="user" type="password" name="password" value="<?= $pass ?>"><br>
                <h2>Rol:</h2>
                <input class="user" type="text" name="rol" value="<?= $rol ?>"><br>
            <?php endif; ?>
            <input class="b1" type="submit" value="Actualizar">
        </form>
    </section>        
</body>
</html>
