<?php
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'login/session.php');
if(empty($_GET["gasto_id"])) {
	die("dato insuficiente");
}

require_once $pathProy.'/header.php';
require_once $pathProy.'/menu.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'gastos/models/class.Gastos.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'proveedores/models/class.Proveedores.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'login/models/class.Login.php');
require_once($_SERVER['REDIRECT_PATH_CONFIG'].'/calendario/models/class.Calendario.php');
$objCalendario = new Calendario();

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
$options_gasto_categoria_id = '<option value="0">-- Elige un Categoria --</option>';
while(list(,$dataGastoCategoria) = each($rowsGastosCategoria)){
	$selected = '';
	if($rowGasto["gasto_categoria_id"] == $dataGastoCategoria["gasto_categoria_id"]){
		$selected = ' selected';
	}	
	$options_gasto_categoria_id.='<option value="'.$dataGastoCategoria["gasto_categoria_id"].'"'.$selected.'>'.$dataGastoCategoria["gasto_categoria_desc"].'</option>';
}

$rowsGastosSucursal = $objGasto->getGastosSucursal();
$asoccGastoSucursal = array();
$options_sucursal_id = '<option value="0">-- Elige una Sucursal --</option>';
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
$options_gasto_status_id = '<option value="0">-- Elige una Status --</option>';
while(list(,$dataGastoStatus) = each($rowsGastosStatus)){
	$selected = '';
	if($rowGasto["gasto_status_id"] == $dataGastoStatus["gasto_status_id"]){
			$selected = 'selected';
	}
	$asoccGastoStatus[$dataGastoStatus["gasto_status_id"]]=$dataGastoStatus["gasto_status_desc"];
	$options_gasto_status_id.='<option value="'.$dataGastoStatus["gasto_status_id"].'" '.$selected.'>'.$dataGastoStatus["gasto_status_desc"].'</option>';	
}

/* INICIA SECUENCIA PARA PROVEEDORES */
$objProveedor = new Proveedor();
$rowsProveedores = $objProveedor->getProveedores();
$options_proveedor_id = '<option value="0">-- Elige un Proveedor --</option>';
while(list(,$dataProveedor) = each($rowsProveedores)){
	$selected = '';
	if($dataProveedor["proveedor_id"] == $rowGasto["proveedor_id"]){
		$selected = 'selected';
	}
	$options_proveedor_id.='<option value="'.$dataProveedor["proveedor_id"].'" '.$selected.'>'.$dataProveedor["proveedor_nombre"].'</option>';
}
/* FIN SECUENCIA PARA PROVEEDORES */

/* INICIA SECUENCIA PARA EMPLEADOS */
$objLogin = new Login();
$rowsLogin = $objLogin->getUsers("");
//print_r($rowsLogin);
$options_login_id = '<option value="0">-- Elige un Empleado --</option>';
while(list(,$dataLogin) = each($rowsLogin)){
	$selected = '';
	if($dataLogin["login_id"] == $rowGasto["login_id"]){
		$selected = 'selected';
	}
	$options_login_id.='<option value="'.$dataLogin["login_id"].'" '.$selected.'>'.$dataLogin["firstName"].' '.$dataLogin["lastName"].'</option>';
}
/* FIN SECUENCIA PARA EMPLEADOS */


/* INICIA SECUENCIA PARA RECORDATORIOS */
$rowRecordatorio = $objCalendario->existRecordatorio($_GET["gasto_id"]);
$rowEvento["evento_recordatorio_activo"] = "0";
if(isset($rowRecordatorio[0])){
	$rowRecordatorio = $rowRecordatorio[0];
	$rowEvento = $objCalendario->getEvento($rowRecordatorio["evento_id"]);
	$rowEvento = $rowEvento[0];
	//print_r($rowEvento);

	list($gasto_fecha_recordatorio,$gasto_hora_recordatorio)=explode(" ",$rowEvento["evento_recordatorio_fecha"]);
	list($gasto_fecha_recordatorio_ano,$gasto_fecha_recordatorio_mes,$gasto_fecha_recordatorio_dia)=explode("-",$gasto_fecha_recordatorio);
	$gasto_hora_recordatorio = substr($gasto_hora_recordatorio, 0, -3);
}
/* FIN SECUENCIA PARA RECORDATORIOS */
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
		<h2>Editando Gasto <!-- Folio <?=$_GET["gasto_id"]?> --></h2>
		<ol class="breadcrumb">
			<li>
				<a href="">Gastos</a>
			</li>
			<li class="active">
				<strong>Editando Gasto</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4">
		<div class="title-action">
			<button type="button" class="btn btn-danger btn-xs" onclick="location.href = '../';">Cancelar</button>&nbsp;&nbsp;
            <button id="boton_crea_gasto" type="button" class="btn btn-primary btn-xs" onclick="edita_gasto('<?=$rowGasto["gasto_id"]?>');">Guardar Gasto</button> <span id="span_crea_gasto"></span>
		</div>
	</div>
