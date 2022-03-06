<!DOCTYPE html>
<html lang="en">
<head>
    <title>Historicos</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href='../css/max_min.css'>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@700&display=swap" rel="stylesheet">
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
                <a class="nav-link" href="estados.php">Ver Estados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="temperatura_historica.html">Temperatura en el tiempo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="humedad_historica.html">Humedad en el tiempo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="max_min.php">Máximos y mínimos registrados</a>
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
        
     
      <br>
      <br>
      <h3 style="text-align:center" >Valores históricos máximos y mínimos</h3>
      <br>
    
      <figure class="highcharts-figure">
        <div id="container-speed" class="chart-container"></div>
        <div id="container-rpm" class="chart-container"></div>
        <div id="container-tempMin" class="chart-container"></div>
        <div id="container-humMin" class="chart-container"></div>
    
        <?php

          require_once('conexion.php');
          $conn = new conexion();
          $queryTempMax = "SELECT MAX(Temperatura) max_temperatura FROM historico;";
          $result = mysqli_query($conn->conectardb(), $queryTempMax);
          $row = mysqli_fetch_row($result);
          $tempMax = $row[0];
    
          $queryHumMax = "SELECT MAX(Humedad) max_humedad FROM historico;";
          $result = mysqli_query($conn->conectardb(), $queryHumMax);
          $row = mysqli_fetch_row($result);
          $humMax = $row[0];

          $queryTempMin = "SELECT MIN(Temperatura) min_temperatura FROM historico;";
          $result = mysqli_query($conn->conectardb(), $queryTempMin);
          $row = mysqli_fetch_row($result);
          $tempMin = $row[0];

        ?>
        <script type="text/javascript">
          var tempMax=parseFloat("<?php echo $tempMax; ?>");
        //var tempMax = ParseFloat(tempMax);
          var humMax = parseInt("<?php echo $humMax; ?>");
          var tempMin = parseFloat("<?php echo $tempMin; ?>");
          var humMin = parseInt("<?php echo $tempMin; ?>");
        
        </script>

        <script type="text/javascript" src='../js/historicos.js'></script>
    
    
        
    
      </figure>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        
            
            <footer style="color:blanchedalmond; width:100%">
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


</body>
    
</html>