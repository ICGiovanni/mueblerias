<?php

list($evento_fecha_vencimiento_dia,$evento_fecha_vencimiento_mes,$evento_fecha_vencimiento_ano) = explode("/",$_GET["evento_fecha"]);
list($evento_fecha_recordatorio_dia,$evento_fecha_recordatorio_mes,$evento_fecha_recordatorio_ano) = explode("/",$_GET["evento_recordatorio_fecha"]);

$evento_fecha_vencimiento = $evento_fecha_vencimiento_ano."-".$evento_fecha_vencimiento_mes."-".$evento_fecha_vencimiento_dia;
$evento_fecha_recordatorio = $evento_fecha_recordatorio_ano."-".$evento_fecha_recordatorio_mes."-".$evento_fecha_recordatorio_dia;

$_GET["evento_fecha"]=$evento_fecha_vencimiento." ".$_GET["evento_hora"];
$_GET["evento_recordatorio_fecha"]=$evento_fecha_recordatorio." ".$_GET["evento_recordatorio_hora"];

require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once("../models/class.Calendario.php");
$objCalendario = new Calendario();

$evento_id = $objCalendario->insertEvento($_GET);

echo $evento_id;

/* meter evento
require_once("../models/class.Calendario.php");
$objCalendario = new Calendario();
$params = array(
					"evento_nombre"=>"Cita Proveedor",
					"evento_fecha"=>"2016-10-28 06:30:00",
					"evento_desc"=>"Veremos detalles para catalogo 2018",
					"evento_recordatorio_activo"=>"1",
					"evento_recordatorio_fecha"=>"2016-10-28 06:00:00",
					"login_id"=>"1"
				)
$evento_id = $objCalendario->insertEvento($params);
*/