</div>
		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    
                    <div class="ibox-content">
					
						<div>
						
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
								if($rowEvento["evento_recordatorio_activo"] == "1"){
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
									<select name="gasto_categoria_id" id="gasto_categoria_id"  class="chosen-select">
										<?=$options_gasto_categoria_id?>
									</select>
								</td>
							</tr>
							<tr>
								
							</tr>
							<tr>
								<td>Descripción:</td>
								<td><textarea cols="40" name="gasto_descripcion" id="gasto_descripcion" ><?=$rowGasto["gasto_descripcion"]?></textarea></td>
								<td colspan="2" align="right">Sucursal:</td>
								<td>
									<select name="sucursal_id" id="sucursal_id">
										<?=$options_sucursal_id?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Monto:</td>
								<td>$ <input type="text" name="gasto_monto" id="gasto_monto" value="<?=$rowGasto["gasto_monto"]?>" size="10"></td>
								<td colspan="2" align="right">Proveedor:</td>
								<td>
									<select name="proveedor_id" id="proveedor_id" onchange="update_beneficiary_from_proveedor();">
										<?=$options_proveedor_id?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Beneficiario:</td>
								<td><input type="text" name="gasto_beneficiario" id="gasto_beneficiario" value="<?=$rowGasto["gasto_beneficiario"]?>" size="40" ></td>
								<td colspan="2" align="right">Empleado:</td>
								<td>
									<select name="login_id" id="login_id" onchange="update_beneficiary_from_login();">
										<?=$options_login_id?>
									</select>
								</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td colspan="2" align="right">Status:</td>
								<td>
									<select name="gasto_status_id" id="gasto_status_id">
										<?=$options_gasto_status_id?>
									</select>
								</td>
							<tr>
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
	<script src="<?=$raizProy?>js/plugins/chosen/chosen.jquery.js"></script>
<script>

$(document).ready(function(){	
     $.fn.datepicker.defaults.language = 'es';
	 $('.clockpicker').clockpicker();
	 $('#gasto_categoria_id').chosen();
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
	sucursal_id=$("#sucursal_id").val();
	proveedor_id=$("#proveedor_id").val();
	login_id=$("#login_id").val();
	gasto_status_id=$("#gasto_status_id").val();
	gasto_beneficiario=$("#gasto_beneficiario").val();
	
	if(gasto_categoria_id == '0'){
		alert("Es necesario elegir una categoria");
		return;
	}
	if(sucursal_id == '0'){
		alert("Es necesario elegir una sucursal");
		return;
	}
	
	if( (gasto_categoria_id == '15') &&  proveedor_id == '0'){ //gasto inputable a proveedores
		alert("Es necesario elegir un proveedor");
		return;
	}
	
	if( (gasto_categoria_id == '13' || gasto_categoria_id == '2') && login_id == '0' ){ //gasto inputable a empleados
		alert("Es necesario elegir un empleado");
		return;
	}
	
	$("#boton_crea_gasto").addClass("disabled");
	$("#span_crea_gasto").addClass("glyphicon glyphicon-refresh glyphicon-refresh-animate");
	
	$.ajax({
		type: "GET",
		url: "../ajax/edita_gasto.php",			
		data: {
			gasto_id:gasto_id, 
			gasto_no_documento:gasto_no_documento,
			gasto_fecha_vencimiento:gasto_fecha_vencimiento,
			gasto_fecha_recordatorio_activo:gasto_fecha_recordatorio_activo,
			gasto_fecha_recordatorio:gasto_fecha_recordatorio,
			gasto_categoria_id:gasto_categoria_id,
			gasto_concepto:gasto_concepto,
			gasto_descripcion:gasto_descripcion,
			gasto_monto:gasto_monto,
			gasto_status_id:gasto_status_id, 
			gasto_hora_vencimiento:gasto_hora_vencimiento, 
			gasto_hora_recordatorio:gasto_hora_recordatorio, 
			sucursal_id:sucursal_id, 
			proveedor_id:proveedor_id,
			login_id:login_id,
			gasto_beneficiario:gasto_beneficiario
		},
		success: function(msg){
			location.href = '../';
			//$("#myModal").modal('hide');
			//$("#boton_crea_gasto").removeClass().addClass("btn btn-primary");
			//$("#span_crea_gasto").removeClass();
		}		
	});
}

function update_beneficiary_from_login(){
	login_text = $("#login_id option:selected").text();
	$("#gasto_beneficiario").val(login_text);
}

function update_beneficiary_from_proveedor(){
	login_text = $("#proveedor_id option:selected").text();
	$("#gasto_beneficiario").val(login_text);
}
</script>

</body>

</html>