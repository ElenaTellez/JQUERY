<?php
require_once("constantes.php");

$conexion = mysql_connect(HOST,USUARIO_DB,CLAVE_DB);
if (!$conexion){
	die("Error en la conexion con BD:". mysql_error());
}
mysql_select_db(NOMBRE_DB,$conexion);

?>