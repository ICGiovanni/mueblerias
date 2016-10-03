<?php
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'productos/models/class.Productos.php');

$productos=new Productos();

$producto_id=$productos->ActualizarProducto($_REQUEST);

if(count($_FILES['upload']['name']))
{
	$productos->InsertImagesProduct($producto_id, $_FILES['upload']);
}

echo $producto_id;