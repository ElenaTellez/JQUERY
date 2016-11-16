<?php
include "conexion.php";
//Solo en el caso de que se pulse para buscar por idtipo se duerme un segundo el servidor
if (!empty($_POST["idtipo"])  && empty($_POST["idinmueble"]) ) sleep(1);


//Consulta general del listado de inmuebles
$consulta = "
SELECT i.idinmueble, i.direccion, i.idtipo, i.visita, t.nombre as nombretipo
FROM inmueble i, tipo t
WHERE i.idtipo = t.idtipo";

//Consulta en función de dirección
if (!empty($_GET["busquedadireccion"])){
$consulta.= " AND i.direccion LIKE '%" . $_GET["busquedadireccion"] . "%' ";
}

//Si llega el parametro ordenapor se ordena por ese campo
if (!empty($_POST["idtipo"])) 
	$consulta .= " AND i.idtipo=" . $_POST["idtipo"];


$resultado = mysql_query($consulta,$conexion);
	
if (mysql_num_rows($resultado)>0){  ?>
        


		
<table id="tabladatos" align="center" >
<tr align="center">
	<th>Dirección</th>	
	<th>Tipo</th>
	<th>Visitas</th>  
    <th>Acciones</th>                              
</tr>
<?php 	
while ($fila=mysql_fetch_array($resultado)){?>
<tr id="inmueble_<?=$fila["idinmueble"]?>" align="center" idrecord="<?=$fila["idinmueble"]?>">
		<td class="direccion"><?=$fila["direccion"] ?></td>
        <td class="idtipo" name="<?=$fila["idtipo"]?>"><?=$fila["nombretipo"]?></td>
        <td class="visita">
		<span class="incrementavisita" >
		<a href="#"><?=$fila["visita"];?></a></span> 
		</td>
        <td> <img class="borrar" src="img/borrar.png" width="20" height="20" alt="Borrar">
    &nbsp;<img class="modificar" src="img/lapiz.png" width="20" height="20" alt="Modificar">
   	</td>
</tr>
<?php }//while ?>
</table>
<?php }//if  ?>
