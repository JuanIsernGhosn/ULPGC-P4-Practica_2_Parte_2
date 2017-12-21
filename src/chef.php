<?php
	include 'sessionAction.php';
	SessionAction::comprobarID('2');
	
	$id = $_SESSION['id'];
	
    include 'DbAdapter.php';
	include_once 'lib.php';
	View::startCoci('Cocina');
    echo "<script src=\"jquery.js\"></script>";
	$res=DbAdapter::consultaSql("SELECT articulos.nombre as articulo,lineascomanda.id as id, mesa FROM comandas,lineascomanda,articulos WHERE (lineascomanda.comanda=comandas.id) AND (horacierre='0') AND (articulos.id = lineascomanda.articulo) AND (lineascomanda.horainicio='0') AND (articulos.tipo = '1')");
	
	addTable($res, "tablaPorElaborar", "Pedidos Pendientes de Elaboración",1,"Asignar");

	$res=DbAdapter::consultaSql("SELECT articulos.nombre as articulo,lineascomanda.id as id, mesa FROM comandas,lineascomanda,articulos WHERE (lineascomanda.comanda=comandas.id) AND (horacierre='0') AND (articulos.id = lineascomanda.articulo) AND (lineascomanda.horainicio!='0') AND (articulos.tipo = '1')AND (lineascomanda.horafinalizacion='0') AND (cocinero='".$id."')");

	addTable($res, "tablaElaborando", "Pedidos en Curso",2,"Terminar");
	
	echo "<script src=\"chef.js\"></script>";

	View::end();

    function addTable ($res,$action,$title,$tipo,$text){
		echo "<div id=\"$action\" class=\"tablasChef\">";
		echo "<h2>$title</h2>";
        foreach($res as $value){
            $id = $value['id'];
$HTML= <<<FIN
<div class ="PrimTabProdCom" id="PrimTabProdCom$id">
<div class="nombreProdChef">
<p>{$value['articulo']}</p>
</div>
<div class="mesaProdChef">
<p>Mesa {$value['mesa']}</p>
</div>
<div class="colCheckElab$tipo">
<button type="button" class="btn-style" name ="$id" id="botonServir">$text</button>
</div>
</div>
FIN;
            echo $HTML;
        }
		echo "</div>";
    }
?>