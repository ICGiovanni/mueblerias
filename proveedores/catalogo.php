<?php session_start();
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once $pathProy.'/header2.php';
require_once $pathProy.'/menu.php';

require_once($_SERVER["REDIRECT_PATH_CONFIG"].'proveedores/models/class.Proveedores.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'productos/models/class.Productos.php');

$proveedorId = base64_decode($_GET['id']);

$proveedores = new Proveedor();
$productos = new Productos();

$infoProv = $proveedores->getProveedor($proveedorId);
$infoProv = end($infoProv);
$list = $proveedores->GetDataProductProveedor($proveedorId);
/*
echo "<pre>";
    print_r($infoProv);
echo "</pre>";  
*/
foreach($list as $key => $value){
    $productId = $value['producto_id'];
    $categoria = $productos->GetProductCategory($productId);
    $material = $productos->GetProductMaterial($productId);
    $color = $productos->GetProductColor($productId);        
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
                <strong>Productos por proveedor <?php echo $infoProv['proveedor_nombre']?></strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" >
                + Nuevo Producto 
                </button>
        </div>
    </div>
</div>



<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-content">
                <div class="">
                    <table id="tablaProductosProveedor" class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>                            
                            <th>SKU</th>
                            <th>Nombre</th>
                            <th>Categoria</th>                            
                            <th>Color</th>
                            <th>Material</th>                            
                            <th>Costo compra</th>
                            <th>Costo publico</th>
                            <th>Galeria</th>
                            <th>Acciones</th>                            
                        </tr>
                        </thead>
                        <tbody id='catalogoProductos'>
                        <?php                                                
                        foreach($list as $item){
                            echo "  <tr>
                                        <td>".$item['producto_sku']."</td>
                                        <td>".$item['producto_name']."</td>
                                        <td>".$item['categoria']."</td>
                                        <td>".$item['color']."</td>
                                        <td>".$item['material']."</td>
                                        <td>".$item['producto_price_utilitarian']."</td>
                                        <td>".$item['producto_price_public']."</td>
                                        <td><a href='galeria.php' target='_blank'>galeria</a></td>    
                                        <td>
                                            <a href='".$raizProy."productos/editar_producto.php?id=".$item['producto_id']."'><i class='fa fa-edit' title='Editar'></i></a>
                                            <a href='#'><i class='fa fa-trash deleteProv' title='Borrar'></i></a>
                                            <a href='#' data-toggle='modal' data-target='#myModal3' 
                                                    data-proveedor='".$infoProv['proveedor_nombre']."'
                                                    data-telefono='".$infoProv['telefono']."'
                                                    data-producto='".$item['producto_id']."'
                                                    data-categoria = '".$item['categoria']."'   
                                                    data-color = '".$item['color']."'   
                                                    data-material = '".$item['material']."'   
                                                    class='nuevoPedido'>Pedido</a>
                                        </td>    
                                    </tr>";
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



<?php 
    require_once $pathProy.'/footer2.php';
?>

<script src="<?php echo $raizProy?>js/plugins/dataTables/datatables.min.js"></script>
<script src="<?php echo $raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>

<link href="<?php echo $raizProy?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

<script src="js/catalogo.js"></script>