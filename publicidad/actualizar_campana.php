<?php
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'publicidad/models/class.Publicidad.php');

$publicidad=new Publicidad();
$id_publicidad=$publicidad->ActualizarPublicidad($_REQUEST);

echo $id_publicidad;