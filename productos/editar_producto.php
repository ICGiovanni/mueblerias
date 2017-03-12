<?php
    include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
    //include $pathProy.'login/session.php';
    require_once($_SERVER["REDIRECT_PATH_CONFIG"].'productos/models/class.Productos.php');
    require_once($_SERVER["REDIRECT_PATH_CONFIG"].'proveedores/models/class.Proveedores.php');
    include $pathProy.'/header.php';
    include $pathProy.'/menu.php';
?>
<link href="<?php echo $raizProy?>css/plugins/chosen/chosen.css" rel="stylesheet">
<link href="<?php echo $raizProy?>font-awesome/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/animate.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/easy-autocomplete/easy-autocomplete.min.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Editar Producto</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">Productos</a>
                </li>
                <li class="active">
                    <strong>Editar Producto</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="./index.php" class="btn btn-warning btn-xs"><i class="fa fa-arrow-left"></i> Regresar a listado</a>
            </div>
        </div>
    </div>
<?php
$productos=new Productos();
$producto_id=$_REQUEST["id"];
$datos=$productos->GetDataProduct($producto_id);
$categorias=$productos->GetProductCategory($producto_id);
$descuentos=$productos->GetDiscountProduct($producto_id);
$descuentosP=$productos->GetDiscountProductPublic($producto_id);

$checked="";
if($datos[0]["producto_conjunto"]=='1')
{
	$checked="checked";	
}


?>
    <div class="wrapper wrapper-content animated fadeInRight">
		<form method="post" class="form-horizontal" action="/" id="form_productos" enctype="multipart/form-data">
			<input type="hidden" class="form-control" id="id_producto" name="id_producto" value="<?php echo $datos[0]["producto_id"]?>">
			<input type="hidden" class="form-control" id="tipo_producto" name="tipo_producto" value="<?php echo $datos[0]["producto_type"]?>">
			<input type="hidden" id="code" name="code" value="">
			<div class="form-group"><label class="col-sm-2 control-label">ID</label>
			<div class="col-sm-6"><label class="col-sm-2 control-label"><?php echo $datos[0]["producto_id"]?></label></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Tipo de Producto</label>
			<div class="col-sm-6"><label class="col-sm-2 control-label"><?php echo utf8_encode($datos[0]["producto_type_name"]);?></label></div>
            </div>
            
