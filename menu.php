<?php
include("conexion.php");
$con = connection();
session_start();
$name = isset($_SESSION['username']) ? $_SESSION['username'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['action'] == 'Usuarios') {
        header("Location: user.php");
        exit();
    } elseif ($_POST['action'] == 'Productos') {
        header("Location: product.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/CSS.css">
    <title>MENU</title>
</head>
<body>
    <section class="form-inicio">
        <h1>Bienvenido <?php echo htmlspecialchars($name); ?></h1>
        <form action="" method="POST">
            <div class="boton">
                <button type="submit" name="action" value="Usuarios">Usuarios</button>
                <button type="submit" name="action" value="Productos">Productos</button>
            </div>
        </form>
        <br>
        <p><a href="index.php">Cerrar sesión</a></p>
    </section>
</body>
</html>
