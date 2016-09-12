<?php
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once $pathProy.'/header.php';
require_once $pathProy.'/menu.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'gastos/models/class.Gastos.php');

$objGasto = new Gasto();

$filtro_fecha_activo_checked = '';
$filtro_categoria_activo_checked = '';
$filtro_status_activo_checked = '';
$filtro_sucursal_activo_checked = '';
if(isset($_GET) && !empty($_GET)){
	
	if(isset($_GET["filtro_fecha_activo"]) && $_GET["filtro_fecha_activo"] == 1){ //add fechas
		$filtro_fecha_activo_checked = 'checked';
	}
	if(isset($_GET["filtro_categoria_activo"]) && $_GET["filtro_categoria_activo"] == 1){ //add fechas
		$filtro_categoria_activo_checked = 'checked';
	}
	if(isset($_GET["filtro_status_activo"]) && $_GET["filtro_status_activo"] == 1){ //add fechas
		$filtro_status_activo_checked = 'checked';
	}
	if(isset($_GET["filtro_sucursal_activo"]) && $_GET["filtro_sucursal_activo"] == 1){ //add fechas
		$filtro_sucursal_activo_checked = 'checked';
	}
	
	
	$rows = $objGasto->getFilteredGastos($_GET);
	
} else {
	$rows = $objGasto->getGastos();
}

$rowsGastosCategoria = $objGasto->getGastosCategoria();
$rowsGastosStatus = $objGasto->getGastosStatus();
$rowsGastosSucursal = $objGasto->getGastosSucursal();


$asoccGastoCategoria = array();
$options_gasto_categoria_id = '<option value="0">-- Elige un Categoria --</option>';
while(list(,$dataGastoCategoria) = each($rowsGastosCategoria)){
	$selected = '';
	if(isset($_GET["filtro_categoria_id"]) && $_GET["filtro_categoria_id"] == $dataGastoCategoria["gasto_categoria_id"]){
		$selected = 'selected';
	}
	$asoccGastoCategoria[$dataGastoCategoria["gasto_categoria_id"]]=$dataGastoCategoria["gasto_categoria_desc"];
	$options_gasto_categoria_id.='<option value="'.$dataGastoCategoria["gasto_categoria_id"].'" '.$selected.'>'.$dataGastoCategoria["gasto_categoria_desc"].'</option>';
}

$asoccGastoStatus = array();
$options_gasto_status_id = '<option value="0">-- Elige un Status --</option>';
while(list(,$dataGastoStatus) = each($rowsGastosStatus)){
	$selected = '';
	if(isset($_GET["filtro_status_id"]) && $_GET["filtro_status_id"] == $dataGastoStatus["gasto_status_id"]){
		$selected = 'selected';
	}
	$asoccGastoStatus[$dataGastoStatus["gasto_status_id"]]=$dataGastoStatus["gasto_status_desc"];
	$options_gasto_status_id.='<option value="'.$dataGastoStatus["gasto_status_id"].'" '.$selected.'>'.$dataGastoStatus["gasto_status_desc"].'</option>';	
}

$asoccGastoSucursal = array();
$options_sucursal_id = '<option value="0">-- Elige una Sucursal --</option>';
while(list(,$dataGastoSucursal) = each($rowsGastosSucursal)){
	$selected = '';
	if(isset($_GET["filtro_sucursal_id"]) && $_GET["filtro_sucursal_id"] == $dataGastoSucursal["sucursal_id"]){
		$selected = 'selected';
	}
	$asoccGastoSucursal[$dataGastoSucursal["sucursal_id"]]=$dataGastoSucursal["sucursal_abrev"];
	$options_sucursal_id.='<option value="'.$dataGastoSucursal["sucursal_id"].'" '.$selected.'>'.$dataGastoSucursal["sucursal_abrev"].'</option>';	
}

//print_r($rows);
$html_rows = '';


