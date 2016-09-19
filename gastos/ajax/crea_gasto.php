<?php

list($gasto_fecha_vencimiento_dia,$gasto_fecha_vencimiento_mes,$gasto_fecha_vencimiento_ano) = explode("/",$_GET["gasto_fecha_vencimiento"]);
list($gasto_fecha_recordatorio_dia,$gasto_fecha_recordatorio_mes,$gasto_fecha_recordatorio_ano) = explode("/",$_GET["gasto_fecha_recordatorio"]);


$gasto_fecha_vencimiento = $gasto_fecha_vencimiento_ano."-".$gasto_fecha_vencimiento_mes."-".$gasto_fecha_vencimiento_dia;
$gasto_fecha_recordatorio = $gasto_fecha_recordatorio_ano."-".$gasto_fecha_recordatorio_mes."-".$gasto_fecha_recordatorio_dia;

$_GET["gasto_fecha_vencimiento"]=$gasto_fecha_vencimiento." ".$_GET["gasto_hora_vencimiento"];
$_GET["gasto_fecha_recordatorio"]=$gasto_fecha_recordatorio." ".$_GET["gasto_hora_recordatorio"];

$_GET["gastos_pagos_fecha"]=$_GET["gasto_fecha_vencimiento"];

require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once("../models/class.Gastos.php");
$gasto = new Gasto();

$gasto_id = $gasto->insertGasto($_GET);
if(isset($_GET["pago_automatico"]) && $_GET["pago_automatico"] == 1){
	$_GET["gasto_id"] =  $gasto_id;
	$_GET["login_id"] = $_GET["login_id_quien_registra"]; // se sobreescribe login del beneficiario por el de quien registra
	$gasto->insertGastoPago($_GET);
}
echo $gasto_id;