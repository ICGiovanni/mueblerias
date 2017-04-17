<?php session_start();
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'clientes/models/class.Clientes.php');
// include $pathProy.'login/session.php';
include $pathProy.'/header.php';
include $pathProy.'/menu.php';

$numProd = 0;
$total = 0;
$subtotal = 0;
$iva = 0;

if(isset($_SESSION['punto_venta']['Productos'])){
    $puntoVenta = $_SESSION['punto_venta'];
    $numProd = count($puntoVenta['Productos']);
    $total = $puntoVenta['Total'];
    $subtotal = $puntoVenta['Subtotal'];
    $iva = $puntoVenta['IVA'];

}
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
                <strong>Ventas</strong>
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
                                <th>Flete</th>
                                <th>Facturación</th>
                                <th>Estatus</th>                                
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="gradeX">
                                <td>1</td>
                                <td>1 <b>HHH-DIV-E6C3</b><br />MESA VENECIA</td>
                                <td>Centro</td>
                                <th>12/Nov/2016<br />11:47 am</th>                                
                                <td>Sergio Gonzalez</td>
                                <td>$1,700.00</td>     
                                <td>Efectivo $500.00<br />Tarjeta $100.00<br /><b>Resta</b> $1,100</td>
                                <td>Seccion 1, Planta baja, Requiere traslado a pie</td>                                    
                                <td>N/R</td>
                                <td>pendiente de pago</td>
                            </tr>
                            <tr class="gradeX">
                                <td>2</td>
                                <td>1<b>POR-DOM-E6D8</b><br />MESA PORTUGAL</td>
                                <td>Allende</td>
                                <th>1/Ene/2017<br />11:47 am</th>
                                <td>Juan Lopez</td>
                                <td>$1,900.00</td>                                
                                <td>Tarjeta $1000.00 1/Ene/2017 11:47 am</td>
                                <td>N/R <br />Flete externo</td>                                    
                                <td>HBGY787878HU8 <br />Juan Lopez</td>                                
                                <td>pendiente de pago</td>
                            </tr>                           
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
