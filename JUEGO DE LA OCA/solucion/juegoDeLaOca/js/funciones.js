var numCasillas = 16;
$(document).ready(function() {
    //Se crean las variables globales
    var jugador = 'rojo';
    var tablero = [];
    
    //Funcion del boton comenzar.
    $('#botonComenzar').on('click',function(){
        
        //Elimina todas las cajas, inicializa las casillas a vacias 
        //y vuelve las fichas al principio.
        for(var i = 1; i <= numCasillas; i++){ $('#casilla' + i).remove(); }
        for(var i = 0; i < numCasillas - 1;i++){ tablero[i] = "vacia"; }
        tablero[numCasillas - 1] = "fin";
        var ocas = 3;
        var pozos = 3;
        $('#rojo').attr('pos',0);
        $('#verde').attr('pos',0);
        $('#rojo').animate({left:'-45px'},500);
        $('#verde').animate({left:'-45px'},500);
        $('#dado').text('Tirada: ');
        //$('#tablero').slideDown(2000);
        $('#botonDado').removeAttr('disabled');
        
        //Se asignan las ocas y los pozos
        do{
            var posicion = Math.floor(Math.random() * (numCasillas - 1));
            if(tablero[posicion] == "vacia" && ocas > 0) { 
                tablero[posicion] = "oca"; 
                ocas--; 
            }
            if(tablero[posicion] == "vacia" && pozos > 0) { 
                tablero[posicion] = "pozo"; 
                pozos--; 
            }
        } while((ocas + pozos) > 0);
        
        //Se crean las 16 casillas
        for(var i = 1; i <= numCasillas; i++){
             var casilla = $('<div></div>')
                            .addClass('casilla')
                            .addClass(tablero[i - 1])
                            .attr('id','casilla' + i)
                            .text(i);    
            $("#tablero").append(casilla);
        }
        
        //Se desactiva el botón comenzar y se indica el turno del jugador.
        $(this).attr('disabled','true');
        $('#texto').text("Turno del Jugador " + jugador);
    });
    
    //Función para tirar un dado
    $('#botonDado').on('click',function(){
        $(this).attr('disabled','true');
        //Se lanza el dado
        var dado = Math.floor(Math.random() * 6) + 1;
        $('#dado').text('Tirada: ' + dado);
        
        //Aumento la posición de la ficha
        var posicion = +$('#'+ jugador).attr('pos');
        $('#'+ jugador).attr('pos',(posicion + dado));
        
        //Se avanza la ficha hasta la casilla que haya salido
        var avanza = 52 * dado;
        //Se comprueba que no se pase de la ultima casilla
        if((posicion + dado) > numCasillas) { 
            avanza = 52 * (numCasillas - posicion);
            $('#'+ jugador).attr('pos', numCasillas);
        }
        
        //Se inicia el movimiento de la ficha
        $('#'+ jugador).animate({left:'+=' + avanza + 'px'},2000,function(){
            posicion = +$('#'+ jugador).attr('pos');
            
            //Se realizan las acciones de caer en una oca
            if(tablero[posicion - 1] == 'oca'){
                $('#texto').text("De oca a oca y tiro por que me toca. Sigue jugando el jugador " + jugador);
                do{
                   posicion++; 
                } while (tablero[posicion - 1] != 'oca' && tablero[posicion - 1] != 'fin');
                $('#'+ jugador).animate({ left:((52 * posicion) - 45)},2000,function(){
                    $('#'+ jugador).attr('pos', posicion);
                    //Se activa el boton de nuevo
                    $('#botonDado').removeAttr('disabled');
                });
                
            //Se ralizan las acciones de caer en el pozo
            } else if(tablero[posicion - 1] == 'pozo'){
                $('#texto').text("Has caido en el pozo. Vuelves al principio");
                $('#'+ jugador).animate({left:'-45px'},2000,function(){ 
                    $('#'+ jugador).attr('pos', 0);
                    cambioTurno(); 
                });
                
            //Se realizan las acciones de caer en una casilla vacia
            } else if(tablero[posicion - 1] == 'vacia'){
                cambioTurno();
            }
            
            //Se realizan las funciones de fin de partida
            if(tablero[posicion - 1] == 'fin') {
                $('#texto').text("El jugador " + jugador + " ha ganado la partida. Pulse en comenzar para jugar de nuevo.");
                $('#botonComenzar').removeAttr('disabled');
                //$('.casilla').slideUp(3000);
                $('#botonDado').attr('disabled','true');
            }
        });
    });
    
    //Funcion para cambiar de turno
    function cambioTurno(){
        if (jugador == "rojo"){ jugador = 'verde'; } 
        else { jugador = 'rojo'; }
        $('#texto').text("Turno del Jugador " + jugador);
        //Se activa el boton de nuevo
        $('#botonDado').removeAttr('disabled');
    }
});