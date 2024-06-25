<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mi_base_de_datos";

// Crear una nueva conexión utilizando MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    // Si la conexión falla, muestra un mensaje de error y termina el script
    die("Conexión fallida: " . $conn->connect_error);
}

// Si la conexión es exitosa, $conn contiene ahora el objeto de conexión a la base de datos
?>
