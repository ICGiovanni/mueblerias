<?php
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'clientes/models/class.Clientes.php');

$clientes=new Clientes();

$idCliente=$_REQUEST['id'];
$data=json_decode(file_get_contents('php://input'), true);

$clientes->InsertarDatosCliente($idCliente,$data);

?>