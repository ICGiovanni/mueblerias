<?php
session_start();
date_default_timezone_set ("America/Mexico_City");
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once $pathProy.'/header.php';
require_once $pathProy.'/menu.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'gastos/models/class.Gastos.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'ingresos/models/class.Ingresos.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/general/class.General.php');
$general = new General();

/////


// Obtenemos el numero de la semana
if(isset($_GET["semana"])){
	$semana = $_GET["semana"];
	$semana_act = date("W");
	//echo $semana_act."----";
	if( $semana > $semana_act ){
		echo "Semana invalida. Semana a futuro"; die();
	} else {
		$semanas_atras = $semana_act - $semana;
		$sec_en_una_semana = "604800";
		echo $semanas_atras." semanas atras";
		$sec_atras = $semanas_atras * $sec_en_una_semana;
		$back_in_time = time() - $sec_atras;
		$month = date("m",$back_in_time);
		$day = date("d",$back_in_time);
		$year = date("Y",$back_in_time);
		$diaSemana = date("w",$back_in_time);
	}

} else {
	$month = date("m");
	$day = date("d");
	$year = date("Y");
	$semana = date("W");
	$diaSemana = date("w");
	//echo $diaSemana;
	if($diaSemana==0)
		$diaSemana=7;
	if($diaSemana > 5){ $semana++; }
}

//Obtenemos el día de la semana de la fecha dada

//el 0 equivale al domingo...

$array_dias_a_recorrer = array("0"=>"1","1"=>"2","2"=>"3","3"=>"4","4"=>"5","5"=>"6","6"=>"0","7"=>"1"); //0 es domingo, 6 es sabado
$array_dias_a_recorrer_2 = array("0"=>"5","1"=>"4","2"=>"3","3"=>"2","4"=>"1","5"=>"0","6"=>"6","7"=>"5");

// A la fecha recibida, le restamos el dia de la semana y obtendremos el lunes
//if($diaSemana)
$primerDia=date("Y/m/d",mktime(0,0,0,$month,$day-$array_dias_a_recorrer[$diaSemana],$year));

// A la fecha recibida, le sumamos el dia de la semana menos siete y obtendremos el domingo
$ultimoDia=date("Y/m/d",mktime(0,0,0,$month,$day+$array_dias_a_recorrer_2[$diaSemana],$year));

//echo "<br>Semana: ".$semana." - Año: ".$year;
//echo "<br>Primer día ".$primerDia;
//echo "<br>Ultimo día ".$ultimoDia;
/////

$objGasto = new Gasto();
$objIngreso = new Ingreso();

