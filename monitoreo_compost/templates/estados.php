<?php
$dispositivo='node1';

function temperatura_actual($dispositivo){
    require_once('conexion.php');
    $conn=new conexion();
    
    //Esta es la consulta para ver la temperatura en la tabla de estado
    //SELECT `temperatura` FROM `estado` WHERE `dispositivo`='node1';
    $queryTemp="SELECT `Temperatura` FROM `estado` WHERE `Dispositivo`='$dispositivo'";
    $resultado= mysqli_query($conn->conectardb(),$queryTemp);
    $row=mysqli_fetch_row($resultado);
    //echo $row[0];
    return $row[0];

      
    }

function humedad_actual($dispositivo){
    require_once('conexion.php');
    $conn=new conexion();
    
    //Esta es la consulta para ver la temperatura en la tabla de estado
    //SELECT `humedad` FROM `estado` WHERE `dispositivo`='node1';
    $queryTemp="SELECT `Humedad` FROM `estado` WHERE `Dispositivo`='$dispositivo'";
    $resultado= mysqli_query($conn->conectardb(),$queryTemp);
    $row=mysqli_fetch_row($resultado);

    return $row[0];
  
    }

function bomba_actual($dispositivo){
    require_once('conexion.php');
    $conn=new conexion();
    
    $queryTemp="SELECT `Bomba` FROM `estado` WHERE `Dispositivo`='$dispositivo'";
    $resultado= mysqli_query($conn->conectardb(),$queryTemp);
    $row=mysqli_fetch_row($resultado);

    //echo $row[0];
    return $row[0];
    
    }

$tempAct = temperatura_actual($dispositivo);
$humAct = humedad_actual($dispositivo);
$bomba = bomba_actual($dispositivo);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Estado Actual</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--<link type="text/css" rel="stylesheet" href='css/max_min.css'>-->
    <link type="text/css" rel="stylesheet" href='../css/max_min.css'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@700&display=swap" rel="stylesheet">
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <link type="text/css" rel="stylesheet" href='../css/main.css'>  
    <script src="https://kit.fontawesome.com/c87eaff8e4.js" crossorigin="anonymous"></script>
    
