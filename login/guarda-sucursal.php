<?php session_start();

include $_SERVER['REDIRECT_PATH_CONFIG'].'config.php';

include $pathProy.'login/models/class.Login.php';

if($_POST){
    
    extract($_POST);

    if(isset($sucursal_id)&& $sucursal_id!=0){
        $_SESSION['login_session']['sucursal_id'] = $sucursal_id;
        header("Location: profile.php");
    }else{
        $error = base64_encode('Selecciona una sucursal valida');                        
        $rutaL =  $ruta."login/sucursal.php?error=".$error;
        header("Location: ".$rutaL);
        exit();
    }
}

?>