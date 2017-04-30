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
$html.='<div style="text-align:center;">';
$html.='<table>';
$html.='<tr>';
$html.='<td><img src="http://globmint.com/img/logo_globmint2.png" class="header_logo " alt="Globmint" height="30" width="74"></td>';
$html.='</tr>';
$html.='</table>';
$html.='</div>';

$html.='<div style="width:100%;">';
$html.='<table>';
$html.='<tr><td><strong>Salida:</strong></td><td>'.$result['usuario_salida'].'</td></tr>';
$html.='<tr><td><strong>Sucursal de Salida:</strong></td><td>'.$result['sucursal_salida'].'</td></tr>';
$html.='<tr><td><strong>Fecha de Salida:</strong></td><td>'.$general->getDateSimple($result['fecha_salida']).'</td></tr>';
$html.='<tr><td><strong>Observaciones de Salida:</strong></td><td>'.$result['nota_salida'].'</td></tr>';
$html.='<tr><td><strong>Chofer:</strong></td><td>'.$result['chofer'].'</td></tr>';
$html.='<tr><td></td><td></td></tr>';
$html.='<tr><td><strong>Entrada:</strong></td><td>'.$result['usuario_entrega'].'</td></tr>';
$html.='<tr><td><strong>Sucursal de Entrada:</strong></td><td>'.$result['sucursal_entrega'].'</td></tr>';
$html.='<tr><td><strong>Fecha de Entrada:</strong></td><td>'.$general->getDateSimple($result['fecha_entrega']).'</td></tr>';
$html.='<tr><td><strong>Observaciones de Salida:</strong></td><td>'.$result['nota_entrega'].'</td></tr>';
$html.='</table>';
$html.='</div>';
$html.='<br>';
$html.='<div style="text-align:center;width:100%;">';
$html.='<table>';
$html.='<tr>
	<th align="center"><strong>Producto</strong></th>
	<th align="center"><strong>Cantidad</strong></th>
	</tr>';
$productos=$inventarios->GetProductsMove($move_id);

foreach($productos as $p)
{
	$html.='<tr><td>'.$p['producto'].'</td><td align="center">'.$p['cantidad'].'</td></tr>';
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

$js = 'print(true);';

$pdf->IncludeJS($js);

$pdf->Output('ticket'.'.pdf', 'I');


?>