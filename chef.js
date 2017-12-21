$("#tablaElaborando").on("click","button",function(){
   var id = $(this).attr('name');
    $.ajax({
        type: "POST",
        url: "elaborado.php",
        data: JSON.stringify({ "id": id }),
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        success: function(res){
            if(res.selected){
                var id = res.id;
                $('#PrimTabProdCom'+id).remove();
            }
        },
        error: function(){
          alert('Errorsito chachi');
       }
    });
});

$("#tablaPorElaborar").on("click","button",function(){
    var id = $(this).attr('name');
    $.ajax({
        type: "POST",
        url: "pendElab.php",
        data: JSON.stringify({ "id": id }),
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        success: function(res){
            if(res.selected){
                var mesa = res.mesa;
                var id = res.id;
                var nombre = res.nombre;
                $('#PrimTabProdCom'+id).remove();
                $('#tablaElaborando').append('<div class ="PrimTabProdCom" id="PrimTabProdCom'+id+'"><div class="nombreProdChef"><p>'+nombre+'</p></div><div class="mesaProdChef"><p>Mesa '+mesa+'</p></div><div class="colCheckElab2"><button type="button" class="btn-style" name ="'+id+'" id="botonServir">Terminar</button></div></div>');
            }
        },
        error: function(){
          alert('Errorsito chachi');
       }
    });
});