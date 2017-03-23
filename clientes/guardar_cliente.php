<?php
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'clientes/models/class.Clientes.php');

$clientes=new Clientes();
$id_cliente=$clientes->InsertarCliente($_REQUEST);
$clientes->JsonClientes();
echo $id_cliente;