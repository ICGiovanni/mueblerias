<?php
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'publicidad/models/class.Publicidad.php');
$id_publicidad=$_REQUEST['id'];
$publicidad=new Publicidad();
$id_publicidad=$publicidad->BorrarPublicidad($id_publicidad);

echo $id_publicidad;