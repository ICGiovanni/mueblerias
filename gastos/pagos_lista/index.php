<?php
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'login/session.php');
if(empty($_GET["gasto_id"])){
	die("dato insuficiente");
}

require_once $pathProy.'/header.php';
require_once $pathProy.'/menu.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'gastos/models/class.Gastos.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/general/class.General.php');

$objGasto = new Gasto();
$objGeneral = new General();

$rowGasto = $objGasto->getGasto($_GET["gasto_id"]);
$rowGasto=$rowGasto[0];

$rowPagos = $objGasto->getPagosSum($_GET["gasto_id"]);
$rowPagos=$rowPagos[0];

$rowPagosDetalle = $objGasto->getPagosDetalle($_GET["gasto_id"]);

//print_r($rowPagosDetalle);
$restan_global = number_format(($rowGasto["gasto_monto"]-$rowPagos["gastos_pagos_monto"]),2);
$restan_parcial = $restan_global;
$rowsDataPagoDetalle = '';

$folioInterno = count($rowPagosDetalle);

while( list(,$dataPagoDetalle)=each($rowPagosDetalle) ){
	
	if($dataPagoDetalle["gastos_pagos_es_fiscal"] == "1"){
		$es_fiscal = "Sí";
		$gastos_pagos_monto_sin_iva = '$'.number_format($dataPagoDetalle["gastos_pagos_monto_sin_iva"],2);
		$gastos_pagos_iva = '$'.number_format($dataPagoDetalle["gastos_pagos_iva"],2);
	} else {
		$es_fiscal = "No";
		$gastos_pagos_monto_sin_iva = 'N/A';
		$gastos_pagos_iva = 'N/A';
	}
	$restan_parcial = str_replace(",","",$restan_parcial);
	//$dataPagoDetalle["gastos_pagos_id"]
	$rowsDataPagoDetalle.='<tr>
							<td align="center">'.$_GET["gasto_id"].'.'.$folioInterno.'</td>
							<td >'.$dataPagoDetalle["firstName"].' '.$dataPagoDetalle["lastName"].'</td>
							<td align="right">$'.number_format($dataPagoDetalle["gastos_pagos_monto"],2).'</td>
							<td align="right">'.$gastos_pagos_monto_sin_iva.'</td>
							<td align="right">'.$gastos_pagos_iva.'</td>
							<td align="center">'.$es_fiscal.'</td>
							<td>'.$dataPagoDetalle["gastos_pagos_forma_de_pago_desc"].'</td>
							<td>'.$dataPagoDetalle["gastos_pagos_referencia"].'</td>
							<td align="center">'.$objGeneral->getDate($dataPagoDetalle["gastos_pagos_fecha"]).'</td>
							<td align="right">$'.number_format($restan_parcial,2).'</td>
							<td align="center"><a href="../pago_editar/?gasto_id='.$_GET["gasto_id"].'&gastos_pagos_id='.$dataPagoDetalle["gastos_pagos_id"].'"><i class="fa fa-pencil" title="Editar Pago" ></i></a> &nbsp;&nbsp; <a><i class="fa fa-trash" title="Borrar Pago" onclick="confirmDelete(\''.$dataPagoDetalle["gastos_pagos_id"].'\',\''.$_GET["gasto_id"].'\')"></i></a></td>
						</tr>';
	$restan_parcial+=$dataPagoDetalle["gastos_pagos_monto"];
	$folioInterno--;
}

$rowsGastosCategoria = $objGasto->getGastosCategoria();
$rowsFormasPago = $objGasto->getFormasPago();

$options_gastos_pagos_forma_de_pago_id = '';
while(list(,$dataFormasPago) = each($rowsFormasPago)){
	$options_gastos_pagos_forma_de_pago_id.='<option value="'.$dataFormasPago["gastos_pagos_forma_de_pago_id"].'">'.$dataFormasPago["gastos_pagos_forma_de_pago_desc"].'</option>';
}

$options_gasto_categoria_id = '';
while(list(,$dataGastoCategoria) = each($rowsGastosCategoria)){
	$options_gasto_categoria_id.='<option value="'.$dataGastoCategoria["gasto_categoria_id"].'">'.$dataGastoCategoria["gasto_categoria_desc"].'</option>';
}

?>
<!-- Data picker -->
<link href="<?=$raizProy?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="<?=$raizProy?>css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
<link href="<?=$raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

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
		<h2>Lista de Pagos a Gasto <span style="font-size:14px"><b>"<?=$rowGasto["gasto_no_documento"]?>"</b></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="">Gastos</a>
			</li>
			<li class="active">
				<strong>Lista de Pagos a Gasto</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
		<div class="title-action">
			<button type="button" class="btn btn-warning btn-xs" onclick="location.href = '../';"><i class="fa fa-arrow-left"></i> Regresar a listado</button>
		</div>
	</div>
