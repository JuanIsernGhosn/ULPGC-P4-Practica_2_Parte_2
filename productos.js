$(document).ready(function() {
    $("#busqRes").html('<div class="busRow"><p>Buscador de productos</p></div>');
});
$("#busquedaText").on("keyup",function(){
    var bla = $("#busquedaText").val().trim();
    if(bla!==""){
        $.ajax({
            type: "POST",
            url: "busqueda.php",
            data: JSON.stringify({ valorBuscar: bla }),
            dataType: "html",
            error: function(){
              alert("error petición ajax");
            },
            success: function(resultado){                                                    
                $("#busqRes").html(resultado);
            }
        });
    } else {
        $("#busqRes").html('<div class="busRow"><p>Buscador de productos</p></div');
    }
});