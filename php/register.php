<?php
session_start();
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $mail = $_POST['mail'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificar si el usuario ya existe
    $check_query = "SELECT * FROM usuarios WHERE username='$username' OR correo='$mail'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        // El usuario ya existe
     
        echo '<script>
        alert("El usuario o correo ya está registrado. Por favor, elige otro.");
        window.location.href = "../register.html";
      </script>';
    } else {
        // Codificar la contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Registrar al nuevo usuario
        $insert_query = "INSERT INTO usuarios (nombre, apellido, correo, username, password) VALUES ('$name', '$lastname', '$mail', '$username', '$hashed_password')";
        
        if ($conn->query($insert_query) === TRUE) {
            // Registro exitoso, redirigir al usuario a la página de inicio de sesión
            echo '<script>
                    alert("Registro exitoso. Redirigiendo a la página de inicio de sesión.");
                    window.location.href = "../index.html";
                  </script>';
        } else {
            echo "Error al registrar al usuario: " . $conn->error;
        }
    }
}
?>
