<?php
	include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
	require_once($_SERVER["REDIRECT_PATH_CONFIG"].'publicidad/models/class.Publicidad.php');
	require_once($_SERVER["REDIRECT_PATH_CONFIG"].'clientes/models/class.Clientes.php');
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
                    <strong>Enviar Campa&ntilde;as</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="./nueva_campana.php" class="btn btn-primary">Agregar Campa&ntilde;as</a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-7">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                             <h5>Clientes</h5>
                        </div>
                    </div>

                    <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tabla_clientes">
                    <thead>
                     <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>E-mail</th>
                        <th>Rating</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="clientes">
                    <?php
                   	$json=file_get_contents($_SERVER["REDIRECT_PATH_CONFIG"]."clientes/json/lista_clientes.json");
                    $json=json_decode($json);
                    $tr="";
                    foreach($json as $d)
                    {
                    	$id_cliente=$d->id_cliente;
                    	$cliente=$d->cliente;
                    	$rating="";
                    	$email=$d->email;
                    	
                    	
                    	
                    	$tr.='<tr class="gradeX">';
                    	$tr.='<td>'.$id_cliente.'</td>';
                    	$tr.='<td>'.$cliente.'</td>';
                    	$tr.='<td>'.$email.'</td>';
                    	$tr.='<td><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></td>';
                    	$tr.='<td><div class="infont col-md-1 col-sm-1"><input type="checkbox" name="cliente_'.$id_cliente.'" id="cliente_'.$id_cliente.'" value="'.$id_cliente.'" class="clientes"></div></td>';
                    	$tr.='</tr>';
                    	
                    }
                    echo $tr;                    
                    ?>
                   
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>E-mail</th>
                        <th>Rating</th>
                        <th></th>
                    </tr>
                    </tfoot>
                    </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="ibox float-e-margins">
                   <div class="ibox-title">
                        <div class="ibox-tools">
                             <h5>Campa&ntilde;as</h5>
                        </div>
                    </div>
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
                    <tbody>
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
                    	$tr.='<td><div class="infont col-md-1 col-sm-1"><input type="checkbox" name="publicidad_'.$id_publicidad.'" id="publicidad_'.$id_publicidad.'" value="'.$id_publicidad.'" class="publicidad"></div></td>';
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
    <div class="row">
	<div class="col-lg-12">
            <div class="col-sm-3 col-sm-offset-5">
            <button class="btn btn-white" id="cancelar" type="button">Cancelar</button>
			<button class="btn btn-primary" id="enviar" type="button">Enviar Campa&ntilde;a</button>
			</div>
			</div>
	</div>
    <script src="<?php echo $raizProy?>js/plugins/dataTables/datatables.min.js"></script>
    


    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){

        	$('#tabla_clientes').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    
                ]

            });

        	$('#tabla_publicidad').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    
                ]

            });
            
        });

        $( "#enviar" ).click(function()
		{	
        	var elements=new Object();
        	var publicidadA=new Array();
        	var clientesA=new Array();
        	
        	var publicidadE=0;
        	var clientesE=0;
        	
        	$("input:checkbox[class=publicidad]").each(function ()
			{
        		var publicidad={};
				publicidad.id=$(this).attr("value");
				publicidadA.push(publicidad);
				publicidadE++;
            });

        	elements.publicidad=publicidadA;

        	$("input:checkbox[class=clientes]").each(function ()
			{
        		var clientes={};
        		clientes.id=$(this).attr("value");
        		clientesA.push(clientes);
        		clientesE++;
            });

            elements.clientes=clientesA;

            if(clientesE==0)
            {
				alert("Debe de seleccionar al menos un Cliente");
            }
            else if(publicidadE==0)
            {
				alert("Debe de seleccionar al menos una Campa\u00f1a");
            }
            else
            {
            	var json=JSON.stringify(elements);

            	$.ajax
    			({
    				type: "POST",
    				url: "enviar_campanas_clientes.php",
    				data: json,
    				contentType: "application/json; charset=utf-8",
    				dataType: "json",
    				complete: function(data)
    				{
    					
    					
    				},
    				failure: function(errMsg)
    				{
    					alert(errMsg);
    				}
    			});	
            }
        	

			console.log(json);
        	
            alert("Envio de Campa\u00f1a exitoso");
            //var url="index.php";
            //$(location).attr("href", url);
		});

        $( "#cancelar" ).click(function()
		{
        	var url="index.php";
        	$(location).attr("href", url);
        });
    </script>


<?php
    include $pathProy.'footer.php';
?>