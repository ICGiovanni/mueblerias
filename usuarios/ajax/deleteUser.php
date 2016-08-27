<?php
    include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';

    include $pathProy.'login/models/class.Login.php';
    $userLogin = new Login();
    
    echo $id = $_POST['id'];
    
    $userLogin->deleteUser($id);
?>    