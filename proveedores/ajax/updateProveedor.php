<?php

require_once($_SERVER["REDIRECT_PATH_CONFIG"].'config.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'proveedores/models/class.Proveedores.php');

$proveedores = new Proveedor();

$data = $_POST;
    
print_r($data);
echo $proveedores->updateProveedor($data);
?>
    