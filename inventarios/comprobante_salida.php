<?php
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'inventarios/models/class.Inventarios.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/general/class.General.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'tcpdf/tcpdf.php');

$move_id=$_REQUEST['m'];

$inventarios=new Inventarios();
$general=new General();

$result=$inventarios->GetDataMoves($move_id);
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

$html.='<div style="width:100%;font-size: 8px;">';
$html.='<table style="padding-right:2px;">';
$html.='<tr><td align="right"><strong>Salida:</strong></td><td align="left">'.$result['usuario_salida'].'</td></tr>';
$html.='<tr><td align="right"><strong>Sucursal de Salida:</strong></td><td align="left">'.$result['sucursal_salida'].'</td></tr>';
$html.='<tr><td align="right"><strong>Fecha de Salida:</strong></td><td align="left">'.$general->getDateSimple($result['fecha_salida']).'</td></tr>';
$html.='<tr><td align="right"><strong>Observaciones de Salida:</strong></td><td align="left">'.$result['nota_salida'].'</td></tr>';
$html.='<tr><td align="right"><strong>Chofer:</strong></td><td align="left">'.$result['chofer'].'</td></tr>';
$html.='<tr><td align="right"></td><td></td></tr>';
$html.='<tr><td align="right"><strong>Entrada:</strong></td><td align="left">'.$result['usuario_entrega'].'</td></tr>';
$html.='<tr><td align="right"><strong>Sucursal de Entrada:</strong></td><td align="left">'.$result['sucursal_entrega'].'</td></tr>';
$html.='<tr><td align="right"><strong>Fecha de Entrada:</strong></td><td align="left">'.$general->getDateSimple($result['fecha_entrega']).'</td></tr>';
$html.='<tr><td align="right"><strong>Observaciones de Salida:</strong></td><td align="left">'.$result['nota_entrega'].'</td></tr>';
$html.='</table>';
$html.='-----------------------------------------------------------------------------------------';
$html.='</div>';
$html.='<div style="text-align:center;width:100%;font-size: 8px;">';
$html.='<table>';
$html.='<tr>
	<th align="center"><strong>CANT.</strong></th>
	<th align="center"><strong>DESCRIPCIÓN/CODIGO</strong></th>
	</tr>';
$productos=$inventarios->GetProductsMove($move_id);

foreach($productos as $p)
{
	$html.='<tr><td align="center">'.$p['cantidad'].'</td><td>'.$p['producto'].'</td></tr>';
}

$html.='</table>';
$html.='</div>';

$width="72";
$height="120";
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