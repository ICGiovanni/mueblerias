<?php
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/connection/class.Connection.php');

class Caja
{
	private $connect;
	private $login_session;
	private $sucursal_id;
	
	function __construct()
	{
		$c=new Connection();
		$this->connect=$c->db;
		
		if(isset($_SESSION['login_session']))
		{
			$this->login_session = $_SESSION['login_session'];
			$this->sucursal_id=$_SESSION['login_session']['sucursal_id'];
		}
		else
		{
			$this->login_session['login_id']=1;
			$this->sucursal_id=1;
		}
	}
	
	public function CashRegisterMountInit($mount)
	{
		$user_id=$this->login_session['login_id'];
		$date=date("Y-m-d h:i:s");
		$sucursal_id=$this->sucursal_id;
		
		$sql="INSERT INTO montos_iniciales VALUES('',:monto_inicial,:user_id,:sucursal_id,:date)";
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':monto_inicial', $mount, PDO::PARAM_STR);
		$statement->bindParam(':user_id', $user_id, PDO::PARAM_STR);
		$statement->bindParam(':sucursal_id', $sucursal_id, PDO::PARAM_STR);
		$statement->bindParam(':date', $date, PDO::PARAM_STR);
		
		$statement->execute();
		$this->connect->lastInsertId();
		
