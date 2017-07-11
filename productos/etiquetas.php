<?php
    include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
    //include $pathProy.'login/session.php';
    require_once($_SERVER["REDIRECT_PATH_CONFIG"].'productos/models/class.Productos.php');
    require_once($_SERVER["REDIRECT_PATH_CONFIG"].'proveedores/models/class.Proveedores.php');
    include $pathProy.'/header.php';
    include $pathProy.'/menu.php';
?>
<link href="<?php echo $raizProy?>css/plugins/chosen/chosen.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/easy-autocomplete/easy-autocomplete.min.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

<style>
#product_list
{
	display:none;
}
#div_conjunto
{
	display:none;
}
</style>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Nuevo Producto</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">Productos</a>
                </li>
                <li class="active">
                    <strong>Nuevo Producto</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="./index.php" class="btn btn-warning btn-xs"><i class="fa fa-arrow-left"></i> Regresar a listado</a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
		<form method="post" class="form-horizontal" action="/" id="form_etiquetas" enctype="multipart/form-data">
			
			<div id="div_etiqueta">
				
				<div class="form-group">
	           	<label class="col-sm-2 control-label">Posición Inicial</label>
	           	<div class="col-sm-1" ><input type="text" class="form-control" id="inicio" name="inicio" value="1"></div>
	           	</div>
			
	           	<div class="form-group">
	           	<label class="col-sm-2 control-label">Productos</label>
	           	<div class="col-sm-6" ><input type="text" class="form-control" id="producto_etiqueta" name="producto_etiqueta"></div>
	           	</div>
	           	
	           	<div class="form-group">
	           	<div class="col-sm-2" ></div>
	           	<div class="col-sm-6" >
	           	<div id="product_list" class="ibox-content">
	           	
	           	<table class="table table-striped">
	           	<thead>
					<tr>
						<td></td>
						<td>Cantidad</td>
						<td>SKU</td>
						<td>Nombre</td>
						<td></td>
					</tr>
				</thead>
	           	<tbody id="products_table">
	           	
	           	</tbody>
	           	</table>
	           </div>
	           </div>
	           </div>
            </div>
            
            <div class="form-group">
			<div class="col-sm-6 col-sm-offset-2" align="right"><br>
			<button class="btn btn-danger btn-xs" id="cancelar" type="button">Cancelar</button>&nbsp;&nbsp;&nbsp;&nbsp;
			<button class="btn btn-primary btn-xs" id="guardar" type="button">Guardar</button>
			</div>
			</div>
        </form>
	</div>

<script src="<?php echo $raizProy?>js/plugins/toastr/toastr.min.js"></script>

<script src="<?php echo $raizProy?>js/plugins/chosen/chosen.jquery.js"></script>
<script src="<?php echo $raizProy?>js/plugins/easy-autocomplete/jquery.easy-autocomplete.min.js"></script>
<script src="<?php echo $raizProy?>productos/js/etiquetas.js"></script>
<script src="<?php echo $raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>  

<?php
    include $pathProy.'footer.php';
?>