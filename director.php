<?php

include("conexion.php");
$sql = "SELECT * FROM alumnos ORDER BY calificacion DESC";
$result = $conn->query($sql);

// Mostrar resultados en la tabla
if ($result->num_rows > 0) {

    echo "<table border='1'>
            <tr>
                <th>Grupo</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Calificacion</th>
                <th>Profesor</th>
            </tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["grupo"] . "</td>
            <td>" . $row["nombre"] . "</td>
            <td>" . $row["apellido"] . "</td>
            <td>" . $row["calificacion"] . "</td>
            <td>" . $row["profesor"] . "</td>
            </tr>";
    }
    echo "</table>";
} 

// Cerrar la conexión a la base de datos
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Director</title>
</head>
<body>
    <a href = http://localhost:4000/calificaciones/grafica.php> Ir a grafica <a/>
</body>
</html>
