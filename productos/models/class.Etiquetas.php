<?php
include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'tcpdf/tcpdf.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'tcpdf/tcpdf_barcodes_1d.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/general/class.General.php');


class Etiquetas
{
	public function GenerarEtiquetas($pos,$products)
	{
		$totalE=count($products);
		
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetMargins(6, 20, 15,false);
		//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetAutoPageBreak(TRUE,-3);
		$pdf->SetFont('helvetica', '', 7);
		
		$cont=1;
		$style = array(
				'position' => '',
				'align' => 'C',
				'stretch' => false,
				'fitwidth' => true,
				'cellfitalign' => 'C',
				'border' => false,
				'hpadding' => 'auto',
				'vpadding' => 'auto',
				'fgcolor' => array(0,0,0),
				'bgcolor' => false, //array(255,255,255),
				'text' => true,
				'font' => 'helvetica',
				'fontsize' => 7,
				'stretchtext' => 4
		);
		
		$t=1;
		$c=1;
		$e=1;
		$pdf->AddPage();
		
		foreach($products as $p)
		{
			$sku=$p['sku'];
			$name=$p['name'];
			$proveedor=$p['proveedor'];
						
			$x=$pdf->GetX();
			$y=$pdf->GetY();
			
			if($c==1)
			{
				$y=$y-3;
			}
			
			if($sku)
			{
				$pdf->write1DBarcode($sku, 'C39', $x+6, $y,55, 14, 0.6, $style, 'M');
			}
			
			$pdf->SetXY($x,$y-5);
			//$pdf->Cell(66, 27, "$ ".$price, 0, 0, 'C', FALSE, '', 0, FALSE, 'C', 'B');
			
			
			if($sku)
			{
				//$text="<br><br><br><br><br>";
				$text=$proveedor."<br>";
				$text.=$name."<br>";
				$text.="<br><br><br><br><br>";
				
				
			}
			else 
			{
				$text="";
			}
			
			/*if($price)
			{
				$text.='$'.$price;
			}*/
			
			
			$pdf->MultiCell(66,27,$text, 0, 'C', false, 1,'', '', true,0,true,true,0,'T',false);
			$pdf->SetXY($x+66,$y);
			
			//echo $x." ".$y."<br>";
			
			if($c==3)
			{
				
				$pdf->Ln();
				$c=1;
			}
			else
			{
				$c++;
			}
			
			if($e==30 && $t<$totalE)
			{
				$pdf->AddPage();
				$e=1;
			}
			else
			{
				$e++;
			}
			$t++;
		}
		
		$js = 'print(true);';
		
		//$pdf->IncludeJS($js);
		
		$pdf->Output($_SERVER["REDIRECT_PATH_CONFIG"].'productos/barcodes.pdf', 'F');
	}
	
}