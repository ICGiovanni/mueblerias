<?php
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'ventas/models/class.Ventas.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'clientes/models/class.Clientes.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/general/class.General.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'tcpdf/tcpdf.php');

$venta_id=$_REQUEST['v'];

$ventas=new Ventas();
$general=new General();
$cliente=new Clientes();

$v=$ventas->obtenerVentas(0,$venta_id);
$v=$v[0];
$idCliente=$v['id_cliente'];

$c=$cliente->GetClientes($idCliente);
$nombre_cliente=$c[0]['nombre'].' '.$c[0]['apellidoP'].' '.$c[0]['apellidoM'];
$telefono='55 22 55 22';
$celular='55 22 55 22';
$email='rodriperez@hotmail.com';

$f=$general->getDateSimple($v['fecha_creacion']);
$f=explode(' ',$f);
$fecha=$f[0];
$hora=$f[1].' '.$f[2];

$ticket=strtotime($v['fecha_creacion']).'-'.$venta_id;
$vendedor='Edgar Isaac Montoya';

if(isset($v['venta_flete_id']) && $v['venta_flete_id']!=0)
{
	$flete=$ventas->getAddress($v['venta_flete_id']);
}
else
{
	$flete="";
}

$html='';
$html.='<style>';
$html.='body{font-family: "Verdana", Geneva, sans-serif;style="text-align:center;font-size: 8px !important;}';
$html.='</style>';
$html.='<div style="text-align:center;font-size: 8px;">';
$html.='<table>';
$html.='<tr>';
$html.='<td><img src="http://globmint.com/img/logo_globmint.png" class="header_logo " alt="Globmint" height="40" width="130"></td>';
$html.='</tr>';
$html.='<tr>';
$html.='<td></td>';
$html.='</tr>';
$html.='<tr>';
$html.='<td>Av. Paseo de la Reforma # 364<br>
Col. Centro C.P. 06010<br>
Del. Cuahutemoc, Ciudad de Mexico<br>
Tel. 5526 - 2734</td>';
$html.='</tr>';
$html.='</table>';
$html.='-----------------------------------------------------------------------------------------';
$html.='</div>';

$html.='<table style="padding-right:8px;text-align:center;font-size: 8px;" width="100%" cellspacing="2">';
$html.='<tr>';
$html.='<td align="left" width="70%"><strong>Fecha:</strong> '.$fecha.'</td>';
$html.='<td align="rigth" width="30%"><strong>Hora:</strong> '.$hora.'</td>';
$html.='</tr>';
$html.='<tr>';
$html.='<td align="left"><strong>No. Ticket:</strong> '.$ticket.'</td>';
$html.='<td></td>';
$html.='</tr>';
$html.='<tr>';
$html.='<td align="left"><strong>Vendedor:</strong> '.$vendedor.'</td>';
$html.='<td></td>';
$html.='</tr>';
$html.='</table>';
$html.='<div style="text-align:center;font-size: 8px;">';
$html.='-----------------------------------------------------------------------------------------';
$html.='</div>';


$html.='<table style="padding-right:8px;text-align:left;font-size: 8px;" width="100%" cellspacing="2">';
$html.='<tr>';
$html.='<td><strong>Cliente:</strong> '.$nombre_cliente.'</td>';

$html.='</tr>';
$html.='<tr>';
$html.='<td><strong>Tel:</strong> '.$telefono.'</td>';
$html.='</tr>';

$html.='<tr>';
$html.='<td><strong>Cel:</strong> '.$telefono.'</td>';
$html.='</tr>';

$html.='<tr>';
$html.='<td><strong>Correo:</strong> '.$telefono.'</td>';
$html.='</tr>';

$html.='</table>';
$html.='<div style="text-align:left;font-size: 8px;">';
$html.='++++++++++++++++++ <STRONG>VENTA NORMAL</STRONG> ++++++++++++++++++<br>';
$html.='-----------------------------------------------------------------------------------------';
$html.='</div>';

$html.='<table style="padding-right:8px;font-size: 8px;" width="100%" cellspacing="2">';
$html.='<tr>
	<th align="center" width="14%"><strong>CANT.</strong></th>
	<th align="center" width="42%"><strong>DESCRIPCIÓN / CODIGO</strong></th>
	<th align="center" width="22%"><strong>PRECIO</strong></th>
	<th align="center" width="22%"><strong>IMPORTE</strong></th>
	</tr>';
