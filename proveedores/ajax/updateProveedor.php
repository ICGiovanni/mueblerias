<?php

require_once($_SERVER["REDIRECT_PATH_CONFIG"].'config.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'proveedores/models/class.Proveedores.php');

$proveedores = new Proveedor();

$data = $_POST;

echo "<pre>";
    print_r($data);
echo "</pre>";    
die();
echo $proveedores->updateProveedor($data);
?>
    