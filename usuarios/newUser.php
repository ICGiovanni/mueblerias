<?php   include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';

        include $pathProy.'login/models/class.Login.php';
        $userLogin = new Login();
        $profiles = $userLogin->getProfiles();
        $sucursales = $userLogin->getSucursales();
        
        
        //include $pathProy.'login/session.php';
        include $pathProy.'/header.php';
        include $pathProy.'/menu.php';
?>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-4">
		<h2>Nuevo Usuario</h2>
		<ol class="breadcrumb">
			<li>
				<a href="">Usuarios</a>
			</li>
			<li class="active">
				<strong>Nuevo Usuario</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-8">
		<div class="title-action">
			
		</div>
	</div>
</div>   
<div class="row">    
    <div class="col-lg-12">
           
        <div class="wrapper wrapper-content animated fadeInRight form-horizontal">                                    
                     
                    <div class="form-group">                        
                        <label for="firstName" class="control-label col-md-2">Nombre:</label>                        
                        <div class="col-md-5">
                            <input type="text" id="firstName" value="" class="form-control" >
                        </div>    
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="form-group">                        
                        <label class="control-label col-md-2">Apellido paterno:</label>                        
                        <div class="col-md-5">
                            <input type="text" id="lastName" value=""  class="form-control" >
                        </div>    
                    </div>                    
                    <div class="clear">&nbsp;</div>
                    <div class="row">                        
                        <label class="control-label col-md-2">Apellido materno:</label>
                        <div class="col-md-5">
                            <input type="text" id="secondLastName" value=""  class="form-control" >
                        </div>    
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="row">                        
                        <label class="control-label col-md-2">Correo electrónico:</label>                        
                        <div class="col-md-5">
                            <input type="text" id="email" value="" class="form-control" >
                        </div>    
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="row">                        
                        <label class="control-label col-md-2">Contraseña:</label>                        
                        <div class="col-md-5">
                            <input type="password" id="password" value="" class="form-control" >
                        </div>    
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="row">                        
                        <label class="control-label col-md-2">Confirmar contraseña:</label>                        
                        <div class="col-md-5">
                            <input type="password" id="password2" value="" class="form-control" >
                        </div>    
                    </div>
                    <div class="clear">&nbsp;</div>            
                    <div class="row">                        
                        <label class="control-label col-md-2">Perfil:</label>                        
                        <div class="col-md-5">
                            <select id="perfil" class="form-control">
                                <option value="0">Selecciona un perfil</option>
                                <?php 
                                foreach($profiles as $profile){
                                    echo "<option value='".$profile['profile_id']."'>".$profile['profile_name']."</option>";
                                }
                                ?>                        
                            </select>
                        </div>    
                    </div>                    
                    <div class="clear">&nbsp;</div>
                    <div class="row">                        
                        <label class="control-label col-md-2">Sucursal:</label>
                        <div class="col-md-5">
                            <select id="sucursal" class="form-control">
                                <option>Selecciona una sucursal</option>
                                <option value="0">Sin Sucursal</option>
                                <?php 
                                foreach($sucursales as $sucursal){
                                    echo "<option value='".$sucursal['sucursal_id']."'>".$sucursal['sucursal_name']."</option>";
                                }
                                ?> 
                            </select>
                        </div>    
                    </div>                                                        
                    <div class="clear">&nbsp;</div>
                    <div class="row">                        
                        <label class="control-label col-md-2">Comision:</label>                        
                        <div class="col-md-5">
                            <input class="form-control" id="comision" value="" placeholder="%" type="text">
                        </div>    
                    </div>                    
                    <div class="clear">&nbsp;</div>
                    <div class="row">                        
                        <label class="control-label col-md-2">Salario:</label>                        
                        <div class="col-md-5">
                            <input class="form-control" id="salario" value="" type="text">
                        </div>                            
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="row">                        
                        <label class="control-label col-md-2">Periodicidad de pago:</label>
                        <div class="col-md-5">                            
                            <select id="periodicidad" name="periodicidad" class="form-control m-b">
                                <option value="0">Selecciona una opción</option>
                                <option value="1">Semanal</option>
                                <option value="2">Quincenal</option>
                                <option value="3">Mensual</option>
                            </select>
                        </div>                            
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="row">                        
                        <label class="control-label col-md-2">Telefono:</label>                        
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
                            <button class="btn btn-primary btn-xs" id="agregarTelefono" value="" placeholder="Telefono" type="button"><i class="fa fa-plus"></i></button>
                        </div>    
                    </div>
                    <div class="row" id="newPhone"></div>
                    <div class="clear">&nbsp;</div>
                    <div class="form-group">                        
                        <label class="control-label col-md-2">Fecha de nacimiento:</label>                        
                        <div class="col-md-5" style="padding: 0px 28px;">
                            <div class="form-group" id="data_1">            
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input class="form-control" value="" type="text" id="fechaNacimiento">
                                </div>
                            </div>
                        </div>                            
                    </div>                    
                    <div class="row">
                        <label class="control-label col-md-2">Calle:</label>                        
                        <div class="col-md-5">                            
                            <input class="form-control" id="calle" name="calle" value="" type="text">                            
                        </div>                            
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="row">
                        <label class="control-label col-md-2">No. Exterior:</label>
                        <div class="col-md-1">                            
                            <input class="form-control" id="numExt" name="numExt" value="" type="text">                            
                        </div>                                                    
                        <div class="col-md-2 ">
                            <label class="control-label">No. Interior:</label>
                        </div>
                        <div class="col-md-1">                            
                            <input class="form-control" id="numInt" name="numInt" value="" type="text">                            
                        </div>
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="row">                        
                        <label class="control-label col-md-2">Colonia:</label>                        
                        <div class="col-md-5">                            
                            <input class="form-control" id="colonia" name="colonia" value="" type="text">                            
                        </div>                            
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="row">
                        <label class="control-label col-md-2">C.P.</label>
                        <div class="col-md-5">                            
                            <input class="form-control" id="cp" name="cp" value="" type="text">                            
                        </div>                            
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="row">
                        <label class="control-label col-md-2">Municipio</label>
                        <div class="col-md-5">                            
                            <input class="form-control" id="municipio" name="municipio" value="" type="text">                            
                        </div>                            
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="row">                        
                        <label class="control-label col-md-2">Estado</label>
                        <div class="col-md-5">                            
                            <select id="estado" name="estado" class="form-control m-b">
                                <option value="0">Selecciona un estado</option>
                            </select>
                        </div>                            
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="row colaboradorForm">  
                        <div class="col-lg-2">&nbsp;</div>
                        <div class="col-lg-5 text-right ">
                            <button class='btn btn-danger btn-xs' id='cancelarUser'>Cancelar</button>                               
                            <button class='btn btn-primary btn-xs' id='saveUser'>Guardar Usuario</button>
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
