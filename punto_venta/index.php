<?php
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/general/class.General.php');
require_once $pathProy.'/header2.php';
require_once $pathProy.'/menu.php';

$objGeneral = new General();
$arrayMetodosPago = $objGeneral->getMetodosPago();

$rowsMetodosPago = '<option value="0" style="color:#888;">Selecciona un método de pago</option> ';
while( list ($KeyMP, $valueMP) = each($arrayMetodosPago) ){
	$rowsMetodosPago.='<option value="'.$valueMP["general_forma_de_pago_id"].'">'.$valueMP["general_forma_de_pago_desc"].'</option> ';
}
$esApartado = false;
if(isset($_GET["apartado"]) && $_GET["apartado"]=="u48f6d1"){
	$esApartado = true;
	//echo "es apartado";
}
if(!isset($_SESSION["punto_venta"])){
	die("Debe agregar al menos un producto al carrito de compras");
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
if( isset($_SESSION["punto_venta"]["envio"]["costo_envio"]) ){
	$totalEnvio = $_SESSION["punto_venta"]["envio"]["costo_envio"];
}
//print_r($_SESSION);
$clientFromSessionDetailedData = '';
$clientFromSessionGeneralData = '';
$clientFromSessionExtra = '';
$clientAddressFactFromSession = '';
$clientAddressShipFromSession = '';
$cssEspacios = '&nbsp;';
if(isset($_SESSION["punto_venta"]["cliente"])){
	
	
	if(isset($_SESSION["punto_venta"]["cliente"]["direcciones"])){
	
		$newBotonesEnvio = '<b>Selecciona una dirección de envío:</b><br>';
		$newDivsEnvio = '';
		$dirsEnvioIni = '';
		$dirsFacturacionIni = '';
		
	
		$newDivBtnsFact = '<b>Selecciona una dirección de facturación:</b><br>';
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
				$newDivsEnvio.= '<div id="demo_'.$valueD["cliente_direccion_id"].'" class="collapse"><i class="fa fa-map-marker"></i> '.$cssEspacios.'<font id="demo_font_'.$valueD["cliente_direccion_id"].'" '.$cssRowDireccion.'>'.$valueD["cliente_direccion_calle"].' '.$valueD["cliente_direccion_numero_ext"].' '.$valueD["cliente_direccion_numero_int"].' '.$valueD["cliente_direccion_colonia"].' '.$valueD["cliente_direccion_municipio"].', '.$valueD['estado'].'. C.P. '.$valueD["cliente_direccion_cp"].'</font> &nbsp;&nbsp;&nbsp;<i id="demo_ico_'.$valueD["cliente_direccion_id"].'" class="fa fa-check-square '.$cssIcoElegir.'" style="color:green;"></i><button type="button" class="btn btn-warning btn-xs '.$cssBtnElegir.'" onclick="asociaDireccionEnvio('.$valueD["cliente_direccion_id"].');" style="margin:4px 0px;" id="demo_btn_'.$valueD["cliente_direccion_id"].'"> Elegir </button> </div>';
				
				$dirsEnvioIni.= '<i class="fa fa-map-marker"></i> '.$cssEspacios.$valueD["cliente_direccion_calle"].' '.$valueD["cliente_direccion_numero_ext"].' '.$valueD["cliente_direccion_numero_int"].' '.$valueD["cliente_direccion_colonia"].' '.$valueD["cliente_direccion_municipio"].', '.$valueD['estado'].'. C.P. '.$valueD["cliente_direccion_cp"].'<br>';
				
			}
			
			if( $valueD["cliente_direccion_tipo_id"] == "1" || $valueD["cliente_direccion_tipo_id"] == "3" ){
				$newDivBtnsFact.= '<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo_'.$valueD["cliente_direccion_id"].'">'.$valueD["cliente_direccion_calle"].' '.$valueD["cliente_direccion_numero_ext"].'...</button> ';
				
				$cssRowDireccion = ' class="direccionSinSeleccion"';
				$cssBtnElegir = 'mostrarElemento';
				$cssIcoElegir = 'ocultarElemento';
				if(isset($_SESSION["punto_venta"]["cliente"]["cliente_direccion_id_fact"]) && ($valueD["cliente_direccion_id"] == $_SESSION["punto_venta"]["cliente"]["cliente_direccion_id_fact"]) ){
					$cssRowDireccion = ' class="direccionSeleccionada"';
					$cssBtnElegir = 'ocultarElemento';
					$cssIcoElegir = 'mostrarElemento';
				}
				$newDivsFact.= '<div id="demo_'.$valueD["cliente_direccion_id"].'" class="collapse"><i class="fa fa-map-marker"></i> '.$cssEspacios.'<font id="demo_font_'.$valueD["cliente_direccion_id"].'" '.$cssRowDireccion.'>'.$valueD["cliente_direccion_calle"].' '.$valueD["cliente_direccion_numero_ext"].' '.$valueD["cliente_direccion_numero_int"].' '.$valueD["cliente_direccion_colonia"].' '.$valueD["cliente_direccion_municipio"].', '.$valueD['estado'].'. C.P. '.$valueD["cliente_direccion_cp"].'</font> &nbsp;&nbsp;&nbsp;<i id="demo_ico_'.$valueD["cliente_direccion_id"].'" class="fa fa-check-square '.$cssIcoElegir.'" style="color:green;"></i><button type="button" class="btn btn-warning btn-xs '.$cssBtnElegir.'" onclick="asociaDireccionFact('.$valueD["cliente_direccion_id"].');" style="margin:4px 0px;" id="demo_btn_'.$valueD["cliente_direccion_id"].'"> Elegir </button> </div>';

				$dirsFacturacionIni.= '<i class="fa fa-file-text-o"></i> '.$cssEspacios.$valueD["cliente_direccion_calle"].' '.$valueD["cliente_direccion_numero_ext"].' '.$valueD["cliente_direccion_numero_int"].' '.$valueD["cliente_direccion_colonia"].' '.$valueD["cliente_direccion_municipio"].', '.$valueD['estado'].'. C.P. '.$valueD["cliente_direccion_cp"].'<br>';
			}
			
		}
		$newBotonesEnvio.= '<button type="button" class="btn btn-success" >+ Nueva direccion envío</button> ';
		$newDivBtnsFact.= '<button type="button" class="btn btn-success" >+ Nueva direccion facturación</button> ';
		
		$clientAddressShipFromSession = $newBotonesEnvio."<br><br>".$newDivsEnvio;
		$clientAddressFactFromSession = $newDivBtnsFact."<br><br>".$newDivsFact;
	}
	
	$clientFromSessionGeneralData ='
	<button style="position:relative; float:right;" type="button" class="btn btn-xs btn-danger" id="removeCliente_'.$_SESSION["punto_venta"]["cliente"]["cliente_id"].'" onclick="removeCliente('.$_SESSION["punto_venta"]["cliente"]["cliente_id"].');">Desasociar cliente</button>
	<table class=""><tbody>
			<tr>
				<td>
					<b>Nombre Completo:</b>
				</td>
			</tr>
			<tr id="row_'.$_SESSION["punto_venta"]["cliente"]["cliente_id"].'">
				<td style="padding-left:10px;">
					<i class="fa fa-user"></i> '.$cssEspacios.$_SESSION["punto_venta"]["cliente"]["name"].' &nbsp;&nbsp;<br><br>
				</td>
				<td></td>
			</tr>
	</tbody></table>';
	
	
	$clientFromSessionDetailedData = $clientFromSessionGeneralData.'
	<table class=""><tbody>
			<tr>
				<td><b>Direcciones de envío:</b></td>
			</tr>
			<tr>
				<td style="padding-left:10px;">
					'.$dirsEnvioIni.'<br>
				</td>
			</tr>
			<tr>
				<td><b>Direcciones de facturación:</b></td>
			</tr>
			<tr>
				<td style="padding-left:10px;">
					'.$dirsFacturacionIni.'
				</td>
			</tr>
			</tbody></table>';
		
		$number_detail = explode(",",$_SESSION["punto_venta"]["cliente"]["number"]);
		//print_r($number_detail);
		$txtTelefonosTipo = '<table>';
		
		while ( list($keyND, $valueND) = each($number_detail) ){
			
			$number_detail_sep = explode("|",$valueND);
			//print_r($number_detail_sep);
			$classIcoPhone = '';
			$fontSizeIcoPhone = '15px;';
			$titleIcoPhone = '';
			if($number_detail_sep[0] == "1" || $number_detail_sep[0] == "5"){ //celular
				$classIcoPhone = 'fa fa-mobile';
				$fontSizeIcoPhone = '20px;';
				$titleIcoPhone = 'Celular';
			}
			if($number_detail_sep[0] == "2"){ //casa
				$classIcoPhone = 'fa fa-home';
				$fontSizeIcoPhone = '15px;';
				$titleIcoPhone = 'Casa';
				
			}
			if($number_detail_sep[0] == "3"){ //oficina
				$classIcoPhone = 'fa fa-hospital-o';
				$fontSizeIcoPhone = '15px;';
				$titleIcoPhone = 'Oficina';
			}
			if($number_detail_sep[0] == "4"){ //otro
				$classIcoPhone = 'fa phone';
				$fontSizeIcoPhone = '15px;';
				$titleIcoPhone = 'Otro';
			}
			$txtTelefonosTipo.='<tr><td align="center"><i class="'.$classIcoPhone.'" style="font-size:'.$fontSizeIcoPhone.'" title="'.$titleIcoPhone.'" ></i></td><td>&nbsp; '.$number_detail_sep[1].'</td></tr>';
		}
		
		$txtTelefonosTipo.= '</table>';
		$clientFromSessionExtra	= '<b>Teléfonos:</b><br>
		'.$txtTelefonosTipo.'
		<br><br>
		<b>Correos:</b><br><i class="fa fa-envelope-o"></i> '.$cssEspacios.str_replace(',','<br><i class="fa fa-envelope-o"></i> '.$cssEspacios,$_SESSION["punto_venta"]["cliente"]["email"]);
}

