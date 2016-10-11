<?php
	include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
	require_once($_SERVER["REDIRECT_PATH_CONFIG"].'clientes/models/class.Clientes.php');
   // include $pathProy.'login/session.php';
    include $pathProy.'/header.php';
    include $pathProy.'/menu.php';
?>

	<link rel="stylesheet" type="text/css" href="../css/clientes.css">
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
                <a href="./nuevo_cliente.php" class="btn btn-primary btn-xs">Nuevo Cliente</a>
                <a href="#" id="rating" data-toggle="modal" data-target="#ratingModal" class="btn btn-primary btn-xs">Configurar Rating</a>
            </div>
            
        </div>
    </div>
    

    <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                             <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#" id="rating" data-toggle="modal" data-target="#ratingModal">Configurar Rating</a>
                                </li>
                            </ul>
                            <!-- <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>-->
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tabla_clientes">
                    <thead>
                    <tr>
                    	<th align="center">ID</th>
                        <th align="center">Cliente</th>
                        <th align="center">Datos Fiscales</th>
                        <th align="center">Direcci&oacute;n</th>
                        <th align="center">Telefono</th>
                        <th align="center">E-mail</th>
                        <th align="center">Rating</th>
                        <th align="center"></th>
                        
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
                    	$nombre=$d->nombre;
                    	$apellidoP=$d->apellidoP;
                    	$apellidoM=$d->apellidoM;
                    	$rfc=$d->rfc;
                    	$razon_social=$d->razon_social;
                    	$telefono=$d->telefono;
                    	$email=$d->email;
                    	$datos_fiscales="";
                    	$direccion="";
                    	
                    	$cliente=$nombre.' '.$apellidoP.' '.$apellidoM;
                    	
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
                    	
                    	$rating=$d->rating;
                    	
                    	$tr.='<tr class="gradeX">';
                    	$tr.='<td align="center">'.$id_cliente.'</td>';
                    	$tr.='<td>'.$cliente.'</td>';
                    	$tr.='<td>'.$datos_fiscales.'</td>';
                    	$tr.='<td>'.$direccion.'</td>';
                    	$tr.='<td>'.$telefono.'</td>';
                    	$tr.='<td align="center">'.$email.'</td>';
                    	$tr.='<td align="center"><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><span class="numero">'.$rating.'</span></td>';
                    	$tr.='<td align="center"><div class="infont col-md-1 col-sm-1"><a href="editar_cliente.php?id='.$id_cliente.'"><i class="fa fa-pencil"></i></a><a href="#" onClick="borrar_cliente('.$id_cliente.');"><i class="fa fa-trash-o"></i></a></div></td>';
                    	$tr.='</tr>';
                    	
                    }
                    echo $tr;                    
                    ?>
                   
                    </tbody>
                    <tfoot>
                    <tr>
                        <th align="center">ID</th>
                        <th align="center">Cliente</th>
                        <th align="center">Datos Fiscales</th>
                        <th align="center">Direcci&oacute;n</th>
                        <th align="center">Telefono</th>
                        <th align="center">E-mail</th>
                        <th align="center">Rating</th>
                        <th align="center"></th>
                    </tr>
                    </tfoot>
                    </table>
                        </div>

                    </div>
                </div>
            </div>
            </div>
	</div>
	
	
	<div class="modal fade" id="ratingModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Configurar Rating</h4>
        </div>
        <div class="modal-body">
        <div class="wrapper wrapper-content animated fadeInRight">
          <label class="col-sm-2 control-label">Monto</label>
			<div class="col-sm-4" ><input type="text" class="form-control" id="monto" name="monto" onkeypress="return validateCantidad(event)" onkeyup="run(this)"></div>
          
          <label class="col-sm-2 control-label">Compras</label>
			<div class="col-sm-4" ><input type="text" class="form-control" id="compras" name="compras" onkeypress="return validateNumber(event)" onkeyup="run(this)"></div>
            
           </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal" id="guardarRating">Guardar</button>
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

        	$( "#guardarRating" ).click(function()
        	{
				var monto=$("#monto").val();
				var compras=$("#compras").val();

        		if(monto=='' || monto==0)
        		{
					alert("El monto debe de ser mayor a 0");
        		}
        		else if(compras=='' || compras==0)
        		{
					alert("Las compras deben ser mayores a 0");
        		}
        		else
        		{
            		url="rating.php";
	        		$.ajax(
	        		{
	        			type: "POST",
	        			url: url,
	        			data: {monto:monto,compras:compras}, // serializes the form's elements.
	        			success: function(data)
	        			{
	        				alert("Se han actualizado los datos"); // show response from the php script.
	        			    var url="index.php";
	        			    $(location).attr("href", url);
	        			}
	        		});
        		}
        	});

        	$( "#rating" ).click(function()
            {
        		$("#monto").focus();
                
        		$.getJSON("json/rating.json",function(result)
        		{
            		var monto=result[0].monto;
            		var compras=result[0].compras;
        			
        			if(monto!=0)
        			{
    					$("#monto").val(monto);
        			}
    				else
    				{
    					$("#monto").val('');
    				}

    				if(compras!=0)
    				{
    					$("#compras").val(compras);
    				}
    				else
    				{
    					$("#compras").val('');
    				}
        		});        		
            });
            
        });

        function borrar_cliente(id_cliente)
        {
        	var url="borrar_cliente.php";
        	var r=confirm("\u00BFDesea continuar?");

        	if(r==true)
        	{			 
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
        }

        

        function validateCantidad(evt)
    	{
    		evt = (evt) ? evt : window.event;
    	    var charCode = (evt.which) ? evt.which : evt.keyCode;
    		
    		
    	    if ((charCode > 31 && (charCode < 48 || charCode > 57) && charCode!=46))
    		{
    	        return false;
    	    }
    	}

        function validateNumber(evt)
    	{
    		evt = (evt) ? evt : window.event;
    	    var charCode = (evt.which) ? evt.which : evt.keyCode;
    	    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
    	        return false;
    	    }
    	}

    	function run(field)
    	{
    	    setTimeout(function()
    		{
    	        var regex = /\d*\.?\d?\d?/g;
    	        field.value = regex.exec(field.value);
    	    },0);
    	}

    </script>


<?php
    include $pathProy.'footer.php';
?>