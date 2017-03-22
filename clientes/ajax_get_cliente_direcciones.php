<?php
session_start();
//print_r($_SESSION);

if(isset( $_SESSION["punto_venta"] )){
	if(isset($_REQUEST["cliente_id"]) && !empty($_REQUEST["cliente_id"])){
		$_SESSION["punto_venta"]["cliente_id"]=$_REQUEST["cliente_id"];
	}
}

include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'clientes/models/class.Clientes.php');

if(empty($_REQUEST["cliente_id"])){ die("datos insuficientes"); }

$clientes = new Clientes();
$result = $clientes->getClientAdresses($_REQUEST["cliente_id"]);
echo json_encode($result);