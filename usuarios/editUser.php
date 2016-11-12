<?php   include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';

        include $pathProy.'login/models/class.Login.php';
        require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/general/class.General.php');
                
        $userLogin = new Login();
        
        $profiles = $userLogin->getProfiles();
        $sucursales = $userLogin->getSucursales();
        
        if(isset($_GET['id'])){
            $userId = base64_decode($_GET['id']);
        }
        else{
            header("location: index.php");
        }
        $infoUser = $userLogin->getUsers($userId);
        $infoUser = end($infoUser);
        
        $address = $userLogin->getAddress($infoUser['address_id']);
        
        $telefonos = $userLogin->getPhones($userId);
        

        $general=new General();       
        $estados = $general->getStates();
        
        //include $pathProy.'login/session.php';
        include $pathProy.'/header2.php';
        include $pathProy.'/menu.php';
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Control de Usuarios</h2>
        <ol class="breadcrumb">
            <li>
                <a href="">Usuarios</a>
            </li>
            <li class="active">
                <strong>Editar Usuario</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">

        </div>
    </div>
</div> 
<div class="clear">&nbsp;</div>      
<div class="row">    
    <div class="col-lg-12">        
        <div class="animated fadeIn">                                    
            <div class="row">
                <div class="col-md-3 text-right">
                    <label for="firstName" class="control-label">Nombre:</label>
                </div>
                <div class="col-md-5">
                    <input type="text" id="firstName" value="<?php echo $infoUser['firstName'] ?>" class="form-control" >
                </div>    
            </div>
            <div class="clear">&nbsp;</div>
            <div class="row">
                <div class="col-md-3 text-right">
                    <label class="control-label">Apellido paterno:</label>
                </div>
                <div class="col-md-5">
                    <input type="text" id="lastName" value="<?php echo $infoUser['lastName'] ?>"  class="form-control" >
                </div>    
            </div>                    
            <div class="clear">&nbsp;</div>
            <div class="row">
                <div class="col-md-3 text-right">
                    <label class="control-label">Apellido materno:</label>
                </div>
                <div class="col-md-5">
                    <input type="text" id="secondLastName" value="<?php echo $infoUser['secondLastName'] ?>"  class="form-control" >
                </div>    
            </div>
            <div class="clear">&nbsp;</div>
            <div class="row">
                <div class="col-md-3 text-right">
                    <label class="control-label">Correo electrónico:</label>
                </div>
                <div class="col-md-5">
                    <input type="text" id="email" value="<?php echo $infoUser['email'] ?>" class="form-control" >
                </div>    
            </div>
            <div class="clear">&nbsp;</div>
            <div class="row">
                <div class="col-md-3 text-right">
                    <label class="control-label">Contraseña:</label>
                </div>
                <div class="col-md-5">
                    <input type="password" id="password" value="******" class="form-control" >
                </div>    
            </div>                    
            <div class="clear">&nbsp;</div>            
            <div class="row">
                <div class="col-md-3 text-right">
                    <label class="control-label">Perfil:</label>
                </div>
                <div class="col-md-5">
                    <select id="perfil" class="form-control">                        
                        <?php 
                        foreach($profiles as $profile){
                            $select = '';
                            if($infoUser['profile_id']==$profile['profile_id']){
                                $select = "selected";
                            }
                            echo "<option value='".$profile['profile_id']."' ".$select.">".$profile['profile_name']."</option>";
                        }
                        ?>                        
                    </select>
                </div>    
            </div>                    
            <div class="clear">&nbsp;</div>
            <div class="row">
                <div class="col-md-3 text-right">
                    <label class="control-label">Sucursal:</label>
                </div>
                <div class="col-md-5">
                    <select id="sucursal" class="form-control">
                        <option value="0">Selecciona una sucursal</option>
                        <?php 
                        foreach($sucursales as $sucursal){
                            $select = '';
                            if($infoUser['sucursal_id']==$sucursal['sucursal_id']){
                                $select = "selected";
                            }
                            echo "<option value='".$sucursal['sucursal_id']."' ".$select.">".$sucursal['sucursal_name']."</option>";
                        }
                        ?> 
                    </select>
                </div>    
            </div>                                                        
            <div class="clear">&nbsp;</div>
            <div class="row">
                <div class="col-md-3 text-right">
                    <label class="control-label">Comision:</label>
                </div>
                <div class="col-md-5">
                    <input class="form-control" id="comision" value="<?php echo $infoUser['comision'] ?>" placeholder="%" type="text">
                </div>    
            </div>                    
            <div class="clear">&nbsp;</div>
            <div class="row">
                <div class="col-md-3 text-right">
                    <label class="control-label">Salario:</label>
                </div>
                <div class="col-md-5">
                    <input class="form-control" id="salario" value="<?php echo $infoUser['salary'] ?>" type="text">
                </div>                            
            </div>  
                                             
            <?php 
            $i=0;
            if(is_array($telefonos))
            foreach($telefonos as $telefono){
            ?>
            <div>
            <div class="clear">&nbsp;</div>
            <div class="row">
                <div class="col-md-3 text-right">
                    <?php 
                        if($i==0){
                    ?>
                    <label class="control-label">Telefono:</label>
                    <?php
                        }
                    ?>    
                </div>
                <div class="col-md-2">                            
                    <input class="form-control" id="telefono" name="telefono[]" value="<?php echo $telefono['number'] ?>" type="text">                                            
                </div>    
                <div class="col-md-2">
                    <select id="phoneType" name="phoneType[]" class="form-control">
                        <option value="1" <?php if($telefono['phone_type_id']==1){echo "selected";}?>>Celular</option>
                        <option value="2" <?php if($telefono['phone_type_id']==2){echo "selected";}?>>Casa</option>
                        <option value="3" <?php if($telefono['phone_type_id']==3){echo "selected";}?>>Oficina</option>
                        <option value="4" <?php if($telefono['phone_type_id']==4){echo "selected";}?>>Otro</option>
                    </select>
                </div>
                <div class="col-md-1">                            
                    <?php 
                        if($i==0){
                    ?>
                    <button class="form-control" id="agregarTelefono" value="" placeholder="Telefono" type="button"><i class="fa fa-plus"></i></button>
                    <?php
                        }
                        else{
                    ?>   
                    <button class='form-control deletePhone' value='' type='button'><i class='fa fa-times'></i></button>
                    <?php
                        }
                    ?>
                </div>    
            </div>
            </div>
            <?php
            $i++;
            }
            ?> 
            <div>
            <div class="clear">&nbsp;</div>
            <div class="row">
                <div class="col-md-3 text-right">
                    
                    <label class="control-label">Telefono:</label>
                     
                </div>
                <div class="col-md-2">                            
                    <input class="form-control" id="telefono" name="telefono[]" value="" type="text">                                            
                </div>    
                <div class="col-md-2">
                    <select id="phoneType" name="phoneType[]" class="form-control">
                        <option value="1">Celular</option>
                        <option value="2">Casa</option>
                        <option value="3">Oficina</option>
                        <option value="4">Otro</option>
                    </select>
                </div>
                <div class="col-md-1">                                               
                    <button class="form-control" id="agregarTelefono" value="" placeholder="Telefono" type="button"><i class="fa fa-plus"></i></button>                    
                </div>    
            </div>
            </div>  
            <div class="row" id="newPhone">

            </div>
            <div class="clear">&nbsp;</div>
            <div class="row">
                <div class="col-md-3 text-right">
                    <label class="control-label">Fecha de nacimiento:</label>
                </div>
                <div class="col-md-5">
                    <div class="form-group" id="data_1">            
                        <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input class="form-control" value="<?php echo $infoUser['birthdate'] ?>" type="text" id="fechaNacimiento">
                        </div>
                    </div>
                </div>                            
            </div>
            <div class="clear">&nbsp;</div>
            <div class="row">
                <div class="col-md-3 text-right">
                    <label class="control-label">Calle:</label>
                </div>
                <div class="col-md-5">                            
                    <input class="form-control" id="calle" name="calle" value="<?php echo $address['street'] ?>" type="text">                            
                </div>                            
            </div>
            <div class="clear">&nbsp;</div>
            <div class="row">
                <div class="col-md-3 text-right">
                    <label class="control-label">No. Exterior:</label>
                </div>
                <div class="col-md-1">                            
                    <input class="form-control" id="numExt" name="numExt" value=" <?php echo $address['number'] ?>" type="text">                            
                </div>                                                    
                <div class="col-md-2 text-right">
                    <label class="control-label">No. Interior:</label>
                </div>
                <div class="col-md-1">                            
                    <input class="form-control" id="numInt" name="numInt" value="<?php echo $address['int_number'] ?>" type="text">                            
                </div>
            </div>
            <div class="clear">&nbsp;</div>
            <div class="row">
                <div class="col-md-3 text-right">
                    <label class="control-label">Colonia:</label>
                </div>
                <div class="col-md-5">                            
                    <input class="form-control" id="colonia" name="colonia" value="<?php echo $address['neighborhood'] ?>" type="text">                            
                </div>                            
            </div>
            <div class="clear">&nbsp;</div>
            <div class="row">
                <div class="col-md-3 text-right">
                    <label class="control-label">C.P.</label>
                </div>
                <div class="col-md-5">                            
                    <input class="form-control" id="cp" name="cp" value="<?php echo $address['zip_code'] ?>" type="text">                            
                </div>                            
            </div>
            <div class="clear">&nbsp;</div>
            <div class="row">
                <div class="col-md-3 text-right">
                    <label class="control-label">Municipio</label>
                </div>
                <div class="col-md-5">                            
                    <input class="form-control" id="municipio" name="municipio" value="<?php echo $address['municipality'] ?>" type="text">                            
                </div>                            
            </div>
            <div class="clear">&nbsp;</div>
            <div class="row">
                <div class="col-md-3 text-right">
                    <label class="control-label">Estado</label>
                </div>
                <div class="col-md-5">                            
                    <select id="estado" name="estado" class="form-control m-b">
                        <option value="0">Selecciona un estado</option>
                        <?php 
                        foreach($estados as $estado){
                            $select = '';
                            if($estado['id_estado']==$address['state']){
                                $select = "selected";
                            }
                            echo "<option value='".$estado['id_estado']."' ".$select.">".$estado['estado']."</option>";
                        }
                        ?>
                    </select>
                </div>                            
            </div>                                   
            <div class="clear">&nbsp;</div>            
            <div class="row ">  
               <div class="col-lg-4">&nbsp;</div>
               <div class="col-lg-2 text-right">
                   <button class='btn btn-danger' id='cancelarUser'>Cancelar</button>
               </div>   
               <div class="col-md-2 text-right">
                   <button class='btn btn-primary' id='updateUser' data-user = '<?php echo $userId ?>'>Actualizar usuario</button>
               </div>
            </div>               
        </div>
    </div>     
</div>     
<div class="clear">&nbsp;</div>   
<div class="clear">&nbsp;</div>  
<div class="clear">&nbsp;</div>  


<?php
    include $pathProy.'footer2.php';
?>

<script src="<?php echo $raizProy?>usuarios/js/editUsers.js"></script>    
<script src="<?php echo $raizProy?>js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="<?php echo $raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>

<link href="<?php echo $raizProy?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
