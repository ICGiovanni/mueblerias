<?php
//session_start();
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/connection/class.Connection.php');

class Gasto {
	private $connect;
	
	function __construct()
	{
		$c=new Connection();
		$this->connect=$c->db;
		$this->name_table_gastos = 'gastos';
		$this->name_table_gastos_pagos = 'gastos_pagos';
		$this->name_table_prestamos = 'prestamos';
	}

	public function insertGasto($params){
		$sql = "INSERT INTO ".$this->name_table_gastos." 
		( gasto_no_documento,
		gasto_fecha_vencimiento,
		gasto_fecha_recordatorio_activo,
		gasto_fecha_recordatorio,		
		gasto_concepto,
		gasto_descripcion,
		gasto_monto,
		gasto_categoria_id,
		gasto_status_id,
		proveedor_id,
		login_id,
		sucursal_id,
		gasto_beneficiario )
		VALUES
		( :gasto_no_documento,
		:gasto_fecha_vencimiento,
		:gasto_fecha_recordatorio_activo,
		:gasto_fecha_recordatorio,
		:gasto_concepto,
		:gasto_descripcion,
		:gasto_monto,
		:gasto_categoria_id,
		:gasto_status_id,
		:proveedor_id,
		:login_id,
		:sucursal_id,
		:gasto_beneficiario )";
		
		//print_r($params);
		//die();
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':gasto_no_documento', $params['gasto_no_documento'], PDO::PARAM_STR);
        $statement->bindParam(':gasto_fecha_vencimiento', $params['gasto_fecha_vencimiento'], PDO::PARAM_STR);
		$statement->bindParam(':gasto_fecha_recordatorio_activo', $params['gasto_fecha_recordatorio_activo'], PDO::PARAM_STR);
		$statement->bindParam(':gasto_fecha_recordatorio', $params['gasto_fecha_recordatorio'], PDO::PARAM_STR);
		$statement->bindParam(':gasto_concepto', $params['gasto_concepto'], PDO::PARAM_STR);
        $statement->bindParam(':gasto_descripcion', $params['gasto_descripcion'], PDO::PARAM_STR);
		$statement->bindParam(':gasto_monto', $params['gasto_monto'], PDO::PARAM_STR);
		$statement->bindParam(':gasto_categoria_id', $params['gasto_categoria_id'], PDO::PARAM_STR);
		$statement->bindParam(':gasto_status_id', $params['gasto_status_id'], PDO::PARAM_STR);
		$statement->bindParam(':proveedor_id', $params['proveedor_id'], PDO::PARAM_STR);
		$statement->bindParam(':login_id', $params['login_id'], PDO::PARAM_STR);
		$statement->bindParam(':sucursal_id', $params['sucursal_id'], PDO::PARAM_STR);
		$statement->bindParam(':gasto_beneficiario', $params['gasto_beneficiario'], PDO::PARAM_STR);
		
		
		$statement->execute();
		return $this->connect->lastInsertId();
	}
	
	public function editGasto($params){
		$sql = "UPDATE ".$this->name_table_gastos." SET 
		gasto_no_documento = :gasto_no_documento,
		gasto_fecha_vencimiento = :gasto_fecha_vencimiento,
		gasto_fecha_recordatorio_activo = :gasto_fecha_recordatorio_activo,
		gasto_fecha_recordatorio = :gasto_fecha_recordatorio,
		gasto_categoria_id = :gasto_categoria_id,
		gasto_concepto = :gasto_concepto,
		gasto_descripcion = :gasto_descripcion,
		gasto_monto = :gasto_monto,
		gasto_status_id = :gasto_status_id,
		sucursal_id = :sucursal_id,
		proveedor_id = :proveedor_id,
		login_id = :login_id,
		gasto_beneficiario = :gasto_beneficiario
		WHERE gasto_id = :gasto_id";
		
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':gasto_id', $params['gasto_id'], PDO::PARAM_STR);
		$statement->bindParam(':gasto_no_documento', $params['gasto_no_documento'], PDO::PARAM_STR);
        $statement->bindParam(':gasto_fecha_vencimiento', $params['gasto_fecha_vencimiento'], PDO::PARAM_STR);
		$statement->bindParam(':gasto_fecha_recordatorio_activo', $params['gasto_fecha_recordatorio_activo'], PDO::PARAM_STR);
		$statement->bindParam(':gasto_fecha_recordatorio', $params['gasto_fecha_recordatorio'], PDO::PARAM_STR);
		$statement->bindParam(':gasto_categoria_id', $params['gasto_categoria_id'], PDO::PARAM_STR);
		$statement->bindParam(':gasto_concepto', $params['gasto_concepto'], PDO::PARAM_STR);
        $statement->bindParam(':gasto_descripcion', $params['gasto_descripcion'], PDO::PARAM_STR);
		$statement->bindParam(':gasto_monto', $params['gasto_monto'], PDO::PARAM_STR);		
		$statement->bindParam(':gasto_status_id', $params['gasto_status_id'], PDO::PARAM_STR);
		$statement->bindParam(':proveedor_id', $params['proveedor_id'], PDO::PARAM_STR);
		$statement->bindParam(':login_id', $params['login_id'], PDO::PARAM_STR);
		$statement->bindParam(':sucursal_id', $params['sucursal_id'], PDO::PARAM_STR);
		$statement->bindParam(':gasto_beneficiario', $params['gasto_beneficiario'], PDO::PARAM_STR);
		
		$statement->execute();
		return "updated";
	}
	
	public function deleteGasto($gasto_id){
		//Primero se borran los pagos hechos al gasto
		$sql = "DELETE FROM ".$this->name_table_gastos_pagos." 
		WHERE gasto_id = :gasto_id LIMIT 1";
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':gasto_id', $gasto_id, PDO::PARAM_STR);
		
		$statement->execute();
		
		//Segundo se borra el gasto
		$sql = "DELETE FROM ".$this->name_table_gastos." 
		WHERE gasto_id = :gasto_id LIMIT 1";
		
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':gasto_id', $gasto_id, PDO::PARAM_STR);
		
		$statement->execute();
		return "deleted";
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
		login_id,
		sucursal_id FROM ".$this->name_table_gastos." ORDER BY gasto_id DESC";

		$statement=$this->connect->prepare($sql);
		//$statement->bindParam(':gasto_id', $idGasto, PDO::PARAM_STR);

		$statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	
	public function getFilteredGastos($params){
		//print_r($params);
		
		$where = array();
		if(isset($params["filtro_fecha_inicio"]) && !empty($params["filtro_fecha_inicio"])){ //add fechas
		
			list($filtro_fecha_inicio_dia,$filtro_fecha_inicio_mes,$filtro_fecha_inicio_ano)=explode("/",$params["filtro_fecha_inicio"]);
			list($filtro_fecha_fin_dia,$filtro_fecha_fin_mes,$filtro_fecha_fin_ano)=explode("/",$params["filtro_fecha_fin"]);
			$where[]=" gasto_fecha_vencimiento BETWEEN '".$filtro_fecha_inicio_ano."-".$filtro_fecha_inicio_mes."-".$filtro_fecha_inicio_dia."' AND '".$filtro_fecha_fin_ano."-".$filtro_fecha_fin_mes."-".$filtro_fecha_fin_dia."' ";
	
		}
		if(isset($params["filtro_categoria_id"]) && $params["filtro_categoria_id"] != 0){ //add fechas
			//echo "add categoria";
			$where[]=" gasto_categoria_id = '".$params["filtro_categoria_id"]."'";
		}
		if(isset($params["filtro_status_id"]) && $params["filtro_status_id"] != 0){ //add fechas
			//echo "add status";
			$where[]=" gasto_status_id = '".$params["filtro_status_id"]."'";
		}
		if(isset($params["filtro_sucursal_id"]) && $params["filtro_sucursal_id"] != 0){ //add fechas
			//echo "add status";
			$where[]=" sucursal_id = '".$params["filtro_sucursal_id"]."'";
		}
		
		$str_where = "";
		if(!empty($where)){
			$str_where = "WHERE ".implode(" AND ",$where);
		}
		//echo $str_where;
	
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
		login_id,
		sucursal_id 
		FROM ".$this->name_table_gastos." ".$str_where." ORDER BY gasto_id DESC";
		

		$statement=$this->connect->prepare($sql);
		
		//$statement->bindParam(':gasto_id', $idGasto, PDO::PARAM_STR);

		$statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	
	public function getGasto($gasto_id){

		$sql="SELECT 
		gasto_id,
		gasto_no_documento,
		gasto_fecha_vencimiento,
		gasto_fecha_recordatorio_activo,
		gasto_fecha_recordatorio,
		gasto_concepto,
		gasto_descripcion,
		gasto_monto,
		gasto_categoria_id,
		gasto_status_id,
		proveedor_id,
		login_id,
		sucursal_id,
		gasto_beneficiario
		FROM ".$this->name_table_gastos." WHERE gasto_id = :gasto_id";

		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':gasto_id', $gasto_id, PDO::PARAM_STR);

		$statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	
	public function getGastosCategoria(){
		$sql="SELECT 
		gasto_categoria_id,
		gasto_categoria_desc
		FROM gasto_categoria";

		$statement=$this->connect->prepare($sql);
		//$statement->bindParam(':gasto_id', $idGasto, PDO::PARAM_STR);

		$statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	
	public function getFormasPago(){
		$sql="SELECT 
		gastos_pagos_forma_de_pago_id,
		gastos_pagos_forma_de_pago_desc
		FROM gastos_pagos_forma_de_pago";

		$statement=$this->connect->prepare($sql);
		//$statement->bindParam(':gasto_id', $idGasto, PDO::PARAM_STR);

		$statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	
	public function getGastosStatus(){
		$sql="SELECT 
		gasto_status_id,
		gasto_status_desc
		FROM gasto_status";

		$statement=$this->connect->prepare($sql);
		//$statement->bindParam(':gasto_id', $idGasto, PDO::PARAM_STR);

		$statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	
	public function getGastosSucursal(){
		$sql="SELECT 
		sucursal_id,
		sucursal_name,
		sucursal_abrev
		FROM inv_sucursales";

		$statement=$this->connect->prepare($sql);
		//$statement->bindParam(':gasto_id', $idGasto, PDO::PARAM_STR);

		$statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	
	public function updateGastoStatus($gasto_id, $gasto_status_id){
		$sql = "UPDATE ".$this->name_table_gastos." SET 
		gasto_status_id = :gasto_status_id
		WHERE gasto_id = :gasto_id";
		
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':gasto_id', $gasto_id, PDO::PARAM_STR);
		$statement->bindParam(':gasto_status_id', $gasto_status_id, PDO::PARAM_STR);
		
		$statement->execute();
		return "updated";
	}
	
	/////////////////////////////////////////////////////////////////////
	
	public function insertGastoPago($params){
		$sql = "INSERT INTO ".$this->name_table_gastos_pagos." 
		( 
		gasto_id,
		gastos_pagos_monto,
		gastos_pagos_forma_de_pago_id,
		gastos_pagos_es_fiscal,
		gastos_pagos_monto_sin_iva,
		gastos_pagos_iva,
		gastos_pagos_fecha,
		gastos_pagos_referencia,
		login_id
		)
		VALUES
		( 
		:gasto_id,
		:gastos_pagos_monto,
		:gastos_pagos_forma_de_pago_id,
		:gastos_pagos_es_fiscal,
		:gastos_pagos_monto_sin_iva,		
		:gastos_pagos_iva,
		:gastos_pagos_fecha,
		:gastos_pagos_referencia,
		:login_id
		)";
		
		//print_r($params);
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':gasto_id', $params['gasto_id'], PDO::PARAM_STR);
        $statement->bindParam(':gastos_pagos_monto', $params['gastos_pagos_monto'], PDO::PARAM_STR);
		$statement->bindParam(':gastos_pagos_forma_de_pago_id', $params['gastos_pagos_forma_de_pago_id'], PDO::PARAM_STR);
		$statement->bindParam(':gastos_pagos_es_fiscal', $params['gastos_pagos_es_fiscal'], PDO::PARAM_STR);
		$statement->bindParam(':gastos_pagos_monto_sin_iva', $params['gastos_pagos_monto_sin_iva'], PDO::PARAM_STR);
		$statement->bindParam(':gastos_pagos_iva', $params['gastos_pagos_iva'], PDO::PARAM_STR);
        $statement->bindParam(':gastos_pagos_fecha', $params['gastos_pagos_fecha'], PDO::PARAM_STR);
		$statement->bindParam(':gastos_pagos_referencia', $params['gastos_pagos_referencia'], PDO::PARAM_STR);
		$statement->bindParam(':login_id', $params['login_id'], PDO::PARAM_STR);
		
		$statement->execute();
		
		$this->checkSaldo($params['gasto_id']);
		
		
		return $this->connect->lastInsertId();
	}
	
	public function editGastoPago($params){
		$sql = "UPDATE ".$this->name_table_gastos_pagos." 
		SET		
		gastos_pagos_monto = :gastos_pagos_monto,
		gastos_pagos_forma_de_pago_id = :gastos_pagos_forma_de_pago_id,
		gastos_pagos_es_fiscal = :gastos_pagos_es_fiscal,
		gastos_pagos_monto_sin_iva = :gastos_pagos_monto_sin_iva,
		gastos_pagos_iva = :gastos_pagos_iva,
		gastos_pagos_fecha = :gastos_pagos_fecha,
		gastos_pagos_referencia = :gastos_pagos_referencia
		WHERE
		gastos_pagos_id = :gastos_pagos_id
		";
		
		//print_r($params);
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':gastos_pagos_id', $params['gastos_pagos_id'], PDO::PARAM_STR);
        $statement->bindParam(':gastos_pagos_monto', $params['gastos_pagos_monto'], PDO::PARAM_STR);
		$statement->bindParam(':gastos_pagos_forma_de_pago_id', $params['gastos_pagos_forma_de_pago_id'], PDO::PARAM_STR);
		$statement->bindParam(':gastos_pagos_es_fiscal', $params['gastos_pagos_es_fiscal'], PDO::PARAM_STR);
		$statement->bindParam(':gastos_pagos_monto_sin_iva', $params['gastos_pagos_monto_sin_iva'], PDO::PARAM_STR);
		$statement->bindParam(':gastos_pagos_iva', $params['gastos_pagos_iva'], PDO::PARAM_STR);
        $statement->bindParam(':gastos_pagos_fecha', $params['gastos_pagos_fecha'], PDO::PARAM_STR);
		$statement->bindParam(':gastos_pagos_referencia', $params['gastos_pagos_referencia'], PDO::PARAM_STR);
		
		$statement->execute();
		
		$this->checkSaldo($params['gasto_id']);
		
		
		return "updated";
	}
	
	public function getGastoPago($gastos_pagos_id){
		$sql = "SELECT
		gasto_id,
		gastos_pagos_monto,
		gastos_pagos_forma_de_pago_id,
		gastos_pagos_es_fiscal,
		gastos_pagos_monto_sin_iva,
		gastos_pagos_iva,
		gastos_pagos_fecha,
		gastos_pagos_referencia,
		login_id
		FROM ".$this->name_table_gastos_pagos."
		WHERE gastos_pagos_id = :gastos_pagos_id
		";
		
		$statement=$this->connect->prepare($sql);		
		$statement->bindParam(':gastos_pagos_id', $gastos_pagos_id, PDO::PARAM_STR);        
		
		$statement->execute();
		
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	
	public function checkSaldo($gasto_id, $gastos_pagos_monto){
		$rowPagos = $this->getPagosSum($gasto_id);
		$rowPagos = $rowPagos[0];
		
		$rowTotal = $this->getTotalPagar($gasto_id);
		$rowTotal = $rowTotal[0];
		
		if($rowPagos["gastos_pagos_monto"] >= $rowTotal["gasto_monto"]){
			$this->updateGastoStatus($gasto_id,"2");
		}
	}
	
	public function deleteGastoPago($params){
		$sql = "DELETE FROM ".$this->name_table_gastos_pagos." 
		WHERE gastos_pagos_id = :gastos_pagos_id LIMIT 1";
		
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':gastos_pagos_id', $params["gastos_pagos_id"], PDO::PARAM_STR);
		
		$statement->execute();
		
		$this->updateGastoStatus($params["gasto_id"], "1");
		
		return "deleted";
	}
	
	public function getPagosSum($gasto_id){
		
		$sql="SELECT SUM(gastos_pagos_monto) as gastos_pagos_monto FROM ".$this->name_table_gastos_pagos." WHERE gasto_id = :gasto_id";

		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':gasto_id', $gasto_id, PDO::PARAM_STR);

		$statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	
	public function getTotalPagar($gasto_id){
		$sql="SELECT gasto_monto FROM ".$this->name_table_gastos." WHERE gasto_id = :gasto_id";

		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':gasto_id', $gasto_id, PDO::PARAM_STR);

		$statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	
	public function getPagosDetalle($gasto_id){
		$sql="SELECT 
		gastos_pagos_id, gastos_pagos_monto, gastos_pagos_forma_de_pago_id, gastos_pagos_forma_de_pago_desc, gastos_pagos_es_fiscal, 
		gastos_pagos_monto_sin_iva, gastos_pagos_iva, gastos_pagos_fecha, gastos_pagos_referencia, firstName, lastName
		FROM ".$this->name_table_gastos_pagos." 
		INNER JOIN gastos_pagos_forma_de_pago USING (gastos_pagos_forma_de_pago_id)
		INNER JOIN inv_login USING (login_id)
		WHERE gasto_id = :gasto_id ORDER BY gastos_pagos_id DESC";

		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':gasto_id', $gasto_id, PDO::PARAM_STR);

		$statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	
	public function getFechaUltimoPago($gasto_id){
		$sql="SELECT 
		gastos_pagos_fecha
		FROM ".$this->name_table_gastos_pagos." 
		WHERE gasto_id = :gasto_id ORDER BY gastos_pagos_id DESC LIMIT 1";

		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':gasto_id', $gasto_id, PDO::PARAM_STR);

		$statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
		if(isset($result[0])){
			$result = $result[0];
		} else {
			$result["gastos_pagos_fecha"] = 'N/A';
		}
		
		return $result;
	}
	
	//////////////////////////////////////////////////////// VISTAS ESPECIALES
	
	public function getGastosNomina($primerDia,$ultimoDia,$grupo){
		return $this->getGastosOperativo("13",$primerDia,$ultimoDia,$grupo);
	}
	
	public function getGastosPrestamos(){
		return $this->getGastosOperativo("2");
	}
	
	public function getGastosComisiones(){
		return $this->getGastosOperativo("23");
	}
	
	public function getGastosOperativo($gasto_categoria_id,$primerDia='',$ultimoDia='',$grupo=''){
		$extra_inner = '';
		$extra_where = '';
		if($gasto_categoria_id == 2){ //PRESTAMOS
			$extra_inner = 'INNER JOIN prestamos USING (gasto_id)';
			$extra_where = 'AND prestamo_status_id = 1';
		}
		
		if($gasto_categoria_id == 13){ //SUELDOS
			if($grupo=='DM'){
				$grupo_where = '( profile_id = 1 OR profile_id = 2 OR profile_id = 3 OR profile_id = 4 )';
			} elseif($grupo=='VN'){
				$grupo_where = '( profile_id = 5 OR profile_id = 6 OR profile_id = 7 )';
			} else {
				die("Grupo nomina invalido.");
			}
		
			$extra_where = 'AND '.$grupo_where.' AND gasto_fecha_vencimiento BETWEEN "'.$primerDia.' 00:00:00" AND "'.$ultimoDia.' 23:59:59"';
		}
		
		$sql='SELECT 
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
		login_id,
		inv_login.sucursal_id,
		firstName,
		lastName
		FROM '.$this->name_table_gastos.'
		INNER JOIN inv_login USING (login_id)
		'.$extra_inner.'
		WHERE 
			gasto_categoria_id = :gasto_categoria_id '.$extra_where.'
		ORDER BY gasto_id DESC';
		
		if($gasto_categoria_id == 13){ //PRESTAMOS
			//echo $sql;
		}

		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':gasto_categoria_id', $gasto_categoria_id, PDO::PARAM_STR);

		$statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	
	function huboPagoExtra($login_id,$primerDia,$ultimoDia){
		$sql = 'SELECT 
			gasto_monto
		FROM '.$this->name_table_gastos.'
		WHERE 
			gasto_categoria_id = 25 
		AND 
			login_id = :login_id
		AND	
			gasto_fecha_vencimiento BETWEEN "'.$primerDia.' 00:00:00" AND "'.$ultimoDia.' 23:59:59"';
			
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':login_id', $login_id, PDO::PARAM_STR);

		$statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	
	public function creaNomina($params){
		
		$sql = "SELECT login_id, salary, salary_periodicity, firstName, lastName FROM inv_login WHERE status_id = 1";
		
		$statement = $this->connect->prepare($sql);
		$statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
		
		$sql = "INSERT INTO ".$this->name_table_gastos." 
		( gasto_no_documento,
		gasto_fecha_vencimiento,
		gasto_fecha_recordatorio_activo,
		gasto_fecha_recordatorio,		
		gasto_concepto,
		gasto_descripcion,
		gasto_monto,
		gasto_categoria_id,
		gasto_status_id,
		proveedor_id,
		login_id,
		sucursal_id,
		gasto_beneficiario )
		VALUES
		( :gasto_no_documento,
		:gasto_fecha_vencimiento,
		:gasto_fecha_recordatorio_activo,
		:gasto_fecha_recordatorio,
		:gasto_concepto,
		:gasto_descripcion,
		:gasto_monto,
		:gasto_categoria_id,
		:gasto_status_id,
		:proveedor_id,
		:login_id,
		:sucursal_id,
		:gasto_beneficiario )";
		
		while(list(,$dataResult) = each($result) ){
			
			if( ($params["toca_semanal"] && $dataResult["salary_periodicity"]==1) || ($params["toca_quincenal"] && $dataResult["salary_periodicity"]==2) || ($params["toca_mensual"] && $dataResult["salary_periodicity"]==3) ){
			
				$dataResult["gasto_no_documento"] = 'Nomina semana '.$params["semana"];
				$dataResult["gasto_fecha_recordatorio_activo"] = '0';
				$dataResult["gasto_concepto"] = "Nomina ".$dataResult["firstName"]." ".$dataResult["lastName"].", semana ".$params["semana"];
				$dataResult["gasto_categoria_id"] = "13";
				$dataResult["gasto_status_id"] = "1";
				$dataResult["proveedor_id"] = "0";
				$dataResult["sucursal_id"] = "1";
				$dataResult["gasto_beneficiario"] = $dataResult["firstName"]." ".$dataResult["lastName"];
				
				$statement=$this->connect->prepare($sql);
			
				$statement->bindParam(':gasto_no_documento', $dataResult["gasto_no_documento"], PDO::PARAM_STR);
				$statement->bindParam(':gasto_fecha_vencimiento', date("Y-m-d"), PDO::PARAM_STR);
				$statement->bindParam(':gasto_fecha_recordatorio_activo', $dataResult["gasto_fecha_recordatorio_activo"], PDO::PARAM_STR);
				$statement->bindParam(':gasto_fecha_recordatorio', date("Y-m-d"), PDO::PARAM_STR);
				$statement->bindParam(':gasto_concepto', $dataResult["gasto_concepto"], PDO::PARAM_STR);
				$statement->bindParam(':gasto_descripcion', $dataResult["gasto_concepto"], PDO::PARAM_STR);
				$statement->bindParam(':gasto_monto', $dataResult["salary"], PDO::PARAM_STR);
				$statement->bindParam(':gasto_categoria_id', $dataResult["gasto_categoria_id"], PDO::PARAM_STR);
				$statement->bindParam(':gasto_status_id', $dataResult["gasto_status_id"], PDO::PARAM_STR);
				$statement->bindParam(':proveedor_id', $dataResult["proveedor_id"], PDO::PARAM_STR);
				$statement->bindParam(':login_id', $dataResult["login_id"], PDO::PARAM_STR);
				$statement->bindParam(':sucursal_id', $dataResult["sucursal_id"], PDO::PARAM_STR);
				$statement->bindParam(':gasto_beneficiario', $dataResult["gasto_beneficiario"], PDO::PARAM_STR);
				
				$statement->execute();
			
			}
			
		}
		
		//return $this->connect->lastInsertId();
	}
	///////////////////PRESTAMOS/////////////////////////////////////	
	public function insertPrestamo($gasto_id){
		
		$sql = "INSERT INTO ".$this->name_table_prestamos." 
		( gasto_id, prestamo_status_id )
		VALUES
		( :gasto_id, 1 )";
		
		$statement=$this->connect->prepare($sql);	
		$statement->bindParam(':gasto_id', $gasto_id, PDO::PARAM_STR);
		
		$statement->execute();
		return "inserted";
	}
	
	//////////////////////FUNCION PARA CRONS///////////////////////////////////
	public function marcaVencidos(){
		$sql = 'SELECT 
			gasto_id
		FROM '.$this->name_table_gastos.'
		WHERE 
			gasto_fecha_vencimiento < "'.date("Y-m-d H:m:s").'"
		AND 
			gasto_status_id = 1';
			
		$statement=$this->connect->prepare($sql);

		$statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
		
		
		while( list(,$dataVencidos) = each ($result) ){
			echo "cambia gasto ".$dataVencidos["gasto_id"]." a vencido<br>";
			$this->updateGastoStatus($dataVencidos["gasto_id"], 4);// 4 = vencido
		}
	}
	
}