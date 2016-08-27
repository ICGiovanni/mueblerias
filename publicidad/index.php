<?php
	include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
	require_once($_SERVER["REDIRECT_PATH_CONFIG"].'publicidad/models/class.Publicidad.php');
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
                <a href="./enviar_campana.php" class="btn btn-primary">Enviar Campa&ntilde;as</a>
                <a href="./nueva_campana.php" class="btn btn-primary">Agregar Campa&ntilde;as</a>
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
                    $publicidades=$publicidad->GetPublicidad();
                    $tr="";
                    
                    foreach($publicidades as $p)
                    {
                    	$id_publicidad=$p["id_publicidad"];
                    	$nombre=$p["nombre"];
                    	$f=$p["fecha"];
                    	$fh=explode(' ', $f);
                    	$fecha=$fh[0];
                    	$f=explode('-', $fecha);
                    	$fecha=$f[2].'/'.$f[1].'/'.$f[0].' '.$fh[1];
                    	
                    	
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
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

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
		        	alert("La Campaña ha sido borrada"); // show response from the php script.
		        	var url="index.php";
		    		$(location).attr("href", url);
				}
			});
        }

    </script>


<?php
    include $pathProy.'footer.php';
?>