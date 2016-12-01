<?php

    include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';

    include $pathProy.'login/models/class.Login.php';
    include $pathProy.'models/general/class.General.php';
    
    $general = new General();
    $userLogin = new Login();

    $users = $userLogin->getUsers($_POST['type']);
        
    if($users){

        foreach($users as $user){
            
            if($user['status_name']!='Activo'){
                $class = 'fa fa-thumbs-o-down';
            }
            else{
                $class = 'fa fa-thumbs-o-up';
            }
            echo "<tr>
                    <td>
                        <div class='row'>
                            <div class='col-md-3'><img class='img-circle' src='".$raizProy.$user['url_image']."' height='40px'/></div>
                            <div class='col-md-9'>
                                <div><b>".$user['firstName']."&nbsp;".$user['lastName']."</b></div>
                                <div> <small>".$user['profile_name']."</small></div>    
                            </div>
                        </div>    
                    </td>
                    <td>".$user['email']."</td>
                    <td>".$general->getDate(date('Y-m-d H:i:s', $user['created_timestamp']))."</td>
                    <td>".$general->getDate(date('Y-m-d H:i:s', $user['modify_timestamp']))."</td>
                    <td>".$user['status_name']."</td>                                            
                    <td class='text-center'>
                        <i role='button' class='active-user fa-2x ".$class."' id='".$user['login_id']."' data-status='".$user['status_id']."' aria-hidden='true'></i>&nbsp;    
                    </td>    
                    <td class='text-center'>                    
                        <a href='editUser.php?id=".  base64_encode($user['login_id'])."'><i class='fa fa-pencil'></i></a>&nbsp;&nbsp;&nbsp;    
                        <a href='#' class='borrar-user' id='".$user['login_id']."' data-name='".$user['firstName']."&nbsp;".$user['lastName']."'><i class='fa fa-trash-o'></i></a>
                    </td>
                 </tr>";
        }                                                
    }
?>    