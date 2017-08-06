<?php
session_start();

if(isset( $_SESSION["punto_venta"] )){
	$_SESSION["punto_venta"]["envio"] = array();
	$_SESSION["punto_venta"]["envio"]["cliente_direccion_id"] = $_REQUEST["cliente_direccion_id"];
	$_SESSION["punto_venta"]["envio"]["select_zona_envio"] = $_REQUEST["select_zona_envio"];
	$_SESSION["punto_venta"]["envio"]["costo_envio"] = $_REQUEST["costo_envio"];
	$_SESSION["punto_venta"]["envio"]["fecha_hora_entrega"] = $_REQUEST["fecha_hora_entrega"];
	$_SESSION["punto_venta"]["envio"]["select_planta"] = $_REQUEST["select_planta"];
	$_SESSION["punto_venta"]["envio"]["select_planta_extra"] = $_REQUEST["select_planta_extra"];
	$_SESSION["punto_venta"]["envio"]["flete_observaciones"] = $_REQUEST["flete_observaciones"];
	
}
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'clientes/models/class.Clientes.php');