<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "ej2";
$error = "";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['name'];
    $contrasena = $_POST['con'];

    $nombre = $conn->real_escape_string($nombre);
    $contrasena = $conn->real_escape_string($contrasena);
    $userol = "admin";

    $sql = "SELECT * FROM usuario WHERE name = '$nombre' AND password = '$contrasena' AND rol = '$userol' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Iniciar sesión
        $_SESSION['username'] = $nombre;
        header("Location: menu.php");
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/CSS.css">
    <title>Formulario</title>
</head>
<body>
    <section class="form-inicio">
        <form action="index.php" method="POST">
            <h1>Bienvenido</h1>
                <div>
                    <input class="user" type="text" size="25" name="name" placeholder="Nombre" required />
                </div>
                <div>
                    <input class="user" type="password" size="5" name="con" placeholder="Contraseña" required />
                </div>
                <div>
                    <input class="btn" type="submit" name="action" value="Iniciar sesión">
                </div>
        </form>
        <?php if ($error): ?>
            <div class="error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
    </section>
</body>
</html>