$html.='<tr><td></td><td></td><td align="right"><strong></strong></td><td align=""></td></tr>';
$productos=$ventas->obtenerProductosVenta($venta_id);
$totalP=0;
$total=0;
foreach($productos as $p)
{
	$precio=$p['precio'];
	$pro=explode('.',$p['precio']);
	if(count($pro)==1)
	{
		$precio.='.00';
	}
	
	$subtotal=$p['subtotal'];
	$s=explode('.',$p['subtotal']);
	if(count($s)==1)
	{
		$subtotal.='.00';
	}
	
	$html.='<tr><td align="center">'.$p['cantidad'].'</td><td align="left">'.$p['producto_name'].' '.$p['producto_sku'].'</td><td align="center">$ '.$precio.'</td><td align="center">$ '.$subtotal.'</td></tr>';
	$total=$total+$p['precio'];
	$totalP++;
	$html.='<tr><td></td><td></td><td align="right"><strong></strong></td><td align=""></td></tr>';
}

$t=explode('.',$total);
if(count($t)==1)
{
	$total.='.00';
}


$html.='<tr><td></td><td></td><td align="right"><strong>SUBTOTAL</strong></td><td align="">$ '.$total.'</td></tr>';
$html.='<tr><td></td><td></td><td align="right"><strong></strong></td><td align=""></td></tr>';
$html.='<tr><td></td><td></td><td align="right"><strong>TOTAL</strong></td><td align=""><strong>$ '.$total.'</strong></td></tr>';

$html.='</table>';


$html.='<table style="padding-right:8px;font-size: 8px;" width="100%" cellspacing="2">';
$html.='<tr><td align="left" style="width:80%;"></td><td></td></tr>';
$html.='<tr><td align="left" style="width:95%;">('.strtoupper($general->num2letras($total)).')</td><td></td></tr>';
$html.='<tr><td align="left" style="width:80%;"></td><td></td></tr>';
$html.='<tr><td align="left" style="width:80%;"><strong>Numero de articulos vendidos:</strong></td><td style="width:20%;text-align-last: right;">'.$totalP.'</td></tr>';
$html.='</table>';
$html.='<div style="text-align:center;width:100%;font-size: 8px;">';
$html.='-----------------------------------------------------------------------------------------';
$html.='</div>';

$html.='<table style="padding-right:8px;font-size: 8px;" width="100%" cellspacing="2">';
$html.='<tr><td width="40%" align="left"><strong>Detalles de Pago:</strong></td><td width="45%" align="left"></td><td width="15%"></td></tr>';
$pagos=$ventas->getPagosVenta($venta_id);

foreach($pagos as $p)
{
	$tipo=$p['general_forma_de_pago_desc'];
	$monto=$p['monto'];
	
	$t=explode('.',$monto);
	if(count($t)==1)
	{
		$monto.='.00';
	}
	
	$html.='<tr><td width="40%" align="left"><strong>'.$tipo.'</strong></td><td width="45%" align="left">$ '.$monto.'</td><td width="15%"></td></tr>';
}
$html.='</table>';
$html.='<div style="text-align:center;width:100%;font-size: 8px;">';
$html.='-----------------------------------------------------------------------------------------';
$html.='</div>';

if($flete)
{
	
	$html.='<table style="padding-right:8px;font-size: 8px;" width="100%" cellspacing="2">';
	
	if(isset($flete['cliente_direccion_numero_int']))
	{
		$direccion=$flete['cliente_direccion_calle'].' '.$flete['cliente_direccion_numero_ext'].' '.$flete['cliente_direccion_numero_ext'];
	}
	else
	{
		$direccion=$flete['cliente_direccion_calle'].' '.$flete['cliente_direccion_numero_ext'];
	}
	
	$html.='<tr><td align="left" width="45%"><strong>Datos de Envio</strong></td><td></td></tr>';
	$html.='<tr><td align="left" width="45%"><strong>Domicilio:</strong></td><td align="left" width="55%">'.$direccion.'</td></tr>';
	$html.='<tr><td align="left" width="45%"><strong>Colonia:</strong></td><td align="left" width="55%">'.$flete['cliente_direccion_colonia'].'</td></tr>';
	$html.='<tr><td align="left" width="45%"><strong>C.P.:</strong></td><td align="left" width="55%">'.$flete['cliente_direccion_cp'].'</td></tr>';
	$html.='<tr><td align="left" width="45%"><strong>Delegación o Municipio:</strong></td><td align="left" width="55%">'.$flete['cliente_direccion_municipio'].'</td></tr>';
	
	$html.='</table>';
	$html.='<div style="text-align:center;width:100%;font-size: 8px;">';
	$html.='-----------------------------------------------------------------------------------------';
	$html.='</div>';
}

