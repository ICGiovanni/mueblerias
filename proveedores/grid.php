<?php session_start();
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once $pathProy.'/header2.php';
require_once $pathProy.'/menu.php';

require_once($_SERVER["REDIRECT_PATH_CONFIG"].'productos/models/class.Productos.php');

$productos = new Productos();

$dataProducts = json_decode($productos->GetDataProductsMainJson());
//echo "<pre>";
//    print_r($dataProducts);
//echo "</pre>";
//$dataUnique = $productos->GetProductsUnique();

?>    

        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Catalogos</h2>
                <ol class="breadcrumb">                    
                    <li class="active">
                        <strong>catalogo de productos</strong>
                    </li>
                </ol>
            </div>           
        </div>

        <div class="wrapper wrapper-content animated fadeIn">
            <div class="row">
                <?php 
                
                foreach($dataProducts as $prod){                                
                                
                
                echo '  <div class="col-md-3">
                            <div class="ibox">
                                <div class="ibox-content product-box">                                    
                                    <div class="product-imitation" style="padding: 10px 0px">
                                        <img src="'.$prod->imagen.'" alt="'.$prod->producto_sku.'" height="180px" width="200px" />
                                    </div>
                                    <div class="product-desc">
                                        <span class="product-price">';
                                        if($prod->producto_type=='U'){
                                            echo "$&nbsp;".$prod->producto_price_public;
                                        }else{
                                            echo '<a href="detalle.php?producto_id='.base64_encode($prod->producto_id).'" style="color: #FFF"><small>ver modelos</small></a>';
                                        }
                                            
                echo '                  </span>
                                        <small class="text-muted">'.$prod->producto_sku.'</small>
                                        <div class="product-name" >'.$prod->producto_name.'</div>
                                        <div class="small m-t-xs">&nbsp;';
                                        if(count($prod->materiales)>0){
                                            foreach($prod->materiales as $material){
                                                echo "<div>".$material->material_name."&nbsp;</div>";
                                            }
                                        }    
                                        else{
                                            echo "<div>&nbsp;</div>";
                                        }
                                        if(count($prod->colores)>0){
                                            foreach($prod->colores as $color){
                                                echo "<div>".$color->color_name."&nbsp;</div>";
                                            }
                                        }
                                        else{
                                            echo "<div>&nbsp;</div>";
                                        }
                echo '                  </div>                                        
                                        <div class="m-t text-right">
                                            <a href="detalle.php?producto_id='.base64_encode($prod->producto_id).'" class="btn btn-xs btn-outline btn-primary">+ Info</a>
                                                &nbsp;';
                                        if($prod->producto_type=='U'){
                                            echo '<a href="#" class="btn btn-xs btn-outline btn-warning addCarrito"> <i class="fa fa-cart-plus"></i> </a>';
                                        }        
                                            
                echo '                  </div>                                        
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
            $(this).parent().parent().parent().addClass("active");
            swal("Agregado!", "Se ha agregado el producto al punto de venta", "success", "#DD6B55");
        });
    });
</script>    
<style type="text/css">
    .ibox .active{        
        border: double 3px #1ab394 !important;
    }
</style>    