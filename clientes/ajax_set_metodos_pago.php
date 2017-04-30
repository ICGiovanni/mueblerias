<?php
session_start();

if(isset( $_SESSION["punto_venta"] )){
	$_SESSION["punto_venta"]["pago"] = array();
	
	$_SESSION["punto_venta"]["pago"] = $_POST["pago_data"]; //{ "pagos": [ {"metodo":"efectivo","monto":"200","referencia":""},{"metodo":"tarjeta credito","monto":"100","referencia":"8955"}  ]}
}
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'clientes/models/class.Clientes.php');