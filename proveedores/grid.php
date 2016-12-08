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
/*echo "<pre>";
    print_r($dataProducts);
echo "<pre>";*/
//$dataUnique = $productos->GetProductsUnique();

?>    

<link href="<?php echo $raizProy?>css/plugins/chosen/chosen.css" rel="stylesheet">

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
                        <td colspan="2">
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

                    foreach($dataProducts as $prod){                                

                    $active = '';
                    $cantidad  = 1;
                    $verCarrito = 1;
                    if(isset($_SESSION['punto_venta']) && is_array($_SESSION['punto_venta']['Productos'])){
                        $puntoVenta = $_SESSION['punto_venta'];                    
                        foreach($puntoVenta['Productos'] as $product){                        
                            if($product['SKU']==$prod->producto_sku){
                                $active = "visibility: visible";
                                $cantidad = $product['Cantidad'];
                                $verCarrito = 0;
                            }
                            if($prod->producto_type!='U'){
                                foreach($prod->variaciones as $variacion){
                                    if($product['SKU']==$variacion->producto_sku){
                                        $active = "visibility: visible";
                                    }
                                }
                            }

                        }
                    }

                    $url = 'detalle';
                    if($prod->producto_type!='U'){                    
                        $url = 'detalleVariacion';                    
                    }

                    echo '  <div class="col-md-3">    

                                <div class="ibox" >
                                    <div class="ibox-content product-box">                                    
                                        <a href="'.$url.'.php?producto_id='.base64_encode($prod->producto_id).'">
                                        <div class="product-imitation" style="padding: 10px 0px">
                                            <img src="'.$prod->imagen.'" alt="'.$prod->producto_sku.'" height="180px" width="200px" />
                                            <div class="line" style="'.$active.'" id="line_'.$prod->producto_id.'"><span style="color: #FFF; padding: 0px 10px" class="diagonal">Punto de venta</span></div>    
                                        </div>
                                        </a>
                                        <div class="product-desc">
                                            <a href="'.$url.'.php?producto_id='.base64_encode($prod->producto_id).'">
                                            <span class="product-price">';

                                            if($prod->producto_type=='U'){
                                                echo "$&nbsp;".$prod->producto_price_public;
                                            }else{                                            
                                                echo '<small>ver modelos</small>';
                                            }

                    echo '                  </span></a>
                                            <small class="text-muted">'.$prod->producto_sku.'</small>
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
                    echo '                  </div>                                        
                                            <div class="m-t text-right">';
                                            if($prod->producto_type!='U'){
                    echo '                  <a href="'.$url.'.php?producto_id='.base64_encode($prod->producto_id).'" class="btn btn-xs btn-outline btn-primary">+ Info</a>
                                                    &nbsp;';
                                            }        
                                            if($prod->producto_type=='U'){
                                                if($verCarrito==1){
                                                echo '<input type="text" id="cantidad_'.$prod->producto_id.'" value="'.$cantidad.'" size="3">&nbsp;';
                                                echo '<a href="#" class="btn btn-xs btn-outline btn-warning addCarrito addPuntoVenta" data-line="line_'.$prod->producto_id.'" id="addPuntoVenta_'.$prod->producto_id.'" 
                                                      data-imagen="'.$prod->imagen.'"
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
<style type="text/css">    
    .line{
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 120px 120px 0 0;
        border-color: #ffb700 transparent transparent transparent;
        line-height: 0px;
        _border-color: #ffb700 #000000 #000000 #000000;
        _filter: progid:DXImageTransform.Microsoft.Chroma(color='#000000');
        position: absolute;
        top: 0px;
        left: 15px;
        z-index: 0;
        opacity: .6;
        filter: alpha(opacity=60);
        visibility: hidden;
    }
    .diagonal{
        width: 125px;
        height: 15px;        
        -webkit-transform: translateY(34px) translateX(15px) rotate(-46deg);
        position: absolute;
        top: -110px;
        left: -25px;
        font-size: 14px;
        z-index: 999;        
    }
</style>    