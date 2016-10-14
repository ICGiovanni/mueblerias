<?php
session_start();
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once $pathProy.'/header.php';
require_once $pathProy.'/menu.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'calendario/models/class.Calendario.php');

$objCalendario = new Calendario();

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
			<button type="button" class="btn btn-danger btn-xs" onclick="location.href = '../';">Cancelar</button>&nbsp;&nbsp;
            <button id="boton_crea_evento" type="button" class="btn btn-primary btn-xs" onclick="crea_evento();">Guardar Evento</button> <span id="span_crea_evento"></span>
		</div>
	</div>
</div>
		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                   
                <!--    <div class="ibox-content"> -->
					
					
					
						<div class="table-responsive">
						
						<table class="table-form">
							<tr>
								<td>Nombre del evento:</td>
								<td><input type="text" name="evento_nombre" id="evento_nombre" size="30"/></td>
							</tr>
							<tr>
								<td valign="top">Fecha del evento:</td>
								<td>
									<div class="form-group" id="data_1" >
										<div class="input-group date">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											<input type="text" class="form-control" id="evento_fecha" name="evento_fecha" value="">
										</div>
									</div>
									<div class="input-group clockpicker" data-autoclose="true">
										<input name="evento_hora" id ="evento_hora" type="text" class="form-control" value="12:00" >
										<span class="input-group-addon">
											<span class="fa fa-clock-o"></span>
										</span>
									</div>

								</td>
								<td valign="top"> <input type="checkbox" name="evento_recordatorio_activo" id="evento_recordatorio_activo" value="1"/> </td>
								<td valign="top">Programar Recordatorio:</td>
								
								<td>
									<div class="form-group" id="data_2" >
										<div class="input-group date">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											<input type="text" class="form-control" id="evento_recordatorio_fecha" name="evento_recordatorio_fecha" value="">
										</div>
									</div>
									<div class="input-group clockpicker" data-autoclose="true">
										<input name="evento_recordatorio_hora" id ="evento_recordatorio_hora" type="text" class="form-control" value="12:00" >
										<span class="input-group-addon">
											<span class="fa fa-clock-o"></span>
										</span>
									</div>
								</td>
								
							</tr>
							
							<tr>
							
								<td>Descripción:</td>
								<td><input type="text" name="evento_desc" id="evento_desc" value="" size="40"></td>
								
								
							</tr>
					  </table>
		
                    
                        </div>

                   <!-- </div> -->
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
		
     $.fn.datepicker.defaults.language = 'es';
	 $('.clockpicker').clockpicker();
});


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
			location.href = '../';
			//$("#myModal").modal('hide');
		}		
	});
}
</script>

</body>

</html>