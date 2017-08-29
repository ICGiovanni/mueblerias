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
                <strong>Lista de Proveedores</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
                <a href='<?php echo $ruta.'proveedores/nuevoProveedor.php'?>' class="btn btn-primary btn-xs" >
                + Nuevo Proveedor 
                </a>                
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-content">
                <div class="">
                    <table id="tablaProveedores" class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>                            
                            <th>Nombre Comercial</th>
                            <th>Nombre Fiscal</th>
                            <th width='120px'><center>Dirección</center></th>
                            <th>Representante</th>
                            <th>Telefono</th>
                            <th>E-mail</th>                            
                            <th width='60px'><center>Accion</center></th>                            
                        </tr>
                        </thead>
                        <tbody id='listaProveedores'></tbody>
                    </table>
		</div>
            </div>
	</div>
    </div>	
</div>

<div class="modal inmodal fade" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding: 15px">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h3 class="modal-title">Nuevo Proveedor </h3>
            </div>
            <div class="modal-body" style="padding-bottom: 0px !important; margin-bottom: -15px !important">    
                <?php include 'proveedorTemplate.php' ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary btn-xs" id="btn_guardar_proveedor" >Guardar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal inmodal fade" id="myModal2" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding: 15px">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h3 class="modal-title">Editar Proveedor </h3>
            </div>
            <div class="modal-body" style="padding-bottom: 0px !important; margin-bottom: -15px !important">                    
                <input type="hidden" id="proveedor_id" value='' />
                <input type="hidden" id="address_id" value='' />
                <?php include 'proveedorTemplate.php' ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary btn-xs" id="btn_editar_proveedor" >Guardar</button>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-primary" id="dialogDetalles">
    <p><label id="titulo_dialog"></label></p>
    
    <div id="content_dialog"></div>
    <button class="btn btn-danger closeDialog">Cerrar</button>
</div>

<?php 
    require_once $pathProy.'/footer2.php';
?>

<script src="<?php echo $raizProy?>js/plugins/dataTables/datatables.min.js"></script>
<script src="<?php echo $raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>

<link href="<?php echo $raizProy?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

<script src="js/proveedores.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script>
    $(document).ready(function(){
        $( "#dialogDetalles" ).dialog({
            autoOpen: false,
            modal: true,
            show: {
                effect: "fade"
            },
            hide: {
                effect: "fade"
            }
        });

        $(document).on("click", ".showDialog", function(e){
            $("#titulo_dialog").html($(this).data('title'));
            $("#content_dialog").html($(this).data('content'));

            $( "#dialogDetalles" ).dialog( "open" );
        });
        
        $(document).on("click", ".closeDialog", function(e) {                    
            $( "#dialogDetalles" ).dialog( "close" );           
        });
       
    });
    
    </script>

