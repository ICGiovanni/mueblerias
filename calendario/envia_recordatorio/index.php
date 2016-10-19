<?php

require_once $_SERVER['REDIRECT_PATH_CONFIG'].'config.php';
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'calendario/models/class.Calendario.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/phpmailer/class.phpmailer.php');

$objCalendario = new Calendario();
$rowRecordatorios = $objCalendario->getRecordatorios();

//print_r($rowRecordatorios);
while ( list (,$dataRecordatorio) = each ($rowRecordatorios)){
	$id_reminder = $dataRecordatorio["evento_id"];
	$title_reminder = $dataRecordatorio["evento_nombre"];
	$body_reminder = $dataRecordatorio["evento_desc"];
	
	/*email*/
		$mail = new PHPMailer();
		$to = $dataRecordatorio["email"];
		
		$subject = "Admin Globmint - Recordatorio - ".$dataRecordatorio["evento_nombre"];
		$msjContent = "Estimado Usuario, le recordamos el siguiente evento programado <br>";
		$mail->SetFrom('info@globmint.com','Info Globmint');
		
		$mail->AddReplyTo('info@globmint.com',"");
		$mail->AddAddress($to, "");
		$mail->AddAddress("shingoo_n@yahoo.com.mx", "");
		
		$mail->Subject=$subject;
		
		$msj = "<html>
			<body style='background-color: #E7EAEC'>				
				<div style='background-color: #127AAE;'>&nbsp;</div>
				<div>	
					<br><br>					
					<table align='center'>
					<tr>
						<td rowspan='5' >
							<img src='http://globmint.com/img/logo_globmint2.png' width='100px' alt='Globmint' style='margin:10px;'/>
						</td>
					</tr>
						<tr>
							<td><b>".$msjContent."</b><br><br></td>
						</tr>
						<tr>
							<td><b>NOMBRE DEL EVENTO:</b> ".$dataRecordatorio["evento_nombre"]." </td>
						</tr>
						<tr>
							<td><b>FECHA DEL EVENTO:</b> ".$dataRecordatorio["evento_fecha"]." </td>
						</tr>
						<tr>
							<td><b>DESCRIPCION:</b> ".$dataRecordatorio["evento_desc"]." <br></td>
						</tr>
						<tr>
							<td colspan='2'><b>-----------------------------------------------------------------------------------------------------------</b></td>
						</tr>
					</table>
					
					<br>
				</div>
				<div style='background-color: #154A76;'>
				<p style='text-align: center; padding:16px 0px; '>
					   <b><a href='http://globmint.com/' target='_blank' style='color:#fff;'>http://globmint.com/ - Ir al Administrador</a></b>
				</p>
				</div>
			</body>
		</html>";

		$mail->MsgHTML(utf8_decode($msj));		
		//$mail->AddAttachment($fileA);
		
	
		if(!$mail->Send()){
			
			inLogSent(date('l jS \of F Y h:i:s A')." El recordatorio: '".$dataRecordatorio["evento_nombre"]."' no pudo ser enviado al correo ".$to." - Mailer Error: ".$mail->ErrorInfo);
			$objCalendario->changeOnlyStatus($dataRecordatorio["evento_id"], 2); //marca como recordatorio enviado pero no entregado...
		}
		else{
			
			inLogSent(date('l jS \of F Y h:i:s A')." El recordatorio: '".$dataRecordatorio["evento_nombre"]."' ha sido enviado al correo ".$to." exitosamente <br>");
			$objCalendario->changeOnlyStatus($dataRecordatorio["evento_id"], 1); //marca como recordatorio entregado...
		}

		//if(file_exists($fileA)){
			//unlink($fileA);
		//}

	/*email*/
}

function inLogSent($newLine){
	$file_log = $_SERVER["REDIRECT_PATH_CONFIG"]."calendario/envia_recordatorio/log_envia_".date("Y_m").".html";
	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
		$file_log = "C:".str_replace("/","\\",$file_log);
	}
	$actual = file_get_contents($file_log);
	$actual .= $newLine;
	file_put_contents($file_log, $actual);
}