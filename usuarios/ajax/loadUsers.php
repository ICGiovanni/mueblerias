<?php

    include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';

    include $pathProy.'login/models/class.Login.php';
    $userLogin = new Login();

    $users = $userLogin->getUsers($_POST['type']);
        
    if($users){

        foreach($users as $user){
            
            if($user['status_name']!='Activo'){
                $class = 'fa fa-toggle-off';
            }
            else{
                $class = 'fa fa-toggle-on';
            }
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
                    <td>".date('d/m/Y g:i:s A ', $user['created_timestamp'])."</td>
                    <td>".$user['status_name']."</td>                        
                    <td>".$user['email']."</td>
                    <td>".date('d/m/Y g:i:s A ', $user['modify_timestamp'])."</td>
                    <td>
                        <a href='#'><i class='active-user fa-2x ".$class."' id='".$user['login_id']."' data-status='".$user['status_id']."' aria-hidden='true'></i></a>&nbsp;    
                    </td>    
                    <td class='text-center'>                    
                        <a href='editUser.php?id=".  base64_encode($user['login_id'])."'><i class='fa fa-pencil'></i></a>&nbsp;&nbsp;&nbsp;    
                        <a href='#' class='borrar-user' id='".$user['login_id']."' data-name='".$user['firstName']."&nbsp;".$user['lastName']."'><i class='fa fa-trash-o'></i></a>
                    </td>
                 </tr>";
        }                                                
    }
?>    