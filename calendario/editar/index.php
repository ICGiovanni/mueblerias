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
<link href="<?=$raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

<style>

.table-form td, th{
	padding: 5px;
}
</style>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-4">
		<h2>Editar Evento</h2>
		<ol class="breadcrumb">
			<li>
				<a href="">Calendario</a>
			</li>
			<li class="active">
				<strong>Editar Evento</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-8">
		<div class="title-action">
			<button type="button" class="btn btn-warning btn-xs" onclick="location.href = '../';"><i class="fa fa-arrow-left"></i> Regresar a vista mensual</button>
		</div>
	</div>
</div>
		
            <div class="row">
                <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight form-horizontal">
                   
						<div class="form-group">
							<label class="control-label col-md-2">Nombre del evento</label>                        
							<div class="col-md-5">
								<input type="text" name="evento_nombre" id="evento_nombre" size="30" class="form-control" value="<?=$rowEvento["evento_nombre"]?>"/>
							</div>    
						</div>
					
						<div class="form-group">                        
							<label class="control-label col-md-2">Fecha del evento</label>                        
							<div class="col-md-3" style="padding-left:30px; height:35px;">
								<div class="form-group" id="data_1" >
									<div class="input-group date">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<input type="text" class="form-control" id="evento_fecha" name="evento_fecha" value="">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="input-group clockpicker" data-autoclose="true">
									<input name="evento_hora" id ="evento_hora" type="text" class="form-control" value="<?=$evento_hora_h_m?>" >
									<span class="input-group-addon">
										<span class="fa fa-clock-o"></span>
									</span>
								</div>
							</div>    
						</div>
						
						<div class="form-group">                        
							<label class="control-label col-md-2">Recordatorio</label>                        
							<div class="col-md-3" style="padding:0px 0px 0px 30px; height:35px;">
								<div class="form-group input-group m-b" id="data_2" >
									<span class="input-group-addon">
										<input type="checkbox" name="evento_recordatorio_activo" id="evento_recordatorio_activo" value="1" <?=$evento_recordatorio_checked?>/>
									</span>
									<div class="input-group date">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<input type="text" class="form-control" id="evento_recordatorio_fecha" name="evento_recordatorio_fecha" value="">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="input-group clockpicker" data-autoclose="true">
									<input name="evento_recordatorio_hora" id ="evento_recordatorio_hora" type="text" class="form-control"  value="<?=$evento_recordatorio_hora_h_m?>" >
									<span class="input-group-addon">
										<span class="fa fa-clock-o"></span>
									</span>
								</div>
							</div>    
						</div>
						
						<div class="form-group">                        
							<label class="control-label col-md-2">Descripción</label>                        
							<div class="col-md-5">
								<textarea  name="evento_desc" id="evento_desc" rows="5" class="form-control" ><?=$rowEvento["evento_desc"]?></textarea>
							</div>    
						</div>
						
						<div class="form-group"> 
							<div class="col-md-7" align="right">								
								<button type="button" class="btn btn-danger btn-xs" onclick="confirmDelete('<?=$rowEvento["evento_id"]?>'); ">BORRAR EVENTO</button>&nbsp;&nbsp;
								<button type="button" class="btn btn-danger btn-xs" onclick="location.href = '../';">Cancelar</button>&nbsp;&nbsp;
								<button id="boton_crea_evento" type="button" class="btn btn-primary btn-xs" onclick="edita_evento();">Guardar Evento</button> <span id="span_crea_evento"></span>
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
	<script src="<?=$raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="<?=$raizProy?>js/plugins/dataTables/datatables.min.js"></script>
	

	<script src="<?=$raizProy?>js/plugins/datapicker/bootstrap-datepicker.js"></script>
	<script src="<?=$raizProy?>js/plugins/datapicker/bootstrap-datepicker.es.js"></script>
	<script src="<?=$raizProy?>js/plugins/clockpicker/clockpicker.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?=$raizProy?>js/inspinia.js"></script>
    <script src="<?=$raizProy?>js/plugins/pace/pace.min.js"></script>

    <!-- Page-Level Scripts -->
	<script src="<?=$raizProy?>js/plugins/toastr/toastr.min.js"></script>
