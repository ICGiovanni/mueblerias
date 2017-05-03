<?php
session_start();

if(isset( $_SESSION["punto_venta"]["cliente"] )){
	unset($_SESSION["punto_venta"]["cliente"]);
}
if( isset($_SESSION["punto_venta"]["envio"]) ){
	unset($_SESSION["punto_venta"]["envio"]);
}
if( isset($_SESSION["punto_venta"]["pago"]) ){
	unset($_SESSION["punto_venta"]["pago"]);
}
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'clientes/models/class.Clientes.php');

