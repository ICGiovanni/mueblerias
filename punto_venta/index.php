<?php
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'config.php';
require_once $pathProy.'/header2.php';
require_once $pathProy.'/menu.php';
?>

    

   
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/css/plugins/steps/jquery.steps.css" rel="stylesheet">
	<link href="/css/plugins/chosen/chosen.css" rel="stylesheet">


<style>
.wizard > .content > .body  position: relative; 
.wizard > .content { min-height: 350px; overflow: scroll;}
.wizard-big.wizard > .content { min-height: 350px; overflow: scroll; }

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
                                <h1>Método de Pago</h1>
								<!-- INICIA METODO DE PAGO -->
                                <fieldset>
                                    <!-- <h2>Account Information</h2> -->
                                    <div class="row">
										<div class="col-lg-4">
											
											<div class="form-group" style='height: 100px'>   
												<label>Opciones de compra</label><br />
												<input type="checkbox" name="envio" id="envio" /> Envío <br>
												<input type="checkbox" name="factura" id="factura" />Factura
											</div> 
											
											<div class="form-group">   
												<label>Agregar Cliente</label>
												<table class="table">
													<tr>
														<td><input id="busqueda_cliente" name="busqueda_cliente" type="text" class="form-control"> </td>
														<td></td>
													</tr>
												</table>                                                 
												<table class="table">
													<tr>
														<td><input id="busqueda_cliente" name="busqueda_cliente" type="text" class="form-control"> </td>
														<td></td>
													</tr>
												</table>
                                            </div>
										</div>
									
                                        <div class="col-lg-4">
                                            
                                            <div class="form-group">
                                                <label>Método de Pago </label>
												<div style="float: right; margin-right:10px;"> <button type="button" class="btn btn-info btn-xs" > <b>+</b> </button> </div>
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
										<div class="col-lg-4">                                            
                                            <div class="form-group">
											<label> Totales </label>
											
                                                <table class="table table-striped table-bordered">
													<tr>
														<td align="right">
															Subtotal
														</td>
														<td>
															$ 8,123.00
														</td>
													</tr>
													<tr>
														<td align="right">
															IVA
														</td>
														<td>
															$ 800.12
														</td>
													</tr>
													<tr>
														<td align="right">
															Total
														</td>
														<td>
															$ 10,921.12
														</td>
													</tr>
													<tr>
														<td align="right">
															<span style="color:red;" >Restan</span>
														</td>
														<td>
															<span style="color:red;" >$ 700.12</span>
														</td>
													</tr>
												</table>
												
												
                                            </div>
                                        </div>
                                        
                                    </div>

                                </fieldset>
								<!-- FINALIZA METODO DE PAGO -->
								
                                
								
                                <h1>Envío</h1>
								<!-- INICIA SELECCION ENVIO -->
                                <fieldset>
                                   
									<div class="form-group">
										
										<div class="col-lg-4">
										<div align="left"></div>
											<table class="table">
												<tr>
													<td><label>Calle: </label></td>
													<td><input type="text" name="calle" id="calle"></td>
												</tr>
												<tr>
													<td><label>Num Ext: </label></td>
													<td><input type="text" name="num_ext" id="num_ext"></td>
												</tr>
												<tr>
													<td><label>Num Int: </label></td>
													<td><input type="text" name="num_int" id="num_int"></td>
												</tr>
												<tr>
													<td><label>Colonia: </label></td>
													<td><input type="text" name="colonia" id="colonia"></td>
												</tr>
												<tr>
													<td><label>Delegacion: </label></td>
													<td><input type="text" name="delegacion" id="delegacion"></td>
												</tr>
												<tr>
													<td><label>Estado: </label></td>
													<td><select name="estado" id="estado"></select></td>
												</tr>
											</table>											
										</div>
										<div class="col-lg-5">
										<br>
											<table class="table">
												
												<tr>
													<td><label>Codigo Postal: </label></td>
													<td><input type="text" name="c_p" id="c_p"></td>
												</tr>
												<tr>
													<td><label>Quien Recibe: </label></td>
													<td><input type="text" name="quien_recibe" id="quien_recibe"></td>
												</tr>
												<tr>
													<td><label>Telefono Contacto: </label></td>
													<td><input type="text" name="telefono_contacto" id="telefono_contacto"></td>
												</tr>
												<tr>
													<td><label>Entre Calles y/o Referencia: </label></td>
													<td>
														<textarea name="calles_y_referencia" id="calles_y_referencia" rows="5"></textarea>
													</td>
												</tr>
											</table>
										</div>
										<div class="col-lg-3">
										<div align="right"><button type="button" class="btn btn-warning btn-xs" > Usar Dirección del Cliente </button></div>
											<table class="table">
												<tr>
													<td><label>Fecha de entrega: </label></td>													
												</tr>
												<tr>
													<td>
														<div class="form-group" id="data_rango_inicio" >
															<div class="input-group date">
																<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" id="filtro_fecha_inicio" name="filtro_fecha_inicio" value="">
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td><label>Hora de entrega: </label></td>
												</tr>
												<tr>
													<td>
														<div class="input-group clockpicker" data-autoclose="true">
															<input name="gasto_hora_vencimiento" id ="gasto_hora_vencimiento" type="text" class="form-control" value="12:00" >
															<span class="input-group-addon">
																<span class="fa fa-clock-o"></span>
															</span>
														</div>
													</td>
												</tr>
											</table>
										</div>
									</div>
								   
                                </fieldset>
								<!-- FINALIZA SELECCION ENVIO -->
								
                                <h1>Factura</h1>
								<!-- INICIA SELECCION FACTURA -->
                                <fieldset>
								<div class="row">
									<div class="col-lg-4">
										<div align="left"></div>
										
										<table class="table">
										<tr>
												<td><label>Razon Social: </label></td>
												<td><label id="razon_social" >Luis Mario Rodriguez</label></td>
											</tr>
											<tr>
												<td><label>RFC: </label></td>
												<td><label id="rfc" >LRM0234234RTT</label></td>
											</tr>
											<tr>
												<td><label>Calle: </label></td>
												<td><input type="text" name="calle" id="calle"></td>
											</tr>
											<tr>
												<td><label>Num Ext: </label></td>
												<td><input type="text" name="num_ext" id="num_ext"></td>
											</tr>
											<tr>
												<td><label>Num Int: </label></td>
												<td><input type="text" name="num_int" id="num_int"></td>
											</tr>
											<tr>
												<td><label>Colonia: </label></td>
												<td><input type="text" name="colonia" id="colonia"></td>
											</tr>
											
											
										</table>
									</div>
									<div class="col-lg-5">
									<br>
										<table class="table">
											<tr>
												<td><label>Delegacion: </label></td>
												<td><input type="text" name="delegacion" id="delegacion"></td>
											</tr>
											<tr>
												<td><label>Estado: </label></td>
												<td><select name="estado" id="estado"></select></td>
											</tr>
												<tr>
													<td><label>Codigo Postal: </label></td>
													<td><input type="text" name="c_p" id="c_p"></td>
												</tr>
												<tr>
													<td><label>Correo Electrónico: </label></td>
													<td><input type="text" name="email" id="email"></td>
												</tr>
											</table>
									</div>
									<div class="col-lg-2">
										<div align="left"><button type="button" class="btn btn-warning btn-xs" > Usar Dirección del Cliente </button></div>
										<br>
										<div class="text-center">
										
                                                <div style="">
                                                    <i class="fa fa-sign-in" style="font-size: 100px;color: #e5e5e5 "></i>
                                                </div>
                                            </div>
									</div>
								</div>
                                </fieldset>
								<!-- FINALIZA SELECCION FACTURA -->
								
								<h1>Resumen de Compra</h1>
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
<div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated flipInY">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Nuevo Cliente</h4>
			</div>
			<div class="modal-body">
				<form method="get" class="form-horizontal" action="/" id="form_cliente">
					<div class="form-group"><label class="col-sm-3 control-label">Nombre</label>
					<div class="col-sm-8" ><input type="text" class="form-control" id="nombre" name="nombre"></div>
					</div>
					<div class="form-group"><label class="col-sm-3 control-label">Apellido Paterno</label>
					<div class="col-sm-8" ><input type="text" class="form-control" id="apellidoP" name="apellidoP"></div>
					</div>
					<div class="form-group"><label class="col-sm-3 control-label">Apellido Materno</label>
					<div class="col-sm-8" ><input type="text" class="form-control" id="apellidoM" name="apellidoM"></div>
					</div>
					<div class="form-group"><label class="col-sm-3 control-label">Raz&oacute;n Social</label>
					<div class="col-sm-8"><input type="text" class="form-control" id="razonS" name="razonS"></div>
					</div>
					<div class="form-group"><label class="col-sm-3 control-label">RFC</label>
					<div class="col-sm-8"><input type="text" class="form-control" id="rfc" name="rfc"></div>
					</div>
					<div class="form-group"><label class="col-sm-3 control-label">Calle</label>
					<div class="col-sm-8"><input type="text" class="form-control" id="calle" name="calle"></div>
					</div>
					<div class="form-group">
					<label class="col-sm-3 control-label">No. Exterior</label>
					<div class="col-sm-3"><input type="text" class="form-control" id="noExt" name="noExt"></div>
					<label class="col-sm-2 control-label">No. Interior</label>
					<div class="col-sm-3"><input type="text" class="form-control" id="noInt" name="noInt"></div>
					</div>
					<div class="form-group"><label class="col-sm-3 control-label">Colonia</label>
					<div class="col-sm-8"><input type="text" class="form-control" id="colonia" name="colonia"></div>
					</div>
					<div class="form-group">
					<label class="col-sm-3 control-label">C.P.</label>
					<div class="col-sm-8"><input type="text" class="form-control" id="codigoPostal" name="codigoPostal"></div>
					</div>
					<div class="form-group"><label class="col-sm-3 control-label">Municipio</label>
					<div class="col-sm-8"><input type="text" class="form-control" id="municipio" name="municipio"></div>
					</div>
					<div class="form-group"><label class="col-sm-3 control-label">Estado</label>
					<div class="col-sm-8">
						<select id="estado" name="estado" class="form-control m-b">
							<option value="">Seleccione un Estado</option>
						</select>
					</div>
					</div>
					<div class="form-group">
					<label class="col-sm-3 control-label">Telefono</label>
					<div class="col-sm-4 "><input class="form-control" id="telefono" name="telefono[]" value="" type="text"></div>
					<div class="col-md-3">
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
					<div class="form-group"><label class="col-sm-3 control-label">E-mail</label>
					<div class="col-sm-8" id="divEmail"><input type="text" class="form-control" id="email" name="email"></div>
					</div>
					<div class="form-group"><label class="col-sm-3 control-label">E-mail Alterno</label>
						<div class="col-sm-8" id="divEmail"><input type="text" class="form-control" id="emailA" name="emailA"></div>
					</div>
					
				
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary btn-xs">Guardar Cliente y Vincular</button>
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
