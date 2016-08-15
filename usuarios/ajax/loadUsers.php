<?php

    include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';

    include $pathProy.'login/models/class.Login.php';
    $userLogin = new Login();

    $users = $userLogin->getUsers($_POST['type']);
    if($users){

        foreach($users as $user){
            echo "<tr>
                    <td>
                        <div class='row'>
                            <div class='col-md-3'>".$user['url_image']."</div>
                            <div class='col-md-9'>
                                <div>".$user['firstName']."&nbsp;".$user['lastName']."</div>
                                <div> <small>".$user['profile_name']."</small></div>    
                            </div>
                        </div>    
                    </td>
                    <td>".date('d/m/Y H:i:s ', $user['created_timestamp'])."</td>
                    <td>".$user['status_name']."</td>
                    <td>".$user['email']."</td>
                    <td class='text-center'>
                        <button class='btn btn-warning'><i class='fa fa-pencil'></i></button>
                    </td>
                    <td class='text-center'>
                        <button class='btn btn-danger'><i class='fa fa-times'></i></button>
                    </td>
                 </tr>";
        }                                                
    }
?>    