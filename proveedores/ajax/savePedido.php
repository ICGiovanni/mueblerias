<?php

require_once($_SERVER["REDIRECT_PATH_CONFIG"].'config.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'proveedores/models/class.Pedidos.php');

$pedidos = new Pedidos();

$data = $_POST;
    
echo $pedidos->savePedido($data);
?>
    