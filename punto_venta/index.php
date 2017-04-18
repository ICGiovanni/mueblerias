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

$totalEnvio = 0;
if( isset($_SESSION["punto_venta"]["envio"]) ){
	$totalEnvio = $_SESSION["punto_venta"]["envio"]["costo_envio"];
}
//print_r($_SESSION);
$clientFromSession = '';
$clientFromSessionForEnvio = '';
$clientFromSessionExtra = '';
$clientAddressFactFromSession = '';
$clientAddressShipFromSession = '';
if(isset($_SESSION["punto_venta"]["cliente"])){
	
	
	if(isset($_SESSION["punto_venta"]["cliente"]["direcciones"])){
	
		$newBotonesEnvio = '<b>Direcciones de envío del cliente:</b><br>';
		$newDivsEnvio = '';
		$dirsEnvioIni = '';
		$dirsFacturacionIni = '';
	
		$newDivBtnsFact = '';
		$newDivsFact = '';
		while ( list($keyD, $valueD) = each($_SESSION["punto_venta"]["cliente"]["direcciones"]) ){
			if( $valueD["cliente_direccion_tipo_id"] == "2" || $valueD["cliente_direccion_tipo_id"] == "3" ){
				$newBotonesEnvio.= '<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo_'.$valueD["cliente_direccion_id"].'">'.$valueD["cliente_direccion_calle"].' '.$valueD["cliente_direccion_numero_ext"].'...</button> ';
				
				$cssRowDireccion = 'class="direccionSinSeleccion"';
				$cssBtnElegir = 'mostrarElemento';
				$cssIcoElegir = 'ocultarElemento';
				if(isset($_SESSION["punto_venta"]["cliente"]["cliente_direccion_id_envio"]) && ($valueD["cliente_direccion_id"] == $_SESSION["punto_venta"]["cliente"]["cliente_direccion_id_envio"]) ){
					$cssRowDireccion = ' class="direccionSeleccionada"';
					$cssBtnElegir = 'ocultarElemento';
					$cssIcoElegir = 'mostrarElemento';
				}
				$newDivsEnvio.= '<div id="demo_'.$valueD["cliente_direccion_id"].'" class="collapse"><font id="demo_font_'.$valueD["cliente_direccion_id"].'" '.$cssRowDireccion.'>'.$valueD["cliente_direccion_calle"].' '.$valueD["cliente_direccion_numero_ext"].' '.$valueD["cliente_direccion_numero_int"].' '.$valueD["cliente_direccion_colonia"].' '.$valueD["cliente_direccion_municipio"].', '.$valueD['estado'].'. C.P. '.$valueD["cliente_direccion_cp"].'</font> &nbsp;&nbsp;&nbsp;<i id="demo_ico_'.$valueD["cliente_direccion_id"].'" class="fa fa-check-square '.$cssIcoElegir.'" style="color:green;"></i><button type="button" class="btn btn-warning btn-xs '.$cssBtnElegir.'" onclick="asociaDireccionEnvio('.$valueD["cliente_direccion_id"].');" style="margin:4px 0px;" id="demo_btn_'.$valueD["cliente_direccion_id"].'"> Elegir </button> </div>';
				
				$dirsEnvioIni.= '<i class="fa fa-map-marker"></i> '.$valueD["cliente_direccion_calle"].' '.$valueD["cliente_direccion_numero_ext"].' '.$valueD["cliente_direccion_numero_int"].' '.$valueD["cliente_direccion_colonia"].' '.$valueD["cliente_direccion_municipio"].', '.$valueD['estado'].'. C.P. '.$valueD["cliente_direccion_cp"].'<br>';
				
			}
			
			if( $valueD["cliente_direccion_tipo_id"] == "1" || $valueD["cliente_direccion_tipo_id"] == "3" ){
				$newDivBtnsFact.= '<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo_'.$valueD["cliente_direccion_id"].'">'.$valueD["cliente_direccion_calle"].' '.$valueD["cliente_direccion_numero_ext"].'...</button> ';
				
				$cssRowDireccion = 'class="direccionSinSeleccion"';
				$cssBtnElegir = 'mostrarElemento';
				$cssIcoElegir = 'ocultarElemento';
				if(isset($_SESSION["punto_venta"]["cliente"]["cliente_direccion_id_fact"]) && ($valueD["cliente_direccion_id"] == $_SESSION["punto_venta"]["cliente"]["cliente_direccion_id_envio"]) ){
					$cssRowDireccion = ' class="direccionSeleccionada"';
					$cssBtnElegir = 'ocultarElemento';
					$cssIcoElegir = 'mostrarElemento';
				}
				$newDivsFact.= '<div id="demo_'.$valueD["cliente_direccion_id"].'" class="collapse"><font id="demo_font_'.$valueD["cliente_direccion_id"].'" '.$cssRowDireccion.'>'.$valueD["cliente_direccion_calle"].' '.$valueD["cliente_direccion_numero_ext"].' '.$valueD["cliente_direccion_numero_int"].' '.$valueD["cliente_direccion_colonia"].' '.$valueD["cliente_direccion_municipio"].', '.$valueD['estado'].'. C.P. '.$valueD["cliente_direccion_cp"].'</font> &nbsp;&nbsp;&nbsp;<i id="demo_ico_'.$valueD["cliente_direccion_id"].'" class="fa fa-check-square '.$cssIcoElegir.'" style="color:green;"></i><button type="button" class="btn btn-warning btn-xs '.$cssBtnElegir.'" onclick="asociaDireccionFact('.$valueD["cliente_direccion_id"].');" style="margin:4px 0px;" id="demo_btn_'.$valueD["cliente_direccion_id"].'"> Elegir </button> </div>';

				$dirsFacturacionIni.= '<i class="fa fa-file-text-o"></i> '.$valueD["cliente_direccion_calle"].' '.$valueD["cliente_direccion_numero_ext"].' '.$valueD["cliente_direccion_numero_int"].' '.$valueD["cliente_direccion_colonia"].' '.$valueD["cliente_direccion_municipio"].', '.$valueD['estado'].'. C.P. '.$valueD["cliente_direccion_cp"].'<br>';
			}
			
		}
		$newBotonesEnvio.= '<button type="button" class="btn btn-success" >+ Nueva direccion envío</button> ';
		$newDivBtnsFact.= '<button type="button" class="btn btn-success" >+ Nueva direccion facturación</button> ';
		
		$clientAddressShipFromSession = $newBotonesEnvio."<br><br>".$newDivsEnvio;
		$clientAddressFactFromSession = $newDivBtnsFact."<br><br>".$newDivsFact;
	}
	
	$clientFromSessionForEnvio ='<button style="position:relative; float:right;" type="button" class="btn btn-xs btn-danger" id="removeCliente_'.$_SESSION["punto_venta"]["cliente"]["cliente_id"].'" onclick="removeCliente('.$_SESSION["punto_venta"]["cliente"]["cliente_id"].');">Desasociar cliente</button>
	<table class=""><tbody>
			<tr>
				<td>
					<b>Nombre Completo:</b>
				</td>
			</tr>
			<tr id="row_'.$_SESSION["punto_venta"]["cliente"]["cliente_id"].'">
				<td class="desc" style="padding-left:10px;">
					'.$_SESSION["punto_venta"]["cliente"]["name"].' &nbsp;&nbsp;<br><br>
				</td>
				<td></td>
			</tr></tbody>
	</table>';
	
	
	$clientFromSession = '
	<button style="position:relative; float:right;" type="button" class="btn btn-xs btn-danger" id="removeCliente_'.$_SESSION["punto_venta"]["cliente"]["cliente_id"].'" onclick="removeCliente('.$_SESSION["punto_venta"]["cliente"]["cliente_id"].');">Desasociar cliente</button>
	<table class=""><tbody>
			<tr>
				<td>
					<b>Nombre Completo:</b>
				</td>
			</tr>
			<tr id="row_'.$_SESSION["punto_venta"]["cliente"]["cliente_id"].'">
				<td class="desc" style="padding-left:10px;">
					'.$_SESSION["punto_venta"]["cliente"]["name"].' &nbsp;&nbsp;<br><br>
				</td>
				<td></td>
			</tr>
			<tr>
				<td><b>Direcciones de envío:</b></td>
			</tr>
			<tr>
				<td class="desc" style="padding-left:10px;">
					'.$dirsEnvioIni.'<br>
				</td>
			</tr>
			<tr>
				<td><b>Direcciones de facturación:</b></td>
			</tr>
			<tr>
				<td class="desc" style="padding-left:10px;">
					'.$dirsFacturacionIni.'
				</td>
			</tr>
			</tbody></table>';
			
		$clientFromSessionExtra	= '<b>Telefonos:</b><br>
		'.str_replace(",","<br>",$_SESSION["punto_venta"]["cliente"]["number"]).'
		<br><br>
		<b>Correos:</b><br>'.str_replace(",","<br>",$_SESSION["punto_venta"]["cliente"]["email"]);
}


