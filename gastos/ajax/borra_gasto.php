<?php
if(!isset($_GET["gasto_id"])){
	die("datos insuficientes");
}

require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once("../models/class.Gastos.php");
$gasto = new Gasto();

$return = $gasto->deleteGasto($_GET["gasto_id"]);
echo $return;