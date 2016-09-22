<?php
session_start();
$administracion = "Sucursal";
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once $pathProy.'/header.php';
require_once $pathProy.'/menu.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'inventarios/sucursales/models/class.'.$administracion.'.php');

$objSucursal = new Sucursal();

$rows =$objSucursal->getSucursales();
$html_rows = '';

while(list(,$dataSucursal) = each($rows) ){
	$boton_borrar = '';
	
	if($_SESSION["login_session"]["profile_id"] == "1"){ // profile_director
		$boton_borrar = ' &nbsp;<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal8" onclick="load_sucursal_d(\''.$dataSucursal['sucursal_id'].'\');"><i class="fa fa-trash" title="Borrar"></i></a>';
	}
	
	$boton_editar = ' &nbsp;<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal7" onclick="load_sucursal(\''.$dataSucursal['sucursal_id'].'\');"><i class="fa fa-edit" title="Editar"></i></a>';
	
	$html_rows.= '<tr>
		<td>'.$dataSucursal['sucursal_id'].'</td>
		<td id="td_sucursal_name_'.$dataSucursal['sucursal_id'].'">'.$dataSucursal['sucursal_name'].'</td>
		<td id="td_sucursal_abrev_'.$dataSucursal['sucursal_id'].'">'.$dataSucursal['sucursal_abrev'].'</td>
		<td>'.$boton_editar.$boton_borrar.'</td>		
	</tr>';
}
//print_r($rows);
?>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-4">
		<h2>Lista de Sucursales</h2>
		<ol class="breadcrumb">
			<li>
				<a href="">Inventarios</a>
			</li>
			
			<li class="active">
				<strong>Lista de Sucursales</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-8">
		<div class="title-action">
			<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal6" >
			+ Nueva <?=$administracion?>
			</button>
		</div>
	</div>
</div>

<div class="footer">
	<div>
		<strong>Copyright</strong> 
	</div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox-content">
				<div class="">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
						<thead>
						<tr>
							<th><?=$administracion?> ID</th>
							<th><?=$administracion?> Nombre</th>
							<th><?=$administracion?> Abreviacion o Clave</th>
							<th>Accion</th>
						</tr>
						</thead>
						<tbody>
							<?=$html_rows?>
						</tbody>
                    </table>
				</div>
			</div>
		</div>
	</div>
	
</div>

	</div>
	</div>

	<!-- Mainly scripts -->
	
	
    <script src="<?=$raizProy?>js/jquery-2.1.1.js"></script>
    <script src="<?=$raizProy?>js/bootstrap.min.js"></script>
    <script src="<?=$raizProy?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?=$raizProy?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
   

    <!-- Custom and plugin javascript -->
    <script src="<?=$raizProy?>js/inspinia.js"></script>
    <script src="<?=$raizProy?>js/plugins/pace/pace.min.js"></script>

    <!-- Page-Level Scripts -->
	
	<script>
	actual_sucursal = 0;
	
	function guardar_nueva_sucursal(){
		$("#btn_guardar_<?=$administracion?>").addClass("disabled");
		sucursal_name = $("#sucursal_name").val();
		sucursal_abrev = $("#sucursal_abrev").val();
		
		$.ajax({
		type: "GET",
		url: "ajax/crea_<?=strtolower($administracion)?>.php",			
		data: {
			sucursal_name:sucursal_name,
			sucursal_abrev:sucursal_abrev
		},
		success: function(msg){
			location.href = './';
		}		
		});
	}
	
	function editar_sucursal(){
		
		$("#btn_editar_<?=$administracion?>").addClass("disabled");
		sucursal_name = $("#e_sucursal_name").val();
		sucursal_abrev = $("#e_sucursal_abrev").val();
		
		$.ajax({
		type: "GET",
		url: "ajax/edita_<?=strtolower($administracion)?>.php",			
		data: {
			sucursal_id:actual_sucursal,
			sucursal_name:sucursal_name,
			sucursal_abrev:sucursal_abrev
		},
		success: function(msg){
			location.href = './';
		}		
		});
		
	}
	
	function borrar_sucursal(){
		
		$("#btn_borrar_<?=$administracion?>").addClass("disabled");
		
		$.ajax({
		type: "GET",
		url: "ajax/borra_<?=strtolower($administracion)?>.php",			
		data: {
			sucursal_id:actual_sucursal
		},
		success: function(msg){
			location.href = './';
		}		
		});
		
	}
	
	function load_sucursal(sucursal_id){
		actual_sucursal = sucursal_id;
		
		e_sucursal_name = $("#td_sucursal_name_"+actual_sucursal).html();
		e_sucursal_abrev = $("#td_sucursal_abrev_"+actual_sucursal).html();
		
		$("#e_sucursal_name").val(e_sucursal_name);
		$("#e_sucursal_abrev").val(e_sucursal_abrev);
	}
	
	function load_sucursal_d(sucursal_id){
		actual_sucursal = sucursal_id;
		
		d_sucursal_name = $("#td_sucursal_name_"+actual_sucursal).html();
		d_sucursal_abrev = $("#td_sucursal_abrev_"+actual_sucursal).html();
		
		$("#d_sucursal_name").html(d_sucursal_name);
		$("#d_sucursal_abrev").html(d_sucursal_abrev);
	}
	</script>

</body>

<div class="modal inmodal fade" id="myModal6" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Nueva <?=$administracion?></h4>
			</div>
			<div class="modal-body">
				
					<table class="table">
						<tr>
							<td align="right">Nombre:</td>
							<td><input type="text" name="sucursal_name" id="sucursal_name" /></td>
						</tr>
						<tr>
							<td align="right">Abreviacion o Clave:</td>
							<td><input type="text" name="sucursal_abrev" id="sucursal_abrev" /></td>
						</tr>
					</table>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary btn-xs" onclick="guardar_nueva_sucursal();" id="btn_guardar_<?=$administracion?>" >Guardar <?=$administracion?></button>
			</div>
		</div>
	</div>
</div>

<div class="modal inmodal fade" id="myModal7" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
				<h4 class="modal-title">Editar <?=$administracion?></h4>
			</div>
			<div class="modal-body">
				
					<table class="table">
						<tr>
							<td align="right">Nombre:</td>
							<td><input type="text" name="e_sucursal_name" id="e_sucursal_name" /></td>
						</tr>
						<tr>
							<td align="right">Abreviacion o Clave:</td>
							<td><input type="text" name="e_sucursal_abrev" id="e_sucursal_abrev" /></td>
						</tr>
					</table>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary btn-xs" onclick="editar_sucursal();" id="btn_editar_<?=$administracion?>" >Guardar <?=$administracion?></button>
			</div>
		</div>
	</div>
</div>

<div class="modal inmodal fade" id="myModal8" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
				<h4 class="modal-title">Confirmar Borrar <?=$administracion?></h4>
			</div>
			<div class="modal-body">
				
					<table class="table">
						<tr>
							<td>¿Estas seguro de querer borrar la sucursal?</td>
							<td><span name="d_sucursal_name" id="d_sucursal_name"></span></td>
						</tr>
						<tr>
							<td>Abreviacion o Clave:</td>
							<td><span name="d_sucursal_abrev" id="d_sucursal_abrev"></span></td>
						</tr>
					</table>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary btn-xs" onclick="borrar_sucursal();" id="btn_borrar_<?=$administracion?>" >Borrar <?=$administracion?></button>
			</div>
		</div>
	</div>
</div>

</html>