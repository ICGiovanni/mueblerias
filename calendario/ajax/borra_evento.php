<?php
if(!isset($_GET["evento_id"])){
	die("datos insuficientes");
}

require_once $_SERVER['REDIRECT_PATH_CONFIG'].'config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'calendario/models/class.Calendario.php');
$calendario = new Calendario();

$return = $calendario->deleteEvento($_GET["evento_id"]);
echo $return;