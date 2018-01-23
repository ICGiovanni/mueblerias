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

$corte_final_id=$_REQUEST['cf'];
$caja_data=$caja->getCashRegisterDataFinal($corte_final_id);

$usuario=$caja_data[0]['firstName']." ".$caja_data[0]["lastName"];
$fecha=$general->getDateSimple($caja_data[0]["date"]);
$f=explode(" ",$fecha);
$fecha=$f[0];
$hora=$f[1];

$cortes_parciales=$caja->getBoxCutPartial($corte_final_id);

$total=array();

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
$html.='<td align="left" width="50%"><strong>Fecha:</strong> '.$fecha.'</td>';
$html.='<td align="rigth" width="50%"><strong>Hora: </strong>'.$hora.'</td>';
$html.='</tr>';
$html.='<tr>';
$html.='<td align="left"><strong>No. Corte Final:</strong> '.$corte_final_id.'</td>';
$html.='<td></td>';
$html.='</tr>';
$html.='<tr>';
$html.='<td align="left"><strong>Vendedor:</strong> '.$usuario.'</td>';
$html.='<td></td>';
$html.='</tr>';
$html.='<tr>';
$html.='<td align="center" colspan="2"></td>';
$html.='</tr>';
$html.='<tr>';
$html.='<td align="center" colspan="2">++++++++++++  <strong>CORTE FINAL</strong>  ++++++++++++</td>';
$html.='</tr>';
$html.='<tr>';
$html.='<td align="center" colspan="2"></td>';
$html.='</tr>';

$html.='</table>';

$i=1;
$cortes=count($cortes_parciales);
foreach($cortes_parciales as $cp)
{
	$fechaP=$general->getDateSimple($cp["date"]);
	$corte_parcial_id=$cp["corte_parcial_id"];
	$usuarioP=$cp['firstName']." ".$cp["lastName"];
	/*$html.='<div style="text-align:center;font-size: 8px;">';
	$html.='<table style="padding-right:8px;text-align:center;font-size: 8px;" width="100%" cellspacing="2">';
	$html.='<tr>';
	$html.='<td align="left" width="70%"><strong>Fecha:</strong> '.$fechaP.'</td>';
	$html.='<td align="rigth" width="30%"></td>';
	$html.='</tr>';
	$html.='<tr>';
	$html.='<td align="left"><strong>No. Corte Parcial:</strong> '.$corte_parcial_id.'</td>';
	$html.='<td></td>';
	$html.='</tr>';
	$html.='<tr>';
	$html.='<td align="left"><strong>Realizo:</strong> '.$usuarioP.'</td>';
	$html.='<td></td>';
	$html.='</tr>';
	$html.='</table>';*/
	
	$pagos=array();
	$ventas=$caja->getCashRegister($corte_parcial_id);
	
	foreach($ventas as $v)
	{
		$venta_id=$v['venta_id'];
		
		$payments=$caja->getPaymentsData($corte_parcial_id, $venta_id);
		
		foreach($payments as $p)
		{
			$forma_pago=$p["general_forma_de_pago_desc"];
			$monto=$p["monto"];
			
			$m=explode('.',$monto);
			if(count($m)==1)
			{
				$monto.='.00';
			}
			
			if(isset($pagos[$forma_pago]))
			{
				$pagos[$forma_pago]=$pagos[$forma_pago]+$monto;
			}
			else
			{
				$pagos[$forma_pago]=$monto;
			}
			
			if(isset($total[$forma_pago]))
			{
				$total[$forma_pago]=$total[$forma_pago]+$monto;
			}
			else
			{
				$total[$forma_pago]=$monto;
			}
		}
	}
	
	$mounts=$caja->getMountsInitBoxCut($corte_parcial_id);
	
	foreach($mounts as $mount)
	{
		if(isset($pagos["Caja"]))
		{
			$pagos["Caja"]=$pagos["Caja"]+$mount["monto_inicial"];
		}
		else
		{
			$pagos["Caja"]=$mount["monto_inicial"];
		}
		
		if(isset($total["Caja"]))
		{
			$total["Caja"]=$total["Caja"]+$mount["monto_inicial"];
		}
		else
		{
			$total["Caja"]=$mount["monto_inicial"];
		}
	}
	
	
	$html.='<table style="margin-bottom:10px;font-size: 8px;" width="100%" cellspacing="1">';
	$html.='<thead >';
	$html.='<tr style="border-top-width:1px; border-bottom-width:1px;text-align:center;font-size: 8px !important;">';
	$html.='<td  style="border-top-width:1px; border-bottom-width:1px;text-align:center;">CORTE '.$i.'/'.$cortes.'</td>';
	$html.='<td  style="border-top-width:1px; border-bottom-width:1px;text-align:center;border-style: dotted;"></td>';
	$html.='<td  style="border-top-width:1px; border-bottom-width:1px;text-align:center;">DETALLE</td>';
	$html.='<td  style="border-top-width:1px; border-bottom-width:1px;text-align:center;">IMPORTE</td>';
	$html.='</tr>';
	$html.='</thead>';
	$html.='<tbody>';
	
	$totalC=0;
	foreach($pagos as $k=>$p)
	{
		$totalC=$totalC+$p;
		
		$m=explode('.',$p);
		if(count($m)==1)
		{
			$p.='.00';
		}
		
		$html.='<tr><td></td><td></td><td align="right"><strong>'.$k.'</strong></td><td align="">$ '.$p.'</td></tr>';
	}
	
	$m=explode('.',$totalC);
	if(count($m)==1)
	{
		$totalC.='.00';
	}

	$html.='<tr><td></td><td></td><td align="right"><strong>TOTAL</strong></td><td align="">$ '.$totalC.'</td></tr>';
	
	$html.='</tbody>';
	$html.='<tfoot>';
	$html.='<tr style="border-top-width:1px; border-bottom-width:1px;text-align:center;font-size: 8px !important;">';
	$html.='<td colspan="4" style="border-top-width:1px; border-bottom-width:1px;text-align:center;border-style: dotted;">';
	$html.=strtoupper($general->num2letras($totalC));
	$html.='</td>';
	$html.='</tr>';
	$html.='</tfoot>';
	$html.='</table>';

	$i++;
}

