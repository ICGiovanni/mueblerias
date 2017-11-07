<?php
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'ventas/models/class.Ventas.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'clientes/models/class.Clientes.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/general/class.General.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'punto_venta/models/class.Caja.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'tcpdf/tcpdf.php');

$ventas=new Ventas();
$general=new General();
$cliente=new Clientes();
$caja=new Caja();

$corte_parcial_id=$_REQUEST['cp'];
$caja_data=$caja->getCashRegisterData($corte_parcial_id);

$usuario=$caja_data[0]['firstName']." ".$caja_data[0]["lastName"];
$fecha=$general->getDateSimple($caja_data[0]["date"]);

$ventas=$caja->getCashRegister($corte_parcial_id);



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
$html.='<td align="rigth" width="30%"></td>';
$html.='</tr>';
$html.='<tr>';
$html.='<td align="left"><strong>No. Corte Parcial:</strong> '.$corte_parcial_id.'</td>';
$html.='<td></td>';
$html.='</tr>';
$html.='<tr>';
$html.='<td align="left"><strong>Realizo:</strong> '.$usuario.'</td>';
$html.='<td></td>';
$html.='</tr>';
$html.='</table>';

foreach($ventas as $v)
{
	$venta_id=$v['venta_id'];
	
	
	$html.='<div style="text-align:left;font-size: 8px;">';
	$html.='-----------------------------------------------------------------------------------------';
	$html.='               <STRONG> Ticket No. '.$venta_id.'</STRONG> <br>';
	$html.='</div>';
	
	$html.='<table style="padding-right:8px;font-size: 8px;" width="100%" cellspacing="2">';
	$html.='<tr>
	<th align="center" width="50%"><strong>T. DE PAGO</strong></th>
	<th align="center" width="42%"><strong>MONTO</strong></th>';
	
	$html.='</tr>';
	
	$payments=$caja->getPaymentsData($corte_parcial_id, $venta_id);
	$html.='<table style="padding-right:8px;font-size: 8px;" width="100%" cellspacing="2">';
	foreach($payments as $p)
	{
		$forma_pago=$p["general_forma_de_pago_desc"];
		$monto=$p["monto"];
		
		$m=explode('.',$monto);
		if(count($m)==1)
		{
			$monto.='.00';
		}
		
		$html.='<tr>
	<th align="center" width="50%">'.$forma_pago.'</th>
	<th align="center" width="42%">'.$monto.'</th>';
		$html.='</tr>';
	}
	
	$html.='</table>';
}

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