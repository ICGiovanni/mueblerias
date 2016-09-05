<?php
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
		$sql="INSERT INTO clientes VALUES('',:nombre,:apellidoP,:apellidoM,:razonS,:rfc,:calle,:noExt,:noInt,:colonia,:codigoPostal,:municipio,:estado,:telefono,:telefonoA,:celular,:celularA,:email,:emailA,'')";
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':nombre', $params['nombre'], PDO::PARAM_STR);
		$statement->bindParam(':apellidoP', $params['apellidoP'], PDO::PARAM_STR);
		$statement->bindParam(':apellidoM', $params['apellidoM'], PDO::PARAM_STR);
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
		$statement->bindParam(':celular', $params['celular'], PDO::PARAM_STR);
		$statement->bindParam(':celularA', $params['celularA'], PDO::PARAM_STR);
		$statement->bindParam(':email', $params['email'], PDO::PARAM_STR);
		$statement->bindParam(':emailA', $params['emailA'], PDO::PARAM_STR);
		
		$statement->execute();
		return $this->connect->lastInsertId();		
	}
	
	public function ActualizarCliente($params)
	{
		$sql="UPDATE clientes SET nombre=:nombre,apellidoP=:apellidoP,apellidoM=:apellidoM,razon_social=:razonS,rfc=:rfc,
				calle=:calle,num_exterior=:noExt,num_interior=:noInt,colonia=:colonia,
				codigo_postal=:codigoPostal,municipio=:municipio,id_estado=:estado,
				telefono=:telefono,telefono_alterno=:telefonoA,celular=:celular,celularA=:celularA,email=:email,
				emailA=:emailA
				WHERE id_cliente=:id_cliente";
		
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':id_cliente', $params['id_cliente'], PDO::PARAM_STR);
		$statement->bindParam(':nombre', $params['nombre'], PDO::PARAM_STR);
		$statement->bindParam(':apellidoP', $params['apellidoP'], PDO::PARAM_STR);
		$statement->bindParam(':apellidoM', $params['apellidoM'], PDO::PARAM_STR);
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
		$statement->bindParam(':celular', $params['celular'], PDO::PARAM_STR);
		$statement->bindParam(':celularA', $params['celularA'], PDO::PARAM_STR);
		$statement->bindParam(':email', $params['email'], PDO::PARAM_STR);
		$statement->bindParam(':emailA', $params['emailA'], PDO::PARAM_STR);
		
		$statement->execute();
		return $params['id_cliente'];
	}
	
	public function BorrarCliente($id_cliente)
	{
		$sql="DELETE FROM clientes WHERE id_cliente=:id_cliente";
		
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':id_cliente', $id_cliente, PDO::PARAM_STR);
		
		$statement->execute();
		return $id_cliente;
	}
	
	public function JsonClientes()
	{
		$sql="SELECT c.id_cliente,c.nombre,c.apellidoP,c.apellidoM,c.razon_social,c.rfc,c.calle,c.num_exterior,
				c.num_interior,c.colonia,c.codigo_postal,c.municipio,
				e.estado,c.telefono,c.telefono_alterno,c.celular,c.celularA,c.email,c.emailA,c.rating
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
	
	public function JsonRating($params)
	{
		$monto=$params['monto'];
		$compras=$params['compras'];
		
		$json=array(array("monto"=>$monto,"compras"=>$compras));
		
		$json=json_encode($json);
		
		$jsonPathFile='json/rating.json';
		
		$handler = fopen($jsonPathFile, "w");
		fwrite($handler, $json);
		fclose($handler);
	}
	
	public function GetClientes($id_cliente="",$order="")
	{
		if($id_cliente)
		{
			$where="WHERE c.id_cliente IN(".$id_cliente.")";
		}
		else
		{
			$where="";
		}
		
		if($order)
		{
			$orderby="ORDER BY ".$order;
		}
		else
		{
			$orderby="ORDER BY c.id_cliente";
		}
		
		
		$sql="SELECT c.id_cliente,c.nombre,c.apellidoP,c.apellidoM,c.razon_social,c.rfc,c.calle,c.num_exterior,
				c.num_interior,c.colonia,c.codigo_postal,c.municipio,
				e.estado,c.telefono,c.telefono_alterno,c.celular,c.celularA,c.email,c.emailA
				FROM clientes c
				INNER JOIN estados e USING(id_estado)
				$where
				$orderby";
	
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
	
		return $result;
	}
}