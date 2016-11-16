<?php 
include_once "conexion.php";

$consulta = "UPDATE atleta SET
			nombre = '" . $_POST["nombre"] ."',
			fechanac = STR_TO_DATE('" . $_POST["fechanac"] ."','%d/%m/%Y'),
			iddeporte = " . $_POST["iddeporte"] . "
			 WHERE idatleta = " . $_POST["idatleta"];
			 
mysql_query($consulta,$conexion);

$consulta = "SELECT nombre 
			 FROM deporte
			 WHERE iddeporte=" . $_POST["iddeporte"];
			 
			 
$resultado = mysql_query($consulta,$conexion);
$fila=mysql_fetch_array($resultado);
echo $fila["nombre"];?>

