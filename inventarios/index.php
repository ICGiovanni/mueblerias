<?php
session_start();
$administracion = "Inventario";
$administracion_p = "Inventario";
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once $pathProy.'/header.php';
require_once $pathProy.'/menu.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'productos/models/class.Productos.php');

$objProducto = new Productos();
//$rows =$objProducto->getInventario();

$html_rows = '';
/*
while(list(,$dataGeneric) = each($rows) ){
	$boton_borrar = '';
	
	if($_SESSION["login_session"]["profile_id"] == "1"){ // profile_director
		$boton_borrar = ' &nbsp;<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal8" onclick="load_'.strtolower($administracion).'_d(\''.$dataGeneric[strtolower($administracion).'_id'].'\');"><i class="fa fa-trash" title="Borrar"></i></a>';
	}
	
	$boton_editar = ' &nbsp;<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal7" onclick="load_'.strtolower($administracion).'(\''.$dataGeneric[strtolower($administracion).'_id'].'\');"><i class="fa fa-edit" title="Editar"></i></a>';
	
	$html_rows.= '<tr>
		<td>'.$dataGeneric[strtolower($administracion).'_id'].'</td>
		<td id="td_'.strtolower($administracion).'_name_'.$dataGeneric[strtolower($administracion).'_id'].'">'.$dataGeneric[strtolower($administracion).'_name'].'</td>
		<td id="td_'.strtolower($administracion).'_abrev_'.$dataGeneric[strtolower($administracion).'_id'].'">'.$dataGeneric[strtolower($administracion).'_abrev'].'</td>
		<td>'.$boton_editar.$boton_borrar.'</td>		
	</tr>';
}*/
//print_r($rows);
?>
<!-- FooTable -->
<link href="<?php echo $raizProy?>css/plugins/chosen/chosen.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/easy-autocomplete/easy-autocomplete.min.css" rel="stylesheet">
<link href="<?=$raizProy?>css/plugins/footable/footable.core.css" rel="stylesheet">
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-4">
		<h2><?=$administracion_p?></h2>
		<ol class="breadcrumb">
			<li>
				<a href="">Inventarios</a>
			</li>
			
			<li class="active">
				<strong><?=$administracion_p?></strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-8">
		<div class="title-action">
			<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_nuevo_inventario" >
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
				<input class="form-control input-sm m-b-xs" id="filter" placeholder="Buscar producto" type="text">
                    <table class="footable table table-bordered dataTables-example toggle-square" data-filter="#filter">
						<thead>
						<tr>
							<th>SKU</th>
							<th>Producto</th>
							<th>Categoria</th>
							<th data-hide="all" style="text-align:right;"></th>
							<th>Accion</th>
						</tr>
						</thead>
						<tbody>
							<?=$html_rows?>
							<tr>
								<td>1993KSHJIW</td>
								<td>Silla Melocoton</td>
								<td>Comedores</td>
								<td><b>Cantidad por Sucursal:</b><br>
								Sucursal 3 <i class="fa fa-long-arrow-right"></i> 3<br>
								Sucursal 7 <i class="fa fa-long-arrow-right"></i> 6<br>
								Sucursal 9 <i class="fa fa-long-arrow-right"></i> 1<br></td>
								<td></td>
							</tr>
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
	
	<!-- FooTable -->
    <script src="<?=$raizProy?>js/plugins/footable/footable.all.min.js"></script>

    <!-- Page-Level Scripts -->
	
	<script>
$(document).ready(function(){
	/*$('.footable').footable({
		sorting:  false
	});*/

	$('.footable').footable({
		"paging": {
			"enabled": true
		},
		"filtering": {
			"enabled": true
		},
		"sorting": {
			"enabled": true
		}
	});
});
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
				
			</div>			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary btn-xs" onclick="editar_<?=strtolower($administracion)?>();" id="btn_editar_<?=$administracion?>" >Guardar <?=$administracion?></button>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo $raizProy?>js/plugins/toastr/toastr.min.js"></script>

<script src="<?php echo $raizProy?>js/plugins/chosen/chosen.jquery.js"></script>
<script src="<?php echo $raizProy?>js/plugins/easy-autocomplete/jquery.easy-autocomplete.min.js"></script>

<div class="modal inmodal fade" id="modal_nuevo_inventario" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding: 15px">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h3 class="modal-title">Inventario</h3>
            </div>
            <div class="modal-body" style="padding-bottom: 0px !important; margin-bottom: -15px !important">    
                <?php include_once 'nueva_solicitud.php' ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary btn-xs" id="btn_guardar_proveedor" >Guardar</button>
            </div>
        </div>
    </div>
</div>



</html>