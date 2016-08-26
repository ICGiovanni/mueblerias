<?php
session_start();
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/connection/class.Connection.php');

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
		$sql="INSERT INTO publicidad VALUES('',:nombre,:text)";
		
		$statement=$this->connect->prepare($sql);
		
		$statement->bindParam(':nombre', $params['nombre'], PDO::PARAM_STR);
		$statement->bindParam(':text', $params['text'], PDO::PARAM_STR);
		
		$statement->execute();
		
		return $this->connect->lastInsertId();
	}
}