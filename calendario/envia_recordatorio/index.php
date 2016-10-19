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
			<body style='background-color: #fff'>
				<p style='text-align: center; width: 300px'>
					<img src='http://globmint.com/img/logo_globmint2.png' width='200px' alt='Globmint'/>
				</p>
				<div style='background-color: #D71921'>&nbsp;</div>
				<div>	
					<br><br>					
					<table align='center'>
						<tr>
							<td><b>".$msjContent."</b></td>
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
					</table>
					--------------------------------------------------------------------------------------------------------
					<br>
				</div>
				<div style='background-color: #D71921'>
				<p style='text-align: center; padding:16px 0px; color:#fff;'>
					   <b>http://globmint.com/ <- Ir al Administrador </b>
				</p>
				</div>
			</body>
		</html>";

		$mail->MsgHTML(utf8_decode($msj));		
		//$mail->AddAttachment($fileA);
		
	
		if(!$mail->Send()){
			echo "El recordatorio: '".$dataRecordatorio["evento_nombre"]."' no pudo ser enviado al correo ".$to." - Mailer Error: ".$mail->ErrorInfo;
			$objCalendario->changeOnlyStatus($dataRecordatorio["evento_id"], 2); //marca como recordatorio enviado pero no entregado...
		}
		else{			
			echo "El recordatorio: '".$dataRecordatorio["evento_nombre"]."' ha sido enviado al correo ".$to." exitosamente <br>";
			$objCalendario->changeOnlyStatus($dataRecordatorio["evento_id"], 1); //marca como recordatorio entregado...
		}

		//if(file_exists($fileA)){
			//unlink($fileA);
		//}

	/*email*/
}