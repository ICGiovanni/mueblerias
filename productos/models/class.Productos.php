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
		$sql="SELECT c.color_id,c.color_name
				FROM colores c
				ORDER BY c.color_name";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	public function GetMaterials()
	{
		$sql="SELECT m.material_id,m.material_name
				FROM materiales m
				ORDER BY m.material_name";
	
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
	
		return $result;
	}
	
	public function GetCategories()
	{
		$sql="SELECT c.categoria_id,c.categoria_name
				FROM categorias c
				ORDER BY c.categoria_name";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
	
		return $result;
	}
	
	public function InsertarProducto($params)
	{
		$sql="INSERT INTO productos VALUES('',:nombre,:sku,:descripcion,:precio_utilitario,:precio_publico,:proveedor)";
		
		$statement=$this->connect->prepare($sql);
		$price_utilitarian=number_format($params['precioU'], 2, '.', '');
		$price_public=number_format($params['precioP'], 2, '.', '');
		
		$statement->bindParam(':nombre', $params['nombre'], PDO::PARAM_STR);
		$statement->bindParam(':sku', $params['sku'], PDO::PARAM_STR);
		$statement->bindParam(':descripcion', $params['descripcion'], PDO::PARAM_STR);
		$statement->bindParam(':precio_utilitario', $price_utilitarian, PDO::PARAM_STR);
		$statement->bindParam(':precio_publico', $price_public, PDO::PARAM_STR);
		$statement->bindParam(':proveedor', $params['proveedor'], PDO::PARAM_STR);
		
		$statement->execute();
		
		$producto_id=$this->connect->lastInsertId();
		
		$this->InsertColorsProduct($producto_id, $params['color']);
		
		$this->InsertMaterialsProduct($producto_id, $params['material']);
		
		$this->InsertCategoriesProduct($producto_id, $params['categoria']);
		
		return $producto_id;
	}
	
	public function GetNextImageNumber($producto_id)
	{
		$sql="SELECT MAX(imagen_id) AS images
				FROM imagenes_productos
				WHERE producto_id=:producto";
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':producto', $producto_id, PDO::PARAM_STR);
		
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		$next_image=$result[0]['images']+1;
		
		return $next_image;
	}
	
	public function InsertImagesProduct($producto_id,$params)
	{
		$images=count($params['name']);

		if (!file_exists(DIR_UPLOAD."productos/"))
		{
			mkdir(DIR_UPLOAD."productos/", 0777, true);
		}
		
		for($i=0;$i<$images;$i++)
		{
			if($params['name'][$i])
			{
				$n=explode('.',$params['name'][$i]);
				$ext=$n[count($n)-1];
				$next_image=$this->GetNextImageNumber($producto_id);
				$name=$params['name'][$i];
				$name='producto_'.$producto_id.'_'.$next_image.'.'.$ext;
				$rute=DIR_UPLOAD.'productos/'.$name;
				$shortrute=FINAL_URL.'uploads/productos/'.$name;
											
				move_uploaded_file($params['tmp_name'][$i], $rute);
				
				$sql="INSERT INTO imagenes_productos VALUES('',:producto,:name,:route)";
				
				$statement=$this->connect->prepare($sql);
				
				$statement->bindParam(':producto', $producto_id, PDO::PARAM_STR);
				$statement->bindParam(':name', $name, PDO::PARAM_STR);
				$statement->bindParam(':route', $shortrute, PDO::PARAM_STR);
					
				$statement->execute();
			}
		}
	}
	
	public function GetDataProduct($producto_id='')
	{
		$where="";
		if($producto_id!='')
		{
			$where=" WHERE p.producto_id='$producto_id'";
		}
		
		$sql="SELECT p.producto_id,p.producto_name,p.producto_sku,
				p.producto_description,p.producto_price_utilitarian,p.producto_price_public,p.proveedor_id
				FROM productos p".
				$where.
				" ORDER BY p.producto_id";
		
		$statement=$this->connect->prepare($sql);
		
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result; 
	}
	
	public function GetProductColor($producto_id)
	{
		$colores=array();
		
		$sql="SELECT c.color_id,c.color_name
				FROM colores c
				INNER JOIN productos_colores pc USING(color_id)
				WHERE pc.producto_id=:producto
				ORDER BY c.color_name";
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':producto', $producto_id, PDO::PARAM_STR);
		
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($result as $r)
		{
			$colores[$r['color_id']]=$r['color_name'];	
		}
		
		return $colores;
	}
	
	public function GetProductMaterial($producto_id)
	{
		$materiales=array();
	
		$sql="SELECT m.material_id,m.material_name
				FROM materiales m
				INNER JOIN productos_materiales pm USING(material_id)
				WHERE pm.producto_id=:producto
				ORDER BY m.material_name";
		$statement=$this->connect->prepare($sql);
	
		$statement->bindParam(':producto', $producto_id, PDO::PARAM_STR);
	
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
	
		foreach($result as $r)
		{
			$materiales[$r['material_id']]=$r['material_name'];
		}
		
		return $materiales;
	}
	
	public function GetProductCategory($producto_id)
	{
		$categorias=array();
	
		$sql="SELECT c.categoria_id,c.categoria_name
				FROM categorias c
				INNER JOIN productos_categorias pm USING(categoria_id)
				WHERE pm.producto_id=:producto
				ORDER BY c.categoria_name";
		$statement=$this->connect->prepare($sql);
	
		$statement->bindParam(':producto', $producto_id, PDO::PARAM_STR);
	
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
	
		foreach($result as $r)
		{
			$categorias[$r['categoria_id']]=$r['categoria_name'];
		}
	
		return $categorias;
	}
	
	public function GetImagesProduct($producto_id,$imagen_id='')
	{
		$where="";
		if($imagen_id!='')
		{
			$where=" AND ip.imagen_id=$imagen_id ";
		}
		
		$sql="SELECT ip.imagen_id,ip.imagen_name,ip.imagen_route
				FROM imagenes_productos ip
				WHERE ip.producto_id=$producto_id ".
				$where.
				"ORDER BY ip.imagen_id ASC";
		
		$statement=$this->connect->prepare($sql);
		
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	public function DeleteImg($producto_id,$imagen_id)
	{
		$data_image=$this->GetImagesProduct($producto_id,$imagen_id);
		$name=$data_image[0]['imagen_name'];
	
		unlink(DIR_UPLOAD."productos/".$name);
		
		$sql="DELETE FROM imagenes_productos WHERE imagen_id=:imagen_id";
	
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':imagen_id', $imagen_id, PDO::PARAM_STR);
	
		$statement->execute();
		
		return $imagen_id;
	}
	
	public function InsertColorsProduct($producto_id,$colores)
	{
		
		$sql="DELETE FROM productos_colores WHERE producto_id=:producto";
		
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':producto', $producto_id, PDO::PARAM_STR);
		
		$statement->execute();
		
		foreach($colores as $c)
		{
			$sql="INSERT INTO productos_colores VALUES(:producto,:color)";
				
			$statement=$this->connect->prepare($sql);
				
			$statement->bindParam(':producto', $producto_id, PDO::PARAM_STR);
			$statement->bindParam(':color', $c, PDO::PARAM_STR);
				
			$statement->execute();
		}
	}
	
	public function InsertMaterialsProduct($producto_id,$materiales)
	{
		$sql="DELETE FROM productos_materiales WHERE producto_id=:producto";
		
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':producto', $producto_id, PDO::PARAM_STR);
		
		$statement->execute();
		
		foreach($materiales as $m)
		{
			$sql="INSERT INTO productos_materiales VALUES(:producto,:material)";
		
			$statement=$this->connect->prepare($sql);
		
			$statement->bindParam(':producto', $producto_id, PDO::PARAM_STR);
			$statement->bindParam(':material', $m, PDO::PARAM_STR);
				
			$statement->execute();
		}
	}
	
	public function InsertCategoriesProduct($producto_id,$categorias)
	{
		$sql="DELETE FROM productos_categorias WHERE producto_id=:producto";
		
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':producto', $producto_id, PDO::PARAM_STR);
		
		$statement->execute();
		
		foreach($categorias as $c)
		{
			$sql="INSERT INTO productos_categorias VALUES(:producto,:categoria)";
		
			$statement=$this->connect->prepare($sql);
		
			$statement->bindParam(':producto', $producto_id, PDO::PARAM_STR);
			$statement->bindParam(':categoria', $c, PDO::PARAM_STR);
				
			$statement->execute();
		}
	}
	
	public function ActualizarProducto($params)
	{
		$sql="UPDATE productos SET producto_name=:nombre,producto_sku=:sku,producto_description=:descripcion,producto_price_utilitarian=:precio_utilitario,producto_price_public=:precio_publico,proveedor_id=:proveedor
				WHERE producto_id=:producto";
		
		
		$statement=$this->connect->prepare($sql);
		
		$price_utilitarian=number_format($params['precioU'], 2, '.', '');
		$price_public=number_format($params['precioP'], 2, '.', '');
		
		$statement->bindParam(':nombre', $params['nombre'], PDO::PARAM_STR);
		$statement->bindParam(':sku', $params['sku'], PDO::PARAM_STR);
		$statement->bindParam(':descripcion', $params['descripcion'], PDO::PARAM_STR);
		$statement->bindParam(':precio_utilitario', $price_utilitarian, PDO::PARAM_STR);
		$statement->bindParam(':precio_publico', $price_public, PDO::PARAM_STR);
		$statement->bindParam(':proveedor', $params['proveedor'], PDO::PARAM_STR);
		$statement->bindParam(':producto', $params['id_producto'], PDO::PARAM_STR);
		
		$statement->execute();
		
		$producto_id=$params['id_producto'];
		
		$this->InsertColorsProduct($producto_id, $params['color']);
		
		$this->InsertMaterialsProduct($producto_id, $params['material']);
		
		$this->InsertCategoriesProduct($producto_id, $params['categoria']);
		
		return $producto_id;
	}
	
	public function DeleteProduct($producto_id)
	{
		$sql="DELETE FROM productos_colores WHERE producto_id=:producto";
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':producto', $producto_id, PDO::PARAM_STR);
		$statement->execute();
		
		
		$sql="DELETE FROM productos_materiales WHERE producto_id=:producto";
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':producto', $producto_id, PDO::PARAM_STR);
		$statement->execute();
		
		$sql="DELETE FROM productos_categorias WHERE producto_id=:producto";
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':producto', $producto_id, PDO::PARAM_STR);
		$statement->execute();
		
		$images=$this->GetImagesProduct($producto_id);
		
		foreach($images as $img)
		{
			$imagen_id=$img['imagen_id'];
			
			$this->DeleteImg($producto_id, $imagen_id);
		}
		
		$sql="DELETE FROM productos WHERE producto_id=:producto";
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':producto', $producto_id, PDO::PARAM_STR);
		$statement->execute();
	}
}