<?php
    include 'DbAdapter.php';

    $nombre = $_POST['nombre'];

    if(strcmp($nombre,"cobrar") == 0){
		cobrar();
	}

	function cobrar(){
		session_start();
		$id = $_SESSION['id'];
		$comanda = $_POST['comanda']; 
		$res = DbAdapter::consultaSql("SELECT articulos.PVP as precio FROM comandas,lineascomanda,articulos WHERE comandas.id=".$comanda." AND lineascomanda.comanda=comandas.id AND articulos.id = lineascomanda.articulo AND lineascomanda.horaservicio != 0");
		$precio=0;
		foreach($res as $value){
			$precio += $value['precio'];
		}
		$time = time();
        DbAdapter::consultaSql("UPDATE comandas SET camarerocierre='".$id."', horacierre='".$time."', PVP='".$precio."' WHERE id='".$comanda."';");
		header("Location: listaMesas.php");
    }
?>