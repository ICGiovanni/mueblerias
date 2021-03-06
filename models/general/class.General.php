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
	
	public function num2letras($num, $fem = false, $dec = true)
	{
		$matuni[2]  = "dos";
		$matuni[3]  = "tres";
		$matuni[4]  = "cuatro";
		$matuni[5]  = "cinco";
		$matuni[6]  = "seis";
		$matuni[7]  = "siete";
		$matuni[8]  = "ocho";
		$matuni[9]  = "nueve";
		$matuni[10] = "diez";
		$matuni[11] = "once";
		$matuni[12] = "doce";
		$matuni[13] = "trece";
		$matuni[14] = "catorce";
		$matuni[15] = "quince";
		$matuni[16] = "dieciseis";
		$matuni[17] = "diecisiete";
		$matuni[18] = "dieciocho";
		$matuni[19] = "diecinueve";
		$matuni[20] = "veinte";
		$matunisub[2] = "dos";
		$matunisub[3] = "tres";
		$matunisub[4] = "cuatro";
		$matunisub[5] = "quin";
		$matunisub[6] = "seis";
		$matunisub[7] = "sete";
		$matunisub[8] = "ocho";
		$matunisub[9] = "nove";
		
		$matdec[2] = "veint";
		$matdec[3] = "treinta";
		$matdec[4] = "cuarenta";
		$matdec[5] = "cincuenta";
		$matdec[6] = "sesenta";
		$matdec[7] = "setenta";
		$matdec[8] = "ochenta";
		$matdec[9] = "noventa";
		$matsub[3]  = 'mill';
		$matsub[5]  = 'bill';
		$matsub[7]  = 'mill';
		$matsub[9]  = 'trill';
		$matsub[11] = 'mill';
		$matsub[13] = 'bill';
		$matsub[15] = 'mill';
		$matmil[4]  = 'millones';
		$matmil[6]  = 'billones';
		$matmil[7]  = 'de billones';
		$matmil[8]  = 'millones de billones';
		$matmil[10] = 'trillones';
		$matmil[11] = 'de trillones';
		$matmil[12] = 'millones de trillones';
		$matmil[13] = 'de trillones';
		$matmil[14] = 'billones de trillones';
		$matmil[15] = 'de billones de trillones';
		$matmil[16] = 'millones de billones de trillones';
		
		//Zi hack
		$float=explode('.',$num);
		$num=$float[0];
		
		$num = trim((string)@$num);
		if ($num[0] == '-') {
			$neg = 'menos ';
			$num = substr($num, 1);
		}else
			$neg = '';
			while ($num[0] == '0') $num = substr($num, 1);
			if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num;
			$zeros = true;
			$punt = false;
			$ent = '';
			$fra = '';
			for ($c = 0; $c < strlen($num); $c++) {
				$n = $num[$c];
				if (! (strpos(".,'''", $n) === false)) {
					if ($punt) break;
					else{
						$punt = true;
						continue;
					}
					
				}elseif (! (strpos('0123456789', $n) === false)) {
					if ($punt) {
						if ($n != '0') $zeros = false;
						$fra .= $n;
					}else
						
						$ent .= $n;
				}else
					
					break;
					
			}
			$ent = '     ' . $ent;
			if ($dec and $fra and ! $zeros) {
				$fin = ' coma';
				for ($n = 0; $n < strlen($fra); $n++) {
					if (($s = $fra[$n]) == '0')
						$fin .= ' cero';
						elseif ($s == '1')
						$fin .= $fem ? ' una' : ' un';
						else
							$fin .= ' ' . $matuni[$s];
				}
			}else
				$fin = '';
				if ((int)$ent === 0) return 'Cero ' . $fin;
				$tex = '';
				$sub = 0;
				$mils = 0;
				$neutro = false;
				while ( ($num = substr($ent, -3)) != '   ') {
					$ent = substr($ent, 0, -3);
					if (++$sub < 3 and $fem) {
						$matuni[1] = 'una';
						$subcent = 'as';
					}else{
						$matuni[1] = $neutro ? 'un' : 'uno';
						$subcent = 'os';
					}
					$t = '';
					$n2 = substr($num, 1);
					if ($n2 == '00') {
					}elseif ($n2 < 21)
					$t = ' ' . $matuni[(int)$n2];
					elseif ($n2 < 30) {
						$n3 = $num[2];
						if ($n3 != 0) $t = 'i' . $matuni[$n3];
						$n2 = $num[1];
						$t = ' ' . $matdec[$n2] . $t;
					}else{
						$n3 = $num[2];
						if ($n3 != 0) $t = ' y ' . $matuni[$n3];
						$n2 = $num[1];
						$t = ' ' . $matdec[$n2] . $t;
					}
					$n = $num[0];
					if ($n == 1) {
						$t = ' ciento' . $t;
					}elseif ($n == 5){
						$t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t;
					}elseif ($n != 0){
						$t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t;
					}
					if ($sub == 1) {
					}elseif (! isset($matsub[$sub])) {
						if ($num == 1) {
							$t = ' mil';
						}elseif ($num > 1){
							$t .= ' mil';
						}
					}elseif ($num == 1) {
						$t .= ' ' . $matsub[$sub] . 'ón';
					}elseif ($num > 1){
						$t .= ' ' . $matsub[$sub] . 'ones';
					}
					if ($num == '000') $mils ++;
					elseif ($mils != 0) {
						if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub];
						$mils = 0;
					}
					$neutro = true;
					$tex = $t . $tex;
				}
				$tex = $neg . substr($tex, 1) . $fin;
				//Zi hack --> return ucfirst($tex);
				$end_num=ucfirst($tex).' pesos '.$float[1].'/100 M.N.';
				return $end_num;
	}

	public function addZeros($monto)
	{
		$m=explode('.',$monto);
		if(count($m)==1)
		{
			$monto.='.00';
		}
		else if($m[1]>'0')
		{
			$monto=round($monto,2);
		}

		return $monto;
	}
}