<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Alumnos</title>
</head>
<body>

    <h2>Registro de Alumnos</h2>

    <form action="maestro.php" method="post">

        <label for="grupo">Grupo:</label>
        <input type="text" id="grupo" name="grupo" required>

        <br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <br>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>

        <br>

        <label for="calificacion">Calificación:</label>
        <input type="text" id="calificacion" name="calificacion" required>

        <br>

        <input type="hidden" name="profesor" value="<?php echo htmlspecialchars($username); ?>">

        <input type="submit" value="Registrar Alumno">

        
    </form>

</body>
</html>


<?php
include("conexion.php");
session_start();

// Verificar si los datos del formulario están presentes
if (isset($_POST['grupo'], $_POST['nombre'], $_POST['apellido'], $_POST['calificacion'], $_SESSION['username'])) {
    // Recuperar datos del formulario
    
    $grupo = $_POST['grupo'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $calificacion = $_POST['calificacion'];
    $profesor = $_SESSION['username'];
    

    // Insertar datos en la tabla de alumnos
    $sql = "INSERT INTO alumnos (grupo, nombre, apellido, calificacion, profesor) VALUES ('$grupo', '$nombre', '$apellido', '$calificacion', '$profesor')";

    if ($conn->query($sql) === TRUE) {
        echo "Alumno registrado con éxito.";
    } else {
        echo "Error al registrar al alumno: " . $conn->error;
    }
} else {
    echo "Error: Datos del formulario incompletos.";
}

// Consultar los datos de la tabla de alumnos
$sql = "SELECT * FROM alumnos WHERE profesor = '{$_SESSION['username']}' ORDER BY calificacion DESC";
$result = $conn->query($sql);

// Mostrar resultados en la tabla
if ($result->num_rows > 0) {

    echo "<table border='1'>
            <tr>
                <th>Grupo</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Calificacion</th>
            </tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["grupo"] . "</td>
            <td>" . $row["nombre"] . "</td>
            <td>" . $row["apellido"] . "</td>
            <td>" . $row["calificacion"] . "</td>
            </tr>";
    }
    echo "</table>";
} 

$sql_prom = "SELECT grupo, AVG(calificacion) AS promedio_calificacion FROM alumnos WHERE profesor = '{$_SESSION['username']}' GROUP BY grupo ORDER BY promedio_calificacion DESC";
$result_prom = $conn->query($sql_prom);

if ($result_prom->num_rows > 0) {

    echo "<table border='1'>
            <tr>
                <th>Grupo</th>
                <th>Promedio</th>
            </tr>";
    
    while ($row = $result_prom->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["grupo"] . "</td>
            <td>" . $row["promedio_calificacion"] . "</td>
            </tr>";
    }
    echo "</table>";
} 
// Cerrar la conexión a la base de datos
$conn->close();
?>
