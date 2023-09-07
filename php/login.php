<?php
session_start();
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Inicio de sesión exitoso
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location:dashboard.php"); // Redirige a la página de inicio después del inicio de sesión exitoso
    } else {
        // Inicio de sesión fallido
        echo "Credenciales incorrectas. Por favor, inténtalo de nuevo.";
    }
}
?>