$rows = $objGasto->getGastosNomina($primerDia,$ultimoDia);

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
	$css_tr = '';
	if(isset($dataGastoPrestamo[$dataGasto["login_id"]])){
		$onclick_aplicaPagoPrestamo = 'aplicaPagoPrestamo(\''.$dataGastoPrestamo[$dataGasto["login_id"]]["gasto_id"].'\',\''.$dataGasto["login_id"].'\'); ';
		$prestamo_activo = $dataGastoPrestamo[$dataGasto["login_id"]]["gasto_monto"];
		$aCuentaEsteMes = '$ <input type="text" name="aCuentaEsteMes_'.$dataGasto["login_id"].'" id="aCuentaEsteMes_'.$dataGasto["login_id"].'" size="5" onchange="updateRestanTotal('.$dataGasto["login_id"].');" value="0" data-gasto-id-prestamo="'.$dataGastoPrestamo[$dataGasto["login_id"]]["gasto_id"].'"/>';
		
		$span_restarian_id = 'span_restarian_'.$dataGastoPrestamo[$dataGasto["login_id"]]["gasto_id"];
		$span_restan_id = 'span_restan_'.$dataGastoPrestamo[$dataGasto["login_id"]]["gasto_id"];
	}
	$span_total_original_id = 'span_total_original_'.$dataGasto["login_id"];
	$span_total_id = 'span_total_'.$dataGasto["login_id"];
	
	$comision_activa = 0;
	
	if(isset($dataGastoComisiones[$dataGasto["login_id"]])){
		$comision_activa = $dataGastoComisiones[$dataGasto["login_id"]];
	}
	
	$totalPagarEsteMes= $dataGasto["gasto_monto"] + $comision_activa;
	
	$restanEsteMes= $prestamo_activo - $sumaPagado["ingreso_monto"];
	
	if($dataGasto["gasto_status_id"] == "1"){
		$ckeckbox_dia_extra = '<input type="checkbox" name="dia_extra_'.$dataGasto["login_id"].'" id="dia_extra_'.$dataGasto["login_id"].'" onclick="updateRestanTotal('.$dataGasto["login_id"].');" />';
		$ckeckbox_dia_descuento = '<input type="checkbox" name="dia_descuento_'.$dataGasto["login_id"].'" id="dia_descuento_'.$dataGasto["login_id"].'" onclick="updateRestanTotal('.$dataGasto["login_id"].');" />';
		$ckeckbox_dia_descuento_penalizacion = '$ <input type="text" name="dia_descuento_penalizacion_'.$dataGasto["login_id"].'" id="dia_descuento_penalizacion_'.$dataGasto["login_id"].'" size="5" onchange="updateRestanTotal('.$dataGasto["login_id"].');" value="0" disabled />';
		$boton_aplica_nomina = '<a href="javascript:void(0);" onclick="'.$onclick_aplicaPagoPrestamo.'creaPagoSalario(\''.$dataGasto["gasto_id"].'\',\''.$dataGasto["login_id"].'\'); "><i class="fa fa-floppy-o"></i></a>';
		$td_restarian = '$ <span id="'.$span_restarian_id.'">'.number_format($restanEsteMes,2).'</span>';
	} else {
		$css_tr = 'style="background-color:#BCF5BD;"';
		$td_restarian = '';
		
		$ckeckbox_dia_extra = '<i class="fa fa-square-o"></i>';
		$res_dia_extra = $objGasto->huboPagoExtra($dataGasto["login_id"],$primerDia,$ultimoDia);
		$monto_dia_extra = 0;
		if(isset($res_dia_extra[0])){
			$ckeckbox_dia_extra = '<i class="fa fa-check-square-o"></i>';
			$monto_dia_extra = ($dataGasto["gasto_monto"]/7);
		}
		
		$res_dia_descuento = $objIngreso->huboDescuentoPenalizacion($dataGasto["login_id"],$primerDia,$ultimoDia, $dataGasto["gasto_id"]);
		$ckeckbox_dia_descuento = '<i class="fa fa-square-o"></i>';
		$ckeckbox_dia_descuento_penalizacion = '';
		$monto_dia_descuento_penalizacion = 0;
		if(isset($res_dia_descuento[0])){
			$ckeckbox_dia_descuento = '<i class="fa fa-check-square-o"></i>';
			$ckeckbox_dia_descuento_penalizacion = '$'.$res_dia_descuento[0]["ingreso_monto"];
			$monto_dia_descuento_penalizacion = $res_dia_descuento[0]["ingreso_monto"];
		}
		$boton_aplica_nomina = '<i class="fa fa-check-square-o"></i>';
		
		$aCuentaEsteMes = '';
		$monto_este_mes = 0;
		if(isset($dataGastoPrestamo[$dataGasto["login_id"]])){
			$res_pago_prestamo = $objIngreso->huboPagoPrestamo($dataGasto["login_id"],$primerDia,$ultimoDia, $dataGastoPrestamo[$dataGasto["login_id"]]["gasto_id"]);
		
			if(isset($res_pago_prestamo[0])){
				$aCuentaEsteMes = '$ '.$res_pago_prestamo[0]["ingreso_monto"];
				$monto_este_mes = $res_pago_prestamo[0]["ingreso_monto"];
			}
		}
		
		$totalPagarEsteMes = $dataGasto["gasto_monto"] + $comision_activa - $monto_este_mes - $monto_dia_descuento_penalizacion +  $monto_dia_extra;
	}	
	
	$html_rows.= '<tr id="row_salary_'.$dataGasto["login_id"].'" '.$css_tr.'>
		<td align="left">'.$dataGasto["firstName"].' '.$dataGasto["lastName"].'</td>
		<td align="left">'.$dataGasto["gasto_id"].'</td>
		<td align="right">$ '.number_format($dataGasto["gasto_monto"],2).'</td>
		<td align="right">$ <span id="salario_diario_'.$dataGasto["login_id"].'">'.number_format(($dataGasto["gasto_monto"]/7),2).'</span></td>
		<td align="right">$ '.number_format($comision_activa,2).'</td>
		<td align="center"> '.$ckeckbox_dia_extra.' </td>
		<td align="center"> '.$ckeckbox_dia_descuento.' </td>
		<td align="right"> '.$ckeckbox_dia_descuento_penalizacion.'</td>
		<td align="right">$ '.number_format($prestamo_activo,2).'</td>
		<td align="right">$ '.number_format($sumaPagado["ingreso_monto"],2).'</td>
		<td align="right">$ <span id="'.$span_restan_id.'">'.number_format($restanEsteMes,2).'</span></td>		
		<td style="width:85px; text-align:right;">'.$aCuentaEsteMes.'</td>
		<td align="right"> '.$td_restarian.' </td>
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
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2>Nomina Semana <?=$semana?> - <i>Del <?="Sab"?> <?=$general->getOnlyDate($primerDia)?> al <?="Vie"?> <?=$general->getOnlyDate($ultimoDia)?></i></h2>
		<ol class="breadcrumb">
			<li>
				<a href="">Gastos</a>
			</li>
			<li class="active">
				<strong>Nomina</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
		<div class="title-action">
			<button type="button" class="btn btn-primary btn-xs"  onclick="location.href = './?semana=<?=($semana-1)?>';" >
			1 semana atras
			</button>
			<?php
			if($semana < date("W")){
			?>
			<button type="button" class="btn btn-primary btn-xs"  onclick="location.href = './';" >
			semana actual
			</button>
			<?php
			}
			?>
		</div>
	</div>
