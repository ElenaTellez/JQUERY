<?php
include "conexion.php";


$consulta ="DELETE FROM inmueble 
			WHERE idinmueble = ". $_GET["idinmueble"];
			

mysql_query($consulta,$conexion);
?>
