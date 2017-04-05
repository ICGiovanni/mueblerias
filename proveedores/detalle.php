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

$images = $productos->GetImagesProduct($producto_id);
$getDataP= json_decode($productos->GetDataProductsMainJson($producto_id));
$dataProduct = end($getDataP);
/*
echo "<pre>";
    print_r($dataProduct);
echo "</pre>";
*/
?>
<link href="<?php echo $raizProy?>css/plugins/slick/slick.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/slick/slick-theme.css" rel="stylesheet">
   

    
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Catalogos</h2>
                <ol class="breadcrumb">                    
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
                                                                    <img src="'.$dataProduct->imagen.'" width="250px"/>
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
                                        <?php echo $dataProduct->producto_description_corta?>
                                    </small>
                                    <div class="m-t-md">
                                        <h2 class="product-main-price">$ <?php echo $dataProduct->producto_price_public?><small class="text-muted"> IVA incluido</small> </h2>
                                    </div>
                                    <hr>

                                    <h4>Detalle de producto</h4>
                                    <div class="small text-muted">
                                        <?php echo $dataProduct->producto_description?>
                                    </div>
                                    <div class="clear">&nbsp;</div>
                                    <div class="small">
                                    <?php                                        
                                        
                                        if(count($dataProduct->materiales)>0){
                                            echo "<dt>Material:</dt>";
                                            foreach($dataProduct->materiales as $material){                                                
                                                echo "<dd>".$material->material_name."</dd>";
                                            }
                                        }    
                                        
                                        if(count($dataProduct->colores)>0){
                                            echo "<dt>Color:</dt>";
                                            foreach($dataProduct->colores as $color){
                                                echo "<dd>".$color->color_name."</dd>";
                                            }
                                        }                                        
                                    ?>    

                                    </div>                                    
                                    <hr>
                                    <div>
                                        <div class="btn-group">
                                            <button class="btn btn-primary btn-sm" id='addPuntoVenta'><i class="fa fa-cart-plus"></i> Punto de venta</button>                                            
                                        </div>
                                    </div>



                                </div>
                            </div>

                        </div>
                        <div class="ibox-footer">
                            <span class="pull-right">
                                Full stock - <i class="fa fa-clock-o"></i> 14.04.2016 10:04 pm
                            </span>
                            The generated Lorem Ipsum is therefore always free
                        </div>
                    </div>

                </div>
            </div>
            
        </div>

<?php 
    require_once $pathProy.'/footer2.php';
?>

<script src="<?php echo $raizProy?>js/plugins/slick/slick.min.js"></script>
<script src="<?php echo $raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>
<link href="<?php echo $raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    


<script>
    $(document).ready(function(){


        $('.product-images').slick({
            dots: true
        });
        
        
        $("#addPuntoVenta").click(function(){
            swal({   
                title: "Agregar a punto de venta",   
                text: "Desea agregar el producto al punto de venta",   
                type: "info",   
                showCancelButton: true,   
                closeOnConfirm: false,   
                showLoaderOnConfirm: true,
            }, function(){
                                
                setTimeout(function(){     swal("Ajax request finished!");   }, 2000);
                
            });
        });

    });

</script>

</body>

</html>
