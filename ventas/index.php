<?php session_start();
    include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
    require_once($_SERVER["REDIRECT_PATH_CONFIG"].'clientes/models/class.Clientes.php');
    // include $pathProy.'login/session.php';
    include $pathProy.'/header.php';
    include $pathProy.'/menu.php';
    
    $numProd = 0;
    $total = 0;
    $subtotal = 0;
    $iva = 0;
    
    if(isset($_SESSION['punto_venta']['Productos'])){
        $puntoVenta = $_SESSION['punto_venta'];
        $numProd = count($puntoVenta['Productos']);
        $total = $puntoVenta['Total'];
        $subtotal = $puntoVenta['Subtotal'];
        $iva = $puntoVenta['IVA'];
        
    }
?>
<link href="<?php echo $raizProy?>css/plugins/easy-autocomplete/easy-autocomplete.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../css/clientes.css">
<style type="text/css">
    #productosVenta td{
        vertical-align: middle;
    }
</style>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Punto de Venta</h2>
        <ol class="breadcrumb">
            <li>
                <a href="">Punto de Venta</a>
            </li>
            <li class="active">
                <strong>Productos</strong>
            </li>
        </ol>
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
                    <span class="pull-right">Prductos Agregados (<strong><?php echo $numProd; ?></strong>)</span>
                    <h5>Productos Agregados:</h5>
                </div>
                <div id="productos">                       
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table shoping-cart-table">
                                <thead>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Modelo</th>
                                        <th style="width: 120px">Precio Unitario</th>
                                        <th style="width: 70px">Cantidad</th>
                                        <th style="width: 120px; text-align: center">Subtotal</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody id="productosVenta">
                                
                                <?php 
                                if(isset($puntoVenta) && is_array($puntoVenta['Productos'])){
                                    foreach($puntoVenta['Productos'] as $prod){
                                        
                                    
                                    echo '  <tr>
                                                <td width="90">
                                                    <div class="cart-product-imitation"></div>
                                                </td>
                                                <td class="desc">
                                                    <h3><a href="#" class="text-navy">'.$prod['Modelo'].'</a></h3>                                                                                                                      
                                                </td>
                                                <td>$ '.number_format($prod['Precio'],2,'.',',').'</td>
                                                <td><input type="text" class="form-control" placeholder="1" value='.$prod['Cantidad'].'></td>
                                                <td><h4>$ '.number_format($prod['Subtotal'],2,'.',',').'</h4></td>
                                                <td><i class="fa fa-trash" role="button"></i></td>                                    
                                            </tr>';
                                    }
                                }
                                ?>                                                                                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
		</div>                        
                <div class="ibox-content">                    
                    <a href="<?php echo $ruta.'proveedores/grid.php'?>" class="btn btn-white"><i class="fa fa-arrow-left"></i>&nbsp;Continuar Comprando</a>
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
                        Subtotal
                    </span>
                    <h2 class="font-bold text-right">
                        $ <?php echo number_format($subtotal,2,'.',',');?>
                    </h2>                    
                    <span>
                        IVA
                    </span>
                    <h2 class="font-bold text-right">
                        $ <?php echo number_format($iva,2,'.',',');?>
                    </h2>                    
                    <span>
                        Total
                    </span>
                    <h2 class="font-bold text-right">
                        $ <?php echo number_format($total,2,'.',',');?>
                    </h2>
                    <hr/>
                    
                    <div class="m-t-sm">
                        <a href="#" class="btn btn-warning btn-md"><i class="fa fa-shopping-cart"></i>&nbsp;Apartar</a>&nbsp;                            
                        <a href="<?php echo $ruta.'punto_venta'?>" class="btn btn-primary btn-md"><i class="fa fa-shopping-cart"></i>&nbsp;Pagar</a>                        
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