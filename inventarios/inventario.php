<?php
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
	
}
?>