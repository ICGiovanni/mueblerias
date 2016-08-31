<?php
list($gastos_pagos_fecha_dia,$gastos_pagos_fecha_mes,$gastos_pagos_fecha_ano) = explode("/",$_GET["gastos_pagos_fecha"]);

$gastos_pagos_fecha = $gastos_pagos_fecha_ano."-".$gastos_pagos_fecha_mes."-".$gastos_pagos_fecha_dia;

$_GET["gastos_pagos_fecha"]=$gastos_pagos_fecha." ".$_GET["gastos_pagos_hora"];

require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once("../models/class.Gastos.php");
$gasto = new Gasto();

$return = $gasto->insertGastoPago($_GET);

if(isset($_GET["cierra_gasto"]) && $_GET["cierra_gasto"]=="1"){
	$gasto->updateGastoStatus($_GET["gasto_id"],"2");
}

echo $return;