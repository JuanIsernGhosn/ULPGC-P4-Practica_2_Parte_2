<?php
include 'DbAdapter.php';
include 'sessionAction.php';

$res = new stdClass();
$res->included=false; //Formato objeto con propiedad deleted (por defecto a false)
$res->message='Error al añadir productos a la comanda'; //Mensaje en caso de error

$json = file_get_contents('php://input');
$obj = (array)json_decode($json);
$id = $obj['id'];
$comanda = $obj['comanda'];

session_start();
$idSes = $_SESSION['id'];
$time = time();
$producto = DbAdapter::consultaUnica("SELECT * FROM articulos where id = '".$id."';");
DbAdapter::consultaSql("INSERT INTO [lineascomanda] ([comanda], [articulo], [camareropeticion], [horapeticion], [tipo]) VALUES (".$comanda.", ".$producto['id'].", ".$idSes.", ".$time.", ".$producto['tipo'].");");
$productoAñadido = DbAdapter::consultaUnica("SELECT id FROM lineascomanda where id = (SELECT MAX(id) FROM lineascomanda)");

$res->id = $productoAñadido['id'];
$res->nombre= $producto['nombre'];
$res->tipo= $producto['tipo'];

$res->included=true;
header('Content-type: application/json');
echo json_encode($res);
