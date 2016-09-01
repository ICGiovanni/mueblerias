<?php
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once $pathProy.'/header.php';
require_once $pathProy.'/menu.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'gastos/models/class.Gastos.php');

$objGasto = new Gasto();

$rows = $objGasto->getGastosNomina();

$rowsPrestamos = $objGasto->getGastosPrestamos();
while(list(,$dataGasto) = each($rowsPrestamos)){
	$dataGastoPrestamo[$dataGasto["login_id"]]=$dataGasto["gasto_monto"];
}

$rowsComisiones = $objGasto->getGastosComisiones();
while(list(,$dataGasto) = each($rowsComisiones)){
	$dataGastoComisiones[$dataGasto["login_id"]]=$dataGasto["gasto_monto"];
}

$rowsGastosSucursal = $objGasto->getGastosSucursal();


$asoccGastoSucursal = array();
$options_sucursal_id = '';
while(list(,$dataGastoSucursal) = each($rowsGastosSucursal)){
	$asoccGastoSucursal[$dataGastoSucursal["sucursal_id"]]=$dataGastoSucursal["sucursal_name"];
	$options_sucursal_id.='<option value="'.$dataGastoSucursal["sucursal_id"].'">'.$dataGastoSucursal["sucursal_name"].'</option>';	
}

//print_r($rows);
//print_r($rowsPrestamos);

$html_rows = '';


while(list(,$dataGasto) = each($rows)){
	$rowPagos = $objGasto->getPagosSum($dataGasto["gasto_id"]);
	$rowPagos=$rowPagos[0];
	
	$pagado=0;
	$restanEsteMes=0;
	
	
	$prestamo_activo = 0;
	$aCuentaEsteMes = 'N/A';
	
	if(isset($dataGastoPrestamo[$dataGasto["login_id"]])){
		$prestamo_activo = $dataGastoPrestamo[$dataGasto["login_id"]];
		$aCuentaEsteMes = '$ <input type="text" name="aCuentaEsteMes_'.$dataGasto["login_id"].'" id="aCuentaEsteMes_'.$dataGasto["login_id"].'" size="5"/>';
	}
	
	$comision_activa = 0;
	
	if(isset($dataGastoComisiones[$dataGasto["login_id"]])){
		$comision_activa = $dataGastoComisiones[$dataGasto["login_id"]];
	}
	
	$totalPagarEsteMes=$dataGasto["gasto_monto"] + $comision_activa;
	
	$html_rows.= '<tr>
		<td align="left">'.$dataGasto["firstName"].' '.$dataGasto["lastName"].'</td>
		<td align="right">$ '.number_format($dataGasto["gasto_monto"],2).'</td>
		<td align="right">$ '.number_format($comision_activa,2).'</td>
		<td align="right">$ '.number_format($prestamo_activo,2).'</td>
		<td align="right">$ '.$pagado.'</td>
		<td style="width:75px; text-align:right;">'.$aCuentaEsteMes.'</td>
		<td align="right">$ '.number_format($restanEsteMes,2).'</td>
		<td align="right">$ '.number_format($totalPagarEsteMes,2).'</td>
	</tr>';
}



?>
<!-- Data picker -->
<link href="<?=$raizProy?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="<?=$raizProy?>css/plugins/clockpicker/clockpicker.css" rel="stylesheet">


<style>
.glyphicon-refresh-animate {
    -animation: spin .9s infinite linear;
    -webkit-animation: spin2 .9s infinite linear;
}

@-webkit-keyframes spin2 {
    from { -webkit-transform: rotate(0deg);}
    to { -webkit-transform: rotate(360deg);}
}

@keyframes spin {
    from { transform: scale(1) rotate(0deg);}
    to { transform: scale(1) rotate(360deg);}
}
.table-form td, th{
	padding: 5px;
}
</style>
		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Gastos</h5>
                        <div class="ibox-tools">
							
                            <button type="button" class="btn btn-primary btn-xs"  onclick="location.href = 'nuevo/';" >+ Nuevo Gasto</button>
                            <!--<a class="collapse-link">
                                <i class="fa fa-plus-square-o"></i>
                            </a>
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>-->
							
                        </div>
                    </div>
                    <div class="ibox-content">
					<div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
						<th>Empleado</th>
                        <th style="text-align:right;">Salario</th>
                        <th style="text-align:right;">Comision</th>
						<th style="text-align:right;">Prestamo</th>
						<th style="text-align:right;">Pagado</th>
						<th style="text-align:right;">A cuenta</th>
                        <th style="text-align:right;">Restan</th>
						<th style="text-align:right;">Total</th>
                    </tr>
                    </thead>
                    <tbody>
						<?=$html_rows?>
                    </tbody>
                    <tfoot>
                    <tr>
						<th>Empleado</th>
                        <th style="text-align:right;">Salario</th>
                        <th style="text-align:right;">Comision</th>
						<th style="text-align:right;">Prestamo</th>
						<th style="text-align:right;">Pagado</th>
						<th style="text-align:right;">A cuenta</th>
                        <th style="text-align:right;">Restan</th>
						<th style="text-align:right;">Total</th>
                    </tr>
                    </tfoot>
                    </table>
                        </div>

                    </div>
                </div>
            </div>
            </div>
            
        </div>
        <div class="footer">
            <div>
                <strong>Copyright</strong> 
            </div>
        </div>

        </div>
        </div>
		
    <!-- Mainly scripts -->
	
	
    <script src="<?=$raizProy?>js/jquery-2.1.1.js"></script>
    <script src="<?=$raizProy?>js/bootstrap.min.js"></script>
    <script src="<?=$raizProy?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?=$raizProy?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?=$raizProy?>js/plugins/jeditable/jquery.jeditable.js"></script>

    <script src="<?=$raizProy?>js/plugins/dataTables/datatables.min.js"></script>
	

	<script src="<?=$raizProy?>js/plugins/datapicker/bootstrap-datepicker.js"></script>
	<script src="<?=$raizProy?>js/plugins/datapicker/bootstrap-datepicker.es.js"></script>
	<script src="<?=$raizProy?>js/plugins/clockpicker/clockpicker.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?=$raizProy?>js/inspinia.js"></script>
    <script src="<?=$raizProy?>js/plugins/pace/pace.min.js"></script>

    <!-- Page-Level Scripts -->
    

<script>

$(document).ready(function(){
	
	$('.dataTables-example').DataTable({
				searching: false,
				ordering:  false,
				paging: false,
                dom: '<"html5buttons"B>lTfgitp',
				"language": {
					"lengthMenu": "Display _MENU_ records per page",
					"zeroRecords": "Nothing found - sorry",
					"info": "Mostrando _MAX_ entradas",
					"infoEmpty": "No records available",
					"infoFiltered": "(filtered from _MAX_ total records)"
				},
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},
                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });
	
	
     $.fn.datepicker.defaults.language = 'es';
	
	$('#data_rango_inicio .input-group.date').datepicker({
	keyboardNavigation: false,
	forceParse: false,
	autoclose: true,
	language: 'es'
	}).datepicker("setDate", "0");
	
	$('#data_rango_fin .input-group.date').datepicker({
	keyboardNavigation: false,
	forceParse: false,
	autoclose: true,
	language: 'es'
	}).datepicker("setDate", "0");

});
</script>

</body>

</html>