$html.='<br><br>';
$html.='<table style="text-align:center;font-size: 8px !important;">';
$html.='<tr>';
$html.='<td style="border-top-width:1px; border-bottom-width:1px;border-right-width:1px;border-left-width:1px;text-align:center;"><strong>CORTE TOTAL</strong></td>';
$html.='</tr>';
$html.='<tr>';
$html.='<td></td>';
$html.='</tr>';
$html.='<tr>';
$html.='<td style="border-top-width:1px; border-bottom-width:1px;border-right-width:1px;border-left-width:1px;">';
$html.='<table style="margin-bottom:10px;font-size: 7px;" width="100%" cellspacing="1">';
$mounts=$caja->getMountsInitBoxCut($corte_parcial_id);
$html.='<tr>';
$html.='<td></td>';
$html.='<td></td>';
$html.='<td></td>';
$html.='<td></td>';
$html.='</tr>';

$totalF=0;
foreach($total as $k=>$p)
{
	$totalF=$totalF+$p;
	
	$m=explode('.',$p);
	if(count($m)==1)
	{
		$p.='.00';
	}
	
	$html.='<tr><td></td><td></td><td align="right"><strong>'.$k.'</strong></td><td align="">$ '.$p.'</td></tr>';
}


$m=explode('.',$totalF);
if(count($m)==1)
{
	$totalF.='.00';
}

$html.='<tr><td></td><td></td><td align="right"><strong></strong></td><td align=""></td></tr>';
$html.='<tr><td></td><td></td><td align="right"><strong>Total</strong></td><td align="">$ '.$totalF.'</td></tr>';

$html.='<tr>';
$html.='<td></td>';
$html.='<td></td>';
$html.='<td></td>';
$html.='<td></td>';
$html.='</tr>';

$html.='</table>';
$html.='</td>';
$html.='</tr>';
$html.='</table>';

$html.='<br>';

$html.='<div style="font-size: 8px;text-align:left;">Observaciones:_____________________________________________________________________________________________________________________________________________________</div>';

$html.='<br>';

