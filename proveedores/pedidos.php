<?php session_start();
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once $pathProy.'/header2.php';
require_once $pathProy.'/menu.php';

require_once($_SERVER["REDIRECT_PATH_CONFIG"].'proveedores/models/class.Proveedores.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'proveedores/models/class.Pedidos.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'productos/models/class.Productos.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/general/class.General.php');

$productos = new Productos();
$pedidos = new Pedidos();
$general = new General();
$listaPedidos = $pedidos->getPedidos();
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Pedidos</h2>
        <ol class="breadcrumb">
            <li>
                <a href="">Pedidos</a>
            </li>
            <li class="active">
                <strong>Listado de pedidos</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
        </div>
    </div>
</div>



<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-content">
                <div class="">
                    <table id="tablaPedidos" class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>                            
                            <th>Pedido</th>
                            <th>Proveedor</th>
                            <th>Producto</th>
                            <th>Categoria</th>                            
                            <th>Color</th>                            
                            <th>Material</th>
                            <th>Fecha de entrega</th>                            
                            <th>Acciones</th>                            
                        </tr>
                        </thead>
                        <tbody id='listaPedidos'>
                        <?php                                 
                        
                        foreach($listaPedidos as $item){
                            $productId = $item['producto_id'];
                            $categoria = $productos->GetProductCategory($productId);
                            $material = $productos->GetProductMaterial($productId);
                            $color = $productos->GetProductColor($productId);        
                            echo "  <tr>
                                        <td>".$item['pedido_id']."</td>
                                        <td>".$item['proveedor_nombre']."</td>
                                        <td>".$item['producto_name']."</td>                                        
                                        <td>".implode(",", $categoria)."</td>
                                        <td>".implode(",", $color)."</td>
                                        <td>".implode(",", $material)."</td> 
                                        <td>".$general->getDate($item['fecha_entrega'])."</td> 
                                        <td>
                                            <a href='#' data-toggle='modal' data-target='#myModal'>
                                                <i class='fa fa-edit editPedido'
                                                    data-proveedor='".$item['proveedor_nombre']."'
                                                    data-categorias='".implode(",", $categoria)."'
                                                    data-colores='".implode(",", $color)."'
                                                    data-materiales='".implode(",", $material)."'
                                                    data-telefono='".$item['telefono']."'
                                                    data-stock='".$item['stock']."'
                                                    data-fecha='".substr($item['fecha_entrega'],0,10)."'   
                                                    data-costo='".$item['costo_total']."'   
                                                    data-observaciones='".$item['observaciones']."'  
                                                    data-pedido='".$item['pedido_id']."'  
                                                        
                                                    title='Editar'></i>
                                            </a>
                                            <a href='#'><i class='fa fa-trash deletePedido' data-producto='".$item['producto_name']."' data-pedido='".$item['pedido_id']."' title='Borrar'></i></a>                                            
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
                <h3 class="modal-title">Editar Pedido </h3>
            </div>
            <div class="modal-body" style="padding-bottom: 0px !important; margin-bottom: -15px !important">    
                <input type="hidden" id="pedido_id" val='' />
                <?php include 'pedidoTemplate.php' ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary btn-xs" id="btn_editar_pedido" >Guardar</button>
            </div>
        </div>
    </div>
</div>

<?php 
    require_once $pathProy.'/footer2.php';
?>

<script src="<?php echo $raizProy?>js/plugins/dataTables/datatables.min.js"></script>
<script src="<?php echo $raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo $raizProy?>js/plugins/datapicker/bootstrap-datepicker.js"></script>


<link href="<?php echo $raizProy?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">

<script src="js/pedidos.js"></script>






