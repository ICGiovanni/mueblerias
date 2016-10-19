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
		$sql="SELECT c.color_id,c.color_name,color_abrev
				FROM colores c
				ORDER BY c.color_name";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	public function GetMaterials()
	{
		$sql="SELECT m.material_id,m.material_name,material_abrev
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
		$type="U";
		if(isset($params['conjunto']))
		{
			$type="C";
		}
		
		$sql="INSERT INTO productos VALUES('',:nombre,:sku,:descripcion,:precio_utilitario,:precio_utilitario_descuento,:precio_publico,:color,:material,:proveedor,:type,:version,:medida)";
		
		$statement=$this->connect->prepare($sql);
		$price_utilitarian=number_format($params['precioU'], 2, '.', '');
		$price_utilitarian_descuento=number_format($params['precioUD'], 2, '.', '');
		$price_public=number_format($params['precioP'], 2, '.', '');
		
		$statement->bindParam(':nombre', $params['nombre'], PDO::PARAM_STR);
		$statement->bindParam(':sku', $params['sku'], PDO::PARAM_STR);
		$statement->bindParam(':descripcion', $params['descripcion'], PDO::PARAM_STR);
		$statement->bindParam(':precio_utilitario', $price_utilitarian, PDO::PARAM_STR);
		$statement->bindParam(':precio_utilitario_descuento', $price_utilitarian_descuento, PDO::PARAM_STR);
		$statement->bindParam(':precio_publico', $price_public, PDO::PARAM_STR);
		$statement->bindParam(':color', $params['color'], PDO::PARAM_STR);
		$statement->bindParam(':material', $params['material'], PDO::PARAM_STR);
		$statement->bindParam(':proveedor', $params['proveedor'], PDO::PARAM_STR);
		$statement->bindParam(':type', $type, PDO::PARAM_STR);
		$statement->bindParam(':version', $params['version'], PDO::PARAM_STR);
		$statement->bindParam(':medida', $params['medida'], PDO::PARAM_STR);
		
		$statement->execute();
		
		$producto_id=$this->connect->lastInsertId();
		
		$this->InsertCategoriesProduct($producto_id, $params['categoria']);
		
		$this->InsertDiscount($producto_id,$params['descuento']);
		
		return $producto_id;
	}
	
	public function InsertDiscount($producto_id,$descuentos)
	{
		$sql="DELETE FROM productos_descuentos WHERE producto_id=:producto";
		
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':producto', $producto_id, PDO::PARAM_STR);
		
		$statement->execute();
		
		foreach($descuentos as $d)
		{
			$sql="INSERT INTO productos_descuentos VALUES('',:producto,:descuento)";
		
			$statement=$this->connect->prepare($sql);
		
			$statement->bindParam(':producto', $producto_id, PDO::PARAM_STR);
			$statement->bindParam(':descuento', $d, PDO::PARAM_STR);
		
			$statement->execute();
		}
		
	}
	
	public function GetProductSearch($params)
	{
		$producto=array();
		$where="WHERE 1 ";
		if($params["nombre"])
		{
			$where.="AND producto_name LIKE '%".$params["nombre"]."%' ";
		}
		
		if($params["sku"])
		{
			$where.="AND producto_sku LIKE '%".$params["sku"]."%' ";
		}
		
		if($params["tipo"])
		{
			$where.="AND producto_type='".$params["tipo"]."' ";
		}
		
		$colores="";
		if(isset($params["color"]))
		{
			$i=0;
			foreach($params["color"] as $c)
			{
				if($i==0)
				{
					$colores=$c;
				}
				else
				{
					$colores.=','.$c;
				}
				
				$i++;
			}
		}
		
		if($colores)
		{
			$where.=" AND color_id IN(".$colores.")";
		}
		
		$materiales="";
		if(isset($params["material"]))
		{
			$i=0;
			foreach($params["material"] as $m)
			{
				if($i==0)
				{
					$materiales=$m;
				}
				else
				{
					$materiales.=','.$m;
				}
		
				$i++;
			}
		}
		
		if($materiales)
		{
			$where.=" AND material_id IN(".$materiales.")";
		}
		
		$categorias="";
		if(isset($params["categoria"]))
		{
			$i=0;
			foreach($params["categoria"] as $c)
			{
				if($i==0)
				{
					$categorias=$c;
				}
				else
				{
					$categorias.=','.$c;
				}
		
				$i++;
			}
		}
		
		if($categorias)
		{
			$sql="SELECT producto_id
					FROM productos_categorias
					WHERE categoria_id IN(".$categorias.")";
			
			$statement=$this->connect->prepare($sql);
			$statement->execute();
			$result=$statement->fetchAll(PDO::FETCH_ASSOC);
			
			foreach($result as $res)
			{
				foreach($res as $r)
				{
					$producto[$r]=$r;
				}
			}
		}
		
		if(count($producto))
		{
			$productoB="";
			$i=0;
			foreach($producto as $p)
			{
				if($i==0)
				{
					$productoB.=$p;
				}
				else 
				{
					$productoB.=','.$p;
				}
				$i++;
			}
			
			$where.=' AND producto_id IN('.$productoB.')';
		}
		
		$sql="SELECT p.producto_id,p.producto_name,p.producto_sku,
				p.producto_description,p.producto_price_utilitarian,p.producto_price_public,p.proveedor_id,IF(p.producto_type='U','&Uacute;nico','Conjunto') AS producto_type,c.color_name,m.material_name
				FROM productos p 
				INNER JOIN colores c USING(color_id)
				INNER JOIN materiales m USING(material_id)
				INNER JOIN proveedores pr USING(proveedor_id)".
				$where.
				" ORDER BY p.producto_id";
		$statement=$this->connect->prepare($sql);
		
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($result as $key=>$r)
		{
			$producto_id=$r['producto_id'];
			$i=0;
			foreach($this->GetProductCategory($producto_id) as $c)
			{
				$result[$key]["categoria"][$i]=$c;
				$i++;
			}
		}
				
		return $result;
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
				p.producto_description,p.producto_price_utilitarian,p.producto_price_public,
				p.proveedor_id,IF(p.producto_type='U','&Uacute;nico','Conjunto') AS producto_type,
				p.producto_type AS type,p.producto_version,p.producto_medida,c.color_name,m.material_name,c.color_id,m.material_id,producto_price_utilitarian_discount
				FROM productos p
				INNER JOIN colores c USING(color_id)
				INNER JOIN materiales m USING(material_id)
				INNER JOIN proveedores pr USING(proveedor_id)".
				$where.
				" ORDER BY p.producto_id";
		
		$statement=$this->connect->prepare($sql);
		
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result; 
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
	
	public function DeleteProductGroup($producto_id)
	{
		$sql="DELETE FROM productos_conjunto WHERE producto_id=:producto_id";
		
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':producto_id', $producto_id, PDO::PARAM_STR);
		
		$statement->execute();
	}
	
	public function ActualizarProducto($params)
	{
		if(isset($params['conjunto']))
		{
			$type="C";
		}
		else
		{
			$type="U";
			
		}
		
		$this->DeleteProductGroup($params['id_producto']);
		
		$sql="UPDATE productos SET producto_name=:nombre,producto_sku=:sku,producto_description=:descripcion,producto_price_utilitarian=:precio_utilitario,producto_price_public=:precio_publico,proveedor_id=:proveedor,color_id=:color,material_id=:material,producto_type=:type,producto_version=:version,	producto_medida=:medida,producto_price_utilitarian_discount=:precio_utilitario_descuento
				WHERE producto_id=:producto";
		
		
		$statement=$this->connect->prepare($sql);
		
		$price_utilitarian=number_format($params['precioU'], 2, '.', '');
		$price_public=number_format($params['precioP'], 2, '.', '');
		$price_utilitarian_descuento=number_format($params['precioUD'], 2, '.', '');
		
		$statement->bindParam(':nombre', $params['nombre'], PDO::PARAM_STR);
		$statement->bindParam(':sku', $params['sku'], PDO::PARAM_STR);
		$statement->bindParam(':descripcion', $params['descripcion'], PDO::PARAM_STR);
		$statement->bindParam(':precio_utilitario', $price_utilitarian, PDO::PARAM_STR);
		$statement->bindParam(':precio_utilitario_descuento', $price_utilitarian_descuento, PDO::PARAM_STR);
		$statement->bindParam(':precio_publico', $price_public, PDO::PARAM_STR);
		$statement->bindParam(':proveedor', $params['proveedor'], PDO::PARAM_STR);
		$statement->bindParam(':color', $params['color'], PDO::PARAM_STR);
		$statement->bindParam(':material', $params['material'], PDO::PARAM_STR);
		$statement->bindParam(':type', $type, PDO::PARAM_STR);
		$statement->bindParam(':version', $params['version'], PDO::PARAM_STR);
		$statement->bindParam(':medida', $params['medida'], PDO::PARAM_STR);
		$statement->bindParam(':producto', $params['id_producto'], PDO::PARAM_STR);
		
		$statement->execute();
		
		$producto_id=$params['id_producto'];
		
		$this->InsertCategoriesProduct($producto_id, $params['categoria']);
		
		$this->InsertDiscount($producto_id,$params['descuento']);
		
		return $producto_id;
	}
	
	public function DeleteProduct($producto_id)
	{
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
	
	public function GetProductsUnique()
	{
		$sql="SELECT p.producto_id,p.producto_sku,p.producto_name,
				IF((SELECT imagen_route
				FROM imagenes_productos ip
				WHERE ip.producto_id=p.producto_id
				ORDER BY imagen_id ASC
				limit 0,1)!='',
				(SELECT imagen_route
				FROM imagenes_productos ip
				WHERE ip.producto_id=p.producto_id
				ORDER BY imagen_id ASC
				limit 0,1),'".FINAL_URL."img/imagen-no.png') AS imagen
				FROM productos p
				INNER JOIN proveedores pr USING(proveedor_id)
				WHERE producto_type='U'
				ORDER BY p.producto_name ASC";
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	public function InsertProductoGroup($producto_id,$data)
	{		
		foreach($data as $d)
		{
			
			$sql="INSERT INTO productos_conjunto VALUES(:producto,:producto_conjunto,:cantidad)";
		
			$statement=$this->connect->prepare($sql);
		
			$statement->bindParam(':producto', $producto_id, PDO::PARAM_STR);
			$statement->bindParam(':producto_conjunto', $d['id'], PDO::PARAM_STR);
			$statement->bindParam(':cantidad', $d['cantidad'], PDO::PARAM_STR);
				
			$statement->execute();
		}
	}
	
	public function GetProductsGroup($producto_id)
	{
		$sql="SELECT p.producto_id,p.producto_sku,p.producto_name,
				IF((SELECT imagen_route
				FROM imagenes_productos ip
				WHERE ip.producto_id=p.producto_id
				ORDER BY imagen_id ASC
				limit 0,1)!='',
				(SELECT imagen_route
				FROM imagenes_productos ip
				WHERE ip.producto_id=p.producto_id
				ORDER BY imagen_id ASC
				limit 0,1),'".FINAL_URL."img/imagen-no.png') AS imagen,pc.cantidad,pc.producto_conjunto_id
				FROM productos p
				INNER JOIN proveedores pr USING(proveedor_id)
				INNER JOIN productos_conjunto pc ON pc.producto_conjunto_id=p.producto_id
				WHERE producto_type='U'
				AND pc.producto_id='$producto_id'
				ORDER BY p.producto_name ASC";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	public function GetDiscountProduct($producto_id)
	{
		$sql="SELECT producto_descuento
				FROM productos_descuentos
				WHERE producto_id='$producto_id'
				ORDER BY descuento_id ASC";
				
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
}