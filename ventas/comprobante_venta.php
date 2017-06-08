<?php
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'ventas/models/class.Ventas.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/general/class.General.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'tcpdf/tcpdf.php');

$venta_id=$_REQUEST['v'];

$ventas=new Ventas();
$general=new General();
$v=$ventas->obtenerVentas(0,$venta_id);
$v=$v[0];

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
$html.='body{font-family: "Arial", Helvetica, sans-serif;}';
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

$html.='<div style="text-align:center;font-size: 8px;">';
$html.='<table>';
$html.='<tr>';
$html.='<td align="left"><strong>Fecha:</strong> '.$fecha.'</td>';
$html.='<td align="left"><strong>Hora:</strong> '.$hora.'</td>';
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
$html.='<br><br>++++++++++++++++++++++++ <STRONG>VENTA</STRONG> +++++++++++++++++++++<br><br>';
$html.='-----------------------------------------------------------------------------------------';
$html.='</div>';

$html.='<div style="text-align:center;width:100%;font-size: 8px;">';
$html.='<table>';
$html.='<tr>
	<th align="center"><strong>CANT.</strong></th>
	<th align="center"><strong>DESCRIPCIÓN/CODIGO</strong></th>
	<th align="center"><strong>PRECIO</strong></th>
	<th align="center"><strong>IMPORTE</strong></th>
	</tr>';
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
	
	$html.='<tr><td align="center">'.$p['cantidad'].'</td><td>'.$p['producto_sku'].' '.$p['producto_name'].'</td><td>$ '.$precio.'</td><td>$ '.$subtotal.'</td></tr>';
	$total=$total+$p['precio'];
	$totalP++;
}

$t=explode('.',$total);
if(count($t)==1)
{
	$total.='.00';
}

$html.='<tr><td></td><td></td><td align="right"><strong>SUBTOTAL</strong></td><td align="">$ '.$total.'</td></tr>';
$html.='<tr><td></td><td></td><td align="right"><strong>TOTAL</strong></td><td align="">$ '.$total.'</td></tr>';

$html.='</table>';
$html.='</div>';

$html.='<div style="text-align:center;width:100%;font-size: 8px;">';
$html.='<table>';
$html.='<tr><td style="width:80%;">('.$general->num2letras($total).')</td><td></td></tr>';
$html.='<tr><td style="width:80%;"><strong>Numero de articulos vendidos:</strong></td><td style="width:20%;text-align-last: right;">'.$totalP.'</td></tr>';
$html.='</table>';
$html.='</div>';
$html.='------------------------------------------------------------------------';

$html.='<div style="text-align:center;width:100%;font-size: 8px;">';
$html.='<table>';
$html.='<tr><td>Detalles de Pago:</td><td></td></tr>';
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
	
	$html.='<tr><td style="text-align-last: left;">'.$tipo.'</td><td style="text-align-last: left;">$ '.$monto.'</td></tr>';
}

$html.='</table>';
$html.='------------------------------------------------------------------------------------------';
$html.='</div>';

if($flete)
{
	$html.='<div style="text-align:center;width:100%;font-size: 8px;">';
	$html.='<table>';
	
	if(isset($flete['cliente_direccion_numero_int']))
	{
		$direccion=$flete['cliente_direccion_calle'].' '.$flete['cliente_direccion_numero_ext'].' '.$flete['cliente_direccion_numero_ext'];
	}
	else
	{
		$direccion=$flete['cliente_direccion_calle'].' '.$flete['cliente_direccion_numero_ext'];
	}
	
	$html.='<tr><td style="text-align:right;"><strong>Datos de Envio</strong></td><td></td></tr>';
	$html.='<tr><td style="text-align:right;"><strong>Domicilio:</strong></td><td style="text-align:left;">'.$direccion.'</td></tr>';
	$html.='<tr><td style="text-align:right;"><strong>Colonia:</strong></td><td style="text-align:left;">'.$flete['cliente_direccion_colonia'].'</td></tr>';
	$html.='<tr><td style="text-align:right;"><strong>C.P.:</strong></td><td style="text-align:left;">'.$flete['cliente_direccion_cp'].'</td></tr>';
	$html.='<tr><td style="text-align:right;"><strong>Delegación o Municipio:</strong></td><td style="text-align:left;">'.$flete['cliente_direccion_municipio'].'</td></tr>';
	$html.='<tr><td style="text-align:right;"></td><td></td></tr>';
	$html.='</table>';
	$html.='------------------------------------------------------------------------------------------';
	$html.='</div>';
}

$html.='<div style="text-align:center;width:100%;font-size: 8px;">';
$html.='GRACIAS POR SU COMPRA LO ESPERAMOS PRONTO<br>';
$html.='<div style="text-align:justify;width:100%;font-size: 5px;">';
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
$html.='No atenderemos ninguna reclamación sin la presentación de este
Comprobante Simplificado.';
$html.='</div>';
$html.='------------------------------------------------------------------------------------------';
$html.='</div>';

//die($html);

$width="72";
$height="220";
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

$pdf->SetFont('times', '', 8);

$pdf->AddPage();

$pdf->writeHTML($html, true, 0, true, 0);

//$js = 'print(true);';
$js='';
$pdf->IncludeJS($js);

$pdf->Output('ticket'.'.pdf', 'I');


?>