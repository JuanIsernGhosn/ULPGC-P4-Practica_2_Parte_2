<?php

include 'DbAdapter.php';

$res = new stdClass();
$res->deleted=false; //Formato objeto con propiedad deleted (por defecto a false)
$res->message='Error'; //Mensaje en caso de error

$json = file_get_contents('php://input');
$obj = (array)json_decode($json);
$id = $obj['id'];

DbAdapter::consultaSql("DELETE from lineascomanda where id ='".$id."'");
$res->deleted=true;
header('Content-type: application/json');
echo json_encode($res);