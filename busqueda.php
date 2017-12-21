<?php
include 'DbAdapter.php';
$json = file_get_contents('php://input');
$obj = (array)json_decode($json);
$nombre = $obj['valorBuscar'];
$resultado = "";
$numRes = DbAdapter::consultaUnica("SELECT count(*) FROM articulos WHERE articulos.nombre like '%$nombre%' COLLATE NOCASE;")['count(*)'];
if($numRes>0){
    $res = DbAdapter::consultaSql("SELECT articulos.nombre as nombre FROM articulos WHERE articulos.nombre like '%$nombre%' COLLATE NOCASE;");
    foreach($res as $value){
    	$nombre = $value['nombre'];
    	$resultado .= <<<FIN
    	<div class="busRow">
    	<p>$nombre</p>
    	</div>
FIN;
    }
} else {
    $resultado .= <<<FIN
    	<div class="busRow">
    	<p>No se encuentran resultados</p>
    	</div>
FIN;
}
echo $resultado;
?>