<?php
	include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
	require_once($_SERVER["REDIRECT_PATH_CONFIG"].'clientes/models/class.Clientes.php');
   // include $pathProy.'login/session.php';
    include $pathProy.'/header.php';
    include $pathProy.'/menu.php';

?>

	<link rel="stylesheet" type="text/css" href="../css/clientes.css">
	<link href="<?php echo $raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
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
                <a href="./nuevo_cliente.php" class="btn btn-primary btn-xs">+ Nuevo Cliente</a>
                <!--<a href="#" id="rating" data-toggle="modal" data-target="#ratingModal" class="btn btn-success btn-xs">Configurar Rating</a>-->
            </div>

        </div>
    </div>


    <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <div class="ibox-tools">

                            <a class="dropdown-toggle btn btn-success btn-xs" style="color:#FFFFFF" id="rating" data-toggle="modal" data-target="#ratingModal" href="#">
                                Configurar Rating <i class="fa fa-wrench"></i>
                            </a>
                           <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
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
                        <th align="center">Datos Facturación</th>
                        <th align="center">Datos Envio</th>
                        <th align="center">Telefono</th>
                        <th align="center">E-mail</th>
                        <th align="center">Rating</th>
                        <th align="center">Acciones</th>

                    </tr>
                    </thead>
                    <tbody id="clientes">
                    <?php
                    $clientes=new Clientes();

                   	$json=file_get_contents("json/lista_clientes.json");
                    $json=json_decode($json);
                    $tr="";
                    foreach($json as $d)
                    {
                    	$id_cliente=$d->id_cliente;
                    	$nombre=$d->nombre;
                    	$apellidoP=$d->apellidoP;
                    	$apellidoM=$d->apellidoM;
                    	$rating=$d->rating;

                    	$email="";
                    	$datos_fiscales="";
                    	$direccion="";
                    	$telefono='';

                    	$i=0;
                    	foreach($clientes->GetPhonesClient($id_cliente) as $p)
                    	{
                    		if($i>0)
                    		{
                    			$telefono.='<br>';
                    		}
                    		$telefono.='<b>'.$p['type'].':</b>'.$p['number'];

                    		$i++;
                    	}

                    	$i=0;

                    	foreach($clientes->GetEmailsClient($id_cliente) as $e)
                    	{
                    		if($i>0)
                    		{
                    			$email.='<br>';
                    		}
                    		$email.=$e['email'];

                    		$i++;
                    	}


                    	$cliente='<b>'.$nombre.' '.$apellidoP.' '.$apellidoM.'</b>';

                    	$datos="";
                    	$content="";
                    	$content2="";
                    	$direcciones=$clientes->GetDataCliente($id_cliente);

                    	foreach($direcciones as $d)
                    	{
                    		$tipo=$d['cliente_direccion_tipo_desc'];
                    		$rfc=$d['cliente_direccion_rfc'];
                    		$razonS=$d['cliente_direccion_razon_social'];
                    		$calle=$d['cliente_direccion_calle'];
                    		$noExt=$d['cliente_direccion_numero_ext'];
                    		$noInt=$d['cliente_direccion_numero_int'];
                    		$colonia=$d['cliente_direccion_colonia'];
                    		$codigoP=$d['cliente_direccion_cp'];
                    		$id_estado=$d['id_estado'];
                    		$estado=$d['estado'];
                    		$municipio=$d['cliente_direccion_municipio'];
                    		$referencia=$d['cliente_direccion_entre_calles'];


                    		$datos='';

                    		if($tipo=='envio')
                    		{
                    			$tipoR='<div id="addres_tipo_'.$i.'">Envio</div>';
                    			$datos.="";
                    		}
                    		else
                    		{
                    			$tipoR='<div id="addres_tipo'.$i.'">Facturación</div>';
                    			$datos.="<strong>RFC: </strong>".$rfc."<br><strong>Razón Social: </strong>".$razonS."<br>";
                    		}

                    		$datos.='<strong>Calle: </strong>'.$calle.' <strong>No. Ext: </strong>'.$noExt;

                    		if($noInt)
                    		{
                    			$datos.='<strong>No. Int.: </strong>'.$noInt;
                    		}

							$datos.='<br>';

                    		$datos.='<strong>Colonia: </strong>'.$colonia.'<br><strong>C.P. </strong>'.$codigoP.'<br><strong>Municipio o Delegación: </strong> '.$municipio.'<br><strong>Estado: </strong>'.$estado.'<br>';

                    		if($referencia)
                    		{
                    			$datos.='<strong>Referencia: </strong>'.$referencia;
                    		}

                    		if($tipo=='envio')
                    		{
                    			$content.='<div id="addres_div_'.$i.'">'.$datos.'</div>';
                    		}
                    		else
                    		{
                    			$content2.='<div id="addres_div_'.$i.'">'.$datos.'</div>';
                    		}


                    		$i++;
                    	}

                    	$datos_cliente="";

                    	$tr.='<tr class="gradeX">';
                    	$tr.='<td align="center">'.$id_cliente.'</td>';
                    	$tr.='<td>'.$cliente.'</td>';
                    	$tr.='<td>'.$content2.'</td>';
                    	$tr.='<td>'.$content.'</td>';
                    	$tr.='<td>'.$telefono.'</td>';
                    	$tr.='<td align="center">'.$email.'</td>';

                    	if($rating)
                    	{
                    		$s=0;
                    		$stars="";
                    		for($i=0;$i<$rating;$i++)
                    		{
                    			$stars.='<i class="fa fa-star"></i>';
                    			$s++;
                    		}
                    		$s=5-$s;
                    		for($i=0;$i<$s;$i++)
                    		{
                    			$stars.='<i class="fa fa-star-o"></i>';
                    		}

                    		$tr.='<td align="center">'.$stars.'<span class="numero">'.$rating.'</span></td>';
                    	}
                    	else
                    	{
                    		$tr.='<td align="center"><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><span class="numero">'.$rating.'</span></td>';
                    	}

                    	$tr.='<td align="center"><div class="infont col-md-1 col-sm-1"><a href="editar_cliente.php?id='.$id_cliente.'" title="Editar Cliente"><i class="fa fa-pencil"></i></a></div><div class="infont col-md-1 col-sm-1"><a href="#" onClick="borrar_cliente('.$id_cliente.');" title="Borrar Cliente"><i class="fa fa-trash-o"></i></a></div></td>';
                    	$tr.='</tr>';

                    }
                    echo $tr;
                    ?>

                    </tbody>
                    <tfoot>
                    <tr>
                        <th align="center">ID</th>
                        <th align="center">Cliente</th>
                        <th align="center">Datos Facturación</th>
                        <th align="center">Datos Envio</th>
                        <th align="center">Telefono</th>
                        <th align="center">E-mail</th>
                        <th align="center">Rating</th>
                        <th align="center">Acciones</th>
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
          <br><br><label class="col-sm-12 control-label">Esta opci&oacute;n es para generar las estrellas de cada cliente dependiendo del monto que se le haga la venta como tambi&eacute;n del numero de ventas</label>
        </div>
        <div class="modal-body">
        <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <h4 class="modal-title">Criterio por Monto</h4><br>
            <div class="col-lg-12">
            <div class="row" style="margin-bottom:10px;">
            <div class="form-group">
              <label class="col-sm-2 control-label">Monto</label>
    			<div class="col-sm-4" ><input type="text" class="form-control" id="monto" name="monto" onkeypress="return validateCantidad(event)" onkeyup="run(this)"></div>
            </div>
        </div>
        <div class="row">
            <h4 class="modal-title">Criterio por Compra</h4><br>
            <div class="form-group">
              <label class="col-sm-2 control-label">Compras</label>
    		  <div class="col-sm-4" ><input type="text" class="form-control" id="compras" name="compras" onkeypress="return validateNumber(event)" onkeyup="run(this)"></div>
              <label class="col-sm-2 control-label">Monto Minimo</label>
              <div class="col-sm-4" ><input type="text" class="form-control" id="compras_monto" name="compras_monto" onkeypress="return validateNumber(event)" onkeyup="run(this)"></div>
            </div>
        </div>
               </div>
           </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary btn-xs" id="guardarRating">Guardar</button>
        </div>
      </div>

    </div>
  </div>

    <script src="<?php echo $raizProy?>js/plugins/dataTables/datatables.min.js"></script>
    <script src="<?php echo $raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="<?php echo $raizProy?>js/plugins/toastr/toastr.min.js"></script>


    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){

            toastr.options=
            {
                  "closeButton": true,
                  "debug": false,
                  "progressBar": true,
                  "preventDuplicates": false,
                  "positionClass": "toast-top-right",
                  "onclick": null,
                  "showDuration": "400",
                  "hideDuration": "1000",
                  "timeOut": "7000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "fadeIn",
                  "hideMethod": "fadeOut"
            }

        	$('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [],
                "language": {
                    "url": "../js/plugins/dataTables/Spanish.json"
            	}
            });

        	$( "#guardarRating" ).click(function()
        	{
				var monto=$("#monto").val();
				var compras=$("#compras").val();
                var compras_monto=$("#compras_monto").val();

        		if(monto=='' || monto==0)
        		{
                    toastr.error('El monto debe de ser mayor a 0');
                    $("#monto").val('');
                    $("#monto").focus();
        		}
        		else if(compras=='' || compras==0)
        		{
                    toastr.error('Las compras deben ser mayores a 0"');
                    $("#compras").val('');
                    $("#compras").focus();
        		}
                else if(compras_monto=='' || compras_monto==0)
                {
                    toastr.error('El monto de las compras deben ser mayores a 0"');
                    $("#compras_monto").val('');
                    $("#compras_monto").focus();
                }
        		else
        		{
            		url="rating.php";
	        		$.ajax(
	        		{
	        			type: "POST",
	        			url: url,
	        			data: {monto:monto,compras:compras,compras_monto:compras_monto}, // serializes the form's elements.
	        			success: function(data)
	        			{
	        			    swal({
				                title: "Guardado!",
				                text: "Rating guardado correctamente!",
				                type: "success"
				            }, function () {
				                window.location.href = 'index.php';
				            });
	        			}
	        		});
        		}
        	});

        	$( "#rating" ).click(function()
            {
        		$("#monto").focus();
        		var n = Date.now();

        		$.getJSON("json/rating.json?"+n,function(result)
        		{
            		var monto=result[0].monto;
            		var compras=result[0].compras;
                    var compras_monto=result[0].compras_monto;

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

                    if(compras_monto!=0)
                    {
                        $("#compras_monto").val(compras_monto);
                    }
                    else
                    {
                        $("#compras_monto").val('');
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
