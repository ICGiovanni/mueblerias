<?php session_start();
require_once $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
require_once $pathProy.'/header2.php';
require_once $pathProy.'/menu.php';

?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Proveedores</h2>
        <ol class="breadcrumb">
            <li>
                <a href="">Proveedores</a>
            </li>
            <li class="active">
                <strong>Nuevo Proveedores</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8"></div>
</div>



<div class="wrapper wrapper-content animated fadeIn">
    <form method="get" class="form-horizontal" action="/" id="form_cliente">              
        <div class="row">    
            <div class="col-lg-12">                      
                <div class="form-group">                            
                    <label for="nombre" class="control-label col-md-2">Nombre:</label>                            
                    <div class="col-md-6">
                        <input type="text" id="nombre" value="" class="form-control" >
                    </div>    
                </div>                                    
                <div class="form-group">                      
                    <label class="control-label col-md-2">Correo electrónico:</label>                    
                    <div class="col-md-6">
                        <input type="text" id="email" value="" class="form-control" >
                    </div>    
                </div>                                                     
                <div class="form-group">                      
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
                        <div class="col-md-1" style="padding-top: 5px">                            
                            <button class="btn btn-primary btn-xs" id="agregarTelefono" value="" placeholder="Telefono" type="button"><i class="fa fa-plus"></i></button>
                        </div>                             
                </div>          
                <div class="row" id="newPhone" style="    margin-top: -16px; margin-left: -8px;"></div>
                <div class="clear">&nbsp;</div>
                <div class="form-group">  
                    <label class="control-label col-md-2">Calle:</label>                    
                    <div class="col-md-6">                           
                        <input class="form-control" id="calle" name="calle" value="" type="text">                            
                    </div>                            
                </div>
                <div class="form-group">                      
                    <label class="control-label col-md-2">No. Exterior:</label>                    
                    <div class="col-md-2">                            
                        <input class="form-control" id="numExt" name="numExt" value="" type="text">                            
                    </div>                                                                        
                    <label class="control-label col-md-2">No. Interior:</label>                    
                    <div class="col-md-2">                            
                        <input class="form-control" id="numInt" name="numInt" value="" type="text">                            
                    </div>
                </div>
                <div class="form-group">  
                    <label class="control-label col-md-2">Colonia:</label>                    
                    <div class="col-md-6">                           
                        <input class="form-control" id="colonia" name="colonia" value="" type="text">                            
                    </div>                            
                </div>
                <div class="form-group">                      
                    <label class="control-label col-md-2">C.P.</label>                   
                    <div class="col-md-2">                          
                        <input class="form-control" id="cp" name="cp" value="" type="text">                            
                    </div>                            
                </div>
                <div class="form-group">                      
                    <label class="control-label col-md-2">Municipio</label>
                    <div class="col-md-6">                           
                        <input class="form-control" id="municipio" name="municipio" value="" type="text">                            
                    </div>                            
                </div>                    
                <div class="form-group">  
                    <label class="control-label col-md-2">Estado</label>
                    <div class="col-md-6">                        
                        <select id="estado" name="estado" class="form-control m-b">
                            <option value="0">Selecciona un estado</option>
                        </select>
                    </div>                            
                </div>  
                <div class="form-group">                      
                    <div class="col-md-8 text-right">                                                
                        <a href='<?php echo $ruta.'proveedores/'?>' class="btn btn-danger btn-xs" >Cancelar</a> 
                        <button type="button" class="btn btn-primary btn-xs" id="btn_guardar_proveedor" >Guardar</button>
                    </div>                            
                </div> 
            </div> 
            
        </div>     
    </form>                                       
</div>
  


<?php 
    require_once $pathProy.'/footer2.php';
?>

<script src="<?php echo $raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>

<link href="<?php echo $raizProy?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

<script src="js/proveedores.js"></script>

