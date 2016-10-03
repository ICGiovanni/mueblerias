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
$colores=$productos->GetProductColor($producto_id);
$materiales=$productos->GetProductMaterial($producto_id);
$categorias=$productos->GetProductCategory($producto_id);

$checked="";
if($datos[0]["type"]=='C')
{
	$checked="checked";	
}


?>
    <div class="wrapper wrapper-content animated fadeInRight">
		<form method="post" class="form-horizontal" action="/" id="form_productos" enctype="multipart/form-data">
			<input type="hidden" class="form-control" id="id_producto" name="id_producto" value="<?php echo $datos[0]["producto_id"]?>">
			
			<div class="form-group"><label class="col-sm-2 control-label">ID</label>
			<div class="col-sm-6"><label class="col-sm-2 control-label"><?php echo $datos[0]["producto_id"]?></label></div>
            </div>
			<div class="form-group">
            <label class="col-sm-2 control-label">SKU</label>
			<div class="col-sm-2 "><input type="text" class="form-control" id="sku" name="sku" value="<?php echo $datos[0]['producto_sku'];?>"></div>
            </div>
			<div class="form-group"><label class="col-sm-2 control-label">Nombre</label>
			<div class="col-sm-6" ><input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $datos[0]['producto_name'];?>"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Descripci&oacute;n</label>
			<div class="col-sm-6" ><textarea class="form-control" id="descripcion" name="descripcion"><?php echo $datos[0]['producto_description'];?></textarea></div>
            </div>
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Colores</label>
			<div class="col-sm-6" >
				<select data-placeholder="Selecciona un color" class="chosen-select" multiple style="width:300px;" tabindex="4" id="color" name="color[]">
	            <option value=""></option>
	            <?php 
	            $productos=new Productos();
	            
	            $result=$productos->GetColors();
	            
	            $list="";
	            foreach($result as $r)
	            {
	            	if(isset($colores[$r['color_id']]))
	            	{
	            		$list.='<option value="'.$r['color_id'].'" selected="">'.$r['color_name'].'</option>';
	            	}
	            	else
	            	{
	            		$list.='<option value="'.$r['color_id'].'">'.$r['color_name'].'</option>';
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
				<select data-placeholder="Selecciona un material" class="chosen-select" multiple style="width:300px;" tabindex="4" id="material" name="material[]">
	            <option value=""></option>
	            <?php 
	            $productos=new Productos();
	            
	            $result=$productos->GetMaterials();
	            
	            $list="";
	            foreach($result as $r)
	            {
	            	if(isset($materiales[$r['material_id']]))
	            	{
	            		$list.='<option value="'.$r['material_id'].'" selected="">'.$r['material_name'].'</option>';
	            	}
	            	else
	            	{
	            		$list.='<option value="'.$r['material_id'].'">'.$r['material_name'].'</option>';
	            	}
	            }
	            
	            echo $list;
	            
	            ?>
				</select>
			</div>
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
            <label class="col-sm-2 control-label">Pecio Utilitario</label>
			<div class="col-sm-2 "><input type="text" class="form-control" id="precioU" name="precioU" onkeypress="return validateCantidad(event)" value="<?php echo $datos[0]['producto_price_utilitarian'];?>"></div>
            </div>
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Precio P&uacute;blico</label>
			<div class="col-sm-2 "><input type="text" class="form-control" id="precioP" name="precioP" onkeypress="return validateCantidad(event)" value="<?php echo $datos[0]['producto_price_public'];?>"></div>
            </div>
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Conjunto</label>
			<div class="col-sm-2 ">
				<input type="checkbox" name="conjunto" id="conjunto" value="activo" <?php echo $checked;?>>
			</div>
            </div>
			<div id="div_conjunto" <?php $checked=='U' ? 'style="display:none;"' : ""?>>
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
			<button class="btn btn-primary btn-xs" id="guardar" type="button">Guardar Cliente</button>
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
	
	$("#sku").focus();

	$( "#guardar" ).click(function()
	{
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
		else if($("#descripcion").val()=='')
		{
			toastr.error('Debe de agregar una breve Descripci\u00F3n');
			$("#descripcion").val('');
			$("#descripcion").focus();
		}
		else if($("#color").val()==undefined)
		{
			toastr.error('Debe de agregar un Color');
			$("#color").val('');
			$("#color").focus();		
		}
		else if($("#material").val()==undefined)
		{
			toastr.error('Debe de agregar un tipo de Material');
			$("#material").val('');
			$("#material").focus();		
		}
		else if($("#categoria").val()==undefined)
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
		else if($('#conjunto').is(":checked") && bandera==false)
        {
			toastr.error('Debe de agregar un producto para armar el Conjunto');
			$("#producto").val('');
			$("#producto").focus();
        }
		else if($("#precioU").val()=='')
		{
			toastr.error('Debe de agregar el Precio Utilitario del producto');
			$("#precioU").val('');
			$("#precioU").focus();		
		}
		else if($("#precioP").val()=='')
		{
			toastr.error('Debe de agregar el Precio P\u00FAblico');
			$("#precioU").val('');
			$("#precioU").focus();		
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
		url: "http://localhost/globmint.com/productos/get_products_unique.php",
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