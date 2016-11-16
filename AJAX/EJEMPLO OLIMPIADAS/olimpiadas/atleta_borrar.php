<?php
include "conexion.php";


$consulta ="DELETE FROM atleta 
			WHERE idatleta = ". $_GET["idatleta"];
			

mysql_query($consulta,$conexion);
?>
