<?php
error_reporting(0);
require_once('conexion.php');


$dispositivo = $_POST['dispositivo'];
$temperatura = $_POST['temperatura'];
$humedad = $_POST['humedad'];

$bomba = $_POST['bomba'];



$conn = new conexion();
//actualizo lo que el node ve, lo que recibe del sensor
$queryUPDATE ="UPDATE `estado` SET `Temperatura`=`$temperatura`,`Humedad`=`$humedad` WHERE `estado`.`Dispositivo`='$dispositivo';";
$update= mysqli_query($conn->conectardb(),$queryUPDATE);
//inserto en el historico
$queryINSERT="INSERT INTO `historico` (`Dispositivo`, `Temperatura`, `Humedad`, `Bomba`, `Fecha`) VALUES ('$dispositivo', '$temperatura', '$humedad', '$bomba', NOW());";
#$insert = mysqli_query($conn->conectardb(), $query);
#echo "<p>Datos agregados</p>";

$insert = mysqli_query($conn->conectardb(), $queryINSERT);

//Hago la consulta para filtrar el estado de la tarjeta
$querySELECT = "SELECT `bomba` FROM `estado` WHERE `estado`.`Dispositivo`='node1';";
$result = mysqli_query($conn->conectardb(), $querySELECT);

$row = mysqli_fetch_row($result);
echo "{BOMBA:".$row[0]."}"; //respuesta que se enviará al nodeMCU para leer el estado de la


?>