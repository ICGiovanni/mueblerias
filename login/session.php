<?php ob_start();
    session_start();// Starting Session

    $login_session =$_SESSION['login_session'];

    
    include $pathProy.'login/models/class.Login.php';

    if(!isset($login_session)){
        header('Location: '.$raizProy);
    }

    else{
        
        $inslogin = new Login();
        $pages = $inslogin->pagesProfile($login_session['profile_id']);
		
        $inArrayPages = array();
        foreach($pages as $page){
            array_push($inArrayPages, $raizProy.$page['page']);
        }

        $pagina = $_SERVER['SCRIPT_NAME'];

        if(!in_array($pagina, $inArrayPages)){
            header('Location: '.$raizProy.'login/profile.php');
        }

    }



?>