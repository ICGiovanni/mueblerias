<?php session_start();
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once $pathProy.'/header2.php';
require_once $pathProy.'/menu.php';

require_once($_SERVER["REDIRECT_PATH_CONFIG"].'productos/models/class.Productos.php');

$productos = new Productos();

$dataProducts = $productos->GetDataProduct();
//$dataUnique = $productos->GetProductsUnique();

?>    

        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>E-commerce grid</h2>
                <ol class="breadcrumb">                    
                    <li class="active">
                        <strong>Products grid</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeIn">
            <div class="row">
                <?php 
                
                foreach($dataProducts as $prod){
                
                $images = $productos->GetImagesProduct($prod['producto_id']);
                
                $image = 'http://globmint.com/img/imagen-no.png';
                
                if(count($images)){
                    $image = ($images[0]['imagen_route']);
                }
                
                echo '  <div class="col-md-3">
                            <div class="ibox">
                                <div class="ibox-content product-box">

                                    <div class="product-imitation" style="padding: 10px 0px">
                                        <img src="'.$image.'" alt="'.$prod['producto_sku'].'" height="180px" />
                                    </div>
                                    <div class="product-desc">
                                        <span class="product-price">
                                            $&nbsp;'.$prod['producto_price_public'].'
                                        </span>
                                        <small class="text-muted">'.$prod['producto_sku'].'</small>
                                        <a href="#" class="product-name">'.$prod['producto_name'].'</a>
                                        <div class="small m-t-xs">
                                            <div>'.$prod['producto_description'].'</div>
                                            <div>'.$prod['material_name'].'</div> 
                                            <div>'.$prod['color_name'].'</div> 
                                        </div>
                                        <div class="m-t pull-left">
                                            <a href="#" class="btn btn-xs btn-outline btn-warning addCarrito"> <i class="fa fa-cart-plus"></i> </a>
                                        </div>
                                        <div class="m-t pull-righ">
                                            <a href="detalle.php" class="btn btn-xs btn-outline btn-primary">+ Info <i class="fa fa-long-arrow-right"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> ';
                }
                
                ?>
                
            </div>                        
        </div>



<?php 
    require_once $pathProy.'/footer2.php';
?>

<script src="<?php echo $raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>
<link href="<?php echo $raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

<script>
    $(document).ready(function(){
        $(".addCarrito").click(function(){
            swal("Agregado!", "Se ha agregado el producto al punto de venta", "success", "#DD6B55");
        });
    });
</script>    