$html.='<div style="text-align:center;font-size: 8px;">';
$html.='<table>';
$html.='<tr>';
$html.='<td><img src="http://globmint.com/img/rectangulo.png" class="header_logo " alt="Globmint" height="60" width="170"></td>';
$html.='</tr>';
$html.='<tr>';
$html.='<td><strong>Firma del cliente recibido de conformidad</strong></td>';
$html.='</tr>';
$html.='</table>';
$html.='-----------------------------------------------------------------------------------------';
$html.='</div>';

$html.='<div style="text-align:center;width:100%;font-size: 8px;">';
$html.='GRACIAS POR SU COMPRA LO ESPERAMOS PRONTO<br>';
$html.='<span style="font-size: 7px;">Tel. Central 55 33 44 22</span><br>';
$html.='<div style="text-align:justify;width:100%;font-size: 6px;">';
$html.='Extiende la presente garantía contra defectos de fabricación, de acuerdo a la Ley Federal de
Protección al Consumidor.<br>
*Dependiendo del pedido sera entregado en un lapso aproximado de 10 dias habiles.<br>
CLÁUSULAS. - Esta garantía será válida siempre y cuando los bienes no hayan sido usados
en condiciones distintas a los fines para lo que fueron fabricados. - Todos los fletes incurren en
un costo, el cual es cubierto por el cliente. - Por razón de seguridad no nos hacemos
responsables por los muebles que sean introducidos a la casa por ventanas, azoteas o
exteriores del edificio (que sean volados). - Para brindarles un mejor servicio, le
agradeceremos reportar inmediatamente cualquier anomalía al departamento de servicios. -
De acuerdo a lo señalado por los Articulos 93 y 105 del Código Sanitario, no se hacen
cambios de colchones, por lo que deberán revisarlos sin quitarles el plastico protector. - Los
Servicios y las Garantiás seran brindadas directamente por el fabricante y para darle el servicio
que usted se merece, deberá reportarlo directamente a nuestra central.
- Toda reclamación por daños o entregas imcompletas, deberán reportarse dentro de los 2
primeros días siguientes a la fecha en que recibío el bien o los bienes detallados
anteriormente, en caso contrario se entendera que
usted los recibió a su entera satisfacción. - En caso de apartados: Después de 90 días el precio
está sujeto a cambio sin previo aviso. Toda cancelación causará un 20% de cargos por gastos
de Administración.';
$html.='</div>';
$html.='<div style="text-align:center;width:100%;font-size: 6px;">';
$html.='<strong>No atenderemos ninguna reclamación sin la presentación de este
Comprobante Simplificado.</strong>';
$html.='</div>';

//die($html);

$width="72";
$height="315";
$custom_layout = array($width, $height);
$pdf = new TCPDF('P', 'mm', $custom_layout, true, 'UTF-8', false);
/*$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$width = 175;
$height = 266;
$orientation = ($height>$width) ? 'P' : 'L';
$pdf->addFormat("custom", $width, $height);
$pdf->reFormat("custom", $orientation);
*/
$pdf->SetCreator(PDF_CREATOR);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetMargins(3,1,1,true);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->SetAutoPageBreak(TRUE,0);

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//$pdf->SetFont('times', '', 8);

$pdf->AddPage();

$pdf->writeHTML($html, true, 0, true, 0);

$js = 'print(true);';
$pdf->IncludeJS($js);

$pdf->Output('ticket'.'.pdf', 'I');


?>