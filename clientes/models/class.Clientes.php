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
	
	public function DeleteDataCliente($id_cliente)
	{
		$sql="DELETE FROM cliente_direccion WHERE id_cliente=:id_cliente";
		
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':id_cliente', $id_cliente, PDO::PARAM_STR);
		
		$statement->execute();
		return $id_cliente;
	}
	
	public function InsertarDatosCliente($idCliente,$data)
	{
		$this->DeleteDataCliente($idCliente);
		
		foreach($data as $d)
		{			
			$sql="INSERT INTO cliente_direccion VALUES('',:cliente,:tipo,:calle,:num_ext,:num_int,:colonia,:municipio,:estado,:codigoPostal,:rfc,:razon_social,:referencia)";
			
			$statement=$this->connect->prepare($sql);
			
			$statement->bindParam(':cliente', $idCliente, PDO::PARAM_STR);
			$statement->bindParam(':tipo', $d['tipo'], PDO::PARAM_STR);
			$statement->bindParam(':calle', $d['calle'], PDO::PARAM_STR);
			$statement->bindParam(':num_ext', $d['noExt'], PDO::PARAM_STR);
			$statement->bindParam(':num_int', $d['noInt'], PDO::PARAM_STR);
			$statement->bindParam(':colonia', $d['colonia'], PDO::PARAM_STR);
			$statement->bindParam(':municipio', $d['municipio'], PDO::PARAM_STR);
			$statement->bindParam(':estado', $d['estado'], PDO::PARAM_STR);
			$statement->bindParam(':codigoPostal', $d['codigoPostal'], PDO::PARAM_STR);
			$statement->bindParam(':rfc', $d['rfc'], PDO::PARAM_STR);
			$statement->bindParam(':razon_social', $d['razonS'], PDO::PARAM_STR);
			$statement->bindParam(':referencia', $d['referencia'], PDO::PARAM_STR);
			
			$statement->execute();
		}
		
		$cliente_id=$this->connect->lastInsertId();
	}
	
	public function InsertarCliente($params)
	{
		$sql="INSERT INTO clientes VALUES('',:nombre,:apellidoP,:apellidoM,'')";
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':nombre', $params['nombre'], PDO::PARAM_STR);
		$statement->bindParam(':apellidoP', $params['apellidoP'], PDO::PARAM_STR);
		$statement->bindParam(':apellidoM', $params['apellidoM'], PDO::PARAM_STR);
		
		$statement->execute();
		$cliente_id=$this->connect->lastInsertId();
		
		$phone=$_REQUEST['telefono'];
		$phone_type=$_REQUEST['phoneType'];
		
		foreach($phone as $k=>$p)
		{
			$type=$phone_type[$k];
			
			if($p!='')
			{
				$sql="INSERT INTO cliente_telefono VALUES('',:id_cliente,:type,:phone)";
				$statement=$this->connect->prepare($sql);
				$statement->bindParam(':id_cliente', $cliente_id, PDO::PARAM_STR);
				$statement->bindParam(':type', $type, PDO::PARAM_STR);
				$statement->bindParam(':phone', $p, PDO::PARAM_STR);
				
				$statement->execute();
			}
		}
		
		$email=$_REQUEST['email'];
	
		foreach($email as $k=>$e)
		{
			if($e!='')
			{
				$sql="INSERT INTO cliente_email VALUES('',:id_cliente,:email)";
				$statement=$this->connect->prepare($sql);
				$statement->bindParam(':id_cliente', $cliente_id, PDO::PARAM_STR);
				$statement->bindParam(':email', $e, PDO::PARAM_STR);
		
				$statement->execute();
			}
		}
		
		return $cliente_id;
	}
	
	public function ActualizarCliente($params)
	{
		$sql="UPDATE clientes SET nombre=:nombre,apellidoP=:apellidoP,apellidoM=:apellidoM,razon_social=:razonS,rfc=:rfc,
				calle=:calle,num_exterior=:noExt,num_interior=:noInt,colonia=:colonia,
				codigo_postal=:codigoPostal,municipio=:municipio,id_estado=:estado
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
		
		$statement->execute();
		
		$cliente_id=$params['id_cliente'];
		
		$this->BorrarTelefonos($cliente_id);
		
		$phone=$_REQUEST['telefono'];
		$phone_type=$_REQUEST['phoneType'];
		
		foreach($phone as $k=>$p)
		{
			$type=$phone_type[$k];
				
			if($p!='')
			{
				$sql="INSERT INTO cliente_telefono VALUES('',:id_cliente,:type,:phone)";
				$statement=$this->connect->prepare($sql);
				$statement->bindParam(':id_cliente', $cliente_id, PDO::PARAM_STR);
				$statement->bindParam(':type', $type, PDO::PARAM_STR);
				$statement->bindParam(':phone', $p, PDO::PARAM_STR);
		
				$statement->execute();
			}
		}
		
		$this->BorrarEmail($cliente_id);
		
		$email=$_REQUEST['email'];
		
		foreach($email as $k=>$e)
		{
			if($e!='')
			{
				$sql="INSERT INTO cliente_email VALUES('',:id_cliente,:email)";
				$statement=$this->connect->prepare($sql);
				$statement->bindParam(':id_cliente', $cliente_id, PDO::PARAM_STR);
				$statement->bindParam(':email', $e, PDO::PARAM_STR);
		
				$statement->execute();
			}
		}
		
		return $cliente_id;
	}
	
	public function BorrarTelefonos($id_cliente)
	{
		$sql="DELETE FROM cliente_telefono WHERE id_cliente=:id_cliente";
		
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':id_cliente', $id_cliente, PDO::PARAM_STR);
		
		$statement->execute();
		return $id_cliente;
	}
	
	public function BorrarEmail($id_cliente)
	{
		$sql="DELETE FROM cliente_email WHERE id_cliente=:id_cliente";
		
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':id_cliente', $id_cliente, PDO::PARAM_STR);
		
		$statement->execute();
		return $id_cliente;
	}
	
	public function BorrarCliente($id_cliente)
	{
		$this->BorrarTelefonos($id_cliente);
		
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
				e.estado,c.rating,
				IF((SELECT ct.number
				FROM cliente_telefono ct
				WHERE ct.id_cliente=c.id_cliente
				ORDER BY id_telefono ASC
				LIMIT 0,1)!='',
				(SELECT ct.number
				FROM cliente_telefono ct
				WHERE ct.id_cliente=c.id_cliente
				ORDER BY id_telefono ASC
				LIMIT 0,1),'') AS telefono,
				IF((SELECT ce.email
				FROM cliente_email ce
				WHERE ce.id_cliente=c.id_cliente
				ORDER BY id_email ASC
				LIMIT 0,1)!='',
				(SELECT ce.email
				FROM cliente_email ce
				WHERE ce.id_cliente=c.id_cliente
				ORDER BY id_email ASC
				LIMIT 0,1),'') AS email
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
		
		
		$sql="SELECT c.id_cliente,c.nombre,c.apellidoP,c.apellidoM
				FROM clientes c
				$where
				$orderby";
	
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
	
		return $result;
	}
	
	public function GetDataCliente($id_cliente)
	{
		$sql="SELECT cliente_direccion_tipo_desc,cliente_direccion_calle,cliente_direccion_numero_ext,
				cliente_direccion_numero_int,cliente_direccion_colonia,cliente_direccion_municipio,
				estado,cliente_direccion_cp,cliente_direccion_rfc,cliente_direccion_razon_social,
				cliente_direccion_entre_calles
				FROM cliente_direccion cd
				INNER JOIN cliente_direccion_tipo cdt USING(cliente_direccion_tipo_id)
				INNER JOIN estados e USING(id_estado)
				WHERE cliente_id='$id_cliente'
				ORDER BY cliente_direccion_id";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	public function GetTypesPhones()
	{
		$sql="SELECT phone_type_id,type
				FROM inv_phone_type";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	public function GetPhonesClient($id_cliente)
	{
		$sql="SELECT ct.number,pt.phone_type_id,pt.type,pt.phone_type_css 
				FROM cliente_telefono ct
				INNER JOIN inv_phone_type pt USING(phone_type_id)
				WHERE ct.id_cliente=:id_cliente";
		
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':id_cliente', $id_cliente, PDO::PARAM_STR);
		
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	public function GetEmailsClient($id_cliente)
	{
		$sql="SELECT ce.email
				FROM cliente_email ce
				WHERE ce.id_cliente=:id_cliente";
		
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':id_cliente', $id_cliente, PDO::PARAM_STR);
	
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
	
		return $result;
	}
	
	public function GetClientsSearch(){
		$sql="SELECT id_cliente, concat(nombre,' ',apellidoP,' ',apellidoM) AS nombre
			FROM clientes
			WHERE 1";
	
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		
		while ( list($key, $values) = each ($result) ){
			/////
			$emails = $this->GetEmailsClient($values["id_cliente"]);
			
			$txtEmails = array();
			while ( list($keyE, $valueE) = each($emails) ){
				$txtEmails[]=$valueE["email"];	
			}
			$txtEmails = implode(",",$txtEmails);
			/////
			$numbers = $this->GetPhonesClient($values["id_cliente"]);
			
			$txtNumbers = array();
			$txtNumbersWithType = array();
			while ( list($keyN, $valueN) = each($numbers) ){
				
				$txtNumbersWithType[]=$valueN["phone_type_id"]."|".$valueN["number"];	
				$txtNumbers[]=$valueN["number"];
				
			}
			$txtNumbers = implode(",",$txtNumbers);
			$txtNumbersWithType = implode(",",$txtNumbersWithType);
			/////
			$result[$key]["emails"]=$txtEmails;
			$result[$key]["numbers"]=$txtNumbers;
			$result[$key]["numbers_type"]=$txtNumbersWithType;
		}
		//print_r($result);
		return $result;
	}
	
	public function getClientAdresses($cliente_id){
		$sql="SELECT 
				cliente_direccion_id,
				cliente_direccion_tipo_id,
				cliente_direccion_calle,
				cliente_direccion_numero_ext,
				cliente_direccion_numero_int,
				cliente_direccion_colonia,
				cliente_direccion_municipio,
				estado,
				id_estado,
				cliente_direccion_cp,
				cliente_direccion_rfc,
				cliente_direccion_razon_social,
				cliente_direccion_entre_calles
			FROM cliente_direccion
			INNER JOIN estados USING(id_estado)
			WHERE cliente_id = :cliente_id";
		
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':cliente_id', $cliente_id, PDO::PARAM_STR);
		
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	
	public function InsertClientAddress($idCliente,$json)
	{
		
	}
}