<?php
if($datos[0]["producto_type"]=='V')
{
	echo '<div class="form-group"><label class="col-sm-2 control-label">Producto Principal</label>';
	echo '<div class="col-sm-10"><label class="col-sm-2 control-label">';
	echo utf8_encode($datos[0]["producto_principal"]);
	echo '</label></div></div>';
}
?>
            
			<div class="form-group"><label class="col-sm-2 control-label">Modelo</label>
			<div class="col-sm-6" ><input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $datos[0]['producto_name'];?>"></div>
            </div>
            <div class="form-group">
            <label class="col-sm-2 control-label">SKU</label>
			<div class="col-sm-2 ">
			<input type="text" class="form-control" id="sku" name="sku" value="<?php echo $datos[0]['producto_sku'];?>" readonly>
			</div>
			<label class="col-sm-1 control-label">Manual</label>
			<div class="col-sm-1 ">
			<input type="checkbox" name="manual" id="manual" value="">
			</div>
            </div>
            <div id="div_principal" style="<?php echo ($datos[0]['producto_type']!='P' && $datos[0]['producto_type']!='U') ? "display:none;" : ''; ?>">
            			
			<div class="form-group">
            <label class="col-sm-2 control-label">Medida</label>
			<div class="col-sm-2 "><input type="text" class="form-control" id="medida" name="medida" value="<?php echo $datos[0]['producto_medida'];?>"></div>
			</div>
            
            <div class="form-group"><label class="col-sm-2 control-label">Descripci&oacute;n</label>
			<div class="col-sm-6" ><textarea class="form-control" id="descripcion" name="descripcion"><?php echo utf8_encode($datos[0]['producto_description']);?></textarea></div>
            </div>
            
            <div class="form-group"><label class="col-sm-2 control-label">Descripci&oacute;n Corta</label>
			<div class="col-sm-6" ><textarea class="form-control" id="descripcionC" name="descripcionC"><?php echo utf8_encode($datos[0]['producto_description_corta']);?></textarea></div>
            </div>
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Categorias</label>
			<div class="col-sm-6" >
				<select data-placeholder="Selecciona una categoria" class="chosen-select" multiple style="width:300px;" tabindex="4" id="categoria" name="categoria[]">
	            <option value=""></option>
	            <?php 
	            $productos=new Productos();
	            
	            $result=$productos->GetCategories();
	            
	            $list="";
	            foreach($result as $r)
	            {
	            	if(isset($categorias[$r['categoria_id']]))
	            	{
	            		$list.='<option value="'.$r['categoria_id'].'" selected="">'.$r['categoria_name'].'</option>';
	            	}
	            	else
	            	{
	            		$list.='<option value="'.$r['categoria_id'].'">'.$r['categoria_name'].'</option>';
	            	}
	            }
	            
	            echo $list;
	            
	            ?>
				</select>
			</div>
            </div>
            
            
            <div id="div_variantes">
	           	<div class="form-group">
	           	<label class="col-sm-2 control-label">Productos Variantes</label>
	           	<div class="col-sm-6" ><input type="text" class="form-control" id="productoV" name="productoV"></div>
	           	</div>
	           	
	           	<div class="form-group">
	           	<div class="col-sm-2" ></div>
	           	<div class="col-sm-6" >
	           	<div id="product_list_variante" class="ibox-content">
	           	
	           	<table class="table table-striped">
	           	<thead>
					<tr>
						<td></td>
						<td>SKU</td>
						<td>Nombre</td>
						<td></td>
					</tr>
				</thead>
	           	<tbody id="products_table_variante">
	           	<?php 
	           	$result=$productos->GetFeatureVariations($producto_id);
	           	$table='';
	           	
	           	foreach($result as $r)
	           	{
	           		$id=$r['producto_id'];
	           		$sku=$r['producto_sku'];
	           		$name=$r['producto_name'];
	           		
	           		$table.='<tr>';
	           		$table.='<input type="hidden" id="product_'.$id.'" name="product_'.$id.'" value="'.$id.'" class="products_variante">';
	           		$table.='<td>'.$sku.'</td>';
	           		$table.='<td>'.$name.'</td>';
	           		$table.='<td class="text-left"><a id="delete_'.$id.'" href="#" onCLick="deleteRow(this.id);"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>';
	           		$table.='</tr>';
	           		
	           	}
	           	echo $table;
	           	?>
	           	
	           	</tbody>
	           	</table>
	           </div>
	           </div>
	           </div>
            
            
            </div>
            
            </div>
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Proveedor</label>
			<div class="col-sm-6" >
				<select data-placeholder="Selecciona un proveedor" class="chosen-select" style="width:300px;" tabindex="4" id="proveedor" name="proveedor">
	            <option value=""></option>
	            <?php 
	            $proveedor=new Proveedor();
	            
	            $result=$proveedor->getProveedores();
	            
	            $list="";
	            foreach($result as $r)
	            {
	            	if($datos[0]["proveedor_id"]==$r['proveedor_id'])
	            	{
	            		$list.='<option value="'.$r['proveedor_id'].'" selected>'.$r['proveedor_nombre'].'</option>';
	            	}
	            	else
	            	{
	            		$list.='<option value="'.$r['proveedor_id'].'">'.$r['proveedor_nombre'].'</option>';
	            	}
	            }
	            
	            echo $list;
	            
	            ?>
				</select>
			</div>
            </div>
            
            <div id="div_variacion" style="<?php echo ($datos[0]['producto_type']!='P') ? '' : "display:none;"; ?>">
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Version(es)</label>
			<div class="col-sm-6" >
				<select data-placeholder="Selecciona una versión" class="chosen-select" style="width:300px;" tabindex="4" id="version" name="version">
	            <option value="" data-abrev=""></option>
	            <?php 
	            $productos=new Productos();
	            
	            $result=$productos->GetVersions();
	            
	            $list="";
	            foreach($result as $r)
	            {
	            	if($datos[0]['version_id']==$r['version_id'])
	            	{
	            		$list.='<option value="'.$r['version_id'].'" data-abrev="'.$r['version_abrev'].'" selected>'.$r['version_name'].'</option>';
	            	}
	            	else
	            	{
	            		$list.='<option value="'.$r['version_id'].'" data-abrev="'.$r['version_abrev'].'">'.$r['version_name'].'</option>';
	            	}
	            }
	            
	            echo $list;
	            
	            ?>
				</select>
			</div>
            </div>
            
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Color(es)</label>
			<div class="col-sm-6" >
				<select data-placeholder="Selecciona un color" class="chosen-select" style="width:300px;" tabindex="4" id="color" name="color">
	            <option value="" data-abrev=""></option>
	            <?php 
	            $productos=new Productos();
	            
	            $result=$productos->GetColors();
	            
	            $list="";
	            foreach($result as $r)
	            {
	            	if($datos[0]['color_id']==$r['color_id'])
	            	{
	            		$list.='<option value="'.$r['color_id'].'" selected="" data-abrev="'.$r['color_abrev'].'">'.$r['color_name'].'</option>';
	            	}
	            	else
	            	{
	            		$list.='<option value="'.$r['color_id'].'" data-abrev="'.$r['color_abrev'].'">'.$r['color_name'].'</option>';
	            	}
	            }
	            
	            echo $list;
	            
	            ?>
				</select>
			</div>
            </div>
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Material(es)</label>
			<div class="col-sm-6" >
				<select data-placeholder="Selecciona un material" class="chosen-select" style="width:300px;" tabindex="4" id="material" name="material">
	            <option value="" data-abrev=""></option>
	            <?php 
	            $productos=new Productos();
	            
	            $result=$productos->GetMaterials();
	            
	            $list="";
	            foreach($result as $r)
	            {
	            	if($datos[0]['material_id']==$r['material_id'])
	            	{
	            		$list.='<option value="'.$r['material_id'].'" selected="" data-abrev="'.$r['material_abrev'].'">'.$r['material_name'].'</option>';
	            	}
	            	else
	            	{
	            		$list.='<option value="'.$r['material_id'].'" data-abrev="'.$r['material_abrev'].'">'.$r['material_name'].'</option>';
	            	}
	            }
	            
	            echo $list;
	            
	            ?>
				</select>
			</div>
            </div>
            
            
            <div class="col-lg-11">
			<div class="panel panel-default">
            <div class="panel-heading">
            <label class="control-label">Precio Lista</label>
			</div>
            <div class="panel-body">
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Precio</label>
			<div class="col-sm-2 ">
			<div class="input-group m-b">
			<span class="input-group-addon">$</span>
			<input type="text" class="form-control" id="precioU" name="precioU" onkeypress="return validateNumber(event)" value="<?php echo $datos[0]['producto_price_purchase'];?>">
			</div>
			</div>
			<div class="col-sm-5">
			<div class="input-group m-b">
			<span class="input-group-addon" style="font-size:13px !important;"><label class="control-label">Precio con Descuento</label></span>
			<span class="input-group-addon">-$</span>
			<input type="text" class="form-control" id="precioUD" name="precioUD" readonly="readonly" value="<?php echo $datos[0]['producto_price_purchase_discount'];?>">
			
			</div>
			</div>
            </div>
            
			<?php 
			
			$i=0;
			$descuentosA="";
			foreach($descuentos as $d)
			{
				$descuento=$d['producto_descuento'];
				
				$descuentosA.='<div class="form-group">';
				if($i==0)
				{
					$descuentosA.='<label class="col-sm-2 control-label">Porcentaje de Descuento</label>';
					$descuentosA.='<div class="col-sm-2 "><div class="input-group m-b"><input class="form-control discount" id="descuento" name="descuento[]" value="'.(100*$descuento).'" type="text" onkeypress="return validateNumber(event)"><span class="input-group-addon">%</span></div></div>';
					$descuentosA.='<div class="col-md-1"><button class="btn btn-primary btn-xs" id="agregarDescuento" value="" placeholder="Descuento" type="button"><i class="fa fa-plus"></i></button></div>';
			
				}
				else
				{
					$descuentosA.='<label class="col-sm-2 control-label"></label>';
					$descuentosA.='<div class="col-sm-2 "><div class="input-group m-b"><input class="form-control discount" id="descuento" name="descuento[]" value="'.(100*$descuento).'" type="text" onkeypress="return validateNumber(event)"><span class="input-group-addon">+%</span></div></div>';
					$descuentosA.='<div class="col-md-1"><button class="btn btn-danger btn-xs deleteDiscount" id="agregarDescuento" value="" placeholder="Descuento" type="button"><i class="fa fa-times"></i></button></div>';
				}
				$descuentosA.='</div>';
				$i++;
				
			}
			
			if(!$descuentosA)
			{
				$descuentosA.='<div class="form-group">';
				$descuentosA.='<label class="col-sm-2 control-label">Porcentaje de Descuento</label>';
				$descuentosA.='<div class="col-sm-2 "><div class="input-group m-b"><input class="form-control discount" id="descuento" name="descuento[]" value="" type="text" onkeypress="return validateNumber(event)"><span class="input-group-addon">%</span></div></div>';
				$descuentosA.='<div class="col-md-1"><button class="btn btn-primary btn-xs" id="agregarDescuento" value="" placeholder="Descuento" type="button"><i class="fa fa-plus"></i></button></div>';
				$descuentosA.='</div>';
			}
			echo $descuentosA;
			?>
           
            <div id="newDiscount"></div>
            
            </div>
			</div>
            </div>
            
            <div class="col-lg-11">
			<div class="panel panel-default">
            <div class="panel-heading">
            <label class="control-label">Precio Público</label>
			</div>
            <div class="panel-body">
                        
            <div class="form-group">
            <label class="col-sm-2 control-label">Porcentaje de Utilidad</label>
			<div class="col-sm-2">
			<div class="input-group m-b">
			<input type="text" class="form-control" id="precioPUP" name="precioPUP" onkeypress="return validateCantidad(event)" value="<?php echo $datos[0]['producto_price_purchase_percent'];?>">
			<span class="input-group-addon">%</span>
			</div>			
			</div>
			
			<div class="col-sm-5">
			<div class="input-group m-b">
			<span class="input-group-addon" style="font-size:13px !important;"><label class="control-label">Venta Público</label></span>
			<span class="input-group-addon">$</span>
			<input type="text" class="form-control" id="precioP" name="precioP" onkeypress="return validateCantidad(event)" value="<?php echo $datos[0]['producto_price_public'];?>">
			</div>
			</div>
			
			
            </div>
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Venta Público con Descuento</label>
            <div class="col-sm-2 ">
            <div class="input-group m-b">
			 <span class="input-group-addon">-$</span>
			 <input type="text" class="form-control" id="precioPD" name="precioPD" onkeypress="return validateCantidad(event)" readonly="readonly" value="<?php echo $datos[0]['producto_price_public_discount'];?>">
			 </div>
			 </div>
            </div> 
            
            
            <?php 
			
			$i=0;
			$descuentosA="";
			foreach($descuentosP as $d)
			{
				$descuento=$d['producto_descuento'];
				
				$descuentosA.='<div class="form-group">';
				if($i==0)
				{
					$descuentosA.='<label class="col-sm-2 control-label">Porcentaje de Descuento</label>';
					$descuentosA.='<div class="col-sm-2 ">
           	 <div class="input-group m-b">
           	<input class="form-control discountP" id="descuentoP" name="descuentoP[]" value="'.(100*$descuento).'" type="text" onkeypress="return validateNumber(event)">
           	<span class="input-group-addon">%</span>
           	</div>
           	</div>';
					$descuentosA.='<div class="col-md-1">                            
                            <button class="btn btn-primary btn-xs" id="agregarDescuentoP" value="" placeholder="Descuento" type="button"><i class="fa fa-plus"></i></button>
                        </div>';
			
				}
				else
				{
					$descuentosA.='<label class="col-sm-2 control-label"></label><div class="col-sm-2 ">';
					$descuentosA.='<div class="col-sm-2 "><input class="form-control discountP" id="descuentoP" name="descuentoP[]" value="'.(100*$descuento).'" type="text" onkeypress="return validateNumber(event)"></div>';
					$descuentosA.='<div class="input-group m-b"><input class="form-control discountP" id="descuentoP" name="descuentoP[]" value="'.(100*$descuento).'" type="text" onkeypress="return validateNumber(event)"><span class="input-group-addon">%</span></div></div>';
					$descuentosA.='<div class="col-md-1"><button class="btn btn-danger btn-xs deleteDiscountP" id="agregarDescuentoP" value="" placeholder="Descuento" type="button"><i class="fa fa-times"></i></button></div>';
				}
				$descuentosA.='</div>';
				$i++;
				
			}
			
			if(!$descuentosA)
			{
				$descuentosA.='<div class="form-group">';
				$descuentosA.='<label class="col-sm-2 control-label">Porcentaje de Descuento</label>';
				$descuentosA.='<div class="col-sm-2 ">
           	 <div class="input-group m-b">
           	<input class="form-control discountP" id="descuentoP" name="descuentoP[]" value="" type="text" onkeypress="return validateNumber(event)">
           	<span class="input-group-addon">%</span>
           	</div>
           	</div>';
				$descuentosA.='<div class="col-md-1">                            
                            <button class="btn btn-primary btn-xs" id="agregarDescuentoP" value="" placeholder="Descuento" type="button"><i class="fa fa-plus"></i></button>
                        </div>';
				$descuentosA.='</div>';
			}
			echo $descuentosA;
			?>
            
            
            
            <div id="newDiscountP"></div>
                       
            <div class="form-group">
            <label class="col-sm-2 control-label">Precio P&uacute;blico Minimo</label>
            
            <div class="col-sm-2">
			<div class="input-group m-b">
			<input type="text" class="form-control" id="precioPMM" name="precioPMM" onkeypress="return validateCantidad(event)" value="<?php echo $datos[0]['producto_price_min_public_percent'];?>">
			<span class="input-group-addon">%</span>
			</div>			
			</div>
            
			<div class="col-sm-3">
			<div class="input-group m-b">
			<span class="input-group-addon">$</span>
			<input type="text" class="form-control" id="precioPM" name="precioPM" onkeypress="return validateCantidad(event)" value="<?php echo $datos[0]['producto_price_public_min'];?>">
			</div>
			</div>
            </div>
            
            </div>
			</div>
            </div>
            
            </div>
           
            <div class="form-group"><label class="col-sm-2 control-label">Imagenes</label>
			<div class="col-sm-6" >
			<input name="upload[]" type="file" id="upload" accept='image/*'/>
    		<button class="add_more btn btn-primary btn-xs">Agregar</button>
			</div>
            </div>
            
            <div class="form-group">
            <label class="col-sm-2 control-label"></label>
			<div class="col-sm-6" >
			<div class="lightBoxGallery" id="gallery">
			</div>
			</div>
            </div>
            <?php 
            
            if($checked)
            {
            	$visible="";
            }
            else
            {
            	$visible='style="display:none;"';	
            }
            
            ?>
            
            <div id="div_check_conjunto" <?php echo $visible;?>>
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Conjunto</label>
			<div class="col-sm-1 ">
				<input type="checkbox" name="conjunto" id="conjunto" value="1" <?php echo $checked;?>>
			</div>
			<div class="col-sm-6 ">
				 <label class="control-label">* Son productos que conforman otro y pueden ser vendidos por separado</label>
			</div>
            </div>
            
            
			<div id="div_conjunto" <?php echo $visible;?>>
	           	<div class="form-group">
	           	<label class="col-sm-2 control-label">Productos</label>
	           	<div class="col-sm-6" ><input type="text" class="form-control" id="producto" name="producto"></div>
	           	</div>
	           	
	           	<div class="form-group">
	           	<div class="col-sm-2" ></div>
	           	<div class="col-sm-6" >
	           	<div id="product_list" class="ibox-content">
	           	
	           	<table class="table table-striped">
	           	<thead>
					<tr>
						<td></td>
						<td>Cantidad</td>
						<td>SKU</td>
						<td>Nombre</td>
						<td></td>
					</tr>
				</thead>
	           	<tbody id="products_table">
	           	<?php 
	           	$products=$productos->GetProductsGroup($producto_id);
	           	
	           	$table="";
	           	foreach($products as $p)
	           	{
	           		$table.='<input type="hidden" id="product_'.$p['producto_id'].'" name="product_'.$p['producto_id'].'" value="'.$p['producto_id'].'" class="products">';
	           		$table.='<tr>';
	           		$table.='<td>'.'<img src="'.$p['imagen'].'" height="50" width="50">'.'</td>';
	           		$table.='<td>'.'<input id="cantidad_'.$p['producto_conjunto_id'].'" value="'.$p['cantidad'].'" size="3" onkeypress="return validateNumber(event)"></td>';
	           		$table.='<td>'.$p['producto_sku'].'</td>';
	           		$table.='<td>'.$p['producto_name'].'</td>';
	           		$table.='<td class="text-left"><a id="delete_'.$p['producto_id'].'" href="#" onCLick="deleteRow(this.id,'.$producto_id.','.$p['producto_id'].');"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>';
	           		$table.='</tr>';
	           	}
	           	echo $table;
	           	?>
	           	</tbody>
	           	</table>
	           </div>
	           </div>
	           </div>
            </div>
            </div>
            
            <div class="form-group">
			<div class="col-sm-6 col-sm-offset-2" align="right"><br>
			<button class="btn btn-danger btn-xs" id="cancelar" type="button">Cancelar</button>&nbsp;&nbsp;&nbsp;&nbsp;
			<button class="btn btn-primary btn-xs" id="editar" type="button">Guardar Cambio</button>
			</div>
			</div>
        
		</form>
	</div>

<script src="<?php echo $raizProy?>js/plugins/toastr/toastr.min.js"></script>

<script src="<?php echo $raizProy?>js/plugins/chosen/chosen.jquery.js"></script>
<script src="<?php echo $raizProy?>js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
<script src="<?php echo $raizProy?>js/plugins/easy-autocomplete/jquery.easy-autocomplete.min.js"></script>
<script src="<?php echo $raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>

<script src="<?php echo $raizProy?>productos/js/productos.js"></script>


   

<?php
    include $pathProy.'footer.php';
?>