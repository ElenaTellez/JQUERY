<?php include_once "conexion.php";


$consulta = "SELECT a.idatleta, a.iddeporte, 
		DATE_FORMAT(a.fechanac,'%d/%m/%Y') as fecha,
		a.nombre, d.nombre as deporte
			 FROM atleta a, deporte d
			 WHERE a.iddeporte=d.iddeporte ";
			 
if (empty($_POST["ordenapor"]))
	$consulta .= "ORDER BY a.nombre";
else{
	sleep(1);//simula retraso de 1 seg en servidor
	$ordena="";
	if ($_POST["ordenapor"]=="atleta") $ordena = "a.nombre";
	else $ordena = "d.nombre";
	$consulta .= "ORDER BY " . $ordena;
}

$resultado = mysql_query($consulta,$conexion);

//echo $consulta;	
if (mysql_num_rows($resultado)>0){
?>

<table>
<tr>
<th class="ordena" name="atleta">Atleta</th>
<th class="ordena" name="fechanac">Fecha Nac</th>
<th class="ordena" name="deporte">Deporte</th>
<th>Acciones</th>
</tr>
<?php
//RECORRIDO DE ATLETAS
while ($fila=mysql_fetch_array($resultado)){?>
<tr id="atleta_<?php echo $fila["idatleta"]?>" name="<?php echo $fila["idatleta"]?>">
	<td class="nombreatleta"><?php echo $fila["nombre"]?></td>
	<td class="fechanac"><?php echo $fila["fecha"]?></td>

    <td class="nombredeporte" name="<?php echo $fila["iddeporte"]?>"><?php echo $fila["deporte"]?></td>
	<td> <img class="borrar" src="images/borrar.png" width="20" height="20" alt="Borrar">
    &nbsp;<img class="modificar" src="images/lapiz.png" width="20" height="20" alt="Modificar">
   	</td>
</tr>
<?php 
}//while

}//if

?>
</table>	











