<?php
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'clientes/models/class.Clientes.php');
$id_cliente=$_REQUEST['id'];
$clientes=new Clientes();
$id_cliente=$clientes->BorrarCliente($id_cliente);
$clientes->JsonClientes();
echo $id_cliente;