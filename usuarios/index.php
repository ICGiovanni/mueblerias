<?php   include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
        include $pathProy.'login/session.php';
        include $pathProy.'/header2.php';
        include $pathProy.'/menu.php';
?>
<style type="text/css">
    .colaboradorForm{ display: none;}
    .fa-thumbs-o-up{color:#18A689;}
    .fa-thumbs-o-down{color:#EC4758;}
</style>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-4">
		<h2>Lista de Usuarios</h2>
		<ol class="breadcrumb">
			<li>
				<a href="">Usuarios</a>
			</li>
			<li class="active">
				<strong>Lista de Usuarios</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-8">
		<div class="title-action">			
                    <a href="newUser.php" class="btn btn-primary btn-xs">+ Nuevo Usuario</a>			
		</div>
	</div>
</div>

<div class="row">    
    <div class="col-lg-12">
           
        <div class="ibox-content animated fadeInRight">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Creado</th>
                        <th>Ultimo Acceso</th>
                        <th>Estatus</th>                                                
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

<script src="<?php echo $raizProy?>js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="<?php echo $raizProy?>js/plugins/dataTables/datatables.min.js"></script>
<script src="<?php echo $raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>

<link href="<?php echo $raizProy?>css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<script src="<?php echo $raizProy?>usuarios/js/usuarios.js"></script>    
