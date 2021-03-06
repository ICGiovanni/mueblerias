<?php   include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';

        include $pathProy.'login/models/class.Login.php';
        require_once $pathProy.'/clientes/models/class.Clientes.php';

        $insClientes = new Clientes();
        $userLogin = new Login();
        
        $profiles = $userLogin->getProfiles();
        $sucursales = $userLogin->getSucursales();
        
        
        $phones = '';
        foreach($insClientes->GetTypesPhones() as $type){
            $phones .= '<option value="'.$type['phone_type_id'].'">'.$type['type'].'</option>';
        }
        
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
            <a href="./index.php" class="btn btn-warning btn-xs"><i class="fa fa-arrow-left"></i> Regresar a listado</a>            
        </div>
    </div>
</div>   
<div class="row">    
    <div class="col-lg-12">           
        <div class="wrapper wrapper-content animated fadeInRight form-horizontal">
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Nombre</label>
		<div class="col-sm-6" ><input type="text" id="firstName" value="" class="form-control" ></div>
            </div>                                                 
            <div class="form-group">                        
                <label class="control-label col-sm-2">Apellido Paterno</label>                        
                <div class="col-md-6">
                    <input type="text" id="lastName" value=""  class="form-control" >
                </div>    
            </div>
            <div class="form-group">                        
                <label class="control-label col-sm-2">Apellido Materno</label>                        
                <div class="col-md-6">
                    <input type="text" id="secondLastName" value=""  class="form-control" >
                </div>    
            </div>
            <div class="form-group">                        
                <label class="control-label col-sm-2">Correo Electrónico</label>                        
                <div class="col-md-6">
                    <input type="text" id="email" value="" class="form-control" >
                </div>    
            </div>
            <div class="form-group">                        
                <label class="control-label col-sm-2">Contraseña</label>                        
                <div class="col-md-6">
                    <input type="password" id="password" value="" class="form-control" >
                </div>    
            </div>    
            <div class="form-group">                        
                <label class="control-label col-sm-2">Perfil</label>                        
                <div class="col-md-6">
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
            <div class="form-group">                        
                <label class="control-label col-sm-2">Sucursal</label>                        
                <div class="col-md-6">
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
            <div class="form-group">
                <label class="control-label col-sm-2">Salario</label>
                <div class="col-md-2">
                    <input class="form-control" id="salario" value="" type="text">
                </div>
                <label class="control-label col-sm-2">Comision</label>                        
                <div class="col-md-2">
                    <input class="form-control" id="comision" value="" placeholder="%" type="text">
                </div>
            </div>  
            <div class="form-group">                        
                <label class="control-label col-sm-2">Periodicidad de pago</label>                        
                <div class="col-md-6">
                    <select id="periodicidad" name="periodicidad" class="form-control m-b chosen-select" data-placeholder="Selecciona una opcion">
                        <option value="0">Selecciona una opción</option>
                        <option value="1">Semanal</option>
                        <option value="2">Quincenal</option>
                        <option value="3">Mensual</option>
                    </select>
                </div>    
            </div> 
            <div class="form-group">                        
                <label class="control-label col-sm-2">Telefono</label>                        
                <div class="col-md-3">
                    <input class="form-control" id="telefono" name="telefono[]" value="" type="text">
                </div>    
                <div class="col-md-2">
                    <select id="phoneType" name="phoneType[]" class="form-control">
                        <?php 
                            foreach($insClientes->GetTypesPhones() as $type){
                                echo '<option value="'.$type['phone_type_id'].'">'.$type['type'].'</option>';
                            }
                        ?>                                
                    </select>
                </div>   
                <div class="col-md-1" style="padding-top: 5px">                            
                    <button class="btn btn-primary btn-xs" id="agregarTelefono" value="" placeholder="Telefono" type="button"><i class="fa fa-plus"></i></button>
                </div>    
            </div>                
            <div id="newPhone"></div>                
            <div class="form-group">                        
                <label class="control-label col-sm-2">Fecha de nacimiento</label>                        
                <div class="col-md-6">
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input class="form-control" value="" type="text" id="fechaNacimiento"  data-date-format='dd/mm/yyyy' >
                    </div>
                </div>    
            </div>   
            <div class="form-group">                        
                <label class="control-label col-sm-2">Calle</label>                        
                <div class="col-md-6">
                    <textarea class="form-control" id="calle" name="calle"></textarea>
                </div>    
            </div>                
            <div class="form-group">                        
                <label class="control-label col-sm-2">No. Exterior</label>                        
                <div class="col-md-2">
                    <input class="form-control" id="numExt" name="numExt" value="" type="text">
                </div>    
                <label class="control-label col-sm-2">No. Interior</label>                        
                <div class="col-md-2">
                    <input class="form-control" id="numInt" name="numInt" value="" type="text">
                </div>
            </div>
            <div class="form-group">                        
                <label class="control-label col-sm-2">Colonia</label>                        
                <div class="col-md-6">
                    <input class="form-control" id="colonia" name="colonia" value="" type="text">                            
                </div>    
            </div>
            <div class="form-group">                        
                <label class="control-label col-sm-2">Código Postal</label>                        
                <div class="col-md-2">
                    <input class="form-control" id="cp" name="cp" value="" type="text">                            
                </div>    
            </div>
            <div class="form-group">                        
                <label class="control-label col-sm-2">Delegación&nbsp;/&nbsp;Municipio</label>
                <div class="col-md-6">
                    <input class="form-control" id="municipio" name="municipio" value="" type="text">                            
                </div>    
            </div>
            <div class="form-group">                        
                <label class="control-label col-sm-2">Estado</label>                        
                <div class="col-md-6">
                    <select id="estado" name="estado" class="form-control m-b chosen-select">
                        <option value="0">Selecciona un estado</option>
                    </select>
                </div>    
            </div>
            <div class="form-group">                      
                <div class="col-md-8 text-right">                                                
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


<script src="<?php echo $raizProy?>js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="<?php echo $raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo $raizProy?>js/plugins/chosen/chosen.jquery.js"></script>

<link href="<?php echo $raizProy?>css/plugins/chosen/chosen.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<script src="<?php echo $raizProy?>usuarios/js/addUsers.js"></script>    
<script>
    $(document).ready(function(){
        $("#periodicidad").chosen();
        $("#perfil").chosen();
        $("#sucursal").chosen();
        phones = '<?php echo $phones ?>';
    });        
</script>    