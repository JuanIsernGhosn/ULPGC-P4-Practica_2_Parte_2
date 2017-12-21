$("#tablaComanTop").on("click",".servirProdCom button",function(){
	var id = $(this).attr('name');
    $.ajax({
    	type: "POST",
        url: "mesaServir.php",
        data: JSON.stringify({ "id": id }),
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        success: function(res){
        	if(res.served){
				var precio = res.precio;
				var nombre = res.nombre;
            	$('#PrimTabProdCom' + id).remove();
                $('#ProductosServidos').append('<div class="tablaFinRow"><div class="filaTabFin"><p>'+nombre+'</p></div><div class="filaTabFin"><p>'+precio+'</p></div></div>');
				var precioFinal = parseFloat($("#precioFinal").text());
				var precioModificado = (Number(precioFinal)*1000 + Number(precio)*1000);
				precioModificado = Math.round(precioModificado)/1000;
				$('#precioFinal').empty();
				$('#precioFinal').append(precioModificado);
            }
        },
        error: function(){
          alert('Errorsito chachi');
        }
    });
});

$("#tablaComanTop").on("click",".elimProdCom button",function(){
    var id = $(this).attr('name');
    $.ajax({
        type: "POST",
        url: "mesaElim.php",
        data: JSON.stringify({ "id": id }),
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        success: function(res){
            if(res.deleted){
                $('#PrimTabProdCom'+id).remove();
            }
        },
        error: function(){
          alert('Errorsito chachi');
       }
    });
});

$("#botonAñadir").on("click", function(){ 
    var value = $("select").val();
	var coman = $('#addProductSelect').attr('name');
	$.ajax({
        type: "POST",
        url: "mesaAdd.php",
        data: JSON.stringify({ "id": value, "comanda": coman }),
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        success: function(res){
            if(res.included){
				var idLinCom = res.id;
                if(res.tipo == 1){
					$('#prodTabEnCoci').append('<div class="filaProd"><p>'+res.nombre+'</p></div>');
				} else {
					$('#tablaComanTop').append('<div class ="PrimTabProdCom" id="PrimTabProdCom'+idLinCom+'"><div class="nombreProdCom"><p>'+res.nombre+'</p></div><div class="servirProdCom"><button type="button" class="btn-style" name ="'+idLinCom+'" id="botonServir">Servir</button></div><div class="elimProdCom"><button type="button" class="btn-style" name ="'+idLinCom+'" id="botonEliminar">Eliminar</button></div></div>');
				}
            }
        },
        error: function(){
          alert('Errorsito chachi');
       }
    });
});