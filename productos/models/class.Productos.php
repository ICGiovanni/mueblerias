<?php
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/connection/class.Connection.php');

class Productos
{
	private $connect;
	
	function __construct()
	{
		$c=new Connection();
		$this->connect=$c->db;
	}
	
	public function GetColors()
	{
		$sql="SELECT c.id_color,c.color
				FROM colores c
				ORDER BY c.color";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	public function GetMaterials()
	{
		$sql="SELECT m.id_material,m.material
				FROM materiales m
				ORDER BY m.material";
	
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
	
		return $result;
	}
	
	public function GetCategories()
	{
		$sql="SELECT c.id_categoria,c.categoria
				FROM categorias c
				ORDER BY c.categoria";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
	
		return $result;
	}
	
	public function InsertarProducto($params)
	{
		$sql="INSERT INTO productos VALUES('',:nombre,:sku,:descripcion,:precio_utilitario,:precio_publico)";
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':nombre', $params['nombre'], PDO::PARAM_STR);
		$statement->bindParam(':sku', $params['sku'], PDO::PARAM_STR);
		$statement->bindParam(':descripcion', $params['descripcion'], PDO::PARAM_STR);
		$statement->bindParam(':precio_utilitario', $params['precioU'], PDO::PARAM_STR);
		$statement->bindParam(':precio_publico', $params['precioP'], PDO::PARAM_STR);
		
		$statement->execute();
		
		$id_producto=$this->connect->lastInsertId();
		
		foreach($params['color'] as $c)
		{
			$sql="INSERT INTO productos_colores VALUES(:producto,:color)";
			
			$statement=$this->connect->prepare($sql);
			
			$statement->bindParam(':producto', $id_producto, PDO::PARAM_STR);
			$statement->bindParam(':color', $c, PDO::PARAM_STR);
			
			$statement->execute();
		}
		
		foreach($params['material'] as $m)
		{
			$sql="INSERT INTO productos_materiales VALUES(:producto,:material)";
				
			$statement=$this->connect->prepare($sql);
				
			$statement->bindParam(':producto', $id_producto, PDO::PARAM_STR);
			$statement->bindParam(':material', $m, PDO::PARAM_STR);
			
			$statement->execute();
		}
		
		foreach($params['categoria'] as $c)
		{
			$sql="INSERT INTO productos_categorias VALUES(:producto,:categoria)";
				
			$statement=$this->connect->prepare($sql);
				
			$statement->bindParam(':producto', $id_producto, PDO::PARAM_STR);
			$statement->bindParam(':categoria', $c, PDO::PARAM_STR);
			
			$statement->execute();
		}
	}
	
	public function GetNextImageNumber($id_producto)
	{
		$sql="SELECT COUNT(*) AS images
				FROM imagenes_productos
				WHERE id_producto=:producto";
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':producto', $id_producto, PDO::PARAM_STR);
		
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		$next_image=$result[0]['images']+1;
		
		return $next_image;
	}
	
	public function InsertImagesProduct($id_producto,$params)
	{
		$images=count($params['name']);
		
		for($i=0;$i<$images;$i++)
		{
			if($params['name'][$i])
			{
				$n=explode('.',$params['name'][$i]);
				$ext=$n[count($n)-1];
				$next_image=$this->GetNextImageNumber($id_producto);
				$name=$params['name'][$i];
				$name='producto_'.$id_producto.'_'.$next_image.'.'.$ext;
				$rute=$_SERVER["REDIRECT_PATH_CONFIG"].'uploads/productos/'.$name;
				$shortrute=FINAL_URL.'uploads/productos/'.$name;
											
				move_uploaded_file($params['tmp_name'][$i], $rute);
				
				$sql="INSERT INTO imagenes_productos VALUES('',:producto,:name,:rute)";
				
				$statement=$this->connect->prepare($sql);
				
				$statement->bindParam(':producto', $id_producto, PDO::PARAM_STR);
				$statement->bindParam(':name', $name, PDO::PARAM_STR);
				$statement->bindParam(':rute', $shortrute, PDO::PARAM_STR);
					
				$statement->execute();
			}
		}
	}
	
	public function GetDataProduct($id_producto)
	{
		$sql="SELECT p.id_producto,p.nombre,p.sku,
				p.descripcion,p.precio_utilitario,p.precio_publico
				FROM productos p
				WHERE p.id_producto=:producto";
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':producto', $id_producto, PDO::PARAM_STR);
		
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result; 
	}
	
	public function GetProductColor($id_producto)
	{
		$colores=array();
		
		$sql="SELECT c.id_color,c.color
				FROM colores c
				INNER JOIN productos_colores pc USING(id_color)
				WHERE pc.id_producto=:producto
				ORDER BY c.color";
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':producto', $id_producto, PDO::PARAM_STR);
		
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($result as $r)
		{
			$colores[$r['id_color']]=$r['color'];	
		}
		
		return $colores;
	}
	
	public function GetProductMaterial($id_producto)
	{
		$materiales=array();
	
		$sql="SELECT m.id_material,m.material
				FROM materiales m
				INNER JOIN productos_materiales pm USING(id_material)
				WHERE pm.id_producto=:producto
				ORDER BY m.material";
		$statement=$this->connect->prepare($sql);
	
		$statement->bindParam(':producto', $id_producto, PDO::PARAM_STR);
	
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
	
		foreach($result as $r)
		{
			$materiales[$r['id_material']]=$r['material'];
		}
	
		return $materiales;
	}
	
	public function GetProductCategory($id_producto)
	{
		$categorias=array();
	
		$sql="SELECT c.id_categoria,c.categoria
				FROM categorias c
				INNER JOIN productos_categorias pm USING(id_categoria)
				WHERE pm.id_producto=:producto
				ORDER BY c.categoria";
		$statement=$this->connect->prepare($sql);
	
		$statement->bindParam(':producto', $id_producto, PDO::PARAM_STR);
	
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
	
		foreach($result as $r)
		{
			$categorias[$r['id_categoria']]=$r['categoria'];
		}
	
		return $categorias;
	}
	
	public function GetImagesProduct($id_producto)
	{
		$sql="SELECT ip.id_imagen,ip.name,ip.ruta
				FROM imagenes_productos ip
				WHERE ip.id_producto=:producto
				ORDER BY ip.id_imagen ASC";
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':producto', $id_producto, PDO::PARAM_STR);
		
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	public function DeleteImg($id_imagen)
	{
		$sql="DELETE FROM imagenes_productos WHERE id_imagen=:id_imagen";
	
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':id_imagen', $id_imagen, PDO::PARAM_STR);
	
		$statement->execute();
		
		return $id_imagen;
	}
}