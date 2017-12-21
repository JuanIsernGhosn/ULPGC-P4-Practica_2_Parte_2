<?php
include 'DbAdapter.php';
session_start();
$idSes = $_SESSION['id'];
$res = new stdClass();
$res->served=false; //Formato objeto con propiedad deleted (por defecto a false)
$res->message='Error'; //Mensaje en caso de error

$json = file_get_contents('php://input');
$obj = (array)json_decode($json);
$id = $obj['id'];

$time = time();
DbAdapter::consultaSql("UPDATE lineascomanda SET horaservicio='".$time."', camareroservicio='".$idSes."'  WHERE id='".$id."'");
$res->served=true;
$producto = DbAdapter::consultaUnica("Select articulos.nombre as nombre, articulos.PVP as precio from lineascomanda,articulos where lineascomanda.id='".$id."'  and lineascomanda.articulo = articulos.id;");
$res->precio=$producto['precio'];
$res->nombre=$producto['nombre'];

header('Content-type: application/json; charset=utf-8');
echo json_encode($res);
exit();