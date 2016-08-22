<?php

list($gasto_fecha_vencimiento_dia,$gasto_fecha_vencimiento_mes,$gasto_fecha_vencimiento_ano) = explode("/",$_GET["gasto_fecha_vencimiento"]);
list($gasto_fecha_recordatorio_dia,$gasto_fecha_recordatorio_mes,$gasto_fecha_recordatorio_ano) = explode("/",$_GET["gasto_fecha_recordatorio"]);


$gasto_fecha_vencimiento = $gasto_fecha_vencimiento_ano."-".$gasto_fecha_vencimiento_mes."-".$gasto_fecha_vencimiento_dia;
$gasto_fecha_recordatorio = $gasto_fecha_recordatorio_ano."-".$gasto_fecha_recordatorio_mes."-".$gasto_fecha_recordatorio_dia;

$_GET["gasto_fecha_vencimiento"]=$gasto_fecha_vencimiento." ".$_GET["gasto_hora_vencimiento"];
$_GET["gasto_fecha_recordatorio"]=$gasto_fecha_recordatorio." ".$_GET["gasto_hora_recordatorio"];;

require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once("../models/class.Gastos.php");
$gasto = new Gasto();

$return = $gasto->editGasto($_GET);
echo $return;