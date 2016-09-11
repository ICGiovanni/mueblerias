<?php
session_start();
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once $pathProy.'/header.php';
require_once $pathProy.'/menu.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'gastos/models/class.Gastos.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'ingresos/models/class.Ingresos.php');

$objGasto = new Gasto();
$objIngreso = new Ingreso();

$rows = $objGasto->getGastosNomina();

$rowsPrestamos = $objGasto->getGastosPrestamos();
while(list(,$dataGasto) = each($rowsPrestamos)){
	$dataGastoPrestamo[$dataGasto["login_id"]]["gasto_monto"]=$dataGasto["gasto_monto"];
	$dataGastoPrestamo[$dataGasto["login_id"]]["gasto_id"]=$dataGasto["gasto_id"];
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
	
	$sumaPagado["ingreso_monto"]=0;
	if(isset($dataGastoPrestamo[$dataGasto["login_id"]])){
		$sumaPagado = $objIngreso->getSumIngresosPrestamos($dataGastoPrestamo[$dataGasto["login_id"]]["gasto_id"]);
		$sumaPagado = $sumaPagado[0];
		if(empty($sumaPagado["ingreso_monto"])){
			$sumaPagado["ingreso_monto"] = 0;
		}
	}
	
	$prestamo_activo = 0;
	$aCuentaEsteMes = '';
	$span_total_id = '';
	$span_restan_id = '';
	$span_restarian_id = '';
	$span_total_original_id = '';
	$boton_aplica_nomina = '';
	$onclick_aplicaPagoPrestamo = '';
	if(isset($dataGastoPrestamo[$dataGasto["login_id"]])){
		$onclick_aplicaPagoPrestamo = 'aplicaPagoPrestamo(\''.$dataGastoPrestamo[$dataGasto["login_id"]]["gasto_id"].'\',\''.$dataGasto["login_id"].'\'); ';
		$prestamo_activo = $dataGastoPrestamo[$dataGasto["login_id"]]["gasto_monto"];
		$aCuentaEsteMes = '$ <input type="text" name="aCuentaEsteMes_'.$dataGasto["login_id"].'" id="aCuentaEsteMes_'.$dataGasto["login_id"].'" size="5" onchange="updateRestanTotal('.$dataGasto["login_id"].');" value="0" data-gasto-id-prestamo="'.$dataGastoPrestamo[$dataGasto["login_id"]]["gasto_id"].'"/>';
		$span_total_id = 'span_total_'.$dataGasto["login_id"];
		
		$span_restarian_id = 'span_restarian_'.$dataGastoPrestamo[$dataGasto["login_id"]]["gasto_id"];
		$span_restan_id = 'span_restan_'.$dataGastoPrestamo[$dataGasto["login_id"]]["gasto_id"];
	}
	$span_total_original_id = 'span_total_original_'.$dataGasto["login_id"];
	
	if($dataGasto["gasto_status_id"] == "1"){
		$boton_aplica_nomina = '<a href="javascript:void(0);" onclick="'.$onclick_aplicaPagoPrestamo.'creaPagoSalario(\''.$dataGasto["gasto_id"].'\',\''.$dataGasto["login_id"].'\'); "><i class="fa fa-floppy-o"></i></a>';
	} else {
		$boton_aplica_nomina = '<i class="fa fa-check-square-o"></i>';
	}
	
	
	$comision_activa = 0;
	
	if(isset($dataGastoComisiones[$dataGasto["login_id"]])){
		$comision_activa = $dataGastoComisiones[$dataGasto["login_id"]];
	}
	
	$totalPagarEsteMes=$dataGasto["gasto_monto"] + $comision_activa;
	
	$restanEsteMes= $prestamo_activo - $sumaPagado["ingreso_monto"];
	
	$html_rows.= '<tr id="row_salary_'.$dataGasto["login_id"].'">
		<td align="left">'.$dataGasto["firstName"].' '.$dataGasto["lastName"].'</td>
		<td align="right">$ '.number_format($dataGasto["gasto_monto"],2).'</td>
		<td align="right">$ <span id="salario_diario_'.$dataGasto["login_id"].'">'.number_format(($dataGasto["gasto_monto"]/7),2).'</span></td>
		<td align="right">$ '.number_format($comision_activa,2).'</td>
		<td align="center"> <input type="checkbox" name="dia_extra_'.$dataGasto["login_id"].'" id="dia_extra_'.$dataGasto["login_id"].'" onclick="updateRestanTotal('.$dataGasto["login_id"].');" /> </td>
		<td align="center"> <input type="checkbox" name="dia_descuento_'.$dataGasto["login_id"].'" id="dia_descuento_'.$dataGasto["login_id"].'" onclick="updateRestanTotal('.$dataGasto["login_id"].');" /> </td>
		<td align="right">$ <input type="text" name="dia_descuento_penalizacion_'.$dataGasto["login_id"].'" id="dia_descuento_penalizacion_'.$dataGasto["login_id"].'" size="5" onchange="updateRestanTotal('.$dataGasto["login_id"].');" value="0" disabled /> </td>
		<td align="right">$ '.number_format($prestamo_activo,2).'</td>
		<td align="right">$ '.number_format($sumaPagado["ingreso_monto"],2).'</td>
		<td align="right">$ <span id="'.$span_restan_id.'">'.number_format($restanEsteMes,2).'</span></td>		
		<td style="width:85px; text-align:right;">'.$aCuentaEsteMes.'</td>
		<td align="right">$ <span id="'.$span_restarian_id.'">'.number_format($restanEsteMes,2).'</span></td>
		<td align="right">
			$ <span id="'.$span_total_id.'">'.number_format($totalPagarEsteMes,2).'</span>
			<span id="'.$span_total_original_id.'" style="display:none;">'.$totalPagarEsteMes.'</span>
		</td>
		<td align="right"> '.$boton_aplica_nomina.'</td>
	</tr>';
}

