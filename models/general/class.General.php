<?php
session_start();
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/connection/class.Connection.php');

class General
{
	private $connect;
	
	public $month=array(
			'01'=>'ENE',
			'02'=>'FEB',
			'03'=>'MAR',
			'04'=>'ABR',
			'05'=>'MAY',
			'06'=>'JUN',
			'07'=>'JUL',
			'08'=>'AGO',
			'09'=>'SEP',
			'10'=>'OCT',
			'11'=>'NOV',
			'12'=>'DIC');
	
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
	
	public function getDate($date)
	{
		$dateformat= new DateTime($date);
		$date=$dateformat->format('Y-m-d h:i:s a');
		
		$s=explode(' ',$date);
		$d=$s[0];
		$h=$s[1];
		$t=$s[2];
		
		$d=explode('-',$d);
		$date=$d[2].'/'.$this->month[$d[1]].'/'.$d[0].' '.$h.' '.$t;
		
		return $date;
	}
}