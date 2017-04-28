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
	
	
	public function InsertProductDB($producto_id,$sucursal_id,$cantidad)
	{
		$productos=new Productos();
		
		$r=$productos->GetDataProduct($producto_id);
		$conjunto=$r[0]['conjunto'];
		
		if($conjunto)
		{
			$sql="SELECT producto_conjunto_id,cantidad
					FROM productos_conjunto
					WHERE producto_id='$producto_id' ";
			
			$statement=$this->connect->prepare($sql);
			$statement->execute();
			$result=$statement->fetchAll(PDO::FETCH_ASSOC);
			
			foreach($result as $r)
			{
				$producto_id=$r['producto_conjunto_id'];
				$cantidadR=$cantidad*$r['cantidad'];				
				
				$result=$this->GetProductSucursal($producto_id, $sucursal_id);
				
				if(isset($result[0]['producto_id']))
				{
					$sql="UPDATE inventario_productos SET cantidad=cantidad+$cantidadR WHERE producto_id='$producto_id' AND sucursal_id='$sucursal_id'";
						
					$statement=$this->connect->prepare($sql);
					$statement->execute();
				}
				else
				{
					$sql="INSERT INTO inventario_productos VALUES('',:producto,:sucursal,:cantidad)";
						
					$statement=$this->connect->prepare($sql);
						
					$statement->bindParam(':producto', $producto_id, PDO::PARAM_STR);
					$statement->bindParam(':sucursal', $sucursal_id, PDO::PARAM_STR);
					$statement->bindParam(':cantidad', $cantidadR, PDO::PARAM_STR);
						
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
	
	public function DiscountInventaryDB($producto_id,$sucursal_id,$cantidad)
	{
		$productos=new Productos();
		
		$r=$productos->GetDataProduct($producto_id);
		$conjunto=$r[0]['conjunto'];
		
		if($conjunto)
		{
			$sql="SELECT producto_conjunto_id,cantidad
			FROM productos_conjunto
			WHERE producto_id='$producto_id' ";
				
			$statement=$this->connect->prepare($sql);
			$statement->execute();
			$result=$statement->fetchAll(PDO::FETCH_ASSOC);
				
			foreach($result as $r)
			{
				$producto_id=$r['producto_conjunto_id'];
				$cantidadR=$cantidad*$r['cantidad'];
				
				$sql="UPDATE inventario_productos SET cantidad=cantidad-$cantidadR WHERE producto_id='$producto_id' AND sucursal_id='$sucursal_id'";
					
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
			$this->InsertProductDB($producto_id, $sucursal_id, $cantidad);
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
			
			$this->DiscountInventaryDB($producto_id, $sucursal_id, $cantidad);
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
	
	public function CheckStock($data,$sucursal_id)
	{
		$productos=new Productos();
		
		$producto=array();
		
		foreach($data as $d)
		{
			$producto_id=$d['id'];
			$cantidad=$d['cantidad'];
			
			$r=$productos->GetDataProduct($producto_id);
			$conjunto=$r[0]['conjunto'];
			
			if($conjunto)
			{
				$sql="SELECT producto_conjunto_id,cantidad
				FROM productos_conjunto
				WHERE producto_id='$producto_id' ";
				
				$statement=$this->connect->prepare($sql);
				$statement->execute();
				$result=$statement->fetchAll(PDO::FETCH_ASSOC);
				$array_stock=array();
					
				foreach($result as $r)
				{
					$producto_id=$r['producto_conjunto_id'];
					$cantidad_n=$r['cantidad'];
					
					$cantidadR=$cantidad_n*$cantidad;
					
					if(array_key_exists($producto_id,$producto))
					{
						$producto[$producto_id]=$producto[$producto_id]+$cantidadR;
					}
					else
					{
						$producto[$producto_id]=$cantidadR;
					}
				}
			}
			else
			{
				if(array_key_exists($producto_id,$producto))
				{
					$producto[$producto_id]=$producto[$producto_id]+$cantidad;
				}
				else
				{
					$producto[$producto_id]=$cantidad;
				}
			}			
		}
		
		
		foreach($producto as $producto_id=>$p)
		{
			$cantidad=$p;
			$stock=$this->GetStockbySucursal($producto_id,$sucursal_id);
				
			if($stock<$cantidad)
			{
				$r=$productos->GetDataProduct($producto_id);
			
				return array("producto_id"=>$producto_id,"producto_name"=>$r[0]['producto_name'],"producto_sku"=>$r[0]['producto_sku'],"stock"=>$stock,"solicitado"=>$cantidad);
			}
		}
		
		/*foreach($data as $d)
		{
			$producto_id=$d['id'];
			$cantidad=$d['cantidad'];
			
			$stock=$this->GetStockbySucursal($producto_id,$sucursal_id);
			
			if($stock<$cantidad)
			{
				$r=$productos->GetDataProduct($producto_id);
				
				return array("producto_id"=>$producto_id,"producto_name"=>$r[0]['producto_name'],"producto_sku"=>$r[0]['producto_sku'],"stock"=>$stock);
			}
		}*/
		
		return false;
	}
		
	public function GetStockbySucursal($product_id,$sucursal_id="")
	{
		$productos=new Productos();
		
		$r=$productos->GetDataProduct($product_id);
		$conjunto=$r[0]['conjunto'];
		
		if($conjunto)
		{
			$sql="SELECT producto_conjunto_id,cantidad
			FROM productos_conjunto
			WHERE producto_id='$product_id' ";
				
			$statement=$this->connect->prepare($sql);
			$statement->execute();
			$result=$statement->fetchAll(PDO::FETCH_ASSOC);
			$array_stock=array();
			
			foreach($result as $r)
			{
				$producto_id=$r['producto_conjunto_id'];
				$cantidad=$r['cantidad'];
				
				$where="";
				if($sucursal_id)
				{
					$where=" AND sucursal_id='$sucursal_id'";
				}
				
				$sql="SELECT p.producto_id,ivs.sucursal_name,SUM(ip.cantidad) AS stock
				FROM productos p
				INNER JOIN inventario_productos ip USING(producto_id)
				INNER JOIN inv_sucursales ivs USING(sucursal_id)
				WHERE p.producto_id='$producto_id'".
				$where;
				
				$statement=$this->connect->prepare($sql);
				$statement->execute();
				$result=$statement->fetchAll(PDO::FETCH_ASSOC);
				
				$cantidad_inv=$result[0]['stock'];
				
				$cantidad=$cantidad_inv/$cantidad;
				
				$c=explode('.',$cantidad);
				$cantidad=$c[0];
				
				if(!in_array($cantidad,$array_stock))
				{
					array_push($array_stock,$cantidad);
				}
			}
			
			$cantidad=min($array_stock);
			
			return $cantidad;
		}
		else
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
			
			return $result[0]['stock'];
		}				
	}
	
	public function GetStockVariation($producto_id)
	{
		$sql="SELECT p.producto_id
		FROM productos p
		WHERE producto_parent='$producto_id'";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result_variation=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		$stock="";
		foreach($result_variation as $v)
		{
			$stock=$stock+($this->GetStockbySucursal($v['producto_id']));
		}
		
		return $stock;
	}
	
	public function GetStockSucursalbyProduct($producto_id)
	{
		$result=array();
		
		$sql="SELECT s.sucursal_id,s.sucursal_name,s.sucursal_abrev
					FROM inv_sucursales s";
			
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$sucursales=$statement->fetchAll(PDO::FETCH_ASSOC);
			
		$i=0;
		foreach($sucursales as $s)
		{
			$stock=$this->GetStockbySucursal($producto_id,$s['sucursal_id']);
			
			if($stock)
			{
				$result[$i]['sucursal_id']=$s['sucursal_id'];
				$result[$i]['sucursal_name']=$s['sucursal_name'];
				$result[$i]['sucursal_abrev']=$s['sucursal_abrev'];
				$result[$i]['stock']=$stock;
					
				$i++;
			}
		}
		
		return $result;
	}
	
	
	public function GetDataMoves($move_id)
	{
		$sql="SELECT IF(usuario_id_salida!=0,
				(SELECT CONCAT(firstName,' ',lastName,' ',secondLastName)
				FROM inv_login
				WHERE login_id=usuario_id_salida),'') AS usuario_salida,
				ss.sucursal_name AS sucursal_salida,
				fecha_salida,
				nota_salida,
				IF(usuario_id_entrega!=0,
				(SELECT CONCAT(firstName,' ',lastName,' ',secondLastName)
				FROM inv_login
				WHERE login_id=usuario_id_entrega),'') AS usuario_entrega,
				se.sucursal_name AS sucursal_entrega,
				nota_entrega,chofer,fecha_entrega
				FROM movimientos_inventario mi
				LEFT JOIN inv_sucursales ss ON ss.sucursal_id=mi.sucursal_id_salida
				LEFT JOIN inv_sucursales se ON se.sucursal_id=mi.sucursal_id_entrada
				WHERE movimiento_id=$move_id";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result[0];		
	}
	
	public function GetProductsMove($move_id)
	{
		$sql="SELECT producto_id,CONCAT(producto_sku,' ',producto_name,' ',color_name,' ',material_name) AS producto,
				cantidad
				FROM movimientos_productos mp
				INNER JOIN productos p USING(producto_id)
				INNER JOIN colores c USING(color_id)
				INNER JOIN materiales m USING(material_id)
				WHERE mp.movimiento_id=$move_id";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
}
