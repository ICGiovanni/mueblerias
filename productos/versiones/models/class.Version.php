<?php
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/connection/class.Connection.php');

class Version {
	private $connect;
	
	function __construct()
	{
		$c=new Connection();
		$this->connect=$c->db;
		$this->name_table_versiones = 'versiones';
	}
	
	function insertVersion($params){
		$sql = "INSERT INTO ".$this->name_table_versiones." 
		( 
		version_name,
		version_abrev
		)
		VALUES
		( 
		:version_name,
		:version_abrev
		)";
		
		//print_r($params);
		//die();
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':version_name', $params['version_name'], PDO::PARAM_STR);
        $statement->bindParam(':version_abrev', $params['version_abrev'], PDO::PARAM_STR);
		
		$statement->execute();
		return $this->connect->lastInsertId();
	}
	
	function editVersion($params){
		$sql = "UPDATE ".$this->name_table_versiones." 
		SET
		version_name = :version_name,
		version_abrev = :version_abrev
		WHERE
		version_id = :version_id";
		
		//print_r($params);
		//die();
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':version_name', $params['version_name'], PDO::PARAM_STR);
        $statement->bindParam(':version_abrev', $params['version_abrev'], PDO::PARAM_STR);
		$statement->bindParam(':version_id', $params['version_id'], PDO::PARAM_STR);
		
		$statement->execute();
		return "updated";
	}
	
	function deleteVersion($params){
		$sql = "DELETE FROM ".$this->name_table_versiones."
		WHERE version_id = :version_id";
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':version_id', $params['version_id'], PDO::PARAM_STR);
		
		$statement->execute();
		return "deleted";
	}
	
	function getVersiones(){
		$sql="SELECT 
		version_id,
		version_name,
		version_abrev
		FROM ".$this->name_table_versiones." ORDER BY version_id ASC";

		$statement=$this->connect->prepare($sql);
		

		$statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	
}