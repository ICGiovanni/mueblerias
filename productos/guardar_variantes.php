<?php
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'productos/models/class.Productos.php');
header("Content-Type: application/json;charset=utf-8");
$data=json_decode(file_get_contents('php://input'), true);
$productos=new Productos();
$productos->InsertProductoVariantes($_REQUEST['id'],$data);

echo $_REQUEST['id'];

