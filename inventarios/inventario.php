<?php
header("Content-Type: application/json;charset=utf-8");
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'inventarios/models/class.Inventarios.php');

$inventarios=new Inventarios();

$type=$_REQUEST['t'];

if($type=='n')
{
	echo $inventarios->InsertMoveInventary($_REQUEST);
}
else if($type=='p')
{
	$move_id=$_REQUEST['id'];
	$data=json_decode(file_get_contents('php://input'), true);
	
	$inventarios->InsertProductsMoves($move_id,$data);
}
else if($type=='j')
{
	$move_id=$_REQUEST['id'];
	
	echo json_encode($inventarios->GetProductsbyMove($move_id));
}
else if($type=='r')
{
	$move_id=$_REQUEST['id'];
	$nota=$_REQUEST['nota'];
	
	echo $inventarios->ReceivingProducts($move_id,$nota);
}
else if($type=='c')
{
	$result=$inventarios->GetMoves();
	
	echo json_encode($result);
}
else if($type=='is')
{
	$product_id=$_REQUEST['id'];
	$result=$inventarios->GetStockbySucursal($product_id);
	echo json_encode($result);
}
else if($type=='cp')
{
	$product_id=$_REQUEST['id'];
	$sucursal_id=$_REQUEST['su'];
	$cantidad=$_REQUEST['c'];
	
	$stock=$inventarios->GetStockbySucursal($product_id.$sucursal_id);
	
	if($stock>=$cantidad)
	{
		echo true;
	}
	else 
	{
		echo false;
	}
}
else if($type=='ns')
{
	$move_id=$_REQUEST['id'];
	
	$result=$inventarios->GetMoves($move_id);
	echo json_encode($result);
}
?>