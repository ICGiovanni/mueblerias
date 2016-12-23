<?php
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'login/session.php');
if(empty($_GET["gasto_id"])){
	die("dato insuficiente");
}

require_once $pathProy.'/header.php';
require_once $pathProy.'/menu.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'gastos/models/class.Gastos.php');

$objGasto = new Gasto();
$rowGasto = $objGasto->getGasto($_GET["gasto_id"]);
$rowGasto=$rowGasto[0];

$rowPagos = $objGasto->getPagosSum($_GET["gasto_id"]);
$rowPagos=$rowPagos[0];


$rowsGastosCategoria = $objGasto->getGastosCategoria();
$rowsFormasPago = $objGasto->getFormasPago();

$options_gastos_pagos_forma_de_pago_id = '<option value="0">-- Elige un Metodo de Pago --</option>';
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
<link href="<?=$raizProy?>css/plugins/chosen/chosen.css" rel="stylesheet">

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
		<h2>Nuevo Pago a Gasto <span style="font-size:14px"><b>"<?=$rowGasto["gasto_no_documento"]?>"</b></span></h2>
		<ol class="breadcrumb">
			<li>
				<a href="">Gastos</a>
			</li>
			<li class="active">
				<strong>Nuevo Pago a Gasto</strong>
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
				<div class="col-md-5">
					<b>$<?=number_format($rowGasto["gasto_monto"],2)?></b>
				</div>    
			</div>
			<div class="form-group">
				<div class="col-md-2" align="right"><b>Pagos Realizados</b></div>                        
				<div class="col-md-5">
					<b style="color:green;">$<?=number_format($rowPagos["gastos_pagos_monto"],2)?></b>
				</div>    
			</div>
			<div class="form-group">
				<div class="col-md-2" align="right"><b>Restan</b></div>                        
				<div class="col-md-5">
					<b style="color:red;">$<?=number_format(($rowGasto["gasto_monto"]-$rowPagos["gastos_pagos_monto"]),2)?></b>
				</div>    
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Monto del pago</label>                        
				<div class="col-md-5 input-group m-b" style="padding:0px 15px; height:35px; margin-bottom:1px;">
					 <span class="input-group-addon">$</span>
					<input type="text" name="gastos_pagos_monto" id="gastos_pagos_monto" size="30" onchange="valida_pago(this);" class="form-control"/>
				</div>    
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Es fiscal</label>                        
				<div class="col-md-5">
					<input type="checkbox" name="gastos_pagos_es_fiscal" id="gastos_pagos_es_fiscal" value="1" onclick="update_iva();"/> 
				</div>    
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Monto del pago sin IVA</label>                        
				<div class="col-md-5 input-group m-b" style="padding:0px 15px; height:35px; margin-bottom:1px;">
				<span class="input-group-addon">$</span>
					<input type="text" name="gastos_pagos_monto_sin_iva" id="gastos_pagos_monto_sin_iva" value="" size="30" disabled class="form-control"/>
				</div>    
			</div>	
			<div class="form-group">
				<label class="control-label col-md-2">IVA</label>                        
				<div class="col-md-5 input-group m-b" style="padding:0px 15px; height:35px; margin-bottom:1px;">
				<span class="input-group-addon">$</span>
					<input type="text" name="gastos_pagos_iva" id="gastos_pagos_iva" value="" size="30" disabled class="form-control"/>
				</div>    
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Método de pago</label>                        
				<div class="col-md-5">
					<select name="gastos_pagos_forma_de_pago_id" id="gastos_pagos_forma_de_pago_id" class="chosen-select">
						<?=$options_gastos_pagos_forma_de_pago_id?>
					</select>
				</div>    
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Referencia</label>                        
				<div class="col-md-5">
					<textarea rows="1" name="gastos_pagos_referencia" id="gastos_pagos_referencia" class="form-control"></textarea>
				</div>    
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Fecha de pago</label>                        
				<div class="col-md-3" style="padding-left:30px; height:35px;">
					<div class="form-group" id="data_1" >
						<div class="input-group date">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" id="gastos_pagos_fecha" name="gastos_pagos_fecha" value="">
						</div>
					</div>
				</div>   
				<div class="col-md-2">
					<div class="input-group clockpicker" data-autoclose="true">
						<input name="gastos_pagos_hora" id ="gastos_pagos_hora" type="text" class="form-control" value="<?=date("H:m")?>" >
						<span class="input-group-addon">
							<span class="fa fa-clock-o"></span>
						</span>
					</div>
				</div>
			</div>	
			<div class="form-group"> 
				<div class="col-md-7" align="right">
					<button type="button" class="btn btn-danger btn-xs" onclick="location.href = '../';">Cancelar</button>&nbsp;&nbsp;
					<button id="boton_crea_registro" type="button" class="btn btn-primary btn-xs" onclick="crea_pago();"> Guardar Pago</button> <span id="span_crea_registro"></span>
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
	<script src="<?=$raizProy?>js/plugins/chosen/chosen.jquery.js"></script>
	<script src="<?=$raizProy?>js/plugins/toastr/toastr.min.js"></script>

