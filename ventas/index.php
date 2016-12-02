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
    
  
<div class="wrapper wrapper-content animated fadeIn">

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
                    
                    <span class="pull-right">Productos Agregados (<strong><?php echo $numProd; ?></strong>)</span>
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
                                        <th role="button" onclick="removeAll()"><i class="fa fa-trash-o"></i> todos</th>
                                    </tr>
                                </thead>
                                <tbody id="productosVenta">
                                
                                <?php 
                                if(isset($puntoVenta) && is_array($puntoVenta['Productos'])){
                                    foreach($puntoVenta['Productos'] as $prod){
                                        
                                    
                                    echo '  <tr id="row_'.$prod['ID'].'">
                                                <td width="90">
                                                    <img src="'.$prod['Imagen'].'" height="80" width="80">
                                                </td>
                                                <td class="desc">
                                                    <h3><a href="#" class="text-navy">'.$prod['Modelo'].'</a></h3>                                                                                                                      
                                                </td>
                                                <td>$ '.number_format($prod['Precio'],2,'.',',').'</td>
                                                <td><input type="text" class="form-control" placeholder="1" value='.$prod['Cantidad'].'></td>
                                                <td><h4>$ '.number_format($prod['Subtotal'],2,'.',',').'</h4></td>
                                                <td><i class="fa fa-trash removeCart" role="button" data-sku="'.$prod['SKU'].'" id="removeCart_'.$prod['ID'].'"></i></td>                                    
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
<script src="<?php echo $raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>
<link href="<?php echo $raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<!-- Page-Level Scripts -->
<script>
$(document).ready(function()
{
    setTimeout(function(){$("#producto").focus();},0);
    
    var options={
            url: "../productos/get_products_sell.php",
            getValue: function(element){
                var name=element.producto_sku+' '+element.producto_name;			
                return name;
            },
            template: {
                type: "custom",
                method: function(value, item) {
                    return "<img src='" + item.imagen + "' height='50' width='50'/>"+ value;
                }
            },
            list:{
                match:{
                    enabled: true
                },
		showAnimation:{
                    type: "fade", //normal|slide|fade
                    time: 400,
                    callback: function() {}
                },
                hideAnimation: {
                    type: "slide", //normal|slide|fade
                    time: 400,
                    callback: function() {}
		},
		onChooseEvent:function(){
                    var id=$("#producto").getSelectedItemData().producto_id;
                    var sku=$("#producto").getSelectedItemData().producto_sku;
                    var name=$("#producto").getSelectedItemData().producto_name;
                    var imagen=$("#producto").getSelectedItemData().imagen;
                    var public_price=$("#producto").getSelectedItemData().producto_price_public;
                    SelectedItemData(id,sku,name,imagen, public_price);
		}
            }
	};

	var SelectedItemData=function(id,sku,name,imagen,price)
	{
		var table='';

		var product=$("#product_"+id).val();

		if(product==undefined)
		{
                        urlImage = '';
                        if(imagen!=''){                            
                            urlImage = imagen;
                            imagen='<img src="'+imagen+'" height="80" width="80">';
			}else{
                            imagen = '<div class="cart-product-imitation"></div>';
                        }
                        
                        table +='   <tr id="row_'+id+'"> '+
                                        '<td width="90">'+imagen+'</td>'+
                                        '<td class="desc">'+
                                            '<h3><a href="#" class="text-navy">'+name+'</a></h3>'+
                                        '</td>'+
                                        '<td>$ '+addCommas(price)+'</td>'+
                                        '<td><input type="text" class="form-control" placeholder="1" value="1"></td>'+
                                        '<td><h4>$ '+addCommas(price)+'</h4></td>'+
                                        '<td><i class="fa fa-trash removeCart" role="button" data-sku="'+sku+'" id="removeCart_'+id+'"></i></td>'+
                                        '</tr>';					
	
			$('#productosVenta').append(table);
	
			$("#producto").focus();
			$("#producto").val('');
			$("#product_list").fadeIn();
                        
                        saveCart(id, sku, name, 1, price,urlImage);
		}
		else
		{
			$("#producto").focus();
			$("#producto").val('');
			alert("El producto ya ha sido agregado");
		}
	}

	$("#producto").easyAutocomplete(options);
        
        $(".removeCart").click(function(){  
            var id = $(this).attr('id');              

            swal({   
                title: "Quitar de punto de venta",   
                text: "Desea quitar el producto del punto de venta",   
                type: "error",   
                showCancelButton: true,   
                closeOnConfirm: true,   
                showLoaderOnConfirm: true
            }, function(){                
                $.ajax({
                    url: "<?php echo $raizProy?>proveedores/ajax/removePuntoVenta.php",
                    type: "post",
                    data: {                        
                        sku : $("#"+id).data('sku')                    
                    },
                    success: function (response) {  
                        //console.log(response);
                        window.location.href = 'index.php';                        
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                       swal("Error, intente nuevamente");
                    }
                });                                                                 
            });
        });
});

function saveCart(id, sku, modelo, cantidad, precio, imagen){

    $.ajax({
        url: "<?php echo $raizProy?>proveedores/ajax/addPuntoVenta.php",
        type: "post",
        data: {
            id: id,
            sku : sku,
            modelo : modelo,
            cantidad : cantidad,
            precio : precio,
            imagen : imagen
        },
        success: function (response) {                        
            console.log(response);
            /*swal({
                title: "Actualizado!",
                text: "Producto agregado correctamente!",
                type: "success"
            });*/            
        },
        error: function(jqXHR, textStatus, errorThrown) {
           swal("Error, intente nuevamente");
        }
    }); 
}

function removeAll(){
    swal({   
            title: "Limpiar punto de venta",   
            text: "Desea quitar todos los productos del punto de venta",   
            type: "error",   
            showCancelButton: true,   
            closeOnConfirm: true,   
            showLoaderOnConfirm: true
        }, function(){
            $.ajax({
                url: "<?php echo $raizProy?>proveedores/ajax/removePuntoVenta.php",
                type: "post",
                data: {            
                    deleteAll: 1
                },
                success: function (response) {                        
                    window.location.href = 'index.php';                             
                },
                error: function(jqXHR, textStatus, errorThrown) {
                   swal("Error, intente nuevamente");
                }
            });  
        });    
}

function addCommas(nStr)
{
    
    nStr = parseFloat(nStr).toFixed(2);
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

</script>


<?php
    include $pathProy.'footer.php';
?>
