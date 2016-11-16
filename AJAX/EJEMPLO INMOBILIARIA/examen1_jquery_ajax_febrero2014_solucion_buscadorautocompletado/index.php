<?php include_once "conexion.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Listado Inmuebles</title>
<link rel="stylesheet" type="text/css" href="css/estilo.css"/>       
<link rel="stylesheet" type="text/css" href="ui-lightness/jquery-ui-1.10.3.custom.css"/>
<script src="js/jquery.js"></script>
<script src="js/jquery-ui-1.10.3.custom.js"></script>
	
		
<script type="text/javascript">

$(document).ready(function() {			
	var idtipo;
	var idinmueble;
//AUTOCOMPLETADO
$(document).on("keypress keyup","#buscadireccion",function(){		
	var valor= $("#buscadireccion").val();
 $.get("inmueble_lista_tabla.php" , 
	   {
		   busquedadireccion: valor 
		},
	   function(data){
			//vuelve a pintar el listado
		   $("#contenedor").html(data);
	   });//get
	
});

//---------------------------------------------------
//DIALOGO DE INCREMENTAR
	$( "#dialogoincrementar" ).dialog({
		autoOpen: false,
		resizable: false,
		modal: true,
		buttons: {
		//BOTON DE INCREMENTAR
		"Aceptar": function() {			
			//Ajax con post
			$.post('inmueble_incrementa_visita.php',{idinmueble:idinmueble},
			function(data){
			//Cambiamos el html del enlace
				$("#inmueble_" + idinmueble + " .incrementavisita a").html(data);			
			});
		
			//Cerrar la ventana de dialogo				
			$(this).dialog("close");												
		},
		"Cancelar": function() {
				//Cerrar la ventana de dialogo
				$(this).dialog("close");
		}
		}//buttons
	});	


	
//---------------------------------------------------
//DIALOGO DE BORRADO
	$( "#dialogoborrar" ).dialog({
		autoOpen: false,
		resizable: false,
		modal: true,
		buttons: {
		//BOTON DE BORRAR
		"Borrar": function() {			
			//Ajax con get
			$.get("inmueble_borrar.php", {"idinmueble":idinmueble},function(data,status){				
				$("#inmueble_" + idinmueble).fadeOut(500);
			})//get			
			//Cerrar la ventana de dialogo				
			$(this).dialog("close");												
		},
		"Cancelar": function() {
				//Cerrar la ventana de dialogo
				$(this).dialog("close");
		}
		}//buttons
	});	

//Evento click que pulsa el boton borrar
$(document).on("click",".borrar",function(){
	//Obtenemos el idinmueble a eliminar
	//a traves del atributo idrecord del tr
	idinmueble = $(this).parents("tr").attr("idrecord");
	//Accion para mostrar el dialogo de borrar
	 $( "#dialogoborrar" ).dialog("open");		
});


	
//---------------------------------------------------
//MODIFICAR
$( "#dialogomodificar" ).dialog({
		autoOpen: false,
		resizable: false,
		modal: true,
		buttons: {
		"Guardar": function() {			
			$.post("inmueble_modificar.php", {
				idinmueblemodificar : idinmueble,
				direccionmodificar : $("#direccionmodificar").val() ,
				idtipomodificar: $("#idtipomodificar").val() ,
				idtipo: $("#idtipo").val() ,
				visitamodificar : $("#visitamodificar").val()
			},function(data,status){				
				$("#contenedor").html(data);
			})//get			
					
			$(this).dialog( "close" );												
					},
		"Cancelar": function() {
				$(this).dialog( "close" );
		}
		}//buttons
	});				

//Boton Modificar	
$(document).on("click",".modificar",function(){
	//Obtenemos el idinmueble de la fila
	idinmueble = $(this).parents("tr").attr("idrecord");
	//Para que ponga el campo direccion con su valor
	$("#direccionmodificar").val($(this).parent().siblings("td.direccion").html());
	
	//Para que me seleccione el idtipomodificar
	var idtipomodificar = $(this).parent().siblings("td.idtipo").attr("name");
	$("#idtipomodificar option[value='" + idtipomodificar + "']").attr("selected",true);
	
	//visita
	var visitas= $.trim($(this).parent().siblings("td.visita").text());
	$("#visitamodificar").val(visitas);
	
	//Muestro el dialogo
	$( "#dialogomodificar").dialog("open")
	
});	


				
//----------------------------------------------------
// FILTRAR				
$(document).on("click","#filtrar",function(){		//Cargo en la vble global el tipo seleccionado			
		idtipo = $("#idtipo").val();
		//Llamo Ajax con la función ajax
		$.ajax({
			url: "inmueble_lista_tabla.php",
			data:{idtipo:idtipo},
			type: "post",
			beforeSend: cargar,
			success: filtratabla,
			complete: fin,
			cache: false
		});//ajax														
					
});

//Se ejecuta en el tiempo de espera del servidor
function cargar(){
	//Muestra el gráfico de cargar
	$("#cargando").show();
}

//Cargar en el contenedor el resultado de la tabla con filtro				
function filtratabla(data){		
	$("#contenedor").html(data);
}
			
//Una vez cargado vuelve a ocultar el gif animado			
function fin(){
	$("#cargando").hide();
}

	
//-------------------------------------------------------
//VISITAS INCREMENTO				
//Click al enlace que hay dentro de la clase incrementavisita
$(document).on("click",".incrementavisita a",function(){	
	//Obtener el idinmueble a través del atributo idrecord
	idinmueble = $(this).parents("tr").attr("idrecord");	
	$( "#dialogoincrementar" ).dialog("open");
});
				
				

//---- NUEVO --------------
//Boton de nuevo inmueble 
//Crea nueva fila al final de la tabla
//Con dos nuevos botones (guardarnuevo y cancelarnuevo)
$(document).on("click","#nuevo",function(){	
	$.post("inmueble_formulario_nuevo.php",function(data){
	//Añade a la tabla de datos una nueva fila
	$("#tabladatos").append(data);
			//Selecciona por defecto la opcion 
			//del select del tipo seleccionado
			$("#idtiponuevo option[value='" + $("#idtipo").val() + "']").attr("selected",true);	
			//Ocultamos boton de nuevo inmueble
			//Para evitar añadir mas de uno 
			//a la vez
			$("#nuevo").hide();			
	})//get	
});			

//Boton de cancelar nuevo
$(document).on("click","#cancelarnuevo",function(){	
		//Elimina la nueva fila creada
		$("#filanueva").remove();
		//vuelve a mostrar el botón de nuevo (+)
		$("#nuevo").show();
		
});			

//Boton de guardar nuevo
$(document).on("click","#guardarnuevo",function(){
	$.post("inmueble_insertar_nuevo.php", {
				"direccionnuevo":$("#direccionnuevo").val(),
				"idtiponuevo":$("#idtiponuevo").val(),
				"visitanuevo":$("#visitanuevo").val(),
				"idtipo":$("#idtipo").val()
			},function(data){
				//Pinta de nuevo la tabla
				$("#contenedor").html(data);
				//Vuelve a mostrar el boton de nuevo
				$("#nuevo").show();		
			})//post	
});
											
});//ready
			

		</script>
    </head>
    <body>

<?php include "inmueble_cabecera.php" ?>
<div id="contenedor">
<?php include "inmueble_lista_tabla.php" ?>
</div>

<!-- CAPA DE DIALOGO MODIFICAR INMUEBLE -->
<div id="dialogomodificar" title="Modificar Inmueble">
<?php include "inmueble_formulario_modificar.php"?>
</div>

<!-- CAPA DE DIALOGO ELIMINAR INMUEBLE -->
<div id="dialogoborrar" title="Eliminar Inmueble">
  <p>¿Esta seguro que desea eliminar el inmueble?</p>
</div>

<!-- CAPA DE DIALOGO INCREMENTAR VISITA -->
<div id="dialogoincrementar" title="Incrementar Visita">
  <p>¿Esta seguro que desea incrementar las visitas?</p>
</div>


</body>
</html>
