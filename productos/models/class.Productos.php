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
			$n=explode('.',$params['name'][$i]);
			$ext=$n[count($n)-1];
			$next_image=$this->GetNextImageNumber($id_producto);
			$name=$params['name'][$i];
			$name='producto_'.$id_producto.'_'.$next_image.'.'.$ext;
			$rute=$_SERVER["REDIRECT_PATH_CONFIG"].'uploads/productos/'.$name;
			$shortrute=FINAL_URL.'uploads/productos/'.$name;
			echo $shortrute;
						
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