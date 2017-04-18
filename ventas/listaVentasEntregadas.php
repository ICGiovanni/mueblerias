<?php session_start();
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'ventas/models/class.Ventas.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'clientes/models/class.Clientes.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/general/class.General.php');

// include $pathProy.'login/session.php';
include $pathProy.'/header.php';
include $pathProy.'/menu.php';


$insVentas = new Ventas();
$insClientes = new Clientes();
$insGeneral = new General();

$ventas = $insVentas->obtenerVentas(1,0);

?>
<link href="<?php echo $raizProy?>css/plugins/easy-autocomplete/easy-autocomplete.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../css/clientes.css">
<style type="text/css">
    #productosVenta td{
        vertical-align: middle;
    }
</style>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Ventas</h2>
        <ol class="breadcrumb">
            <li>
                <a href="">Lista de ventas</a>
            </li>
            <li class="active">
                <strong>Entregadas</strong>
            </li>
        </ol>
    </div>
</div>


<div class="wrapper wrapper-content animated fadeIn">      
    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-title">
                    &nbsp;
                </div>
                <div id="productos">
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-responsive table-striped table-bordered table-hover dataTables-example" id="table" >
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th style="width: 250px">Productos</th>
                                    <th>Sucursal</th>                                    
                                    <th>Fecha compra</th>
                                    <th>Fecha entrega</th>
                                    <th>Cliente</th>
                                    <th>Total</th>
                                    <th>Pagos</th>
                                    <th>Resta</th>
                                    <th>Flete</th>
                                    <th>Facturación</th>
                                    <th>Estatus</th>                                    
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    foreach($ventas as $venta){
                                        $clienteInfo = $insClientes->GetClientes($venta['id_cliente']);
                                        $flete = 'No Requiere';
                                        if($venta['venta_flete_id']!=0){
                                            $dir = end($insVentas->getAddress($venta['venta_flete_id']));
                                            $flete = $dir['cliente_direccion_calle']."&nbsp;".$dir['cliente_direccion_numero_ext']." &nbsp;".$dir['cliente_direccion_entre_calles'];
                                        }

                                        $factura = 'No Requiere';
                                        if($venta['cliente_direccion_id']!=0){
                                            $dir = end($insVentas->getAddress($venta['cliente_direccion_id']));
                                            $factura = $dir['cliente_direccion_rfc']."<br />".$dir['cliente_direccion_razon_social'];
                                        }
                                        
                                        $pagosInfo = $insVentas->getPagosVenta($venta['venta_id']);
                                        $pagos = 'Sin Pago';
                                        $resta = $venta['monto'];
                                        if($pagosInfo){

                                            $pagos = '';

                                            foreach($pagosInfo as $pago){
                                                $pagos .= number_format($pago['monto'],2,'.',',')."&nbsp;".$pago['general_forma_de_pago_desc']."<br />".$insGeneral->getDate($pago['fecha']);
                                                $resta -= $pago['monto'];
                                            }
                                        }

                                        $productosVenta = $insVentas->obtenerProductosVenta($venta['venta_id']);
                                        $productosMostrar = '';
                                        foreach($productosVenta as $pv){
                                            $productosMostrar .= "<b>".$pv['producto_sku']."</b>&nbsp;".$pv['producto_name']."<br />";
                                        }
                                        echo "<tr>";
                                        echo "<td>".$venta['venta_id']."</td>";
                                        echo "<td>".$productosMostrar."</td>";
                                        echo "<td>".$insVentas->getSucursal($venta['sucursal_id'])."</td>";
                                        echo "<td>".$insGeneral->getDate($venta['fecha_creacion'])."</td>";
                                        echo "<td>".$insGeneral->getDate($venta['fecha_creacion'])."</td>";
                                        echo "<td>".$clienteInfo[0]['nombre']."&nbsp;".$clienteInfo[0]['apellidoP']."&nbsp;".$clienteInfo[0]['apellidoM']."</td>";
                                        echo "<td>".$venta['monto']."</td>";
                                        echo "<td>".$pagos."</td>";
                                        echo "<td>".$resta."</td>";
                                        echo "<td>".$flete."</td>";
                                        echo "<td>".$factura."</td>";
                                        echo "<td>".$insVentas->getEstatusVenta($venta['venta_estatus_id'])."</td>";                                    

                                        echo "</tr>";
                                    }
                                ?>                                                                                                        
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </div>    
</div>

<script src="<?php echo $raizProy?>js/plugins/toastr/toastr.min.js"></script>
<script src="<?php echo $raizProy?>js/plugins/dataTables/datatables.min.js"></script>

<script src="<?php echo $raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>
<link href="<?php echo $raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<!-- Page-Level Scripts -->
<script>

    $(document).ready(function () {
        $('#table').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [],
            "language": {
                "url": "../js/plugins/dataTables/Spanish.json"
            }
        });
    });

</script>

<?php
include $pathProy.'footer.php';
?>
