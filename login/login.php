<?php session_start();

include $_SERVER['REDIRECT_PATH_CONFIG'].'config.php';

include $pathProy.'login/models/class.Login.php';

if($_POST){
    
    extract($_POST);
        
    if(!empty($email) && !empty($password)){
    
        $login = new Login();
        $loginInfo = $login->auth($email, $password);        
        
        if($loginInfo){
            
            $login->insertLastLogin($loginInfo['login_id']);
            
            $_SESSION['login_session']=$loginInfo;
            header("Location: profile.php");
            exit();
        }
        else{
            
            $error = base64_encode('Los datos son incorrectos, intente nuevamente');        
            $rutaL =  $ruta."login/index.php?error=".$error;
            header("Location: ".$rutaL);
            exit();
        }        
    }
    else{        
        $error = base64_encode('Ingresa correo electrónico y contraseña para acceder al sistema');        
        $rutaL =  $ruta."login/index.php?error=".$error;
        header("Location: ".$rutaL);
        exit();
    }
}

?>