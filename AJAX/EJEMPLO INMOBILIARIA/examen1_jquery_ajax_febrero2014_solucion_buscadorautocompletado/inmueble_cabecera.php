<?php include "conexion.php"; ?>

<h3 align="center">Listado Inmuebles
	<span id="carga"><img src="img/ajax-loader.gif" id="cargando" /></span>
<select id="idtipo">
<option value="">------</option>
<?php
$consulta2 = "SELECT idtipo, nombre 
			FROM tipo
			ORDER BY nombre";
$resultado2 = mysql_query($consulta2,$conexion);
while ($fila2=mysql_fetch_array($resultado2)){?>
<option value="<?=$fila2["idtipo"]?>" 
<?php if (!empty($_POST["idtipo"]) && $_POST["idtipo"]==$fila2["idtipo"]) echo ' selected="selected" '?>
><?=$fila2["nombre"]?></option>
<?php } ?>
</select>
<input id="filtrar" type="button" value="filtrar" />
<img src="img/nuevo.png" width="20" height="20" id="nuevo" title="Nuevo Inmueble">
</h3>
<h3 align="center">Direcci&oacute;n<input type="text" id="buscadireccion" value=""></h3>