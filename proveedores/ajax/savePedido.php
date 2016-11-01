<?php session_start();

require_once($_SERVER["REDIRECT_PATH_CONFIG"].'config.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'proveedores/models/class.Pedidos.php');
require_once($_SERVER['REDIRECT_PATH_CONFIG'].'/calendario/models/class.Calendario.php');

$objCalendario = new Calendario();
$pedidos = new Pedidos();

$data = $_POST;
    
echo $pedidos->savePedido($data);

$login_session = $_SESSION['login_session'];

$params = array(
					"evento_nombre"=>"Pedido Proveedor",
					"evento_fecha"=>$data['fecha'],
					"evento_desc"=>$data['observaciones'],
					"evento_recordatorio_activo"=>"1",
					"evento_recordatorio_fecha"=>$data['fecha'],
					"login_id"=>$login_session['login_id']
				);

$evento_id = $objCalendario->insertEvento($params);
?>
    