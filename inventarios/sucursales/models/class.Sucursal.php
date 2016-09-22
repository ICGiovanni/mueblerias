<?php
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/connection/class.Connection.php');

class Sucursal {
	private $connect;
	
	function __construct()
	{
		$c=new Connection();
		$this->connect=$c->db;
		$this->name_table_sucursales = 'inv_sucursales';
	}
	
	function insertSucursal($params){
		$sql = "INSERT INTO ".$this->name_table_sucursales." 
		( 
		sucursal_name,
		sucursal_abrev
		)
		VALUES
		( 
		:sucursal_name,
		:sucursal_abrev
		)";
		
		//print_r($params);
		//die();
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':sucursal_name', $params['sucursal_name'], PDO::PARAM_STR);
        $statement->bindParam(':sucursal_abrev', $params['sucursal_abrev'], PDO::PARAM_STR);
		
		$statement->execute();
		return $this->connect->lastInsertId();
	}
	
	function editSucursal($params){
		$sql = "UPDATE ".$this->name_table_sucursales." 
		SET
		sucursal_name = :sucursal_name,
		sucursal_abrev = :sucursal_abrev
		WHERE
		sucursal_id = :sucursal_id";
		
		//print_r($params);
		//die();
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':sucursal_name', $params['sucursal_name'], PDO::PARAM_STR);
        $statement->bindParam(':sucursal_abrev', $params['sucursal_abrev'], PDO::PARAM_STR);
		$statement->bindParam(':sucursal_id', $params['sucursal_id'], PDO::PARAM_STR);
		
		$statement->execute();
		return "updated";
	}
	
	function deleteSucursal($params){
		$sql = "DELETE FROM ".$this->name_table_sucursales."
		WHERE sucursal_id = :sucursal_id";
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':sucursal_id', $params['sucursal_id'], PDO::PARAM_STR);
		
		$statement->execute();
		return "deleted";
	}
	
	function getSucursales(){
		$sql="SELECT 
		sucursal_id,
		sucursal_name,
		sucursal_abrev
		FROM ".$this->name_table_sucursales." ORDER BY sucursal_id ASC";

		$statement=$this->connect->prepare($sql);
		

		$statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	
}