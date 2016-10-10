<?php
//session_start();
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/connection/class.Connection.php');

class Calendario {
	private $connect;
	
	function __construct()
	{
		$c=new Connection();
		$this->connect=$c->db;
		$this->name_table_eventos = 'eventos';
	}
	
	public function insertEvento($params){
		$sql = "INSERT INTO ".$this->name_table_eventos." 
		( 
		evento_nombre,
		evento_fecha,
		evento_desc,
		evento_recordatorio_activo,
		evento_recordatorio_fecha,
		login_id
		)
		VALUES
		( 
		:evento_nombre,
		:evento_fecha,
		:evento_desc,
		:evento_recordatorio_activo,
		:evento_recordatorio_fecha,
		:login_id
		)";
		
		//print_r($params);
		//die();
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':evento_nombre', $params['evento_nombre'], PDO::PARAM_STR);
        $statement->bindParam(':evento_fecha', $params['evento_fecha'], PDO::PARAM_STR);
		$statement->bindParam(':evento_desc', $params['evento_desc'], PDO::PARAM_STR);
		$statement->bindParam(':evento_recordatorio_activo', $params['evento_recordatorio_activo'], PDO::PARAM_STR);		
		$statement->bindParam(':evento_recordatorio_fecha', $params['evento_recordatorio_fecha'], PDO::PARAM_STR);
		$statement->bindParam(':login_id', $params['login_id'], PDO::PARAM_STR);
		
		$statement->execute();
		return $this->connect->lastInsertId();
	}
}