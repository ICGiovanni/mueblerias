<?php session_start();
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once $pathProy.'/header2.php';
require_once $pathProy.'/menu.php';

require_once($_SERVER["REDIRECT_PATH_CONFIG"].'productos/models/class.Productos.php');

$productos = new Productos();

$dataProducts = json_decode($productos->GetDataProductsMainJson());

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
                                
                $active = '';
                
                if(isset($_SESSION['punto_venta'])){
                    
                    foreach($_SESSION['punto_venta']['Productos'] as $product){                        
                        if($product['SKU']==$prod->producto_sku){
                            $active = 'border: double 3px #1ab394 !important';                            
                        }
                        if($prod->producto_type!='U'){
                            foreach($prod->variaciones as $variacion){
                                if($product['SKU']==$variacion->producto_sku){
                                    $active = 'border: double 3px #1ab394 !important';
                                }
                            }
                        }
                        
                    }
                }
                
                echo '  <div class="col-md-3">
                            <div class="ibox" style=" '.$active.'">
                                <div class="ibox-content product-box">                                    
                                    <div class="product-imitation" style="padding: 10px 0px">
                                        <img src="'.$prod->imagen.'" alt="'.$prod->producto_sku.'" height="180px" width="200px" />
                                    </div>
                                    <div class="product-desc">
                                        <span class="product-price">';
                                        $url = 'detalle';
                                        if($prod->producto_type=='U'){
                                            echo "$&nbsp;".$prod->producto_price_public;
                                        }else{
                                            $url = 'detalleVariacion';
                                            echo '<a href="'.$url.'.php?producto_id='.base64_encode($prod->producto_id).'" style="color: #FFF"><small>ver modelos</small></a>';
                                        }
                                            
                echo '                  </span>
                                        <small class="text-muted">'.$prod->producto_sku.'</small>
                                        <div class="product-name" >'.$prod->producto_name.'</div>
                                        <div class="small m-t-xs">&nbsp;';
                                        if(count($prod->materiales)>0){
                                            echo "<div>";
                                            foreach($prod->materiales as $material){
                                                echo $material->material_name.", &nbsp;";
                                            }
                                            echo "</div>";
                                        }    
                                        else{
                                            echo "<div>&nbsp;</div>";
                                        }
                                        if(count($prod->colores)>0){
                                            echo "<div>";
                                            foreach($prod->colores as $color){
                                                echo $color->color_name.", &nbsp;";
                                            }
                                            echo "</div>";
                                        }
                                        else{
                                            echo "<div>&nbsp;</div>";
                                        }
                echo '                  </div>                                        
                                        <div class="m-t text-right">
                                            <a href="'.$url.'.php?producto_id='.base64_encode($prod->producto_id).'" class="btn btn-xs btn-outline btn-primary">+ Info'.$prod->producto_id.'</a>
                                                &nbsp;';
                                        if($prod->producto_type=='U'){
                                            echo '<a href="#" class="btn btn-xs btn-outline btn-warning addCarrito addPuntoVenta" id="addPuntoVenta_'.$prod->producto_id.'" 
                                                  data-sku="'.$prod->producto_sku.'"
                                                  data-modelo="'.$prod->producto_name.'"
                                                  data-precio="'.$prod->producto_price_public.'">+ <i class="fa fa-cart-plus"></i> </a>';
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
<script src="<?php echo $raizProy?>js/plugins/slick/slick.min.js"></script>
<script src="<?php echo $raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>
<link href="<?php echo $raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<script src="<?php echo $raizProy?>proveedores/js/addPuntoVenta.js"></script>

<style type="text/css">
    .ibox .active{        
        border: double 3px #1ab394 !important;
    }
</style>    