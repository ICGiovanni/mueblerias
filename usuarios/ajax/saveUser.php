<?php
    include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';

    include $pathProy.'login/models/class.Login.php';
    $userLogin = new Login();
    
    $data = $_POST;
    
    echo "se guardo Usuario Numero: ".$userLogin->saveUser($data);
?>    