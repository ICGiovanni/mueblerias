<?php
$administracion = 'Color';
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once("../models/class.".$administracion.".php");

eval('$obj_admin = new '.$administracion.'();');
eval('$obj_id = $obj_admin->insert'.$administracion.'($_GET);');

echo $obj_id;