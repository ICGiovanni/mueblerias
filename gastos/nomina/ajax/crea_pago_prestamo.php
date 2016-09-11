<?php

$now = time();
$dateNow = date("Y-m-d H:i:s", $now);

require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/ingresos/models/class.Ingresos.php';
$ingreso = new Ingreso();

$_GET["ingreso_fecha"]=$dateNow;


$ingreso_id = $ingreso->insertIngreso($_GET);
$_GET["ingreso_id"]=$ingreso_id;
$ingreso_gasto_id = $ingreso->insertPagoPrestamo($_GET);

if(isset($_GET["cierra_prestamo"]) && $_GET["cierra_prestamo"]=="1"){
	$ingreso->updatePrestamoStatus($_GET["gasto_id"],"2");
}

echo $ingreso_gasto_id;