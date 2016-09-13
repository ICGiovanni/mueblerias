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
           
        <div class="ibox-content animated fadeInRightBig">                                    
                     
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <label for="firstName" class="control-label">Nombre:</label>
                        </div>
                        <div class="col-md-5">
                            <input type="text" id="firstName" value="" class="form-control" >
                        </div>    
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <label class="control-label">Apellido paterno:</label>
                        </div>
                        <div class="col-md-5">
                            <input type="text" id="lastName" value=""  class="form-control" >
                        </div>    
                    </div>                    
                    <div class="clear">&nbsp;</div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <label class="control-label">Apellido materno:</label>
                        </div>
                        <div class="col-md-5">
                            <input type="text" id="secondLastName" value=""  class="form-control" >
                        </div>    
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <label class="control-label">Correo electrónico:</label>
                        </div>
                        <div class="col-md-5">
                            <input type="text" id="email" value="" class="form-control" >
                        </div>    
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <label class="control-label">Contraseña:</label>
                        </div>
                        <div class="col-md-5">
                            <input type="password" id="password" value="" class="form-control" >
                        </div>    
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <label class="control-label">Confirmar contraseña:</label>
                        </div>
                        <div class="col-md-5">
                            <input type="password" id="password2" value="" class="form-control" >
                        </div>    
                    </div>
                    <div class="clear">&nbsp;</div>            
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <label class="control-label">Perfil:</label>
                        </div>
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
                        <div class="col-md-3 text-right">
                            <label class="control-label">Sucursal:</label>
                        </div>
                        <div class="col-md-5">
                            <select id="sucursal" class="form-control">
                                <option value="0">Selecciona una sucursal</option>
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
                        <div class="col-md-3 text-right">
                            <label class="control-label">Comision:</label>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" id="comision" value="" placeholder="%" type="text">
                        </div>    
                    </div>                    
                    <div class="clear">&nbsp;</div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <label class="control-label">Salario:</label>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" id="salario" value="" type="text">
                        </div>                            
                    </div>
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
                    <div class="row" id="newPhone"></div>
                    <div class="clear">&nbsp;</div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <label class="control-label">Fecha de nacimiento:</label>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group" id="data_1">            
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input class="form-control" value="" type="text" id="fechaNacimiento">
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
                            <input class="form-control" id="calle" name="calle" value="" type="text">                            
                        </div>                            
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <label class="control-label">No. Exterior:</label>
                        </div>
                        <div class="col-md-1">                            
                            <input class="form-control" id="numExt" name="numExt" value="" type="text">                            
                        </div>                                                    
                        <div class="col-md-2 text-right">
                            <label class="control-label">No. Interior:</label>
                        </div>
                        <div class="col-md-1">                            
                            <input class="form-control" id="numInt" name="numInt" value="" type="text">                            
                        </div>
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <label class="control-label">Colonia:</label>
                        </div>
                        <div class="col-md-5">                            
                            <input class="form-control" id="colonia" name="colonia" value="" type="text">                            
                        </div>                            
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <label class="control-label">C.P.</label>
                        </div>
                        <div class="col-md-5">                            
                            <input class="form-control" id="cp" name="cp" value="" type="text">                            
                        </div>                            
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <label class="control-label">Municipio</label>
                        </div>
                        <div class="col-md-5">                            
                            <input class="form-control" id="municipio" name="municipio" value="" type="text">                            
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
                            </select>
                        </div>                            
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="row colaboradorForm">  
                        <div class="col-lg-4">&nbsp;</div>
                        <div class="col-lg-2 text-right">
                            <button class='btn btn-danger btn-xs' id='cancelarUser'>Cancelar</button>
                        </div>   
                        <div class="col-md-2 text-right">        
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
