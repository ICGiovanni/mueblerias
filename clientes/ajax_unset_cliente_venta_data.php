<?php
session_start();

if(isset( $_SESSION["punto_venta"] )){
	unset($_SESSION["punto_venta"]);
}
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'clientes/models/class.Clientes.php');