<?php session_start();

require_once($_SERVER["REDIRECT_PATH_CONFIG"].'config.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'inventarios/models/class.Inventarios.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'proveedores/models/class.Pedidos.php');

$insPedidos = new Pedidos();
$instInventario = new Inventarios();

$productos = $_POST['productos'];
$pedidoId = $_POST['pedido_id'];
foreach($productos as $prod){
    echo $prod['producto_id']. $prod['sucursal_id']. $prod['stock'];
    var_dump($instInventario->InsertProductDB($prod['producto_id'], $prod['sucursal_id'], $prod['stock']));
}

$insPedidos->updatePedidoStatus($pedidoId);


?>    

