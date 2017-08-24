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

$apartados = $insVentas->obtenerApartados();

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
                <strong>Vigentes</strong>
            </li>
        </ol>
    </div>
</div>


<div class="wrapper wrapper-content animated fadeIn">

    <div class="row">
        <div class="col-md-12">
            <div class="">
                <div class="ibox-title">
                    &nbsp;
                </div>
                <div id="productos">
                    <div class="ibox-content">      
                        <div class="table table-responsive">
                    <table class="table table-striped table-responsive table-bordered table-hover dataTables-example" id="table" style='font-size: 12px' >
                            <thead>
                            <tr>
                                <th>Id</th>                                
                                <th>Prod</th>
                                <th>Sucursal</th>                                    
                                <th>Fecha Compra</th>                                
                                <th>Cliente</th>
                                <th>Total</th>
                                <th>Resta</th>
                                <th>Pagos</th>
                                <th>Flete</th>
                                <th>Fact</th>
                                <th>Estatus</th>                                
                                <th>Accion</th>                                
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($apartados as $venta){
                                    
                                    $clienteInfo = $insClientes->GetClientes($venta['id_cliente']);
                                    $flete = '';
                                    if($venta['venta_flete_id']!=0){
                                        $dir = end($insVentas->getAddress($venta['venta_flete_id']));
                                        $flete = $dir['cliente_direccion_calle']."&nbsp;".$dir['cliente_direccion_numero_ext']." &nbsp;".$dir['cliente_direccion_entre_calles'];
                                    }

                                    $factura = '';
                                    if($venta['cliente_direccion_id']!=0){
                                        $dir = end($insVentas->getAddress($venta['cliente_direccion_id']));
                                        $factura = $dir['cliente_direccion_rfc']."<br />".$dir['cliente_direccion_razon_social'];
                                    }
                                    
                                    $pagosInfo = $insVentas->getPagosVenta($venta['venta_id']);
                                    $pagos = '';
                                    $resta = $venta['monto'];
                                    if($pagosInfo){
                                        
                                        $pagos = '';
                                        
                                        foreach($pagosInfo as $pago){
                                            $pagos .= "$ ".number_format($pago['monto'],2,'.',',')."<br />".$pago['general_forma_de_pago_desc']."<br />".$insGeneral->getDate($pago['fecha'])."<br />-----------<br />";
                                            $resta -= $pago['monto'];
                                        }


                                    }
                                    
                                    $productosVenta = $insVentas->obtenerProductosVenta($venta['venta_id']);
                                    $productosMostrar = '';
                                    foreach($productosVenta as $pv){                                        
                                        $productosMostrar .= "<b>".$pv['producto_sku']."</b>  ".$pv['producto_name']."<br />";
                                    }
                                    $productosMostrar.='<br />';
                                    
                                    $clienteTable = $clienteInfo[0]['nombre']."<br />".$clienteInfo[0]['apellidoP']."<br />".$clienteInfo[0]['apellidoM'];
                                    echo "<tr>";  
                                    echo "<td>".$venta['venta_id']."</td>";
                                    echo "<td class='text-center'><a href='#' data-content='".$productosMostrar."' data-title='".count($productosVenta)." productos en venta ID: ".$venta['venta_id']."' class='showDialog'>".count($productosVenta)."</a></td>";
                                    echo "<td>".$insVentas->getSucursal($venta['sucursal_id'])."</td>";
                                    echo "<td>".$insGeneral->getDate($venta['fecha_creacion'])."</td>";                                    
                                    echo "<td class='text-center'><a href='#' data-content='".$clienteTable."' data-title='Información de cliente' class='showDialog'><i class='fa fa-eye success'></i></a></td>";
                                    echo "<td><b>$".number_format($venta['monto'],2,'.',',')."</b></td>";
                                    echo "<td><b>$".number_format($resta,2,'.',',')."</b></td>";
                                    echo "<td class='text-center'>";
                                        if(!empty($pagos)){
                                            echo "<a href='#' data-content='".$pagos."' data-title='Pagos realizados' class='showDialog'><i class='fa fa-eye success'></i></a>";
                                        }else{
                                            echo "<i class='fa fa-eye-slash text-danger'></i>";
                                        }
                                    echo "</td>";
                                    echo "<td class='text-center'>";
                                        if(!empty($flete)){
                                            echo "<a href='#' data-content='".$flete."' data-title='Enviar a la dirección' class='showDialog'><i class='fa fa-eye success'></i></a>";
                                        }else{
                                            echo "<i class='fa fa-eye-slash text-danger'></i>";
                                        }
                                    echo "</td>";
                                    echo "<td>";
                                        if(!empty($factura)){
                                            echo "<a href='#' data-content='".$factura."' data-title='Dirección de facturación' class='showDialog'><i class='fa fa-eye success'></i></a>";
                                        }else{
                                            echo "<i class='fa fa-eye-slash text-danger'></i>";
                                        }
                                    echo "</td>";
                                    echo "<td>".$insVentas->getEstatusVenta($venta['venta_estatus_id'])."</td>";                                    
                                    echo "<td class='text-center'>
                                            <a href='#'><i class='fa fa-pencil' title='Editar'></i></a>&nbsp;&nbsp;&nbsp;
                                          </td>";                                    

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

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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
        
       $(document).on("click", ".add_note", function(e) {
           
         $( "#dialog" ).dialog( "open" );  
           
       }); 
       
       $(document).on("click", ".closeDialog", function(e) {
           
         $( "#dialog" ).dialog( "close" );
         $( "#dialogDetalles" ).dialog( "close" );
           
       });
       
        $( "#dialog" ).dialog({
            autoOpen: false,
            modal: true,
            show: {
              effect: "fade"              
            },
            hide: {
              effect: "fade"              
            }
        });

        $( "#dialogDetalles" ).dialog({
            autoOpen: false,
            modal: true,
            show: {
                effect: "fade"
            },
            hide: {
                effect: "fade"
            }
        });

        $(document).on("click", ".showDialog", function(e){

            $("#titulo_dialog").html($(this).data('title'));
            $("#content_dialog").html($(this).data('content'));

            $( "#dialogDetalles" ).dialog( "open" );


        });
    });

</script>
<div class="panel panel-primary" id="dialog">        
    <label>Ingresa nota de Entrega</label>
    <textarea></textarea>
    <br />
    <button class="btn btn-danger closeDialog">Cancelar</button>
    <button class="btn btn-success">Guardar</button>    
</div>

<div class="panel panel-primary" id="dialogDetalles">
    <label id="titulo_dialog"></label>
    <div id="content_dialog"></div>
    <button class="btn btn-danger closeDialog">Cerrar</button>
</div>
<?php
include $pathProy.'footer.php';
?>
