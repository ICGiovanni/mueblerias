<?php session_start();

require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/connection/class.Connection.php');

class Ventas {
    
    private $connect;
	
    function __construct()
    {
        $c=new Connection();
        $this->connect=$c->db;
        $this->name_table = 'ventas';
    }
    
    
    public function nuevaVenta(){
        
    }
    
}
