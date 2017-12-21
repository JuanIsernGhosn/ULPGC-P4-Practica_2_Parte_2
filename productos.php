<?php
include_once 'lib.php';
View::startCliente('Productos');
echo "<script src=\"jquery.js\"></script>";

$HTML = <<<FIN
<div id="busqueda">
	<div id="busquedaFields">
		<div>
		<input type="text" name="producto" id="busquedaText"/>
		</div>
	</div>
</div>
<div id="busqRes">
</div>
FIN;
echo $HTML;

echo "<script src=\"productos.js\"></script>";
View::end();
?>