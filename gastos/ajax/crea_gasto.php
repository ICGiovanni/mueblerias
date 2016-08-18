<?php
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once("../models/class.Gastos.php");
$gasto = new Gasto();
$return = $gasto->insertGasto($_GET);
echo $return;