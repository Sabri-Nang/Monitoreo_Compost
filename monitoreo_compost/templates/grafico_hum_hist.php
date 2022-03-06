<?php
$fecha_inicio = $_POST['fecha_inicio'];

$anio_inicio = substr($fecha_inicio,0,4); 
$mes_inicio = substr($fecha_inicio, 5, 2);
$dia_inicio = substr($fecha_inicio, 8,2);

$fecha_final= $_POST['fecha_final'];
$anio_final = substr($fecha_final, 0, 4);
$mes_final = substr($fecha_final, 5, 2);
$dia_final = substr($fecha_final, 8, 2);
$intervalo = $_POST['intervalo'];

//Funcion para obtener las temperatiras en el intervalo
function humedad_intervalo($fecha_inicio, $fecha_final, $intervalo){
    require_once('conexion.php');
    $conn = new conexion();

    $queryHumedad = "SELECT UNIX_TIMESTAMP(`Fecha`), `Humedad` FROM `historico` WHERE `Fecha` BETWEEN '$fecha_inicio' AND '$fecha_final';";
    $resultado = mysqli_query($conn->conectardb(), $queryHumedad);

    while($row = mysqli_fetch_row($resultado)){
        echo "[";
        echo ($row[0] - (60*60*3))*1000; //Paso la hora a GMT -3
        echo ",";
        echo $row[1];
        echo "],";

        for($x=0; $x<$intervalo; $x++){ //las filas que se salteará
            $row = mysqli_fetch_row($resultado);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hmedad en el tiempo</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href='css/historicos_curvas.css'>
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    
</head>
<body class="bg-dark text-white">
    <div>
        <h1>Electrónica Aplicada IoT</h1>
        <h3>Trabajo Final</h3> 
    </div>
    

    <nav class="navbar navbar-expand-sm bg-danger navbar-dark">
        <div class="container-fluid">
          <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="index.html">Proyecto</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="estados.php">Ver Estados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="temperatura_historica.html">Temperatura en el tiempo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="humedad_historica.html">Humedad en el tiempo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="max_min.php">Máximos y mínimos registrados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="actuador.php">Modificar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="futuro.html">A Futuro</a>
            </li>
          </ul>
        </div>
    </nav>
    

    <div class="container-fluid  my-5 bg-dark text-white">

        <h3 style="text-align:center">Registros de humedad a lo largo del tiempo</h3>
        
        <figure class="highcharts-figure">
            <div id="container"></div>
            <p class="highcharts-description">
                
            </p>
        </figure>
        
        <script type="text/javascript">
            Highcharts.chart('container', {
                chart: {
                    type: 'spline'
                },
                title: {
                    text: 'Humedad vs Tiempo'
                },
                subtitle: {
                    text: ' '
                },
                xAxis: {
                    type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                
                    month: '%e. %b',
                    year: '%b'
                },
                title: {
                    text: 'Fecha'
                }
            },
            yAxis: {
                title: {
                    text: 'Humedad (%)'
                },
                min: null
            },
            tooltip: {
                headerFormat: '<b>{series.name}</b><br>',
                pointFormat: '{point.x:%e. %b}: {point.y:.2f} %'
            },

            plotOptions: {
                series: {
                    marker: {
                        enabled: true
                    }
                }
            },

            colors: ['#6CF', '#39F', '#06C', '#036', '#000'],

            // Define the data points. All series have a dummy year
            // of 1970/71 in order to be compared on the same x axis. Note
            // that in JavaScript, months start at 0 for January, 1 for February etc.
            series: [{
                name: "<?php echo 'Porcentaje de humedad registradas entre el dia '.$dia_inicio.' del mes '.$mes_inicio.' del año '.$anio_inicio;
                echo '<br>y el día '.$dia_final.' del mes '.$mes_final.' del año '.$anio_final;
                  ?>",
                data: [<?php humedad_intervalo($fecha_inicio, $fecha_final, $intervalo);?>
                ]
            }],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        plotOptions: {
                            series: {
                                marker: {
                                    radius: 2.5
                                }
                            }
                        }
                    }
                }]
            }
            });

        </script>
        <div style="text-align: center;">
            <button type="button" class="btn btn-primary btn-lg" onclick="location.href='humedad_historica.html'">Regresar</button>
        </div>

        
            
        

     </div>
    
      
</body>