</div>
		
            <div class="row">
                <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight form-horizontal">
                    
					<div class="form-group">
						<div class="col-md-2" align="right"><b>Monto a cubir</b></div>                        
						<div class="col-md-1" align="right">
							<b>$<?=number_format($rowGasto["gasto_monto"],2)?></b>
						</div>    
					</div>
					<div class="form-group">
						<div class="col-md-2" align="right"><b>Pagos Realizados</b></div>                        
						<div class="col-md-1" align="right">
							<b style="color:green;">$<?=number_format($rowPagos["gastos_pagos_monto"],2)?></b>
						</div>    
					</div>
					<div class="form-group">
						<div class="col-md-2" align="right"><b>Restan</b></div>                        
						<div class="col-md-1" align="right">
							<b style="color:red;">$<?=$restan_global?></b>
						</div>    
					</div>
					
					<div class="table-responsive col-md-12">
						
						        
						<table class="table table-striped">
							<tr>
								<th style="text-align:center">Folio Pago</th>
								<th style="text-align:center">Usuario que registró</th>
								<th style="text-align:center">Monto Pagado</th>
								<th style="text-align:center">Monto del pago sin IVA</th>
								<th style="text-align:right">IVA</th>
								<th style="text-align:center">Fiscal</th>
								<th>Forma de pago</th>
								<th>Referencia</th>
								<th style="text-align:center">Fecha del pago</th>
								<th style="text-align:right">Restan</th>
								<th style="text-align:center">Borrar Pago</th>
							</tr>
							<?=$rowsDataPagoDetalle?>
						</table>
		
                    
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
	<script src="<?=$raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>
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
	 $('.clockpicker').clockpicker();
});


$('#data_1 .input-group.date').datepicker({
	keyboardNavigation: false,
	forceParse: false,
	autoclose: true,
	language: 'es'
}).datepicker("setDate", "0");

function crea_pago(){
	$("#boton_crea_registro").addClass("disabled");
	$("#span_crea_registro").addClass("glyphicon glyphicon-refresh glyphicon-refresh-animate");
	
	gasto_id = '<?=$_GET["gasto_id"]?>';
	gastos_pagos_monto=$("#gastos_pagos_monto").val();
	gastos_pagos_forma_de_pago_id=$("#gastos_pagos_forma_de_pago_id").val();
	if ( $("#gastos_pagos_es_fiscal").is(':checked') ){
		gastos_pagos_es_fiscal = "1";
	} else {
		gastos_pagos_es_fiscal = "0";
	}
	gastos_pagos_monto_sin_iva=$("#gastos_pagos_monto_sin_iva").val();
	gastos_pagos_iva=$("#gastos_pagos_iva").val();
	gastos_pagos_fecha=$("#gastos_pagos_fecha").val();
	gastos_pagos_hora=$("#gastos_pagos_hora").val();
	
	$.ajax({
		type: "GET",
		url: "../ajax/crea_pago.php",			
		data: {gasto_id:gasto_id,gastos_pagos_monto:gastos_pagos_monto,gastos_pagos_forma_de_pago_id:gastos_pagos_forma_de_pago_id,gastos_pagos_es_fiscal:gastos_pagos_es_fiscal,gastos_pagos_monto_sin_iva:gastos_pagos_monto_sin_iva,gastos_pagos_iva:gastos_pagos_iva,gastos_pagos_fecha:gastos_pagos_fecha,gastos_pagos_hora:gastos_pagos_hora},
		success: function(msg){
			location.href = '../';
		}		
	});
}

function confirmDelete(gastos_pagos_id,gasto_id){
	swal({
	  title: "¿ Estás seguro ?",
	  text: "Se eliminará el pago del gasto",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#DD6B55",
	  confirmButtonText: "Borrar",
	  cancelButtonText: "Cancelar",
	  closeOnConfirm: false,
	},
	function(isConfirm){
		if (isConfirm) {
			borra_pago(gastos_pagos_id,gasto_id);
			swal({
				title: "Borrado!", 
				text: "Se ha borrado el pago del gasto", 
				type: "success"			
			}, function () {
				location.href = './?gasto_id=<?=$_GET["gasto_id"]?>';
			});
		}
	});
}

function borra_pago(gastos_pagos_id,gasto_id){
	$.ajax({
		type: "GET",
		url: "../ajax/borra_pago.php",			
		data: {gastos_pagos_id:gastos_pagos_id, gasto_id:gasto_id},
		success: function(msg){
					
		}		
	});
}

function update_iva(){
	
	if($("#gastos_pagos_es_fiscal").is(':checked')){
		
		gastos_pagos_monto = $("#gastos_pagos_monto").val();
		updated_iva = gastos_pagos_monto * 16 / 100;
		gastos_pagos_monto_sin_iva = gastos_pagos_monto - updated_iva;
		$("#gastos_pagos_monto_sin_iva").val(gastos_pagos_monto_sin_iva);
		$("#gastos_pagos_iva").val(updated_iva);
	} else {
		$("#gastos_pagos_monto_sin_iva").val("");
		$("#gastos_pagos_iva").val("");
	}
}

saldo_actual = '<?=($rowGasto["gasto_monto"]-$rowPagos["gastos_pagos_monto"])?>';
saldo_actual = Number(saldo_actual);

function valida_pago(obj){
	pago_actual = Number(obj.value);
	
	if( pago_actual > saldo_actual){
		alert("Pago invalido");
		obj.value = "0";
	}
	update_iva();
}
</script>

</body>

</html>