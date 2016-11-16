<?php include "conexion.php"?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<link rel="stylesheet" type="text/css" href="jquery-ui-1.11.4.custom/jquery-ui.css"/>
<script src="jquery-1.11.3.min.js"></script>
<script src="jquery-ui-1.11.4.custom/jquery-ui.js"></script>

<script>
$(document).ready(function() {
	
	var idatleta;
	var ordenapor;
	
	
	//VENTANA DIALOGO DE BORRAR
	$( "#dialogomodificar" ).dialog({
		autoOpen: false,
		resizable: false,
		modal: true,
		buttons: {
		"Guardar": function() {
			var iddeportevalor= $("#iddeporte").val();
		
			//console.log("entra en borrar = " + idcliente);
			$.post("atleta_modificar.php", {
				idatleta : idatleta,
				nombre : $("#nombreatleta").val() ,
				fechanac: $("#fechanac").val(),
				iddeporte : iddeportevalor
			},function(data,status){
				//Actualizo la fila del atleta
				//nombre deportista
				$("#atleta_" + idatleta + " td.nombreatleta").html($("#nombreatleta").val());
				//fechanac
				$("#atleta_" + idatleta + " td.fechanac").html($("#fechanac").val());
				
				//nombre_deporte
				$("#atleta_" + idatleta + " td.nombredeporte").html(data);
				//id_deporte
				$("#atleta_" + idatleta + " td.nombredeporte").attr("name",iddeportevalor);
			});	
							
						$(this).dialog( "close" );												
					},
		"Cancelar": function() {
				$(this).dialog( "close" );
		}
		}//buttons
	});
	
	//VENTANA DIALOGO DE BORRAR
	$("#dialogo").dialog({
		autoOpen: false,
		resizable: false,
		modal: true,
		buttons: {
		"Borrar": function() {
			//console.log("entra en borrar = " + idcliente);
			$.get("atleta_borrar.php?idatleta=" + idatleta,function(){				
				$("#atleta_" + idatleta).fadeOut(1000);
			})//get			
			//cierra ventana dialogo				
			$(this).dialog( "close" );												
		},
		"Cancelar": function() {
				$(this).dialog( "close" );
		}
		}//buttons
	});	
	
	//---------------------------------------------
	//BORRAR
$(document).on("click",".borrar",function(){
		idatleta = $(this).parents("tr").attr("name");
		 $("#dialogo").dialog("open");		
		
	});
	
	//---------------------------------------------
	//MODIFICAR
$(document).on("click",".modificar",function(){
		console.log("modificar");
		idatleta = $(this).parents("tr").attr("name");
		//Para que ponga el campo nombre de atleta con su valor
		$("#nombreatleta").val($(this).parent().siblings("td.nombreatleta").html());
		
		$("#fechanac").val($(this).parent().siblings("td.fechanac").html());
		
		var iddeporte = $(this).parent().siblings("td.nombredeporte").attr("name");
		
		console.log("iddeporte=" + iddeporte);
		
		//Para que me seleccione el iddeporte
		$("#iddeporte option[value='" + iddeporte + "']").attr("selected",true);
		
		$( "#dialogomodificar").dialog("open");
		
		
	});	
	
	
//-------------------------------------------------------
$(document).on("click",".ordena",function(){
		
		//obtener el ordenapor
		ordenapor=$(this).attr("name");
		
		$.ajax({
			url: "atleta_lista.php",
			data:{ordenapor:ordenapor},
			type: "post",
			beforeSend: cargar,
			success: rellenar,
			cache: false
		});
});

//Se ejecuta en el tiempo de espera del servidor
function cargar(){
	//Muestra el gráfico de cargar
	var cargando = '<span><img src="images/loader.gif" id="cargando" /></span>';
	
	$("#atleta_lista").html(cargando);
}

function rellenar(data){		
	$("#atleta_lista").html(data);
}

 $( "#fechanac" ).datepicker({
	 dateFormat: "dd/mm/yy"
 });
 
 
});//ready
</script>
</head>

<body>

<div id="dialogo" title="Eliminar Atleta">
  <p>¿Esta seguro que desea eliminar el atleta?</p>
</div>


<div id="dialogomodificar" title="Modificar Atleta">
<form id="formulario">
Nombre Atleta:<input type="text" id="nombreatleta" value=""><br>
Fecha Nacimiento:<input type="text" id="fechanac" value=""><br>
Deporte<select id="iddeporte">
<?php 
$consulta = "SELECT iddeporte, nombre 
			 FROM deporte
			 ORDER BY nombre";
			 
$resultado = mysql_query($consulta,$conexion);
while ($fila=mysql_fetch_array($resultado)){?>
<option value="<?php echo $fila["iddeporte"]?>"><?php echo $fila["nombre"]?></option>
<?php }//while
?>
</select>
</form>
</div>
<!----------------------------------------------->
<div id="atleta_lista">
<?php include "atleta_lista.php"?>
</div>
<!----------------------------------------------->

</body>
</html>