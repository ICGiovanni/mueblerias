<?php
session_start();

if(isset( $_SESSION["punto_venta"] )){
	if( isset($_REQUEST["name"]) && !empty($_REQUEST["name"]) ){
		$_SESSION["punto_venta"]["cliente"]["name"]=$_REQUEST["name"];
	}
	if( isset($_REQUEST["email"]) && !empty($_REQUEST["email"]) ){
		$_SESSION["punto_venta"]["cliente"]["email"]=$_REQUEST["email"];
	}
	if( isset($_REQUEST["number"]) && !empty($_REQUEST["number"]) ){
		$_SESSION["punto_venta"]["cliente"]["number"]=$_REQUEST["number"];
	}
}
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'clientes/models/class.Clientes.php');