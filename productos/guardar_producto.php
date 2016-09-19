<?php 
//echo count($_FILES['upload']['name']);}
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'productos/models/class.Productos.php');

$productos=new Productos();

//$id_producto=$productos->InsertarProducto($_REQUEST);
$id_producto=6;
if(count($_FILES['upload']['name']))
{
	$productos->InsertImagesProduct($id_producto, $_FILES['upload']);
}

