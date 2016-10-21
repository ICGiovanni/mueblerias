<?php
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'login/session.php');
if(empty($_GET["gasto_id"])) {
	die("dato insuficiente");
}

require_once $pathProy.'/header.php';
require_once $pathProy.'/menu.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'gastos/models/class.Gastos.php');

$objGasto = new Gasto();
$rowGasto = $objGasto->getGasto($_GET["gasto_id"]);
$rowGasto=$rowGasto[0];

list($gasto_fecha_vencimiento,$gasto_hora_vencimiento)=explode(" ",$rowGasto["gasto_fecha_vencimiento"]);
list($gasto_fecha_vencimiento_ano,$gasto_fecha_vencimiento_mes,$gasto_fecha_vencimiento_dia)=explode("-",$gasto_fecha_vencimiento);
$gasto_hora_vencimiento = substr($gasto_hora_vencimiento, 0, -3);

list($gasto_fecha_recordatorio,$gasto_hora_recordatorio)=explode(" ",$rowGasto["gasto_fecha_recordatorio"]);
list($gasto_fecha_recordatorio_ano,$gasto_fecha_recordatorio_mes,$gasto_fecha_recordatorio_dia)=explode("-",$gasto_fecha_recordatorio);
$gasto_hora_recordatorio = substr($gasto_hora_recordatorio, 0, -3);

$rowsGastosCategoria = $objGasto->getGastosCategoria();
$options_gasto_categoria_id = '';
while(list(,$dataGastoCategoria) = each($rowsGastosCategoria)){
	$selected = '';
	if($rowGasto["gasto_categoria_id"] == $dataGastoCategoria["gasto_categoria_id"]){
		$selected = ' selected';
	}	
	$options_gasto_categoria_id.='<option value="'.$dataGastoCategoria["gasto_categoria_id"].'"'.$selected.'>'.$dataGastoCategoria["gasto_categoria_desc"].'</option>';
}

$rowsGastosSucursal = $objGasto->getGastosSucursal();
$asoccGastoSucursal = array();
$options_sucursal_id = '';
while(list(,$dataGastoSucursal) = each($rowsGastosSucursal)){
	$selected = '';
	if($rowGasto["sucursal_id"] == $dataGastoSucursal["sucursal_id"]){
			$selected = 'selected';
	}
	$asoccGastoSucursal[$dataGastoSucursal["sucursal_id"]]=$dataGastoSucursal["sucursal_name"];
	$options_sucursal_id.='<option value="'.$dataGastoSucursal["sucursal_id"].'" '.$selected.'>'.$dataGastoSucursal["sucursal_name"].'</option>';
}

$rowsGastosStatus = $objGasto->getGastosStatus();
$asoccGastoStatus = array();
$options_gasto_status_id = '';
while(list(,$dataGastoStatus) = each($rowsGastosStatus)){
	$selected = '';
	if($rowGasto["gasto_status_id"] == $dataGastoStatus["gasto_status_id"]){
			$selected = 'selected';
	}
	$asoccGastoStatus[$dataGastoStatus["gasto_status_id"]]=$dataGastoStatus["gasto_status_desc"];
	$options_gasto_status_id.='<option value="'.$dataGastoStatus["gasto_status_id"].'" '.$selected.'>'.$dataGastoStatus["gasto_status_desc"].'</option>';	
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
	<div class="col-sm-4">
		<h2>Confirmar borrar Gasto Folio <?=$_GET["gasto_id"]?></h2>
		<ol class="breadcrumb">
			<li>
				<a href="">Gastos</a>
			</li>
			<li class="active">
				<strong>Borrar Gasto</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-8">
		<div class="title-action">
			<button type="button" class="btn btn-danger btn-xs" onclick="location.href = '../';">Cancelar</button>&nbsp;&nbsp;
            <button id="boton_crea_gasto" type="button" class="btn btn-primary btn-xs" onclick="borrar_gasto('<?=$rowGasto["gasto_id"]?>');">Eliminar Gasto</button> <span id="span_crea_gasto"></span>
		</div>
	</div>
</div>
		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    
                    <div class="ibox-content">
					
					
					
						<div class="table-responsive">
						
						
						¿ Esta realmente seguro de eliminar el gasto <b>#Folio: <?=$_GET["gasto_id"]?></b> ?<br> <b>Concepto:</b> "<?=$rowGasto["gasto_no_documento"]?>"
						
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




function borrar_gasto(gasto_id){
	$("#boton_crea_gasto").addClass("disabled");
	$("#span_crea_gasto").addClass("glyphicon glyphicon-refresh glyphicon-refresh-animate");
	
	$.ajax({
		type: "GET",
		url: "../ajax/borra_gasto.php",			
		data: {gasto_id:gasto_id},
		success: function(msg){
			location.href = '../';
			//$("#myModal").modal('hide');
			//$("#boton_crea_gasto").removeClass().addClass("btn btn-primary");
			//$("#span_crea_gasto").removeClass();
		}		
	});
}
</script>

</body>

</html>