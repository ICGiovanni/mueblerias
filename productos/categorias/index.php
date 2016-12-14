<?php
session_start();
$administracion = "Categoria";
$administracion_p = "Categorias";
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once $pathProy.'/header.php';
require_once $pathProy.'/menu.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'productos/'.strtolower($administracion_p).'/models/class.'.$administracion.'.php');

eval('$objMaterial = new '.$administracion.'();');
eval('$rows =$objMaterial->get'.$administracion_p.'();');

$html_rows = '';

while(list(,$dataGeneric) = each($rows) ){
	$boton_borrar = '';
	
	if($_SESSION["login_session"]["profile_id"] == "1"){ // profile_director
		$boton_borrar = ' &nbsp;<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal8" onclick="load_'.strtolower($administracion).'_d(\''.$dataGeneric[strtolower($administracion).'_id'].'\');"><i class="fa fa-trash" title="Borrar"></i></a>';
	}
	
	$boton_editar = ' &nbsp;<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal7" onclick="load_'.strtolower($administracion).'(\''.$dataGeneric[strtolower($administracion).'_id'].'\');"><i class="fa fa-pencil" title="Editar"></i></a>';
	
	$html_rows.= '<tr>
		<td>'.$dataGeneric[strtolower($administracion).'_id'].'</td>
		<td id="td_'.strtolower($administracion).'_name_'.$dataGeneric[strtolower($administracion).'_id'].'">'.$dataGeneric[strtolower($administracion).'_name'].'</td>
		<td id="td_'.strtolower($administracion).'_abrev_'.$dataGeneric[strtolower($administracion).'_id'].'">'.$dataGeneric[strtolower($administracion).'_abrev'].'</td>
		<td>'.$boton_editar.$boton_borrar.'</td>		
	</tr>';
}
//print_r($rows);
?>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-4">
		<h2>Lista de <?=$administracion_p?></h2>
		<ol class="breadcrumb">
			<li>
				<a href="">Productos</a>
			</li>
			
			<li class="active">
				<strong>Lista de <?=$administracion_p?></strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-8">
		<div class="title-action">
			<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal6" >
			+ Nuevo <?=$administracion?>
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
							<th>ID de <?=$administracion?></th>
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
	actual_<?=strtolower($administracion)?> = 0;
	
	function guardar_nueva_<?=strtolower($administracion)?>(){
		$("#btn_guardar_<?=$administracion?>").addClass("disabled");
		<?=strtolower($administracion)?>_name = $("#<?=strtolower($administracion)?>_name").val();
		<?=strtolower($administracion)?>_abrev = $("#<?=strtolower($administracion)?>_abrev").val();
		
		$.ajax({
		type: "GET",
		url: "ajax/crea_<?=strtolower($administracion)?>.php",			
		data: {
			<?=strtolower($administracion)?>_name:<?=strtolower($administracion)?>_name,
			<?=strtolower($administracion)?>_abrev:<?=strtolower($administracion)?>_abrev
		},
		success: function(msg){
			location.href = './';
		}		
		});
	}
	
	function editar_<?=strtolower($administracion)?>(){
		
		$("#btn_editar_<?=$administracion?>").addClass("disabled");
		<?=strtolower($administracion)?>_name = $("#e_<?=strtolower($administracion)?>_name").val();
		<?=strtolower($administracion)?>_abrev = $("#e_<?=strtolower($administracion)?>_abrev").val();
		
		$.ajax({
		type: "GET",
		url: "ajax/edita_<?=strtolower($administracion)?>.php",			
		data: {
			<?=strtolower($administracion)?>_id:actual_<?=strtolower($administracion)?>,
			<?=strtolower($administracion)?>_name:<?=strtolower($administracion)?>_name,
			<?=strtolower($administracion)?>_abrev:<?=strtolower($administracion)?>_abrev
		},
		success: function(msg){
			location.href = './';
		}		
		});
		
	}
	
	function borrar_<?=strtolower($administracion)?>(){
		
		$("#btn_borrar_<?=$administracion?>").addClass("disabled");
		
		$.ajax({
		type: "GET",
		url: "ajax/borra_<?=strtolower($administracion)?>.php",			
		data: {
			<?=strtolower($administracion)?>_id:actual_<?=strtolower($administracion)?>
		},
		success: function(msg){
			location.href = './';
		}		
		});
		
	}
	
	function load_<?=strtolower($administracion)?>(<?=strtolower($administracion)?>_id){
		actual_<?=strtolower($administracion)?> = <?=strtolower($administracion)?>_id;
		
		e_<?=strtolower($administracion)?>_name = $("#td_<?=strtolower($administracion)?>_name_"+actual_<?=strtolower($administracion)?>).html();
		e_<?=strtolower($administracion)?>_abrev = $("#td_<?=strtolower($administracion)?>_abrev_"+actual_<?=strtolower($administracion)?>).html();
		
		$("#e_<?=strtolower($administracion)?>_name").val(e_<?=strtolower($administracion)?>_name);
		$("#e_<?=strtolower($administracion)?>_abrev").val(e_<?=strtolower($administracion)?>_abrev);
	}
	
	function load_<?=strtolower($administracion)?>_d(<?=strtolower($administracion)?>_id){
		actual_<?=strtolower($administracion)?> = <?=strtolower($administracion)?>_id;
		
		d_<?=strtolower($administracion)?>_name = $("#td_<?=strtolower($administracion)?>_name_"+actual_<?=strtolower($administracion)?>).html();
		d_<?=strtolower($administracion)?>_abrev = $("#td_<?=strtolower($administracion)?>_abrev_"+actual_<?=strtolower($administracion)?>).html();
		
		$("#d_<?=strtolower($administracion)?>_name").html(d_<?=strtolower($administracion)?>_name);
		$("#d_<?=strtolower($administracion)?>_abrev").html(d_<?=strtolower($administracion)?>_abrev);
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
							<td><input type="text" name="<?=strtolower($administracion)?>_name" id="<?=strtolower($administracion)?>_name" /></td>
						</tr>
						<tr>
							<td align="right">Abreviacion o Clave:</td>
							<td><input type="text" name="<?=strtolower($administracion)?>_abrev" id="<?=strtolower($administracion)?>_abrev" /></td>
						</tr>
					</table>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary btn-xs" onclick="guardar_nueva_<?=strtolower($administracion)?>();" id="btn_guardar_<?=$administracion?>" >Guardar <?=$administracion?></button>
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
							<td><input type="text" name="e_<?=strtolower($administracion)?>_name" id="e_<?=strtolower($administracion)?>_name" /></td>
						</tr>
						<tr>
							<td align="right">Abreviacion o Clave:</td>
							<td><input type="text" name="e_<?=strtolower($administracion)?>_abrev" id="e_<?=strtolower($administracion)?>_abrev" /></td>
						</tr>
					</table>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary btn-xs" onclick="editar_<?=strtolower($administracion)?>();" id="btn_editar_<?=$administracion?>" >Guardar <?=$administracion?></button>
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
							<td>¿Estas seguro de querer borrar la <?=strtolower($administracion)?>?</td>
							<td><span name="d_<?=strtolower($administracion)?>_name" id="d_<?=strtolower($administracion)?>_name"></span></td>
						</tr>
						<tr>
							<td>Abreviacion o Clave:</td>
							<td><span name="d_<?=strtolower($administracion)?>_abrev" id="d_<?=strtolower($administracion)?>_abrev"></span></td>
						</tr>
					</table>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary btn-xs" onclick="borrar_<?=strtolower($administracion)?>();" id="btn_borrar_<?=$administracion?>" >Borrar <?=$administracion?></button>
			</div>
		</div>
	</div>
</div>

</html>