		return true;
	}
	
	public function CashRegisterPartial()
	{
		$user_id=$this->login_session['login_id'];
		$date=date("Y-m-d h:i:s");
		$sucursal_id=$this->sucursal_id;
				
		$sales=$this->getSales();
		
		if(count($sales))
		{
			$sql="INSERT INTO corte_caja_parcial VALUES('',:user_id,:sucursal_id,:date)";
			
			$statement=$this->connect->prepare($sql);
			
			$statement->bindParam(':user_id', $user_id, PDO::PARAM_STR);
			$statement->bindParam(':sucursal_id', $sucursal_id, PDO::PARAM_STR);
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
			
			$mounts=$this->getMountsInit();
			
			foreach($mounts as $mount)
			{
				$mount_id=$mount['monto_inicial_id'];
				
				$sql="INSERT INTO montos_corte_caja VALUES(:montos_corte_caja,:corte_parcial_id)";
				
				$statement=$this->connect->prepare($sql);
				
				$statement->bindParam(':corte_parcial_id', $caja_parcial_id, PDO::PARAM_STR);
				$statement->bindParam(':montos_corte_caja', $mount_id, PDO::PARAM_STR);
				
				$statement->execute();				
			}
		}
		else
		{
			return false;	
		}
	}
	
	public function CashRegisterFinal()
	{
		$user_id=$this->login_session['login_id'];
		$date=date("Y-m-d h:i:s");
		$sucursal_id=$this->sucursal_id;
		
		$corte_parcial=$this->getBoxCut();
		
		if(count($corte_parcial))
		{
			$sql="INSERT INTO corte_caja_final VALUES('',:user_id,:sucursal_id,:date)";
			
			$statement=$this->connect->prepare($sql);
			
			$statement->bindParam(':user_id', $user_id, PDO::PARAM_STR);
			$statement->bindParam(':sucursal_id', $sucursal_id, PDO::PARAM_STR);
			$statement->bindParam(':date', $date, PDO::PARAM_STR);
			
			$statement->execute();
			$caja_final_id=$this->connect->lastInsertId();
			
			foreach($corte_parcial as $cp)
			{
				$corte_parcial_id=$cp['corte_parcial_id'];
				
				$sql="INSERT INTO corte_caja_final_parcial VALUES(:caja_final_id,:corte_parcial_id)";
				
				$statement=$this->connect->prepare($sql);
				
				$statement->bindParam(':corte_parcial_id', $corte_parcial_id, PDO::PARAM_STR);
				$statement->bindParam(':caja_final_id', $caja_final_id, PDO::PARAM_STR);
				
				$statement->execute();				
			}
		}
		else
		{
			return false;
		}
		
	}
	
	public function getBoxCut()
	{
		$sql="SELECT DISTINCT(corte_parcial_id)
				FROM corte_caja_parcial cp
				WHERE corte_parcial_id NOT IN (
				SELECT corte_parcial_id
				FROM corte_caja_final_parcial)";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	public function getMountsInit()
	{
		$sql="SELECT monto_inicial_id
				FROM montos_iniciales mi
				WHERE monto_inicial_id NOT IN(SELECT monto_inicial_id
				FROM montos_corte_caja mc)
				AND mi.sucursal_id='".$this->sucursal_id."'";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
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
	
	public function getDataSale($venta_id)
	{
		$sql="SELECT v.venta_id,v.monto,v.costo_envio,
				CONCAT(c.nombre,' ',c.apellidoP) AS cliente,
				fecha_creacion,detalle_envio
				FROM ventas v
				INNER JOIN clientes c USING(id_cliente)
				WHERE v.venta_id='$venta_id'";

		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result[0];
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
	
	public function getBoxCutPartial($corte_final_id)
	{
		$sql="SELECT corte_parcial_id,date,firstName,lastName
				FROM corte_caja_parcial cp
				INNER JOIN inv_login l ON l.login_id=cp.usuario_id
				INNER JOIN corte_caja_final_parcial ccf USING(corte_parcial_id)
				WHERE ccf.corte_final_id='$corte_final_id'";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	
	
	public function getCashRegisterData($corte_parcial_id="")
	{
		$sucursal_id=$this->sucursal_id;
		$where="WHERE cp.sucursal_id='$sucursal_id'";
		if($corte_parcial_id)
		{
			$where=	"AND corte_parcial_id='$corte_parcial_id'";
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
	
	public function getCashRegisterDataFinal($corte_final_id="")
	{
		$sucursal_id=$this->sucursal_id;
		$where="WHERE cf.sucursal_id='$sucursal_id'";
		if($corte_final_id)
		{
			$where.=" AND corte_final_id='$corte_final_id'";
		}
		
		$sql="SELECT corte_final_id,date,firstName,lastName,
		s.sucursal_id,sucursal_name
		FROM corte_caja_final cf
		INNER JOIN inv_sucursales s USING(sucursal_id)
		INNER JOIN inv_login l ON l.login_id=cf.usuario_id
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
	
	public function getMountsInitBoxCut($corte_parcial_id)
	{
		$sql="SELECT monto_inicial_id,monto_inicial
				FROM montos_iniciales mi
				INNER JOIN montos_corte_caja mc USING(monto_inicial_id)
				WHERE mc.corte_parcial_id=$corte_parcial_id";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	public function DeleteBoxCutPartial($corte_parcial_id)
	{
		$sql="DELETE FROM corte_caja_final_parcial WHERE corte_parcial_id=:corte_parcial_id";
		
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':corte_parcial_id', $corte_parcial_id, PDO::PARAM_STR);
		
		$statement->execute();
		
		$sql="DELETE FROM corte_parcial_ventas WHERE corte_parcial_id=:corte_parcial_id";
		
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':corte_parcial_id', $corte_parcial_id, PDO::PARAM_STR);
		
		$statement->execute();
		
		$sql="DELETE FROM corte_caja_parcial WHERE corte_parcial_id=:corte_parcial_id";
		
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':corte_parcial_id', $corte_parcial_id, PDO::PARAM_STR);
		
		$statement->execute();
	}
	
	public function DeleteBoxCutFinal($corte_final_id)
	{
		$sql="DELETE FROM corte_caja_final_parcial WHERE corte_final_id=:corte_final_id";
		
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':corte_final_id', $corte_final_id, PDO::PARAM_STR);
		
		$statement->execute();
		
		
		$sql="DELETE FROM corte_caja_final WHERE corte_final_id=:corte_final_id";
		
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':corte_final_id', $corte_final_id, PDO::PARAM_STR);
		
		$statement->execute();
	}
}