<?php
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'config.php';
session_start();
if(!isset($_SESSION["login_session"]["login_id"])){
	die("Login necesario");
}
list($gasto_fecha_vencimiento_dia,$gasto_fecha_vencimiento_mes,$gasto_fecha_vencimiento_ano) = explode("/",$_GET["gasto_fecha_vencimiento"]);
list($gasto_fecha_recordatorio_dia,$gasto_fecha_recordatorio_mes,$gasto_fecha_recordatorio_ano) = explode("/",$_GET["gasto_fecha_recordatorio"]);


$gasto_fecha_vencimiento = $gasto_fecha_vencimiento_ano."-".$gasto_fecha_vencimiento_mes."-".$gasto_fecha_vencimiento_dia;
$gasto_fecha_recordatorio = $gasto_fecha_recordatorio_ano."-".$gasto_fecha_recordatorio_mes."-".$gasto_fecha_recordatorio_dia;

$_GET["gasto_fecha_vencimiento"]=$gasto_fecha_vencimiento." ".$_GET["gasto_hora_vencimiento"];
$_GET["gasto_fecha_recordatorio"]=$gasto_fecha_recordatorio." ".$_GET["gasto_hora_recordatorio"];


require_once($_SERVER['REDIRECT_PATH_CONFIG']."gastos/models/class.Gastos.php");
$gasto = new Gasto();
$return = $gasto->editGasto($_GET);

require_once($_SERVER['REDIRECT_PATH_CONFIG'].'calendario/models/class.Calendario.php');
$objCalendario = new Calendario();
$rowRecordatorios = $objCalendario->existRecordatorio($_GET["gasto_id"]);
if(isset($rowRecordatorios[0])){
	
	$rowRecordatorios = $rowRecordatorios[0];
	
	$gasto_fecha_recordatorio_activo = 0;
	if(isset($_GET["gasto_fecha_recordatorio_activo"]) && $_GET["gasto_fecha_recordatorio_activo"] == 1){
		$gasto_fecha_recordatorio_activo = 1;
	}

	$params = array(
					"evento_nombre"=>$_GET["gasto_concepto"],
					"evento_fecha"=>$_GET["gasto_fecha_vencimiento"],
					"evento_desc"=>$_GET["gasto_descripcion"],
					"evento_recordatorio_activo"=>$gasto_fecha_recordatorio_activo,
					"evento_recordatorio_fecha"=>$_GET["gasto_fecha_recordatorio"],
					"evento_id"=>$rowRecordatorios["evento_id"]
				);
	$return = $objCalendario->editEvento($params);
	
} elseif(isset($_GET["gasto_fecha_recordatorio_activo"]) && $_GET["gasto_fecha_recordatorio_activo"] == 1){
	//si no existe el evento pero esta checado el recordatorio
	$params = array(
						"evento_nombre"=>$_GET["gasto_concepto"],
						"evento_fecha"=>$_GET["gasto_fecha_vencimiento"],
						"evento_desc"=>$_GET["gasto_descripcion"],
						"evento_recordatorio_activo"=>"1",
						"evento_recordatorio_fecha"=>$_GET["gasto_fecha_recordatorio"],
						"login_id"=>$_SESSION["login_session"]["login_id"]
					);
	$evento_id = $objCalendario->insertEvento($params);	
	$objCalendario->insertEventoGasto($evento_id, $_GET["gasto_id"]);
}
echo $return;