<?php
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/general/class.General.php');
require_once $pathProy.'/header2.php';
require_once $pathProy.'/menu.php';

$objGeneral = new General();
$arrayMetodosPago = $objGeneral->getMetodosPago();

$rowsMetodosPago = '<option value="0">Selecciona un método de pago</option> ';
while( list ($KeyMP, $valueMP) = each($arrayMetodosPago) ){
	$rowsMetodosPago.='<option value="'.$valueMP["general_forma_de_pago_id"].'">'.$valueMP["general_forma_de_pago_desc"].'</option> ';
}


if(!isset($_SESSION["punto_venta"])){
	die("Agregar productos al carrito");
}
else{
	$trProductos = '';
	$totalVenta = 0;
	while( list($keyP, $valueP) = each($_SESSION["punto_venta"]["Productos"])){
		$trProductos.= '<tr>
			<td>'.$valueP["SKU"].'</td>
			<td>'.$valueP["Modelo"].'</td>
			<td>'.$valueP["Cantidad"].'</td>
			<td>'.$valueP["Precio"].'</td>
			<td>'.$valueP["Subtotal"].'</td>
		</tr>';
		$totalVenta+=$valueP["Subtotal"];
	}
}
//print_r($_SESSION);
?>   
<link href="<?=$raizProy?>css/plugins/iCheck/custom.css" rel="stylesheet">
<link href="<?=$raizProy?>css/plugins/steps/jquery.steps.css" rel="stylesheet">
<link href="<?=$raizProy?>css/plugins/chosen/chosen.css" rel="stylesheet">
<link href="<?=$raizProy?>css/plugins/easy-autocomplete/easy-autocomplete.min.css" rel="stylesheet">

<style>
.wizard > .content > .body  position: relative; 
.wizard > .content { min-height: 350px; overflow: scroll;}
.wizard-big.wizard > .content { min-height: 350px; overflow: scroll; }
.wizard > .steps > ul > li { width: 10% !important; }
#inputBuscaCliente { width: 830px !important;}


</style>
        
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Punto de Venta</h2>
		<ol class="breadcrumb">
			<li>
				<a href="index.html">Punto de Venta</a>
			</li>
			<li class="active">
				<strong>Venta</strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-2">

	</div>
