<?php
//session_start();
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/connection/class.Connection.php');

class Ingreso {
	private $connect;
	
	function __construct()
	{
		$c=new Connection();
		$this->connect=$c->db;
		$this->name_table_ingresos = 'ingresos';
		$this->name_table_prestamos = 'prestamos';
		$this->name_table_ingreso_gasto = 'ingreso_gasto';
	}
	
	function insertIngreso($params){
		$sql = "INSERT INTO ".$this->name_table_ingresos." 
		( 
		ingreso_monto,
		ingreso_fecha,
		ingreso_categoria_id,
		ingreso_descripcion
		)
		VALUES
		( 
		:ingreso_monto,
		:ingreso_fecha,
		:ingreso_categoria_id,
		:ingreso_descripcion
		)";
		
		//print_r($params);
		//die();
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':ingreso_monto', $params['ingreso_monto'], PDO::PARAM_STR);
        $statement->bindParam(':ingreso_fecha', $params['ingreso_fecha'], PDO::PARAM_STR);
		$statement->bindParam(':ingreso_categoria_id', $params['ingreso_categoria_id'], PDO::PARAM_STR);
		$statement->bindParam(':ingreso_descripcion', $params['ingreso_descripcion'], PDO::PARAM_STR);
		
		$statement->execute();
		return $this->connect->lastInsertId();
	}
	
	function editIngreso($params){
		$sql = "UPDATE ".$this->name_table_ingresos." 
		SET
		ingreso_monto = :ingreso_monto,
		ingreso_fecha = :ingreso_fecha
		WHERE
		ingreso_id = :ingreso_id
		";
		
		//print_r($params);
		//die();
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':ingreso_monto', $params['ingreso_monto'], PDO::PARAM_STR);
        $statement->bindParam(':ingreso_fecha', $params['ingreso_fecha'], PDO::PARAM_STR);
		$statement->bindParam(':ingreso_id', $params['ingreso_id'], PDO::PARAM_STR);
		
		$statement->execute();
		return "updated";
	}

///////////////////////////////////////////////////////////////////////////////////////

	function insertPagoPrestamo($params){
		$sql = "INSERT INTO ".$this->name_table_ingreso_gasto." 
		( 
		gasto_id,
		ingreso_id
		)
		VALUES
		( 
		:gasto_id,
		:ingreso_id
		)";
		
		//print_r($params);
		//die();
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':gasto_id', $params['gasto_id'], PDO::PARAM_STR);
        $statement->bindParam(':ingreso_id', $params['ingreso_id'], PDO::PARAM_STR);
		
		$statement->execute();
		return $this->connect->lastInsertId();
	}
	
	function getSumIngresosPrestamos($gasto_id){
		$sql="SELECT		 
		SUM(ingreso_monto) as ingreso_monto
		FROM ".$this->name_table_ingreso_gasto."
		INNER JOIN ".$this->name_table_ingresos." USING (ingreso_id)
		INNER JOIN ".$this->name_table_prestamos." USING (gasto_id)
		WHERE gasto_id = :gasto_id AND prestamo_status_id = 1"; //prestamo activo o pendiente
		
		//echo $sql."---".$gasto_id;die();

		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':gasto_id', $gasto_id, PDO::PARAM_STR);

		$statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	
	public function updatePrestamoStatus($gasto_id, $prestamo_status_id){
		$sql = "UPDATE ".$this->name_table_prestamos." SET 
		prestamo_status_id = :prestamo_status_id
		WHERE gasto_id = :gasto_id";
		
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':gasto_id', $gasto_id, PDO::PARAM_STR);
		$statement->bindParam(':prestamo_status_id', $prestamo_status_id, PDO::PARAM_STR);
		
		$statement->execute();
		return "updated";
	}
	
	public function huboDescuentoPenalizacion($login_id,$primerDia,$ultimoDia,$gasto_id){
		$sql = 'SELECT 
		ingreso_id,
		ingreso_monto
		FROM ingresos
		WHERE 
			ingreso_categoria_id = 2 
		AND 
			ingreso_fecha BETWEEN "'.$primerDia.' 00:00:00" AND "'.$ultimoDia.' 23:59:59"
		AND	
			ingreso_descripcion = "Dia Descuento/Penalización salario folio '.$gasto_id.'"';
			
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':gasto_id', $gasto_id, PDO::PARAM_STR);

		$statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	
	public function huboPagoPrestamo($login_id,$primerDia,$ultimoDia,$gasto_id){
		$sql = 'SELECT 
		ingreso_id,
		ingreso_monto
		FROM ingresos
		INNER JOIN '.$this->name_table_ingreso_gasto.' USING (ingreso_id)
		WHERE 
			ingreso_categoria_id = 1 
		AND 
			ingreso_fecha BETWEEN "'.$primerDia.' 00:00:00" AND "'.$ultimoDia.' 23:59:59"
		AND	
			gasto_id = :gasto_id';
			
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':gasto_id', $gasto_id, PDO::PARAM_STR);

		$statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
}