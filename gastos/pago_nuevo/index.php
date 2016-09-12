<?php
session_start();

if(empty($_GET["gasto_id"])){
	die("dato insuficiente");
}

require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
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
		<h2>Registrar Nuevo Pago a Gasto "<?=$rowGasto["gasto_no_documento"]?>"</h2>
		<ol class="breadcrumb">
			<li>
				<a href="">Gastos</a>
			</li>
			<li class="active">
				<strong>Registrar Nuevo Pago a Gasto</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
		<div class="title-action">
			<button type="button" class="btn btn-danger btn-xs" onclick="location.href = '../';">Cancelar</button>&nbsp;&nbsp;
            <button id="boton_crea_registro" type="button" class="btn btn-primary btn-xs" onclick="crea_pago();"> Guardar Pago</button> <span id="span_crea_registro"></span>
		</div>
	</div>
</div>
		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    
                    <div class="ibox-content">
					
						<div class="table-responsive">
						<table class="table ">
							<tr>
								<td>Monto total a cubir: <b>$ <?=number_format($rowGasto["gasto_monto"],2)?></b></td>
								<td>Suma total de pagos realizados: <b style="color:green;">$ <?=number_format($rowPagos["gastos_pagos_monto"],2)?></b></td>
								<td>Saldo restante vigente a cubrir: <b style="color:red;">$ <?=number_format(($rowGasto["gasto_monto"]-$rowPagos["gastos_pagos_monto"]),2)?></b></td>
							</tr>
						</table>
						        
						<table class="table-form">
							<tr>
								<td align="right">Monto del pago a registrar: $</td>
								<td><input type="text" name="gastos_pagos_monto" id="gastos_pagos_monto" size="30" onchange="valida_pago(this);"/></td>
								<td align="right">Forma del pago:</td>
								<td>
									<select name="gastos_pagos_forma_de_pago_id" id="gastos_pagos_forma_de_pago_id">
										<?=$options_gastos_pagos_forma_de_pago_id?>
									</select>
								</td>
							</tr>
							<tr>
							
								<td align="right">
									<input type="checkbox" name="gastos_pagos_es_fiscal" id="gastos_pagos_es_fiscal" value="1" onclick="update_iva();"/> 
								</td>
								<td>Es fiscal</td>
								<td align="right">
									Referencia:
								</td>
								<td rowspan="5">
									<textarea rows="10" name="gastos_pagos_referencia" cols="25" id="gastos_pagos_referencia"></textarea>
								</td>
							</tr>
							<tr>
								
							</tr>
							<tr>
							
								<td align="right">Monto del pago sin iva: $</td>
								<td><input type="text" name="gastos_pagos_monto_sin_iva" id="gastos_pagos_monto_sin_iva" value="" size="30" disabled></td>
								<td colspan="2"></td>
								
							</tr>
							<tr>
							
								<td align="right">IVA: $</td>
								<td><input type="text" name="gastos_pagos_iva" id="gastos_pagos_iva" value="" size="30" disabled></td>

							</tr>
							<tr>
								<td valign="top">Fecha en que fue realizado el pago:</td>
								<td>
									<div class="form-group" id="data_1" >
										<div class="input-group date">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" id="gastos_pagos_fecha" name="gastos_pagos_fecha" value="">
										</div>
									</div>
									<div class="input-group clockpicker" data-autoclose="true">
										<input name="gastos_pagos_hora" id ="gastos_pagos_hora" type="text" class="form-control" value="12:00" >
										<span class="input-group-addon">
											<span class="fa fa-clock-o"></span>
										</span>
									</div>

								</td>
							</tr>
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
});


$('#data_1 .input-group.date').datepicker({
	keyboardNavigation: false,
	forceParse: false,
	autoclose: true,
	language: 'es'
}).datepicker("setDate", "0");

function crea_pago(){
	
	gasto_id = '<?=$_GET["gasto_id"]?>';
	gastos_pagos_monto=$("#gastos_pagos_monto").val();
	gastos_pagos_forma_de_pago_id=$("#gastos_pagos_forma_de_pago_id").val();
	
	if(gastos_pagos_forma_de_pago_id == '0'){
		alert("Es necesario elegir un metodo de pago");
		return;
	}
	
	if ( $("#gastos_pagos_es_fiscal").is(':checked') ){
		gastos_pagos_es_fiscal = "1";
	} else {
		gastos_pagos_es_fiscal = "0";
	}
	gastos_pagos_monto_sin_iva=$("#gastos_pagos_monto_sin_iva").val();
	gastos_pagos_iva=$("#gastos_pagos_iva").val();
	gastos_pagos_fecha=$("#gastos_pagos_fecha").val();
	gastos_pagos_hora=$("#gastos_pagos_hora").val();
	
	gastos_pagos_referencia=$("textarea#gastos_pagos_referencia").val();
	login_id = '<?=$_SESSION["login_session"]["login_id"]?>';
	
	$("#boton_crea_registro").addClass("disabled");
	$("#span_crea_registro").addClass("glyphicon glyphicon-refresh glyphicon-refresh-animate");
	
	//alert(cierra_gasto);
	
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
		alert("Pago invalido");
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