</head>
<body class="bg-dark text-white" style="font-family: 'Roboto Mono', monospace;">
  <div class="container p-5" style="color:blanchedalmond" >
        <h1>Monitoreo de variables del compost</h1>
        <h3>Electrónica Aplicada IoT. Trabajo Final</h3> 
  </div>


    <nav class="navbar navbar-expand-sm bg-danger navbar-dark">
        <div class="container-fluid">
          <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.html">Proyecto</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="estados.php">Ver Estados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="temperatura_historica.html">Temperatura en el tiempo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="humedad_historica.html">Humedad en el tiempo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="max_min.php">Máximos y mínimos registrados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="actuador.php">Bomba de Agua</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="futuro.html">A Futuro</a>
            </li>
 
          </ul>
        </div>
    </nav>
    

    <div class="container-fluid  my-5 bg-dark text-white">

        <h3 style="text-align:center">Estado Actual</h3>
        
        <figure class="highcharts-figure">
            <div id="container-speed" class="chart-container"></div>
            <div id="container-rpm" class="chart-container"></div>
            <div class="highcharts-description">
                <h3 style="text-align:center;">Temperatura y Humedad actual</h3>
            <div>
            
        </figure>
            
        <script type="text/javascript">


            var gaugeOptions = {
                chart: {
                    type: 'solidgauge'
                },

                title: null,

                pane: {
                    center: ['50%', '85%'],
                    size: '140%',
                    startAngle: -90,
                    endAngle: 90,
                    background: {
                        backgroundColor:
                            Highcharts.defaultOptions.legend.backgroundColor || '#EEE',
                        innerRadius: '60%',
                        outerRadius: '100%',
                        shape: 'arc'
                    }
                },

                exporting: {
                    enabled: false
                },

                tooltip: {
                    enabled: false
                },

                // the value axis
                yAxis: {
                    stops: [
                        [0.1, '#55BF3B'], // green
                        [0.5, '#DDDF0D'], // yellow
                        [0.9, '#DF5353'] // red
                    ],
                    lineWidth: 0,
                    tickWidth: 0,
                    minorTickInterval: null,
                    tickAmount: 2,
                    title: {
                        y: -70
                    },
                    labels: {
                        y: 16
                    }
                },

                plotOptions: {
                    solidgauge: {
                        dataLabels: {
                            y: 5,
                            borderWidth: 0,
                            useHTML: true
                        }
                    }
                }
            };

            // TEMPERATURA
            var chartSpeed = Highcharts.chart('container-speed', Highcharts.merge(gaugeOptions, {
                yAxis: {
                    min: 0,
                    max: 120,
                    title: {
                        text: 'TEMPERATURA'
                    }
                },

                credits: {
                    enabled: false
                },

                series: [{
                    name: 'TEMPERATURA',
                    data: [parseFloat("<?php echo $tempAct; ?>")],
                    dataLabels: {
                        format:
                            '<div style="text-align:center">' +
                            '<span style="font-size:25px">{y}</span><br/>' +
                            '<span style="font-size:12px;opacity:0.4">ºC</span>' +
                            '</div>'
                    },
                    tooltip: {
                        valueSuffix: ' ºC'
                    }
                }]

            }));

            // HUMEDAD
            var chartRpm = Highcharts.chart('container-rpm', Highcharts.merge(gaugeOptions, {
                yAxis: {
                    min: 0,
                    max: 100,
                    title: {
                        text: 'HUMEDAD'
                    }
                },

                series: [{
                    name: 'HUMEDAD',
                    data: [parseInt("<?php echo $humAct; ?>")],
                    dataLabels: {
                        format:
                            '<div style="text-align:center">' +
                            '<span style="font-size:25px">{y:.1f}</span><br/>' +
                            '<span style="font-size:12px;opacity:0.4">%</span>' +
                            '</div>'
                    },
                    tooltip: {
                        valueSuffix: ' %'
                    }
                }]

            }));
        </script>

        <div class="mt-5 p-3 bg-primary text-white rounded"> 
            <?php
                $bomba = bomba_actual($dispositivo);
                $tempAct = temperatura_actual($dispositivo);
                $humAct = humedad_actual($dispositivo);

                if($bomba==1){
                    echo "<h5 style='text-align:center;'>La bomba se encuentra PRENDIDA</h4>";
                
                }else if($bomba==0){
                    echo "<h5 style='text-align:center;'>La bomba se encuentra APAGADA</h4>";
                }
                if($tempAct>70){
                    echo "<h5 style='text-align:center'>La temperatura es demasiado alta. Encender la bomba o airear</h5>";
                } else if ($tempAct<35){
                    echo "<h5 style='text-align:center'>La temperatura es demasiado baja. Incorporar restos húmedos para aumentar el volumen. En las últimas fases la temperatura es normal</h5>";
                } else if ($tempAct>=35 && $tempAct<=70){
                    echo "<h5 style='text-align:center'>Temperatura óptima para fase intermedia</h5>";
                }
                if($humAct<40){

                    echo "<h5 style='text-align:center'>Humedad baja. En fase intermedia añadir materiales húmedos o encender la bomba hasta que la humedad ronde el 50%.</h5>";
                } else if($humAct>60){
                    echo "<h5 style='text-align:center'>La humedad es demasiado alta, incorporar materiales secos</h5>";
                } else if($humAct>=40 && $humAct<=60){
                    echo "<h5 style='text-align:center'>La humedad es óptima</h5>";
                }
                if($humAct>=70 && $bomba==1){
                    echo "<h5 style='text-align:center'>Humedad alta y bomba encendida. Apagar bomba</h5>";
                }
            
            ?>
        </div>

     </div>
     <center>
           <footer style="color:blanchedalmond">
    <br>
    <div style="color:blanchedalmond">
            <a href="https://www.instagram.com/" target="_blank" ><i class="fab fa-instagram fa-2x"></i></a>
            <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter fa-2x"></i></a>
            <a href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin fa-2x"></i></a>
            <a href="mailto:sabrinadelosangelessanches@gmail.com" target="_blank"><i class="far fa-envelope fa-2x"></i></a>
    </div>
    <p>Creadora: Sabrina Sanches<br>
    <p>Derechos reservados @2021</p>
    
    <br>
  </footer>
     </center>
    
      
</body>
<?php
//Vuelvo a acargar la pagina para actuallizar los datos
    echo '<script type="text/JavaScript"> location.reload(); </script>';
    sleep(6);
?>