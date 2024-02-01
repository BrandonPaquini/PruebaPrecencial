<?php
include("conexion.php");

// Consulta SQL para obtener los promedios por grupo
$sql = "SELECT grupo, AVG(calificacion) as promedio FROM alumnos GROUP BY grupo";
$result = $conn->query($sql);


$datosCalificaciones = array();


while ($row = $result->fetch_assoc()) {
    $datosCalificaciones[] = array(
        'grupo' => $row['grupo'],
        'promedio' => $row['promedio']
    );
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico de Calificaciones</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <div style="width: 30%;">
        <canvas id="graficoCalificaciones"></canvas>
    </div>

    <script>
        // Obtener los datos desde PHP
        var datosCalificaciones = <?php echo json_encode($datosCalificaciones); ?>;

        // Obtener el contexto del canvas
        var ctx = document.getElementById('graficoCalificaciones').getContext('2d');

        // Configurar el gráfico de barras
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: datosCalificaciones.map(item => item.grupo),
                datasets: [{
                    label: 'Calificaciones Promedio por Grupo',
                    data: datosCalificaciones.map(item => item.promedio),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <a href = http://localhost:4000/calificaciones/director.php> Regresar </a>

</body>
</html>
