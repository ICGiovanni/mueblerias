<?php
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'login/session.php');
require_once $pathProy.'/header.php';
require_once $pathProy.'/menu.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'gastos/models/class.Gastos.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'proveedores/models/class.Proveedores.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'login/models/class.Login.php');
/* INICIO SECUENCIA PARA GASTOS */
$objGasto = new Gasto();

$rowsGastosCategoria = $objGasto->getGastosCategoria();
$rowsGastosSucursal = $objGasto->getGastosSucursal();

$options_gasto_categoria_id = '<option value="0">-- Elige un Categoria --</option>';
while(list(,$dataGastoCategoria) = each($rowsGastosCategoria)){
	$options_gasto_categoria_id.='<option value="'.$dataGastoCategoria["gasto_categoria_id"].'">'.$dataGastoCategoria["gasto_categoria_desc"].'</option>';
}

$options_sucursal_id = '<option value="0">-- Elige una Sucursal --</option>';
while(list(,$dataGastoSucursal) = each($rowsGastosSucursal)){
	$options_sucursal_id.='<option value="'.$dataGastoSucursal["sucursal_id"].'">'.$dataGastoSucursal["sucursal_name"].'</option>';
}
/* FIN SECUENCIA PARA GASTOS */

/* INICIA SECUENCIA PARA PROVEEDORES */
$objProveedor = new Proveedor();
$rowsProveedores = $objProveedor->getProveedores();
$options_proveedor_id = '<option value="0">-- Elige un Proveedor --</option>';
while(list(,$dataProveedor) = each($rowsProveedores)){
	$options_proveedor_id.='<option value="'.$dataProveedor["proveedor_id"].'">'.$dataProveedor["proveedor_nombre"].'</option>';
}
/* FIN SECUENCIA PARA PROVEEDORES */

/* INICIA SECUENCIA PARA EMPLEADOS */
$objLogin = new Login();
$rowsLogin = $objLogin->getUsers("");
//print_r($rowsLogin);
$options_login_id = '<option value="0">-- Elige un Empleado --</option>';
while(list(,$dataLogin) = each($rowsLogin)){
	$options_login_id.='<option value="'.$dataLogin["login_id"].'">'.$dataLogin["firstName"].' '.$dataLogin["lastName"].'</option>';
}
/* FIN SECUENCIA PARA EMPLEADOS */
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
	<div class="col-sm-4">
		<h2>Nuevo Gasto</h2>
		<ol class="breadcrumb">
			<li>
				<a href="">Gastos</a>
			</li>
			<li class="active">
				<strong>Nuevo Gasto</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-8">
		<div class="title-action">
			<button type="button" class="btn btn-warning btn-xs" onclick="location.href = '../';"><i class="fa fa-arrow-left"></i> Regresar a listado</button>
		</div>
	</div>
