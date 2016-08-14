<?php
date_default_timezone_set("America/Mexico_City");

class Connection
{
	public $db;

	function __construct()	
	{
        $this->dbhost = DATA_BASE_HOST;
        $this->dbname = DATA_BASE_NAME;
        $this->dbuser = DATA_BASE_USER;
        $this->dbpass = DATA_BASE_PWD;

		try
		{
			$this->db=new PDO('mysql:dbname='.$this->dbname.';host='.$this->dbhost, $this->dbuser, $this->dbpass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (PDOException $e)
		{
			echo 'Connection failed: ' . $e->getMessage();
		}		
    }
	
	function __destruct()
	{
		/*try
		{
            $this->db=null;
        }
		catch (PDOException $e)
		{
            die($e->getMessage());
        }*/
   	} 
	
}
?>