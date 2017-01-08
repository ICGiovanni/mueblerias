<?php
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'login/session.php');
require_once $pathProy.'/header.php';
require_once $pathProy.'/menu.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'calendario/models/class.Calendario.php');

$objCalendario = new Calendario();

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
		<h2>Nuevo Evento</h2>
		<ol class="breadcrumb">
			<li>
				<a href="">Calendario</a>
			</li>
			<li class="active">
				<strong>Nuevo Evento</strong>
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
								<input type="text" name="evento_nombre" id="evento_nombre" size="30" class="form-control"/>
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
									<input name="evento_hora" id ="evento_hora" type="text" class="form-control" value="12:00" >
									<span class="input-group-addon">
										<span class="fa fa-clock-o"></span>
									</span>
								</div>
							</div>    
						</div>
						
						<div class="form-group">                        
							<label class="control-label col-md-2">Recordatorio</label>                        
							<div class="col-md-3" style="padding:0px 15px 0px 30px; height:35px;">
								<div class="form-group input-group m-b" id="data_2" >
									<span class="input-group-addon">
										<input type="checkbox" name="evento_recordatorio_activo" id="evento_recordatorio_activo" value="1"/>
									</span>
									<div class="input-group date">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<input type="text" class="form-control" id="evento_recordatorio_fecha" name="evento_recordatorio_fecha" value="">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="input-group clockpicker" data-autoclose="true">
									<input name="evento_recordatorio_hora" id ="evento_recordatorio_hora" type="text" class="form-control" value="12:00" >
									<span class="input-group-addon">
										<span class="fa fa-clock-o"></span>
									</span>
								</div>
							</div>    
						</div>
						
						<div class="form-group">                        
							<label class="control-label col-md-2">Descripción</label>                        
							<div class="col-md-5">
								<textarea  name="evento_desc" id="evento_desc" rows="5" class="form-control" ></textarea>
							</div>    
						</div>
						
						 <div class="form-group"> 
							<div class="col-md-7" align="right">
								<button type="button" class="btn btn-danger btn-xs" onclick="location.href = '../';">Cancelar</button>&nbsp;&nbsp;
								<button id="boton_crea_evento" type="button" class="btn btn-primary btn-xs" onclick="crea_evento();">Guardar Evento</button> <span id="span_crea_evento"></span>
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
	<script src="<?=$raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>

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
}).datepicker("setDate", "0");

$('#data_2 .input-group.date').datepicker({
	keyboardNavigation: false,
	forceParse: false,
	autoclose: true,
	language: 'es'
}).datepicker("setDate", "0");

function crea_evento(){
	
	var validate = validate_form();
	if(!validate){
		return;
	}
	
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
	
	login_id = '<?=$_SESSION["login_session"]["login_id"]?>';
	
	$("#boton_crea_evento").addClass("disabled");
	$("#span_crea_evento").addClass("glyphicon glyphicon-refresh glyphicon-refresh-animate");
	
	$.ajax({
		type: "GET",
		url: "../ajax/crea_evento.php",			
		data: {
			
			evento_nombre:evento_nombre,
			evento_fecha:evento_fecha,
			evento_recordatorio_fecha:evento_recordatorio_fecha,
			evento_hora:evento_hora,
			evento_recordatorio_hora:evento_recordatorio_hora,
			evento_recordatorio_activo:evento_recordatorio_activo,
			evento_desc:evento_desc,
			login_id:login_id
		},
		success: function(msg){
			swal({
				title: "Guardado!",
				text: "Evento guardado correctamente!",
				type: "success"
			}, function () {
				location.href = '../';
			});
		}		
	});
}
</script>

</body>

</html>