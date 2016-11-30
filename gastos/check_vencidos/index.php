<?php
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'config.php';
session_start();
if(!isset($_SESSION["login_session"]["login_id"])){
	die("Login necesario");
}
require_once($_SERVER['REDIRECT_PATH_CONFIG']."gastos/models/class.Gastos.php");
$gasto = new Gasto();

$gasto->marcaVencidos();
