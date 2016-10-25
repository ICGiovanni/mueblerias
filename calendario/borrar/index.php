<?php
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'login/session.php');
if(!isset($_GET["evento_id"])){
	die("datos insuficientes");
}

require_once $pathProy.'/header.php';
require_once $pathProy.'/menu.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'calendario/models/class.Calendario.php');

$objCalendario = new Calendario();
$rowEvento = $objCalendario->getEvento($_GET["evento_id"]);
$rowEvento = $rowEvento[0];

list($evento_fecha, $evento_hora) = explode(" ",$rowEvento["evento_fecha"]);
list($evento_fecha_ano,$evento_fecha_mes,$evento_fecha_dia) = explode("-",$evento_fecha);
$evento_hora_h_m = substr($evento_hora,"0",5);

list($evento_recordatorio_fecha, $evento_recordatorio_hora) = explode(" ",$rowEvento["evento_recordatorio_fecha"]);
list($evento_recordatorio_fecha_ano,$evento_recordatorio_fecha_mes,$evento_recordatorio_fecha_dia) = explode("-",$evento_recordatorio_fecha);
$evento_recordatorio_hora_h_m = substr($evento_recordatorio_hora,"0",5);

$evento_recordatorio_checked = '';
if($rowEvento["evento_recordatorio_activo"]==1){
	$evento_recordatorio_checked = 'checked';
}

//print_r($rowEvento);
?>
<!-- Data picker -->
<link href="<?=$raizProy?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="<?=$raizProy?>css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
<style>

.table-form td, th{
	padding: 5px;
}
</style>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-4">
		<h2>Confirmar borrar Evento Folio <?=$_GET["evento_id"]?></h2>
		<ol class="breadcrumb">
			<li>
				<a href="">Calendario</a>
			</li>
			<li class="active">
				<strong>Borrar Evento</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-8">
		<div class="title-action">
			<button type="button" class="btn btn-danger btn-xs" onclick="location.href = '../';">Cancelar</button>&nbsp;&nbsp;
            <button id="boton_crea_evento" type="button" class="btn btn-primary btn-xs" onclick="borrar_evento('<?=$rowGasto["evento_id"]?>');">Eliminar Evento</button> <span id="span_crea_evento"></span>
		</div>
	</div>
</div>
		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    
                    <div class="ibox-content">
					
					
					
						<div class="table-responsive">
						
						
						¿ Esta realmente seguro de eliminar el evento <b>#Folio: <?=$_GET["evento_id"]?></b> ?
						<br> <b>Nombre del evento:</b> "<?=$rowEvento["evento_nombre"]?>"
						<br> <b>Descripcion del evento:</b> "<?=$rowEvento["evento_desc"]?>"
						
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
		
});

function borrar_evento(evento_id){
	$("#boton_crea_evento").addClass("disabled");
	$("#span_crea_evento").addClass("glyphicon glyphicon-refresh glyphicon-refresh-animate");
	
	$.ajax({
		type: "GET",
		url: "../ajax/borra_evento.php",			
		data: {evento_id:evento_id},
		success: function(msg){
			location.href = '../';
		}		
	});
}
</script>

</body>

</html>