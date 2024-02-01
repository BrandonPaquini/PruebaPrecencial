<?php

include("conexion.php");
// Recuperar datos del formulario
$username = $_POST['username'];
$password = $_POST['password'];

// Consulta SQL para verificar el usuario y la contraseña
$sql = "SELECT * FROM usuarios WHERE nombre_prof='$username' AND contrasenia='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Obtener el puesto del usuario
    $row = $result->fetch_assoc();
    $puesto = $row['puesto'];

    session_start();
    $_SESSION['username'] = $username;
    
    // Redirigir según el puesto
    switch ($puesto) {
        case 'Director':
            header("Location: director.php");
            break;
        case 'maestro':
            header("Location: maestro.php");
            break;
        
        default:
            header("Usuario o contraseña incorrectos. Inténtalo de nuevo.");
    }
} else {
    // Usuario o contraseña incorrectos
    echo "Usuario o contraseña incorrectos. Inténtalo de nuevo.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
