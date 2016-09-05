<?php

$now = time();
$dateNow = date("Y-m-d H:i:s", $now);

require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/ingresos/models/class.Ingresos.php';
$ingreso = new Ingreso();

$_GET["ingreso_fecha"]=$dateNow;


$ingreso_id = $ingreso->insertIngreso($_GET);
$_GET["ingreso_id"]=$ingreso_id;
$ingreso_gasto_id = $ingreso->insertIngresoGasto($_GET);
print_r($_GET);
echo $ingreso_gasto_id;