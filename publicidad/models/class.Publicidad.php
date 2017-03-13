<?php
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/connection/class.Connection.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'clientes/models/class.Clientes.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/phpmailer/class.phpmailer.php');


date_default_timezone_set ('America/Mexico_City');

class Publicidad
{
	private $connect;
	
	function __construct()
	{
		$c=new Connection();
		$this->connect=$c->db;
	}
	
	public function InsertarPublicidad($params)
	{
		$date=date("Y-m-d h:i:s");
		$sql="INSERT INTO publicidad VALUES('',:nombre,:text,:date)";
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':nombre', $params['nombre'], PDO::PARAM_STR);
		$statement->bindParam(':text', $params['text'], PDO::PARAM_STR);
		$statement->bindParam(':date', $date, PDO::PARAM_STR);
		
		
		$statement->execute();
		
		return $this->connect->lastInsertId();
	}
	
	public function ActualizarPublicidad($params)
	{
		$sql="UPDATE publicidad SET nombre=:nombre,contenido=:text WHERE id_publicidad=:id_publicidad";
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':nombre', $params['nombre'], PDO::PARAM_STR);
		$statement->bindParam(':text', $params['text'], PDO::PARAM_STR);
		$statement->bindParam(':id_publicidad', $params['id'], PDO::PARAM_STR);
		
		$statement->execute();
		return $params['id'];
	}
	
	public function BorrarPublicidad($id_publicidad)
	{
		$sql="DELETE FROM publicidad WHERE id_publicidad=:id_publicidad";
	
		$statement=$this->connect->prepare($sql);
		$statement->bindParam(':id_publicidad', $id_publicidad, PDO::PARAM_STR);
	
		$statement->execute();
		return $id_publicidad;
	}
	
	public function GetPublicidad($id_publicidad="",$order="")
	{
		if($id_publicidad)
		{
			$where="WHERE p.id_publicidad='".$id_publicidad."'";
		}
		else
		{
			$where="";
		}
	
		if($order)
		{
			$orderby="ORDER BY ".$order;
		}
		else
		{
			$orderby="ORDER BY p.id_publicidad";
		}
	
	
		$sql="SELECT p.id_publicidad, p.nombre,
				p.contenido,p.fecha
				FROM publicidad p
				$where
				$orderby";
	
		$statement=$this->connect->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
	
		return $result;
	}
	
	public function SendPublicidad($id_publicidad,$clientesE)
	{
		$clientes=new Clientes();
		$dataP=$this->GetPublicidad($id_publicidad);
		$nombre=$dataP[0]["nombre"];
		$contenido=$dataP[0]["contenido"];		
		
		$mensaje='<!DOCTYPE html>
					<html>
					<head>
					<meta>
					<title></title>
					</head>
					<body>';
		$mensaje.=$contenido;
		$mensaje.='</body>
					</html>';
		
		/*$mensaje='<!DOCTYPE html>
					<html>
					<head>
					<meta>
					<title></title>
					</head>
					<body>';
		$mensaje.=$contenido;
		$mensaje.='</body>
					</html>';
		
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From: InfoGlobmint <info@globmint.com>\r\n";
		$headers .= "Return-path: info@globmint.com\r\n";
		
		$id_cliente="";
		foreach($clientesE as $c)
		{
			if(!$id_cliente)
			{
				$id_cliente.=$c["id"];
			}
			else
			{
				$id_cliente.=",".$c["id"];
			}
		}
		
		$result=$clientes->GetClientes($id_cliente);
		
		$email="";
		foreach($result as $r)
		{
			if($r["email"])
			{
				if($email=="")
				{
					$email=$r["email"];
				}
				else
				{
					$email.=",".$r["email"];
				}
			}
		}
		die($email);
		return mail($email,$nombre,$mensaje,$headers);*/
		
		//
		/*$mail->isSMTP();
		$mail->SMTPDebug = 2;
		$mail->Debugoutput = 'html';
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
		$mail->SMTPSecure = 'tls';
		$mail->SMTPAuth = true;
		$mail->Username = "umedina86@gmail.com";
		$mail->Password = "More1989";*/
		//
		
		$mail=new PHPMailer();
		foreach($clientesE as $c)
		{
			$result=$clientes->GetEmailsClient($c["id"]);
			foreach($result as $r)
			{
				echo $r["email"]."\n";
				$mail->AddAddress($r["email"], "");
			}
		}
		
		$mail->setFrom('info@globmint.com','Info Globmint');
		$mail->Subject=utf8_decode($nombre);
		$mail->MsgHTML(utf8_decode($mensaje));
		
		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo 'Message has been sent';
		}
		
	}
}