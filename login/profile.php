<?php   ob_start();
        
        include $_SERVER['REDIRECT_PATH_CONFIG'].'config.php';    

        include $pathProy.'login/session.php';

        if(isset($login_session['profile_id'])) {
            
            if(isset($login_session['sucursal_id'])){
                //para el caso de 1
                if ($login_session['profile_id'] == 1) {

                    $rutaSend = $ruta.'usuarios/index.php';
                    header("Location: ".$rutaSend);

                } //para el caso de 2
                else {
                    $rutaSend = $ruta.'gastos/';
                    header("Location: ".$rutaSend);
                    //echo "redirigir pagina Inicial profile_id 2";
                } //para el caso 3
                //else if ($login_session['profile_id'] == 3) {
                //    echo "redirigir pagina Inicial profile_id 3";
                //}
            }else{
                header('Location: '. $ruta.'login/sucursal.php');
            }    
        }
        else{                    
            header('Location: '. $ruta);
        }
?>