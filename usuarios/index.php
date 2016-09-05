<?php   include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
        include $pathProy.'login/session.php';
        include $pathProy.'/header2.php';
        include $pathProy.'/menu.php';
?>
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
                    <a href='newUser.php' class="btn btn-primary" >
                        <i class="fa fa-user-plus"></i>&nbsp;usuario
                    </a>
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
                        <th>Ultimo Acceso</th>
                        <th class="text-center">Activación</th>  
                        <th class="text-center">Acciones</th>  
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
    include $pathProy.'footer2.php';
?>
<script src="<?php echo $raizProy?>usuarios/js/usuarios.js"></script>    
<script src="<?php echo $raizProy?>js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="<?php echo $raizProy?>js/plugins/dataTables/datatables.min.js"></script>
<script src="<?php echo $raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>

<link href="<?php echo $raizProy?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
