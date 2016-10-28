/* 
 * EJERCICIO DE LA PALETA DE COLORES. 
 * JS CREADO POR ADOLFINA RUEDA SÁNCHEZ PARA EL EXAMEN DE JQUERY (DEWC)
 * IES CAMPANILLAS (MÁLAGA). 10/12/2015
*/

//esta función sirve para escribir el color seleccionado en su label correspondiente
function escribeColor() {
    var label = $(this).parent().find('label');
    var bgcolor = $(this).css('background-color');
    label.text(bgcolor);
    label.css('border-bottom', '2px solid ' + bgcolor);
}


//obtengo las clases de los div seleccionados en las paletas y las almaceno en variables diferentes
var colorHover;
var color2;
function cogeColorHover() {
    colorHover = $(this).attr('class');
}
function cogeColor2() {
    color2 = $(this).attr('class');
}


//elimino las clases anteriores que tenga el div y le añado la clase seleccionada en la paleta 1
function cambiaColorHover() {
    $(this).removeClass().addClass(colorHover);
    actualizaNum();
}


//intercambio el color seleccionado en la paleta 1 por el de la paleta 2
function intercambia() {
    $('#contenedor').find('.' + colorHover)
                    .removeClass(colorHover)
                    .addClass(color2);
    actualizaNum();
}


//comprueba uno a uno los div del #contenedor. Si tienen la clase 'nada', se la quita y le pone la clase del color seleccionado en la paleta 2
function rellena() {
    $('#contenedor div').each(function() {
        if ($(this).hasClass('nada')) {
            $(this).removeClass('nada')
                   .addClass(color2);
        }
    });
    //esto también lo podría haber hecho con: $('#contenedor').find('.nada')
    //como en la función intercambia()
    actualizaNum();
}


//recorro todos los div de #contenedor, le quito todas las clases que tenga y le añado solo la clase 'nada'
function limpia() {
    $('#contenedor div').each(function() {
        $(this).removeClass().addClass('nada');
    });
    actualizaNum();
}

//esta función sirve para actualizar todos los números de cada uno de los colores en la paleta 1
function actualizaNum() {
    $('#paletaUno .rojo').text($('#contenedor div.rojo').length);
    $('#paletaUno .amariyo').text($('#contenedor div.amariyo').length);
    $('#paletaUno .verde').text($('#contenedor div.verde').length);
    $('#paletaUno .azul').text($('#contenedor div.azul').length);
    $('#paletaUno .negro').text($('#contenedor div.negro').length);
    $('#paletaUno .blanco').text($('#contenedor div.blanco').length);
}


$(document).ready(function() {
    //coge todos los div que estén dentro de algún div cuyo id comience por paleta y que esté dentro de #paletas
    $('#paletas div[id ^= paleta]').on('click', 'div', escribeColor);
    
    //a los div de cada una de las paletas le aplico una función diferente para igualar su clase a una variable
    $('#paletaUno').on('click', 'div', cogeColorHover);
    $('#paletaDos').on('click', 'div', cogeColor2);
    
    //cuando hago mouseenter en los div del #contenedor, llamo a cambiaColorHover
    $('#contenedor').on('mouseenter', 'div', cambiaColorHover);
    
    //al pulsar en el botón Intercambiar, llamo a intercambia
    $('#intercambiar').on('click', intercambia);
    
    //al pulsar en el botón Rellenar, llamo a rellena
    $('#rellenar').on('click', rellena);
    
    //al pulsar en el botón Limpiar, llamo a limpia
    $('#limpiar').on('click', limpia);
});
