<?php
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/connection/class.Connection.php');

class Caja
{
	private $connect;
	private $login_session;
	
	function __construct()
	{
		$c=new Connection();
		$this->connect=$c->db;
		
		if(isset($_SESSION['login_session']))
		{
			$this->login_session = $_SESSION['login_session'];
		}
		else
		{
			$this->login_session['login_id']=1;
		}
	}
	
	public function CashRegisterPartial()
	{
		$user_id=$this->login_session['login_id'];
		$date=date("Y-m-d h:i:s");
				
		$sales=$this->getSales();
		
		if(count($sales))
		{
			$sql="INSERT INTO corte_caja_parcial VALUES('',:user_id,:date)";
			
			$statement=$this->connect->prepare($sql);
			
			$statement->bindParam(':user_id', $user_id, PDO::PARAM_STR);
			$statement->bindParam(':date', $date, PDO::PARAM_STR);
						
			$statement->execute();
			$caja_parcial_id=$this->connect->lastInsertId();
			
			foreach($sales as $s)
			{
				$venta_id=$s['venta_id'];
				
				$payments=$this->getPaymentsbySale($venta_id);
				
				foreach($payments as $p)
				{
					$ventas_pago_id=$p['ventas_pagos_id'];
					
					$sql="INSERT INTO corte_parcial_ventas VALUES(:corte_parcial_id,:ventas_pago_id)";
					
					$statement=$this->connect->prepare($sql);
					
					$statement->bindParam(':corte_parcial_id', $caja_parcial_id, PDO::PARAM_STR);
					$statement->bindParam(':ventas_pago_id', $ventas_pago_id, PDO::PARAM_STR);
					
					$statement->execute();
				}
			}
		}
		else
		{
			return false;	
		}
	}
	
	public function getSales()
	{
		$sql="SELECT DISTINCT(v.venta_id)
				FROM ventas v
				INNER JOIN ventas_estatus vs ON v.venta_estatus_id=vs.ventas_estatus_id
				INNER JOIN ventas_pagos vp ON vp.venta_id=v.venta_id
				INNER JOIN general_formas_de_pago gfp ON gfp.general_forma_de_pago_id=vp.general_forma_de_pago_id
				WHERE ventas_pagos_id NOT IN(
				SELECT ventas_pago_id
				FROM corte_parcial_ventas)
				AND ventas_estatus_id IN(2)";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	public function getPaymentsbySale($venta_id)
	{
		$sql="SELECT v.venta_id,ventas_pagos_id
				FROM ventas v
				INNER JOIN ventas_estatus vs ON v.venta_estatus_id=vs.ventas_estatus_id
				INNER JOIN ventas_pagos vp ON vp.venta_id=v.venta_id
				INNER JOIN general_formas_de_pago gfp ON gfp.general_forma_de_pago_id=vp.general_forma_de_pago_id
				WHERE ventas_pagos_id NOT IN(
				SELECT ventas_pago_id
				FROM corte_parcial_ventas)
				AND v.venta_id IN($venta_id)
				AND ventas_estatus_id IN(2)";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	public function getCashRegister($corte_parcial_id)
	{
		$sql="SELECT DISTINCT(v.venta_id)
				FROM corte_caja_parcial cp
				INNER JOIN corte_parcial_ventas cv USING(corte_parcial_id)
				INNER JOIN ventas_pagos vp ON vp.ventas_pagos_id=cv.ventas_pago_id
				INNER JOIN ventas v ON v.venta_id=vp.venta_id
				INNER JOIN ventas_estatus vs ON v.venta_estatus_id=vs.ventas_estatus_id
				INNER JOIN general_formas_de_pago gfp ON gfp.general_forma_de_pago_id=vp.general_forma_de_pago_id
				WHERE ventas_estatus_id IN(2)
				AND cv.corte_parcial_id IN($corte_parcial_id)";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	public function getCashRegisterData($corte_parcial_id="")
	{
		$where="";
		if($corte_parcial_id)
		{
			$where=	"WHERE corte_parcial_id='$corte_parcial_id'";
		}
		
		$sql="SELECT corte_parcial_id,date,firstName,lastName
				FROM corte_caja_parcial cp
				INNER JOIN inv_login l ON l.login_id=cp.usuario_id
				$where
				ORDER BY date";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	public function getPaymentsData($corte_parcial_id,$venta_id)
	{
		$sql="SELECT cp.corte_parcial_id,vp.monto,general_forma_de_pago_desc
				FROM corte_caja_parcial cp
				INNER JOIN corte_parcial_ventas cv USING(corte_parcial_id)
				INNER JOIN ventas_pagos vp ON vp.ventas_pagos_id=cv.ventas_pago_id
				INNER JOIN ventas v ON v.venta_id=vp.venta_id
				INNER JOIN ventas_estatus vs ON v.venta_estatus_id=vs.ventas_estatus_id
				INNER JOIN general_formas_de_pago gfp ON gfp.general_forma_de_pago_id=vp.general_forma_de_pago_id
				WHERE ventas_estatus_id IN(2)
				AND cp.corte_parcial_id=$corte_parcial_id
				AND v.venta_id=$venta_id";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	
}