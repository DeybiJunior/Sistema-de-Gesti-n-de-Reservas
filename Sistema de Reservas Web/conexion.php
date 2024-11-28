<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_reservas";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
