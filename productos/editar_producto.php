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
                <a href="./index.php" class="btn btn-danger btn-xs"><i class="fa fa-arrow-left"></i> Regresar a listado</a>
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
            <label class="col-sm-2 control-label">Version</label>
			<div class="col-sm-2 "><input type="text" class="form-control" id="version" name="version" value="<?php echo $datos[0]['producto_version'];?>"></div>
			</div>
			
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
            <label class="col-sm-2 control-label">Colores</label>
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
            <label class="col-sm-2 control-label">Materiales</label>
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
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Pecio Utilitario</label>
			<div class="col-sm-2 "><input type="text" class="form-control" id="precioU" name="precioU" onkeypress="return validateNumber(event)" value="<?php echo $datos[0]['producto_price_purchase'];?>"></div>
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
					$descuentosA.='<label class="col-sm-2 control-label">Descuento</label>';
					$descuentosA.='<div class="col-sm-2 "><input class="form-control discount" id="descuento" name="descuento[]" value="'.(100*$descuento).'" type="text" onkeypress="return validateNumber(event)"></div>';
					$descuentosA.='<div class="col-md-1"><button class="btn btn-primary btn-xs" id="agregarDescuento" value="" placeholder="Descuento" type="button"><i class="fa fa-plus"></i></button></div>';
			
				}
				else
				{
					$descuentosA.='<label class="col-sm-2 control-label"></label>';
					$descuentosA.='<div class="col-sm-2 "><input class="form-control discount" id="descuento" name="descuento[]" value="'.(100*$descuento).'" type="text" onkeypress="return validateNumber(event)"></div>';
					$descuentosA.='<div class="col-md-1"><button class="btn btn-danger btn-xs deleteDiscount" id="agregarDescuento" value="" placeholder="Descuento" type="button"><i class="fa fa-times"></i></button></div>';
				}
				$descuentosA.='</div>';
				$i++;
				
			}
			
			if(!$descuentosA)
			{
				$descuentosA.='<div class="form-group">';
				$descuentosA.='<label class="col-sm-2 control-label">Descuento</label>';
				$descuentosA.='<div class="col-sm-2 "><input class="form-control discount" id="descuento" name="descuento[]" value="" type="text" onkeypress="return validateNumber(event)"></div>';
				$descuentosA.='<div class="col-md-1"><button class="btn btn-primary btn-xs" id="agregarDescuento" value="" placeholder="Descuento" type="button"><i class="fa fa-plus"></i></button></div>';
				$descuentosA.='</div>';
			}
			echo $descuentosA;
			?>
           
            <div id="newDiscount"></div>
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Pecio Utilitario con Descuento</label>
			<div class="col-sm-2 "><input type="text" class="form-control" id="precioUD" name="precioUD" value="<?php echo $datos[0]['producto_price_purchase_discount'];?>" readonly="readonly"></div>
            </div>
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Precio P&uacute;blico</label>
			<div class="col-sm-2 "><input type="text" class="form-control" id="precioP" name="precioP" onkeypress="return validateCantidad(event)" value="<?php echo $datos[0]['producto_price_public'];?>"></div>
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
					$descuentosA.='<label class="col-sm-2 control-label">Descuento</label>';
					$descuentosA.='<div class="col-sm-2 "><input class="form-control discountP" id="descuentoP" name="descuentoP[]" value="'.(100*$descuento).'" type="text" onkeypress="return validateNumber(event)"></div>';
					$descuentosA.='<div class="col-md-1"><button class="btn btn-primary btn-xs" id="agregarDescuentoP" value="" placeholder="Descuento" type="button"><i class="fa fa-plus"></i></button></div>';
			
				}
				else
				{
					$descuentosA.='<label class="col-sm-2 control-label"></label>';
					$descuentosA.='<div class="col-sm-2 "><input class="form-control discountP" id="descuentoP" name="descuentoP[]" value="'.(100*$descuento).'" type="text" onkeypress="return validateNumber(event)"></div>';
					$descuentosA.='<div class="col-md-1"><button class="btn btn-danger btn-xs deleteDiscountP" id="agregarDescuentoP" value="" placeholder="Descuento" type="button"><i class="fa fa-times"></i></button></div>';
				}
				$descuentosA.='</div>';
				$i++;
				
			}
			
			if(!$descuentosA)
			{
				$descuentosA.='<div class="form-group">';
				$descuentosA.='<label class="col-sm-2 control-label">Descuento</label>';
				$descuentosA.='<div class="col-sm-2 "><input class="form-control discountP" id="descuentoP" name="descuentoP[]" value="" type="text" onkeypress="return validateNumber(event)"></div>';
				$descuentosA.='<div class="col-md-1"><button class="btn btn-primary btn-xs" id="agregarDescuentoP" value="" placeholder="Descuento" type="button"><i class="fa fa-plus"></i></button></div>';
				$descuentosA.='</div>';
			}
			echo $descuentosA;
			?>
            
            
            
            <div id="newDiscountP"></div>
            <div class="form-group">
            <label class="col-sm-2 control-label">Precio P&uacute;blico con Descuento</label>
			<div class="col-sm-2 "><input type="text" class="form-control" id="precioPD" name="precioPD" onkeypress="return validateCantidad(event)" readonly="readonly" value="<?php echo $datos[0]['producto_price_public_discount'];?>"></div>
            </div>
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Precio P&uacute;blico Minimo</label>
			<div class="col-sm-2 "><input type="text" class="form-control" id="precioPM" name="precioPM" onkeypress="return validateCantidad(event)" value="<?php echo $datos[0]['producto_price_public_min'];?>"></div>
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
            
            
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Conjunto</label>
			<div class="col-sm-2 ">
				<input type="checkbox" name="conjunto" id="conjunto" value="1" <?php echo $checked;?>>
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
            
            <div class="form-group">
			<div class="col-sm-6 col-sm-offset-2" align="right"><br>
			<button class="btn btn-danger btn-xs" id="cancelar" type="button">Cancelar</button>&nbsp;&nbsp;&nbsp;&nbsp;
			<button class="btn btn-primary btn-xs" id="guardar" type="button">Guardar Producto</button>
			</div>
			</div>
        
		</form>
	</div>