</div>
        <div class="wrapper wrapper-content animated fadeInRight">
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        
                        <div class="ibox-content">
                           

                            <form id="form" action="#" class="wizard-big">
							
								<h1><i class="fa fa-user"></i></h1>
								<!-- INICIA DATOS DEL CLIENTE -->
                                <fieldset>
                                    <!-- <h2>Account Information</h2> -->
                                    <div class="row">
										<div class="col-lg-10">
											<font style="font-size:25px;">Datos del cliente</font>
											<br>
											
											
											<div class="form-group"><br>
												<div class="form-group"><input type="text" placeholder="Nombre, email, numero telefonico" class="form-control" id="inputBuscaCliente_0" name="inputBuscaCliente_0" ></div>
												<div class="form-group" id="divBuscaCliente_0" ></div>
												
                                            </div>
										</div>
										
										<div class="col-lg-2" align="center">  <br><br><br>                                   
                                            <div class="form-group">
												<div style=""> <button type="button" class="btn btn-sm btn-warning"  data-toggle="modal" data-target="#modalNuevoCliente"> <b>+ Nuevo Cliente</b> </button> </div>
											</div>
                                        </div>
										
                                        
                                    </div>

                                </fieldset>
								<!-- FINALIZA DATOS DEL CLIENTE -->
							
                               
								
                                <h1><i class="fa fa-truck"></i></h1>
								<!-- INICIA SELECCION ENVIO -->
                                <fieldset>
                                   
									<div class="form-group">
										
										<div class="col-lg-12">
											<div align="center"><font style="font-size:25px;">¿Requiere envío a domicilio?</font></div>
											<br><br><br><div align="center">
													
													<table>
														<tr>
															<td><button class="btn btn-primary dim btn-large-dim" type="button" data-toggle="modal" data-target="#modalBuscaCliente">SÍ</button></td>
															<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
															<td><button class="btn btn-danger dim btn-large-dim" type="button">NO</button></td>
														</tr>
											</div>	</table>
										</div>
										
										
									</div>
								   
                                </fieldset>
								
								
							
								<!-- FINALIZA SELECCION ENVIO -->
								
                                <h1><i class="fa fa-dollar"></i></h1>
								<!-- INICIA SELECCION FACTURA -->
                                <fieldset>
								
									<div class="form-group">
										
										<div class="col-lg-12">
											<div align="center"><font style="font-size:25px;">¿Requiere factura?</font></div>
											<br><br><br><div align="center">
													
													<table>
														<tr>
															<td><button class="btn btn-primary dim btn-large-dim" type="button"  data-toggle="modal" data-target="#ModelDetalleFacturacion">SÍ</button></td>
															<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
															<td><button class="btn btn-danger dim btn-large-dim" type="button">NO</button></td>
														</tr>
											</div>	</table>
										</div>
										
										
									</div>
								
                                </fieldset>
								<!-- FINALIZA SELECCION FACTURA -->
								
								 <h1><i class="fa fa-credit-card"></i></h1>
								<!-- INICIA METODO DE PAGO -->
                                <fieldset>
                                    <!-- <h2>Account Information</h2> -->
                                    <div class="row">
										<div class="col-lg-6">
											<font style="font-size:25px;">Método de pago</font> <br>
											<br>
											<div class="form-group">
												
                                                <table class="table" id="tableMetodosDePago">
													<tr id="trMetodo_1">
														<td>
															<select id="" style="height:35px; font-size:15px;">
																<?=$rowsMetodosPago?>
															</select>
														</td>
														<td>
															<div>
																<input type="text" name="metodo_1" id="metodo_1" class="form-control" placeholder="$" onchange="recalculaRestaTotal(this);" /> 
															</div>
														</td>
														<td>
															<button class="btn btn-primary btn-xs" id="agregarMetodoPago" value="" placeholder="Metodo Pago" type="button" style="margin-top:5px;"><i class="fa fa-plus" onclick="agregaNuevoMetodoPago();"></i></button>
														</td>
													</tr>
												</table>
                                            </div>
											
											
										</div>
										<div class="col-lg-1">
										</div>
										<div class="col-lg-5">          <br><br><br>                                   
                                           
												<table class="table table-bordered" style="font-size:20px;">
													<tr>
														<td align="left">Total venta</td>
														<td>$ <?=$totalVenta?></td>
													</tr>
													<!--
													<tr> 
														<td align="right">IVA</td>
														<td>$ 800.12</td>
													</tr>
													-->
													<tr>
														<td align="left">
															<span style="color:red;" >Restan</span>
														</td>
														<td>
															<span style="color:red;" id="spanRestanVenta" >$ <?=$totalVenta?></span>
															<span style="display:none;" id="spanRestanVentaOriginal" ><?=$totalVenta?></span>
														</td>
													</tr>
												</table>
											
										</div>
                                        
                                    </div>

                                </fieldset>
								<!-- FINALIZA METODO DE PAGO -->
								
								<h1><i class="fa fa-th-list"></i></h1>
								<!-- INICIA RESUMEN DE COMPRA -->
                                <fieldset>
									<div class="col-lg-12" >
									<font style="font-size:25px;">Resumen de compra</font><br><br>
										<table class="table table-striped table-bordered">
											<tr>
												<th>SKU</th>
												<th>Modelo</th>
												<th>Cantidad</th>
												<th>Precio</th>
												<th>Subtotal</th>
											</tr>
											<?=$trProductos?>
										</table>
									<div>
									
									<div class="col-lg-8" >
										<i class="fa fa-check-square-o"></i> Envío a domicilio
										<div>
											Calle Luis Barrera, Fraccionamiento Ojo de Pato<br>
											Cuautitlan Izcalli, Estado de México, C.P. 58252<br>
											Telefono de contacto: 55 55 76 56 26<br>
											Fecha y hora de entrega: 21/dic/2016 4:00pm<br>
										</div>
										<br>
										<i class="fa fa-check-square-o"></i> Requiere Factura
										<div>
											<b>Luis Mario Rodriguez</b><br>
											<b>LMRO098765AG7</b><br>
											Calle Luis Barrera, Fraccionamiento Ojo de Pato<br>
											Cuautitlan Izcalli, Estado de México, C.P. 58252<br>
											lmrodriguez@gmail.com<br>
										</div>
									</div>
									<div class="col-lg-4" >
										<table class="table table-striped table-bordered">
										<!--	<tr>
												<td>Subtotal</td>
												<td>$ 4,500</td>												
											</tr>
											<tr>
												<td>IVA</td>
												<td>$ 800</td>												
											</tr> 
											<tr>
												<td>Descuento</td>
												<td>$ 500</td>												
											</tr> -->
											<tr>
												<td>TOTAL</td>
												<td>$ <?=$totalVenta?></td>												
											</tr>
										</table>
									</div>
                                </fieldset>
								<!-- FINALIZA RESUMEN DE COMPRA -->
                            </form>
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

