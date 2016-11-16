<?php 
include "conexion.php";

$consulta = "INSERT INTO inmueble (direccion,idtipo,visita) 
			VALUES('" . $_POST["direccionnuevo"] ."'," . 
			$_POST["idtiponuevo"] . "," . 
			$_POST["visitanuevo"] . ")";

mysql_query($consulta,$conexion);

include "inmueble_lista_tabla.php";
?>

