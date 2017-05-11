<?php
session_start();

if(isset( $_SESSION["punto_venta"] )){
	$_SESSION["punto_venta"]["envio"] = array();
	$_SESSION["punto_venta"]["envio"]["cliente_direccion_id"] = "0";
	$_SESSION["punto_venta"]["envio"]["motivo"] = $_REQUEST["motivo"];
}
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'clientes/models/class.Clientes.php');