<!-- ini modals -->


<div class="modal inmodal fade" id="modalBuscaCliente" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Detalle de Envio</h4>
			</div>
			<div class="modal-body">
				<div class="form-group"><input type="text" placeholder="Nombre, email, numero telefonico" class="form-control" id="inputBuscaCliente" name="inputBuscaCliente" ></div>
				<div class="form-group" id="divBuscaClienteEnvio" ></div>
				<div class="form-group" id="divDireciconesClienteEnvio" ></div>
				<div class="form-group"><div style="display: inline; width: 150px">selecciona zona de envío</div>
										<select class="form-control" id="flete" style="display: inline; width: 200px">
											<option value="0">Elige sección</option>
											<option value="1">seccion 1</option>
											<option value="2">seccion 2</option>
											<option value="3">seccion 3</option>
											<option value="4">seccion 4</option>
										</select>
										<input type="text" id="costoFlete" class="form-control" style="display: inline; width: 150px">
										</div>
				<div class="form-group">
										<select class="form-control" id="planta">
											<option value="0">Selecciona número de pisos</option>
											<option value="1">Planta Baja</option>
											<option value="2">Piso 1</option>
											<option value="3">Piso 2</option>
											<option value="4">Piso 3</option>
											<option value="4">Piso 4</option>
											<option value="4">Piso 5</option>
											<option value="4">Piso 6</option>
											<option value="4">Piso 7</option>
											<option value="4">Piso 8</option>
											<option value="4">Piso 9</option>
											<option value="4">Piso 10</option>
											<option value="4">Mas de 10</option>
										</select></div>
										
										<div class="form-group">
										<select class="form-control" id="planta">
											<option value="0">Selecione donde se entregará la mercancia</option>
											<option value="1">Al interior de la vivienda</option>										
											<option value="1">A pie de puerta</option>
											<option value="2">Require traslado a pie</option>
											
										</select></div>
										
			</div>
			<div class="modal-footer">
				<button data-toggle="modal" href="#ModalClienteNuevo"  type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalNuevoCliente">+ Nuevo Cliente</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary">Guardar datos de envío</button>
			</div>
		</div>
	</div>
</div>

<div class="modal inmodal fade" id="ModelDetalleFacturacion" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Detalle de Facturación</h4>
			</div>
			<div class="modal-body">
				<div class="form-group"><input type="text" placeholder="Nombre, email, numero telefonico" class="form-control" id="inputBuscaCliente" name="inputBuscaCliente" ></div>
				<div class="form-group" id="divBuscaClienteFacturacion" ></div>
				<div class="form-group" id="divDireciconesClienteFacturacion" ></div>										
			</div>
			<div class="modal-footer">
				<button data-toggle="modal" href="#ModalClienteNuevo"  type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalNuevoCliente">+ Nuevo Cliente</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary">Guardar datos de facturación</button>
			</div>
		</div>
	</div>
</div>
								
