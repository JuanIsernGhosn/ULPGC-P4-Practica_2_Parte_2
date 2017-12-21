<?php
include 'DbAdapter.php';
include 'sessionAction.php';

$res = new stdClass();
$res->selected=false; //Formato objeto con propiedad deleted (por defecto a false)
$res->message='Error'; //Mensaje en caso de error

$json = file_get_contents('php://input');
$obj = (array)json_decode($json);
$id = $obj['id'];

session_start();
$idSes = $_SESSION['id'];

$time = time();
DbAdapter::consultaSql("UPDATE lineascomanda SET horainicio='".$time."', cocinero='".$idSes."' WHERE id='".$id."'");
$producto = DbAdapter::consultaUnica("Select articulos.nombre as nombre, comandas.mesa as mesa from lineascomanda,comandas,articulos where lineascomanda.id='".$id."'  and lineascomanda.comanda = comandas.id and lineascomanda.articulo = articulos.id;");

$res->id= $id;
$res->nombre= $producto['nombre'];
$res->mesa= $producto['mesa'];

$res->selected=true;
header('Content-type: application/json');
echo json_encode($res);