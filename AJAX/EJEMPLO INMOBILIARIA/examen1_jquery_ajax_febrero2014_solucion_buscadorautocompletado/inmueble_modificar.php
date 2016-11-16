<?php 
include "conexion.php";

$consulta = "UPDATE inmueble SET
			direccion = '" . $_POST["direccionmodificar"] ."',
			idtipo = " . $_POST["idtipomodificar"] . ",
			visita = " . $_POST["visitamodificar"] . " 
			 WHERE idinmueble = " . $_POST["idinmueblemodificar"];


mysql_query($consulta,$conexion);


include "inmueble_lista_tabla.php";
?>