<div class="modal inmodal fade" id="modalNuevoCliente" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Nuevo Cliente</h4>
			</div>
			<div class="modal-body">
				<p>
				<div class="wrapper wrapper-content animated fadeInRight">
					<form method="get" class="form-horizontal" action="/" id="form_cliente">
						<div class="form-group"><label class="col-sm-2 control-label">Nombre</label>
						<div class="col-sm-6" ><input type="text" class="form-control" id="nombre" name="nombre"></div>
						</div>
						<div class="form-group"><label class="col-sm-2 control-label">Apellido Paterno</label>
						<div class="col-sm-6" ><input type="text" class="form-control" id="apellidoP" name="apellidoP"></div>
						</div>
						<div class="form-group"><label class="col-sm-2 control-label">Apellido Materno</label>
						<div class="col-sm-6" ><input type="text" class="form-control" id="apellidoM" name="apellidoM"></div>
						</div>
						<div class="form-group"><label class="col-sm-2 control-label">Raz&oacute;n Social</label>
						<div class="col-sm-6"><input type="text" class="form-control" id="razonS" name="razonS"></div>
						</div>
						<div class="form-group"><label class="col-sm-2 control-label">RFC</label>
						<div class="col-sm-6"><input type="text" class="form-control" id="rfc" name="rfc"></div>
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
						<select id="estado" name="estado" class="form-control">
						<option value="">Seleccione un Estado</option>
						</select>
						</div>
						</div>
						<div class="form-group"><label class="col-sm-2 control-label">Municipio</label>
						<div class="col-sm-6"><input type="text" class="form-control" id="municipio" name="municipio"></div>
						</div>
						<div class="form-group">
						<label class="col-sm-2 control-label">Telefono</label>
						<div class="col-sm-3 "><input class="form-control telefono_cliente" id="telefono" name="telefono[]" value="" type="text" onkeypress="return validateNumber(event)"></div>
						<div class="col-md-2">
										<select id="phoneType" name="phoneType[]" class="form-control">
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
						<!--
						<button class="btn btn-danger btn-xs" id="cancelar" type="button">Cancelar</button>&nbsp;&nbsp;&nbsp;&nbsp;
						<button class="btn btn-primary btn-xs" id="guardar" type="button">Guardar Cliente</button>
						-->
						</div>
						</div>
					
					</form>
				</div>
				</p>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary">Guardar y Ligar Cliente</button>
			</div>
		</div>
	</div>
</div>

