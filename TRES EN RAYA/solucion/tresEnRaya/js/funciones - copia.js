$(document).ready(function() {
    //Se crean las variables globales
    var idCasilla = 1;
    var jugador = 'circulo';
    var combGanadora = [['#caja1','#caja2','#caja3'],
                        ['#caja1','#caja4','#caja7'],
                        ['#caja1','#caja5','#caja9'],
                        ['#caja2','#caja5','#caja8'],
                        ['#caja3','#caja5','#caja7'],
                        ['#caja3','#caja6','#caja9'],
                        ['#caja4','#caja5','#caja6'],
                        ['#caja7','#caja8','#caja9']];
    //Funcion del boton comenzar.
    $('#botonComenzar').on('click',function(){
        
        //Elimina todas las cajas e inicializa los id
        for(var i = 1; i < 10; i++){
            $('#caja' + i).remove();
        }
        idCasilla = 1;
        $('#tablero').slideDown(2000);
        //Se crean las 9 casillas
        for(var i = 0; i < 9; i++){
             var casilla = $('<div></div>')
                            .addClass('casilla')
                            .addClass('vacia')
                            .attr('id','caja' + idCasilla);
                           
            $("#tablero").append(casilla);
            idCasilla++;
        }
        $(this).attr('disabled','true');
        $('#texto').text("Turno del Jugador 1");
    });
    
    //Función para aplicar una clase al pinchar en una casilla
    $('#tablero').on('click',".vacia",function(){
        //Cambio la ficha que se debe poner
        if (jugador=="cruz"){
            jugador = 'circulo';
            $('#texto').text("Turno del Jugador 1");
        } else {
            jugador = 'cruz';
            $('#texto').text("Turno del Jugador 2");
        }
        //Se añade la nueva clase y se elimina la clase vacia
        $(this).addClass(jugador);
        $(this).removeClass('vacia');
        comprobarGanador();
    });
    
    //Funcion que comprueba si alguno ha ganado
    function comprobarGanador(){
        //Se comprueba el numero de jugador
        var numero = (jugador == 'cruz') ? 1 : 2;
        //Se comprueban las distintas combinaciones.
        for(var i = 0; i <= 7; i++){
            //Si alguien gana, se muestra
            if($(combGanadora[i][0]).hasClass(jugador) && 
               $(combGanadora[i][1]).hasClass(jugador) &&
               $(combGanadora[i][2]).hasClass(jugador)){
                $('#texto').text("Gana Jugador " + numero);
                $('.casilla').slideUp(3000,function(){
                    $('#texto').text("Pulse Comenzar para jugar otra partida");
                });
                $('#botonComenzar').removeAttr('disabled');
            }
        }
    }
});