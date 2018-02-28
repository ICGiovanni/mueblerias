<?php
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'clientes/models/class.Clientes.php');
$clientes=new Clientes();
$clientes->JsonRating($_REQUEST);
$clientes->calculateRating();




