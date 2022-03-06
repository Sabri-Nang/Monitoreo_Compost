<?php
//Este archivo solo actualiza el estado del LED


//header('Location: http://192.168.0.10/monitoreo_compost/actuador.php');

header("Location: /monitoreo_compost/templates/actuador.php");


require_once('conexion.php');


$dispositivo=$_GET['dispositivo'];
$bomba=$_GET['bomba'];


$conn=new conexion();




$queryUPDATE="UPDATE `estado` SET `Bomba` = '$bomba' WHERE `estado`.`Dispositivo` = '$dispositivo';";
//primer parametro la conexion, el segundo la consulta
$update= mysqli_query($conn->conectardb(), $queryUPDATE);

?>