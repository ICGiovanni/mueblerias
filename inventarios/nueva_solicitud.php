<?php 
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'inventarios/models/class.Inventarios.php');
$inventarios=new Inventarios();
?>

<div class="wrapper wrapper-content animated fadeInRight">
	<form method="post" class="form-horizontal" action="/" id="form_productos" enctype="multipart/form-data">

	<div class="form-group">
        <label class="col-sm-2 control-label">Entrada</label>
		<div class="col-sm-6" >
			<select data-placeholder="Selecciona una entrada" class="chosen-select" style="width:300px;" tabindex="4" id="entrada" name="entrada">
	        <option value=""></option>
	        <option value="0">Proveedor</option>
	        <?php 
				
            $result=$inventarios->GetSucursales();
           
            $list="";
            foreach($result as $r)
            {
            	$list.='<option value="'.$r['sucursal_id'].'">'.$r['sucursal_name'].'</option>';
            }
            
            echo $list;
	            
			?>
			</select>
		</div>
	</div>
	
	<div class="form-group">
        <label class="col-sm-2 control-label">Destino</label>
		<div class="col-sm-6" >
			<select data-placeholder="Selecciona un Destino" class="chosen-select" style="width:300px;" tabindex="4" id="destino" name="destino">
	        <option value=""></option>
	        <?php 
				
            $result=$inventarios->GetSucursales();
           
            $list="";
            foreach($result as $r)
            {
            	$list.='<option value="'.$r['sucursal_id'].'">'.$r['sucursal_name'].'</option>';
            }
            
            echo $list;
	            
			?>
			</select>
		</div>
	</div>
            
	<div class="form-group">
	<label class="col-sm-2 control-label">Productos</label>
    <div class="col-sm-7" ><input type="text" class="form-control" id="producto" name="producto"></div>
    </div>
    <div class="form-group">
	           	
	           	<div class="col-sm-12" >
	           	<div id="product_list" class="ibox-content" style="display:none;">
	           	
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
	<input type="hidden" class="form-control" id="producto_id" name="producto_id">		            
    </form>
</div>
<script>
$(document).ready(function()
{
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
	};
	
	var options=
	{
		url: "../productos/get_products_unique.php",
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

	
	$('#modal_nuevo_inventario').on('shown.bs.modal', function () {
		$("#products_table").html('');
		$("#entrada").chosen();
		$("#destino").chosen();
		$('.chosen-select', this).chosen('destroy').chosen();
		$("#producto").easyAutocomplete(options);
	});
});

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