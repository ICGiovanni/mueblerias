<?php
session_start();

if(isset( $_SESSION["punto_venta"] )){
	if(isset( $_SESSION["punto_venta"]["facturacion"]  )){
		unset( $_SESSION["punto_venta"]["facturacion"] );
	}
}
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'clientes/models/class.Clientes.php');