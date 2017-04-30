<?php
@session_start();
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/connection/class.Connection.php');

class General
{
	private $connect;
	
	public $month=array(
			'01'=>'Ene',
			'02'=>'Feb',
			'03'=>'Maz',
			'04'=>'Abr',
			'05'=>'May',
			'06'=>'Jun',
			'07'=>'Jul',
			'08'=>'Ago',
			'09'=>'Sep',
			'10'=>'Oct',
			'11'=>'Nov',
			'12'=>'Dic');
	
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
	
	function getMetodosPago(){
		$sql="SELECT general_forma_de_pago_id, general_forma_de_pago_desc
				FROM general_formas_de_pago
				WHERE 1";
		
		$statement=$this->connect->prepare($sql);		
		$statement->execute();
		$result=$statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	public function getDate($date)
	{
		$dateformat= new DateTime($date);
		$date=$dateformat->format('Y-m-d h:i a');
		
		$s=explode(' ',$date);
		$d=$s[0];
		$h=$s[1];
		$t=$s[2];
		
		$d=explode('-',$d);
		$date='<b>'.$d[2].'/'.$this->month[$d[1]].'/'.$d[0].'</b><br>'.$h.' '.$t;
		
		return $date;
	}
	
	public function getDateSimple($date)
	{
		$dateformat= new DateTime($date);
		$date=$dateformat->format('Y-m-d h:i a');
		
		$s=explode(' ',$date);
		$d=$s[0];
		$h=$s[1];
		$t=$s[2];
		
		$d=explode('-',$d);
		$date=$d[2].'/'.$this->month[$d[1]].'/'.$d[0].' '.$h.' '.$t;
		
		return $date;
	}
	
	public function getOnlyDate($date)
	{
		$dateformat= new DateTime($date);
		$date=$dateformat->format('Y-m-d');
		
		$d=explode('-',$date);
		$date=$d[2].'/'.$this->month[$d[1]].'/'.$d[0];
		
		return $date;
	}
}