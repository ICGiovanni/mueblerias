<?php session_start();
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once $pathProy.'/header2.php';
require_once $pathProy.'/menu.php';

require_once($_SERVER["REDIRECT_PATH_CONFIG"].'proveedores/models/class.Proveedores.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'productos/models/class.Productos.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'inventarios/models/class.Inventarios.php');


$proveedorId = '';
if(isset($_GET['id'])){
    $proveedorId = base64_decode($_GET['id']);
}
$proveedores = new Proveedor();
$productos = new Productos();
$inventarios = new Inventarios();

$infoProv = $proveedores->getProveedor($proveedorId);
$infoProv = end($infoProv);
$list = $proveedores->GetDataProductProveedor($proveedorId);

$proveedoresList = $proveedores->getProveedores(); 
$sucursalesList = $inventarios->GetSucursales();
?>  
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Pedidos</h2>
        <ol class="breadcrumb">
            <li>
                <a href="">Pedidos</a>
            </li>
            <li class="active">
                <strong>Nuevo Pedido</strong>
            </li>
        </ol>
    </div>    
    <div class="col-sm-8">
        <div class="title-action">
            <a href="index.php" class="btn btn-warning btn-xs"><i class="fa fa-arrow-left"></i> Regresar a listado</a>
        </div>
    </div>
</div>



<div class="wrapper wrapper-content animated fadeIn form-horizontal">           
    <form id='form_proveedor'>
        <div class="form-group">
            <label class="col-sm-2 control-label">Selecciona Proveedor</label>
            <div class="col-sm-6" >
                <select data-placeholder="Selecciona un proveedor" class="chosen-select form-control" tabindex="4" id="proveedor" name="id">                            
                    <option value='0'>&nbsp;</option>
                    <?php 

                        foreach($proveedoresList as $itemProv){
                            $selected ='';
                            if($proveedorId == $itemProv['proveedor_id']){
                                $selected = "selected='selected'";
                            }
                            echo "<option value='".base64_encode($itemProv['proveedor_id'])."' ".$selected.">".$itemProv['proveedor_nombre']."</option>";
                        }
                    ?>
                </select>                    
            </div>                
        </div>                         
    </form>
<?php
    if($proveedorId!=0){         
?>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Selecciona Productos</label>
        <div class="col-sm-5" >
            <select data-placeholder="Selecciona un producto" class="chosen-select form-control"  tabindex="4" id="selectProducto" name="productos">                            
                <option value='0'></option>
                <?php 
                    foreach($list as $product){                        
                        echo "<option value='".$product['producto_id']."'>".$product['producto_sku']."&nbsp;".$product['producto_name']."</option>";
                    }
                ?>
            </select> 
            <?php                
                foreach($list as $product){
                    
                    echo "<div style='display: none' id='producto_".$product['producto_id']."' 
                            data-sku='".$product['producto_sku']."'
                            data-modelo='".$product['producto_name']."'
                            data-precio='".$product['producto_price_purchase']."'
                            ></div>";
                }
            ?>
        </div>
        <div class="col-sm-1" style='padding-top: 5px'>
            <button type="button" class="btn btn-primary btn-xs" style='display: inline' id="agregarProducto">Agregar</button>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-8">
            <table class="table table-responsive table-striped">
                <tr>
                    <th>SKU</th>
                    <th>Modelo</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                </tr>
                <tbody id="listaProductos">

                </tbody>
                <tfoot>
                    <th colspan="3" class="text-right">Total</th>
                    <th id="totalPedido" class="text-right"></th>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Selecciona Sucursal</label>
        <div class="col-sm-6" >
            <select data-placeholder="Selecciona una sucursal" class="chosen-select form-control"  tabindex="4" id="selectSucursal" name="selectSucursal">                            
                <option value='0'></option>
                <?php 
                    foreach($sucursalesList as $sucursal){                        
                        echo "<option value='".$sucursal['sucursal_id']."'>".$sucursal['sucursal_name']."</option>";
                    }
                ?>
            </select>            
        </div>                
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Fecha de entrega</label>
        <div class="col-sm-6">
            <div class="input-group date">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input class="form-control" value="" type="text" id="fechaEntrega">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Fecha Recordatorio</label>
        <div class="col-sm-6">
            <div class="input-group date">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input class="form-control" value="" type="text" id="fechaRecordatorio">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Observaciones</label>
        <div class="col-sm-6">
            <textarea id="observaciones" rows="5" style="width: 100%" class="form-control"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Copiar en E-mail</label>
        <div class="col-sm-6">
            <input type="text" name="email" id="email" value="" class="form-control">
        </div>
    </div>
     <div class="form-group">        
        <div class="col-sm-8 text-right">
            <button class='btn btn-primary btn-xs' id='crearPedido'>Guardar</button>
        </div>
    </div>
<?php    
    }
?>
</div>
  


<?php 
    require_once $pathProy.'/footer2.php';
?>
<script src="<?php echo $raizProy?>proveedores/js/pedidos.js"></script>

<script src="<?php echo $raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo $raizProy?>js/plugins/chosen/chosen.jquery.js"></script>
<script src="<?php echo $raizProy?>js/plugins/datapicker/bootstrap-datepicker.js"></script>

<link href="<?php echo $raizProy?>css/plugins/chosen/chosen.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<script>
    $(document).ready(function(){
        $("#proveedor").chosen();
        $("#productos").chosen();
    });
</script>    