<!-- fin modals -->
    <!-- Mainly scripts -->
    <script src="<?=$raizProy?>js/jquery-2.1.1.js"></script>
    <script src="<?=$raizProy?>js/bootstrap.min.js"></script>
    <script src="<?=$raizProy?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?=$raizProy?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?=$raizProy?>js/inspinia.js"></script>
    <script src="<?=$raizProy?>js/plugins/pace/pace.min.js"></script>

    <!-- Steps -->
    <script src="<?=$raizProy?>js/plugins/staps/jquery.steps.min.js"></script>

    <!-- Jquery Validate -->
    <script src="<?=$raizProy?>js/plugins/validate/jquery.validate.min.js"></script>
	<script src="<?=$raizProy?>js/plugins/chosen/chosen.jquery.js"></script>
	<script src="<?=$raizProy?>js/plugins/easy-autocomplete/jquery.easy-autocomplete.min.js"></script>



    <script>
	
	
        $(document).ready(function(){
			
			$("#wizard").steps();
			$("#metodosPago").chosen();
		
			
            $("#form").steps({
                bodyTag: "fieldset",
				labels: {
					cancel: "Cancelar",
					finish: "Finalizar",
					next: "Siguiente",
					previous: "Anterior"
				},
                onStepChanging: function (event, currentIndex, newIndex)
                {
					if(newIndex == 1){
						$("#sel_metodo_pago_01").chosen();
					}
                    // Always allow going backward even if the current step contains invalid fields!
                    if (currentIndex > newIndex)
                    {
                        return true;
                    }

                    // Forbid suppressing "Warning" step if the user is to young
                    if (newIndex === 3 && Number($("#age").val()) < 18)
                    {
                        return false;
                    }

                    var form = $(this);

                    // Clean up if user went backward before
                    if (currentIndex < newIndex)
                    {
                        // To remove error styles
                        $(".body:eq(" + newIndex + ") label.error", form).remove();
                        $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                    }

                    // Disable validation on fields that are disabled or hidden.
                    form.validate().settings.ignore = ":disabled,:hidden";

                    // Start validation; Prevent going forward if false
                    return form.valid();
                },
                onStepChanged: function (event, currentIndex, priorIndex)
                {
					setTimeout(function(){
						$("#metodosPago").chosen();
						$('#metodosPago').trigger("chosen:updated");
						
					}, 2000);
					//alert(currentIndex);
                    // Suppress (skip) "Warning" step if the user is old enough.
					/*
                    if (currentIndex === 2 && Number($("#age").val()) >= 18)
                    {
                        $(this).steps("next");
                    }
*/
                    // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                    if (currentIndex === 2 && priorIndex === 3)
                    {
                       // $(this).steps("previous");
                    }
                },
                onFinishing: function (event, currentIndex)
                {
                    var form = $(this);

                    // Disable validation on fields that are disabled.
                    // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                    form.validate().settings.ignore = ":disabled";

                    // Start validation; Prevent form submission if false
                    return form.valid();
                },
                onFinished: function (event, currentIndex)
                {
                    var form = $(this);

                    // Submit form input
                    form.submit();
                }
            }).validate({
                        errorPlacement: function (error, element)
                        {
                            element.before(error);
                        },
                        rules: {
                            confirm: {
                                equalTo: "#password"
                            }
                        }
                    });
					
					
					
			
			
			
			/*FUNCIONES PARA CLIENTE NUEVO*/
			$( "#guardar" ).click(function(){
				var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
				if($("#nombre").val()=='')
				{
					toastr.error('Debe de agregar un Nombre');
					$("#nombre").val('');
					$("#nombre").focus();		
				}
				else if($("#apellidoP").val()=='')
				{
					toastr.error('Debe de agregar un Apellido Paterno');
					$("#apellidoP").val('');
					$("#apellidoP").focus();		
				}
				else if($("#apellidoM").val()=='')
				{
					toastr.error('Debe de agregar un Apellido Materno');
					$("#apellidoM").val('');
					$("#apellidoM").focus();		
				}
				else if($("#telefono").val()=='')
				{
					toastr.error('Debe de agregar un Telefono');
					$("#telefono").val('');
					$("#telefono").focus();
				}
				else if(!email_regex.test($("#email").val()))
				{
					toastr.error('Debe de agregar un E-mail valido');
					$("#email").val('');
					$("#email").focus();
				}
				else
				{
					var url="/clientes/guardar_cliente.php";
					 
					$.ajax(
					{
						type: "POST",
						url: url,
						data: $("#form_cliente").serialize(), // serializes the form's elements.
						success: function(data)
						{
							alert("El Cliente ha sido registrado y vinculado a esta compra"); // show response from the php script.
						}
					});

					
				}
			});
			
			
			
			
			$.getJSON("/clientes/states_json.php",function(result)
			{
				$.each(result, function(i, field)
				{
					$("#estado").append('<option value="'+field.id_estado+'" >'+field.estado+'</option>');
				});
			});

			$("#agregarTelefono").click(function(){
				$("#newPhone").append('<div class="form-group"><label class="col-sm-3 control-label"></label><div class="col-sm-4 "><input class="form-control" id="telefono" name="telefono[]" value="" type="text"></div><div class="col-md-3">                                <select id="phoneType" name="phoneType[]" class="form-control"><option value="1">Celular</option><option value="2">Casa</option>                                    <option value="3">Oficina</option><option value="4">Otro</option>                                </select></div><div class="col-md-1"><button class="btn btn-danger btn-xs deletePhone" id="agregarTelefono" value="" placeholder="Telefono" type="button"><i class="fa fa-times"></i></button></div></div>');

				$(".deletePhone").click(function(){            
					$(this).parent().parent().remove();
				});
			 });
			/*FUNCIONES PARA CLIENTE NUEVO*/
			
			$("#flete").change(function(){
				console.log("llega" + $(this).val());
				if($(this).val()=='1'){
					$("#costoFlete").val('666');
				}
				if($(this).val()=='2'){
					$("#costoFlete").val('777');
				}
				if($(this).val()=='3'){
					$("#costoFlete").val('888');
				}
				if($(this).val()=='4'){
					$("#costoFlete").val('999');
				}
				
			});
			
			
			
			
			//FUNCIONES PARA BUSQUEDA DE CLIENTE
    
		var options={
				url: "/clientes/get_clients_search.php",
				getValue: function(element){
					var name=element.nombre+' '+element.emails+' '+element.numbers;			
					return name;
				},
				template: {
					type: "custom",
					method: function(value, item) {
						return value;
					}
				},
				list:{
					match:{
						enabled: true
					},
			showAnimation:{
						type: "fade", //normal|slide|fade
						time: 400,
						callback: function() {}
					},
					hideAnimation: {
						type: "slide", //normal|slide|fade
						time: 400,
						callback: function() {}
			},
			onChooseEvent:function(){
						var id=$("#inputBuscaCliente").getSelectedItemData().id_cliente;						
						var name=$("#inputBuscaCliente").getSelectedItemData().nombre;
						var email=$("#inputBuscaCliente").getSelectedItemData().emails;
						var number=$("#inputBuscaCliente").getSelectedItemData().numbers;
						
						var url="/clientes/ajax_get_cliente_direcciones.php";
						
						SelectedItemData(id, name, email, number);
						
						$.ajax({
							type: "POST",
							url: url,
							data: { cliente_id:id }, // serializes the form's elements.
							success: function(data)
							{
								$('#divDireciconesClienteEnvio').html('');
								$('#divDireciconesClienteFacturacion').html('');
								
								dataJson = JSON.parse(data);
								newDivBtnsEnvio = '';
								newDivBtnsFact = '';
								
								newDivsEnvio = '';
								newDivsFact = '';
								
								jQuery.each(dataJson, function(i, val) {
									
									//separar botones de divs
									if(val.cliente_direccion_tipo_id == 1 || val.cliente_direccion_tipo_id == 3){
										newDivBtnsEnvio+= '<button type="button" class="btn btn-success" data-toggle="collapse" data-target="#demo_'+val.cliente_direccion_id+'">'+val.cliente_direccion_calle+' '+val.cliente_direccion_numero_ext+'...</button> ';
										newDivsEnvio+= '<div id="demo_'+val.cliente_direccion_id+'" class="collapse">'+val.cliente_direccion_calle+' '+val.cliente_direccion_numero_ext+' '+val.cliente_direccion_numero_int+' '+val.cliente_direccion_colonia+' '+val.cliente_direccion_municipio+' C.P. '+val.cliente_direccion_cp+' <a href="javascript:void(0)" onclick="asociaDireccionEnvio('+val.cliente_direccion_id+');">elegir</a></div>';
									}
									if(val.cliente_direccion_tipo_id == 2 || val.cliente_direccion_tipo_id == 3){
										newDivBtnsFact+= '<button type="button" class="btn btn-success" data-toggle="collapse" data-target="#demo_'+val.cliente_direccion_id+'">'+val.cliente_direccion_calle+' '+val.cliente_direccion_numero_ext+'...</button> ';
										newDivsFact+= '<div id="demo_'+val.cliente_direccion_id+'" class="collapse">'+val.cliente_direccion_calle+' '+val.cliente_direccion_numero_ext+' '+val.cliente_direccion_numero_int+' '+val.cliente_direccion_colonia+' '+val.cliente_direccion_municipio+' C.P. '+val.cliente_direccion_cp+' <a href="javascript:void(0)" onclick="asociaDireccionFact('+val.cliente_direccion_id+');">elegir</a></div>';
									}
									
								});
								
								newDivBtnsEnvio+= '<button type="button" class="btn btn-success" >+ Nueva direccion envío</button> ';
								newDivBtnsFact+= '<button type="button" class="btn btn-success" >+ Nueva direccion facturación</button> ';
								
								$('#divDireciconesClienteEnvio').append(newDivBtnsEnvio+"<br><br>");
								$('#divDireciconesClienteEnvio').append(newDivsEnvio);
								
								$('#divDireciconesClienteFacturacion').append(newDivBtnsFact+"<br><br>");
								$('#divDireciconesClienteFacturacion').append(newDivsFact);
							}
						});
						
			}
				}
		};
		
		var options_0={
				url: "/clientes/get_clients_search.php",
				getValue: function(element){
					var name=element.nombre+' '+element.emails+' '+element.numbers;			
					return name;
				},
				template: {
					type: "custom",
					method: function(value, item) {
						return value;
					}
				},
				list:{
					match:{
						enabled: true
					},
			showAnimation:{
						type: "fade", //normal|slide|fade
						time: 400,
						callback: function() {}
					},
					hideAnimation: {
						type: "slide", //normal|slide|fade
						time: 400,
						callback: function() {}
			},
			onChooseEvent:function(){
						var id=$("#inputBuscaCliente_0").getSelectedItemData().id_cliente;						
						var name=$("#inputBuscaCliente_0").getSelectedItemData().nombre;
						var email=$("#inputBuscaCliente_0").getSelectedItemData().emails;
						var number=$("#inputBuscaCliente_0").getSelectedItemData().numbers;
						
						var url="/clientes/ajax_get_cliente_direcciones.php";
						
						SelectedItemData_0(id, name, email, number);
						
						$.ajax({
							type: "POST",
							url: url,
							data: { cliente_id:id }, // serializes the form's elements.
							success: function(data)
							{
								$('#divDireciconesClienteEnvio').html('');
								$('#divDireciconesClienteFacturacion').html('');
								
								dataJson = JSON.parse(data);
								newDivBtnsEnvio = '';
								newDivBtnsFact = '';
								
								newDivsEnvio = '';
								newDivsFact = '';
								
								jQuery.each(dataJson, function(i, val) {
									
									//separar botones de divs
									if(val.cliente_direccion_tipo_id == 1 || val.cliente_direccion_tipo_id == 3){
										newDivBtnsEnvio+= '<button type="button" class="btn btn-success" data-toggle="collapse" data-target="#demo_'+val.cliente_direccion_id+'">'+val.cliente_direccion_calle+' '+val.cliente_direccion_numero_ext+'...</button> ';
										newDivsEnvio+= '<div id="demo_'+val.cliente_direccion_id+'" class="collapse">'+val.cliente_direccion_calle+' '+val.cliente_direccion_numero_ext+' '+val.cliente_direccion_numero_int+' '+val.cliente_direccion_colonia+' '+val.cliente_direccion_municipio+' C.P. '+val.cliente_direccion_cp+' <a href="javascript:void(0)" onclick="asociaDireccionEnvio('+val.cliente_direccion_id+');">elegir</a></div>';
									}
									if(val.cliente_direccion_tipo_id == 2 || val.cliente_direccion_tipo_id == 3){
										newDivBtnsFact+= '<button type="button" class="btn btn-success" data-toggle="collapse" data-target="#demo_'+val.cliente_direccion_id+'">'+val.cliente_direccion_calle+' '+val.cliente_direccion_numero_ext+'...</button> ';
										newDivsFact+= '<div id="demo_'+val.cliente_direccion_id+'" class="collapse">'+val.cliente_direccion_calle+' '+val.cliente_direccion_numero_ext+' '+val.cliente_direccion_numero_int+' '+val.cliente_direccion_colonia+' '+val.cliente_direccion_municipio+' C.P. '+val.cliente_direccion_cp+' <a href="javascript:void(0)" onclick="asociaDireccionFact('+val.cliente_direccion_id+');">elegir</a></div>';
									}
									
								});
								
								newDivBtnsEnvio+= '<button type="button" class="btn btn-success" >+ Nueva direccion envío</button> ';
								newDivBtnsFact+= '<button type="button" class="btn btn-success" >+ Nueva direccion facturación</button> ';
								
								$('#divDireciconesClienteEnvio').append(newDivBtnsEnvio+"<br><br>");
								$('#divDireciconesClienteEnvio').append(newDivsEnvio);
								
								$('#divDireciconesClienteFacturacion').append(newDivBtnsFact+"<br><br>");
								$('#divDireciconesClienteFacturacion').append(newDivsFact);
							}
						});
						
						
			}
				}
		};

		var SelectedItemData=function(id,name,email,number)
		{
			var table='<table ><tbody>';

			var cliente=$("#cliente_"+id).val();
			
			if(cliente==undefined)
			{
							urlImage = '';
							
							table +='   <tr id="row_'+id+'"> '+
											'<td class="desc" style="padding-right:50px;">'+
												'<h3><a href="#" class="text-navy">'+name+'</a></h3>'+
											'</td>'+
											'<td style="padding-right:50px;"><h3>'+email+'<h3></td>'+									
											'<td style="padding-right:50px;"><h3>'+number+'</h3></td>'+
											'<td><h3><i class="fa fa-trash removeCart" role="button" id="removeCliente_'+id+'" onclick="removeCliente('+id+');"></i></h3></td>'+
											'</tr></tbody></table>';
											
				$('#divBuscaClienteEnvio_0').html(table);
				$('#divBuscaClienteEnvio').html(table);
				$('#divBuscaClienteFacturacion').html(table);
				
				$("#inputBuscaCliente").focus(); // foco a input
				$("#inputBuscaCliente").val(''); // reset a input
				//$("#product_list").fadeIn();
							
							//saveClienteEnVenta(id, sku, name, 1, price,urlImage);
			}
			else
			{
				$("#inputBuscaCliente").focus();
				$("#inputBuscaCliente").val('');
				alert("El cliente ya ha sido ligado");
			}
		}
		
		var SelectedItemData_0=function(id,name,email,number)
		{
			var table='<table ><tbody>';

			var cliente=$("#cliente_"+id).val();
			
			if(cliente==undefined)
			{
							urlImage = '';
							
							table +='   <tr id="row_'+id+'"> '+
											'<td class="desc" style="padding-right:50px;">'+
												'<h3><a href="#" class="text-navy">'+name+'</a></h3>'+
											'</td>'+
											'<td style="padding-right:50px;"><h3>'+email+'<h3></td>'+									
											'<td style="padding-right:50px;"><h3>'+number+'</h3></td>'+
											'<td><h3><i class="fa fa-trash removeCart" role="button" id="removeCliente_'+id+'" onclick="removeCliente('+id+');"></i></h3></td>'+
											'</tr></tbody></table>';					
		
				$('#divBuscaCliente_0').html(table);
				$('#divBuscaClienteEnvio').html(table);
				$('#divBuscaClienteFacturacion').html(table);
		
				$("#inputBuscaCliente_0").focus();
				$("#inputBuscaCliente_0").val('');
				//$("#product_list").fadeIn();
							
							//saveClienteEnVenta(id, sku, name, 1, price,urlImage);
			}
			else
			{
				$("#inputBuscaCliente_0").focus();
				$("#inputBuscaCliente_0").val('');
				alert("El cliente ya ha sido ligado");
			}
		}

		$("#inputBuscaCliente").easyAutocomplete(options);		
		$("#inputBuscaCliente_0").easyAutocomplete(options_0);
			
       });
	   
	   function asociaDireccionEnvio(cliente_direccion_id){
		   var url="/clientes/ajax_asocia_direccion_envio.php";
					 
			$.ajax({
				type: "POST",
				url: url,
				data: {cliente_direccion_id: cliente_direccion_id}, // serializes the form's elements.
				success: function(data)
				{
					alert("Sweet Alert");
				}
			});
	   }
	   
	   function asociaDireccionFact(cliente_direccion_id){
		   var url="/clientes/ajax_asocia_direccion_fact.php";
					 
			$.ajax({
				type: "POST",
				url: url,
				data: {cliente_direccion_id: cliente_direccion_id}, // serializes the form's elements.
				success: function(data)
				{
					alert("Sweet Alert"); // show response from the php script.
				}
			});
	   }
	   
	   function removeCliente(cliente_id){
			$('#divBuscaCliente_0').html('');
			$('#divBuscaClienteEnvio').html('');
			$('#divBuscaClienteFacturacion').html('');
			$('#divDireciconesClienteEnvio').html('');
			$('#divDireciconesClienteFacturacion').html('');
	   }
	   
	   function agregaNuevoMetodoPago(){
			nuevoMetodoDePago = '<tr id="">';
			nuevoMetodoDePago+= '	<td>';
			nuevoMetodoDePago+= '		<select id="" style="height:35px; font-size:15px;">';
			nuevoMetodoDePago+= '			<?=$rowsMetodosPago?>';
			nuevoMetodoDePago+= '		</select>';
			nuevoMetodoDePago+= '	</td>';
			nuevoMetodoDePago+= '	<td>';
			nuevoMetodoDePago+= '		<div>';
			nuevoMetodoDePago+= '			<input type="text" name="metodo_01" class="form-control" placeholder="$" /> ';
			nuevoMetodoDePago+= '		</div>';
			nuevoMetodoDePago+= '	</td>';
			nuevoMetodoDePago+= '	<td>';
			nuevoMetodoDePago+= '		<button class="btn btn-danger btn-xs" id="agregarMetodoPago" value="" placeholder="Metodo Pago" type="button" style="margin-top:5px;"><i class="fa fa-minus" onclick="remueveNuevoMetodoPago();"></i></button>';
			nuevoMetodoDePago+= '	</td>';
			nuevoMetodoDePago+= '</tr>';
		   $('#tableMetodosDePago').append(nuevoMetodoDePago);
	   }
	   
	   function remueveNuevoMetodoPago(){
		   
	   }
	   
	   function recalculaRestaTotal(objTxt){
		   numMetodoPago =  Number(objTxt.value);
		   numNuevoRestan = $('#spanRestanVentaOriginal').html();
		   numNuevoRestan = Number(numNuevoRestan);
		   numNuevoRestan = numNuevoRestan - numMetodoPago;
		   //$('#spanRestanVentaOriginal').html(numNuevoRestan);
		   $('#spanRestanVenta').html('$ '+numNuevoRestan);
		   
	   }
    </script>

</body>

</html>
