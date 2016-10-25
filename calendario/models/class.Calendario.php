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
		evento_recordatorio_enviado,
		login_id
		)
		VALUES
		( 
		:evento_nombre,
		:evento_fecha,
		:evento_desc,
		:evento_recordatorio_activo,
		:evento_recordatorio_fecha,
		0,
		:login_id
		)";
		
		
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
	
	public function editEvento($params){
		$sql = "UPDATE ".$this->name_table_eventos."
		SET
			evento_nombre = :evento_nombre,
			evento_fecha = :evento_fecha,
			evento_desc = :evento_desc,
			evento_recordatorio_activo = :evento_recordatorio_activo,
			evento_recordatorio_fecha = :evento_recordatorio_fecha
		WHERE
			evento_id = :evento_id
		LIMIT 1";
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':evento_nombre', $params['evento_nombre'], PDO::PARAM_STR);
        $statement->bindParam(':evento_fecha', $params['evento_fecha'], PDO::PARAM_STR);
		$statement->bindParam(':evento_desc', $params['evento_desc'], PDO::PARAM_STR);
		$statement->bindParam(':evento_recordatorio_activo', $params['evento_recordatorio_activo'], PDO::PARAM_STR);		
		$statement->bindParam(':evento_recordatorio_fecha', $params['evento_recordatorio_fecha'], PDO::PARAM_STR);
		$statement->bindParam(':evento_id', $params['evento_id'], PDO::PARAM_STR);
		
		$statement->execute();
		return "updated";
	}
	
	public function getEventos($login_id){
		$sql="SELECT 
			evento_id,
			evento_nombre,
			evento_fecha,
			evento_desc,
			evento_recordatorio_activo,
			evento_recordatorio_fecha
		FROM 
			".$this->name_table_eventos."
		WHERE
			login_id = :login_id
		AND
			evento_fecha BETWEEN '".(date("Y")-1)."-".date("m")."-".date("d")."' AND '".(date("Y")+1)."-".date("m")."-".date("d")."'
		";
//echo $sql;
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':login_id', $login_id, PDO::PARAM_STR);

		$statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
		
	}
	
	public function getEvento($evento_id){
		$sql="SELECT 
			evento_id,
			evento_nombre,
			evento_fecha,
			evento_desc,
			evento_recordatorio_activo,
			evento_recordatorio_fecha
		FROM 
			".$this->name_table_eventos."
		WHERE
			evento_id = :evento_id
		";

		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':evento_id', $evento_id, PDO::PARAM_STR);

		$statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
		
	}
	
	public function getRecordatorios(){
		$sql="SELECT 
			evento_id,
			evento_nombre,
			evento_fecha,
			evento_desc,
			evento_recordatorio_activo,
			evento_recordatorio_fecha,
			login_id,
			email
		FROM 
			".$this->name_table_eventos."
		INNER JOIN 
			inv_login USING(login_id)
		WHERE
			evento_recordatorio_activo = 1
		AND
			'".date("Y-m-d H:i:s")."' > evento_recordatorio_fecha
		AND	
			evento_recordatorio_enviado = 0
		";
//echo $sql;
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':login_id', $login_id, PDO::PARAM_STR);

		$statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	
	public function changeOnlyStatus($evento_id, $evento_recordatorio_enviado){
		$sql = "UPDATE 
		".$this->name_table_eventos."
		SET
			evento_recordatorio_enviado = :evento_recordatorio_enviado
		WHERE
			evento_id = :evento_id
		LIMIT 1";
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':evento_id', $evento_id, PDO::PARAM_STR);
		$statement->bindParam(':evento_recordatorio_enviado', $evento_recordatorio_enviado, PDO::PARAM_STR);

		$statement->execute();
		
		return "updated";
	}
	
	public function deleteEvento($evento_id){
		$sql = "DELETE FROM ".$this->name_table_eventos." 
		WHERE evento_id = :evento_id LIMIT 1";
		
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':evento_id', $evento_id, PDO::PARAM_STR);
		
		$statement->execute();
		return "deleted";
	}
}