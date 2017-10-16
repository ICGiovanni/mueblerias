<?php session_start();
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once $pathProy.'/header2.php';
require_once $pathProy.'/menu.php';

require_once($_SERVER["REDIRECT_PATH_CONFIG"].'productos/models/class.Productos.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'inventarios/models/class.Inventarios.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'proveedores/models/class.Proveedores.php');

$productos = new Productos();
$inventarios=new Inventarios();
$proveedores = new Proveedor();

$dataProducts = json_decode($productos->GetDataProductsMainJson());

/*
echo "<pre>";
    print_r($dataProducts);
echo "<pre>";
*/
//$dataUnique = $productos->GetProductsUnique();

?>
<style type="text/css">

.imgCarrito{
    display: none;
}
</style>
<link href="<?php echo $raizProy?>css/plugins/chosen/chosen.css" rel="stylesheet">

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Catalogos</h2>
                <ol class="breadcrumb">                    
                    <li class="active">
                        <strong>Catalogo de Productos</strong>
                    </li>
                </ol>
            </div>           
        </div>
        <div class="ibox">
            <div class="ibox-title">      
            <form method="post" action="/grid.php" id="form_filtro" >
		<table class="table-form" id="table_search">
                    <tr>
                        <td>
                            <div class="form-group" id="data_material">                                
				<select data-placeholder="Selecciona una proveedor" class="chosen-select" multiple style="width:200px;" tabindex="4" id="proveedor" name="proveedor[]">
                                    <option value=""></option>
                                    <?php 
                                    $result=$proveedores->getProveedoresList();
                                    foreach($result as $r){
                                        echo '<option value="'.$r['proveedor_id'].'">'.$r['proveedor_nombre'].'</option>';
                                    }
                                    ?>
				</select>&nbsp;
                            </div>
			</td>
                        <td>
                            <div class="form-group" id="data_material">                                
				<select data-placeholder="Selecciona una categoria" class="chosen-select" multiple style="width:200px;" tabindex="4" id="categoria" name="categoria[]">
                                    <option value=""></option>
                                    <?php 
                                    $result=$productos->GetCategories();                                   
                                    foreach($result as $r){
                                        echo '<option value="'.$r['categoria_id'].'">'.$r['categoria_name'].'</option>';
                                    }
                                    ?>
				</select>&nbsp;
                            </div>
			</td>
                        <td>
                            <div class="form-group" id="data_sku">
                                <input type="text" id="sku" name="sku" class="form-control" placeholder="SKU">
                            </div>
			</td>
                        <td style="padding-left: 4px">
                            <div class="form-group" id="data_modelo" >
                                <input type="text" id="modelo" name="modelo" class="form-control" placeholder="Modelo"> 
                            </div>
			</td>
                    </tr>
                    <tr>
			<td>
                            <div class="form-group" id="data_color" >                                
                                    <select data-placeholder="Selecciona un color" class="chosen-select form-control" multiple style="width:200px;" tabindex="4" id="color" name="color[]">
                                        <option value=""></option>
					<?php 					            					            
                                        $result=$productos->GetColors();					                    					                                                
                                        foreach($result as $r){
                                            echo '<option value="'.$r['color_id'].'">'.$r['color_name'].'</option>';
                                        }					            
					?>
                                    </select> 
                            </div>
			</td>
			<td>
                            <div class="form-group" id="data_material" >                                
				<select data-placeholder="Selecciona un material" class="chosen-select" multiple style="width:200px;" tabindex="4" id="material" name="material[]">
                                    <option value=""></option>
                                    <?php 
                                    $result=$productos->GetMaterials();                                    
                                    foreach($result as $r){
                                        echo '<option value="'.$r['material_id'].'">'.$r['material_name'].'</option>';
                                    }                               
                                    ?>
                                </select>
                            </div>
			</td>                    
                        <td colspan="2" style='padding: 5px; vertical-align: top;'>
                            <button type="button" class="btn btn-primary btn-xs" id="filtar">Filtrar</button> &nbsp;&nbsp;&nbsp;
                            <button type="button" class="btn btn-warning btn-xs"  onclick="location.href = 'grid.php';" >Limpiar</button>
			</td>
                    </tr>
		</table>					
            </form>
            </div>    
        
            <div class="wrapper wrapper-content animated fadeIn ibox-title">
                <div class="row">
                    <?php 
                    $indi = 0;
                    foreach($dataProducts as $prod){                                

                    $indi++;
                    $styleClear = '';
                    if($indi==5){
                        $styleClear = 'style="clear: left;"';
                        $indi = 1;
                    }    
                        
                    $active = '';
                    $cantidad  = 1;
                    $verCarrito = 1;
                    if(isset($_SESSION['punto_venta']) && is_array($_SESSION['punto_venta']['Productos'])){
                        $puntoVenta = $_SESSION['punto_venta'];                    
                        foreach($puntoVenta['Productos'] as $product){                        
                            if($product['SKU']==$prod->producto_sku){
                                $active = "display: block";
                                $cantidad = $product['Cantidad'];
                                $verCarrito = 0;
                            }
                            if($prod->producto_type!='U'){
                                foreach($prod->variaciones as $variacion){
                                    if($product['SKU']==$variacion->producto_sku){
                                        $active = "display: block";
                                    }
                                }
                            }

                        }
                    }

                    $url = 'detalle';
                    if($prod->producto_type!='U'){                    
                        $url = 'detalleVariacion';                    
                    }
                    $imgPromo='display: none;';
                    $discount = false;
                    if($prod->producto_price_public>$prod->producto_price_public_discount){
                        $imgPromo='display: block';
                        $discount=true;
                    }

                    echo '  <div class="col-md-3" '.$styleClear.'>    

                                <div class="ibox" >
                                    <div class="ibox-content product-box">                      
                                        <img class="imgCarrito" id="line_'.$prod->producto_id.'" src="//globmint.com/img/etiqueta_carrito.png" style="position: absolute; left: 15px; top: 5px; '.$active.'" />
                                        <img src="//globmint.com/img/etiqueta_promo.png" style="position: absolute; right: 9px; top: -7px; z-index: 999;'.$imgPromo.'" />          
                                        <a href="'.$url.'.php?producto_id='.base64_encode($prod->producto_id).'">
                                        <div class="product-imitation" style="padding: 5px 0px">                                            
                                            <img src="'.str_replace('http:','https:',$prod->imagen).'" alt="'.$prod->producto_sku.'" class="img-thumbnail" height="150px"/>                                                
                                        </div>
                                        </a>
                                        <div class="product-desc">
                                            <a href="'.$url.'.php?producto_id='.base64_encode($prod->producto_id).'">';

                                            if($prod->producto_type=='U'){
                                                if($discount==true){
                                                    echo "&nbsp;<span class=\"product-price\" style='text-decoration:line-through;'>$".$prod->producto_price_public."</span>&nbsp;<span class=\"product-price\" style='background-color: #B0171D; color: #FFF; margin-top: 35px'>$".$prod->producto_price_public_discount."</span>";
                                                }else{
                                                    echo "<span class=\"product-price\">$&nbsp;".$prod->producto_price_public."</span>";
                                                }
                                            }else{
                                                echo '<span class="product-price"><small>ver modelos</small></span>';
                                            }

                                            $infoProveedor = end($proveedores->getProveedor($prod->proveedor_id));

                    echo '                  </span>
                                            <small class="text-muted">'.trim($prod->producto_sku).'</small>
                                            <div style="font-size: 14px; color: #676a6c; font-weight: bold">'.$infoProveedor['proveedor_nombre'].'</div>
                                            <div class="product-name" >'.$prod->producto_name.'</div>
                                            <div class="small m-t-xs" >'.$prod->producto_description_corta.'</div>
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
                    echo '                  </div></a>                                        
                                            <div class="m-t text-right">';
                                            if($prod->producto_type!='U'){
                    echo '                  <a href="'.$url.'.php?producto_id='.base64_encode($prod->producto_id).'" class="btn btn-xs btn-outline btn-primary">+ Info</a>
                                                    &nbsp;';
                                            }        
                                            if($prod->producto_type=='U'){
                                                if($verCarrito==1){
                                                echo '<input type="number" min="1" id="cantidad_'.$prod->producto_id.'" value="'.$cantidad.'" size="3" style="width: 70px">&nbsp;';
                                                echo '<a href="#" class="btn btn-xs btn-outline btn-warning addCarrito addPuntoVenta" data-line="line_'.$prod->producto_id.'" id="addPuntoVenta_'.$prod->producto_id.'" 
                                                      data-imagen="'.str_replace('http:','https:',$prod->imagen).'"
                                                      data-id="'.$prod->producto_id.'"
                                                      data-sku="'.$prod->producto_sku.'"
                                                      data-modelo="'.$prod->producto_name.'"
                                                      data-precio="'.$prod->producto_price_public.'">+ <i class="fa fa-cart-plus"></i> </a>';
                                                }
                                                else{
                                                    echo '<a href="#" class="btn btn-xs btn-outline btn-danger addCarrito removePuntoVenta" data-line="line_'.$prod->producto_id.'" id="removePuntoVenta_'.$prod->producto_id.'" data-id="'.$prod->producto_id.'" data-sku="'.$prod->producto_sku.'"><i class="fa fa-trash"></i></a>';
                                                }
                                            }        

                    echo '                  </div>                                        
                                        </div>                                                                        
                                    </div>
                                </div>                        
                            </div>
                            ';
                    }

                    ?>

                </div>                        
            </div>
        </div>


<?php 
    require_once $pathProy.'/footer2.php';
?>

<script src="<?php echo $raizProy?>js/plugins/chosen/chosen.jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#color").chosen();        
        $("#material").chosen();
        $("#categoria").chosen();
        $("#proveedor").chosen();
    });
</script>    
<script src="<?php echo $raizProy?>js/plugins/slick/slick.min.js"></script>
<script src="<?php echo $raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>
<link href="<?php echo $raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<script src="<?php echo $raizProy?>proveedores/js/addPuntoVenta.js"></script>
<script src="<?php echo $raizProy?>js/plugins/dataTables/datatables.min.js"></script>    
