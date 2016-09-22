<?php
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/connection/class.Connection.php');

class Categoria {
	private $connect;
	
	function __construct()
	{
		$c=new Connection();
		$this->connect=$c->db;
		$this->name_table_categorias = 'categorias';
	}
	
	function insertCategoria($params){
		$sql = "INSERT INTO ".$this->name_table_categorias." 
		( 
		categoria_name,
		categoria_abrev
		)
		VALUES
		( 
		:categoria_name,
		:categoria_abrev
		)";
		
		//print_r($params);
		//die();
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':categoria_name', $params['categoria_name'], PDO::PARAM_STR);
        $statement->bindParam(':categoria_abrev', $params['categoria_abrev'], PDO::PARAM_STR);
		
		$statement->execute();
		return $this->connect->lastInsertId();
	}
	
	function editCategoria($params){
		$sql = "UPDATE ".$this->name_table_categorias." 
		SET
		categoria_name = :categoria_name,
		categoria_abrev = :categoria_abrev
		WHERE
		categoria_id = :categoria_id";
		
		//print_r($params);
		//die();
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':categoria_name', $params['categoria_name'], PDO::PARAM_STR);
        $statement->bindParam(':categoria_abrev', $params['categoria_abrev'], PDO::PARAM_STR);
		$statement->bindParam(':categoria_id', $params['categoria_id'], PDO::PARAM_STR);
		
		$statement->execute();
		return "updated";
	}
	
	function deleteCategoria($params){
		$sql = "DELETE FROM ".$this->name_table_categorias."
		WHERE categoria_id = :categoria_id";
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':categoria_id', $params['categoria_id'], PDO::PARAM_STR);
		
		$statement->execute();
		return "deleted";
	}
	
	function getCategorias(){
		$sql="SELECT 
		categoria_id,
		categoria_name,
		categoria_abrev
		FROM ".$this->name_table_categorias." ORDER BY categoria_id ASC";

		$statement=$this->connect->prepare($sql);
		

		$statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	
}