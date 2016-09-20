<?php

if($_SERVER["SERVER_NAME"]=="dev-globmint.com" || $_SERVER["SERVER_NAME"]=="localhost"){
	
    define("DATA_BASE_HOST","localhost");
    define("DATA_BASE_NAME","pentaglobal");
    define("DATA_BASE_USER","root");
    define("DATA_BASE_PWD","");
	
    define("FINAL_URL",$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["SERVER_NAME"].'/');

    $ruta = 'http://dev-globmint.com/';

    //si en el entorno local no funciona esta variable colocar la ruta absoluta
    //ejemplo: $pathProy = C:/Xampp/htdocs/
    $pathProy = dirname(__FILE__).'/';   
    
    $raizProy = "/";
    //$raizProy = "/globmint.com/";
}
else{
    define("DATA_BASE_HOST","db642823290.db.1and1.com");
    define("DATA_BASE_NAME","db642823290");
    define("DATA_BASE_USER","dbo642823290");
    define("DATA_BASE_PWD","Gl0bm1nt2016!");

    define("FINAL_URL",$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["SERVER_NAME"].'/globmint.com/');

    $ruta = 'http://globmint.com/';
    $pathProy = '/kunden/homepages/1/d642566705/htdocs/';
    $raizProy = "/";
}

?>