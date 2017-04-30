<?php
    include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
    //include $pathProy.'login/session.php';
    include $pathProy.'/header.php';
    include $pathProy.'/menu.php';
?>
<link href="<?php echo $raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<link href="<?=$raizProy?>css/plugins/chosen/chosen.css" rel="stylesheet">


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Nuevo Cliente</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">Clientes</a>
                </li>
                <li class="active">
                    <strong>Nuevo Cliente</strong>
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
		<form method="get" class="form-horizontal" action="/" id="form_cliente">
			<input type="hidden" id="address" name="address" value="0">
			<input type="hidden" id="address_current" name="address_current" value="">
			<div class="form-group"><label class="col-sm-2 control-label">Nombre</label>
			<div class="col-sm-6" ><input type="text" class="form-control" id="nombre" name="nombre"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Apellido Paterno</label>
			<div class="col-sm-6" ><input type="text" class="form-control" id="apellidoP" name="apellidoP"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Apellido Materno</label>
			<div class="col-sm-6" ><input type="text" class="form-control" id="apellidoM" name="apellidoM"></div>
            </div>
            
            
            <div class="col-lg-11">
			<div class="panel panel-default">
            <div class="panel-heading">
            <label class="control-label">Datos Cliente</label>
			</div>
            <div class="panel-body">
            
            <div class="form-group"><label class="col-sm-2 control-label">Tipo</label>
			<div class="col-sm-6">
			<select data-placeholder="Selecciona un Tipo" class="chosen-select" style="width:300px;" tabindex="4" id="tipo_datos" name="tipo_datos">
			<option value="facturacion">Facturación</option>
			<option value="envio">Envio</option>
			</select>
			</div>
			</div>
            
            <div id="div_facturacion" name=""div_facturacion"">
            <div class="form-group"><label class="col-sm-2 control-label">Raz&oacute;n Social</label>
			<div class="col-sm-6"><input type="text" class="form-control" id="razonS" name="razonS"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">RFC</label>
			<div class="col-sm-6"><input type="text" class="form-control" id="rfc" name="rfc"></div>
            </div>
            </div>
            
            <div class="form-group"><label class="col-sm-2 control-label">Calle</label>
			<div class="col-sm-6"><input type="text" class="form-control" id="calle" name="calle"></div>
            </div>
            <div class="form-group">
            <label class="col-sm-2 control-label">No. Exterior</label>
			<div class="col-sm-2"><input type="text" class="form-control" id="noExt" name="noExt"></div>
			<label class="col-sm-2 control-label">No. Interior</label>
			<div class="col-sm-2"><input type="text" class="form-control" id="noInt" name="noInt"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Colonia</label>
			<div class="col-sm-6"><input type="text" class="form-control" id="colonia" name="colonia"></div>
            </div>
            <div class="form-group">
			<label class="col-sm-2 control-label">C.P.</label>
			<div class="col-sm-2"><input type="text" class="form-control" id="codigoPostal" name="codigoPostal"></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Estado</label>
			<div class="col-sm-6">
			<select data-placeholder="Selecciona un estado" class="chosen-select" style="width:300px;" tabindex="4" id="estado" name="estado">
            <option value=""></option>
            </select>
			&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-danger btn-xs" id="limpiar_estado" type="button"><i class="fa fa-times"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
			</div>
			<div class="form-group"><label class="col-sm-2 control-label">Delegación o Municipio</label>
			<div class="col-sm-6"><input type="text" class="form-control" id="municipio" name="municipio"></div>
            </div>
            
            <div class="form-group"><label class="col-sm-2 control-label">Referencia</label>
			<div class="col-sm-6"><textarea class="form-control" id="referencia" name="referencia"></textarea></div>
            </div>
            
            <div class="form-group">
			<div class="col-sm-6 col-sm-offset-2" align="right"><br>
			<button class="btn btn-warning btn-xs" id="limpiar_address" type="button">Limpiar</button>&nbsp;&nbsp;&nbsp;&nbsp;
			<button class="btn btn-primary btn-xs" id="addAddress" type="button">Agregar Dirección</button>
			<button class="btn btn-primary btn-xs" style="display: none;" id="aditAddress" type="button">Actualizar Dirección</button>
			</div>
			</div>
			
			<div class="form-group">
	           	<div class="col-sm-8" >
	           	<div id="address_list" class="ibox-content" style="display:none;">
	           	
	           	<table class="table table-striped">
	           	<thead>
					<tr>
						<td><strong>Tipo</strong></td>
						<td><strong>Datos</strong></td>
						<td></td>
					</tr>
				</thead>
	           	<tbody id="address_table">
	           	
	           	</tbody>
	           	</table>
	           </div>
	           </div>
	           </div>
            
            </div>
			</div>
            </div>
            
            
            
            <div class="form-group">
           	<label class="col-sm-2 control-label">Telefono</label>
           	<div class="col-sm-3 "><input class="form-control telefono_cliente" id="telefono" name="telefono[]" value="" type="text" onkeypress="return validateNumber(event)"></div>
           	<div class="col-md-2">
                            <select id="phoneType" name="phoneType[]" class="form-control chosen-select phone">
                                <option value="1">Celular</option>
                                <option value="2">Casa</option>
                                <option value="3">Oficina</option>
                                <option value="4">Otro</option>
                            </select>
                        </div>
			<div class="col-md-1">                            
                            <button class="btn btn-primary btn-xs" id="agregarTelefono" value="" placeholder="Telefono" type="button"><i class="fa fa-plus"></i></button>
                        </div>    
            </div>
            <div id="newPhone"></div>
            
            <div class="form-group">
           	<label class="col-sm-2 control-label">E-mail</label>
           	<div class="col-sm-5 "><input class="form-control" id="email" name="email[]" value="" type="text"></div>
			<div class="col-md-1">                            
                            <button class="btn btn-primary btn-xs" id="agregarEmail" value="" placeholder="E-mail" type="button"><i class="fa fa-plus"></i></button>
                        </div>    
            </div>
            <div id="newEmail"></div>
            
            <div class="form-group">
			<div class="col-sm-6 col-sm-offset-2" align="right"><br>
			<button class="btn btn-danger btn-xs" id="cancelar" type="button">Cancelar</button>&nbsp;&nbsp;&nbsp;&nbsp;
			<button class="btn btn-primary btn-xs" id="guardar" type="button">Guardar Cliente</button>
			</div>
			</div>
        
		</form>
	</div>
<script src="<?php echo $raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo $raizProy?>js/plugins/toastr/toastr.min.js"></script>
<script src="<?php echo $raizProy?>clientes/js/clientes.js"></script>
<script src="<?=$raizProy?>js/plugins/chosen/chosen.jquery.js"></script>

<?php
    include $pathProy.'footer.php';
?>