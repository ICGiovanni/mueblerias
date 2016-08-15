<?php   session_start();
        error_reporting(E_ALL);
        
        if(!isset($_SESSION['login_session'])){    
            
            header("Location: ".$ruta."login/logout.php");            
            exit();
        }else{            
            $login_session = $_SESSION['login_session'];
            include $pathProy.'login/models/class.Login.php';
            $inslogin = new Login();
            
            $pages = $inslogin->pagesProfile($login_session['profile_id']);

            $inArrayPages = array();
            foreach($pages as $page){
                array_push($inArrayPages, $page['page']);
            }

            $pagina = trim($_SERVER['SCRIPT_NAME'],'/');

            if(!in_array($pagina, $inArrayPages)){            
               header("Location: ".$ruta."login/profile.php");
            }            
            
        }        
?>