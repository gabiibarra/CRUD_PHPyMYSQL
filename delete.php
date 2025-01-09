<?php
$conn = mysqli_connect('localhost', 'root', '', 'ej2');

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $type = $_POST['type'];
    if ($type == 'product' && isset($_POST['action']) && $_POST['action'] == 'Eliminar') {
        $sql = "DELETE FROM productos WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            header("Location: product.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } elseif ($type == 'user' && isset($_POST['action']) && $_POST['action'] == 'Eliminar') {
        $sql = "DELETE FROM usuario WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            header("Location: user.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
} else {
    if (isset($_GET['id']) && isset($_GET['type'])) {
        $id = $_GET['id'];
        $type = $_GET['type'];
        echo "<html>
          <head>
            <title>Resultado</title>
            <link rel='stylesheet' href='CSS/CSS.css'>
           </head>
           <body>
                <section class='form-inicio'>
                <form method='post' action=''>
                    <input type='hidden' name='id' value='$id'>
                    <input type='hidden' name='type' value='$type'>
                    <h2>¿Estás seguro de que quieres eliminar el ítem con ID: $id ?</h2><br>
                    <input class='b1' type='submit' name='action' value='Eliminar'>
                 </form>                
                </section>
            </body>
       </html>";
    } else {
        echo "No se ha proporcionado un ID válido.";
    }
}
?>

