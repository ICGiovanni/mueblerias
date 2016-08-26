<?php
	include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
	require_once($_SERVER["REDIRECT_PATH_CONFIG"].'clientes/models/class.Clientes.php');
   // include $pathProy.'login/session.php';
    include $pathProy.'/header.php';
    include $pathProy.'/menu.php';
?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Clientes</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">Clientes</a>
                </li>
                <li class="active">
                    <strong>Lista de Clientes</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="./nuevo_cliente.php" class="btn btn-primary">Agregar Cliente</a>
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
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tabla_clientes">
                    <thead>
                    <tr>
                    	<th>ID</th>
                        <th>Cliente</th>
                        <th>Datos Fiscales</th>
                        <th>Direcci&oacute;n</th>
                        <th>Telefono</th>
                        <th>E-mail</th>
                        <th></th>
                        
                    </tr>
                    </thead>
                    <tbody id="clientes">
                    <?php
                   	$json=file_get_contents("json/lista_clientes.json");
                    $json=json_decode($json);
                    $tr="";
                    foreach($json as $d)
                    {
                    	$id_cliente=$d->id_cliente;
                    	$cliente=$d->cliente;
                    	$rfc=$d->rfc;
                    	$razon_social=$d->razon_social;
                    	$telefono=$d->telefono;
                    	$email=$d->email;
                    	$datos_fiscales="";
                    	$direccion="";
                    	
                    	if($rfc!='')
                    	{
                    		$datos_fiscales.='RFC: '.$rfc;
                    	}
                    	
                    	if($razon_social)
                    	{
                    		$datos_fiscales.='<br>'.$razon_social;
                    	}
                    	
                    	
                    	if($d->calle!='')
                    	{
                    		$direccion.=$d->calle;
                    	}
                    	
                    	if($d->num_exterior!='')
                    	{
                    		$direccion.=' No. Exterior '.$d->num_exterior;
                    	}
                    	
                    	if($d->num_interior!='')
                    	{
                    		$direccion.=' No. Interior '.$d->num_interior;
                    	}
                    	
                    	if($d->colonia)
                    	{
                    		$direccion.=' Col. '.$d->colonia;
                    	}
                    	
                    	if($d->codigo_postal!='')
                    	{
                    		$direccion.=' C.P.'.$d->codigo_postal;
                    	}
                    	
                    	if($d->municipio!='' && $d->estado!='')
                    	{
                    		$direccion.=' '.$d->municipio.', '.$d->estado;
                    	}
                    	else if($d->municipio)
                    	{
                    		$direccion.=' '.$d->municipio;
                    	}
                    	else if($d->estado!='')
                    	{
                    		$direccion.=' '.$d->estado;
                    	}
                    	
                    	$tr.='<tr class="gradeX">';
                    	$tr.='<td>'.$id_cliente.'</td>';
                    	$tr.='<td>'.$cliente.'</td>';
                    	$tr.='<td>'.$datos_fiscales.'</td>';
                    	$tr.='<td>'.$direccion.'</td>';
                    	$tr.='<td>'.$telefono.'</td>';
                    	$tr.='<td>'.$email.'</td>';
                    	$tr.='<td><div class="infont col-md-3 col-sm-4"><a href="editar_cliente.php?id='.$id_cliente.'"><i class="fa fa-pencil"></i></a></div><div class="infont col-md-3 col-sm-4"><a href="#" onClick="borrar_cliente('.$id_cliente.');"><i class="fa fa-trash-o"></i></a></div></td>';
                    	$tr.='</tr>';
                    	
                    }
                    echo $tr;                    
                    ?>
                   
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Datos Fiscales</th>
                        <th>Direcci&oacute;n</th>
                        <th>Telefono</th>
                        <th>E-mail</th>
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
	<script src="<?php echo $raizProy?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
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

        function borrar_cliente(id_cliente)
        {
        	var url="borrar_cliente.php";
        				 
			$.ajax(
			{
		    	type: "POST",
		        url: url,
		        data: {id:id_cliente}, // serializes the form's elements.
		        success: function(data)
		        {
		        	alert("El Cliente ha sido borrado"); // show response from the php script.
		        	var url="index.php";
		    		$(location).attr("href", url);
				}
			});
        }

    </script>


<?php
    include $pathProy.'footer.php';
?>