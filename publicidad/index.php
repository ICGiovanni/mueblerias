<?php
	include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
	require_once($_SERVER["REDIRECT_PATH_CONFIG"].'publicidad/models/class.Publicidad.php');
	require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/general/class.General.php');
   // include $pathProy.'login/session.php';
    include $pathProy.'/header.php';
    include $pathProy.'/menu.php';
?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Campa&ntilde;as</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">Campa&ntilde;as</a>
                </li>
                <li class="active">
                    <strong>Lista de Campa&ntilde;a</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="./nueva_campana.php" class="btn btn-primary btn-xs">Nueva Campa&ntilde;a</a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <!--<div class="ibox-title">
                        <div class="ibox-tools">
                             <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#">Config option 1</a>
                                </li>
                                <li><a href="#">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>-->
                    <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tabla_publicidad">
                    <thead>
                    <tr>
                    	<th>ID</th>
                        <th>Campa&ntilde;a</th>
                        <th>Fecha de Creaci&oacute;n</th>
                        <th></th>
                        
                    </tr>
                    </thead>
                    <tbody id="clientes">
                    <?php
                    $publicidad=new Publicidad();
                    $general=new General();
                    $publicidades=$publicidad->GetPublicidad();
                    $tr="";
                    
                    foreach($publicidades as $p)
                    {
                    	$id_publicidad=$p["id_publicidad"];
                    	$nombre=$p["nombre"];
                    	$fecha=$general->getDate($p["fecha"]);
                    	
                    	
                    	
                    	
                    	$tr.='<tr class="gradeX">';
                    	$tr.='<td>'.$id_publicidad.'</td>';
                    	$tr.='<td>'.$nombre.'</td>';
                    	$tr.='<td>'.$fecha.'</td>';
                    	$tr.='<td><div class="infont col-md-1 col-sm-1"><a href="editar_campana.php?id='.$id_publicidad.'"><i class="fa fa-pencil"></i></a></div><div class="infont col-md-1 col-sm-1"><a href="#" onClick="borrar_publicidad('.$id_publicidad.');"><i class="fa fa-trash-o"></i></a></div></td>';
                    	$tr.='</tr>';
                    	
                    }
                    
                    echo $tr;          
                    ?>
                   
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Campa&ntilde;a</th>
                        <th>Fecha de Creaci&oacute;n</th>
                        <th></th>
                    </tr>
                    </tfoot>
                    </table>
                        </div>

                    </div>
                </div>
            </div>
            </div>
	</div>
    <script src="<?php echo $raizProy?>js/plugins/dataTables/datatables.min.js"></script>
    


    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){

        	$('.dataTables-example').DataTable({
        		dom: '<"html5buttons"B>lTfgitp',
                buttons: [],
                "language": {
                    "url": "../js/plugins/dataTables/Spanish.json"
            	}

            });
            
        });

        function borrar_publicidad(id_publicidad)
        {
        	var url="borrar_campana.php";
        				 
			$.ajax(
			{
		    	type: "POST",
		        url: url,
		        data: {id:id_publicidad}, // serializes the form's elements.
		        success: function(data)
		        {
		        	swal({
		                title: "Guardado!",
		                text: "Campa\u00f1a borrada correctamente!",
		                type: "success"
		            }, function () {
		                window.location.href = 'index.php';
		            });
				}
			});
        }

    </script>


<?php
    include $pathProy.'footer.php';
?>