<?php
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'productos/models/class.Productos.php');

$productos=new Productos();

$type=$_REQUEST['t'];

if($type=='g')
{
	$id_producto=$_REQUEST['id'];
	
	echo json_encode($productos->GetImagesProduct($id_producto));
}
else if($type=='d')
{
	$id_imagen=$_REQUEST['id'];
	
	$productos->DeleteImg($id_imagen);
}