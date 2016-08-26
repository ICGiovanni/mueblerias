<?php   include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';

        include $pathProy.'login/models/class.Login.php';
        $userLogin = new Login();
        $profiles = $userLogin->getProfiles();
        $sucursales = $userLogin->getSucursales();
        
        
        //include $pathProy.'login/session.php';
        include $pathProy.'/header.php';
        include $pathProy.'/menu.php';
?>

<div class="clear">&nbsp;</div>      
<div class="row">    
    <div class="col-lg-12">
        <div class="ibox-title">
            <div class="row">
                <div class="col-lg-10"><h4>Nuevo Usuario<small>&nbsp;</small></h4></div>                                
            </div>            
        </div>    
        <div class="ibox-content animated fadeInRightBig">                                    
            <div class="row">    
                <div class="col-lg-6">
                    <input type="text" id="firstName" value="" placeholder="Nombre" class="form-control" >
                </div>   
                <div class="col-md-6">
                    <input type="text" id="lastName" value="" placeholder="Apellido" class="form-control" >
                </div>
            </div>
            <div class="clear">&nbsp;</div>
            <div class="row">    
                <div class="col-lg-6">
                    <input type="text" id="email" value="" placeholder="Correo electrónico" class="form-control" >
                </div>   
                <div class="col-md-6">
                    <input type="text" id="password" value="" placeholder="Contraseña" class="form-control" >
                </div>
            </div>
            <div class="clear">&nbsp;</div>
            <div class="row">    
                <div class="col-lg-6">
                    <select id="perfil" class="form-control">
                        <option value="0">Selecciona un perfil</option>
                        <?php 
                        foreach($profiles as $profile){
                            echo "<option value='".$profile['profile_id']."'>".$profile['profile_name']."</option>";
                        }
                        ?>                        
                    </select>
                </div>   
                <div class="col-md-4">
                    <select id="sucursal" class="form-control">
                        <option value="0">Selecciona una sucursal</option>
                        <?php 
                        foreach($sucursales as $sucursal){
                            echo "<option value='".$sucursal['sucursal_id']."'>".$sucursal['sucursal_name']."</option>";
                        }
                        ?> 
                    </select>
                </div>
                <div class="col-md-2" style="padding-top: 5px">
                    <label class="checkbox-inline">
                        <input type="checkbox" value="colaborador" id="colaborador" name="colaborador" />
                        <span style="padding-top: 3px; display: block;"><b>Colaborador</b></span>
                    </label>
                </div>
            </div>
            <div class="clear">&nbsp;</div>
            <div class="row colaboradorForm">    
                <div class="col-lg-6">
                    <input class="form-control" id="comision" value="" placeholder="% Comision" type="text">
                </div>   
                <div class="col-md-6">
                    <input class="form-control" id="telefono" value="" placeholder="Telefono" type="text">
                </div>
            </div>
            <div class="clear">&nbsp;</div>
            <div class="row colaboradorForm">    
                <div class="col-lg-6">
                    <input class="form-control" id="salario" value="" placeholder="Salario" type="text">
                </div>   
                <div class="col-md-6">
                    <div class="form-group" id="data_1">            
                        <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input class="form-control" value="" type="text" id="fechaNacimiento" placeholder="Fecha de nacimiento">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row colaboradorForm">    
                <div class="col-lg-6">
                    
                </div>   
                <div class="col-md-6">&nbsp;        
                </div>
            </div>     
            
             <div class="clear">&nbsp;</div>            
            <div class="row colaboradorForm">  
                <div class="col-lg-8">&nbsp;</div>
                <div class="col-lg-2 text-right">
                    <button class='btn btn-danger' id='cancelarUser'>Cancelar</button>
                </div>   
                <div class="col-md-2 text-right">&nbsp;        
                    <button class='btn btn-primary' id='saveUser'>Agregar usuario</button>
                </div>
            </div>  
             
        </div>
    </div>     
</div>     
<div class="clear">&nbsp;</div>   
<div class="clear">&nbsp;</div>  
<div class="clear">&nbsp;</div>  


<?php
    include $pathProy.'footer.php';
?>

<script src="<?php echo $raizProy?>usuarios/js/addUsers.js"></script>    
<script src="<?php echo $raizProy?>js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="<?php echo $raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>

<link href="<?php echo $raizProy?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
