<?php
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

$rowPagosDetalle = $objGasto->getPagosDetalle($_GET["gasto_id"]);

//print_r($rowPagosDetalle);
$rowsDataPagoDetalle = '';
while( list(,$dataPagoDetalle)=each($rowPagosDetalle) ){
	
	if($dataPagoDetalle["gastos_pagos_es_fiscal"] == "1"){
		$es_fiscal = "Sí";
	} else {
		$es_fiscal = "No";
	}
	$rowsDataPagoDetalle.='<tr><td align="center">'.$dataPagoDetalle["gastos_pagos_id"].'</td><td align="right">$ '.number_format($dataPagoDetalle["gastos_pagos_monto"],2).'</td><td align="center">'.$es_fiscal.'</td><td>'.$dataPagoDetalle["gastos_pagos_forma_de_pago_desc"].'</td><td align="center">'.$dataPagoDetalle["gastos_pagos_fecha"].'</td></tr>';
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
                        <h5>Detalle de Pagos a Gasto "<?=$rowGasto["gasto_no_documento"]?>"</h5>
                        <div class="ibox-tools">
							<button type="button" class="btn btn-danger btn-xs" onclick="location.href = '../';"><i class="fa fa-arrow-left"></i> Regresar a listado</button>&nbsp;&nbsp;
                            
                            <!--<a class="collapse-link">
                                <i class="fa fa-plus-square-o"></i>
                            </a>-->
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
							
                        </div>
                    </div>
                    <div class="ibox-content">
					
						<div class="table-responsive">
						<table class="table">
							<tr>
								<td>MONTO A PAGAR: <b>$ <?=number_format($rowGasto["gasto_monto"],2)?></b></td>
								<td>A CUENTA: <b style="color:green;">$ <?=number_format($rowPagos["gastos_pagos_monto"],2)?></b></td>
								<td>RESTAN: <b style="color:red;">$ <?=number_format(($rowGasto["gasto_monto"]-$rowPagos["gastos_pagos_monto"]),2)?></b></td>
							</tr>
						</table>
						        
						<table class="table">
							<tr>
								<th style="text-align:center">Folio Pago</th>
								<th style="text-align:center">Monto Pagado</th>
								<th style="text-align:center">Fiscal</th>
								<th>Forma de pago</th>
								<th style="text-align:center">Fecha en que fue relizado el pago</th>
							</tr>
							<?=$rowsDataPagoDetalle?>
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
			//$("#myModal").modal('hide');
			//$("#boton_crea_registro").removeClass().addClass("btn btn-primary");
			//$("#span_crea_registro").removeClass();
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