<?php session_start();

include $_SERVER['REDIRECT_PATH_CONFIG'].'config.php';

include $pathProy.'login/models/class.Login.php';

if($_POST){
    
    extract($_POST);
        
    if(isset($email) && !empty($email) && !empty($password)){
        $stringEmail = $email;
        if(!stristr($email, '@globmint.com')){
            $email = $email.'@globmint.com';
        }
        
        $login = new Login();
        $loginInfo = $login->auth($email, $password);        
        
        if($loginInfo){
            
            $login->insertLastLogin($loginInfo['login_id']);           
            $_SESSION['login_session']=$loginInfo;                        
            
            header("Location: sucursal.php");
            exit();
        }
        else{
            
            $error = base64_encode('Los datos son incorrectos, intente nuevamente');        
            $emailUser = base64_encode($stringEmail);
            $rutaL =  $ruta."login/index.php?error=".$error.'&email='.$emailUser;
            header("Location: ".$rutaL);
            exit();
        }        
    }
    else{                 
        $error = base64_encode('Ingresa correo electrónico y contraseña para acceder al sistema');                        
        $rutaL =  $ruta."login/index.php?error=".$error.'&email='.base64_encode($email);
        header("Location: ".$rutaL);
        exit();
    }        
    
}

?>