<?php
session_start();

if(isset( $_SESSION["punto_venta"] )){
	if(isset($_REQUEST["cliente_direccion_id"]) && !empty($_REQUEST["cliente_direccion_id"])){
		$_SESSION["punto_venta"]["cliente_direccion_id_fact"]=$_REQUEST["cliente_direccion_id"];
	}
}
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'clientes/models/class.Clientes.php');

