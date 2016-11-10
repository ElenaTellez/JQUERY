$(document).ready(function() {
    //Se crean las variables globales
    var tablero = [];
    var fila = ['A','B','C','D','E'];
    var aciertos;
    var fallos;
    var columna;
    var aguaYBarcos;
    var barco;
    
    //Funcion para crear barcos
    function crearBarcos(){
        //Se llama a la funcion inicia variables
        iniciaVariables();
        pintaCuadricula();
        //Se asignan las casillas de agua
        for(var i = 0;i < 25;i++){ tablero[i] = "agua"; }
        //Se asignan los barcos, sin que unos pisen a otros.
        do{
            var posicion = Math.floor(Math.random() * 25);
            if(tablero[posicion] == "agua") { 
                tablero[posicion] = "barco"; // añado la clase barco al array
                barco--; 
            }
        } while(barco > 0);
        //Se pinta el tablero por fuera, el marco del tablero, es decir, los div de 1-6 y A,B,C
        for(var i = 0;i < 36;i++){
            var casilla = $("<div></div>").addClass('casilla');
            if(i > 0 && i < 6){ //Se rellenan la fila del array que tengo con las letra A,B,..
                casilla.text(fila[i - 1]);
            }else if((i % 6 == 0) && (i != 0)) { //Se rellena la columna. Voy contando en horizontal. 
                casilla.text(i - i + columna); //columna vale 1, pongo el div con el numero 1, 2, 3...
                columna++;
            } else if(i != 0) { //Se rellenan el agua y los barcos
                casilla.addClass(tablero[aguaYBarcos]); //aguaYBarcos vale 0, por lo ue empiezo a asignar las clases agua y barco a casilla
                aguaYBarcos++;
                //Se asigna el evento click
                casilla.on("click",function(){
                    compruebaCasilla(this);
                });
            }
            //Se añaden las casillas al tablero
            $("#tablero").append(casilla);
        }
    }
        
    //Funcion para comprobar si la casilla es barco o agua
    function compruebaCasilla(casilla) {
        $(casilla).animate({opacity:'1'},1000); //cambio el valor de opacity para que se muestre imagen
        if($(casilla).hasClass("barco")){
            aciertos++;
            $("#aciertos").html("Aciertos: " + aciertos);
        } else {
            fallos++;
            $("#fallos").html("Fallos: " + fallos);
        }
        if(aciertos == 5){
            $("#tablero").find("p").html("WIN!!!").css("display","block");
        }
        if(fallos == 20){
            $("#tablero").find("p").html("GAME OVER!!!").css("display","block");
        }
    }
    
    //Funcion para reiniciar las variables
    function iniciaVariables(){
        //Se borra lo que habia en el tablero
        $("#tablero").fadeOut(1000,function(){
            $("#tablero").fadeIn(1000);
        });
        $("#tablero").find("div").remove();
        //Se reinician las variables
        aciertos = 0;
        $("#aciertos").html("Aciertos: " + aciertos);
        fallos = 0;
        $("#fallos").html("Fallos: " + fallos);
        columna = 1;
        aguaYBarcos = 0;
        barco = 5;
        $("#tablero").find("p").css("display","none");
    }
    
    //Funcion para hacer la cuadricula interior
    function pintaCuadricula(){
        for(var i = 0;i <= 5;i++){
            //Pinta las lineas horizontales
            var lineaH = $("<span></span>")
                        .addClass("lineaH")
                        .css('top',(51 * i) + (i - 1) + 'px');
            $("#tablero").append(lineaH);
            //Pinta las lineas verticales
            var lineaV = $("<span></span>")
                        .addClass("lineaV")
                        .css('left',(51 * i) + (i - 1) + 'px'); // hay que sumar pixel con i porque el div de casilla tiene solid black y es de 50 por lo que seria 52 cada vez
            $("#tablero").append(lineaV);
        }
    }
    
    //Se llama a la funcion crear barcos para comenzar la partida.
    crearBarcos();
    
    //Funcion del boton comenzar
    $('#botonComenzar').on('click', function(){
        //Se llama a la funcion crear barcos
        crearBarcos();
    });
    
    //Funcion del boton siguiente.
    $('#botonBarcos').on('click', function(){
        $(".barco").each(function(){
            if($(this).css('opacity') == 0){
                $(this).animate({opacity:'1'},500,function(){
                    $(this).animate({opacity:'0'},200);
                });
            } 
        });
    });
});