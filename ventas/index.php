<?php session_start();
    include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
    require_once($_SERVER["REDIRECT_PATH_CONFIG"].'clientes/models/class.Clientes.php');
    // include $pathProy.'login/session.php';
    include $pathProy.'/header.php';
    include $pathProy.'/menu.php';
    
    $numProd = 0;
    $total = (int)0;
    $subtotal = 0;
    $iva = 0;
    
    if(isset($_SESSION['punto_venta']['Productos'])){
        $puntoVenta = $_SESSION['punto_venta'];
        $numProd = count($puntoVenta['Productos']);
        //$total = $puntoVenta['Total'];
        $total = (float)$puntoVenta['Subtotal'];
        $subtotal = (float)$puntoVenta['Subtotal'];
        $iva = (float)$puntoVenta['IVA'];
        
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
        <h2>Ventas</h2>
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
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-title">
                    
                    <span class="pull-right">Productos Agregados (<strong><?php echo $numProd; ?></strong>)</span>
                    <h5>Productos Agregados:</h5>
                </div>
                <div id="productos">                       
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table shoping-cart-table table-striped">
                                <thead>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Modelo</th>
                                        <th style="width: 120px">Precio Unitario</th>
                                        <th style="width: 70px">Cantidad</th>
                                        <th style="width: 120px; text-align: center">Subtotal</th>
                                        <th role="button" onclick="removeAll()"><button class='btn btn-danger btn-md' ><i class="fa fa-trash-o"></i> Borrar  Todo</button></th>
                                    </tr>
                                </thead>
                                <tbody id="productosVenta">
                                
                                <?php 
                                if(isset($puntoVenta) && is_array($puntoVenta['Productos']) && count($puntoVenta['Productos'])>0){
                                    foreach($puntoVenta['Productos'] as $prod){
                                        
                                    
                                    echo '  <tr id="row_'.$prod['ID'].'" data-sku="'.$prod['SKU'].'" data-modelo="'.$prod['Modelo'].'" data-imagen="'.$prod['Imagen'].'">
                                                <td width="90">
                                                    <img src="'.$prod['Imagen'].'" height="80" width="80">
                                                </td>
                                                <td class="desc">
                                                    <h3><a href="#" class="text-navy">'.$prod['Modelo'].'</a></h3>                                                                                                                      
                                                </td>
                                                <td>$<span id="labelprecio_'.$prod['ID'].'">'.number_format($prod['Precio'],2,'.',',').'</span><br />
                                                    <input type="number" id="precio_'.$prod['ID'].'" value="'.$prod['Precio'].'" min="'.$prod['Precio'].'" step="50" style="display: none" /></td>
                                                <td><input id="cantidad_'.$prod['ID'].'" type="number" class="form-control cantidad" placeholder="1" min="1" value='.$prod['Cantidad'].'></td>
                                                <td><h4 id="subtotal_'.$prod['ID'].'" class="subtotal_sumar">'.number_format($prod['Subtotal'],2,'.',',').'</h4></td>
                                                <td style="text-align: center"><button class="btn btn-danger btn-md removeCart " data-sku="'.$prod['SKU'].'" id="removeCart_'.$prod['ID'].'"><i class="fa fa-trash " role="button"></i></button></td>                                    
                                            </tr>';
                                    }
                                }else{
                                    //echo "<tr><td colspan='6' style='text-align: center; color: #E70030'>Aún no se han agregado productos a la venta</td></tr>";
                                }
                                ?>                                                                                                    
                                </tbody>
                                <tfoot class="ibox-content">
                                    <tr>                                        
                                        <td colspan="4" class="font-bold" style="text-align: right"><h3>TOTAL</h3></td>
                                        <td><h3 class="text-right" id="total_sumar"> $ <?php echo number_format($total,2,'.',',');?></h3></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
		</div>                        
                <div class="ibox-title">                    
                    <div class="m-t-sm">
                        <a href="<?php echo $ruta.'proveedores/grid.php'?>" class="btn btn-white"><i class="fa fa-arrow-left"></i>&nbsp;Continuar Comprando</a>
                    
                        <div style="float: right">
                            <a href="<?php echo $ruta.'punto_venta/?apartado=u48f6d1'?>" class="btn btn-warning btn-md"><i class="fa fa-shopping-cart"></i>&nbsp;Apartar</a>&nbsp;                            
                            <a href="<?php echo $ruta.'punto_venta'?>" class="btn btn-primary btn-md"><i class="fa fa-shopping-cart"></i>&nbsp;Pagar</a>                        
                        </div>
                        
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
                        var imagenSave = imagen;
                        if(imagen!=''){                            
                            urlImage = imagen;
                            imagen='<img src="'+imagen+'" height="80" width="80">';
			}else{
                            imagen = '<div class="cart-product-imitation"></div>';
                        }
                        
                        table +='   <tr id="row_'+id+'" data-sku="'+sku+'" data-modelo="'+name+'" data-imagen="'+imagenSave+'">'+
                                        '<td width="90">'+imagen+'</td>'+
                                        '<td class="desc">'+
                                            '<h3><a href="#" class="text-navy">'+name+'</a></h3>'+
                                        '</td>'+
                                        '<td>$ <span id="labelprecio_'+id+'">'+addCommas(price)+'</span>'+
                                        '<input type="number" id="precio_'+id+'" value="'+price+'" min="'+price+'" step="50" style="display: none" />'+
                                        '</td>'+
                                        '<td><input id="cantidad_'+id+'" type="number" min="1" class="form-control cantidad" placeholder="1" value="1"></td>'+
                                        '<td><h4 id="subtotal_'+id+'" class="subtotal_sumar">'+addCommas(price)+'</h4></td>'+
                                        '<td style="text-align: center"><button class="btn btn-danger btn-md removeCart" data-sku="'+sku+'" id="removeCart_'+id+'"><i class="fa fa-trash" role="button"></i></button></td>'+
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

	    $(document).on("click", ".removeCart", function(e) {
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
        
    $(document).on("click", ".cantidad", function(e) {
        var id = $(this).attr('id').substr(9, 3);
        var sku = $("#row_"+id).data('sku');
        var modelo = $("#row_"+id).data('modelo');
        var imagen = $("#row_"+id).data('imagen');
        var precio = $("#precio_"+id).val();
        var cantidad = $(this).val();
        
        $("#subtotal_"+id).html(addCommas(precio * cantidad));     
        
        //$(this).change(function(){
            saveCart(id, sku, modelo, cantidad, precio, imagen);
        //});
        
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

            setTimeout(function(){
                var totalSumar = 0;
                $(".subtotal_sumar").each(function(){

                    var txt = $(this).html();
                    txt = txt.replace(",", "");
                    totalSumar += parseFloat(txt);
                });
                //alert(totalSumar);
                $("#total_sumar").html("$ " + addCommas(totalSumar));

                console.log(totalSumar);

            }, 600);

            //window.location.href = 'index.php';
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
<style type="text/css">
    .btn-danger {
        margin-top: -10px !important;
        font-size: 12px !important;
    }

</style>

<?php
    include $pathProy.'footer.php';
?>
