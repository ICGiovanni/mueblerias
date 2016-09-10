<?php
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'/models/general/class.General.php');
$general=new General();

$date=date('Y-m-d H:i:s');

echo $general->getDate($date);

?>