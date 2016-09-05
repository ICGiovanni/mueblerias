<?php
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'publicidad/models/class.Publicidad.php');

$publicidad=new Publicidad();

$data=json_decode(file_get_contents('php://input'), true);

foreach($data["publicidad"] as $p)
{
	$id_publicidad=$p["id"];
	
	echo $publicidad->SendPublicidad($id_publicidad, $data["clientes"]);
}