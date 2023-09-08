<?php
session_start();
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta preparada para evitar la inyección de SQL
    $stmt = $conn->prepare("SELECT username, password FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($username, $hashed_password);
        $stmt->fetch();

        // Verificar la contraseña utilizando password_verify
        if (password_verify($password, $hashed_password)) {
            // Inicio de sesión exitoso
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header("Location: dashboard.php"); // Redirige a la página de inicio después del inicio de sesión exitoso
        } else {
            // Contraseña incorrecta
            echo "Credenciales incorrectas. Por favor, inténtalo de nuevo.";
        }
    } else {
        // Usuario no encontrado
        echo "Credenciales incorrectas. Por favor, inténtalo de nuevo.";
    }

    $stmt->close();
}
?>