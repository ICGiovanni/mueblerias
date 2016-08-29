<?php
//session_start();
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/connection/class.Connection.php');

class Proveedor {
	private $connect;
	
	function __construct()
	{
		$c=new Connection();
		$this->connect=$c->db;
		$this->name_table = 'proveedores';
	}

	public function insertProveedor($params){
		$sql = "INSERT INTO ".$this->name_table." 
		( 
			proveedor_nombre
		)
		VALUES
		( 
			:proveedor_nombre
		)";
		
		//print_r($params);
		//die();
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':proveedor_nombre', $params['proveedor_nombre'], PDO::PARAM_STR);
   	
		$statement->execute();
		return $this->connect->lastInsertId();
	}
	
	public function editProveedor($params){
		$sql = "UPDATE ".$this->name_table." SET 
			proveedor_nombre = :proveedor_nombre
		WHERE proveedor_id = :proveedor_id";
		
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':proveedor_id', $params['proveedor_id'], PDO::PARAM_STR);
		$statement->bindParam(':proveedor_nombre', $params['proveedor_nombre'], PDO::PARAM_STR);
		
		$statement->execute();
		return "updated";
	}
	
	public function getProveedores(){

		$sql="SELECT 
		proveedor_id,
		proveedor_nombre
		FROM ".$this->name_table." ORDER BY proveedor_nombre ASC";

		$statement=$this->connect->prepare($sql);
		//$statement->bindParam(':gasto_id', $idGasto, PDO::PARAM_STR);

		$statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	
	public function getFilteredProveedores($params){
		//print_r($params);
		
		$where = array();
		
		if(isset($params["filtro_nombre_activo"]) && $params["filtro_nombre_activo"] == 1){ 
			$where[]=" proveedor_nombre LIKE '%".$params["filtro_categoria_id"]."%'";
		}
		
		$str_where = "";
		if(!empty($where)){
			$str_where = "WHERE ".implode(" AND ",$where);
		}
		//echo $str_where;
	
		$sql="SELECT 
		proveedor_id,
		proveedor_nombre 
		FROM ".$this->name_table." ".$str_where." ORDER BY proveedor_nombre DESC";
		

		$statement=$this->connect->prepare($sql);
		
		//$statement->bindParam(':gasto_id', $idGasto, PDO::PARAM_STR);

		$statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	
	public function getProveedor($proveedor_id){

		$sql="SELECT 
		proveedor_id,
		proveedor_nombre
		FROM ".$this->name_table." WHERE proveedor_id = :proveedor_id";

		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':proveedor_id', $proveedor_id, PDO::PARAM_STR);

		$statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
}