while(list(,$dataGasto) = each($rows)){
	$rowPagos = $objGasto->getPagosSum($dataGasto["gasto_id"]);
	$rowUltimoPago = $objGasto->getFechaUltimoPago($dataGasto["gasto_id"]);
		
	$rowPagos=$rowPagos[0];
	
	switch($dataGasto["gasto_status_id"]){
		case '1': //pendiente
			$color_row = "#FBFEC0";
			break;
		case '2': //pagado
			$color_row = "#BCF5BD";
			break;
		case '3': //cancelado
			$color_row = "#CCD7FF";
			break;
		case '4': //vencido
			$color_row = "#FFCACA";
			break;
		default:
			$color_row = "#F5F5F5";
			break;
	}
	$boton_borrar = '';
	if(1){ // profile_director
		$boton_borrar = ' &nbsp;<a href="borrar/?gasto_id='.$dataGasto["gasto_id"].'"><i class="fa fa-trash" title="Borrar"></i></a>';
	}
	$dataGasto["gasto_saldo"]=$dataGasto["gasto_monto"] - $rowPagos["gastos_pagos_monto"];
	$html_rows.= '<tr style="background-color:'.$color_row.';">
		<td align="center">'.$dataGasto["gasto_id"].'</td>
		<td>'.$dataGasto["gasto_no_documento"].'</td>
		<td>'.$dataGasto["gasto_fecha_vencimiento"].'</td>
		<td>'.$rowUltimoPago["gastos_pagos_fecha"].'</td>
		<td>'.$asoccGastoCategoria[$dataGasto["gasto_categoria_id"]].'</td>
		<td>'.$dataGasto["gasto_concepto"].'</td>
		<td>'.$asoccGastoSucursal[$dataGasto["sucursal_id"]].'</td>
		<td>$'.number_format($dataGasto["gasto_monto"],2).'</td>
		<td>'.number_format($dataGasto["gasto_saldo"],2).'</td>
		<td>'.$asoccGastoStatus[$dataGasto["gasto_status_id"]].'</td>
		<td align="center"><a href="pago_nuevo/?gasto_id='.$dataGasto["gasto_id"].'"><i class="fa fa-dollar" title="Realizar Pago"></i></a> &nbsp;<a href="pagos_lista/?gasto_id='.$dataGasto["gasto_id"].'"><i class="fa fa-list-ul" title="Ver detalle de pagos"></i></a> &nbsp;<a href="editar/?gasto_id='.$dataGasto["gasto_id"].'"><i class="fa fa-edit" title="Editar"></i></a>'.$boton_borrar.'</td>
	</tr>';
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
		<h2>Lista de Gastos</h2>
		<ol class="breadcrumb">
			<li>
				<a href="">Gastos</a>
			</li>
			<li class="active">
				<strong>Lista de Gastos</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-8">
		<div class="title-action">
			<button type="button" class="btn btn-primary btn-xs"  onclick="location.href = 'nuevo/';" >
			Nuevo Gasto
			</button>
		</div>
	</div>
</div>

		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
					<!--
                    <div class="ibox-title">
                        <h5>Gastos</h5>
                        <div class="ibox-tools">							
                            <button type="button" class="btn btn-primary btn-xs"  onclick="location.href = 'nuevo/';" >
								Nuevo Gasto
							</button>
                        </div>
                    </div>
					-->
					

                    <div class="ibox-content">
						<div id="div_search_tools">
							FILTRAR BUSQUEDA POR 
						<form>
							<table class="table-form ">
								<tr>
									<td valign="">
										<input type="checkbox" name="filtro_fecha_activo" id="filtro_fecha_activo" value="1" <?=$filtro_fecha_activo_checked?>/> <b>Rango de fechas</b><br>
										inicio 
										<div class="form-group" id="data_rango_inicio" >
											<div class="input-group date">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" id="filtro_fecha_inicio" name="filtro_fecha_inicio" value="">
											</div>
										</div>
									</td>
									<td valign=""><br>
										fin
										<div class="form-group" id="data_rango_fin" >
											<div class="input-group date">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" id="filtro_fecha_fin" name="filtro_fecha_fin" value="">
											</div>
										</div>
									</td>
									<td valign="top">
										<input type="checkbox" name="filtro_categoria_activo" id="filtro_categoria_activo" value="1" <?=$filtro_categoria_activo_checked?>/> <b>Categoria</b><br><br>
										<select name="filtro_categoria_id" id="filtro_categoria_id">
											<?=$options_gasto_categoria_id?>
										</select>
									</td>
									<td valign="top">
										<input type="checkbox" name="filtro_status_activo" id="filtro_status_activo" value="1" <?=$filtro_status_activo_checked?>/> <b>Status</b> <br><br>
										<select name="filtro_status_id" id="filtro_status_id">
											<?=$options_gasto_status_id?>
										</select>
									</td>
									<td valign="top">
										<input type="checkbox" name="filtro_sucursal_activo" id="filtro_sucursal_activo" value="1" <?=$filtro_sucursal_activo_checked?>/> <b>Sucursal</b> <br><br>
										<select name="filtro_sucursal_id" id="filtro_sucursal_id">
											<?=$options_sucursal_id?>
										</select>
									</td>
									<td><br>
										<button type="submit" class="btn btn-primary btn-xs"  onclick="" >Filtrar</button> &nbsp;&nbsp;&nbsp;
										<button type="button" class="btn btn-warning btn-xs"  onclick="location.href = '.';" >Limpiar Filtros</button>
									</td>
								</tr>
							</table>
						</form>	
							
							
							
						</div>
					
					<div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
						<th>Folio</th>
                        <th>No Documento</th>
                        <th>Fecha Vencimiento</th>
						<th>Ultimo Pago</th>
						<th>Categoria</th>
                        <th>Concepto</th>
						<th>Sucursal</th>
                        <th>Monto a Pagar</th>
						<th>Restan</th>
                        <th>Status</th> 
						<th style="text-align:center;">Acción</th>
						
                    </tr>
                    </thead>
                    <tbody>
						<?=$html_rows?>
                    </tbody>
                    <tfoot>
                    <tr>
						<th>Folio</th>
                        <th>No Documento</th>
                        <th>Fecha Vencimiento</th>
						<th>Ultimo Pago</th>
						<th>Categoria</th>
                        <th>Concepto</th>
						<th>Sucursal</th>
                        <th>Monto a Pagar</th>
						<th>Restan</th>
                         <th>Status</th> 
						<th style="text-align:center;">Acción</th>
                    </tr>
                    </tfoot>
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
				"language": {
					"lengthMenu": "Display _MENU_ records per page",
					"zeroRecords": "Nothing found - sorry",
					"info": "Mostrando _MAX_ entradas",
					"infoEmpty": "No records available",
					"infoFiltered": "(filtered from _MAX_ total records)"
				},
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
	
	$('#data_rango_inicio .input-group.date').datepicker({
	keyboardNavigation: false,
	forceParse: false,
	autoclose: true,
	language: 'es'
	}).datepicker("setDate", "<?=isset($_GET["filtro_fecha_inicio"])?$_GET["filtro_fecha_inicio"]:'0'?>");
	
	$('#data_rango_fin .input-group.date').datepicker({
	keyboardNavigation: false,
	forceParse: false,
	autoclose: true,
	language: 'es'
	}).datepicker("setDate", "<?=isset($_GET["filtro_fecha_fin"])?$_GET["filtro_fecha_fin"]:'0'?>");

});
</script>

</body>

</html>