?>
<!-- Data picker -->
<link href="<?=$raizProy?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="<?=$raizProy?>css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
<!-- FooTable -->
<link href="<?=$raizProy?>css/plugins/footable/footable.core.css" rel="stylesheet">

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
                        <h5>NOMINA</h5>
                        <div class="ibox-tools">

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
                    <table class="footable table table-bordered dataTables-example toggle-square" >
                    <thead>
                    <tr>
						<th>Empleado</th>
                        <th data-hide="all" style="text-align:right;">Salario Semanal</th>
						<th data-hide="all" style="text-align:right;">Salario Diario</th>
                        <th data-hide="all" style="text-align:right;">Comision</th>
						<th style="text-align:right;">Día Extra</th>
						<th style="text-align:right;">Día Descuento</th>
						<th style="text-align:right;">Penalización</th>
						<th style="text-align:right;">Prestamo</th>
						<th style="text-align:right;">Pagado</th>
						<th style="text-align:right;">Restan</th>
						<th style="text-align:right;">A cuenta</th>
                        <th style="text-align:right;">Restarian</th>
						<th style="text-align:right;">Total</th>
						<th style="text-align:right;"></th>
                    </tr>
                    </thead>
                    <tbody>
						<?=$html_rows?>
                    </tbody>
                    
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
	
	 <!-- FooTable -->
    <script src="<?=$raizProy?>js/plugins/footable/footable.all.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?=$raizProy?>js/inspinia.js"></script>
    <script src="<?=$raizProy?>js/plugins/pace/pace.min.js"></script>

    <!-- Page-Level Scripts -->
    

<script>

$(document).ready(function(){
	$('.footable').footable({
		sorting:  false
	});
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
		
	

});



