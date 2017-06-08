<?php
session_start();

if(isset( $_SESSION["punto_venta"] )){
	$_SESSION["punto_venta"]["facturacion"] = array();
	$_SESSION["punto_venta"]["facturacion"]["cliente_direccion_id"] = $_REQUEST["cliente_direccion_id"];
	$_SESSION["punto_venta"]["facturacion"]["select_correo_factura"] = $_REQUEST["select_correo_factura"];
}
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'clientes/models/class.Clientes.php');