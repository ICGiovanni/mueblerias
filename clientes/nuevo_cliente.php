<?php
    include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
    include $pathProy.'/header.php';
    include $pathProy.'/menu.php';
?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Agregar Cliente</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">Clientes</a>
                </li>
                <li class="active">
                    <strong>Agregar Cliente</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="./index.php" class="btn btn-primary">Lista de Clientes</a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
		<form method="get" class="form-horizontal">
			<div class="form-group"><label class="col-sm-2 control-label">Nombre</label>
			<div class="col-sm-6"><input type="text" class="form-control" id="nombre"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Raz&oacute;n Social</label>
			<div class="col-sm-6"><input type="text" class="form-control" id="razonS"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">RFC</label>
			<div class="col-sm-6"><input type="text" class="form-control" id="rfc"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Calle</label>
			<div class="col-sm-6"><input type="text" class="form-control" id="calle"></div>
            </div>
            <div class="form-group">
            <label class="col-sm-2 control-label">No. Exterior</label>
			<div class="col-sm-2"><input type="text" class="form-control" id="noExt"></div>
			<label class="col-sm-2 control-label">No. Interior</label>
			<div class="col-sm-2"><input type="text" class="form-control" id="noInt"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Colonia</label>
			<div class="col-sm-6"><input type="text" class="form-control" id="colonia"></div>
            </div>
            <div class="form-group">
			<label class="col-sm-2 control-label">C.P.</label>
			<div class="col-sm-2"><input type="text" class="form-control" id="codigoPostal"></div>
            </div>
            <div class="form-group">
            <label class="col-sm-2 control-label">Telefono de Casa</label>
			<div class="col-sm-2 "><input type="text" class="form-control" id="telefono"></div>
			<label class="col-sm-2 control-label">Celular</label>
			<div class="col-sm-2"><input type="text" class="form-control" id="celular"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">E-mail</label>
			<div class="col-sm-6"><input type="text" class="form-control" id="email"></div>
            </div>
            <div class="form-group">
			<div class="col-sm-4 col-sm-offset-2">
			<button class="btn btn-white" id="cancelar" type="button">Cancelar</button>
			<button class="btn btn-primary" type="submit">Guardar</button>
			<label class="col-sm-2 control-label">* </label>
			</div>
			</div>
        
		</form>
	</div>

<script>
$(document).ready(function()
{
	$("#nombre").focus();

	$( "#cancelar" ).click(function()
	{
		var url="index.php";
		$(location).attr("href", url);
	});
	
});
</script>


   

<?php
    include $pathProy.'footer.php';
?>