<?php
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/connection/class.Connection.php');

class Material {
	private $connect;
	
	function __construct()
	{
		$c=new Connection();
		$this->connect=$c->db;
		$this->name_table_materiales = 'materiales';
	}
	
	function insertMaterial($params){
		$sql = "INSERT INTO ".$this->name_table_materiales." 
		( 
		material_name,
		material_abrev
		)
		VALUES
		( 
		:material_name,
		:material_abrev
		)";
		
		//print_r($params);
		//die();
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':material_name', $params['material_name'], PDO::PARAM_STR);
        $statement->bindParam(':material_abrev', $params['material_abrev'], PDO::PARAM_STR);
		
		$statement->execute();
		return $this->connect->lastInsertId();
	}
	
	function editMaterial($params){
		$sql = "UPDATE ".$this->name_table_materiales." 
		SET
		material_name = :material_name,
		material_abrev = :material_abrev
		WHERE
		material_id = :material_id";
		
		//print_r($params);
		//die();
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':material_name', $params['material_name'], PDO::PARAM_STR);
        $statement->bindParam(':material_abrev', $params['material_abrev'], PDO::PARAM_STR);
		$statement->bindParam(':material_id', $params['material_id'], PDO::PARAM_STR);
		
		$statement->execute();
		return "updated";
	}
	
	function deleteMaterial($params){
		$sql = "DELETE FROM ".$this->name_table_materiales."
		WHERE material_id = :material_id";
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':material_id', $params['material_id'], PDO::PARAM_STR);
		
		$statement->execute();
		return "deleted";
	}
	
	function getMateriales(){
		$sql="SELECT 
		material_id,
		material_name,
		material_abrev
		FROM ".$this->name_table_materiales." ORDER BY material_id ASC";

		$statement=$this->connect->prepare($sql);
		

		$statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	
}