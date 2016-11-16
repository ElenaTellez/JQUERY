<?php
include "conexion.php";
//Actualiza el inmueble con el valor vendido
if (!empty($_POST["idinmueble"])){	
	$sql = "UPDATE inmueble SET
		visita = visita + 1  
		WHERE idinmueble=". $_POST["idinmueble"];
	mysql_query($sql,$conexion);	

//vuelve a hacer consulta para devolver el valor 
//de la visita
$consulta = "SELECT visita 
			FROM inmueble
			WHERE idinmueble=". $_POST["idinmueble"];
			
$resultado = mysql_query($consulta);
$fila= mysql_fetch_array($resultado);
echo $fila["visita"];
}
?>