//INFORMACION ENVIO Y FACTURA
$txtDivInfoResumenEnvio = '';
$txtDivInfoResumenFact = '';

$cssIcoResumenEnvio = 'fa fa-question-circle';
$cssIcoResumenFact = 'fa fa-question-circle';

if(isset($_SESSION["punto_venta"]["envio"])){
	if($_SESSION["punto_venta"]["envio"]["cliente_direccion_id"] == "0"){ //eligio sin envio
		$cssIcoResumenEnvio = 'fa fa-times-circle-o redFont';
		$txtDivInfoResumenEnvio.= 'Sin envío';
	} else {
	
		$datosDireccion = array();
		reset($_SESSION["punto_venta"]["cliente"]["direcciones"]);
		while ( list($keyDirecciones, $valueDirecciones) = each( $_SESSION["punto_venta"]["cliente"]["direcciones"] )){
			if($valueDirecciones["cliente_direccion_id"] == $_SESSION["punto_venta"]["envio"]["cliente_direccion_id"]){
				$datosDireccion = $valueDirecciones;
			}
		}
		if(!empty($datosDireccion)){
			$cssIcoResumenEnvio = 'fa fa-check-square-o greenFont';
			$txtDivInfoResumenEnvio.= $datosDireccion["cliente_direccion_calle"]." ".$datosDireccion["cliente_direccion_numero_ext"]." ".$datosDireccion["cliente_direccion_numero_int"]."<br>";
			$txtDivInfoResumenEnvio.= $datosDireccion["cliente_direccion_colonia"]." ".$datosDireccion["cliente_direccion_municipio"].", ".$datosDireccion["estado"].". CP ".$datosDireccion["cliente_direccion_cp"]."<br>";
			$txtDivInfoResumenEnvio.= "Fecha de entrega: ".$_SESSION["punto_venta"]["envio"]["fecha_hora_entrega"]."<br>";
		}
		
	}
}

