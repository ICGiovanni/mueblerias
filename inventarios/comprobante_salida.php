<?php
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'inventarios/models/class.Inventarios.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/general/class.General.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'tcpdf/tcpdf.php');

$move_id=$_REQUEST['m'];

$inventarios=new Inventarios();
$general=new General();

$result=$inventarios->GetDataMoves($move_id);

$f=$general->getDateSimple($result['fecha_salida']);
$f=explode(' ',$f);
$fecha=$f[0];
$hora=$f[1].' '.$f[2];

$vendedor=$result['usuario_salida'];

$html='';
$html.='<style>';
$html.='body{font-family: "Verdana", Geneva, sans-serif;}';
$html.='</style>';
$html.='<div style="text-align:center;font-size: 8px;">';
$html.='<table>';
$html.='<tr>';
$html.='<td><img src="http://globmint.com/img/logo_globmint.png" class="header_logo " alt="Globmint" height="40" width="130"></td>';
$html.='</tr>';
$html.='<tr>';
$html.='<td></td>';
$html.='</tr>';
$html.='</table>';
$html.='<table style="padding-right:8px;" width="100%" cellspacing="2">';
$html.='<tr>';
$html.='<td align="left"><strong>Fecha:</strong> '.$fecha.'</td>';
$html.='<td align="rigth"><strong>Hora:</strong> '.$hora.'</td>';
$html.='</tr>';
$html.='<tr>';
$html.='<td align="left"><strong>No. Movimiento:</strong> '.$move_id.'</td>';
$html.='<td></td>';
$html.='</tr>';
$html.='<tr>';
$html.='<td align="left"><strong>Vendedor:</strong> '.$vendedor.'</td>';
$html.='<td align="rigth"><div><strong>1 / 2</strong></div></td>';
$html.='</tr>';
$html.='</table><br><br>';
$html.='<strong>+++++++++++ MOV. MERCANCIA +++++++++++</strong><br>';
$html.='-----------------------------------------------------------------------------------------';
$html.='</div>';


$html.='<table style="padding-right:8px;font-size: 8px;" width="100%" cellspacing="2">';
$html.='<tr>
	<th align="left" width="55%"><strong>DESCRIPCIÓN / CODIGO</strong></th>
	<th align="center"><strong>CANT.</strong></th>
	</tr>';
$html.='<tr><td></td><td align="center"></td></tr>';
$productos=$inventarios->GetProductsMove($move_id);
$cantidad=0;
foreach($productos as $p)
{
	$html.='<tr><td width="55%" align="left">'.$p['producto'].'<br>'.$p['producto_sku'].'</td><td align="center">'.$p['cantidad'].'</td></tr>';
	$cantidad=$cantidad+$p['cantidad'];
}

$html.='<tr><td></td><td align="center">__________</td></tr>';
$html.='<tr><td width="55%" align="left"><strong>No. de Articulos:</strong></td><td align="center">'.$cantidad.'</td></tr>';
$html.='</table>';
$html.='<div style="text-align:center;width:100%;font-size: 8px;">';
$html.='-----------------------------------------------------------------------------------------';
$html.='</div>';

$html.='<table style="padding-right:2px;text-align:center;font-size: 8px;" cellspacing="2">';
$html.='<tr><td align="left"><strong>Datos de SALIDA:</strong></td></tr>';
$html.='<tr><td align="left"></td></tr>';
$html.='<tr><td align="left"><strong>Salida Encargado:</strong> '.$result['usuario_salida'].'</td></tr>';
$html.='<tr><td align="left"><strong>Salida Sucursal:</strong> '.$result['sucursal_salida'].'</td></tr>';
$html.='<tr><td align="left"><strong>Fecha de Salida:</strong> '.$general->getDateSimple($result['fecha_salida']).'</td></tr>';
$html.='<tr><td align="left"></td></tr>';
$html.='<tr><td align="left"><strong>Tipo de Movimiento:</strong> Interno</td></tr>';
$html.='<tr><td align="left"><strong>Chofer:</strong> '.$result['chofer'].'</td></tr>';
$html.='<tr><td align="left"><strong>Observaciones:</strong> '.$result['nota_salida'].'</td></tr>';
$html.='<tr><td></td><td align="center"></td></tr>';
$html.='<tr><td align="left"><strong>Destino Sucursal::</strong> '.$result['sucursal_entrega'].'</td></tr>';
$html.='</table>';
$html.='<div style="text-align:center;width:100%;font-size: 8px;">';
$html.='-----------------------------------------------------------------------------------------';
$html.='</div>';

$html.='<div style="text-align:center;font-size: 8px;">';
$html.='<table>';
$html.='<tr>';
$html.='<td><img src="http://globmint.com/img/rectangulo.png" class="header_logo " alt="Globmint" height="60" width="170"></td>';
$html.='</tr>';
$html.='<tr>';
$html.='<td><strong>Firma de Entrada de Mercancia</strong></td>';
$html.='</tr>';
$html.='</table>';
$html.='</div>';

$width="72";
$height="180";
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

//$pdf->SetFont('tahoma', '', 8);

$pdf->AddPage();

$pdf->writeHTML($html, true, 0, true, 0);

$js = 'print(true);';
$pdf->IncludeJS($js);

$pdf->Output('ticket'.'.pdf', 'I');


?>