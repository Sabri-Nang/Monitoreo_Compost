<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@700&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href='../css/main.css'>  
    <script src="https://kit.fontawesome.com/c87eaff8e4.js" crossorigin="anonymous"></script>
    
    
    
    <title>Bomba de Agua</title>
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
                <a class="nav-link" href="max_min.php">Máximos y mínimos registrados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="actuador.php">Bomba de Agua</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="futuro.html">A Futuro</a>
            </li>

          </ul>
        </div>
    </nav>

    <center>
        
        <div class="container-fluid p-5 my-5 bg-dark text-white">
        
        

        <h1>BOMBA </h1>

        <div>

            <button type="button" class="btn btn-danger" onClick=location.href='/monitoreo_compost/templates/bomba.php?dispositivo=node1&bomba=0'><h2>Apagar</h2>
            </button>
        
        
            <button type="button" class="btn btn-success" onClick=location.href='/monitoreo_compost/templates/bomba.php?dispositivo=node1&bomba=1'><h2>Encender</h2>
            </button>
        </div>
        <br>
        <br>


        <?php
        //COMINEZA PHP
        //Insertamos codigo PHP en medio del HTML para mostrar el estado del led
        
        require_once('conexion.php');
        $conn=new conexion();
        $querySELECT="SELECT `bomba` FROM `estado` WHERE `Dispositivo`= 'node1';";

        //primer parametro la conexion, el segundo la consulta
        $result= mysqli_query($conn->conectardb(),$querySELECT);

        //Creo una variable $row (fila) en la cual vamos a guardar la fila que nos da como resultado la consulta SELECT
        $row=mysqli_fetch_row($result);
        //Esta fila $row va tener las dos posiciones, en la posicion 0 va a estar el valor de servo y en la posicion 1 va a estar el valor de led

        //Con el estado del led $row[1] armo una estructura if - else if - else para los distintos mensajes
        if($row[0]==1){
            echo "La bomba se encuentra PRENDIDA";

        }else if($row[0]==0){
            echo "La bomba se encuentra APAGADA";


        }else{
            echo "Valor invalido para bomba";

        }
        
        ?>
        
        
    </div>
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
</html>