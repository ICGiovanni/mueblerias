<?php
    include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
    //include $pathProy.'login/session.php';
    require_once($_SERVER["REDIRECT_PATH_CONFIG"].'productos/models/class.Productos.php');
    require_once($_SERVER["REDIRECT_PATH_CONFIG"].'proveedores/models/class.Proveedores.php');
    include $pathProy.'/header.php';
    include $pathProy.'/menu.php';
?>
<link href="<?php echo $raizProy?>css/plugins/chosen/chosen.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/easy-autocomplete/easy-autocomplete.min.css" rel="stylesheet">

<style>
#product_list
{
	display:none;
}
#div_conjunto
{
	display:none;
}
</style>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Agregar Producto</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">Productos</a>
                </li>
                <li class="active">
                    <strong>Agregar Producto</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="./index.php" class="btn btn-danger btn-xs"><i class="fa fa-arrow-left"></i> Regresar a listado</a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
		<form method="post" class="form-horizontal" action="/" id="form_productos" enctype="multipart/form-data">
			<div class="form-group">
            <label class="col-sm-2 control-label">SKU</label>
			<div class="col-sm-2 "><input type="text" class="form-control" id="sku" name="sku"></div>
            </div>
			<div class="form-group"><label class="col-sm-2 control-label">Modelo</label>
			<div class="col-sm-6" ><input type="text" class="form-control" id="nombre" name="nombre"></div>
            </div>
            <div class="form-group">
            <label class="col-sm-2 control-label">Version</label>
			<div class="col-sm-2 "><input type="text" class="form-control" id="version" name="version"></div>
			</div>
			
			<div class="form-group">
            <label class="col-sm-2 control-label">Medida</label>
			<div class="col-sm-2 "><input type="text" class="form-control" id="medida" name="medida"></div>
			</div>
            <div class="form-group"><label class="col-sm-2 control-label">Descripci&oacute;n</label>
			<div class="col-sm-6" ><textarea class="form-control" id="descripcion" name="descripcion"></textarea></div>
            </div>
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Colores</label>
			<div class="col-sm-6" >
				<select data-placeholder="Selecciona un color" class="chosen-select" style="width:300px;" tabindex="4" id="color" name="color">
	            <option value=""></option>
	            <?php 
	            $productos=new Productos();
	            
	            $result=$productos->GetColors();
	            
	            $list="";
	            foreach($result as $r)
	            {
	            	$list.='<option value="'.$r['color_id'].'">'.$r['color_name'].'</option>';
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
	            <option value=""></option>
	            <?php 
	            $productos=new Productos();
	            
	            $result=$productos->GetMaterials();
	            
	            $list="";
	            foreach($result as $r)
	            {
	            	$list.='<option value="'.$r['material_id'].'">'.$r['material_name'].'</option>';
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
	            	$list.='<option value="'.$r['categoria_id'].'">'.$r['categoria_name'].'</option>';
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
	            	$list.='<option value="'.$r['proveedor_id'].'">'.$r['proveedor_nombre'].'</option>';
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
            <label class="col-sm-2 control-label">Pecio Utilitario</label>
			<div class="col-sm-2 "><input type="text" class="form-control" id="precioU" name="precioU" onkeypress="return validateNumber(event)"></div>
            </div>
            
            <div class="form-group">
           	<label class="col-sm-2 control-label">Descuento</label>
           	<div class="col-sm-2 "><input class="form-control discount" id="descuento" name="descuento[]" value="" type="text" onkeypress="return validateNumber(event)"></div>
			<div class="col-md-1">                            
                            <button class="btn btn-primary btn-xs" id="agregarDescuento" value="" placeholder="Descuento" type="button"><i class="fa fa-plus"></i></button>
                        </div>    
            </div>
            
            <div id="newDiscount"></div>
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Pecio Utilitario con Descuento</label>
			<div class="col-sm-2 "><input type="text" class="form-control" id="precioUD" name="precioUD" readonly="readonly"></div>
            </div>
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Precio P&uacute;blico</label>
			<div class="col-sm-2 "><input type="text" class="form-control" id="precioP" name="precioP" onkeypress="return validateCantidad(event)"></div>
            </div>
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Conjunto</label>
			<div class="col-sm-2 ">
				<input type="checkbox" name="conjunto" id="conjunto" value="activo">
			</div>
            </div>
			<div id="div_conjunto" style="display:none;">
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
<script src="<?php echo $raizProy?>js/plugins/easy-autocomplete/jquery.easy-autocomplete.min.js"></script>

<script>
$(document).ready(function()
{

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
		else if($('#conjunto').is(":checked") && bandera==false)
        {
			toastr.error('Debe de agregar un producto para armar el Conjunto');
			$("#producto").val('');
			$("#producto").focus();
        }
		else
		{
			var url="guardar_producto.php";
	
			var formData = new FormData($("#form_productos")[0]);
	
		    $.ajax({
		        url: url,
		        type: 'POST',
		        data: formData,
		        async: false,
		        success: function (data)
		        {
			        var producto_id=data;
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
					            alert("El Producto ha sido agregado");
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
			        	alert("El Producto ha sido agregado");
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

	$(".discount").keyup(function()
	{
		validateDiscount($(this));    	
    });

	$("#precioU").keyup(function()
	{
		$("#precioUD").val($(this).val());
		calculateDiscount();    	
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

function validateNumber(evt)
{
	evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
}

</script>


   

<?php
    include $pathProy.'footer.php';
?>