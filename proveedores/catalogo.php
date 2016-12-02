<?php session_start();
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once $pathProy.'/header2.php';
require_once $pathProy.'/menu.php';

require_once($_SERVER["REDIRECT_PATH_CONFIG"].'proveedores/models/class.Proveedores.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'productos/models/class.Productos.php');


$proveedorId = '';
if(isset($_GET['id'])){
    $proveedorId = base64_decode($_GET['id']);
}
$proveedores = new Proveedor();
$productos = new Productos();

$infoProv = $proveedores->getProveedor($proveedorId);
$infoProv = end($infoProv);
$list = $proveedores->GetDataProductProveedor($proveedorId);

$proveedoresList = $proveedores->getProveedores(); 
/*
echo "<pre>";
    print_r($list);
echo "</pre>";  
*/
foreach($list as $key => $value){
    $productId = $value['producto_id'];
    $categoria = array('category'); // $productos->GetProductCategory($productId);
    $material = array('material'); // $productos->GetProductMaterial($productId);
    $color = array('color'); // $productos->GetProductColor($productId);        
    $galeria = $productos->GetImagesProduct($productId);    
    $list[$key]['categoria'] = implode(",", $categoria);
    $list[$key]['material'] = implode(",", $material);
    $list[$key]['color'] = implode(",", $color);
    $list[$key]['galeria'] = $galeria;        
}

?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Catalogo de productos</h2>
        <ol class="breadcrumb">
            <li>
                <a href="">Proveedores</a>
            </li>
            <li class="active">
                <strong>Productos <?php echo $infoProv['proveedor_nombre']?></strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
                <a href='<?php echo $ruta.'productos/nuevo_producto.php'?>' class="btn btn-primary btn-xs" >
                + Nuevo Producto 
                </a>
        </div>
    </div>
</div>



<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-content">
                <div class="">
                    <div class="form-group" id="data_color" >
                        <form>
                        Proveedor
                        <select data-placeholder="Selecciona un proveedor" class="chosen-select form-control" style="width:200px;" tabindex="4" id="proveedor" name="id">                            
                            <option value='0'>&nbsp;</option>
                            <?php 
                                foreach($proveedoresList as $itemProv){
                                    echo "<option value='".base64_encode($itemProv['proveedor_id'])."'>".$itemProv['proveedor_nombre']."</option>";
                                }
                            ?>
                        </select> 
                        <button type="submit" class="btn btn-primary btn-xs" style='display: inline'>Filtrar</button>
                        </form>
                    </div>
                </div>
                <div class="">
                    <table id="tablaProductosProveedor" class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>                            
                            <th>SKU</th>
                            <th>Modelo</th>
                            <th>Categoria</th>                            
                            <th>Color</th>
                            <th>Material</th>                                                        
                            <th>Precio</th>
                            <th>Galeria</th>
                            <th>Acciones</th>                            
                        </tr>
                        </thead>
                        <tbody id='catalogoProductos'>
                        <?php                                                
                        foreach($list as $item){
                            
                            $infoProvItem = $proveedores->getProveedor($item['proveedor_id']);
                            $infoProvItem = end($infoProvItem);
                            
                            $data = json_decode($productos->GetDataProductsMainJson($item['producto_id']));
                            
                            
                            $catego= $productos->GetProductCategory($item['producto_id']);
                            $categoria = '';
                            foreach($catego as $cat ){
                                $categoria.= $cat;
                            }
                            
                            $materiales = '';
                            $colores = '';
                            foreach($data as $dat){
                                
                                foreach($dat->materiales as $material){
                                    $materiales .= $material->material_name;                                    
                                }
                                foreach($dat->colores as $col){
                                    $colores .= $col->color_name;                                    
                                }
                                
                            }
                            
                            if(count($data)>0){
                            echo "  <tr>
                                        <td>".$item['producto_sku']."</td>
                                        <td>".$item['producto_name']."</td>
                                        <td>".$categoria."</td>
                                        <td>".$colores."</td>
                                        <td>".$materiales."</td>                                        
                                        <td>".$item['producto_price_purchase']."</td>
                                        <td><a href='#' data-toggle='modal' data-target='#myModal4' data-galeria='".json_encode($item['galeria'])."' class='linkGalery'>galeria</a></td>    
                                        <td>
                                            <a href='".$raizProy."productos/editar_producto.php?id=".$item['producto_id']."'><i class='fa fa-edit' title='Editar'></i></a>
                                            <a href='#'><i class='fa fa-trash deleteProv' title='Borrar'></i></a>
                                            <a href='#' data-toggle='modal' data-target='#myModal3' 
                                                    data-proveedor='".$infoProvItem['proveedor_nombre']."'
                                                    data-telefono='".$infoProvItem['telefono']."'
                                                    data-producto='".$item['producto_id']."'
                                                    data-categoria = '".$item['categoria']."'   
                                                    data-color = '".$item['color']."'   
                                                    data-material = '".$item['material']."'   
                                                    class='nuevoPedido'>Pedido</a>
                                        </td>    
                                    </tr>";
                            }
                        }
                        ?>    
                        </tbody>
                    </table>
		</div>
            </div>
	</div>
    </div>	
</div>

<div class="modal inmodal fade" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding: 15px">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h3 class="modal-title">Nuevo Proveedor </h3>
            </div>
            <div class="modal-body" style="padding-bottom: 0px !important; margin-bottom: -15px !important">    
                <?php include 'proveedorTemplate.php' ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary btn-xs" id="btn_guardar_proveedor" >Guardar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal inmodal fade" id="myModal2" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding: 15px">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h3 class="modal-title">Editar Proveedor </h3>
            </div>
            <div class="modal-body" style="padding-bottom: 0px !important; margin-bottom: -15px !important">                    
                <input type="hidden" id="proveedor_id" value='' />
                <input type="hidden" id="address_id" value='' />
                <?php include 'proveedorTemplate.php' ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary btn-xs" id="btn_editar_proveedor" >Guardar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="myModal3" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding: 15px">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h3 class="modal-title">Nuevo Pedido </h3>
            </div>
            <div class="modal-body" style="padding-bottom: 0px !important; margin-bottom: -15px !important">                    
                <input type="hidden" id="proveedor_id_update" value='<?php echo $proveedorId;?>' />      
                <input type="hidden" id="producto_id" value='' />      
                <?php include 'pedidoTemplate.php' ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary btn-xs" id="btn_guardar_pedido" >Guardar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="myModal4" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding: 5px">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>                
            </div>
            <div class="" style="padding-top: 15px !important; padding-bottom: 25px !important">                    
                <div class="lightBoxGallery">
                    <div id='image_src'></div>                   
                </div>
                <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
                <div id="blueimp-gallery" class="blueimp-gallery">
                    <div class="slides"></div>
                    <h3 class="title"></h3>
                    <a class="prev">‹</a>
                    <a class="next">›</a>
                    <a class="close">×</a>
                    <a class="play-pause"></a>
                    <ol class="indicator"></ol>
                </div>
            </div>           
        </div>
    </div>
</div>



<?php 
    require_once $pathProy.'/footer2.php';
?>

<script src="<?php echo $raizProy?>js/plugins/dataTables/datatables.min.js"></script>
<script src="<?php echo $raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo $raizProy?>js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
<script src="<?php echo $raizProy?>js/plugins/chosen/chosen.jquery.js"></script>
<script src="<?php echo $raizProy?>js/plugins/datapicker/bootstrap-datepicker.js"></script>

<link href="<?php echo $raizProy?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/chosen/chosen.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">

<script src="js/catalogo.js"></script>
<script>
$(document).ready(function(){  
    
    $("#proveedor").chosen();
    
    $(".linkGalery").click(function(){    
        
        $("#image_src").html('');    
        
        $.each( $(this).data('galeria'), function( key, value ) {
            $("#image_src").append('<a href="'+value.imagen_route+'" title="'+value.imagen_name+'" data-gallery=""><img src="'+value.imagen_route+'" width="120px"></a>');
        });   
        
        $(".slide-content").click();
        
    });
});    
</script>