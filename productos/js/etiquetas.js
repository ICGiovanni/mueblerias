$(document).ready(function()
{	
	var options=
	{
		url: "get_products_inventary.php",
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
		adjustWidth: false,
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
				var id=$("#producto_etiqueta").getSelectedItemData().producto_id;
				var sku=$("#producto_etiqueta").getSelectedItemData().producto_sku;
				var name=$("#producto_etiqueta").getSelectedItemData().producto_name;
				var imagen=$("#producto_etiqueta").getSelectedItemData().imagen;
				
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
	
			$("#producto_etiqueta").focus();
			$("#producto_etiqueta").val('');
			$("#product_list").fadeIn();
		}
		else
		{
			$("#producto_etiqueta").focus();
			$("#producto_etiqueta").val('');
			alert("El producto ya ha sido agregado");
		}
	}

	$("#producto_etiqueta").easyAutocomplete(options);
	$("#producto_etiqueta").focus();
	
	$( "#guardar" ).click(function()
	{
		var bandera=false;
		
		$.each($('.products'), function (index, value)
    	{
    		var id=$(value).val();
    		bandera=true;
    	});
		
		if($("#inicio").val()=='')
		{
			toastr.error('Debe de agregar la posición inicial');
			$("#inicio").val('');
			$("#inicio").focus();
		}
		else if(!bandera)
		{
			toastr.error('Debe de agregar al menos un producto');
			$("#producto_etiqueta").val('');
			$("#producto_etiqueta").focus();
		}
		else
		{
			var pos=$("#inicio").val();
			var url="imprimir_etiquetas.php?pos="+pos;
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
		        	swal(
		        	{
		        		title: "Guardado!",
		        		text: "Etiquetas generadas correctamente!",
		                type: "success"
		            },
		            function ()
		            {
		            	window.location.href = 'etiquetas.php';
		            	window.open('barcodes.pdf','_blank');
		            });
			       
		        },
		        cache: false,
		        contentType: false,
		        processData: false
		    });
		}
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
	
	$("#producto_etiqueta").val('');
	$("#producto_etiqueta").focus();
}

function validateNumber(evt)
{
	evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
}