<script src="<?php echo $raizProy?>js/plugins/toastr/toastr.min.js"></script>

<script src="<?php echo $raizProy?>js/plugins/chosen/chosen.jquery.js"></script>
<script src="<?php echo $raizProy?>js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
<script src="<?php echo $raizProy?>js/plugins/easy-autocomplete/jquery.easy-autocomplete.min.js"></script>

<script>

$(document).ready(function()
{
	var loadimg=function()
	{
		var id_producto=$("#id_producto").val();	
		
		$.getJSON("images.php?t=g&id="+id_producto,function(result)
		{
			var img='<div id="blueimp-gallery" class="blueimp-gallery">	            <div class="slides"></div><h3 class="title"></h3><a class="prev">Prev.</a>	            <a class="next">Sig.</a><a class="close">x</a><a class="play-pause"></a>	            <ol class="indicator"></ol></div>';
			
	        $.each(result, function(i, field)
			{
	    		img+='<div class="infont col-md-3 col-sm-4"><a data-gallery="" title="Image from Unsplash" href="'+field.imagen_route+'"><img src="'+field.imagen_route+'" width="75" height="75"></a><a href="#" data-img="'+field.imagen_id+'" class="img_delete"><i class="fa fa-trash-o"></i></a></div>';
	        	
	        });
	        
        	$("#gallery").html(img);

	    });
	}
	
	loadimg();
	

	$(document).on('click', "a.img_delete", function()
	{
		var r=confirm("\u00BFDesea continuar?");

    	if(r==true)
    	{
			var id_img=$(this).attr('data-img');
			var id_producto=$("#id_producto").val();

			$.ajax
			({
				type: "POST",
				url: "images.php",
				data: {t:'d',id:id_producto,id_i:id_img},
				dataType: "text/html",
				complete: function(data)
				{
					loadimg();
				},
				failure: function(errMsg)
				{
					alert(errMsg);
				}
			});
    	}
	});
	
	
	$('.add_more').click(function(e){
        e.preventDefault();
        $(this).before('<input name="upload[]" type="file" id="upload" accept="image/*"/>');
    });
    
	toastr.options=
	{
		  "closeButton": true,
		  "debug": false,
		  "progressBar": true,
		  "preventDuplicates": false,
		  "positionClass": "toast-top-right",
		  "onclick": null,
		  "showDuration": "400",
		  "hideDuration": "1000",
		  "timeOut": "7000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
	}
	
	$("#nombre").focus();

	$( "#guardar" ).click(function()
	{
		var tipo_producto=$("#tipo_producto").val();
		var bandera=false;
		
    	$.each($('.products'), function (index, value)
    	{
    		var id=$(value).val();
    		bandera=true;
    	});	
		
		if($("#sku").val()=='')
		{
			toastr.error('Debe de agregar el SKU del producto');
			$("#sku").val('');
			$("#sku").focus();		
		}
		else if($("#nombre").val()=='')
		{
			toastr.error('Debe de agregar un Nombre');
			$("#nombre").val('');
			$("#nombre").focus();		
		}
		else if($("#descripcion").val()=='' && (tipo_producto=='U' || tipo_producto=='P'))
		{
			toastr.error('Debe de agregar una breve Descripci\u00F3n');
			$("#descripcion").val('');
			$("#descripcion").focus();
		}
		else if($("#color").val()==undefined && (tipo_producto=='U' || tipo_producto=='V'))
		{
			toastr.error('Debe de agregar un Color');
			$("#color").val('');
			$("#color").focus();		
		}
		else if($("#material").val()==undefined && (tipo_producto=='U' || tipo_producto=='V'))
		{
			toastr.error('Debe de agregar un tipo de Material');
			$("#material").val('');
			$("#material").focus();		
		}
		else if($("#categoria").val()==undefined && (tipo_producto=='U' || tipo_producto=='P'))
		{
			toastr.error('Debe de agregar un tipo de Categoria');
			$("#categoria").val('');
			$("#categoria").focus();		
		}
		else if($("#proveedor").val()=='')
		{
			toastr.error('Debe de agregar un Proveedor');
			$("#proveedor").val('');
			$("#proveedor").focus();
		}
		else if($("#precioU").val()=='' && (tipo_producto=='U' || tipo_producto=='V'))
		{
			toastr.error('Debe de agregar el Precio Utilitario del producto');
			$("#precioU").val('');
			$("#precioU").focus();		
		}
		else if($("#precioP").val()=='' && (tipo_producto=='U' || tipo_producto=='V'))
		{
			toastr.error('Debe de agregar el Precio P\u00FAblico');
			$("#precioU").val('');
			$("#precioU").focus();		
		}
		else if($('#conjunto').is(":checked") && bandera==false)
        {
			toastr.error('Debe de agregar un producto para armar el Conjunto');
			$("#producto").val('');
			$("#producto").focus();
        }
		else if(tipo_producto=='V' && $("#producto_padre_id").val()==0)
		{
			toastr.error('Debe de agregar un producto padre para la variación');
			$("#producto_padre").val('');
			$("#producto_padre").focus();
		}
		else
		{
			var url="actualizar_producto.php";
	
			var formData = new FormData($("#form_productos")[0]);
	
		    $.ajax({
		        url: url,
		        type: 'POST',
		        data: formData,
		        async: false,
		        success: function (data)
		        {
		        	var producto_id=$("#id_producto").val();
		        	
			        if($('#conjunto').is(":checked"))
			        {
				        var url="guardar_conjunto.php?id="+producto_id;
				        var products=new Array();
				        
				        $.each($('.products'), function (index, value)
		            	{
				        	var p={};
				        	var id=$(value).val();
				        	var cantidad=$("#cantidad_"+id).val();
				        	p.id=id;
				        	p.cantidad=cantidad;
				        	products.push(p);
		            	});	

				        var jsonProducts=JSON.stringify(products);
				        
			        	$.ajax({
					        url: url,
					        type: 'POST',
					        data:  jsonProducts,
					        contentType: "application/json; charset=utf-8",
					        async: false,
					        dataType: "json",
					        success: function (data)
					        {
					        	alert("El Producto ha sido actualizado");
					            var url="index.php";
					    		$(location).attr("href", url);
					        },
					        cache: false,
					        contentType: false,
					        processData: false
					    });
			        }
			        else
			        {
			        	alert("El Producto ha sido actualizado");
			            var url="index.php";
			    		$(location).attr("href", url);
			        }
		        },
		        cache: false,
		        contentType: false,
		        processData: false
		    });

		    
		}
		
	});
	
	$( "#cancelar" ).click(function()
	{
		var url="index.php";
		$(location).attr("href", url);
	});

	$('#sku').keyup(function()
	{
    	this.value = $.trim(this.value.toLocaleUpperCase());
    });

	$('#conjunto').change(function()
	{
		$(".easy-autocomplete").css("width","auto");
        if($(this).is(":checked"))
        {
        	$("#div_conjunto").fadeIn();
        	$("#producto").focus();
        }
        else
        {
        	$("#div_conjunto").fadeOut();
        }
    });

	var options=
	{
		url: "get_products_unique.php",
		getValue: function(element)
		{
			var name=element.producto_sku+' '+element.producto_name;
			
			return name;
		},
		template: {
			type: "custom",
			method: function(value, item) {
				return "<img src='" + item.imagen + "' height='50' width='50'/>"+ value;
			}
		},
		list:
		{
			match:
			{
				enabled: true
			},
			showAnimation:
			{
				type: "fade", //normal|slide|fade
				time: 400,
				callback: function() {}
			},
			hideAnimation: {
				type: "slide", //normal|slide|fade
				time: 400,
				callback: function() {}
			},
			onChooseEvent:function()
			{
				var id=$("#producto").getSelectedItemData().producto_id;
				var sku=$("#producto").getSelectedItemData().producto_sku;
				var name=$("#producto").getSelectedItemData().producto_name;
				var imagen=$("#producto").getSelectedItemData().imagen;
				
				SelectedItemData(id,sku,name,imagen);
			}
		}
	};

	var SelectedItemData=function(id,sku,name,imagen)
	{
		var table='';

		var product=$("#product_"+id).val();

		if(product==undefined)
		{
			table+='<tr>';
			table+='<input type="hidden" id="product_'+id+'" name="product_'+id+'" value="'+id+'" class="products">';
			
			if(imagen!='')
			{
				imagen='<img src="'+imagen+'" height="50" width="50">';
			}
			
			table+='<td>'+imagen+'</td>';
			table+='<td><input id="cantidad_'+id+'" value="1" size="3" onkeypress="return validateNumber(event)"></td>';
			table+='<td>'+sku+'</td>';
			table+='<td>'+name+'</td>';
			table+='<td class="text-left"><a id="delete_'+id+'" href="#" onCLick="deleteRow(this.id);"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>';
			table+='</tr>';			
	
			$('#products_table').append(table);
	
			$("#producto").focus();
			$("#producto").val('');
			$("#product_list").fadeIn();
		}
		else
		{
			$("#producto").focus();
			$("#producto").val('');
			alert("El producto ya ha sido agregado");
		}
	}

	$("#producto").easyAutocomplete(options);

	$("#color").chosen();
	$("#material").chosen();
	$("#categoria").chosen();
	$("#proveedor").chosen();

	var calculateDiscount=function()
	{
		var precio_utilitario=$("#precioU").val();
		precio_utilitario=parseFloat(precio_utilitario);
		precio_utilitario=precio_utilitario.toFixed(2);
		
		var precioUD=precio_utilitario;
		var bandera=0;
		
		$("input[name='descuento[]']").each(function()
		{        
			if($(this).val()!='' || $(this).val()!=0)
			{
				var discount=$(this).val()/100;
				discount=parseFloat(discount);
				discount=discount.toFixed(2);
				precioUD=parseFloat(precioUD-(discount*precioUD));
				bandera=1;
			}
		}); 

		if(bandera==0)
		{
			$("#precioUD").val($("#precioU").val());
		}
		else
		{
			precioUD=parseFloat(precioUD);
			precioUD=precioUD.toFixed(2);
			
			$("#precioUD").val(precioUD);
		}
	};
	
	
	var validateDiscount=function(discount)
	{
		if($("#precioU").val()=='' || $("#precioU").val()==0)
		{
			discount.val('');
			$("#precioU").val('');
			$("#precioUD").val('');
			$("#precioU").focus();
			alert("Debe de agregar primero el Precio Unitario");
		}
		else if(discount.val()>=100)
		{
			discount.val('');
			discount.focus();
			alert("Descuento Invalido");
			$("#precioUD").val($("#precioU").val());
			calculateDiscount();
		}
		else
		{
			calculateDiscount();
		}
	};
	
	$("#agregarDescuento").click(function()
	{
		if($("#descuento").val()!='')
		{
	        $("#newDiscount").append('<div class="form-group"><label class="col-sm-2 control-label"></label><div class="col-sm-2 "><input class="form-control discount" id="descuento" name="descuento[]" value="" type="text" onkeypress="return validateNumber(event)"></div><div class="col-md-1">                                <button class="btn btn-danger btn-xs deleteDiscount" id="agregarDescuento" value="" placeholder="Descuento" type="button"><i class="fa fa-times"></i></button></div></div>');
	
	        $(".deleteDiscount").click(function(){            
	            $(this).parent().parent().remove();
	            calculateDiscount();
	        });
	        
	        $(".discount").keyup(function()
	        {
	        	validateDiscount($(this));
	        });  
		}
		else
		{
			$("#descuento").val('');
			$("#descuento").focus();
			alert("Debe de agregar primero un Descuento");
		}
     });

	$(".deleteDiscount").click(function(){            
        $(this).parent().parent().remove();
        calculateDiscount();
    });

	$(".discount").keyup(function()
	{
		validateDiscount($(this));    	
    });

	$("#precioU").keyup(function()
	{
		$("#precioUD").val($(this).val());
		calculateDiscount();    	
    });

	var remove_accent=function(str)
    {
    	var map={'À':'A','Á':'A','Â':'A','Ã':'A','Ä':'A','Å':'A','Æ':'AE','Ç':'C','È':'E','É':'E','Ê':'E','Ë':'E','Ì':'I','Í':'I','Î':'I','Ï':'I','Ð':'D','Ñ':'N','Ò':'O','Ó':'O','Ô':'O','Õ':'O','Ö':'O','Ø':'O','Ù':'U','Ú':'U','Û':'U','Ü':'U','Ý':'Y','ß':'s','à':'a','á':'a','â':'a','ã':'a','ä':'a','å':'a','æ':'ae','ç':'c','è':'e','é':'e','ê':'e','ë':'e','ì':'i','í':'i','î':'i','ï':'i','ñ':'n','ò':'o','ó':'o','ô':'o','õ':'o','ö':'o','ø':'o','ù':'u','ú':'u','û':'u','ü':'u','ý':'y','ÿ':'y','Ā':'A','ā':'a','Ă':'A','ă':'a','Ą':'A','ą':'a','Ć':'C','ć':'c','Ĉ':'C','ĉ':'c','Ċ':'C','ċ':'c','Č':'C','č':'c','Ď':'D','ď':'d','Đ':'D','đ':'d','Ē':'E','ē':'e','Ĕ':'E','ĕ':'e','Ė':'E','ė':'e','Ę':'E','ę':'e','Ě':'E','ě':'e','Ĝ':'G','ĝ':'g','Ğ':'G','ğ':'g','Ġ':'G','ġ':'g','Ģ':'G','ģ':'g','Ĥ':'H','ĥ':'h','Ħ':'H','ħ':'h','Ĩ':'I','ĩ':'i','Ī':'I','ī':'i','Ĭ':'I','ĭ':'i','Į':'I','į':'i','İ':'I','ı':'i','Ĳ':'IJ','ĳ':'ij','Ĵ':'J','ĵ':'j','Ķ':'K','ķ':'k','Ĺ':'L','ĺ':'l','Ļ':'L','ļ':'l','Ľ':'L','ľ':'l','Ŀ':'L','ŀ':'l','Ł':'L','ł':'l','Ń':'N','ń':'n','Ņ':'N','ņ':'n','Ň':'N','ň':'n','ŉ':'n','Ō':'O','ō':'o','Ŏ':'O','ŏ':'o','Ő':'O','ő':'o','Œ':'OE','œ':'oe','Ŕ':'R','ŕ':'r','Ŗ':'R','ŗ':'r','Ř':'R','ř':'r','Ś':'S','ś':'s','Ŝ':'S','ŝ':'s','Ş':'S','ş':'s','Š':'S','š':'s','Ţ':'T','ţ':'t','Ť':'T','ť':'t','Ŧ':'T','ŧ':'t','Ũ':'U','ũ':'u','Ū':'U','ū':'u','Ŭ':'U','ŭ':'u','Ů':'U','ů':'u','Ű':'U','ű':'u','Ų':'U','ų':'u','Ŵ':'W','ŵ':'w','Ŷ':'Y','ŷ':'y','Ÿ':'Y','Ź':'Z','ź':'z','Ż':'Z','ż':'z','Ž':'Z','ž':'z','ſ':'s','ƒ':'f','Ơ':'O','ơ':'o','Ư':'U','ư':'u','Ǎ':'A','ǎ':'a','Ǐ':'I','ǐ':'i','Ǒ':'O','ǒ':'o','Ǔ':'U','ǔ':'u','Ǖ':'U','ǖ':'u','Ǘ':'U','ǘ':'u','Ǚ':'U','ǚ':'u','Ǜ':'U','ǜ':'u','Ǻ':'A','ǻ':'a','Ǽ':'AE','ǽ':'ae','Ǿ':'O','ǿ':'o'};
    	var res='';
    	for(var i=0;i<str.length;i++)
        {
            c=str.charAt(i);
            res+=map[c]||c;
		}

		return res;
    };

	var getCode=function()
	{
		var letter=['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','X','Y','Z'];
		var num=Math.floor(Math.random()*9)+1;
		var letter_code=letter[Math.floor(Math.random()*9)+1];

		var code=letter_code+num;

		return code;
	};
    
	var get_sku=function()
	{
		var mod=$("#nombre").val().toUpperCase().split(' ');
		var modelo='';
		var sku='';
		
		for(var i=0;i<mod.length;i++)
		{
	    	if(mod[i]!='')
	    	{
				modelo=mod[i];
	    	}
	    }
				
		modelo=$.trim(modelo);
		modelo=modelo.substring(3,0);
				
		sku=modelo;

		var selected=$("#color").find('option:selected');
    	var color_abrev=selected.data('abrev');
		
    	if(color_abrev!='')
    	{
        	if(sku=='')
        	{
    			sku+=color_abrev;
        	}
        	else
        	{
        		sku+='-'+color_abrev;
        	}
    	}

    	var selected=$("#material").find('option:selected');
    	var material_abrev=selected.data('abrev');
		
    	if(material_abrev!='')
    	{
        	if(sku=='')
        	{
    			sku+=material_abrev;
        	}
        	else
        	{
        		sku+='-'+material_abrev;
        	}
    	}

    	code=$("#code").val();

		if(code=='')
		{
			code=getCode();
			$("#code").val(code);		
		}

		if(sku=='')
		{
			sku=code;
		}
		else
		{
			sku+='-'+code;
		}
		$("#sku").val(sku);
    	/*if(abrev!='')
    	{
	    	if(sku=='')
	    	{
				sku+=abrev;
	    	}
	    	else
	    	{
				sku+='-'.abrev;
	    	}
    	}

    	var selected=$("#material").find('option:selected');
    	var abrev=selected.data('abrev');
		
    	if(abrev!=undefined)
    	{
	    	if(sku=='')
	    	{
				sku+=abrev;
	    	}
	    	else
	    	{
				sku+='-'.abrev;
	    	}
    	}
    	
	    

	    $("#sku").val(sku);*/
	};

    $("#color").change(function()
    {
    	get_sku();
    });

    $("#material").change(function()
	{
    	get_sku();
    });

	$('#nombre').keyup(function()
	{
		get_sku();
    });

	$('#manual').change(function()
	{
		if($(this).is(":checked"))
		{
			$("#sku").val('');
			$("#sku").prop('readonly',false);
			$("#sku").focus();			
		}
		else
		{
			$("#sku").prop('readonly',true);
			get_sku();
		}
	});


	var calculateDiscountP=function()
	{
		var precio_utilitario=$("#precioP").val();
		precio_utilitario=parseFloat(precio_utilitario);
		precio_utilitario=precio_utilitario.toFixed(2);
		
		var precioUD=precio_utilitario;
		var bandera=0;
		
		$("input[name='descuentoP[]']").each(function()
		{        
			if($(this).val()!='' || $(this).val()!=0)
			{
				var discount=$(this).val()/100;
				discount=parseFloat(discount);
				discount=discount.toFixed(2);
				precioUD=parseFloat(precioUD-(discount*precioUD));
				bandera=1;
			}
		}); 

		if(bandera==0)
		{
			$("#precioPD").val($("#precioP").val());
		}
		else
		{
			precioUD=parseFloat(precioUD);
			precioUD=precioUD.toFixed(2);
			
			$("#precioPD").val(precioUD);
		}
	};

	var validateDiscountP=function(discount)
	{
		if($("#precioP").val()=='' || $("#precioP").val()==0)
		{
			discount.val('');
			$("#precioP").val('');
			$("#precioPD").val('');
			$("#precioP").focus();
			alert("Debe de agregar primero el Precio Público");
		}
		else if(discount.val()>=100)
		{
			discount.val('');
			discount.focus();
			alert("Descuento Invalido");
			$("#precioPD").val($("#precioP").val());
			calculateDiscountP();
		}
		else
		{
			calculateDiscountP();
		}
	};
	
	$("#agregarDescuentoP").click(function()
	{
		if($("#descuentoP").val()!='')
		{
			$("#newDiscountP").append('<div class="form-group"><label class="col-sm-2 control-label"></label><div class="col-sm-2 "><input class="form-control discountP" id="descuentoP" name="descuentoP[]" value="" type="text" onkeypress="return validateNumber(event)"></div><div class="col-md-1">                                <button class="btn btn-danger btn-xs deleteDiscountP" id="agregarDescuentoP" value="" placeholder="Descuento" type="button"><i class="fa fa-times"></i></button></div></div>');
			
			$(".deleteDiscountP").click(function(){            
				$(this).parent().parent().remove();
			    calculateDiscountP();
			});
			        
			$(".discountP").keyup(function()
			{
				validateDiscountP($(this));
			});  
		}
		else
		{
			$("#descuentoP").val('');
			$("#descuentoP").focus();
			alert("Debe de agregar primero un Descuento");
		}
	});
	
	$(".discountP").keyup(function()
	{
		validateDiscountP($(this));    	
	});

	$("#precioP").keyup(function()
	{
		$("#precioPD").val($(this).val());
		calculateDiscountP();    	
	});

});

function validateCantidad(evt)
{
	evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
	
	
    if ((charCode > 31 && (charCode < 48 || charCode > 57) && charCode!=46))
	{
        return false;
    }
}

function validateNumber(evt)
{
	evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
}

function deleteRow(td)
{
	$("#"+td).parent().parent().remove();

	var bandera=false;
	$.each($('.products'), function (index, value)
	{
		var id=$(value).val();
		bandera=true;
	});
	
	if(bandera==false)
	{
		$("#product_list").fadeOut();
	}
	
	$("#producto").val('');
	$("#producto").focus();
}

</script>


   

<?php
    include $pathProy.'footer.php';
?>