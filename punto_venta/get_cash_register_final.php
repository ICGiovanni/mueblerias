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
$sucursal=$caja_data[0]['sucursal_name'];
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
$html.='<td align="left"><strong>Sucursal:</strong> '.$sucursal.'</td>';
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
	
	$pagos=array();
	$ventas=$caja->getCashRegister($corte_parcial_id);
	$enviosT=0;

	$html.='<div style="font-size: 8px;border-top-style: solid;border-right-style: solid;border-bottom-style: solid;border-left-style: solid;text-align:center;"><strong>VENTA NORMAL</strong></div>';
		$html.='<br>';

	foreach($ventas as $v)
	{
		$venta_id=$v['venta_id'];
		
		$ds=$caja->getDataSale($venta_id);
		$payments=$caja->getPaymentsData($corte_parcial_id, $venta_id);

		$detalle_envio='';
		if($ds['detalle_envio'])
		{
			$detalle_envio=json_decode($ds['detalle_envio']);
		}


		$monto_venta=$general->addZeros($ds['monto']);
		$monto_envio=$general->addZeros($ds['costo_envio']);
		$nombre_cliente=$ds['cliente'];
		$ticket=strtotime($ds['fecha_creacion']).'-'.$venta_id;
		$subtotal=$general->addZeros($monto_venta+$monto_envio);

		//$html.='<div style="text-align:left;font-size: 8px;">';
		
		//$html.='</div>';

		$html.='<table style="margin-bottom:10px;font-size: 8px;" width="100%" cellspacing="3">';
		$html.='<thead cellspacing="6">';
		$html.='<tr style="text-align:center;font-size: 8px !important;">';
		$html.='<td  style="border-top-width:1px; border-bottom-width:1px;text-align:center;border-style: dotted;">NO. TICKET</td>';
		$html.='<td  style="border-top-width:1px; border-bottom-width:1px;text-align:center;">CLIENTE</td>';
		$html.='<td  style="border-top-width:1px; border-bottom-width:1px;text-align:center;">DETALLE</td>';
		$html.='<td  style="border-top-width:1px; border-bottom-width:1px;text-align:center;">IMPORTE</td>';
		$html.='</tr>';
		$html.='</thead>';
		$html.='<tbody>';
		$html.='<tr style="text-align:center;font-size: 7px !important;">';
		$html.='<td>'.$ticket.'</td>';
		$html.='<td>'.$nombre_cliente.'</td>';
		$html.='<td style="text-align:right;">VENTA</td>';
		$html.='<td style="text-align:right;">$ '.$monto_venta.'</td>';
		$html.='</tr>';

		if($monto_envio)
		{
			$html.='<tr style="text-align:center;font-size: 7px !important;">';
			$html.='<td></td>';
			$html.='<td></td>';
			$html.='<td style="text-align:right;">ENVIO</td>';
			$html.='<td style="text-align:right;">$ '.$monto_envio.'</td>';
			$html.='</tr>';
			$enviosT=$enviosT+$monto_envio;
		}

		$html.='<tr style="text-align:center;font-size: 7px !important;">';
		$html.='<td></td>';
		$html.='<td></td>';
		$html.='<td style="text-align:right;"><strong>SUB-TOTAL</strong></td>';
		$html.='<td style="text-align:right;"><strong>$ '.$subtotal.'</strong></td>';
		$html.='</tr>';

		$html.='<tr style="text-align:left;font-size: 7px !important;">';
		$html.='<td colspan="2">Detalle de Pago:</td>';
		$html.='<td style="text-align:right;"></td>';
		$html.='<td style="text-align:right;"></td>';
		$html.='</tr>';

		foreach($payments as $p)
		{
			$forma_pago=$p["general_forma_de_pago_desc"];
			$monto=$general->addZeros($p["monto"]);
			
			if(isset($pagos[$forma_pago]))
			{
				$pagos[$forma_pago]=$pagos[$forma_pago]+$monto;
			}
			else
			{
				$pagos[$forma_pago]=$monto;
			}
			
			$html.='<tr style="text-align:center;font-size: 7px !important;">';
			$html.='<td></td>';
			$html.='<td></td>';
			$html.='<td style="text-align:right;">'.$forma_pago.'</td>';
			$html.='<td style="text-align:right;">$ '.$monto.'</td>';
			$html.='</tr>';

			$forma_pago=$p["general_forma_de_pago_desc"];
			
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

		$html.='<tr style="text-align:center;font-size: 7px !important;">';
		$html.='<td></td>';
		$html.='<td></td>';
		$html.='<td style="text-align:right;"><strong>TOTAL</strong></td>';
		$html.='<td style="text-align:right;">$ '.$subtotal.'</td>';
		$html.='</tr>';

		if($detalle_envio)
		{
			$html.='<tr>';
			$html.='<td></td>';
			$html.='<td></td>';
			$html.='<td></td>';
			$html.='<td></td>';
			$html.='</tr>';
			
			$fecha_envio=$detalle_envio->{'fecha_hora_entrega'};
			$seccion=$detalle_envio->{'select_zona_envio'};
			$planta=$detalle_envio->{'select_planta'};
			$planta_extra=$detalle_envio->{'select_planta_extra'};

			if($planta_extra)
			{
				$planta.=' ';
			}
			else
			{
				$planta_extra='';
			}


			$html.='<tr>';
			$html.='<td colspan="4"><strong>Envio: </strong>'.$fecha_envio.' '.$seccion.' '.$planta.' '.$planta_extra.'</td>';
			$html.='</tr>';
		}

		$html.='<tr>';
		$html.='<td></td>';
		$html.='<td></td>';
		$html.='<td></td>';
		$html.='<td></td>';
		$html.='</tr>';

		$html.='</tbody>';
		$html.='</table>';

	}

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
	
	$html.='<tr><td></td><td></td><td align="right"><strong>'.$k.'</strong></td><td align="right">$ '.$p.'</td></tr>';
}


$m=explode('.',$totalF);
if(count($m)==1)
{
	$totalF.='.00';
}

$html.='<tr><td></td><td></td><td align="right"><strong></strong></td><td align=""></td></tr>';
$html.='<tr><td></td><td></td><td align="right"><strong>Total</strong></td><td align="right">$ '.$totalF.'</td></tr>';

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