?> 
<link href="<?=$raizProy?>css/plugins/iCheck/custom.css" rel="stylesheet">
<link href="<?=$raizProy?>css/plugins/steps/jquery.steps.css" rel="stylesheet">
<link href="<?=$raizProy?>css/plugins/chosen/chosen.css" rel="stylesheet">
<link href="<?=$raizProy?>css/plugins/easy-autocomplete/easy-autocomplete.min.css" rel="stylesheet">
<link href="<?=$raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<link href="<?=$raizProy?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="<?=$raizProy?>css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
<style>
.wizard > .content > .body  position: relative; 
.wizard > .content { min-height: 350px; overflow: scroll;}
.wizard-big.wizard > .content { min-height: 350px; overflow: scroll; }
.wizard > .steps > ul > li { width: 20% !important; }
#inputBuscaCliente { width: 830px !important;}
.direccionSeleccionada{ font-size:14px; text-decoration: underline; }
.direccionSinSeleccion{ font-size:14px; }
.ocultarElemento{ visibility:hidden; }
.mostrarElemento{ visibility:visible; }
.greenFont { color:green; }
.redFont { color:red; }
.clockpicker-popover{
	z-index: 999999;
}

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
							
								<h1><i class="fa fa-user"></i> Datos</h1>
								<!-- INICIA DATOS DEL CLIENTE -->
                                <fieldset>
								
									<button style="float:right; position:relative;"  type="button" class="btn btn-sm btn-warning"  data-toggle="modal" data-target="#modalNuevoCliente"> <b>+ Nuevo Cliente</b> </button> 
								
                                    <h2>Datos del cliente</h2>
                                    <div class="row">
										<div class="col-lg-10">
											<div class="form-group">
												<font>Busqueda del cliente por:</font><br>
												<div style="margin-top: 4px;" class="form-group" id="divBuscaClienteInputPpal"><input type="text" placeholder="Nombre, email y/o número telefónico" class="form-control" id="inputBuscaCliente_0" name="inputBuscaCliente_0" ></div>
												
												
                                            </div>
										</div>
										
										<div class="col-lg-2">
										</div>
										
										<div class="col-lg-9">
											<div class="ibox"  >
												<div class="ibox-content" id="divBuscaCliente_0">
													<?=$clientFromSession?>
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="ibox"  >
												<div class="ibox-content" id="divBuscaCliente_extra_0">
													<?=$clientFromSessionExtra?>
												</div>
											</div>
										</div>
										
										
                                        
                                    </div>

                                </fieldset>
								<!-- FINALIZA DATOS DEL CLIENTE -->
							
                               
								
                                <h1><i class="fa fa-truck"></i> Envío</h1>
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
															<td><button class="btn btn-danger dim btn-large-dim" type="button" data-toggle="modal" data-target="#modalVentaSinEnvio" onclick="ventaSinEnvio();" >NO</button></td>
														</tr>
											</div>	</table>
										</div>
										
										
									</div>
								   
                                </fieldset>
								
								
							
								<!-- FINALIZA SELECCION ENVIO -->
								
                                <h1><i class="fa fa-dollar"></i> Factura</h1>
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
															<td><button class="btn btn-danger dim btn-large-dim" type="button" onclick="ventaSinFactura();">NO</button></td>
														</tr>
											</div>	</table>
										</div>
										
										
									</div>
								
                                </fieldset>
								<!-- FINALIZA SELECCION FACTURA -->
								
								 <h1><i class="fa fa-credit-card"></i> Pago</h1>
								<!-- INICIA METODO DE PAGO -->
                                <fieldset>
                                    <!-- <h2>Account Information</h2> -->
                                    <div class="row">
										<div class="col-lg-9">
											<div class="ibox">
												<div class="ibox-content">
													<h2>Método de pago</h2>
														
														<table class="table" id="tableMetodosDePago">
															<tr id="trMetodo_1">
																<td style="padding-top:15px;font-weight: bold;font-size: 14px;"> 1 </td>
																<td> 
																	<select id="sel_metodo_1" style="height:35px; font-size:15px;">
																		<?=$rowsMetodosPago?>
																	</select>
																</td>
																<td>
																	<div>
																		<input style="width:130px;" type="text" name="metodo_1" id="metodo_1" class="form-control" placeholder="$" onchange="recalculaRestaTotal();" /> 
																	</div>
																</td>
																<td>
																	<div>
																		 <input type="text" name="referencia_1" id="referencia_1" class="form-control" placeholder="Referencia/Terminación" /> 
																	</div>
																</td>
																<td>
																	<button class="btn btn-primary btn-xs" id="agregarMetodoPago" value="" placeholder="Metodo Pago" type="button" style="margin-top:5px;" onclick="agregaNuevoMetodoPago();"><i class="fa fa-plus"></i></button>
																</td>
															</tr>
														</table>
													
												</div>
											</div>
											
										</div>
										
										
										
										<div class="col-md-3">
											<div class="ibox">
												<div class="ibox-title">
													<h5>Resumen de Venta</h5>
												</div>
												<div class="ibox-content">
													                  
													<span>
														Sub-total
													</span>
													<h3 class="font-bold text-right">
														$ <?=$totalVenta?>            </h3>                    
													<span>
														Costo envío
													</span>
													<h3 class="font-bold text-right" id="costoEnvioEnPago"> $ <?=$totalEnvio?>  </h3>
													<span>
														Total
													</span>
													<h2 class="font-bold text-right" id="granTotalEnPago"> $ <?=($totalVenta+$totalEnvio)?>  </h2>
													<span>
														Restan
													</span>
													<h2 class="font-bold text-right">
														<span id="spanRestanVenta" >$ <?=($totalVenta+$totalEnvio)?></span>
														<span style="display:none;" id="spanRestanVentaOriginal" ><?=($totalVenta+$totalEnvio)?></span>                    </h2>
													<hr/>
													
												</div>
											</div>
										</div>
										
										
                                        
                                    </div>

                                </fieldset>
								<!-- FINALIZA METODO DE PAGO -->
								
								<h1><i class="fa fa-th-list"></i> Resumen</h1>
								<!-- INICIA RESUMEN DE COMPRA -->
                                <fieldset>
									<div class="col-lg-12" >
									<font style="font-size:25px;">Resumen de compra</font><br><br>
										<table class="table table-striped table-bordered">
											<tr>
												<th>SKU</th>
												<th>Modelo</th>
												<th>Cantidad</th>
												<th>Precio Uni</th>
												<th>Subtotal</th>
											</tr>
											<?=$trProductos?>
										</table>
									<div>
									
									<div class="col-lg-8" >
										<i id="icoResumenEnvio" class="fa fa-check-circle-o greenFont" style="font-size:20px;"></i> &nbsp;<font style="font-size:15px;"><b>Envío a domicilio</b></font>
										<div id="divInfoResumenEnvio">
										
											<!--Calle Luis Barrera, Fraccionamiento Ojo de Pato<br>
											Cuautitlan Izcalli, Estado de México, C.P. 58252<br>
											Telefono de contacto: 55 55 76 56 26<br>
											Fecha y hora de entrega: 21/dic/2016 4:00pm<br>-->
										</div>
										<br>
										<i id="icoResumenFactura" class="fa fa-check-circle-o greenFont" style="font-size:20px;"></i> &nbsp;<font style="font-size:15px;"><b>Requiere Factura</b></font>
										<div id="divInfoResumenFactura">
										
											<!--<b>Luis Mario Rodriguez</b><br>
											<b>LMRO098765AG7</b><br>
											Calle Luis Barrera, Fraccionamiento Ojo de Pato<br>
											Cuautitlan Izcalli, Estado de México, C.P. 58252<br>
											lmrodriguez@gmail.com<br>-->
										</div>
									</div>
									<div class="col-lg-4" style="padding-right: 0px;">
										<table class="table table-striped table-bordered">
										<!-- <tr>
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
												<td><b>Gran Total</b></td>
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
				<div class="form-group" id="divBuscaClienteInputEnvio"><input type="text" placeholder="Nombre, email y/o número telefónico" class="form-control" id="inputBuscaCliente" name="inputBuscaCliente" style="display:<?=($clientFromSessionForEnvio=='')?"block":"none"?>" ></div>
				<div class="form-group" id="divBuscaClienteEnvio" ><?=$clientFromSessionForEnvio?></div>
				<div class="form-group" id="divDireciconesClienteEnvio" ><?=$clientAddressShipFromSession?></div>
				
				<div class="ibox">
					<div class="ibox-title">
						<b>Datos extras de envío</b>
					</div>
					<div class="ibox-content">
						<div class="form-group">
						<div class="col-md-2" style="padding:7px 0px;">Zona de envío&nbsp;&nbsp;&nbsp;</div>
						<div class="col-md-4" style="width:31%">
										<select class="form-control" id="flete" style="display: inline; width: 200px">
											<option value="0">Elige sección</option>
											<option value="1">seccion 1</option>
											<option value="2">seccion 2</option>
											<option value="3">seccion 3</option>
											<option value="4">seccion 4</option>
										</select>
					</div>
					
							<input type="text" id="costoFlete" placeholder="Costo del Flete" class="form-control" style="display: inline; width: 150px" onchange="actualizaCostoEnvio();">
							&nbsp;&nbsp;&nbsp;<span id="spanCostoFlete"></span> 
					
							</div>
						<div class="form-group">
							<div class="col-md-2" style="padding:7px 0px;">
								Fecha/hora entrega
							</div>
							<div class="col-md-3">
								<div class="form-group" id="data_1" >
										<div class="input-group date">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" id="gasto_fecha_vencimiento" name="gasto_fecha_vencimiento" value="">
										</div>
								</div>
							</div>   
							<div class="col-md-2">
								<div class="input-group clockpicker" data-autoclose="true">
									<input name="gasto_hora_vencimiento" id ="gasto_hora_vencimiento" type="text" class="form-control" value="12:00" >
									<span class="input-group-addon">
										<span class="fa fa-clock-o"></span>
									</span>
								</div>
							</div>
							
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
				</div>
										
			</div>
			<div class="modal-footer">
				<!-- <button data-toggle="modal" href="#ModalClienteNuevo"  type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalNuevoCliente">+ Nuevo Cliente</button>-->
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary">Guardar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal inmodal fade" id="modalVentaSinEnvio" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Sin envío</h4>
			</div>
			<div class="modal-body">
						<h5>Motivo por el cual el cliente no quiere envio</h5>
						<div class="form-group">
							<select class="form-control" id="SelSinEnvio">
								<option value="0">Seleccione una opcion</option>
								<option value="1">Flete externo</option>
								<option value="2">El cliente se lo lleva</option>
							</select></div></div>
			<div class="modal-footer">
				<!-- <button data-toggle="modal" href="#ModalClienteNuevo"  type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalNuevoCliente">+ Nuevo Cliente</button>-->
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary">Guardar</button>
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
				<div class="form-group" id="divBuscaClienteInputFacturacion"><input type="text" placeholder="Nombre, email y/o número telefónico" class="form-control" id="inputBuscaCliente" name="inputBuscaCliente" ></div>
				<div class="form-group" id="divBuscaClienteFacturacion" ><?=$clientFromSession?></div>
				<div class="form-group" id="divDireciconesClienteFacturacion" ><?=$clientAddressFactFromSession?></div>										
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
	<script src="<?=$raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?=$raizProy?>js/inspinia.js"></script>
    <script src="<?=$raizProy?>js/plugins/pace/pace.min.js"></script>
	
	<script src="<?=$raizProy?>js/plugins/datapicker/bootstrap-datepicker.js"></script>
	<script src="<?=$raizProy?>js/plugins/datapicker/bootstrap-datepicker.es.js"></script>
	<script src="<?=$raizProy?>js/plugins/clockpicker/clockpicker.js"></script>

    <!-- Steps -->
    <script src="<?=$raizProy?>js/plugins/staps/jquery.steps.min.js"></script>

    <!-- Jquery Validate -->
    <script src="<?=$raizProy?>js/plugins/validate/jquery.validate.min.js"></script>
	<script src="<?=$raizProy?>js/plugins/chosen/chosen.jquery.js"></script>
	<script src="<?=$raizProy?>js/plugins/easy-autocomplete/jquery.easy-autocomplete.min.js"></script>
	<script src="<?=$raizProy?>js/plugins/toastr/toastr.min.js"></script>



    <script>
	
		currentClientDireccionIdEnvio = 0;
		currentClientDireccionIdFact = 0;
		
