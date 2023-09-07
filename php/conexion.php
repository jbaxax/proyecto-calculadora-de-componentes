<?php
$servername = "localhost";
$port = 33065;
$username = "root";
$password = "";
$database = "innovabd";

$conn = new mysqli($servername, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}
?>