</div>
		
            <div class="row">
                <div class="col-lg-12">
				
                <div class="wrapper wrapper-content animated fadeInRight form-horizontal">
                   
						<div class="form-group">                        
							<label class="control-label col-md-2">No de documento</label>                        
							<div class="col-md-5">
								<input type="text" name="gasto_no_documento" id="gasto_no_documento" size="30" class="form-control"/>
							</div>    
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Fecha de vencimiento</label>                        
							<div class="col-md-3" style="padding-left:30px; height:35px;">
								<div class="form-group" id="data_1" >
										<div class="input-group date">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" id="gasto_fecha_vencimiento" name="gasto_fecha_vencimiento" value="">
										</div>
								</div>
							</div>   
							<div class="col-md-2">
								<div class="input-group clockpicker" data-autoclose="true">
									<input name="gasto_hora_vencimiento" id ="gasto_hora_vencimiento" type="text" class="form-control" value="12:00" >
									<span class="input-group-addon">
										<span class="fa fa-clock-o"></span>
									</span>
								</div>
							</div>
						</div>

						<div class="form-group">                        
							<label class="control-label col-md-2"> Recordatorio</label>                        
							<div class="col-md-3" style="padding:0px 0px 0px 30px; height:35px;">
								<div class="form-group input-group m-b" id="data_2" >
									<span class="input-group-addon">
										<input type="checkbox" name="gasto_fecha_recordatorio_activo" id="gasto_fecha_recordatorio_activo" value="1"/>
									</span>
									<div class="input-group date">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" id="gasto_fecha_recordatorio" name="gasto_fecha_recordatorio" value="">
									</div>
								</div>
								
							</div>   
							<div class="col-md-2">
								<div class="input-group clockpicker" data-autoclose="true">
									<input name="gasto_hora_recordatorio" id ="gasto_hora_recordatorio" type="text" class="form-control" value="12:00" >
									<span class="input-group-addon">
										<span class="fa fa-clock-o"></span>
									</span>
								</div>
							</div>
						</div>	

                    <div class="form-group">                        
                        <label class="control-label col-md-2">Concepto</label>                        
                        <div class="col-md-5">
                            <input type="text" name="gasto_concepto" id="gasto_concepto" value="" size="40" class="form-control">
                        </div>    
                    </div>
					<div class="form-group">                        
                        <label class="control-label col-md-2">Descripción</label>                        
                        <div class="col-md-5">
                            <textarea cols="40" name="gasto_descripcion" id="gasto_descripcion" class="form-control" ></textarea>
                        </div>    
                    </div>
					 <div class="form-group">                        
                        <label class="control-label col-md-2">Monto</label>                        
                        <div class="col-md-5 input-group m-b" style="padding:0px 15px; height:35px; margin-bottom:1px;">
                            <span class="input-group-addon">$</span>
							<input type="text" name="gasto_monto" id="gasto_monto" value="" size="10" class="form-control">
                        </div>    
                    </div>
                    <div class="form-group">                        
                        <label class="control-label col-md-2">Categoria</label>                        
                        <div class="col-md-5">
                            <select name="gasto_categoria_id" id="gasto_categoria_id" class="chosen-select" onchange="update_sucursal();" >
								<?=$options_gasto_categoria_id?>
							</select>
                        </div>    
                    </div>

                    <div class="form-group">                        
                        <label class="control-label col-md-2">Sucursal</label>                        
                        <div class="col-md-5">
                            <select name="sucursal_id" id="sucursal_id" class="chosen-select" >
								<?=$options_sucursal_id?>
							</select>
                        </div>    
                    </div>
                   
                    <div class="form-group">                        
                        <label class="control-label col-md-2">Proveedor</label>                        
                        <div class="col-md-5">
                            <select name="proveedor_id" id="proveedor_id" class="chosen-select" onchange="update_beneficiary_from_proveedor();">
								<?=$options_proveedor_id?>
							</select>
                        </div>    
                    </div>

                    <div class="form-group">                        
                        <label class="control-label col-md-2">Empleado</label>                        
                        <div class="col-md-5">
                            <select name="login_id" id="login_id"  class="chosen-select" onchange="update_beneficiary_from_login();">
								<?=$options_login_id?>
							</select>
                        </div>    
                    </div>
					<div class="form-group">                        
                        <label class="control-label col-md-2">Beneficiario</label>                        
                        <div class="col-md-5">
                            <input type="text" name="gasto_beneficiario" id="gasto_beneficiario" value="" size="40" class="form-control">
                        </div>    
                    </div>
                    <div class="form-group">                        
                        <label class="control-label col-md-2">Registrar Pago en automático</label>                        
                        <div class="col-md-5">
                            <input type="checkbox" name="pago_automatico" id="pago_automatico" /> 
                        </div>    
                    </div>

                    <div class="form-group"> 
                        <div class="col-md-7" align="right">
                            <button type="button" class="btn btn-danger btn-xs" onclick="location.href = '../';">Cancelar</button>&nbsp;&nbsp;
									<button id="boton_crea_gasto" type="button" class="btn btn-primary btn-xs" onclick="crea_gasto();">Guardar Gasto</button> <span id="span_crea_gasto"></span>
                        </div>    
                    </div>
						
                </div>
            </div>
            </div>
            
       <!--
        <div class="footer">
            <div>
                <strong>Copyright</strong> 
            </div>
        </div>
		-->
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
	 $('#sucursal_id').chosen();
	 $('#proveedor_id').chosen();
	 $('#login_id').chosen();
	 
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




function crea_gasto(){
	
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
	gasto_status_id = '1';
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
	
	if( $("#pago_automatico").is(":checked") ){
		var d = new Date();
		/// DATOS PARA PAGO AUTOMATICO	
		pago_automatico = '1';
		gastos_pagos_monto = gasto_monto;
		gastos_pagos_forma_de_pago_id = '1';
		gastos_pagos_es_fiscal = '0';
		gastos_pagos_monto_sin_iva= '0';
		gastos_pagos_iva = '0';
		gastos_pagos_fecha = '<?=date("d/m/Y")?>';
		gastos_pagos_hora= d.getHours()+':'+d.getMinutes()+':'+d.getSeconds();		
		gastos_pagos_referencia = '';
		login_id_quien_registra = '<?=$_SESSION["login_session"]["login_id"]?>'; // de quien registra el pago
		
		$.ajax({
			type: "GET",
			url: "../ajax/crea_gasto.php",			
			data: {
				
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
				gasto_beneficiario:gasto_beneficiario,
				pago_automatico:pago_automatico,
				
				gastos_pagos_monto:gastos_pagos_monto,
				gastos_pagos_forma_de_pago_id:gastos_pagos_forma_de_pago_id,
				gastos_pagos_es_fiscal:gastos_pagos_es_fiscal,
				gastos_pagos_monto_sin_iva:gastos_pagos_monto_sin_iva,
				gastos_pagos_iva:gastos_pagos_iva,
				gastos_pagos_fecha:gastos_pagos_fecha,
				gastos_pagos_hora:gastos_pagos_hora,
				gastos_pagos_referencia:gastos_pagos_referencia,
				login_id_quien_registra:login_id_quien_registra // login_id de quien registra el pago
			},
			success: function(msg){
				location.href = '../';
			}		
		});
		
	}
	else {
	
		$.ajax({
			type: "GET",
			url: "../ajax/crea_gasto.php",			
			data: {
				
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
			}		
		});
	}
}

function update_beneficiary_from_login(){
	login_text = $("#login_id option:selected").text();
	$("#gasto_beneficiario").val(login_text);
}

function update_beneficiary_from_proveedor(){
	login_text = $("#proveedor_id option:selected").text();
	$("#gasto_beneficiario").val(login_text);
}

function update_sucursal(){
	gasto_categoria_id = $("#gasto_categoria_id option:selected").val();
	if(gasto_categoria_id == "2"){ //si es prestamo 
		$("#sucursal_id").val("1"); // se le atribuye el gasto a la oficina central
		
	}
}
</script>

</body>

</html>