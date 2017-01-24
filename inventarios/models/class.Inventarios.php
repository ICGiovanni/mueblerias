<?php
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/connection/class.Connection.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'productos/models/class.Productos.php');

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
			$date_s=date("Y-m-d h:i:s");
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
		
		$sql="INSERT INTO movimientos_inventario VALUES('',:usuario_o,:date_s,:origen,:nota_salida,:chofer,:status,:usuario_d,:date_e,:destino,'')";

		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':usuario_o', $usuario_o, PDO::PARAM_STR);
		$statement->bindParam(':date_s', $date_s, PDO::PARAM_STR);
		$statement->bindParam('origen', $params['origen'], PDO::PARAM_STR);
		$statement->bindParam('nota_salida', $params['nota_salida'], PDO::PARAM_STR);
		$statement->bindParam('chofer', $params['chofer'], PDO::PARAM_STR);
		$statement->bindParam('status', $status, PDO::PARAM_STR);
		$statement->bindParam('usuario_d', $usuario_d, PDO::PARAM_STR);
		$statement->bindParam('date_e', $date_e, PDO::PARAM_STR);
		$statement->bindParam('destino', $params['destino'], PDO::PARAM_STR);
		
		$statement->execute();
		
		$move_id=$this->connect->lastInsertId();
		
		return $move_id;
	}
	
	public function InsertProductsMoves($move_id,$data)
	{
		$move=$this->GetMoves($move_id);
		
		foreach($data as $d)
		{
		
			$sql="INSERT INTO movimientos_productos VALUES(:movimiento,:producto,:cantidad)";
		
			$statement=$this->connect->prepare($sql);
		
			$statement->bindParam(':movimiento', $move_id, PDO::PARAM_STR);
			$statement->bindParam(':producto', $d['id'], PDO::PARAM_STR);
			$statement->bindParam(':cantidad', $d['cantidad'], PDO::PARAM_STR);
		
			$statement->execute();
			
			if($move[0]['estatus']=='EP')
			{
				$this->ProductInventory($d['id'],$move[0]['sucursal_id_entrada'],$d['cantidad']);
			}
		}
		
		echo $move_id;
	}
	
	public function GetProductSucursal($producto_id,$sucursal_id)
	{
		$sql="SELECT ip.producto_id,ip.sucursal_id,ip.cantidad
				FROM inventario_productos ip
				WHERE ip.producto_id='$producto_id' AND ip.sucursal_id='$sucursal_id'";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	
	public function InsertProductDB($product_id,$sucursal_id,$cantidad)
	{
		$productos=new Productos();
		
		$r=$productos->GetDataProduct($product_id);
		$conjunto=$r['conjunto'];
		
		if($conjunto)
		{
			$sql="SELECT producto_conjunto_id,cantidad
					FROM productos_conjunto
					WHERE producto_id='$product_id' ";
			
			$statement=$this->connect->prepare($sql);
			$statement->execute();
			$result=$statement->fetchAll(PDO::FETCH_ASSOC);
			
			foreach($result as $r)
			{
				$producto_id=$r['producto_conjunto_id'];
				$cantidad=$cantidad*$r['cantidad'];
				
				
				$result=$this->GetProductSucursal($producto_id, $sucursal_id);
				
				if(isset($result[0]['producto_id']))
				{
					$sql="UPDATE inventario_productos SET cantidad=cantidad+$cantidad WHERE producto_id='$producto_id' AND sucursal_id='$sucursal_id'";
						
					$statement=$this->connect->prepare($sql);
					$statement->execute();
				}
				else
				{
					$sql="INSERT INTO inventario_productos VALUES('',:producto,:sucursal,:cantidad)";
						
					$statement=$this->connect->prepare($sql);
						
					$statement->bindParam(':producto', $producto_id, PDO::PARAM_STR);
					$statement->bindParam(':sucursal', $sucursal_id, PDO::PARAM_STR);
					$statement->bindParam(':cantidad', $cantidad, PDO::PARAM_STR);
						
					$statement->execute();
				}
				
			}
		}
		else 
		{
			$result=$this->GetProductSucursal($producto_id, $sucursal_id);
				
			if(isset($result[0]['producto_id']))
			{
				$sql="UPDATE inventario_productos SET cantidad=cantidad+$cantidad WHERE producto_id='$producto_id' AND sucursal_id='$sucursal_id'";
			
				$statement=$this->connect->prepare($sql);
				$statement->execute();
			}
			else
			{
				$sql="INSERT INTO inventario_productos VALUES('',:producto,:sucursal,:cantidad)";
					
				$statement=$this->connect->prepare($sql);
					
				$statement->bindParam(':producto', $producto_id, PDO::PARAM_STR);
				$statement->bindParam(':sucursal', $sucursal_id, PDO::PARAM_STR);
				$statement->bindParam(':cantidad', $cantidad, PDO::PARAM_STR);
					
				$statement->execute();
			}
		}
		
	}
	
	public function DiscountInventaryDB($product_id,$sucursal_id,$cantidad)
	{
		$productos=new Productos();
		
		$r=$productos->GetDataProduct($product_id);
		$conjunto=$r['conjunto'];
		
		if($conjunto)
		{
			$sql="SELECT producto_conjunto_id,cantidad
			FROM productos_conjunto
			WHERE producto_id='$product_id' ";
				
			$statement=$this->connect->prepare($sql);
			$statement->execute();
			$result=$statement->fetchAll(PDO::FETCH_ASSOC);
				
			foreach($result as $r)
			{
				$producto_id=$r['producto_conjunto_id'];
				$cantidad=$cantidad*$r['cantidad'];
				
				$sql="UPDATE inventario_productos SET cantidad=cantidad-$cantidad WHERE producto_id='$producto_id' AND sucursal_id='$sucursal_id'";
					
				$statement=$this->connect->prepare($sql);
				$statement->execute();
			}
		}
		else
		{
			$sql="UPDATE inventario_productos SET cantidad=cantidad-$cantidad WHERE producto_id='$producto_id' AND sucursal_id='$sucursal_id'";
				
			$statement=$this->connect->prepare($sql);
			$statement->execute();
		}
	}
	
	public function ProductInventory($producto_id,$sucursal_id,$cantidad,$type='E')
	{
		if($type=='E')
		{
			$this->InsertProductDB($product_id, $sucursal_id, $cantidad);
			/*$result=$this->GetProductSucursal($producto_id, $sucursal_id);
			
			if(isset($result[0]['producto_id']))
			{
				$sql="UPDATE inventario_productos SET cantidad=cantidad+$cantidad WHERE producto_id='$producto_id' AND sucursal_id='$sucursal_id'";
				
				$statement=$this->connect->prepare($sql);		
				$statement->execute();
			}
			else
			{
				$sql="INSERT INTO inventario_productos VALUES('',:producto,:sucursal,:cantidad)";
					
				$statement=$this->connect->prepare($sql);
					
				$statement->bindParam(':producto', $producto_id, PDO::PARAM_STR);
				$statement->bindParam(':sucursal', $sucursal_id, PDO::PARAM_STR);
				$statement->bindParam(':cantidad', $cantidad, PDO::PARAM_STR);
					
				$statement->execute();
			}*/
		}
		else if($type=='S')
		{
			
			$this->DiscountInventaryDB($product_id, $sucursal_id, $cantidad);
			/*$sql="UPDATE inventario_productos SET cantidad=cantidad-$cantidad WHERE producto_id='$producto_id' AND sucursal_id='$sucursal_id'";
			
			$statement=$this->connect->prepare($sql);
			$statement->execute();*/
		}
	}
	
	public function GetMoves($move_id='')
	{
		$where="";
		if($move_id)
		{
			$where=" WHERE movimiento_id='$move_id'";
		}
		
		$sql="SELECT mi.movimiento_id,
				IF(mi.usuario_id_salida!=0,
				(SELECT CONCAT(firstName,' ',lastName)
				FROM inv_login
				WHERE login_id=mi.usuario_id_salida),'') AS salida,
				IF(mi.usuario_id_entrega!=0,
				(SELECT CONCAT(firstName,' ',lastName)
				FROM inv_login
				WHERE login_id=mi.usuario_id_entrega),'') AS entrada,
				IF(fecha_salida!='0000-00-00' && mi.estatus!='EP',fecha_salida,'') AS fecha_salida,
				IF(fecha_entrega!='0000-00-00',fecha_entrega,'') AS fecha_entrega,
				CASE estatus
				WHEN 'EP' THEN 'Entrega de Proveedor'
				WHEN 'ET' THEN 'Entregado a Tienda'
				WHEN 'PE' THEN 'Por Entregar a Tienda'
				END AS estatus_etiqueta,
				estatus,
				IF(mi.sucursal_id_salida!=0,
				(SELECT sucursal_name
				FROM inv_sucursales
				WHERE sucursal_id=mi.sucursal_id_salida),'Proveedor') AS sucursal_salida,
				IF(mi.sucursal_id_entrada!=0,
				(SELECT sucursal_name
				FROM inv_sucursales
				WHERE sucursal_id=mi.sucursal_id_entrada),'') AS sucursal_entrada,
				mi.sucursal_id_salida,mi.sucursal_id_entrada,mi.nota_salida,mi.nota_entrega,mi.chofer
				FROM movimientos_inventario mi
				$where
				ORDER BY mi.movimiento_id DESC";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	public function GetProductsbyMove($move_id)
	{
		$sql="SELECT p.producto_id,p.producto_sku,p.producto_name,mp.cantidad
				FROM movimientos_productos mp
				INNER JOIN productos p USING(producto_id)
				WHERE movimiento_id='$move_id'";
	
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
		
	}
	
	public function ReceivingProducts($move_id,$nota)
	{
		
		$usuario_d='1';
		$date_e=date("Y-m-d h:i:s");
		
		$result=$this->GetMoves($move_id);
		$sucursal_salida=$result[0]['sucursal_id_salida'];
		$sucursal_entrada=$result[0]['sucursal_id_entrada'];
				
		$sql="UPDATE movimientos_inventario SET usuario_id_entrega=$usuario_d,fecha_entrega='$date_e',estatus='ET',nota_entrega='$nota' WHERE movimiento_id='$move_id'";
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		
		$productos=$this->GetProductsbyMove($move_id);
		
		foreach($productos as $p)
		{
			$producto_id=$p['producto_id'];
			$cantidad=$p['cantidad'];
			
			$this->ProductInventory($producto_id, $sucursal_entrada, $cantidad,'E');
			
			$this->ProductInventory($producto_id, $sucursal_salida, $cantidad,'S');
		}
		
		return $move_id;
		
	}
	
	public function GetStockbyProduct($product_id)
	{
		$sql="SELECT ip.producto_id,SUM(cantidad) AS stock
				FROM inventario_productos ip
				WHERE producto_id='$product_id'";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		if(isset($result[0]['producto_id']))
		{
			return $result[0]['stock'];
		}
		else
		{
			return 0;	
		}
	}
	
	public function GetStockbySucursal($product_id,$sucursal_id="")
	{
		$where="";
		
		if($sucursal_id)
		{
			$where=" AND sucursal_id='$sucursal_id'";
		}
		
		$sql="SELECT p.producto_id,ivs.sucursal_name,SUM(ip.cantidad) AS stock
				FROM productos p
				INNER JOIN inventario_productos ip USING(producto_id)
				INNER JOIN inv_sucursales ivs USING(sucursal_id)
				WHERE p.producto_id='$product_id'".
				$where;
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
		
}
