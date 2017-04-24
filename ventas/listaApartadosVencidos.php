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

$apartados = $insVentas->obtenerApartados(0,2);

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
        <h2>Apartados</h2>
        <ol class="breadcrumb">
            <li>
                <a href="">Lista de Apartados</a>
            </li>
            <li class="active">
                <strong>Vencidos</strong>
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
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="table" >
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th style="width: 250px">Productos</th>
                                <th>Sucursal</th>                                    
                                <th>Fecha</th>
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
                                foreach($apartados as $apartado){
                                    $clienteInfo = $insClientes->GetClientes($apartado['id_cliente']);
                                    $flete = 'No Requiere';
                                    if($apartado['venta_flete_id']!=0){
                                        $dir = end($insVentas->getAddress($apartado['venta_flete_id']));
                                        $flete = $dir['cliente_direccion_calle']."&nbsp;".$dir['cliente_direccion_numero_ext']." &nbsp;".$dir['cliente_direccion_entre_calles'];
                                    }
                                    
                                    $factura = 'No Requiere';
                                    if($apartado['cliente_direccion_id']!=0){
                                        $dir = end($insVentas->getAddress($apartado['cliente_direccion_id']));
                                        $factura = $dir['cliente_direccion_rfc']."<br />".$dir['cliente_direccion_razon_social'];
                                    }
                                    echo "<tr>";
                                    echo "<td>".$apartado['venta_id']."</td>";
                                    echo "<td>Productos</td>";
                                    echo "<td>".$insVentas->getSucursal($apartado['sucursal_id'])."</td>";
                                    echo "<td>".$insGeneral->getDate($apartado['fecha_creacion'])."</td>";
                                    echo "<td>".$clienteInfo[0]['nombre']."&nbsp;".$clienteInfo[0]['apellidoP']."&nbsp;".$clienteInfo[0]['apellidoM']."</td>";
                                    echo "<td>".$apartado['monto']."</td>";
                                    echo "<td>Pagos</td>";
                                    echo "<td>Resta</td>";
                                    echo "<td>".$flete."</td>";
                                    echo "<td>".$factura."</td>";
                                    echo "<td>".$insVentas->getEstatusVenta($apartado['venta_estatus_id'])."</td>";                                    
                                    
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
