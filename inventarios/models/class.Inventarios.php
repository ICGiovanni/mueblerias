<?php
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/connection/class.Connection.php');

class Inventarios
{
	private $connect;
	
	function __construct()
	{
		$c=new Connection();
		$this->connect=$c->db;
	}
	
	public function GetSucursales()
	{
		$sql="SELECT s.sucursal_id,s.sucursal_name
				FROM inv_sucursales s
				ORDER BY s.sucursal_name";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	public function InsertMoveInventary($params)
	{
		if($params['origen']==0)
		{
			$status='EP';
			$usuario_d='1';
			$usuario_o='';
			$date_s='0000-00-00 00:00:00';
			$date_e=date("Y-m-d h:i:s");
		}
		else
		{
			$status='PE';
			$usuario_d='';
			$usuario_o='1';
			$date_s=date("Y-m-d h:i:s");
			$date_e='0000-00-00 00:00:00';
		}
		
		$sql="INSERT INTO movimientos_inventario VALUES('',:usuario_o,:date_s,:origen,:status,:usuario_d,:date_e,:destino)";

		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':usuario_o', $usuario_o, PDO::PARAM_STR);
		$statement->bindParam(':date_s', $date_s, PDO::PARAM_STR);
		$statement->bindParam('origen', $params['origen'], PDO::PARAM_STR);
		$statement->bindParam('status', $status, PDO::PARAM_STR);
		$statement->bindParam('usuario_d', $usuario_d, PDO::PARAM_STR);
		$statement->bindParam('date_e', $date_e, PDO::PARAM_STR);
		$statement->bindParam('destino', $params['destino'], PDO::PARAM_STR);
		
		$statement->execute();
		
		$move_id=$this->connect->lastInsertId();
		
		return $move_id;
	}
	
	public function InsertProducts($move_id,$productos)
	{
		
	}
	
}