/*foreach($cortes_parciales as $cp)
{
	$fechaP=$general->getDateSimple($cp["date"]);
	$corte_parcial_id=$cp["corte_parcial_id"];
	$usuarioP=$cp['firstName']." ".$cp["lastName"];
	$html.='<div style="text-align:center;font-size: 8px;">';
	$html.='<table style="padding-right:8px;text-align:center;font-size: 8px;" width="100%" cellspacing="2">';
	$html.='<tr>';
	$html.='<td align="left" width="70%"><strong>Fecha:</strong> '.$fechaP.'</td>';
	$html.='<td align="rigth" width="30%"></td>';
	$html.='</tr>';
	$html.='<tr>';
	$html.='<td align="left"><strong>No. Corte Parcial:</strong> '.$corte_parcial_id.'</td>';
	$html.='<td></td>';
	$html.='</tr>';
	$html.='<tr>';
	$html.='<td align="left"><strong>Realizo:</strong> '.$usuarioP.'</td>';
	$html.='<td></td>';
	$html.='</tr>';
	$html.='</table>';
	
	$pagos=array();
	$ventas=$caja->getCashRegister($corte_parcial_id);
	foreach($ventas as $v)
	{
		$venta_id=$v['venta_id'];
		
		$payments=$caja->getPaymentsData($corte_parcial_id, $venta_id);
		
		foreach($payments as $p)
		{
			$forma_pago=$p["general_forma_de_pago_desc"];
			$monto=$p["monto"];
			
			$m=explode('.',$monto);
			if(count($m)==1)
			{
				$monto.='.00';
			}
			
			if(isset($pagos[$forma_pago]))
			{
				$pagos[$forma_pago]=$pagos[$forma_pago]+$monto;
			}
			else
			{
				$pagos[$forma_pago]=$monto;
			}
			
			if(isset($total[$forma_pago]))
			{
				$total[$forma_pago]=$total[$forma_pago]+$monto;
			}
			else
			{
				$total[$forma_pago]=$monto;
			}
		}
	}
	
	$mounts=$caja->getMountsInitBoxCut($corte_parcial_id);
	
	foreach($mounts as $mount)
	{
		if(isset($pagos["Caja"]))
		{
			$pagos["Caja"]=$pagos["Caja"]+$mount["monto_inicial"];
		}
		else
		{
			$pagos["Caja"]=$mount["monto_inicial"];
		}
		
		if(isset($total["Caja"]))
		{
			$total["Caja"]=$total["Caja"]+$mount["monto_inicial"];
		}
		else
		{
			$total["Caja"]=$mount["monto_inicial"];
		}
	}
	
	
	$html.='<table style="padding-right:8px;font-size: 8px;" width="100%" cellspacing="2">';
	
	$totalC=0;
	foreach($pagos as $k=>$p)
	{
		$totalC=$totalC+$p;
		
		$m=explode('.',$p);
		if(count($m)==1)
		{
			$p.='.00';
		}
		
		$html.='<tr><td></td><td></td><td align="right"><strong>'.$k.'</strong></td><td align="">$ '.$p.'</td></tr>';
	}
	
	$m=explode('.',$totalC);
	if(count($m)==1)
	{
		$totalC.='.00';
	}
	
	$html.='<tr><td></td><td></td><td align="right"><strong></strong></td><td align=""></td></tr>';
	$html.='<tr><td></td><td></td><td align="right"><strong>Total</strong></td><td align="">$ '.$totalC.'</td></tr>';
	
	$html.='-----------------------------------------------------------------------------------------';
	$html.='</div>';
}


$html.='<div style="text-align:center;font-size: 8px;">';
$html.='<table style="padding-right:8px;text-align:center;font-size: 8px;" width="100%" cellspacing="2">';
$html.='<tr>';
$html.='<td align="left" width="70%"><strong>Fecha:</strong> '.$fecha.'</td>';
$html.='<td align="rigth" width="30%"></td>';
$html.='</tr>';
$html.='<tr>';
$html.='<td align="left"><strong>No. Corte Final:</strong> '.$corte_final_id.'</td>';
$html.='<td></td>';
$html.='</tr>';
$html.='<tr>';
$html.='<td align="left"><strong>Realizo:</strong> '.$usuario.'</td>';
$html.='<td></td>';
$html.='</tr>';
$html.='</table>';
$html.='</div>';
$html.='<div style="text-align:center;font-size: 8px;">';
$html.='<table style="padding-right:8px;font-size: 8px;" width="100%" cellspacing="2">';

$totalF=0;
foreach($total as $k=>$p)
{
	$totalF=$totalF+$p;
	
	$m=explode('.',$p);
	if(count($m)==1)
	{
		$p.='.00';
	}
	
	$html.='<tr><td></td><td></td><td align="right"><strong>'.$k.'</strong></td><td align="">$ '.$p.'</td></tr>';
}

$m=explode('.',$totalF);
if(count($m)==1)
{
	$totalF.='.00';
}

$html.='<tr><td></td><td></td><td align="right"><strong></strong></td><td align=""></td></tr>';
$html.='<tr><td></td><td></td><td align="right"><strong>Total</strong></td><td align="">$ '.$totalF.'</td></tr>';

$html.='-----------------------------------------------------------------------------------------';
$html.='</div>';
*/
$width="72";
$height="315";
$custom_layout = array($width, $height);
$pdf = new TCPDF('P', 'mm', $custom_layout, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->SetMargins(3,1,1,true);

$pdf->SetAutoPageBreak(TRUE,0);

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->AddPage();

$pdf->writeHTML($html, true, 0, true, 0);

//$js = 'print(true);';
//$pdf->IncludeJS($js);

$pdf->Output('ticket'.'.pdf', 'I');


?>