<?php
$administracion = 'Sucursal';
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once("../models/class.".$administracion.".php");

eval('$obj_admin = new '.$administracion.'();');
eval('$return = $obj_admin->edit'.$administracion.'($_GET);');

echo $return;