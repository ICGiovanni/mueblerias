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
                <a href="">Lista de Ventas</a>
            </li>
            <li class="active">
                <strong>Ventas por Entregar</strong>
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
                        <table class="table table-striped" id="table" >
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th >Productos</th>
                                <th>Sucursal</th>                                    
                                <th>Fecha Compra</th>
                                <th>Fecha Entrega</th>
                                <th>Cliente</th>
                                <th>Total</th>
                                <th>Pagos</th>
                                <th>Flete</th>
                                <th>Facturación</th>
                                <th>Estatus</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="gradeX">
                                <td>1</td>
                                <td>4 <b>HHH-DIV-E6C3</b><br />MESA VENECIA</td>
                                <td>Oficina Central</td>
                                <td>12/Nov/2016<br />11:47 am</td>
                                <th>12/Nov/2016<br />11:47 am</th>                                    
                                <td>Mostrador</td>
                                <td>$1,700.00</td>                                                                        
                                <td>Efectivo $500.00<br />Tarjeta $1,200.00</td>
                                <td>Seccion 1, Planta baja, Requiere traslado a pie</td>                                    
                                <td>N/R</td>
                                <td>Pagado</td>    
                                <td align="center"><a href="#" title="Editar Venta"><i class="fa fa-pencil"></i></a>&nbsp;<a href="#" title="Borrar Venta"><i class="fa fa-trash-o" onclick="$(this).parent().parent().parent().remove()"></i></a></td>
                            </tr>
                            <tr class="gradeX">
                                <td>2</td>
                                <td>1 <b>POR-DOM-E6D8</b><br />MESA PORTUGAL</td>
                                <td>Allende</td>
                                <td>1/Ene/2017<br />11:47 am</td>
                                <th>13/Ene/2017<br />11:47 am</th>                                    
                                <td>Juan Lopez</td>
                                <td>$1,900.00</td>                                                                        
                                <td>Efectivo $500.00<br /><b>Resta $1,400</b></td>
                                <td>N/R <br />Flete externo</td>                                    
                                <td>HBGY787878HU8 <br />Juan Lopez</td>
                                <td>Pendiente</td>    
                                <td align="center"><a href="#" title="Editar Venta"><i class="fa fa-pencil"></i></a>&nbsp;<a href="#" title="Borrar Venta"><i class="fa fa-trash-o"></i></a></td>                                                                                                            
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
        
        $('#table .fa-trash-o').click(function(){
            var opc = confirm('¿desea cancelar el pedido?');
            if(opc){
                $(this).parent().parent().parent().remove();
            }    
        });
    });

</script>

<?php
include $pathProy.'footer.php';
?>