</div>

		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    
                    <div class="ibox-content">
					<div class="table-responsive">
                    <table class="footable table table-bordered dataTables-example toggle-square" >
                    <thead>
                    <tr>
						<th>Empleado</th>
						<th data-hide="all" style="text-align:right;">Gasto Folio Id</th>
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
	
	ingreso_monto = 0;
	//alert();
	if( typeof($('#aCuentaEsteMes_'+login_id).val()) != 'undefined' ){
		//alert(ingreso_monto)
		ingreso_monto = Number( $('#aCuentaEsteMes_'+login_id).val() );
		gasto_id = $('#aCuentaEsteMes_'+login_id).attr("data-gasto-id-prestamo"); //gasto_id del prestamo, no del salario
		restan_val = Number($('#span_restan_'+gasto_id).html());
		restarian_val = restan_val - ingreso_monto;
		$('#span_restarian_'+gasto_id).html(restarian_val.toFixed(2));
	}
	
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
	// login_id login del empleado
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
	login_id_quien_registra = '<?=$_SESSION["login_session"]["login_id"]?>'; // de quien registra el pago
	
	$.ajax({
			type: "GET",
			url: "../ajax/crea_pago.php", // pago del gasto salarial
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
				login_id:login_id_quien_registra
			},
			success: function(msg){
				//location.href = './';
			}		
	});
		
	if($("#dia_extra_"+login_id).is(':checked')){
		
		gasto_no_documento = "dia extra salario folio "+gasto_id;
		gasto_fecha_vencimiento = '<?=date("d/m/Y")?>';		
		gasto_fecha_recordatorio_activo = "0";
		gasto_fecha_recordatorio = '<?=date("d/m/Y")?>';
		gasto_categoria_id = '25';
		gasto_concepto = "dia extra salario folio "+gasto_id;		
		gasto_descripcion = "dia extra salario folio "+gasto_id;
		
		dia_extra_monto = Number($("#salario_diario_"+login_id).html().replace(",",""));		
		gasto_monto = dia_extra_monto;
		
		gasto_hora_vencimiento = d.getHours()+':'+d.getMinutes()+':'+d.getSeconds();
		gasto_hora_recordatorio = d.getHours()+':'+d.getMinutes()+':'+d.getSeconds();
		
		sucursal_id = '1'; //oficina central, consultar con JM		
		proveedor_id = '';
		gasto_status_id = '2';
		gasto_beneficiario = login_id; // solo representacion numerica
		pago_automatico = '1';

		/// DATOS PARA PAGO AUTOMATICO	
		gastos_pagos_monto = dia_extra_monto;
		gastos_pagos_forma_de_pago_id = '1';
		gastos_pagos_es_fiscal = '0';
		gastos_pagos_monto_sin_iva= '0';
		gastos_pagos_iva = '0';
		gastos_pagos_fecha = '<?=date("d/m/Y")?>';
		gastos_pagos_hora= d.getHours()+':'+d.getMinutes()+':'+d.getSeconds();		
		gastos_pagos_referencia = '';
		
		$.ajax({
			type: "GET",
			url: "../ajax/crea_gasto.php", // se crea el gasto del dia extra y se paga en automatico
			data: {				
				gasto_no_documento:gasto_no_documento,
				gasto_fecha_vencimiento:gasto_fecha_vencimiento,
				gasto_fecha_recordatorio_activo:gasto_fecha_recordatorio_activo,
				gasto_fecha_recordatorio:gasto_fecha_recordatorio,
				gasto_categoria_id:gasto_categoria_id,
				gasto_concepto:gasto_concepto,
				gasto_descripcion:gasto_descripcion,
				gasto_monto:gasto_monto,
				gasto_status_id:gasto_status_id, 
				gasto_hora_vencimiento:gasto_hora_vencimiento, 
				gasto_hora_recordatorio:gasto_hora_recordatorio, 
				sucursal_id:sucursal_id, 
				proveedor_id:proveedor_id,
				login_id:login_id, // login_id del empleado beneficiado
				gasto_beneficiario:gasto_beneficiario,
				pago_automatico:pago_automatico,
				
				gastos_pagos_monto:gastos_pagos_monto,
				gastos_pagos_forma_de_pago_id:gastos_pagos_forma_de_pago_id,
				gastos_pagos_es_fiscal:gastos_pagos_es_fiscal,
				gastos_pagos_monto_sin_iva:gastos_pagos_monto_sin_iva,
				gastos_pagos_iva:gastos_pagos_iva,
				gastos_pagos_fecha:gastos_pagos_fecha,
				gastos_pagos_hora:gastos_pagos_hora,
				gastos_pagos_referencia:gastos_pagos_referencia,
				login_id_quien_registra:login_id_quien_registra // login_id de quien registra el pago
			},
			success: function(msg){
				//
			}		
		});
	}
	if($("#dia_descuento_"+login_id).is(':checked')){
		
		dia_descuento_monto = Number($("#salario_diario_"+login_id).html().replace(",",""));
		dia_descuento_penalizacion = Number($("#dia_descuento_penalizacion_"+login_id).val());		
		ingreso_monto = dia_descuento_monto + dia_descuento_penalizacion;
		ingreso_categoria_id = '2'; // Dia Descuento/Penalización
		ingreso_descripcion = 'Dia Descuento/Penalización salario folio '+gasto_id;
		
		if(ingreso_monto > 0){
			$.ajax({
				type: "GET",
				url: "../../ingresos/ajax/crea_ingreso.php",			
				data: {
					ingreso_monto:ingreso_monto, 
					ingreso_categoria_id:ingreso_categoria_id, 
					ingreso_descripcion:ingreso_descripcion
				},
				success: function(msg){
					//
				}		
			});
		}
		
	}
	location.href = './';
}

</script>

</body>

</html>