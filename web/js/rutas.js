/**
 * Created by xenon-pb on 21/03/2017.
 */

$(document).ready(function(){
    //Activar la ruta para que sea visible
    $("#activar").on('click', function () {
        var self = $(this);
        $.ajax({
            data: self.data('id'),
            url: self.data('url')
        })
    });


    //Voto positivo a la ruta
    $('#positivo').on('click', function(e){
        e.preventDefault();
        var self = $(this);
        var parametros = {
            "id" : self.data('id'),
            "valor" : 1
        };

        $.ajax({
            data: parametros,
            url: self.data('url'),
            success: function(data){
                if(data=="no"){
                    alert("Sólo puedes votar una vez cada ruta.");
                }else{
                    if(data >= 0){
                        $(".puntuacion").removeClass("rojo");
                        $(".puntuacion").addClass("verde");
                    }
                    $(".puntuacion").html("Puntuación: "+ data)
                }
            }

        })
    });


    //Voto negativo a la ruta
    $('#negativo').on('click', function(e){
        e.preventDefault();
        var self = $(this);
        var parametros = {
            "id" : self.data('id'),
            "valor" : -1
        };

        $.ajax({
            data: parametros,
            url: self.data('url'),
            success: function(data){
                if(data=="no"){
                    alert("Sólo puedes votar una vez cada ruta.");
                }else{
                    if(data < 0){
                        $(".puntuacion").removeClass("verde");
                        $(".puntuacion").addClass("rojo");
                    }
                    $(".puntuacion").html("Puntuación: "+ data)
                }
            }
        })
    });



    //Comentar (Sólo si el usuario ha iniciado sesión)
    $('#btn-cmt').on('click', function (e){
        e.preventDefault();
        var self = $(this);

        if(self.data('rol')){
            alert('Antes debes iniciar sesión');
        }else{
            var comentario = $("#comentario").val();
            if(comentario==""){
                alert('Debes escribir algo');
            }else{
                var parametros = {
                    "id" : self.data('id'),
                    "idUser" : self.data('user'),
                    "comentario":comentario
                };
                $.ajax({
                    data: parametros,
                    url: self.data('url')
                })
            }
        }
    });

    /*--------------- SELECT ORDENAR -----------*/
    $('select#columna').on('change', function(){
        console.log($(this));
        var self = $(this);
        $.ajax({
            data: "columna="+self.val(),
            url: self.data('url'),
            success: function(data){
                $("#listadoRutas").html(data);
            }
        })
    });

    /*--------------- BUSCADOR -----------*/
    $('#buscador').on('keyup', function(){
        var self = $(this);
        if(self.val().length>=3){
            $.ajax({
                data: "nombre="+self.val(),
                url: self.data("url"),
                success: function(data){
                    if(data=="null"){
                        $("#listadoRutas").html('<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span>No hay rutas con ese nombre</div>');
                    }else{
                        $("#listadoRutas").html(data);
                    }
                }
            })
        }else{
            $.ajax({
                data: "nombre=todas",
                url: self.data("url"),
                success: function(data){
                    if(data=="null"){
                        $("#listadoRutas").html('<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span>No hay rutas con ese nombre</div>');
                    }else{
                        $("#listadoRutas").html(data);
                    }
                }
            })
        }
    });


    /*----------- FLECHA SUBIR ------------*/
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });

    $('.scrollup').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 1000);
        return false;
    });

    /*----------- FLECHA BAJAR ------------*/
    $('.btnRutas').click(function(){
        var $elem = $('#id_rutas');
        $('html, body').animate({scrollTop: $elem.height()}, 1000);
        return false;
    });

    /*---------- TAB DATOS -------------------*/
    $('#btndatos').on('click', function(e){
        e.preventDefault();

        $(".tabcontent").hide();
        $("#datos").show();
    });

    /*--------------- TAB RUTAS --------------*/
    $('#btnrutas').on('click', function(e){
        e.preventDefault();

        $(".tabcontent").hide();
        $("#rutas").show();
    });
});