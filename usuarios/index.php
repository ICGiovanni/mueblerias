<?php
    include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
    include $pathProy.'/header.php';
    include $pathProy.'/menu.php';
    
?>

<link href="<?php echo $raizProy?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<style type="text/css">
    .colaboradorForm{ display: none;}
</style>
<div class="clear">&nbsp;</div>      
<div class="row">    
    <div class="col-lg-12">
        <div class="ibox-title">
            <div class="row">
                <div class="col-lg-10"><h4>Control de Usuarios <small>&nbsp;</small></h4></div>
                <div class="col-lg-2">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                        <i class="fa fa-user-plus"></i>&nbsp;usuario
                    </button>
                </div>
                <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content animated fadeInDown">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <i class="fa fa-user fa-4x"></i>
                                <h4 class="modal-title">Usuario</h4>                                
                            </div>
                            <div class="modal-body">
                                <?php include 'templateUserForm.php'?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-dismiss="modal" id="cancelarUser">Close</button>
                                <button type="button" class="btn btn-primary" id="saveUser">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>    
        <div class="ibox-content animated fadeInRightBig">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Creado</th>
                        <th>Estatus</th>
                        <th>Email</th>
                        <th class="text-center">Editar</th>  
                        <th class="text-center">Borrar</th>  
                    </tr>
                    </thead>
                    <tbody id="loadUsers"></tbody>
                </table>    
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
<script src="<?php echo $raizProy?>js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="<?php echo $raizProy?>js/plugins/dataTables/datatables.min.js"></script>    
<script src="<?php echo $raizProy?>js/plugins/datapicker/bootstrap-datepicker.js"></script>
<link href="<?php echo $raizProy?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">

<script src="<?php echo $raizProy?>usuarios/js/usuarios.js"></script>    

