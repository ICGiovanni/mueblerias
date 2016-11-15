<?php
if(!isset($_GET["semana"])){
	die("Semana Invalida");
}
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'config.php';
require_once($_SERVER['REDIRECT_PATH_CONFIG']."gastos/models/class.Gastos.php");
$gasto = new Gasto();

$gasto->creaNomina($_GET);