<?php
include 'DbAdapter.php';
include 'sessionAction.php';

$res = new stdClass();
$res->selected=false; //Formato objeto con propiedad deleted (por defecto a false)
$res->message='Error'; //Mensaje en caso de error

$json = file_get_contents('php://input');
$obj = (array)json_decode($json);
$id = $obj['id'];

$time = time();
DbAdapter::consultaSql("UPDATE lineascomanda SET horafinalizacion='".$time."' WHERE id='".$id."'");
$res->selected=true;
$res->id=$id;
header('Content-type: application/json');
echo json_encode($res);