if(isset($_SESSION["punto_venta"]["facturacion"])){
	
	if($_SESSION["punto_venta"]["facturacion"]["cliente_direccion_id"] == "0"){ //eligio sin envio
		$cssIcoResumenFact = 'fa fa-times-circle-o redFont';
		$txtDivInfoResumenFact.= 'Sin factura';
	} else {
		
		$datosDireccion = array();
		reset($_SESSION["punto_venta"]["cliente"]["direcciones"]);
		while ( list($keyDirecciones, $valueDirecciones) = each( $_SESSION["punto_venta"]["cliente"]["direcciones"] )){
			if($valueDirecciones["cliente_direccion_id"] == $_SESSION["punto_venta"]["facturacion"]["cliente_direccion_id"]){
				$datosDireccion = $valueDirecciones;
			}
		}
		
		if(!empty($datosDireccion)){
			//print_r($datosDireccion);
			
			$cssIcoResumenFact = 'fa fa-check-square-o greenFont';
			$txtDivInfoResumenFact.= "Razón Social: ".$datosDireccion["cliente_direccion_razon_social"]."<br>";
			$txtDivInfoResumenFact.= "RFC: ".$datosDireccion["cliente_direccion_rfc"]."<br>";
			$txtDivInfoResumenFact.= $datosDireccion["cliente_direccion_calle"]." ".$datosDireccion["cliente_direccion_numero_ext"]." ".$datosDireccion["cliente_direccion_numero_int"]."<br>";
			$txtDivInfoResumenFact.= $datosDireccion["cliente_direccion_colonia"]." ".$datosDireccion["cliente_direccion_municipio"].", ".$datosDireccion["estado"].". CP ".$datosDireccion["cliente_direccion_cp"]."<br>";
			$txtDivInfoResumenFact.= "enviar factura a: ".$_SESSION["punto_venta"]["facturacion"]["select_correo_factura"]."<br>";
		}
	}
}
//INFORMACION ENVIO Y FACTURA FIN
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
<!--
#span_iva { display:none; }
#h4_iva { display:none; }
-->       
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
							
								<h1>&nbsp;&nbsp;<i class="fa fa-user"></i> Datos</h1>
								<!-- INICIA DATOS DEL CLIENTE -->
                                <fieldset>
								
									<button style="float:right; position:relative;"  type="button" class="btn btn-sm btn-warning"  data-toggle="modal" data-target="#modalNuevoCliente"> <b>+ Nuevo Cliente</b> </button> 
								
                                    <h2>Datos del cliente</h2>
                                    <div class="row">
										<div class="col-lg-10">
											<div class="form-group">
												<font>Busqueda del cliente por:</font><br>
												<div style="margin-top: 4px;" class="form-group" id="divBuscaClienteInputPpal"><input type="text" placeholder="Nombre, email y/o número telefónico" class="form-control" id="inputBuscaClienteFromDatos" name="inputBuscaClienteFromDatos" ></div>
												
												
                                            </div>
										</div>
										
										<div class="col-lg-2">
										</div>
										
										<div class="col-lg-9">
											<div class="ibox"  >
												<div class="ibox-content" id="divBuscaCliente_0">
													<?=$clientFromSessionDetailedData?>
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
							
                               
								
                                <h1>&nbsp;&nbsp;<i class="fa fa-truck"></i> Envío</h1>
								<!-- INICIA SELECCION ENVIO -->
                                <fieldset>
                                   
									<div class="row">
										<div class="col-lg-8">
										<div class="ibox-content">
											<div align="center"><font style="font-size:25px;">¿Requiere envío a domicilio?</font></div>
											<br><br><br>
											<div align="center">
													<table>
														<tr>
															<td><button class="btn btn-primary dim btn-large-dim" type="button" data-toggle="modal" data-target="#modalDetalleEnvio">SÍ</button></td>
															<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
															<td><button class="btn btn-danger dim btn-large-dim" type="button" data-toggle="modal" data-target="#modalVentaSinEnvio" onclick="ventaSinEnvio();" >NO</button></td>
														</tr>
												</table>
											</div>
										</div>
										</div>
										<div class="col-lg-4">
											<div class="ibox-content">
												<b><i class="fa fa-truck" style="font-size:20px;"></i> &nbsp;&nbsp;DATOS DE ENVÍO</b><br><br>
												<i id="icoResumenEnvio" class="<?=$cssIcoResumenEnvio?>" style="font-size:20px;"></i> &nbsp;<font style="font-size:15px;"><b>Envío a domicilio</b></font>
												<div id="divInfoResumenEnvioSelf">
													<?=$txtDivInfoResumenEnvio?>
												</div>
											</div>
										</div>
									</div>
								   
                                </fieldset>
								
								
							
								<!-- FINALIZA SELECCION ENVIO -->
								
                                <h1>&nbsp;&nbsp;<i class="fa fa-dollar"></i> Factura</h1>
								<!-- INICIA SELECCION FACTURA -->
                                <fieldset>
								
									<div class="form-group">
										
										<div class="col-lg-8">
										<div class="ibox-content">
											<div align="center"><font style="font-size:25px;">¿Requiere factura?</font></div>
											<br><br><br>
											<div align="center">
													<table>
														<tr>
															<td><button class="btn btn-primary dim btn-large-dim" type="button"  data-toggle="modal" data-target="#ModalDetalleFacturacion">SÍ</button></td>
															<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
															<td><button class="btn btn-danger dim btn-large-dim" type="button" onclick="ventaSinFactura();">NO</button></td>
														</tr>
													</table>
											</div>
										</div>
										</div>
										
										<div class="col-lg-4">
											<div class="ibox-content">
												<b><i class="fa fa-dollar" style="font-size:20px;"></i> &nbsp;&nbsp;DATOS DE FACTURACIÓN</b><br><br>
												<i id="icoResumenFactura" class="<?=$cssIcoResumenFact?>" style="font-size:20px;"></i> &nbsp;<font style="font-size:15px;"><b>Requiere Factura</b></font>
												<div id="divInfoResumenFacturaSelf">
													<?=$txtDivInfoResumenFact?>
												</div>
											</div>
										</div>
										
									</div>
								
                                </fieldset>
								<!-- FINALIZA SELECCION FACTURA -->
								
								 <h1>&nbsp;&nbsp;<i class="fa fa-credit-card"></i> Pago</h1>
								<!-- INICIA METODO DE PAGO -->
                                <fieldset>
                                    <!-- <h2>Account Information</h2> -->
                                    <div class="row">
										<div class="col-lg-9">
											<div class="ibox">
												<div class="ibox-content">
													<h2>Método de pago</h2>
														
														<table class="table" id="tableMetodosDePago">
														<?php
															$sumaDePagos = 0;
															$trCount = 1;
															$trsMetodosdePago = '';
															if( isset($_SESSION["punto_venta"]["pago"]) ){
																
																$pagosArray = json_decode($_SESSION["punto_venta"]["pago"],true);
																$pagosArray = $pagosArray["pagos"];
																while( list($keyP, $valueP) = each($pagosArray) ){
																	
																	reset($arrayMetodosPago);
																	$rowsMetodosPagoFromSession = '<option value="0" style="color:#888;">Selecciona un método de pago</option> ';
																	while( list ($KeyMP, $valueMP) = each($arrayMetodosPago) ){
																		$selected = '';
																		if($valueMP["general_forma_de_pago_id"] == $valueP["pago_metodo_id"]){
																			$selected = ' selected';
																		}
																		$rowsMetodosPagoFromSession.='<option value="'.$valueMP["general_forma_de_pago_id"].'"'.$selected.'>'.$valueMP["general_forma_de_pago_desc"].'</option> ';
																	}
																	
																	$trsMetodosdePago.= '<tr id="trMetodo_'.$trCount.'">
																<td style="padding-top:15px;font-weight: bold;font-size: 13px;"> '.$trCount.' </td>
																<td> 
																	<select id="sel_metodo_'.$trCount.'" style="height:35px; font-size:13px;">
																		'.$rowsMetodosPagoFromSession.'
																	</select>
																</td>
																<td>
																	<div>
																		<input style="width:130px; font-size:13px;" type="text" name="metodo_'.$trCount.'" id="metodo_'.$trCount.'" class="form-control" placeholder="$" onchange="recalculaRestaTotal();" value="'.$valueP["monto"].'" /> 
																	</div>
																</td>
																<td>
																	<div>
																		 <input type="text" name="referencia_'.$trCount.'" id="referencia_'.$trCount.'" class="form-control" style="font-size:13px;" placeholder="Referencia/Terminación" value="'.$valueP["referencia"].'" /> 
																	</div>
																</td>';
																
																	if($trCount == 1){
																		$trsMetodosdePago.= '<td>
																		<button class="btn btn-primary btn-xs" id="agregarMetodoPago" value="" type="button" style="margin-top:5px;" onclick="agregaNuevoMetodoPago();"><i class="fa fa-plus"></i></button>
																	</td>';
																	} else {
																		$trsMetodosdePago.= '<td>
																		<button class="btn btn-danger btn-xs" id="botonMinus_'.$trCount.'"  type="button" style="margin-top:5px;" onclick="remueveNuevoMetodoPago(this);"><i class="fa fa-minus"></i></button>
																	</td>';
																	}
																
																	$trsMetodosdePago.= '</tr>';
																	$trCount++;
																	$sumaDePagos+=$valueP["monto"];
																}
																 
															} else { 
																$trsMetodosdePago = '<tr id="trMetodo_1">
																	<td style="padding-top:15px;font-weight: bold;font-size: 13px;"> 1 </td>
																	<td> 
																		<select id="sel_metodo_1" style="height:35px; font-size:13px;">
																			<option value="0" style="color:#888;">Selecciona un método de pago</option> <option value="1">Efectivo</option> <option value="2">Cheque</option> <option value="3">Depósito</option> <option value="4">Tranferencia electrónica</option> <option value="5">Vales de despensa</option> <option value="6">Tarjeta de crédito</option> <option value="7">Tarjeta de débito</option> </select>
																	</td>
																	<td>
																		<div>
																			<input style="width:130px; font-size:13px;" type="text" name="metodo_1" id="metodo_1" class="form-control" placeholder="$" onchange="recalculaRestaTotal();" /> 
																		</div>
																	</td>
																	<td>
																		<div>
																			 <input type="text" name="referencia_1" id="referencia_1" class="form-control" style="font-size:13px;" placeholder="Referencia/Terminación" /> 
																		</div>
																	</td>
																	<td>
																		<button class="btn btn-primary btn-xs" id="agregarMetodoPago" value="" placeholder="Metodo Pago" type="button" style="margin-top:5px;" onclick="agregaNuevoMetodoPago();"><i class="fa fa-plus"></i></button>
																	</td>
																</tr>';
															}
															echo $trsMetodosdePago;
														?>
														
														
															
														</table>
													
												</div>
											</div>
											
										</div>
										
										<?php
											$ivaVenta = 0;
											if( isset( $_SESSION["punto_venta"]["facturacion"]["cliente_direccion_id"] ) && $_SESSION["punto_venta"]["facturacion"]["cliente_direccion_id"] !="0" ){
												$ivaVenta = ($totalVenta*.16);
											}
										?>
										
										<div class="col-md-3">
											<div class="ibox">
												<div class="ibox-title" style="border-style: none">
													<h5>Resumen de Venta</h5>
												</div>
												<div class="ibox-content">
													                  
													<span>
														Sub-total
													</span>
													<h4 class="font-bold text-right">
														$ <?=$totalVenta?>
													</h4>
													<span id="span_iva">
														IVA
													</span>
													<h4  id="h4_iva" class="font-bold text-right">
														$ <?=$ivaVenta?>  
													</h4> 
													<span>
														Envío
													</span>
													<h4 class="font-bold text-right" id="costoEnvioEnPago"> 
														$ <?=$totalEnvio?>
													</h4>
													<span>
														Gran Total
													</span>
													<h4 class="font-bold text-right" id="granTotalEnPago"> 
														$ <?=($totalVenta+$ivaVenta+$totalEnvio)?>
													</h4>
													<span>
														Restan
													</span>
													<h4 class="font-bold text-right">
														<span id="spanRestanVenta" >
														$ <?=($totalVenta+$ivaVenta+$totalEnvio-$sumaDePagos)?>													
														</span>                    
													</h4>
													
												</div>
											</div>
										</div>
										
										
                                        
                                    </div>

                                </fieldset>
								<!-- FINALIZA METODO DE PAGO -->
								
								<h1>&nbsp;&nbsp;<i class="fa fa-th-list"></i> Resumen</h1>
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
										<i id="icoResumenEnvio" class="<?=$cssIcoResumenEnvio?>" style="font-size:20px;"></i> &nbsp;<font style="font-size:15px;"><b>Envío a domicilio</b></font>
										<div id="divInfoResumenEnvio">
											<?=$txtDivInfoResumenEnvio?>
										</div>
										<br>
										<i id="icoResumenFactura" class="<?=$cssIcoResumenFact?>" style="font-size:20px;"></i> &nbsp;<font style="font-size:15px;"><b>Requiere Factura</b></font>
										<div id="divInfoResumenFactura">
											<?=$txtDivInfoResumenFact?>
										</div>
									</div>
									<div class="col-lg-4" style="padding-right: 0px; margin-top: 40px;">
										<table class="table table-striped table-bordered">
											<tr>
												<td align="right"><b>Sub-total</b></td>
												<td align="right">$ <?=$totalVenta?></td>												
											</tr>
											<tr>
												<td align="right"><b>IVA</b></td>
												<td align="right" id="td_iva">
												$ <?=$ivaVenta?>
												</td>												
											</tr>
											<tr>
												<td align="right"><b>Envío</b></td>
												<td align="right" id="costoEnvioEnResumen">$ <?=$totalEnvio?></td>												
											</tr>
											<tr>
												<td align="right"><b>Gran Total</b></td>
												<td align="right" id="granTotalEnResumen"><h2>$ <?=$totalVenta+$ivaVenta+$totalEnvio?></h2></td>												
											</tr>
										</table>
