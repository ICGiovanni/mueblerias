<?php
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'punto_venta/models/class.Caja.php');

$caja=new Caja();

$type=$_REQUEST['t'];

if($type=='P')
{
	$caja->CashRegisterPartial();
}
else if($type=='F')
{
	
}