<script>

toastr.options={
	  "closeButton": true,
	  "debug": false,
	  "progressBar": true,
	  "preventDuplicates": false,
	  "positionClass": "toast-top-right",
	  "onclick": null,
	  "showDuration": "400",
	  "hideDuration": "1000",
	  "timeOut": "7000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
}

$(document).ready(function(){
     $.fn.datepicker.defaults.language = 'es';
	 $('.clockpicker').clockpicker();
	 $("#evento_nombre").focus();
});

function validate_form(){
	var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
	var bandera=true;

	if($("#evento_nombre").val()=='')
	{
		toastr.error('Debe de agregar un Nombre del evento');
		$("#evento_nombre").val('');
		$("#evento_nombre").focus();
		bandera=false;
	}
	return bandera;
}

$('#data_1 .input-group.date').datepicker({
	keyboardNavigation: false,
	forceParse: false,
	autoclose: true,
	language: 'es'
}).datepicker("setDate", "<?=$evento_fecha_dia?>/<?=$evento_fecha_mes?>/<?=$evento_fecha_ano?>");

$('#data_2 .input-group.date').datepicker({
	keyboardNavigation: false,
	forceParse: false,
	autoclose: true,
	language: 'es'
}).datepicker("setDate", "<?=$evento_recordatorio_fecha_dia?>/<?=$evento_recordatorio_fecha_mes?>/<?=$evento_recordatorio_fecha_ano?>");


function confirmDelete(evento_id){
	swal({
	  title: "¿ Estás seguro ?",
	  text: "Se va a eliminar la actividad #"+evento_id,
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#DD6B55",
	  confirmButtonText: "Borrar",
	  cancelButtonText: "Cancelar",
	  closeOnConfirm: false,
	},
	function(isConfirm){
		if (isConfirm) {
			borrar_actividad(evento_id);
			swal({
				title: "Borrado!", 
				text: "Se ha borrado la actividad #"+evento_id, 
				type: "success"			
			}, function () {
				location.href = '../';
			});
		}
	});
}

function borrar_actividad(evento_id){
	
	$.ajax({
		type: "GET",
		url: "../ajax/borra_evento.php",			
		data: {evento_id:evento_id},
		success: function(msg){
			
		}		
	});
	
}

function edita_evento(){
	
	var validate = validate_form();
	if(!validate){
		return;
	}
	
	evento_id='<?=$_GET["evento_id"]?>';
	evento_nombre=$("#evento_nombre").val();
	
	evento_fecha=$("#evento_fecha").val();
	evento_recordatorio_fecha=$("#evento_recordatorio_fecha").val();

	evento_hora=$("#evento_hora").val();
	evento_recordatorio_hora=$("#evento_recordatorio_hora").val();	
	
	
	if ( $("#evento_recordatorio_activo").is(':checked') ){
		evento_recordatorio_activo = "1";
	} else {
		evento_recordatorio_activo = "0";
	}
	
	evento_desc=$("#evento_desc").val();
	
	$("#boton_crea_evento").addClass("disabled");
	$("#span_crea_evento").addClass("glyphicon glyphicon-refresh glyphicon-refresh-animate");
	
	$.ajax({
		type: "GET",
		url: "../ajax/edita_evento.php",			
		data: {
			
			evento_nombre:evento_nombre,
			evento_fecha:evento_fecha,
			evento_recordatorio_fecha:evento_recordatorio_fecha,
			evento_hora:evento_hora,
			evento_recordatorio_hora:evento_recordatorio_hora,
			evento_recordatorio_activo:evento_recordatorio_activo,
			evento_desc:evento_desc,
			evento_id:evento_id
		},
		success: function(msg){
			location.href = '../';
			//$("#myModal").modal('hide');
		}		
	});
}
</script>

</body>

</html>