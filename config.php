<?php


if($_SERVER["SERVER_NAME"]=="localhost"){
	
	define("DATA_BASE_HOST","localhost");
	define("DATA_BASE_NAME","pentaglobal");
	define("DATA_BASE_USER","root");
	define("DATA_BASE_PWD","");
	
	define("FINAL_URL",$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["SERVER_NAME"].'/globmint.com/');
        
        
        $ruta = 'http://localhost/mueblerias/';
        $pathProy = dirname(__FILE__);
        $raizProy = "/mueblerias/";
        
        
}
else{
    
        $ruta = 'http://globmint.com/';
        $pathProy = '/kunden/homepages/1/d642566705/htdocs/';
        $raizProy = "/";
    
}



?>

