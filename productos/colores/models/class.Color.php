<?php
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/connection/class.Connection.php');

class Color {
	private $connect;
	
	function __construct()
	{
		$c=new Connection();
		$this->connect=$c->db;
		$this->name_table_colores = 'colores';
	}
	
	function insertColor($params){
		$sql = "INSERT INTO ".$this->name_table_colores." 
		( 
		color_name,
		color_abrev
		)
		VALUES
		( 
		:color_name,
		:color_abrev
		)";
		
		//print_r($params);
		//die();
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':color_name', $params['color_name'], PDO::PARAM_STR);
        $statement->bindParam(':color_abrev', $params['color_abrev'], PDO::PARAM_STR);
		
		$statement->execute();
		return $this->connect->lastInsertId();
	}
	
	function editColor($params){
		$sql = "UPDATE ".$this->name_table_colores." 
		SET
		color_name = :color_name,
		color_abrev = :color_abrev
		WHERE
		color_id = :color_id";
		
		//print_r($params);
		//die();
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':color_name', $params['color_name'], PDO::PARAM_STR);
        $statement->bindParam(':color_abrev', $params['color_abrev'], PDO::PARAM_STR);
		$statement->bindParam(':color_id', $params['color_id'], PDO::PARAM_STR);
		
		$statement->execute();
		return "updated";
	}
	
	function deleteColor($params){
		$sql = "DELETE FROM ".$this->name_table_colores."
		WHERE color_id = :color_id";
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':color_id', $params['color_id'], PDO::PARAM_STR);
		
		$statement->execute();
		return "deleted";
	}
	
	function getColores(){
		$sql="SELECT 
		color_id,
		color_name,
		color_abrev
		FROM ".$this->name_table_colores." ORDER BY color_id ASC";

		$statement=$this->connect->prepare($sql);
		

		$statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	
}