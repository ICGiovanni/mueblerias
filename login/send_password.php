<?php   ob_start();
        include $_SERVER['REDIRECT_PATH_CONFIG'].'config.php';

        include $pathProy.'login/models/class.Login.php';

        if($_POST){
            extract($_POST);

            if(!empty($email)){
                $login = new Login();
                $userLogin = $login->checkMailRegistered($email);

                if($userLogin){

                    //Enviar E-mail

                    $success = base64_encode('Se ha enviado un correo con tu nueva contraseña');
                    $rutaL =  $ruta."login/forgot_password.php?success=".$success;
                    header("Location: ".$rutaL);
                }
                else{
                    $error = base64_encode('Correo electrónico no registrado');
                    $rutaL =  $ruta."login/forgot_password.php?error=".$error;
                    header("Location: ".$rutaL);
                }
            }    
            else{
                $error = base64_encode('Ingresa un correo electrónico para restablecer tu contraseña');        
                $rutaL =  $ruta."login/forgot_password.php?error=".$error;
                header("Location: ".$rutaL);
            }
        }
        
?>