<?php
		if( isset($_SESSION["punto_venta"]["cliente"]["cliente_direccion_id_envio"]) ){
			echo "currentClientDireccionIdEnvio = ".$_SESSION["punto_venta"]["cliente"]["cliente_direccion_id_envio"]."; ";
		}
		if( isset($_SESSION["punto_venta"]["cliente"]["cliente_direccion_id_fact"]) ){
			echo "currentClientDireccionIdFact = ".$_SESSION["punto_venta"]["cliente"]["cliente_direccion_id_fact"]."; ";
		}
?>
		var globalDataClient = new Array();
	
        $(document).ready(function(){
			
			toastr.options={
			  "closeButton": true,
			  "debug": false,
			  "progressBar": true,
			  "preventDuplicates": false,
			  "positionClass": "toast-top-right",
			  "onclick": null,
			  "showDuration": "400",
			  "hideDuration": "1000",
			  "timeOut": "7000",
			  "extendedTimeOut": "1000",
			  "showEasing": "swing",
			  "hideEasing": "linear",
			  "showMethod": "fadeIn",
			  "hideMethod": "fadeOut"
			}
			
			$("#wizard").steps();
			$("#metodosPago").chosen();
			
			$.fn.datepicker.defaults.language = 'es';
			$('.clockpicker').clockpicker();
			
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
						//$("#sel_metodo_pago_01").chosen();
					}
                    // Always allow going backward even if the current step contains invalid fields!
                    if (currentIndex > newIndex)
                    {
                        return true;
                    }

                    // Forbid suppressing "Warning" step if the user is to young
                    if (newIndex === 4)
                    {
						envia_falso = false;
						maxObjIdTmp = 1;
					   //alert(maxObjId);
						while (maxObjIdTmp <= maxObjId) {
							newValueSel = $('#sel_metodo_'+maxObjIdTmp).val();
							
							if( newValueSel == "0" ){
								toastr.error("Debe elegir el metodo de pago #<b>"+maxObjIdTmp+"</b>");
								envia_falso = true;
							}
							
							if( newValueSel != "0" && newValueSel != "1" && newValueSel != "5" ){ // no requieren referencia 0 sin seleccion, 1 efectivo, 5 vales de despensa
								newValueRef = $('#referencia_'+maxObjIdTmp).val();
								if(newValueRef == ''){
									toastr.error("Debe ingresar una referencia para el metodo de pago #<b>"+maxObjIdTmp+"</b>");
									envia_falso = true;
									setTimeout(function(){
										$("#referencia_"+maxObjIdTmp).focus();
									}, 1);
								}
							}
							
							newValue = $('#metodo_'+maxObjIdTmp).val();
							if(newValue == ''){
								toastr.error("Debe ingresar el monto para el metodo de pago #<b>"+maxObjIdTmp+"</b>");
								envia_falso = true;
								setTimeout(function(){
									$("#metodo_"+maxObjIdTmp).focus();
								}, 1);
							}
							
							maxObjIdTmp++;
						}
						
						if( envia_falso ){
							return false;
						}
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
					$("#costoFlete").val('500');
					$("#spanCostoFlete").html("min $1 - max $500");
				}
				if($(this).val()=='2'){
					$("#costoFlete").val('1000');
					$("#spanCostoFlete").html("min $501 - max $1000");
				}
				if($(this).val()=='3'){
					$("#costoFlete").val('1500');
					$("#spanCostoFlete").html("min $1001 - max $1500");
				}
				if($(this).val()=='4'){
					$("#costoFlete").val('1501');
					$("#spanCostoFlete").html("$1501 más");
				}
				actualizaCostoEnvio();
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
						
						$("#divBuscaClienteInputEnvio").css("display","none");
						
						SelectedItemData(id, name, email, number);
						setClienteData(name, email, number);
						getClienteDirecciones(id);
						
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
						
						$("#divBuscaClienteInputEnvio").css("display","none");
						
						SelectedItemData_0(id, name, email, number);
						setClienteData(name, email, number);
						getClienteDirecciones(id);
						
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
											'<td class="" style="padding-right:50px;">'+
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
											'<td class="" style="padding-right:50px;">'+
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
					swal({
						title: "Guardado!",
						text: "Dirección de envío vinculada correctamente!",
						type: "success"
					}, function () {
						
					});
				}
			});
			
			//agregamos/quitamos clases para seleccion de direccion
			$("#demo_btn_"+cliente_direccion_id).removeClass("mostrarElemento");
			$("#demo_btn_"+cliente_direccion_id).addClass("ocultarElemento");
			
			$("#demo_ico_"+cliente_direccion_id).removeClass("ocultarElemento");
			$("#demo_ico_"+cliente_direccion_id).addClass("mostrarElemento");
			
			$("#demo_font_"+cliente_direccion_id).removeClass("direccionSinSeleccion");
			$("#demo_font_"+cliente_direccion_id).addClass("direccionSeleccionada");
			
			//agregamos/quitamos clases para deseleccion de direccion
			
			$("#demo_btn_"+currentClientDireccionIdEnvio).removeClass("ocultarElemento");
			$("#demo_btn_"+currentClientDireccionIdEnvio).addClass("mostrarElemento");
			
			$("#demo_ico_"+currentClientDireccionIdEnvio).removeClass("mostrarElemento");
			$("#demo_ico_"+currentClientDireccionIdEnvio).addClass("ocultarElemento");
			
			$("#demo_font_"+currentClientDireccionIdEnvio).removeClass("direccionSeleccionada");
			$("#demo_font_"+currentClientDireccionIdEnvio).addClass("direccionSinSeleccion");
			currentClientDireccionIdEnvio = cliente_direccion_id;
			
			/////
			
			txtDireccionEnvio = globalDataClient['id_'+currentClientDireccionIdEnvio]['cliente_direccion_calle']+" "+globalDataClient['id_'+currentClientDireccionIdEnvio]['cliente_direccion_numero_ext']+", "+globalDataClient['id_'+currentClientDireccionIdEnvio]['cliente_direccion_colonia']+"<br>";
			txtDireccionEnvio+= globalDataClient['id_'+currentClientDireccionIdEnvio]['cliente_direccion_municipio']+", "+globalDataClient['id_'+currentClientDireccionIdEnvio]['estado']+". C.P. "+globalDataClient['id_'+currentClientDireccionIdEnvio]['cliente_direccion_cp']+"<br>";
			txtDireccionEnvio+="Fecha y hora de entrega: 21/dic/2016 4:00pm<br>";
			
			$("#divInfoResumenEnvio").html(txtDireccionEnvio);
			
			
			
			/*Calle Luis Barrera, Fraccionamiento Ojo de Pato<br>
				Cuautitlan Izcalli, Estado de México, C.P. 58252<br>
				Telefono de contacto: 55 55 76 56 26<br>
				Fecha y hora de entrega: 21/dic/2016 4:00pm<br>*/
				
				
			
	   }
	   
	   function asociaDireccionFact(cliente_direccion_id){
		   var url="/clientes/ajax_asocia_direccion_fact.php";
					 
			$.ajax({
				type: "POST",
				url: url,
				data: {cliente_direccion_id: cliente_direccion_id}, // serializes the form's elements.
				success: function(data)
				{
					swal({
						title: "Guardado!",
						text: "Dirección de facturación vinculada correctamente!",
						type: "success"
					}, function () {
						
					});
				}
			});
	   }
	   
	   function removeCliente(cliente_id){
			$('#divBuscaCliente_0').html('');
			$('#divBuscaClienteEnvio').html('');
			$('#divBuscaClienteFacturacion').html('');
			$('#divDireciconesClienteEnvio').html('');
			$('#divDireciconesClienteFacturacion').html('');
			
			var url="/clientes/ajax_remove_cliente_session.php";
			$.ajax({
				type: "POST",
				url: url,
				data: {}, 
				success: function(data)
				{
					swal({
						title: "Desvilculado!",
						text: "Clinte desvinculado correctamente!",
						type: "success"
					}, function () {
						
					});
				}
			});
			$("#divBuscaClienteInputEnvio").css("display","block");
	   }
	   maxObjId = 1;
	   function agregaNuevoMetodoPago(){
			maxObjId++;
			nuevoMetodoDePago = '<tr id="trMetodo_'+maxObjId+'">';
			nuevoMetodoDePago+= '<td style="padding-top:15px;font-weight: bold;font-size: 14px;"> '+maxObjId+' </td>';
			nuevoMetodoDePago+= '	<td>';			
			nuevoMetodoDePago+= '		<select id="sel_metodo_'+maxObjId+'" style="height:35px; font-size:15px;">';
			nuevoMetodoDePago+= '			<?=$rowsMetodosPago?>';
			nuevoMetodoDePago+= '		</select>';
			nuevoMetodoDePago+= '	</td>';
			nuevoMetodoDePago+= '	<td>';
			nuevoMetodoDePago+= '		<div>';
			nuevoMetodoDePago+= '			<input style="width:130px;" type="text" name="metodo_'+maxObjId+'" id="metodo_'+maxObjId+'" class="form-control" placeholder="$" onchange="recalculaRestaTotal();" /> ';
			nuevoMetodoDePago+= '		</div>';
			nuevoMetodoDePago+= '	</td>';
			nuevoMetodoDePago+= '	<td>';
			nuevoMetodoDePago+= '		<div>';
			nuevoMetodoDePago+= '			<input type="text" name="referencia_'+maxObjId+'" id="referencia_'+maxObjId+'" class="form-control" placeholder="Referencia/Terminación" onchange="recalculaRestaTotal();" /> ';
			nuevoMetodoDePago+= '		</div>';
			nuevoMetodoDePago+= '	</td>';
			nuevoMetodoDePago+= '	<td>';
			nuevoMetodoDePago+= '		<button class="btn btn-danger btn-xs" id="botonMinus_'+maxObjId+'"  type="button" style="margin-top:5px;" onclick="remueveNuevoMetodoPago(this);"><i class="fa fa-minus"></i></button>';
			nuevoMetodoDePago+= '	</td>';
			nuevoMetodoDePago+= '</tr>';
			
			$('#tableMetodosDePago').append(nuevoMetodoDePago);
	   }
	   
	   function remueveNuevoMetodoPago(objIconMinus){
		  
		   trMetodoTxt = objIconMinus.id.replace("botonMinus_","trMetodo_");
		  // alert(trMetodoTxt);
		   
		   $('#'+trMetodoTxt).remove();
		   recalculaRestaTotal();
	   }
	   
	   function recalculaRestaTotal(){
		   
			maxObjIdTmp = 1;
			
		    numNuevoRestan = $('#spanRestanVentaOriginal').html();
			numNuevoRestan = Number(numNuevoRestan);
		   
			while (maxObjIdTmp <= maxObjId) {
				newValue = $('#metodo_'+maxObjIdTmp).val();
				//alert(newValue);
				if(typeof(newValue) != "undefined" && newValue!=''){
					newValue =  Number(newValue);
					//alert("restar "+newValue);
					numNuevoRestan = numNuevoRestan - newValue;
				}
				
				maxObjIdTmp++;
			}
		   
			$('#spanRestanVenta').html('$ '+numNuevoRestan);
	   }
	   
	   function getClienteDirecciones(id){
		   
		   var url="/clientes/ajax_get_cliente_direcciones.php";
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
						
						globalDataClient['id_'+val.cliente_direccion_id] = new Array();
						globalDataClient['id_'+val.cliente_direccion_id]['cliente_direccion_tipo_id'] = val.cliente_direccion_tipo_id;
						globalDataClient['id_'+val.cliente_direccion_id]['cliente_direccion_calle'] = val.cliente_direccion_calle;
						globalDataClient['id_'+val.cliente_direccion_id]['cliente_direccion_numero_ext'] = val.cliente_direccion_numero_ext;
						globalDataClient['id_'+val.cliente_direccion_id]['cliente_direccion_colonia'] = val.cliente_direccion_colonia;
						globalDataClient['id_'+val.cliente_direccion_id]['cliente_direccion_municipio'] = val.cliente_direccion_municipio;
						globalDataClient['id_'+val.cliente_direccion_id]['estado'] = val.estado;
						globalDataClient['id_'+val.cliente_direccion_id]['cliente_direccion_cp'] = val.cliente_direccion_cp;
						
						if( typeof(val.cliente_direccion_numero_int) != 'string'){
							val.cliente_direccion_numero_int = '';
						} 
						globalDataClient['id_'+val.cliente_direccion_id]['cliente_direccion_numero_int'] = val.cliente_direccion_numero_int;
						
						//separar botones de divs
						if(val.cliente_direccion_tipo_id == 1 || val.cliente_direccion_tipo_id == 3){
							newDivBtnsEnvio+= '<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo_'+val.cliente_direccion_id+'">'+val.cliente_direccion_calle+' '+val.cliente_direccion_numero_ext+'...</button> ';
							newDivsEnvio+= '<div id="demo_'+val.cliente_direccion_id+'" class="collapse" style="font-size:14px;">'+val.cliente_direccion_calle+' '+val.cliente_direccion_numero_ext+' '+val.cliente_direccion_numero_int+' '+val.cliente_direccion_colonia+' '+val.cliente_direccion_municipio+', '+globalDataClient['id_'+currentClientDireccionIdEnvio]['estado']+'. C.P. '+val.cliente_direccion_cp+' &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-warning btn-xs" onclick="asociaDireccionEnvio('+val.cliente_direccion_id+');" style="margin:4px 0px;"> Elegir</button></div>';
						}
						if(val.cliente_direccion_tipo_id == 2 || val.cliente_direccion_tipo_id == 3){
							newDivBtnsFact+= '<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo_'+val.cliente_direccion_id+'">'+val.cliente_direccion_calle+' '+val.cliente_direccion_numero_ext+'...</button> ';
							newDivsFact+= '<div id="demo_'+val.cliente_direccion_id+'" class="collapse" style="font-size:14px;">'+val.cliente_direccion_calle+' '+val.cliente_direccion_numero_ext+' '+val.cliente_direccion_numero_int+' '+val.cliente_direccion_colonia+' '+val.cliente_direccion_municipio+', '+globalDataClient['id_'+currentClientDireccionIdEnvio]['estado']+'. C.P. '+val.cliente_direccion_cp+' &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-warning btn-xs" onclick="asociaDireccionFact('+val.cliente_direccion_id+');" style="margin:4px 0px;"> Elegir</button></div>';
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
	   
	   function setClienteData(name, email, number){
		   
		   var url="/clientes/ajax_set_cliente_data.php";
			$.ajax({
				type: "POST",
				url: url,
				data: { name:name, email:email, number:number }, 
				success: function(data)
				{
					
				}
			});
	   }
	   
	   function ventaSinEnvio(){
			$("#icoResumenEnvio").removeClass("fa-check-circle-o");
			$("#icoResumenEnvio").addClass("fa-times-circle-o");
			
			$("#icoResumenEnvio").removeClass("greenFont");
			$("#icoResumenEnvio").addClass("redFont");
			
	   }
	   
	   function ventaSinFactura(){
			$("#icoResumenFactura").removeClass("fa-check-circle-o");
			$("#icoResumenFactura").addClass("fa-times-circle-o");
			
			$("#icoResumenFactura").removeClass("greenFont");
			$("#icoResumenFactura").addClass("redFont");
			
	   }
	   
	   $('#data_1 .input-group.date').datepicker({
	keyboardNavigation: false,
	forceParse: false,
	autoclose: true,
	language: 'es'
}).datepicker("setDate", "0");

subtotal = <?=$totalVenta?>;
function actualizaCostoEnvio(){
	
	costoActual = $("#costoFlete").val();	
	$("#costoEnvioEnPago").html("$ "+costoActual);
	granTotalActual = Number(costoActual) + Number(subtotal);
	$("#granTotalEnPago").html("$ "+granTotalActual);
	
}
    </script>

</body>

</html>
