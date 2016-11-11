<?php
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'productos/models/class.Productos.php');

$productos=new Productos();
$type="";
if(isset($_REQUEST['t']))
{
	$type=$_REQUEST['t'];
}

echo json_encode($productos->GetProductsMain($type));