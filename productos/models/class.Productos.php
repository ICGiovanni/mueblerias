<?php
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/connection/class.Connection.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'inventarios/models/class.Inventarios.php');

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
		$tipo_producto=$params['tipo_producto'];
		
		$conjunto=0;
		if(isset($params['conjunto']))
		{
			$conjunto=1;
		}
		
		$sql="INSERT INTO productos VALUES('',:nombre,:sku,:descripcion,:descripcionC,:precio_utilitario,:precio_utilitario_descuento,:porcentaje_utilidad,:precio_publico,:precio_publico_min,:producto_price_public_discount,:producto_price_min_public_percent,:color,:material,:proveedor,:conjunto,:version,:medida,:type,:producto_parent)";
		
		$statement=$this->connect->prepare($sql);
		
		$precioU=($params['precioU']=='') ? 0 : $params['precioU'];
		$precioUD=($params['precioUD']=='') ? 0 : $params['precioUD'];
		$precioP=($params['precioP']=='') ? 0 : $params['precioP'];
		$precioPD=($params['precioPD']=='') ? 0 : $params['precioPD'];
		$precioPM=($params['precioPM']=='') ? $precioP : $params['precioPM'];
		
		
		$price_utilitarian=number_format($precioU, 2, '.', '');
		$price_utilitarian_descuento=number_format($precioUD, 2, '.', '');
		$price_public=number_format($precioP, 2, '.', '');
		$price_public_discount=number_format($precioPD, 2, '.', '');
		$price_public_min=number_format($precioPM, 2, '.', '');
		
		$statement->bindParam(':nombre', $params['nombre'], PDO::PARAM_STR);
		$statement->bindParam(':sku', $params['sku'], PDO::PARAM_STR);
		$statement->bindParam(':descripcion', $params['descripcion'], PDO::PARAM_STR);
		$statement->bindParam(':descripcionC', $params['descripcionC'], PDO::PARAM_STR);
		$statement->bindParam(':precio_utilitario', $price_utilitarian, PDO::PARAM_STR);
		$statement->bindParam(':precio_utilitario_descuento', $price_utilitarian_descuento, PDO::PARAM_STR);
		$statement->bindParam(':porcentaje_utilidad', $params['precioPUP'], PDO::PARAM_STR);
		$statement->bindParam(':precio_publico', $price_public, PDO::PARAM_STR);
		$statement->bindParam(':precio_publico_min', $price_public_min, PDO::PARAM_STR);
		$statement->bindParam(':producto_price_public_discount', $price_public_discount, PDO::PARAM_STR);
		$statement->bindParam(':producto_price_min_public_percent', $params['precioPMM'], PDO::PARAM_STR);
		$statement->bindParam(':color', $params['color'], PDO::PARAM_STR);
		$statement->bindParam(':material', $params['material'], PDO::PARAM_STR);
		$statement->bindParam(':proveedor', $params['proveedor'], PDO::PARAM_STR);
		$statement->bindParam(':conjunto', $conjunto, PDO::PARAM_STR);
		$statement->bindParam(':version', $params['version'], PDO::PARAM_STR);
		$statement->bindParam(':medida', $params['medida'], PDO::PARAM_STR);
		$statement->bindParam(':type', $tipo_producto, PDO::PARAM_STR);
		$statement->bindParam(':producto_parent', $params['producto_padre_id'], PDO::PARAM_STR);
		
		$statement->execute();
		
		$producto_id=$this->connect->lastInsertId();
		
		if(isset($params['categoria']))
		{
			$this->InsertCategoriesProduct($producto_id, $params['categoria']);
		}
		
		if(isset($params['descuento']))
		{
			$this->InsertDiscount($producto_id,$params['descuento']);
		}
		
		if(isset($params['descuentoP']))
		{
			$this->InsertDiscountPublico($producto_id,$params['descuentoP']);
		}
		
		return $producto_id;
	}
	
	public function InsertDiscount($producto_id,$descuentos)
	{
		$banderaD=false;
		
		foreach($descuentos as $d)
		{
			if($d!=0)
			{
				$banderaD=true;
			}
		}
		
		if($banderaD)
		{
			$sql="DELETE FROM productos_descuentos WHERE producto_id=:producto";
			
			$statement=$this->connect->prepare($sql);
			$statement->bindParam(':producto', $producto_id, PDO::PARAM_STR);
			
			$statement->execute();
			
			foreach($descuentos as $d)
			{
				if($d!=0)
				{
					$sql="INSERT INTO productos_descuentos VALUES('',:producto,:descuento)";
				
					$statement=$this->connect->prepare($sql);
					$descuento=$d/100;
					$statement->bindParam(':producto', $producto_id, PDO::PARAM_STR);
					$statement->bindParam(':descuento', $descuento, PDO::PARAM_STR);
				
					$statement->execute();
				}
			}
		}		
	}
	
	public function InsertDiscountPublico($producto_id,$descuentos)
	{
		$banderaD=false;
	
		foreach($descuentos as $d)
		{
			if($d!=0)
			{
				$banderaD=true;
			}
		}
	
		if($banderaD)
		{
			$sql="DELETE FROM productos_descuentos_publico WHERE producto_id=:producto";
				
			$statement=$this->connect->prepare($sql);
			$statement->bindParam(':producto', $producto_id, PDO::PARAM_STR);
				
			$statement->execute();
				
			foreach($descuentos as $d)
			{
				if($d!=0)
				{
					$sql="INSERT INTO productos_descuentos_publico VALUES('',:producto,:descuento)";
	
					$statement=$this->connect->prepare($sql);
					$descuento=$d/100;
					$statement->bindParam(':producto', $producto_id, PDO::PARAM_STR);
					$statement->bindParam(':descuento', $descuento, PDO::PARAM_STR);
	
					$statement->execute();
				}
			}
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
				p.producto_description,p.producto_price_purchase,p.producto_price_public,p.proveedor_id,
				IF(p.producto_type='U','&Uacute;nico','Conjunto') AS producto_type,c.color_name,m.material_name,
				IF((SELECT SUM(cantidad) AS stock
				FROM inventario_productos ip
				WHERE ip.producto_id=p.producto_id)!='',
				(SELECT SUM(cantidad) AS stock
				FROM inventario_productos ip
				WHERE ip.producto_id=p.producto_id),0) AS stock
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
				p.producto_description,p.producto_price_purchase,p.producto_price_public,
				p.proveedor_id,IF(p.producto_conjunto='0','&Uacute;nico','Conjunto') AS producto_conjunto,
				p.producto_type AS type,p.producto_version,p.producto_medida,p.color_id,p.material_id,producto_price_purchase_discount,
				producto_price_public_discount,producto_price_public_min,
				IF((SELECT SUM(cantidad) AS stock
				FROM inventario_productos ip
				WHERE ip.producto_id=p.producto_id)!='',
				(SELECT SUM(cantidad) AS stock
				FROM inventario_productos ip
				WHERE ip.producto_id=p.producto_id),0) AS stock,
				CASE producto_type
				WHEN 'P' THEN 'PRINCIPAL'
				WHEN 'U' THEN 'GENERAL'
				WHEN 'V' THEN 'GENERAL'
				END AS producto_type_name,producto_type,producto_conjunto,
				IF(producto_type='V',
				(SELECT producto_name
				FROM productos
				WHERE producto_id=p.producto_parent),'') AS producto_principal,
				producto_description_corta,producto_price_min_public_percent,
				producto_price_purchase_percent
				FROM productos p
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
		$conjunto=0;
		if(isset($params['conjunto']))
		{
			$conjunto=1;
		}
		
		$this->DeleteProductGroup($params['id_producto']);
		
		$sql="UPDATE productos SET producto_name=:nombre,producto_sku=:sku,producto_description=:descripcion,producto_price_purchase=:precio_utilitario,producto_price_public=:precio_publico,proveedor_id=:proveedor,color_id=:color,material_id=:material,producto_version=:version,	producto_medida=:medida,producto_price_purchase_discount=:precio_utilitario_descuento,producto_price_public_min=:precio_publico_min,producto_price_public_discount=:producto_price_public_discount,producto_conjunto=:conjunto,producto_description_corta=:descripcionC,producto_price_purchase_percent=:porcentaje_utilidad,producto_price_min_public_percent=:producto_price_min_public_percent
				WHERE producto_id=:producto";
		
		
		$statement=$this->connect->prepare($sql);
		
		$precioU=($params['precioU']=='') ? 0 : $params['precioU'];
		$precioUD=($params['precioUD']=='') ? 0 : $params['precioUD'];
		$precioP=($params['precioP']=='') ? 0 : $params['precioP'];
		$precioPD=($params['precioPD']=='') ? 0 : $params['precioPD'];
		$precioPM=($params['precioPM']=='') ? $precioP : $params['precioPM'];
		
		$price_utilitarian=number_format($precioU, 2, '.', '');
		$price_utilitarian_descuento=number_format($precioUD, 2, '.', '');
		$price_public=number_format($precioP, 2, '.', '');
		$price_public_discount=number_format($precioPD, 2, '.', '');
		$price_public_min=number_format($precioPM, 2, '.', '');
		
		$statement->bindParam(':nombre', $params['nombre'], PDO::PARAM_STR);
		$statement->bindParam(':sku', $params['sku'], PDO::PARAM_STR);
		$statement->bindParam(':descripcion', $params['descripcion'], PDO::PARAM_STR);
		$statement->bindParam(':descripcionC', $params['descripcionC'], PDO::PARAM_STR);
		$statement->bindParam(':precio_utilitario', $price_utilitarian, PDO::PARAM_STR);
		$statement->bindParam(':precio_utilitario_descuento', $price_utilitarian_descuento, PDO::PARAM_STR);
		$statement->bindParam(':porcentaje_utilidad', $params['precioPUP'], PDO::PARAM_STR);
		$statement->bindParam(':precio_publico', $price_public, PDO::PARAM_STR);
		$statement->bindParam(':precio_publico_min', $price_public_min, PDO::PARAM_STR);
		$statement->bindParam(':producto_price_public_discount', $price_public_discount, PDO::PARAM_STR);
		$statement->bindParam(':producto_price_min_public_percent', $params['precioPMM'], PDO::PARAM_STR);
		$statement->bindParam(':proveedor', $params['proveedor'], PDO::PARAM_STR);
		$statement->bindParam(':color', $params['color'], PDO::PARAM_STR);
		$statement->bindParam(':material', $params['material'], PDO::PARAM_STR);
		$statement->bindParam(':conjunto', $conjunto, PDO::PARAM_STR);
		$statement->bindParam(':version', $params['version'], PDO::PARAM_STR);
		$statement->bindParam(':medida', $params['medida'], PDO::PARAM_STR);
		$statement->bindParam(':producto', $params['id_producto'], PDO::PARAM_STR);
		
		$statement->execute();
		
		$producto_id=$params['id_producto'];
		
		if(isset($params['categoria']))
		{
			$this->InsertCategoriesProduct($producto_id, $params['categoria']);
		}
		
		if(isset($params['descuento']))
		{
			$this->InsertDiscount($producto_id,$params['descuento']);
		}
		
		if(isset($params['descuentoP']))
		{
			$this->InsertDiscountPublico($producto_id,$params['descuentoP']);
		}
		
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
				limit 0,1),'".FINAL_URL."img/imagen-no.png') AS imagen,
				producto_price_public,producto_description
				FROM productos p
				WHERE producto_type IN('U')
				ORDER BY p.producto_name ASC";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	public function GetProductsSell()
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
				limit 0,1),'".FINAL_URL."img/imagen-no.png') AS imagen,
				producto_price_public,producto_description
				FROM productos p
				WHERE producto_type IN('U','V')
				ORDER BY p.producto_name ASC";
	
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
	
		return $result;
	}
	
	public function GetFeatureVariations($producto_id)
	{
		$inventarios=new Inventarios();
		
		$sql="SELECT p.producto_id,p.producto_name,p.producto_sku,
				c.color_id,c.color_name,c.color_abrev,
				m.material_id,m.material_name,m.material_abrev,
				p.producto_price_public,p.producto_price_public_min,
				p.producto_price_public_discount,
				IF((SELECT SUM(cantidad)
				FROM inventario_productos
				WHERE producto_id=p.producto_id)!='',
				(SELECT SUM(cantidad)
				FROM inventario_productos
				WHERE producto_id=p.producto_id),0) AS stock
				FROM productos p
				INNER JOIN colores c USING(color_id)
				INNER JOIN materiales m USING(material_id)
				WHERE producto_parent='$producto_id'";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		$result=$this->ChangeUTF8($result);
		
		foreach($result as $key=>$r)
		{
			$stock=$inventarios->GetStockbySucursal($r['producto_id']);
			
			$arrayStock=array();
			foreach($stock as $k=>$s)
			{
				if($s['sucursal_name']!='')
				$arrayStock=$s;
			}
			
			if(count($arrayStock))
			{
				$result[$key]['stock_sucursal']=$stock;
			}
			else 
			{
				$result[$key]['stock_sucursal']=array();
			}
		}
		
		return $result;
	}
	
	public function GetFeatureProduct($producto_id)
	{
		$sql="SELECT p.producto_id,p.producto_name,p.producto_sku,
				c.color_id,c.color_name,c.color_abrev,
				m.material_id,m.material_name,m.material_abrev
				FROM productos p
				INNER JOIN colores c USING(color_id)
				INNER JOIN materiales m USING(material_id)
				WHERE producto_id='$producto_id'";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	public function ChangeUTF8($result)
	{
		foreach($result as $key=>$r)
		{
			foreach($r as $k=>$d)
			{
				$result[$key][$k]=utf8_encode($result[$key][$k]);
			}
		}
		
		return $result;
	}
	
	public function GetDataProductsMainJson($producto_id="")
	{
		$where="";
		
		if($producto_id)
		{
			$where=" AND p.producto_id='$producto_id'";	
		}
		
		$sql="SELECT p.producto_id,p.producto_sku,p.producto_name,
				IF((SELECT imagen_route
				FROM imagenes_productos ip
				WHERE ip.producto_id=p.producto_id
				ORDER BY imagen_id ASC
				LIMIT 0,1)!='',
				(SELECT imagen_route
				FROM imagenes_productos ip
				WHERE ip.producto_id=p.producto_id
				ORDER BY imagen_id ASC
				LIMIT 0,1),'".FINAL_URL."img/imagen-no.png') AS imagen,
				producto_price_public,producto_description,producto_price_purchase,
				CASE producto_type
				WHEN 'P' THEN 'PRINCIPAL'
				WHEN 'U' THEN 'ÚNICO'
				WHEN 'V' THEN 'VARIANTE'
				END AS producto_type_name,producto_type,
				producto_conjunto,
				IF(producto_type='P',
				(SELECT SUM(cantidad)
				FROM inventario_productos
				WHERE producto_id IN(SELECT producto_id
				FROM productos
				WHERE producto_parent=p.producto_id)),
				IF((SELECT SUM(cantidad)
				FROM inventario_productos
				WHERE producto_id=p.producto_id)!='',
				(SELECT SUM(cantidad)
				FROM inventario_productos
				WHERE producto_id=p.producto_id),0)) AS stock,
				producto_description_corta,producto_description
				FROM productos p
				WHERE producto_type IN('U','P')
				$where";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		$result=$this->ChangeUTF8($result);
		
		
		foreach($result as $key=>$r)
		{
			if($r['producto_type']=='P')
			{
				$materiales=array();
				$colores=array();
				
				$variation=$this->GetFeatureVariations($r['producto_id']);
				$result[$key]['variaciones']=$variation;
				
				foreach($variation as $v)
				{
					$color_id=$v['color_id'];
					$banderaC=false;
					foreach ($colores as $c)
					{
						if($c['color_id']==$color_id)
						{
							$banderaC=true;
						}
					}
					
					if(!$banderaC)
					{
						array_push($colores,array('color_id'=>$v['color_id'],'color_name'=>$v['color_name'],'color_abrev'=>$v['color_abrev']));
					}
					
					$material_id=$v['material_id'];
					$banderaM=false;
					foreach ($materiales as $m)
					{
						if($m['material_id']==$material_id)
						{
							$banderaM=true;
						}
					}
					
					if(!$banderaM)
					{
						array_push($materiales,array('material_id'=>$v['material_id'],'material_name'=>$v['material_name'],'material_abrev'=>$v['material_abrev']));
					}
				}
				
				$result[$key]['materiales']=$materiales;
				$result[$key]['colores']=$colores;
			}
			else
			{
				$materiales=array();
				$colores=array();
				
				$feature=$this->ChangeUTF8($this->GetFeatureProduct($r['producto_id']));
				
				array_push($materiales,array('material_id'=>$feature[0]['material_id'],'material_name'=>$feature[0]['material_name'],'material_abrev'=>$feature[0]['material_abrev']));
				
				array_push($colores,array('color_id'=>$feature[0]['color_id'],'color_name'=>$feature[0]['color_name'],'color_abrev'=>$feature[0]['color_abrev']));
				
				$result[$key]['materiales']=$materiales;
				$result[$key]['colores']=$colores;
			}
		}
		
		return json_encode($result);
	}
	
	public function GetProductsMain($type='')
	{
		if($type=='')
		{
			$type="'U','P'";
		}
		else
		{
			$type="'".$type."'";	
		}
		
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
				limit 0,1),'".FINAL_URL."img/imagen-no.png') AS imagen,
				producto_price_public,producto_description
				FROM productos p
				WHERE producto_type IN($type)
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
	
	public function InsertProductoVariantes($producto_id,$data)
	{
		$sql="UPDATE productos SET producto_parent='0' WHERE producto_parent='$producto_id'";
		
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		
		foreach($data as $d)
		{
				
			$sql="UPDATE productos SET producto_parent=:producto,producto_type='V' WHERE producto_id=:producto_id";
	
			$statement=$this->connect->prepare($sql);
	
			$statement->bindParam(':producto', $producto_id, PDO::PARAM_STR);
			$statement->bindParam(':producto_id', $d['id'], PDO::PARAM_STR);
			
	
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
	
	public function GetDiscountProductPublic($producto_id)
	{
		$sql="SELECT producto_descuento
		FROM productos_descuentos_publico
		WHERE producto_id='$producto_id'
		ORDER BY descuento_id ASC";
	
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
	
		return $result;
	}
}