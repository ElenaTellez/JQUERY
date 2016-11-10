/* 
 * EJERCICIO DEL ÁRBOL DE NAVIDAD. 
 * JS CREADO POR ADOLFINA RUEDA SÁNCHEZ PARA EL EXAMEN DE JQUERY (DEWC)
 * IES CAMPANILLAS (MÁLAGA). 10/12/2015
*/

//estas son mis variables globales, son contadores
var creadas;
var eliminadas;


//función adornar, que crea las bolas y las coloca en el árbol
function adornar() {
    //deshabilito el botón mover
    $('#mover').attr('disabled', 'true');
    
    //creo el color aleatorio
    var color1 = Math.floor((Math.random() * 257) - 1);
    var color2 = Math.floor((Math.random() * 257) - 1);
    var color3 = Math.floor((Math.random() * 257) - 1);
    var color = "rgb(" + color1 + "," + color2 + "," + color3 + ")";
    
    //creo su posición de forma aleatoria. Según el top, será una izq u otra
    var top = Math.floor(Math.random() * 340);
    var izq; 
    if (top < (340/3)) {
        izq = Math.floor(Math.random() * 100) + 150;
    } else if ((top >= (340/3)) && (top < (2 * (340/3)))) {
        izq = Math.floor(Math.random() * 200) + 100;
    } else if ((top >= (2 * (340/3))) && (top < 340)) {
        izq = Math.floor(Math.random() * 300) + 50;
    }
    
    //creo la bolita, añadiendo clase, al cuadro de juego con su css y la animación de la caída. Al final, habilito el botón mover de nuevo
    var bolita = $('<div></div>')
                  .addClass('bolita')
                  .css({
                      'background-color': color, 
                      'left': izq + 'px'
                  })
                  .appendTo('#juego')
                  .animate({
                      'top': top + 'px'
                  }, 500, function() {
                      $('#mover').removeAttr('disabled');
                  });
    
    //incremento el número de creadas y lo muestro
    creadas++;
    $('#creadas').text(creadas);
}


//función mover para hacer que las bolas caigan y desaparezcan
function mover() {
    //deshabilito el botón adornar
    $('#adornar').attr('disabled', 'true');
    
    //genero las animaciones concatenadas con animate
    $('#arbol').animate({
        'left': '+=30px'
    }, 40, function() {
        $('#arbol').animate({
            'left': '-=60px'
        }, 40, function() {
            $('#arbol').animate({
                'left': '+=60px'
            }, 40, function() {
                $('#arbol').animate({
                    'left': '-=30px'
                }, 40, function() {
                    //cuando el árbol se ha movido 4 veces, recorro todas las bolas para hacer que caigan incrementando su top con un animate después del delay
                    $('#juego .bolita').each(function(index) {
                        $(this).delay(50 * index).animate({
                            'top': '356px'
                        }, 50, function() {
                            //cuando llegan abajo se desvanecen todas las bolas con un animate que va a opacity 0
                            $(this).animate({
                                'opacity': 0
                            }, function() {
                                //al final, incremento las eliminadas, muestro el contador
                                eliminadas++; 
                                $('#eliminadas').text(eliminadas);
                                //elimino dicha bola del DOM
                                $(this).remove();
                                //habilito el botón adornar de nuevo
                                $('#adornar').removeAttr('disabled');
                            });
                        });
                    });
                })
            })
        });
    });
}


$(document).ready(function () {
    //al principio son 0 bolas creadas y 0 bolas eliminadas
    creadas = 0;
    eliminadas = 0;
    
    //al clickar en Adornar, llamo a adornar
    $('#adornar').on('click', adornar);
    
    //al clickar en Mover, llamo a mover
    $('#mover').on('click', mover);
});