<?php
if($esApartado){
?>										
										<br>
										<table class="table table-striped table-bordered">
											<tr>
												<td align="right"><b>A cuenta</b></td>
												<td align="right">$ <?=$sumaDePagos?></td>												
											</tr>
											<tr>
												<td align="right"><b>Restan</b></td>
												<td align="right" id="td_iva">
													$ <?=($totalVenta+$ivaVenta+$totalEnvio-$sumaDePagos)?>
												</td>												
											</tr>
										</table>
<?php 
}
?>
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


<div class="modal inmodal fade" id="modalDetalleEnvio" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Detalle de Envio</h4>
			</div>
			<div class="modal-body">
				<div class="form-group" id="divBuscaClienteInputEnvio" style="display:<?=($clientFromSessionGeneralData=='')?"block":"none"?>"><input style="width:830px;" type="text" placeholder="Nombre, email y/o número telefónico" class="form-control" id="inputBuscaClienteFromEnvio" name="inputBuscaClienteFromEnvio" ></div>
				<div class="form-group" id="divBuscaClienteEnvio" ><?=$clientFromSessionGeneralData?></div>
				<div class="form-group" id="divDireciconesClienteEnvio" ><?=$clientAddressShipFromSession?></div>
				
				<div class="ibox">
					<div class="ibox-title">
						<b>Datos extras de envío</b>
					</div>
					<div class="ibox-content">
						<div class="form-group">
						<div class="col-md-2" style="padding:7px 0px;">Zona de envío&nbsp;&nbsp;&nbsp;</div>
						<div class="col-md-4" style="width:31%">
										<select class="form-control" id="select_zona_envio" style="display: inline; width: 200px">
											<option value="0">Elige sección</option>
											<option value="1">seccion 1</option>
											<option value="2">seccion 2</option>
											<option value="3">seccion 3</option>
											<option value="4">seccion 4</option>
										</select>
						</div>
					Costo del Flete &nbsp;&nbsp;&nbsp;
							<input type="text" id="costoEnvio" placeholder="" class="form-control" style="display: inline; width: 150px" onchange="actualizaResumenVenta();" value="<?=(isset($_SESSION["punto_venta"]["envio"]["costo_envio"]) && !empty($_SESSION["punto_venta"]["envio"]["costo_envio"]) )?$_SESSION["punto_venta"]["envio"]["costo_envio"]:"0"?>" >
							&nbsp;&nbsp;&nbsp;<span id="spancostoEnvio"></span> 
					
							</div>
						<div class="form-group">
							<div class="col-md-2" style="padding:7px 0px;">
								Fecha/hora entrega
							</div>
							<div class="col-md-3">
								<div class="form-group" id="data_1" >
										<div class="input-group date">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" id="pv_fecha_vencimiento" name="pv_fecha_vencimiento" value="">
										</div>
								</div>
							</div>   
							<div class="col-md-2">
								<div class="input-group clockpicker" data-autoclose="true">
									<input name="pv_hora_vencimiento" id ="pv_hora_vencimiento" type="text" class="form-control" value="12:00" >
									<span class="input-group-addon">
										<span class="fa fa-clock-o"></span>
									</span>
								</div>
							</div>
							
						</div>
						<div class="form-group">
										<select class="form-control" id="select_planta">
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
										<select class="form-control" id="select_planta_extra">
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
				<button type="button" class="btn btn-primary" onclick="guarda_datos_envio();">Guardar</button>
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
								<option value="0">Seleccione una opción</option>
								<option value="1">Flete externo</option>
								<option value="2">El cliente se lo lleva</option>
							</select></div></div>
			<div class="modal-footer">
				<!-- <button data-toggle="modal" href="#ModalClienteNuevo"  type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalNuevoCliente">+ Nuevo Cliente</button>-->
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary" onclick="guada_porque_no();">Guardar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal inmodal fade" id="ModalDetalleFacturacion" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Detalle de Facturación</h4>
			</div>
			<div class="modal-body">
				<div class="form-group" id="divBuscaClienteInputFacturacion" style="display:<?=($clientFromSessionGeneralData=='')?"block":"none"?>"><input style="width:830px;" type="text" placeholder="Nombre, email y/o número telefónico" class="form-control" id="inputBuscaClienteFromFact" name="inputBuscaClienteFromFact" ></div>
				
				<div class="form-group" id="divBuscaClienteFacturacion" ><?=$clientFromSessionGeneralData?></div>
				<div class="form-group" id="divDireciconesClienteFacturacion" ><?=$clientAddressFactFromSession?></div>
				
				<div class="ibox">
					<div class="ibox-title">
						<b>Datos extras de facturación</b>
					</div>
					<div class="ibox-content" style="height:100px;">
						<div class="col-md-5" style="padding:7px 0px;" >
							Correo electrónico al que se enviará la factura:
						</div>
						<?php 
							if( isset($_SESSION["punto_venta"]["cliente"]["email"]) ){
								$arrayMails = explode(",",$_SESSION["punto_venta"]["cliente"]["email"]);
								$optionsMail = '';
								while( list($keyMail, $valueMail) = each($arrayMails) ){
									$optionsMail.='<option value="'.$valueMail.'">'.$valueMail.'</option>'; 
								}
							}
						?>
						<div class="col-md-5" >
							<select class="form-control" id="correo_p_facturacion" name="correo_p_facturacion" ><option value="0">Elegir un correo electrónico</option><?=$optionsMail?></select>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary" onclick="guarda_datos_facturacion();">Guardar</button>
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
	
		var currentClientDireccionIdEnvio = 0;
		var currentClientDireccionIdFact = 0;
		var bandera_datos_completos_envio = false;
		var bandera_datos_completos_fact = false;
<?php
		if( isset($_SESSION["punto_venta"]["cliente"]["cliente_direccion_id_envio"]) ){
			echo "
		currentClientDireccionIdEnvio = ".$_SESSION["punto_venta"]["cliente"]["cliente_direccion_id_envio"]."; ";
		}
		if( isset($_SESSION["punto_venta"]["cliente"]["cliente_direccion_id_fact"]) ){
			echo "
		currentClientDireccionIdFact = ".$_SESSION["punto_venta"]["cliente"]["cliente_direccion_id_fact"]."; ";
		}
?>
		
		var globalDataClient = new Array();
<?php
		
		if( isset($_SESSION["punto_venta"]["cliente"]["direcciones"]) ){
			reset(($_SESSION["punto_venta"]["cliente"]["direcciones"]));
			
			//print_r($_SESSION["punto_venta"]["cliente"]["direcciones"]);
			
			foreach( $_SESSION["punto_venta"]["cliente"]["direcciones"] as $keyA=>$valueA ){
			
				echo "
		globalDataClient['id_".$valueA["cliente_direccion_id"]."'] = new Array();
		globalDataClient['id_".$valueA["cliente_direccion_id"]."']['cliente_direccion_tipo_id'] = '".$valueA["cliente_direccion_tipo_id"]."';
		globalDataClient['id_".$valueA["cliente_direccion_id"]."']['cliente_direccion_calle'] = '".str_replace("'","\'",$valueA["cliente_direccion_calle"])."';
		globalDataClient['id_".$valueA["cliente_direccion_id"]."']['cliente_direccion_numero_ext'] = '".$valueA["cliente_direccion_numero_ext"]."';
		globalDataClient['id_".$valueA["cliente_direccion_id"]."']['cliente_direccion_numero_int'] = '".$valueA["cliente_direccion_numero_int"]."';
		globalDataClient['id_".$valueA["cliente_direccion_id"]."']['cliente_direccion_colonia'] = '".str_replace("'","\'",$valueA["cliente_direccion_colonia"])."';
		globalDataClient['id_".$valueA["cliente_direccion_id"]."']['cliente_direccion_municipio'] = '".str_replace("'","\'",$valueA["cliente_direccion_municipio"])."';
		globalDataClient['id_".$valueA["cliente_direccion_id"]."']['estado'] = '".str_replace("'","\'",$valueA["estado"])."';
		globalDataClient['id_".$valueA["cliente_direccion_id"]."']['cliente_direccion_cp'] = '".$valueA["cliente_direccion_cp"]."';
		globalDataClient['id_".$valueA["cliente_direccion_id"]."']['cliente_direccion_rfc'] = '".$valueA["cliente_direccion_rfc"]."';
		globalDataClient['id_".$valueA["cliente_direccion_id"]."']['cliente_direccion_razon_social'] = '".$valueA["cliente_direccion_razon_social"]."';
		globalDataClient['id_".$valueA["cliente_direccion_id"]."']['cliente_direccion_entre_calles'] = '".$valueA["cliente_direccion_entre_calles"]."';
		";	
		
			}
		}
		
		if( isset ($_SESSION["punto_venta"]["pago"]) ){
			echo "var maxObjId = ".$trCount.";
			";
		} else {
			echo "var maxObjId = 2;
			";
		}
