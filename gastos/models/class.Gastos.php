<?php
//session_start();
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/connection/class.Connection.php');

class Gasto {
	private $connect;
	
	function __construct()
	{
		$c=new Connection();
		$this->connect=$c->db;
	}

	public function insertGasto($params){
		$sql = "INSERT INTO gastos 
		( gasto_no_documento,
		gasto_fecha_vencimiento,
		gasto_fecha_recordatorio,
		gasto_concepto,
		gasto_descripcion,
		gasto_monto,
		gasto_categoria_id,
		gasto_status_id,
		proveedor_id,
		usuario_id )
		VALUES
		( :gasto_no_documento,
		:gasto_fecha_vencimiento,
		:gasto_fecha_recordatorio,
		:gasto_concepto,
		:gasto_descripcion,
		:gasto_monto,
		:gasto_categoria_id,
		:gasto_status_id,
		:proveedor_id,
		:usuario_id )";
		
		//print_r($params);
		//die();
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':gasto_no_documento', $params['gasto_no_documento'], PDO::PARAM_STR);
        $statement->bindParam(':gasto_fecha_vencimiento', $params['gasto_fecha_vencimiento'], PDO::PARAM_STR);
		$statement->bindParam(':gasto_fecha_recordatorio', $params['gasto_fecha_recordatorio'], PDO::PARAM_STR);
		$statement->bindParam(':gasto_concepto', $params['gasto_concepto'], PDO::PARAM_STR);
        $statement->bindParam(':gasto_descripcion', $params['gasto_descripcion'], PDO::PARAM_STR);
		$statement->bindParam(':gasto_monto', $params['gasto_monto'], PDO::PARAM_STR);
		$statement->bindParam(':gasto_categoria_id', $params['gasto_categoria_id'], PDO::PARAM_STR);
		$statement->bindParam(':gasto_status_id', $params['gasto_status_id'], PDO::PARAM_STR);
		$statement->bindParam(':proveedor_id', $params['proveedor_id'], PDO::PARAM_STR);
		$statement->bindParam(':usuario_id', $params['usuario_id'], PDO::PARAM_STR);
		
		
		$statement->execute();
		return $this->connect->lastInsertId();
	}
	
	public function getGastos(){

		$sql="SELECT 
		gasto_id,
		gasto_no_documento,
		gasto_fecha_vencimiento,
		gasto_fecha_recordatorio,
		gasto_concepto,
		gasto_descripcion,
		gasto_monto,
		gasto_categoria_id,
		gasto_status_id,
		proveedor_id,
		usuario_id FROM gastos";

		$statement=$this->connect->prepare($sql);
		//$statement->bindParam(':gasto_id', $idGasto, PDO::PARAM_STR);

		$statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
}