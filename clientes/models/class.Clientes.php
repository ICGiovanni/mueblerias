<?php
session_start();
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/connection/class.Connection.php');

class Clientes
{
	private $connect;
	
	function __construct()
	{
		$c=new Connection();
		$this->connect=$c->db;
	}
	
	public function InsertarCliente($params)
	{
		$sql="INSERT INTO clientes VALUES('',:nombre,:razonS,:rfc,:calle,:noExt,:noInt,:colonia,:codigoPostal,:municipio,:estado,:telefono,:telefonoA,:email)";
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':nombre', $params['nombre'], PDO::PARAM_STR);
		$statement->bindParam(':razonS', $params['razonS'], PDO::PARAM_STR);
		$statement->bindParam(':rfc', $params['rfc'], PDO::PARAM_STR);
		$statement->bindParam(':calle', $params['calle'], PDO::PARAM_STR);
		$statement->bindParam(':noExt', $params['noExt'], PDO::PARAM_STR);
		$statement->bindParam(':noInt', $params['noInt'], PDO::PARAM_STR);
		$statement->bindParam(':colonia', $params['colonia'], PDO::PARAM_STR);
		$statement->bindParam(':codigoPostal', $params['codigoPostal'], PDO::PARAM_STR);
		$statement->bindParam(':municipio', $params['municipio'], PDO::PARAM_STR);
		$statement->bindParam(':estado', $params['estado'], PDO::PARAM_STR);
		$statement->bindParam(':telefono', $params['telefono'], PDO::PARAM_STR);
		$statement->bindParam(':telefonoA', $params['telefonoA'], PDO::PARAM_STR);
		$statement->bindParam(':email', $params['email'], PDO::PARAM_STR);
		
		$statement->execute();
		return $this->connect->lastInsertId();		
	}
	
	public function JsonClientes()
	{
		$sql="SELECT c.cliente,c.razon_social,c.rfc,c.calle,c.num_exterior,
				c.num_interior,c.colonia,c.codigo_postal,c.municipio,
				e.estado,c.telefono,c.telefono_alterno,c.email
				FROM clientes c
				INNER JOIN estados e USING(id_estado)
				ORDER BY c.id_cliente";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		$json=json_encode($result);
		
		$jsonPathFile='json/lista_clientes.json';
		
		$handler = fopen($jsonPathFile, "w");
		fwrite($handler, $json);
		fclose($handler);
	}
}