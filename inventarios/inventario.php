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
	
	echo $inventarios->ReceivingProducts($move_id);
}
else if($type=='c')
{
	$result=$inventarios->GetMoves();
	
	echo json_encode($result);
}
?>