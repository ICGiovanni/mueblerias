<?php
	include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
	require_once($_SERVER["REDIRECT_PATH_CONFIG"].'inventarios/models/class.Inventarios.php');
	require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/general/class.General.php');
   // include $pathProy.'login/session.php';
    include $pathProy.'/header.php';
    include $pathProy.'/menu.php';
    
    $inventarios=new Inventarios();
    $general=new General();
?>
<link href="<?php echo $raizProy?>css/plugins/chosen/chosen.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/easy-autocomplete/easy-autocomplete.min.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/chosen/chosen.css" rel="stylesheet">

<style>
a.href_colores{
pointer-events: none;
cursor: default;
}

#table_search td
{
	padding: 5px;
}

#color_chosen
{
	display:block;
}

#material_chosen
{
	display:block;
}

#categoria_chosen
{
	display:block;
}
#tipo_chosen
{
	display:block;
}
</style>

 <div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-4">
		<h2>Inventario</h2>
		<ol class="breadcrumb">
			<li>
				<a href="">Inventarios</a>
			</li>
			
			<li class="active">
				<strong>Inventario</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-8">
		<div class="title-action">
			<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_nuevo_inventario" >
			+ Nuevo Movimiento
			</button>
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
					<div id="div_search_tools">

					</div>
					
					
                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tabla_movimientos">
                    <thead>
                    <tr>
                    	<th>ID</th>
                        <th>Salida</th>
                        <th>Sucursal de Salida</th>
                        <th>Fecha de Salida</th>
                        <th>Entrada</th>
                        <th>Sucursal de Entrada</th>
                        <th>Fecha de Entrada</th>
                        <th>Estatus</th>
                        <th></th>                        
                    </tr>
                    </thead>
                    <tbody id="movimientos">
                    <?php
                    $movimientos=$inventarios->GetMoves();
                    $tr="";
                    
                    foreach($movimientos as $m)
                    {
                    	$movimiento_id=$m["movimiento_id"];
                    	$salida=$m["salida"];
                    	$fecha_salida=$m["fecha_salida"];
                    	$sucursal_salida=$m['sucursal_salida'];
                    	
                    	if($fecha_salida)
                    	{
                    		$fecha_salida=$general->getDate($fecha_salida);
                    	}
                    	
                    	$entrada=$m['entrada'];
                    	$fecha_entrada=$m['fecha_entrega'];
                    	$sucursal_entrada=$m['sucursal_entrada'];
                    	$nota_salida=$m['nota_salida'];
                    	$nota_entrega=$m['nota_entrega'];
                    	
                    	if($fecha_entrada)
                    	{
                    		$fecha_entrada=$general->getDate($fecha_entrada);
                    	}
                    	
                    	$estatus=$m['estatus'];
                    	$estatus_etiqueta=$m['estatus_etiqueta'];
                    	
                    	
                    	$tr.='<tr class="gradeX">';
                    	$tr.='<td>'.$movimiento_id.'</td>';
                    	$tr.='<td>'.$salida.'</td>';
                    	$tr.='<td>'.$sucursal_salida.'</td>';
                    	$tr.='<td>'.$fecha_salida.'</td>';
                    	$tr.='<td>'.$entrada.'</td>';
                    	$tr.='<td>'.$sucursal_entrada.'</td>';
                    	$tr.='<td>'.$fecha_entrada.'</td>';
                    	$tr.='<td>'.$estatus_etiqueta.'</td>';
                    	$tr.='<td><div class="infont col-md-1 col-sm-1">';
                    	$tr.='<a href="#" class="link_modal" data-toggle="modal" data-target="#modal_view" data-id="'.$movimiento_id.'"  id="open_modal">';
                    	
                    	if($nota_entrega || $nota_salida)
                    	{
                    		$tr.='<i class="fa fa-file-text-o"></i></a>';
                    	}
                    	else 
                    	{
                    		$tr.='<i class="fa fa-search"></i></a>';
                    	}
                    	
                    	if($estatus=='PE')
                    	{
                    		$tr.='<a href="#" class="link_modal_check" data-toggle="modal" data-target="#modal_check" data-id="'.$movimiento_id.'" id="open_modal"><i class="fa fa-check"></i></a>';
                    	}
                        $tr.='</div></td>';
                    	$tr.='</tr>';
                    	
                    }
                    
                    echo $tr;         
                    ?>
                   
                    </tbody>
                    <tfoot>
                    <tr>
                    	<th>ID</th>
                        <th>Salida</th>
                        <th>Sucursal de Salida</th>
                        <th>Fecha de Salida</th>
                        <th>Entrada</th>
                        <th>Sucursal de Entrada</th>
                        <th>Fecha de Entrada</th>
                        <th>Estatus</th>
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
<script src="<?php echo $raizProy?>js/plugins/toastr/toastr.min.js"></script>
<script src="<?php echo $raizProy?>js/plugins/chosen/chosen.jquery.js"></script>
<script src="<?php echo $raizProy?>js/plugins/easy-autocomplete/jquery.easy-autocomplete.min.js"></script>
<script src="<?php echo $raizProy?>js/plugins/dataTables/datatables.min.js"></script>

	<div class="modal inmodal fade" id="modal_view" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding: 15px">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h3 class="modal-title">Productos</h3>
            </div>
            <div class="modal-body" style="padding-bottom: 0px !important; margin-bottom: -15px !important">    
               <form method="post" class="form-horizontal" action="/" >
               <div class="form-group">
	           	
	           	<div class="col-sm-12" >
	           	           	
	           	<table class="table table-striped">
	           	<thead>
					<tr>
						<td>SKU</td>
						<td>Nombre</td>
						<td>Cantidad</td>
					</tr>
				</thead>
	           	<tbody id="products_table_list">
	           	
	           	</tbody>
	           	</table>
	           
    
    			</div>
               </div>
               
               <div class="form-group">
					<label class="col-sm-3 control-label">Chofer</label>
					<div class="col-sm-8" >
					<label id="chofer"></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Observaciones de Salida</label>
					<div class="col-sm-8" >
					<label id="nota_salida"></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Observaciones de Entrega</label>
					<div class="col-sm-8" >
					<label id="nota_entrega"></label>
					</div>
				</div>
				</form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
	
