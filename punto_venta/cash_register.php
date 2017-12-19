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
	$caja->CashRegisterFinal();
}
else if($type=='M')
{
	$mount=$_REQUEST['m'];
	$caja->CashRegisterMountInit($mount);
}
else if($type=='DP')
{
	$corte_parcial_id=$_REQUEST['cp'];
	$caja->DeleteBoxCutPartial($corte_parcial_id);
}
else if($type=='DF')
{
	$corte_final_id=$_REQUEST['cf'];
	$caja->DeleteBoxCutFinal($corte_final_id);
}