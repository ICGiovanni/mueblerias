<?php   ob_start();

        include $_SERVER['REDIRECT_PATH_CONFIG'].'config.php';    

        include $pathProy.'login/session.php';

        if(isset($login_session['profile_id'])) {
            //para el caso de 1
            if ($login_session['profile_id'] == 1) {
                echo "redirigir pagina Inicial profile_id 1";
            } //para el caso de 2
            else if ($login_session['profile_id'] == 2) {
                echo "redirigir pagina Inicial profile_id 2";
            } //para el caso 3
            else if ($login_session['profile_id'] == 3) {
                echo "redirigir pagina Inicial profile_id 3";
            }
        }
        else{        
            header('location: '. $raizProy);
        }
?>