<div class="modal inmodal fade" id="modal_check" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="padding: 15px">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
				<h3 class="modal-title">Productos</h3>
			</div>
			<div class="modal-body" style="padding-bottom: 0px !important; margin-bottom: -15px !important">    
				<div class="wrapper wrapper-content animated fadeInRight">
				<form method="post" class="form-horizontal" action="/" >
				<div class="form-group">

					<div class="col-sm-12" >
							
					<table class="table table-striped">
					<thead>
					<tr>
						<td>SKU</td>
						<td>Nombre</td>
						<td>Cantidad</td>
					</tr>
					</thead>
					<tbody id="products_table_list_check">

					</tbody>
					</table>


				</div>

				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Chofer</label>
					<div class="col-sm-8" >
					<label id="chofer_check"></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Observaciones de Salida</label>
					<div class="col-sm-8" >
					<label id="nota_salida_check"></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Observaciones de Entrega</label>
					<div class="col-sm-8" >
					<textarea class="form-control" id="nota_entrega_check" name="nota_entrega"></textarea>
					</div>
				</div>
				</form>
				</div>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary btn-xs" id="recibir_productos" id="button_check" >Recibir Productos</button>
			</div>
		</div>
	</div>
</div>


<input id="move_id" type="hidden" value=""> 

<div class="modal inmodal fade" id="modal_nuevo_inventario" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding: 15px">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h3 class="modal-title">Inventario</h3>
            </div>
            <div class="modal-body" style="padding-bottom: 0px !important; margin-bottom: -15px !important">    
                <?php include_once 'nueva_solicitud.php' ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary btn-xs" id="guardar_inventario" >Guardar</button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo $raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>    
<script src="<?php echo $raizProy?>js/plugins/chosen/chosen.jquery.js"></script>
    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){

        	var table=$('#tabla_movimientos').DataTable({
        		"order": [[ 1, "desc" ]],
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [],"language": {
                    "url": "../js/plugins/dataTables/Spanish.json"
            	}

            });

            $("a.link_modal").click(function()
			{
				var id=$(this).data("id");
				var action=$(this).data("action");
				
				$.getJSON( "inventario.php?t=j&id="+id, function( result )
				{
					var table="";
					var tr='';
					$.each(result, function(i, field)
					{
						
						tr+='<tr>';
						tr+='<td>'+field.producto_sku+'</td>';
						tr+='<td>'+field.producto_name+'</td>';
						tr+='<td>'+field.cantidad+'</td>';
						tr+='</tr>';
						
			        });

					$("#products_table_list").html(tr);
				});

				var type='ns';
            	$.getJSON( "inventario.php?t=ns&id="+id, function( result )
				{
	    			$.each(result, function(i, field)
            		{
	    				$("#chofer").text(field.chofer);
	    				$("#nota_salida").text(field.nota_salida);
	    				$("#nota_entrega").text(field.nota_entrega);
					});
				});
            });

            $("a.link_modal_check").click(function()
            {
            	var id=$(this).data("id");

            	$("#move_id").val(id);
            		
            	$.getJSON( "inventario.php?t=j&id="+id, function( result )
            	{
            		var table="";
            		var tr='';
            		$.each(result, function(i, field)
            		{
            					
            			tr+='<tr>';
            			tr+='<td>'+field.producto_sku+'</td>';
            			tr+='<td>'+field.producto_name+'</td>';
            			tr+='<td>'+field.cantidad+'</td>';
            			tr+='</tr>';
            				
            		});

            		$("#products_table_list_check").html(tr);
            	});

            	var type='ns';
            	$.getJSON( "inventario.php?t=ns&id="+id, function( result )
				{
	    			$.each(result, function(i, field)
            		{
	    				$("#chofer_check").text(field.chofer);
	    				$("#nota_salida_check").text(field.nota_salida);
					});
				});
            });

            $("#recibir_productos").click(function()
            {
            	var move_id=$("#move_id").val();
            	var nota_entrega=$("#nota_entrega_check").val();
            	var type='r';
            	
            	$.ajax(
				{
    		        url: "inventario.php",
    		        type: 'POST',
    		        data: {t:type,id:move_id,nota:nota_entrega},
    		        async: false,
    		        success: function (data)
    		        {
    		        	$('#modal_check').modal('hide');
    		        	swal({
			                title: "Guardado!",
			                text: "Movimiento guardado correctamente!",
			                type: "success"
			            }, function () {
			                window.location.href = 'index.php';
			            });
    				}
    		
    			});
            });

            
        });

        function borrar_movimiento(producto_id)
        {
        	var url="borrar_producto.php";
        	var r=confirm("\u00BFDesea continuar?");

        	if(r==true)
        	{			 
				$.ajax(
				{
			    	type: "POST",
			        url: url,
			        data: {id:producto_id}, // serializes the form's elements.
			        success: function(data)
			        {
			        	swal({
			                title: "Guardado!",
			                text: "Movimiento guardado correctamente!",
			                type: "success"
			            }, function () {
			                window.location.href = 'index.php';
			            });
					}
				});
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

    </script>


<?php
    include $pathProy.'footer.php';
?>