?>

		
		var subtotal = <?=$totalVenta?>;
<?php
		if( isset($_SESSION["punto_venta"]["envio"]["costo_envio"]) && !empty($_SESSION["punto_venta"]["envio"]["costo_envio"])){
			echo '		var costoActual = '.$_SESSION["punto_venta"]["envio"]["costo_envio"].';';
		}
		else {
			echo '		var costoActual = 0;';
		}
?>

		var stringPagoData = '';
		var cssEspacios = '<?=$cssEspacios?>';
		var requiere_factura = <?=(isset($_SESSION["punto_venta"]["facturacion"]))?"true":"false"?>;
		
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
			
			//$("#wizard").steps();
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
					
					if(newIndex === 2){
						//alert("envio completo: "+bandera_datos_completos_envio);
						if(!bandera_datos_completos_envio){
							toastr.error("Debe elegir si requiere envío o no");
							return false;
						}
						
					}

                    if(newIndex === 3){
						//alert("envio completo: "+bandera_datos_completos_envio);
						if(!bandera_datos_completos_fact){
							toastr.error("Debe elegir si requiere factura o no");
							return false;
						}
						
					}
					// Forbid suppressing "Warning" step if the user is to young
                    if (newIndex === 4) // validacion de pagos
                    {
						envia_falso = false;
						maxObjIdTmp = 1;
						
						stringPagoData = '{"pagos":[';
						
					   //alert(maxObjId);
						while (maxObjIdTmp <= (maxObjId-1)) {
							newValueSel = $('#sel_metodo_'+maxObjIdTmp).val();
							newValueSelTxt = $('#sel_metodo_'+maxObjIdTmp+' option:selected').text();
							newValue = $('#metodo_'+maxObjIdTmp).val();
							newValueRef = '';
							
							if(typeof(newValue) != "undefined"){ //se borro la fila por lo tanto se omite
							
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
								
								if(newValue == ''){
									toastr.error("Debe ingresar el monto para el metodo de pago #<b>"+maxObjIdTmp+"</b>");
									envia_falso = true;
									setTimeout(function(){
										$("#metodo_"+maxObjIdTmp).focus();
									}, 1);
								}								
								
								if(!envia_falso){
									stringPagoData+='{"pago_metodo_id": "'+newValueSel+'", "pago_metodo": "'+newValueSelTxt+'", "monto": "'+newValue+'", "referencia": "'+newValueRef+'"},';
								}
								
							}
							maxObjIdTmp++;
						}
						stringPagoData = stringPagoData.slice(0,-1);
						stringPagoData+=']}';
						
						<?php
						
						if(!$esApartado){
							echo "
							if(  $('#spanRestanVenta').html() != '$ 0'){
								toastr.error('<b>Los pagos deben cubrir el total de la venta</b>');
								envia_falso = true;
							}
							";
						}
						?>
						
						if( envia_falso ){
							return false;
						} else {
							guarda_metodos_pago();
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
					//alert(currentIndex);
					//var form = $(this);
					if(currentIndex == 4){
						url = '/ventas/ajax/guardarCompra.php<?=($esApartado)?'?apartado=u48f6d1':''?>';
						$.ajax(
						{
							type: "POST",
							url: url,
							success: function(data)
							{
								//alert(data);
								dataJson = JSON.parse(data);
								//alert(dataJson.idVenta);
								swal({
									title: "<?=($esApartado)?'Apartado Realizado!':'Compra Realizada!'?>",
									text: "<?=($esApartado)?'El apartado':'La compra'?> se ha registrado!",
									type: "success"
									}, function () {										
										//mandar impresion de ticket dataJson.idVenta
										window.location.href = 'index.php';
										window.open('../ventas/comprobante_venta.php?v='+dataJson.idVenta,'_blank');
										borrar_datos_venta();
								});
							}
						});
					} else {
						toastr.error("Datos incompletos, aun no se puede finalizar <?=($esApartado)?"el apartado":"la compra"?>");
						return false;
					}
					
                    // Submit form input
                    //form.submit();
                },
				onCanceled: function (event, currentIndex)
				{
					swal({
					  title: "¿ Estás seguro de cancelar esta venta ?",
					  text: "Se eliminaran los datos de la venta",
					  type: "warning",
					  showCancelButton: true,
					  confirmButtonColor: "#DD6B55",
					  confirmButtonText: "Cancelar Venta",
					  cancelButtonText: "Regresar",
					  closeOnConfirm: false,
					},
					function(isConfirm){
						if (isConfirm) {
							
							swal({
								title: "Venta Cancelada!", 
								text: "Se ha borrado el avance de la venta", 
								type: "success"			
							}, function () {
								borrar_datos_venta();
							});
						}
					});

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
			
			$("#select_zona_envio").change(function(){
				//console.log("llega" + $(this).val());
				if($(this).val()=='0'){
					$("#costoEnvio").val('0');
					$("#spancostoEnvio").html("");
				}
				if($(this).val()=='1'){
					$("#costoEnvio").val('500');
					$("#spancostoEnvio").html("min $1 - max $500");
				}
				if($(this).val()=='2'){
					$("#costoEnvio").val('1000');
					$("#spancostoEnvio").html("min $501 - max $1000");
				}
				if($(this).val()=='3'){
					$("#costoEnvio").val('1500');
					$("#spancostoEnvio").html("min $1001 - max $1500");
				}
				if($(this).val()=='4'){
					$("#costoEnvio").val('1501');
					$("#spancostoEnvio").html("$1501 más");
				}
				actualizaResumenVenta();
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
				
						if (typeof( $("#inputBuscaClienteFromDatos").getSelectedItemData().id_cliente ) != "undefined" ) { 
							//desde datos
							var id=$("#inputBuscaClienteFromDatos").getSelectedItemData().id_cliente;	
							var name=$("#inputBuscaClienteFromDatos").getSelectedItemData().nombre;
							var email=$("#inputBuscaClienteFromDatos").getSelectedItemData().emails;
							var number=$("#inputBuscaClienteFromDatos").getSelectedItemData().numbers_type;
						}
				
						if (typeof( $("#inputBuscaClienteFromEnvio").getSelectedItemData().id_cliente ) != "undefined" ) { 
							//desde envio
							var id=$("#inputBuscaClienteFromEnvio").getSelectedItemData().id_cliente;
							var name=$("#inputBuscaClienteFromEnvio").getSelectedItemData().nombre;
							var email=$("#inputBuscaClienteFromEnvio").getSelectedItemData().emails;
							var number=$("#inputBuscaClienteFromEnvio").getSelectedItemData().numbers_type;
						}
						if (typeof( $("#inputBuscaClienteFromFact").getSelectedItemData().id_cliente ) != "undefined" ) { 
							//desde facturacion
							var id=$("#inputBuscaClienteFromFact").getSelectedItemData().id_cliente;
							var name=$("#inputBuscaClienteFromFact").getSelectedItemData().nombre;
							var email=$("#inputBuscaClienteFromFact").getSelectedItemData().emails;
							var number=$("#inputBuscaClienteFromFact").getSelectedItemData().numbers_type; 
						}
						
						$("#divBuscaClienteInputEnvio").css("display","none");
						$("#divBuscaClienteInputFacturacion").css("display","none");
						
						setClienteData(name, email, number);
						getClienteDirecciones(id);
						
						SelectedItemData(id, name, email, number);
						
					}
				}
		};
		
		var SelectedItemData=function(id,name,email,number)
		{
			
			var tableGeneralData ='<button style="position:relative; float:right;" type="button" class="btn btn-xs btn-danger" id="removeCliente_'+id+'" onclick="removeCliente('+id+');">Desasociar cliente</button>'+
			'<table class=""><tbody><tr><td><b>Nombre Completo:</b></td></tr>'+
				'<tr id="row_'+id+'"><td style="padding-left:10px;"><i class="fa fa-user"></i> '+cssEspacios+name+' &nbsp;&nbsp;<br><br> </td><td></td></tr>'+
			'</tbody></table>';

			//var cliente=$("#cliente_"+id).val();
			
			if(1)//cliente==undefined)
			{		
				var tableDetailedData = tableGeneralData+
				'<table class=""><tbody><tr> <td><b>Direcciones de envío:</b></td> </tr>'+
				'<tr> <td style="padding-left:10px;"> '+txtDireccionesEnvio+' <br> </td> </tr>'+									
				'<tr> <td><b>Direcciones de facturación:</b></td> </tr>'+
				'<tr> <td class="desc" style="padding-left:10px;"> '+txtDireccionesFacturacion+' </td> </tr>'+
				'</tbody></table>';
				
				number_detail = number.split(",");
				var txtTelefonosTipo = '<table>';
				
				for(indice in number_detail){
					//alert(number_detail[indice]);
					number_detail_sep = number_detail[indice].split("|");
					classIcoPhone = '';
					fontSizeIcoPhone = '15px;';
					titleIcoPhone = '';
					if(number_detail_sep[0] == 1 || number_detail_sep[0] == 5){ //celular
						classIcoPhone = 'fa fa-mobile';
						fontSizeIcoPhone = '20px;';
						titleIcoPhone = 'Celular';
					}
					if(number_detail_sep[0] == 2){ //casa
						classIcoPhone = 'fa fa-home';
						fontSizeIcoPhone = '15px;';
						titleIcoPhone = 'Casa';
						
					}
					if(number_detail_sep[0] == 3){ //oficina
						classIcoPhone = 'fa fa-hospital-o';
						fontSizeIcoPhone = '15px;';
						titleIcoPhone = 'Oficina';
					}
					if(number_detail_sep[0] == 4){ //otro
						classIcoPhone = 'fa phone';
						fontSizeIcoPhone = '15px;';
						titleIcoPhone = 'Otro';
					}
					
					txtTelefonosTipo+='<tr><td align="center"><i class="'+classIcoPhone+'" style="font-size:'+fontSizeIcoPhone+'" title="'+titleIcoPhone+'" ></i></td><td>&nbsp; '+number_detail_sep[1]+'</td></tr>';
				}
				
				txtTelefonosTipo+='</table>';
				
				table_extra = '<b>Teléfonos:</b><br>'+txtTelefonosTipo+'<br><br><b>Correos:</b><br><i class="fa fa-envelope-o"></i> '+cssEspacios+email.replace(/,/g,'<br><i class="fa fa-envelope-o"></i> '+cssEspacios);
		
				$('#divBuscaCliente_0').html(tableDetailedData);
				
				$('#divBuscaCliente_extra_0').html(table_extra);
				
				$('#divBuscaClienteEnvio').html(tableGeneralData);
				$('#divBuscaClienteFacturacion').html(tableGeneralData);
		
				$("#inputBuscaClienteFromDatos").focus();
				$("#inputBuscaClienteFromDatos").val('');
				
				$("#inputBuscaClienteFromEnvio").focus();
				$("#inputBuscaClienteFromEnvio").val('');
				
				$("#inputBuscaClienteFromFact").focus();
				$("#inputBuscaClienteFromFact").val('');
			}
		}

		$("#inputBuscaClienteFromDatos").easyAutocomplete(options);
		$("#inputBuscaClienteFromEnvio").easyAutocomplete(options);
		$("#inputBuscaClienteFromFact").easyAutocomplete(options);
			
       });
	   
	   var meses = new Array();
	   meses["01"] = "Ene";
	   meses["02"] = "Feb";
	   meses["03"] = "Maz";
	   meses["04"] = "Abr";
	   meses["05"] = "May";
	   meses["06"] = "Jun";
	   meses["07"] = "Jul";
	   meses["08"] = "Ago";
	   meses["09"] = "Sep";
	   meses["10"] = "Oct";
	   meses["11"] = "Nov";
	   meses["12"] = "Dic";
	   
	   function asociaDireccionEnvio(cliente_direccion_id){
		   var url="/clientes/ajax_asocia_direccion_envio.php";
		   
					 
			$.ajax({
				type: "POST",
				url: url,
				data: {cliente_direccion_id: cliente_direccion_id}, // serializes the form's elements.
				success: function(data)
				{
					/*swal({
						title: "Guardado!",
						text: "Dirección de envío vinculada correctamente!",
						type: "success"
					}, function () {
						
					});*/
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
	
	   }
	   
	   function asociaDireccionFact(cliente_direccion_id){
		   
		   var url="/clientes/ajax_asocia_direccion_fact.php";
					 
			$.ajax({
				type: "POST",
				url: url,
				data: {cliente_direccion_id: cliente_direccion_id}, // serializes the form's elements.
				success: function(data)
				{
					/*
					swal({
						title: "Guardado!",
						text: "Dirección de facturación vinculada correctamente!",
						type: "success"
					}, function () {
						
					});*/
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
			
			$("#demo_btn_"+currentClientDireccionIdFact).removeClass("ocultarElemento");
			$("#demo_btn_"+currentClientDireccionIdFact).addClass("mostrarElemento");
			
			$("#demo_ico_"+currentClientDireccionIdFact).removeClass("mostrarElemento");
			$("#demo_ico_"+currentClientDireccionIdFact).addClass("ocultarElemento");
			
			$("#demo_font_"+currentClientDireccionIdFact).removeClass("direccionSeleccionada");
			$("#demo_font_"+currentClientDireccionIdFact).addClass("direccionSinSeleccion");
			currentClientDireccionIdFact = cliente_direccion_id;
			
	   }
	   
	   function removeCliente(cliente_id){
			$('#divBuscaCliente_0').html('');
			$('#divBuscaCliente_extra_0').html('');
			$('#divBuscaClienteEnvio').html('');
			$('#divBuscaClienteFacturacion').html('');
			$('#divDireciconesClienteEnvio').html('');
			$('#divDireciconesClienteFacturacion').html('');
			
			
			$('#correo_p_facturacion').empty();
			$('#correo_p_facturacion').append('<option value="0">Elegir un correo electrónico</option>');

			var url="/clientes/ajax_remove_cliente_session.php";
			$.ajax({
				type: "POST",
				url: url,
				data: {}, 
				success: function(data)
				{
					/*
					swal({
						title: "Desvilculado!",
						text: "Clinte desvinculado correctamente!",
						type: "success"
					}, function () {
						
					});*/
				}
			});
			$("#divBuscaClienteInputEnvio").css("display","block");
			$("#divBuscaClienteInputFacturacion").css("display","block");
			
	   }
	   
	   function agregaNuevoMetodoPago(){
			
			nuevoMetodoDePago = '<tr id="trMetodo_'+maxObjId+'">';
			nuevoMetodoDePago+= '<td style="padding-top:15px;font-weight: bold;font-size: 14px;"> '+maxObjId+' </td>';
			nuevoMetodoDePago+= '	<td>';			
			nuevoMetodoDePago+= '		<select id="sel_metodo_'+maxObjId+'" style="height:35px; font-size:13px;">';
			nuevoMetodoDePago+= '			<?=$rowsMetodosPago?>';
			nuevoMetodoDePago+= '		</select>';
			nuevoMetodoDePago+= '	</td>';
			nuevoMetodoDePago+= '	<td>';
			nuevoMetodoDePago+= '		<div>';
			nuevoMetodoDePago+= '			<input style="width:130px; font-size:13px;" type="text" name="metodo_'+maxObjId+'" id="metodo_'+maxObjId+'" class="form-control" placeholder="$" onchange="recalculaRestaTotal();" /> ';
			nuevoMetodoDePago+= '		</div>';
			nuevoMetodoDePago+= '	</td>';
			nuevoMetodoDePago+= '	<td>';
			nuevoMetodoDePago+= '		<div>';
			nuevoMetodoDePago+= '			<input type="text" name="referencia_'+maxObjId+'" id="referencia_'+maxObjId+'" style="font-size:13px;" class="form-control" placeholder="Referencia/Terminación" onchange="recalculaRestaTotal();" /> ';
			nuevoMetodoDePago+= '		</div>';
			nuevoMetodoDePago+= '	</td>';
			nuevoMetodoDePago+= '	<td>';
			nuevoMetodoDePago+= '		<button class="btn btn-danger btn-xs" id="botonMinus_'+maxObjId+'"  type="button" style="margin-top:5px;" onclick="remueveNuevoMetodoPago(this);"><i class="fa fa-minus"></i></button>';
			nuevoMetodoDePago+= '	</td>';
			nuevoMetodoDePago+= '</tr>';
			
			$('#tableMetodosDePago').append(nuevoMetodoDePago);
			
			maxObjId++;
	   }
	   
	   function remueveNuevoMetodoPago(objIconMinus){
		  
		   trMetodoTxt = objIconMinus.id.replace("botonMinus_","trMetodo_");
		  // alert(trMetodoTxt);
		   
		   $('#'+trMetodoTxt).remove();
		   recalculaRestaTotal();
	   }
	   
	   function recalculaRestaTotal(){
		   
			maxObjIdTmp = 1;
			
			if( requiere_factura ){
				numNuevoRestan = parseInt(costoActual) + ( parseInt(subtotal) * 1.16);
			} else {
				numNuevoRestan = parseInt(costoActual) + parseInt(subtotal);
			}
			numNuevoRestan = Math.round(numNuevoRestan);
			while (maxObjIdTmp <= maxObjId) {
				newValue = $('#metodo_'+maxObjIdTmp).val();
				//alert(newValue);
				if(typeof(newValue) != "undefined" && newValue!=''){
					newValue =  parseInt(newValue);
					//alert("restar "+newValue);
					numNuevoRestan = numNuevoRestan - newValue;
				}
				
				maxObjIdTmp++;
			}
		   
			$('#spanRestanVenta').html('$ '+numNuevoRestan);
	   }
	   var txtDireccionesEnvio = '';
	   var txtDireccionesFacturacion = '';
	   
	   function getClienteDirecciones(id){
		   
		   var url="/clientes/ajax_get_cliente_direcciones.php";
			$.ajax({
				type: "POST",
				url: url,
				data: { cliente_id:id }, // serializes the form's elements.
				async: false,
				success: function(data)
				{
					$('#divDireciconesClienteEnvio').html('');
					$('#divDireciconesClienteFacturacion').html('');
					
					dataJson = JSON.parse(data);
					
					newDivBtnsEnvio = '<b>Selecciona una dirección de envío:</b><br>';
					newDivBtnsFact = '<b>Selecciona una dirección de facturación:</b><br>';
					
					newDivsEnvio = '';
					newDivsFact = '';
					txtDireccionesFacturacion = '';
					txtDireccionesEnvio = '';
					jQuery.each(dataJson, function(i, val) {
						
						globalDataClient['id_'+val.cliente_direccion_id] = new Array();
						globalDataClient['id_'+val.cliente_direccion_id]['cliente_direccion_tipo_id'] = val.cliente_direccion_tipo_id;
						globalDataClient['id_'+val.cliente_direccion_id]['cliente_direccion_calle'] = val.cliente_direccion_calle;
						globalDataClient['id_'+val.cliente_direccion_id]['cliente_direccion_numero_ext'] = val.cliente_direccion_numero_ext;
						globalDataClient['id_'+val.cliente_direccion_id]['cliente_direccion_colonia'] = val.cliente_direccion_colonia;
						globalDataClient['id_'+val.cliente_direccion_id]['cliente_direccion_municipio'] = val.cliente_direccion_municipio;
						globalDataClient['id_'+val.cliente_direccion_id]['estado'] = val.estado;
						globalDataClient['id_'+val.cliente_direccion_id]['cliente_direccion_cp'] = val.cliente_direccion_cp;
						
						globalDataClient['id_'+val.cliente_direccion_id]['cliente_direccion_rfc'] = val.cliente_direccion_rfc;
						globalDataClient['id_'+val.cliente_direccion_id]['cliente_direccion_razon_social'] = val.cliente_direccion_razon_social;
						globalDataClient['id_'+val.cliente_direccion_id]['cliente_direccion_entre_calles'] = val.cliente_direccion_entre_calles;
						
						if( typeof(val.cliente_direccion_numero_int) != 'string'){
							val.cliente_direccion_numero_int = '';
						} 
						globalDataClient['id_'+val.cliente_direccion_id]['cliente_direccion_numero_int'] = val.cliente_direccion_numero_int;
						
						//separar botones de divs
						
						cssRowDireccion = 'class="direccionSinSeleccion"';
						cssBtnElegir = 'mostrarElemento';
						cssIcoElegir = 'ocultarElemento';
						
						if(val.cliente_direccion_tipo_id == 1 || val.cliente_direccion_tipo_id == 3){ //direcciones de facturación
							newDivBtnsFact+= '<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo_'+val.cliente_direccion_id+'">'+val.cliente_direccion_calle+' '+val.cliente_direccion_numero_ext+'...</button> ';
							newDivsFact+= '<div id="demo_'+val.cliente_direccion_id+'" class="collapse"><font id="demo_font_'+val.cliente_direccion_id+'" '+cssRowDireccion+'>'+val.cliente_direccion_calle+' '+val.cliente_direccion_numero_ext+' '+val.cliente_direccion_numero_int+' '+val.cliente_direccion_colonia+' '+val.cliente_direccion_municipio+', '+globalDataClient['id_'+val.cliente_direccion_id]['estado']+'. C.P. '+val.cliente_direccion_cp+'</font> &nbsp;&nbsp;&nbsp;<i id="demo_ico_'+val.cliente_direccion_id+'" class="fa fa-check-square '+cssIcoElegir+'" style="color:green;"></i><button type="button" class="btn btn-warning btn-xs '+cssBtnElegir+'" onclick="asociaDireccionFact('+val.cliente_direccion_id+');" style="margin:4px 0px;" id="demo_btn_'+val.cliente_direccion_id+'"> Elegir</button></div>';
							
							txtDireccionesFacturacion+= '<i class="fa fa-file-text-o"></i> '+cssEspacios+val.cliente_direccion_calle+' '+val.cliente_direccion_numero_ext+' '+val.cliente_direccion_numero_int+' '+val.cliente_direccion_colonia+' '+val.cliente_direccion_municipio+', '+val.estado+'. C.P. '+val.cliente_direccion_cp+'<br>';
						}
						if(val.cliente_direccion_tipo_id == 2 || val.cliente_direccion_tipo_id == 3){ //direcciones de envio
						
							newDivBtnsEnvio+= '<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo_'+val.cliente_direccion_id+'">'+val.cliente_direccion_calle+' '+val.cliente_direccion_numero_ext+'...</button> ';
							newDivsEnvio+= '<div id="demo_'+val.cliente_direccion_id+'" class="collapse"><font id="demo_font_'+val.cliente_direccion_id+'" '+cssRowDireccion+'>'+val.cliente_direccion_calle+' '+val.cliente_direccion_numero_ext+' '+val.cliente_direccion_numero_int+' '+val.cliente_direccion_colonia+' '+val.cliente_direccion_municipio+', '+globalDataClient['id_'+val.cliente_direccion_id]['estado']+'. C.P. '+val.cliente_direccion_cp+'</font> &nbsp;&nbsp;&nbsp;<i id="demo_ico_'+val.cliente_direccion_id+'" class="fa fa-check-square '+cssIcoElegir+'" style="color:green;"></i><button type="button" class="btn btn-warning btn-xs '+cssBtnElegir+'" onclick="asociaDireccionEnvio('+val.cliente_direccion_id+');" style="margin:4px 0px;" id="demo_btn_'+val.cliente_direccion_id+'"> Elegir</button></div>';
							
							txtDireccionesEnvio+= '<i class="fa fa-map-marker"></i> '+cssEspacios+val.cliente_direccion_calle+' '+val.cliente_direccion_numero_ext+' '+val.cliente_direccion_numero_int+' '+val.cliente_direccion_colonia+' '+val.cliente_direccion_municipio+', '+globalDataClient['id_'+val.cliente_direccion_id]['estado']+'. C.P. '+val.cliente_direccion_cp+'<br>';
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
	   
	   function ventaConEnvio(){
			$("#icoResumenEnvio").removeClass();
			$("#icoResumenEnvio").addClass("fa fa-check-square-o greenFont");
			
			txtDireccionEnvio = globalDataClient['id_'+currentClientDireccionIdEnvio]['cliente_direccion_calle']+" "+globalDataClient['id_'+currentClientDireccionIdEnvio]['cliente_direccion_numero_ext']+", "+globalDataClient['id_'+currentClientDireccionIdEnvio]['cliente_direccion_colonia']+"<br>";
			txtDireccionEnvio+= globalDataClient['id_'+currentClientDireccionIdEnvio]['cliente_direccion_municipio']+", "+globalDataClient['id_'+currentClientDireccionIdEnvio]['estado']+". C.P. "+globalDataClient['id_'+currentClientDireccionIdEnvio]['cliente_direccion_cp']+"<br>";
			fec_ven_arr = $("#pv_fecha_vencimiento").val().split("/");
			txtDireccionEnvio+="Fecha y hora de entrega: "+fec_ven_arr[0]+"/"+meses[fec_ven_arr[1]]+"/"+fec_ven_arr[2]+" "+$("#pv_hora_vencimiento").val()+" hrs<br>";
	
			$("#divInfoResumenEnvio").html(txtDireccionEnvio);
	   }
	   
	   function ventaSinEnvio(){
			$("#icoResumenEnvio").removeClass();
			$("#icoResumenEnvio").addClass("fa fa-times-circle-o redFont");
			$("#divInfoResumenEnvio").html("Sin envío");
			
	   }
	   
	function ventaSinFactura(){
		$("#icoResumenFactura").removeClass();
		$("#icoResumenFactura").addClass("fa fa-times-circle-o redFont");
		$("#divInfoResumenFactura").html("Sin factura");
		
		var url="/clientes/ajax_set_cliente_sin_factura_data.php";

		$.ajax({
			type: "POST",
			url: url,
			success: function(data)
			{
				/*
				swal({
						title: "Sin envío!",
						text: "Los datos de NO envío han sido guardados correctamente!",
						type: "success"
					}, function () {
						
					});
				*/
				requiere_factura = false;
				bandera_datos_completos_fact = true;
				$("#form").steps("next");
				$("#h4_iva").html("$ 0");
				$("#td_iva").html("$ 0");
				actualizaResumenVenta();
			}
		});
	}
	   
	function ventaConFactura(){
		$("#icoResumenFactura").removeClass();
		$("#icoResumenFactura").addClass("fa fa-check-square-o greenFont");
		
		txtDireccionFact = "Razón Social: "+globalDataClient['id_'+currentClientDireccionIdFact]['cliente_direccion_razon_social']+"<br>";
		txtDireccionFact+= "RFC: "+globalDataClient['id_'+currentClientDireccionIdFact]['cliente_direccion_rfc']+"<br>";
		txtDireccionFact+= globalDataClient['id_'+currentClientDireccionIdFact]['cliente_direccion_calle']+" "+globalDataClient['id_'+currentClientDireccionIdFact]['cliente_direccion_numero_ext']+", "+globalDataClient['id_'+currentClientDireccionIdFact]['cliente_direccion_colonia']+"<br>";
		txtDireccionFact+= globalDataClient['id_'+currentClientDireccionIdFact]['cliente_direccion_municipio']+", "+globalDataClient['id_'+currentClientDireccionIdFact]['estado']+". C.P. "+globalDataClient['id_'+currentClientDireccionIdFact]['cliente_direccion_cp']+"<br>";
		
		$("#divInfoResumenFactura").html(txtDireccionFact);
		
		$("#h4_iva").html("$ "+( parseInt(subtotal) * 0.16));
		$("#td_iva").html("$ "+( parseInt(subtotal) * 0.16));
		
		actualizaResumenVenta();
	}
	   
	$('#data_1 .input-group.date').datepicker({
		keyboardNavigation: false,
		forceParse: false,
		autoclose: true,
		language: 'es'
	}).datepicker("setDate", "0");

	function actualizaResumenVenta(){
		
		costoActual = $("#costoEnvio").val();
		$("#costoEnvioEnPago").html("$ "+costoActual);
		$("#costoEnvioEnResumen").html("$ "+costoActual);
		//alert(requiere_factura);
		if( requiere_factura ){
			granTotalActual = parseInt(costoActual) + ( parseInt(subtotal) * 1.16);
		} else {
			granTotalActual = parseInt(costoActual) + parseInt(subtotal);
		}
		granTotalActual = Math.round(granTotalActual); // OJO
		$("#granTotalEnPago").html("$ "+granTotalActual);
		$("#granTotalEnResumen").html("$ "+granTotalActual);
		
		recalculaRestaTotal();
	}
	
	function guarda_datos_envio(){
		//validar direccion elegida y costo de flete		
		
		var url="/clientes/ajax_set_cliente_envio_data.php";
		 
		select_zona_envio_text = $("#select_zona_envio option:selected").text();
		costoEnvio = $("#costoEnvio").val();
		
		fec_ven_arr = $("#pv_fecha_vencimiento").val().split("/");
		fecha_hora_entrega = fec_ven_arr[0]+"/"+meses[fec_ven_arr[1]]+"/"+fec_ven_arr[2]+" "+$("#pv_hora_vencimiento").val()+" hrs";
		select_planta_text = $("#select_planta option:selected").text();
		select_planta_extra_text = $("#select_planta_extra option:selected").text();
		
		if(currentClientDireccionIdEnvio == '0'){
			toastr.error("Debe elegir una dirección de envío");
			return false;
		}
		
		$("#modalDetalleEnvio").modal('hide');
		$.ajax({
			type: "POST",
			url: url,
			data: { 
				cliente_direccion_id:currentClientDireccionIdEnvio, 
				select_zona_envio:select_zona_envio_text,
				costo_envio:costoEnvio,
				fecha_hora_entrega:fecha_hora_entrega,
				select_planta:select_planta_text,
				select_planta_extra:select_planta_extra_text				
			}, 
			success: function(data)
			{
				swal({
						title: "Envio!",
						text: "Los datos de envío han sido guardados correctamente!",
						type: "success"
					}, function () {
						bandera_datos_completos_envio = true;
						$("#form").steps("next");
						ventaConEnvio();
					});
			}
		});
		
	}
	
	function guarda_datos_facturacion(){
		//validar que se haya elegido un correo electrónico y una direccion de facturacion
		var url="/clientes/ajax_set_cliente_factura_data.php";
		
		select_correo_factura_text = $("#correo_p_facturacion option:selected").text();
		if(select_correo_factura_text == 'Elegir un correo electrónico'){
			toastr.error("Debe elegir un correo electrónico");
			return false;
		}
		//alert(currentClientDireccionIdFact);
		if(currentClientDireccionIdFact == '0'){
			toastr.error("Debe elegir una dirección de facturación");
			return false;
		}
		$("#ModalDetalleFacturacion").modal('hide');
		
		
		$.ajax({
			type: "POST",
			url: url,
			data: { 
				cliente_direccion_id:currentClientDireccionIdFact, 
				select_correo_factura:select_correo_factura_text			
			}, 
			success: function(data)
			{
				swal({
						title: "Envio!",
						text: "Los datos de facturación han sido guardados correctamente!",
						type: "success"
					}, function () {
						requiere_factura = true;
						bandera_datos_completos_fact = true;
						$("#form").steps("next");
						ventaConFactura();
					});
			}
		});
		//
	}
	
	function guarda_metodos_pago(){

		var url="/clientes/ajax_set_metodos_pago.php";

		$.ajax({
			type: "POST",
			url: url,
			data: { 
				pago_data:stringPagoData				
			}, 
			success: function(data)
			{
				/*swal({
						title: "Pago!",
						text: "Los datos de pago han sido guardados correctamente!",
						type: "success"
					}, function () {
						
					});*/
			}
		});
	}
	
	function guada_porque_no(){
		var url="/clientes/ajax_set_cliente_sin_envio_data.php";
		motivo = $("#SelSinEnvio option:selected").text();
		
		
		if(motivo == 'Seleccione una opción'){
			toastr.error("Debe elegir un motivo");
			return false;
		}
		$("#modalVentaSinEnvio").modal('hide');
		$.ajax({
			type: "POST",
			url: url,
			data: { 
				motivo:motivo				
			}, 
			success: function(data)
			{
				swal({
						title: "Sin envío!",
						text: "Los datos de NO envío han sido guardados correctamente!",
						type: "success"
					}, function () {
						$("#costoEnvioEnPago").html("$ 0");
						$("#costoEnvioEnResumen").html("$ 0");
						$("#costoEnvio").val(0);
						bandera_datos_completos_envio = true;
						$("#form").steps("next");
						actualizaResumenVenta();
					});
			}
		});
	}
	
	function borrar_datos_venta(){
		url = '/clientes/ajax_unset_cliente_venta_data.php';
		
		$.ajax({
			type: "POST",
			url: url,
			success: function(data)
			{
				location.href = '/ventas/index.php';
			}
		});
	}
    </script>

</body>

</html>