<script>
saldo_actual = '<?=($rowGasto["gasto_monto"]-$rowPagos["gastos_pagos_monto"])?>';
saldo_actual = Number(saldo_actual);
cierra_gasto = '0';

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
	 $('#gastos_pagos_forma_de_pago_id').chosen();
});


$('#data_1 .input-group.date').datepicker({
	keyboardNavigation: false,
	forceParse: false,
	autoclose: true,
	language: 'es'
}).datepicker("setDate", "0");


function validate_form(){
	var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
	var bandera=true;

	gastos_pagos_forma_de_pago_id=$("#gastos_pagos_forma_de_pago_id").val();
	if( gastos_pagos_forma_de_pago_id == '0' ){
		toastr.error("Debe elegir un Método de Pago");
		bandera=false;
	}

	gastos_pagos_referencia=$("textarea#gastos_pagos_referencia").val();
	if( (gastos_pagos_forma_de_pago_id == '2' || gastos_pagos_forma_de_pago_id == '3' || gastos_pagos_forma_de_pago_id == '4' || gastos_pagos_forma_de_pago_id == '6' || gastos_pagos_forma_de_pago_id == '7') && gastos_pagos_referencia =='' ){
		toastr.error("Debe agregar una Referencia de Pago");
		bandera=false;
	}

	gastos_pagos_monto=$("#gastos_pagos_monto").val();
	if( gastos_pagos_monto == '' ){
		toastr.error("Debe agregar un Monto");
		bandera=false;
	}
	return bandera;
}

function crea_pago(){
	
	var validate = validate_form();
	if(!validate){
		return;
	}
	
	gasto_id = '<?=$_GET["gasto_id"]?>';
	gastos_pagos_monto=$("#gastos_pagos_monto").val();
	gastos_pagos_forma_de_pago_id=$("#gastos_pagos_forma_de_pago_id").val();
	gastos_pagos_referencia=$("textarea#gastos_pagos_referencia").val();
	
	
	if ( $("#gastos_pagos_es_fiscal").is(':checked') ){
		gastos_pagos_es_fiscal = "1";
	} else {
		gastos_pagos_es_fiscal = "0";
	}
	gastos_pagos_monto_sin_iva=$("#gastos_pagos_monto_sin_iva").val();
	gastos_pagos_iva=$("#gastos_pagos_iva").val();
	gastos_pagos_fecha=$("#gastos_pagos_fecha").val();
	gastos_pagos_hora=$("#gastos_pagos_hora").val();

	login_id = '<?=$_SESSION["login_session"]["login_id"]?>';
	
	$("#boton_crea_registro").addClass("disabled");
	$("#span_crea_registro").addClass("glyphicon glyphicon-refresh glyphicon-refresh-animate");
	
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
				location.href = '../';
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

function valida_pago(obj){
	pago_actual = Number(obj.value);
	
	if( pago_actual > saldo_actual){
		toastr.error("El pago no puede ser mayor a $"+saldo_actual);
		obj.value = "0";
	}
	if( pago_actual == saldo_actual){
		cierra_gasto = '1';
	} else {
		cierra_gasto = '0';
	}
	
	
	update_iva();
}
</script>

</body>

</html>