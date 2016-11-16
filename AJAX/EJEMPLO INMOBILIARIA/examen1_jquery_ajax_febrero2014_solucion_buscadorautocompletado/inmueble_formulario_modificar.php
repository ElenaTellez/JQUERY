<form id="formulario">
Direccion:<input type="text" id="direccionmodificar" value=""><br>
Tipo:<select id="idtipomodificar">
<?php
$consulta2 = "SELECT idtipo, nombre 
			FROM tipo
			ORDER BY nombre";
$resultado2 = mysql_query($consulta2,$conexion);
while ($fila2=mysql_fetch_array($resultado2)){?>
<option value="<?= $fila2["idtipo"]?>"><?= $fila2["nombre"]?></option>
<?php } ?>
</select>
<br>
Visitas:<input type="text" id="visitamodificar" value="" />
</form>
