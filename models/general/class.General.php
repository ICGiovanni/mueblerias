<?php
session_start();
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/connection/class.Connection.php');

class General
{
	private $connect;
	
	function __construct()
	{
		$c=new Connection();
		$this->connect=$c->db;
	}
	
	function getStates()
	{
		$sql="SELECT e.id_estado,e.estado
				FROM estados e
				WHERE e.estado!=''
				ORDER BY e.estado ASC";
		
		$statement=$this->connect->prepare($sql);		
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
}