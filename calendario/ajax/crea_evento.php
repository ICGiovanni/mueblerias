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