function updateRestanTotal(login_id){
	
	ingreso_monto = Number( $('#aCuentaEsteMes_'+login_id).val() );	
	
	gasto_id = $('#aCuentaEsteMes_'+login_id).attr("data-gasto-id-prestamo"); //gasto_id del prestamo, no del salario

	restan_val = Number($('#span_restan_'+gasto_id).html());
	restarian_val = restan_val - ingreso_monto;
	$('#span_restarian_'+gasto_id).html(restarian_val.toFixed(2));
	
	dia_extra_monto = 0;
	if($("#dia_extra_"+login_id).is(':checked')){
		dia_extra_monto = Number($("#salario_diario_"+login_id).html().replace(",",""));
	}
	
	if($("#dia_descuento_"+login_id).is(':checked')){
		dia_descuento_monto = Number($("#salario_diario_"+login_id).html().replace(",",""));
		$("#dia_descuento_penalizacion_"+login_id).prop("disabled", false);
	} else {
		dia_descuento_monto = 0;
		$("#dia_descuento_penalizacion_"+login_id).prop("disabled", true);
		$("#dia_descuento_penalizacion_"+login_id).val("0");
	}
	
	dia_descuento_penalizacion = Number($("#dia_descuento_penalizacion_"+login_id).val());
	
	total_val = Number($('#span_total_original_'+login_id).html().replace(",",""));
	total_val = total_val - ingreso_monto + dia_extra_monto - dia_descuento_monto - dia_descuento_penalizacion;
	
	$('#span_total_'+login_id).html(total_val.toFixed(2));
	

	
}

function aplicaPagoPrestamo(gasto_id, login_id){ //gasto_id del prestamo
	
	ingreso_monto = $('#aCuentaEsteMes_'+login_id).val();
	//alert("se ingresaran "+ingreso_monto+ " al gasto "+login_id);
	
	restarian_val = Number($('#span_restarian_'+login_id).html());
	if(restarian_val == 0){
		cierra_prestamo = '1';
	} else {
		cierra_prestamo = '0';
	}
	
	if(ingreso_monto > 0){
		$.ajax({
			type: "GET",
			url: "ajax/crea_pago_prestamo.php",			
			data: {ingreso_monto:ingreso_monto,gasto_id:gasto_id, cierra_prestamo:cierra_prestamo},
			success: function(msg){
				$('#aCuentaEsteMes_'+login_id).prop('disabled', true);
				//location.href = '../';
				//$("#myModal").modal('hide');
				//$("#boton_crea_registro").removeClass().addClass("btn btn-primary");
				//$("#span_crea_registro").removeClass();
			}		
		});
	} else {
		alert("sin pago al prestamo");
	}
}

function creaPagoSalario(gasto_id, login_id){
	
	var d = new Date();
	
	gastos_pagos_monto = Number($('#span_total_original_'+login_id).html().replace(",",""));
	gastos_pagos_forma_de_pago_id = '1';
	gastos_pagos_es_fiscal = '0';
	gastos_pagos_monto_sin_iva= '0';
	gastos_pagos_iva = '0';
	gastos_pagos_fecha = '<?=date("d/m/Y")?>';
	gastos_pagos_hora= d.getHours()+':'+d.getMinutes()+':'+d.getSeconds();
	
	gastos_pagos_referencia = '';
	cierra_gasto = '1';
	login_id = '<?=$_SESSION["login_session"]["login_id"]?>'; // de quien registra
	
	$.ajax({
			type: "GET",
			url: "../ajax/crea_pago.php",			
			data: {
				gasto_id:gasto_id,
				gastos_pagos_monto:gastos_pagos_monto,
				gastos_pagos_forma_de_pago_id:gastos_pagos_forma_de_pago_id,
				gastos_pagos_es_fiscal:gastos_pagos_es_fiscal,
				gastos_pagos_monto_sin_iva:gastos_pagos_monto_sin_iva,
				gastos_pagos_iva:gastos_pagos_iva,
				gastos_pagos_fecha:gastos_pagos_fecha,
				gastos_pagos_hora:gastos_pagos_hora,
				gastos_pagos_referencia:gastos_pagos_referencia,
				cierra_gasto:cierra_gasto,
				login_id:login_id
			},
			success: function(msg){
				location.href = './';
			}		
		});
}

function updateRestanTotalB(login_id){
	
	
	
	
	
	
	
}
</script>

</body>

</html>