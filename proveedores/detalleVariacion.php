<?php 
if(isset($_GET['producto_id'])){
    $producto_id = base64_decode($_GET['producto_id']);
}
else{
    header('location: grid.php');
}

require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once $pathProy.'/header2.php';
require_once $pathProy.'/menu.php';

require_once($_SERVER["REDIRECT_PATH_CONFIG"].'productos/models/class.Productos.php');

$productos = new Productos();

$jsonProd = json_decode($productos->GetDataProductsMainJson($producto_id));


$dataProduct = end($jsonProd);


$images = $productos->GetImagesProduct($producto_id);

/*
echo "<pre>";
    print_r($dataProduct);
echo "</pre>";
*/
$selectVariaciones='';
if(count($dataProduct->variaciones)>0){  
    $selectVariaciones =  "<select class='form-control' id='selectVariaciones'>
                            <option value='0'>Selecciona una opción</option>";
    $containerOptions = '';
    foreach($dataProduct->variaciones as $variacion){                                    
    
        $containerOptions .= '<div id="container_'.$variacion->producto_id.'" 
                                data-sku="'.$variacion->producto_sku.'"
                                data-modelo="'.$variacion->producto_name.'"
                                data-precio="'.$variacion->producto_price_public.'"
                                data-material="'.$variacion->material_name.'"
                                data-color="'.$variacion->color_name.'"    
                              ></div>';
        
        $selectVariaciones .= "<option value='".$variacion->producto_id."'>".$variacion->producto_name."</option>";
        
        $imagesVariacion = $productos->GetImagesProduct($variacion->producto_id);                
        foreach($imagesVariacion as $imgVar){
            $images[] = $imgVar;
        }
    }
    $selectVariaciones .= "</select>";      
    
    
}                    

?>
<link href="<?php echo $raizProy?>css/plugins/slick/slick.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/slick/slick-theme.css" rel="stylesheet">
   

    
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Catalogos</h2>
                <ol class="breadcrumb">                    
                    <li>
                        <a href="grid.php">Catalogo</a>
                    </li>
                    <li class="active">
                        <strong>Detalle de producto</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeIn">

            <div class="row">
                <div class="col-lg-12">

                    <div class="ibox product-detail">
                        <div class="ibox-content">

                            <div class="row">
                                <div class="col-md-5">


                                    <div class="product-images">
                                        <?php
                                            if(count($images)>0){
                                                foreach($images as $image){
                                                    echo '  <div>
                                                            
                                                                <div class="image-imitation">
                                                                <center>
                                                                    <img src="'.$image['imagen_route'].'" width="250px"/>
                                                                </center>   
                                                                </div>
                                                             
                                                            </div>';
                                                }
                                            }else{
                                                echo '  <div>
                                                                <div class="image-imitation">
                                                                    <img src="'.$dataProduct->imagen.'" width="250px" />
                                                                </div>
                                                            </div>';
                                            }   
                                        ?>                                                                                                                    
                                    </div>

                                </div>
                                <div class="col-md-7">

                                    <h2 class="font-bold m-b-xs">
                                        <?php echo $dataProduct->producto_name?>
                                    </h2>
                                    <small>
                                        <?php echo $dataProduct->producto_description?>
                                    </small>                                    
                                    <hr>

                                    <h4>Detalle de producto</h4>
                                    <div class="small text-muted">
                                        <?php echo $dataProduct->producto_description?>
                                    </div>
                                    <div class="clear">&nbsp;</div>
                                    <div class="small">
                                        <?php                                                                               
                                            if(!empty($selectVariaciones)){
                                                echo $selectVariaciones;
                                            }else{
                                                echo "<span class='text-danger'>No existe información para este producto</span>";
                                            }
                                        ?>    
                                    </div>    
                                    <div class="m-t-md">
                                        <h2 class="product-main-price text-warning" style="display: none">$&nbsp;<span id="precioShow"></span> <small class="text-muted"> IVA incluido</small> </h2>
                                    </div>
                                    <div id="descriptionProduct"></div>                                                                                                            
                                    SKU: <small id="skuShow">Seleccione una variación</small>                                        
                                    <hr>
                                    <div>
                                        
                                        <div class="btn-group pull-right">
                                            <button class="btn btn-primary btn-sm addPuntoVenta" id='addPuntoVenta' 
                                                    data-sku="<?php echo $dataProduct->producto_sku?>"
                                                    data-modelo="<?php echo $dataProduct->producto_name?>"
                                                    data-precio="<?php echo $dataProduct->producto_price_public?>"
                                                    disabled="1"><i class="fa fa-cart-plus"></i> Punto de venta</button>                                            
                                        </div>
                                        
                                    </div>



                                </div>
                            </div>

                        </div>                        
                    </div>

                </div>
            </div>
            
        </div>

<?php 
    require_once $pathProy.'/footer2.php';
    echo $containerOptions;
?>

<link href="<?php echo $raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<script src="<?php echo $raizProy?>js/plugins/slick/slick.min.js"></script>
<script src="<?php echo $raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo $raizProy?>proveedores/js/addPuntoVenta.js"></script>

<script>

$(document).ready(function(){     
   
    $("#selectVariaciones").change(function(){
        
        var val = $(this).val();       
        $("#descriptionProduct").html('');
        $("#addPuntoVenta").prop("disabled", true);
        $("#skuShow").html('Seleccione una variación');
        $("#precioShow").html('');
        $(".product-main-price").hide();
        if(val>0){
            var sku = $("#container_"+val).data('sku');
            var modelo = $("#container_"+val).data('modelo');
            var precio = $("#container_"+val).data('precio');
            var material = $("#container_"+val).data('material');
            var color = $("#container_"+val).data('color');
            $("#descriptionProduct").html( '<p>'+           
                    '<div ><b>Modelo:</b>&nbsp;&nbsp;'+modelo+'</div>'+
                    '<div ><b>Material:</b>&nbsp;&nbsp;'+material+'</div>'+    
                    '<div ><b>Color:</b>&nbsp;&nbsp;'+color+'</div>'+    
                '</p>'
            );
            $("#skuShow").html(sku);
            $("#precioShow").html(precio);
            $("#addPuntoVenta").prop("disabled", false);
            $("#addPuntoVenta").data('sku', sku);
            $("#addPuntoVenta").data('modelo', modelo);
            $("#addPuntoVenta").data('precio', precio);
            $(".product-main-price").show();
            $("#precioShow").html(precio);
        }    
    });   
});

</script>   

</body>

</html>
