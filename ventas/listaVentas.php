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
                <a href="">Lista de pedidos</a>
            </li>
            <li class="active">
                <strong>Pedidos</strong>
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
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="table" >
                                <thead>
                                <tr>
                                    <th>ID Venta</th>
                                    <th>Productos</th>
                                    <th>Total</th>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
                                    <th>Facturación</th>
                                    <th>Pago</th>
                                    <th>Estatus</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr class="gradeX">
                                    <td>1</td>
                                    <td>1 HHH-DIV-E6C3 MESA VENECIA</td>
                                    <td>$1,700.00</td>
                                    <th>12/Nov/2016<br />
                                        11:47 am</th>
                                    <td>Mostrador</td>
                                    <td>N/R</td>
                                    <td>Efectivo $500.00<br />Tarjeta $1,200.00</td>
                                    <td>Por entregar</td>
                                </tr>
                                <tr class="gradeX">
                                    <td>2</td>
                                    <td>1 POR-DOM-E6D8 MESA PORTUGAL</td>
                                    <td>$1,900.00</td>
                                    <th>1/Ene/2017<br />
                                        11:47 am</th>
                                    <td>Juan Lopez</td>
                                    <td>HBGY787878HU8 <br />Juan Lopez</td>
                                    <td>Tarjeta $1900.00</td>
                                    <td>Entregado</td>
                                </tr>
                                <tr class="gradeX">
                                    <td>3</td>
                                    <td>1 ITA-DOM-E6L2 MESA ITALIA</td>
                                    <td>$2,400.00</td>
                                    <th>21/Ene/2017<br />
                                        11:47 am</th>
                                    <td>Pedro Mendoza</td>
                                    <td>N/R</td>
                                    <td>N/R</td>
                                    <td>Por pagar</td>
                                </tr>
                                <tr class="gradeX">
                                    <td>4</td>
                                    <td>1 POR-DOM-E6D8 MESA PORTUGAL</td>
                                    <td>$1,900.00</td>
                                    <th>1/Feb/2017<br />
                                        11:47 am</th>
                                    <td>Diego Terron</td>
                                    <td>N/R</td>
                                    <td>Efectivo $1900.00</td>
                                    <td>Cancelado</td>
                                </tr>
                                <tr class="gradeX">
                                    <td>5</td>
                                    <td>1 POR-DOM-E6D8 MESA ROMA</td>
                                    <td>$1,300.00</td>
                                    <th>11/Feb/2017<br />
                                        11:47 am</th>
                                    <td>Juan Lopez</td>
                                    <td>HBGY787878HU8 <br />Juan Lopez</td>
                                    <td>Tarjeta $1300.00</td>
                                    <td>Pagado</td>
                                </tr>
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
