<?php
	include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
	require_once($_SERVER["REDIRECT_PATH_CONFIG"].'clientes/models/class.Clientes.php');
   // include $pathProy.'login/session.php';
    include $pathProy.'/header.php';
    include $pathProy.'/menu.php';
?>
<link href="<?php echo $raizProy?>css/plugins/easy-autocomplete/easy-autocomplete.min.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="../css/clientes.css">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Ventas</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">Ventas</a>
                </li>
                <li class="active">
                    <strong>Punto de Venta</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <!-- <div class="title-action">
                <a href="./nuevo_cliente.php" class="btn btn-primary btn-xs">Nuevo Cliente</a>
                <a href="#" id="rating" data-toggle="modal" data-target="#ratingModal" class="btn btn-primary btn-xs">Configurar Rating</a>
            </div>-->
            
        </div>
    </div>
    
  
        <div class="wrapper wrapper-content animated fadeInRight">

			<div class="row">
                <div class="col-lg-12">
                <div class="ibox">
               <div class="ibox-title">
				<span class="pull-right"></span>
                <h5>Productos</h5>
                </div>
                <div class="ibox-content">
                <input type="text" class="form-control" id="producto" name="producto">
                </div>
                </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-9">

                    <div class="ibox">
                        <div class="ibox-title">
                            <span class="pull-right">Prductos Agregados (<strong>5</strong>)</span>
                            <h5>Productos Agregados:</h5>
                        </div>
                    <div id="productos">
                       
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table shoping-cart-table">
                                    <tbody>
                                    <tr>
                                        <td width="90">
                                            <div class="cart-product-imitation">
                                            </div>
                                        </td>
                                        <td class="desc">
                                            <h3>
                                            <a href="#" class="text-navy">
                                                Desktop publishing software
                                            </a>
                                            </h3>
                                            <p class="small">
                                                It is a long established fact that a reader will be distracted by the readable
                                                content of a page when looking at its layout. The point of using Lorem Ipsum is
                                            </p>
                                            <dl class="small m-b-none">
                                                <!-- <dt>Description lists</dt>
                                                <dd>A description list is perfect for defining terms.</dd>-->
                                            </dl>

                                            <div class="m-t-sm">
                                                <!-- <a href="#" class="text-muted"><i class="fa fa-gift"></i> Add gift package</a>
                                                |-->
                                                <a href="#" class="text-muted"><i class="fa fa-trash"></i> Quitar Producto</a>
                                            </div>
                                        </td>

                                        <td>
                                            $180,00
                                            <s class="small text-muted">$230,00</s>
                                        </td>
                                        <td width="65">
                                            <input type="text" class="form-control" placeholder="1">
                                        </td>
                                        <td>
                                            <h4>
                                                $180,00
                                            </h4>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
						</div>
					</div>
                        
                        
                        
                        <div class="ibox-content">

                            <!-- <button class="btn btn-primary pull-right"><i class="fa fa fa-shopping-cart"></i> Checkout</button>-->
							<button class="btn btn-white"><i class="fa fa-arrow-left"></i> Continuar Comprando</button>

                        </div>
                    </div>

                </div>
                <div class="col-md-3">

                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Resumen de Venta</h5>
                        </div>
                        <div class="ibox-content">
                            <span>
                                Total
                            </span>
                            <h2 class="font-bold">
                                $390,00
                            </h2>

                            <hr/>
                            <span class="text-muted small">
                                <!--*For United States, France and Germany applicable sales tax will be applied-->
                            </span>
                            <div class="m-t-sm">
                                <div class="btn-group">
                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i> Aceptar</a>
                                <a href="#" class="btn btn-white btn-sm"> Cancelar</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                </div>
            </div>




        </div>
<script src="<?php echo $raizProy?>js/plugins/toastr/toastr.min.js"></script>
<script src="<?php echo $raizProy?>js/plugins/easy-autocomplete/jquery.easy-autocomplete.min.js"></script>    


    <!-- Page-Level Scripts -->
<script>
$(document).ready(function()
{
	setTimeout(function()
	{
		$("#producto").focus();
	},0);
	
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
});

</script>


<?php
    include $pathProy.'footer.php';
?>