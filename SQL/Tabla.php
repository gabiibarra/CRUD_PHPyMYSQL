<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ej2";

// Crea la conexión
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Crea la tabla usuario
$sql1 = "CREATE TABLE usuario (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL,
password VARCHAR(30) NOT NULL,
rol VARCHAR(20) NOT NULL
)";

// Crea la tabla productos
$sql2 = "CREATE TABLE productos (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nombre_prod VARCHAR(30) NOT NULL,
precio INT NOT NULL
)";

// Ejecutar consulta para crear tabla usuario
if (mysqli_query($conn, $sql1)) {
  echo "Table usuario created successfully<br>";
} else {
  echo "Error creating table usuario: " . mysqli_error($conn) . "<br>";
}

// Ejecutar consulta para crear tabla productos
if (mysqli_query($conn, $sql2)) {
  echo "Table productos created successfully<br>";
} else {
  echo "Error creating table productos: " . mysqli_error($conn) . "<br>";
}

// Insertar datos en la tabla usuario
$sql3 = "INSERT INTO usuario (name, password, rol)
VALUES ('gabi', '123', 'admin')";

if (mysqli_query($conn, $sql3)) {
  echo "New record created successfully for usuario<br>";
} else {
  echo "Error: " . $sql3 . "<br>" . mysqli_error($conn) . "<br>";
}

// Insertar datos en la tabla productos
$sql4 = "INSERT INTO productos (nombre_prod, precio)
VALUES ('Pizza', 10),
('Empanada', 30),
('Hamburguesa', 50)";

if (mysqli_query($conn, $sql4)) {
  echo "New record created successfully for productos<br>";
} else {
  echo "Error: " . $sql4 . "<br>" . mysqli_error($conn) . "<br>";
}

mysqli_close($conn);
?>
