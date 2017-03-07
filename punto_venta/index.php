<?php
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'config.php';
require_once $pathProy.'/header2.php';
require_once $pathProy.'/menu.php';
?>   
<link href="<?=$raizProy?>css/plugins/iCheck/custom.css" rel="stylesheet">
<link href="<?=$raizProy?>css/plugins/steps/jquery.steps.css" rel="stylesheet">
<link href="<?=$raizProy?>css/plugins/chosen/chosen.css" rel="stylesheet">

<style>
.wizard > .content > .body  position: relative; 
.wizard > .content { min-height: 350px; overflow: scroll;}
.wizard-big.wizard > .content { min-height: 350px; overflow: scroll; }
.wizard > .steps > ul > li { width: 10% !important; }


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
								<h1><i class="fa fa-credit-card"></i></h1>
								<!-- INICIA METODO DE PAGO -->
                                <fieldset>
                                    <!-- <h2>Account Information</h2> -->
                                    <div class="row">
										<div class="col-lg-4">
											<font style="font-size:30px;">MÉTODO DE PAGO</font>
											<br>
											<div class="form-group">
												
                                                <table class="table">
													<tr>
														<td>
															<select data-placeholder="Selecciona un material" class="chosen-select" id="sel_metodo_pago_01" style="width:100px;"> 
																<option>efectivo</option>
																<option>tarjeta</option>
															</select>
														</td>
														<td>
															<input type="text" name="metodo_01" class="form-control " placeholder="$" />
														</td>
													</tr>
													
												</table>
                                            </div>
											
											
										</div>
										
										<div class="col-lg-4" align="center">  <br><br><br>                                   
                                            <div class="form-group">
											<div style=""> <button type="button" class="btn btn-info" > <b>+ Agregar método de pago</b> </button> </div>
											<br>
											
                                               
												
												
                                            </div>
                                        </div>
										
										<div class="col-lg-4">          <br><br><br>                                   
                                           
												<table class="table table-striped table-bordered" style="font-size:25px;">
													<tr>
														<td align="left">
															Total venta
														</td>
														<td>
															$ 8,123.00
														</td>
													</tr>
													<!--
													<tr>
														<td align="right">
															IVA
														</td>
														<td>
															$ 800.12
														</td>
													</tr>
													-->
													
													<tr>
														<td align="left">
															<span style="color:red;" >Restan</span>
														</td>
														<td>
															<span style="color:red;" >$ 700.12</span>
														</td>
													</tr>
												</table>
											
										</div>
                                        
                                    </div>

                                </fieldset>
								<!-- FINALIZA METODO DE PAGO -->
							
                                <h1><i class="fa fa-credit-card"></i></h1>
								<!-- INICIA METODO DE PAGO -->
                                <fieldset>
                                    <!-- <h2>Account Information</h2> -->
                                    <div class="row">
										<div class="col-lg-4">
											<font style="font-size:30px;">MÉTODO DE PAGO</font>
											<br>
											<div class="form-group">
												
                                                <table class="table">
													<tr>
														<td>
															<select data-placeholder="Selecciona un material" class="chosen-select" id="sel_metodo_pago_01" style="width:100px;"> 
																<option>efectivo</option>
																<option>tarjeta</option>
															</select>
														</td>
														<td>
															<input type="text" name="metodo_01" class="form-control " placeholder="$" />
														</td>
													</tr>
													
												</table>
                                            </div>
											
											
										</div>
										
										<div class="col-lg-4" align="center">  <br><br><br>                                   
                                            <div class="form-group">
											<div style=""> <button type="button" class="btn btn-info" > <b>+ Agregar método de pago</b> </button> </div>
											<br>
											
                                               
												
												
                                            </div>
                                        </div>
										
										<div class="col-lg-4">          <br><br><br>                                   
                                           
												<table class="table table-striped table-bordered" style="font-size:25px;">
													<tr>
														<td align="left">
															Total venta
														</td>
														<td>
															$ 8,123.00
														</td>
													</tr>
													<!--
													<tr>
														<td align="right">
															IVA
														</td>
														<td>
															$ 800.12
														</td>
													</tr>
													-->
													
													<tr>
														<td align="left">
															<span style="color:red;" >Restan</span>
														</td>
														<td>
															<span style="color:red;" >$ 700.12</span>
														</td>
													</tr>
												</table>
											
										</div>
                                        
                                    </div>

                                </fieldset>
								<!-- FINALIZA METODO DE PAGO -->
								
                                <h1><i class="fa fa-truck"></i></h1>
								<!-- INICIA SELECCION ENVIO -->
                                <fieldset>
                                   
									<div class="form-group">
										
										<div class="col-lg-12">
											<div align="center"><font style="font-size:30px;">¿ENVÍO A DOMICILIO?</font></div>
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
											<div align="center"><font style="font-size:30px;">¿REQUIERE FACTURA?</font></div>
											<br><br><br><div align="center">
													
													<table>
														<tr>
															<td><button class="btn btn-primary dim btn-large-dim" type="button"  data-toggle="modal" data-target="#modalBuscaCliente">SÍ</button></td>
															<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
															<td><button class="btn btn-danger dim btn-large-dim" type="button">NO</button></td>
														</tr>
											</div>	</table>
										</div>
										
										
									</div>
								
                                </fieldset>
								<!-- FINALIZA SELECCION FACTURA -->
								
								<h1><i class="fa fa-th-list"></i></h1>
								<!-- INICIA RESUMEN DE COMPRA -->
                                <fieldset>
									<div class="col-lg-12" >
										<table class="table table-striped table-bordered">
											<tr>
												<td>SKU</td>
												<td>Modelo</td>
												<td>Cantidad</td>
												<td>Precio</td>
												<td>Subtotal</td>
											</tr>
											<tr>
												<td>xxxxx</td>
												<td>Recamara Italia</td>
												<td>1</td>
												<td>$ 2,500</td>
												<td>$ 2,500</td>
											</tr>
											<tr>
												<td>xxxxx</td>
												<td>Comedor Rustico</td>
												<td>2</td>
												<td>$ 1,500</td>
												<td>$ 3,000</td>
											</tr>
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
											<tr>
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
											</tr>
											<tr>
												<td>TOTAL</td>
												<td>$ 4,000</td>												
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
				<h4 class="modal-title">Buscar cliente</h4>
			</div>
			<div class="modal-body">
				<div class="form-group"><input type="email" placeholder="Nombre, email, numero telefonico" class="form-control"></div>
			</div>
			<div class="modal-footer">
				<button data-toggle="modal" href="#ModalClienteNuevo"  type="button" class="btn btn-warning"  data-toggle="modal" data-target="#modalNuevoCliente">+ Nuevo Cliente</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary">Ligar Cliente</button>
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



    <script>
	
	
        $(document).ready(function(){
            $("#wizard").steps();
			
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
					
			$("#sel_metodo_pago_01").chosen();
			$("#sel_metodo_pago_02").chosen();
			$("#sel_metodo_pago_03").chosen();
			
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
       });
    </script>

</body>

</html>
