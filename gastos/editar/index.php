<?php
if(empty($_GET["gasto_id"])) {
	die("dato insuficiente");
}
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
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
                        <h5>Editando Gasto</h5>
                        <div class="ibox-tools">
							<button type="button" class="btn btn-danger btn-xs" onclick="location.href = '../';">Cancelar</button>&nbsp;&nbsp;
                            <button id="boton_crea_gasto" type="button" class="btn btn-primary btn-xs" onclick="edita_gasto('<?=$rowGasto["gasto_id"]?>');"><i class="fa fa-save"></i> Guardar Gasto</button> <span id="span_crea_gasto"></span>
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
						
						<table class="table-form">
							<tr>
								<td>No de documento:</td>
								<td><input type="text" name="gasto_no_documento" id="gasto_no_documento" size="30" value="<?=$rowGasto["gasto_no_documento"]?>"/></td>
							</tr>
							<tr>
								<td valign="top">Fecha de vencimiento:</td>
								<td>
									<div class="form-group" id="data_1" >
										<div class="input-group date">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" id="gasto_fecha_vencimiento" name="gasto_fecha_vencimiento" value="<?=$gasto_fecha_vencimiento_dia.'/'.$gasto_fecha_vencimiento_mes.'/'.$gasto_fecha_vencimiento_ano?>">
										</div>
									</div>
									<div class="input-group clockpicker" data-autoclose="true">
										<input name="gasto_hora_vencimiento" id ="gasto_hora_vencimiento" type="text" class="form-control" value="<?=$gasto_hora_vencimiento?>" >
										<span class="input-group-addon">
											<span class="fa fa-clock-o"></span>
										</span>
									</div>

								</td>
								<?php
								$recordatorio_activo_checked = '';
								if($rowGasto["gasto_fecha_recordatorio_activo"] == "1"){
									$recordatorio_activo_checked = "checked";
								}
								?>
								<td valign="top"> <input type="checkbox" name="gasto_fecha_recordatorio_activo" id="gasto_fecha_recordatorio_activo" value="1" <?=$recordatorio_activo_checked?>/> </td>
								<td valign="top">Programar Recordatorio:</td>
								
								<td>
									<div class="form-group" id="data_2" >
										<div class="input-group date">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" id="gasto_fecha_recordatorio" name="gasto_fecha_recordatorio" value="<?=$gasto_fecha_recordatorio_dia.'/'.$gasto_fecha_recordatorio_mes.'/'.$gasto_fecha_recordatorio_ano?>">
										</div>
									</div>
									<div class="input-group clockpicker" data-autoclose="true">
										<input name="gasto_hora_recordatorio" id ="gasto_hora_recordatorio" type="text" class="form-control" value="<?=$gasto_hora_recordatorio?>" >
										<span class="input-group-addon">
											<span class="fa fa-clock-o"></span>
										</span>
									</div>
								</td>
								
							</tr>
							<tr>
								
							</tr>
							
							<tr>
							
								<td>Concepto:</td>
								<td><input type="text" name="gasto_concepto" id="gasto_concepto" value="<?=$rowGasto["gasto_concepto"]?>" size="40"></td>
								
								<td colspan="2" align="right">Categoria:</td>
								<td>
									<select name="gasto_categoria_id" id="gasto_categoria_id">
										<?=$options_gasto_categoria_id?>
									</select>
								</td>
							</tr>
							<tr>
								
							</tr>
							<tr>
								<td>Descripción:</td>
								<td><textarea cols="40" name="gasto_descripcion" id="gasto_descripcion" ><?=$rowGasto["gasto_descripcion"]?></textarea></td>
							</tr>
							<tr>
								<td>Monto:</td>
								<td>$ <input type="text" name="gasto_monto" id="gasto_monto" value="<?=$rowGasto["gasto_monto"]?>" size="10"></td>
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
});

$('#data_2 .input-group.date').datepicker({
	keyboardNavigation: false,
	forceParse: false,
	autoclose: true,
	language: 'es'
});




function edita_gasto(gasto_id){
	$("#boton_crea_gasto").addClass("disabled");
	$("#span_crea_gasto").addClass("glyphicon glyphicon-refresh glyphicon-refresh-animate");
	
	gasto_no_documento=$("#gasto_no_documento").val();
	gasto_fecha_vencimiento=$("#gasto_fecha_vencimiento").val();
	if ( $("#gasto_fecha_recordatorio_activo").is(':checked') ){
		gasto_fecha_recordatorio_activo = "1";
	} else {
		gasto_fecha_recordatorio_activo = "0";
	}
	gasto_fecha_recordatorio=$("#gasto_fecha_recordatorio" ).val();
	gasto_categoria_id=$("#gasto_categoria_id" ).val();
	gasto_concepto=$("#gasto_concepto").val();		
	gasto_descripcion=$("#gasto_descripcion").val();
	gasto_monto=$("#gasto_monto").val();
	gasto_hora_vencimiento=$("#gasto_hora_vencimiento").val();
	gasto_hora_recordatorio=$("#gasto_hora_recordatorio").val();
	
	//gasto_status_id = '1';
	
	$.ajax({
		type: "GET",
		url: "../ajax/edita_gasto.php",			
		data: {gasto_id:gasto_id, gasto_no_documento:gasto_no_documento,gasto_fecha_vencimiento:gasto_fecha_vencimiento,gasto_fecha_recordatorio_activo:gasto_fecha_recordatorio_activo,gasto_fecha_recordatorio:gasto_fecha_recordatorio,gasto_categoria_id:gasto_categoria_id,gasto_concepto:gasto_concepto,gasto_descripcion:gasto_descripcion,gasto_monto:gasto_monto, gasto_hora_vencimiento:gasto_hora_vencimiento, gasto_hora_recordatorio:gasto_hora_recordatorio},
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