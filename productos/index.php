<?php
	include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
	require_once($_SERVER["REDIRECT_PATH_CONFIG"].'productos/models/class.Productos.php');
   // include $pathProy.'login/session.php';
    include $pathProy.'/header.php';
    include $pathProy.'/menu.php';
    
    $productos=new Productos();
?>
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
            <h2>Productos</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">Productos</a>
                </li>
                <li class="active">
                    <strong>Lista de Productos</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="./nuevo_producto.php" class="btn btn-primary btn-xs">+ Nuevo Producto</a>
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
					FILTRAR BUSQUEDA POR
					<form method="post" action="/" id="form_filtro" enctype="multipart/form-data">
					
					<table class="table-form" id="table_search">
					<tr>
						<td>
							<div class="form-group" id="data_sku" >
								SKU<input type="text" id="sku" name="sku" class="form-control"> 
							</div>
						</td>
						<td>
							<div class="form-group" id="data_nombre" >
								Nombre<input type="text" id="nombre" name="nombre" class="form-control"> 
							</div>
						</td>
						<td>
							<div class="form-group" id="data_color" >
								Tipo
								<select data-placeholder="Selecciona un tipo" class="chosen-select form-control" style="width:200px;" tabindex="4" id="tipo" name="tipo">
					            <option value=""></option>
					            <option value="U">&Uacute;nico</option>
					            <option value="C">Conjunto</option>
					            </select> 
							</div>
						</td>
						<td>
							<div class="form-group" id="data_color" >
								Color
								<select data-placeholder="Selecciona un color" class="chosen-select form-control" multiple style="width:200px;" tabindex="4" id="color" name="color[]">
					            <option value=""></option>
					            <?php 
					            					            
					            $result=$productos->GetColors();
					            
					            $list="";
					            foreach($result as $r)
					            {
					            	$list.='<option value="'.$r['color_id'].'">'.$r['color_name'].'</option>';
					            }
					            
					            echo $list;
					            
					            ?>
								</select> 
							</div>
						</td>
						<td>
							<div class="form-group" id="data_material" >
								Material
								<select data-placeholder="Selecciona un material" class="chosen-select" multiple style="width:200px;" tabindex="4" id="material" name="material[]">
					            <option value=""></option>
					            <?php 
					            $result=$productos->GetMaterials();
					            
					            $list="";
					            foreach($result as $r)
					            {
					            	$list.='<option value="'.$r['material_id'].'">'.$r['material_name'].'</option>';
					            }
					            
					            echo $list;
					            
					            ?>
								</select>
							</div>
						</td>
					</tr>
					<tr>
						
						<td>
						<div class="form-group" id="data_material">
								Categoria
								<select data-placeholder="Selecciona una categoria" class="chosen-select" multiple style="width:200px;" tabindex="4" id="categoria" name="categoria[]">
	            <option value=""></option>
	            <?php 
	           $result=$productos->GetCategories();
	            
	            $list="";
	            foreach($result as $r)
	            {
	            	$list.='<option value="'.$r['categoria_id'].'">'.$r['categoria_name'].'</option>';
	            }
	            
	            echo $list;
	            
	            ?>
				</select>
							</div>
							</td>
							<td colspan="4">
							<button type="button" class="btn btn-primary btn-xs" id="filtar">Filtrar</button> &nbsp;&nbsp;&nbsp;
										<button type="button" class="btn btn-warning btn-xs"  onclick="location.href = '.';" >Limpiar</button>
							</td>
					</tr>
					</table>
					
					</form>
					
					</div>
					
					
                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tabla_productos">
                    <thead>
                    <tr>
                    	<th>SKU</th>
                        <th>Producto</th>
                        <th>Tipo</th>
                        <th>Color</th>
                        <th>Material</th>
                        <th>Categoria</th>
                        <th>Precio P&uacute;blico</th>
                        <th></th>                        
                    </tr>
                    </thead>
                    <tbody id="productos">
                    <?php
                    $producto=new Productos();
                    $productos=$producto->GetDataProduct();
                    $tr="";
                    
                    foreach($productos as $p)
                    {
                    	$producto_id=$p["producto_id"];
                    	$nombre=$p["producto_name"];
                    	$tipo=$p["producto_type"];
                    	$sku=$p['producto_sku'];
                    	$description=$p['producto_description'];
                    	$price_utilitarian=$p['producto_price_utilitarian'];
                    	$price_public=$p['producto_price_public'];
                    	                    	
                    	$color='<ul style="padding: 0" class="tag-list">';
                    	$color.='<li><a href="" class="href_colores"><i class="fa fa-tag"></i> '.$p['color_name'].'</a></li>';
                    	$color.='</ul>';
                    	                    	
                    	$material='<ul style="padding: 0" class="tag-list">';
                    	$material.='<li><a href="" class="href_colores"><i class="fa fa-tag"></i> '.$p['material_name'].'</a></li>';
                    	$material.='</ul>';
                    	
                    	$categorias=$producto->GetProductCategory($producto_id);
                    	
                    	$categoria='<ul style="padding: 0" class="tag-list">';
                    	foreach($categorias as $c)
                    	{
                    		$categoria.='<li><a href="" class="href_colores"><i class="fa fa-tag"></i> '.$c.'</a></li>';
                    	}
                    	$categoria.='</ul>';
                    	
                    	
                    	$tr.='<tr class="gradeX">';
                    	$tr.='<td>'.$sku.'</td>';
                    	$tr.='<td>'.$nombre.'</td>';
                    	$tr.='<td>'.$tipo.'</td>';
                    	$tr.='<td>'.$color.'</td>';
                    	$tr.='<td>'.$material.'</td>';
                    	$tr.='<td>'.$categoria.'</td>';
                    	$tr.='<td>$ '.$price_public.'</td>';
                    	$tr.='<td><div class="infont col-md-1 col-sm-1"><a href="editar_producto.php?id='.$producto_id.'"><i class="fa fa-pencil"></i></a></div><div class="infont col-md-1 col-sm-1"><a href="#" onClick="borrar_producto('.$producto_id.');"><i class="fa fa-trash-o"></i></a></div></td>';
                    	$tr.='</tr>';
                    	
                    }
                    
                    echo $tr;         
                    ?>
                   
                    </tbody>
                    <tfoot>
                    <tr>
                    	<th>SKU</th>
                        <th>Producto</th>
                        <th>Tipo</th>
                        <th>Color</th>
                        <th>Material</th>
                        <th>Categoria</th>
                        <th>Precio P&uacute;blico</th>
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
    
	<script src="<?php echo $raizProy?>js/plugins/chosen/chosen.jquery.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){

        	var table=$('#tabla_productos').DataTable({
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
                ],"language": {
                    "url": "../js/plugins/dataTables/Spanish.json"
            	}

            });

            $("#filtar").click(function()
			{
            	var url="product_search.php";
   			 
    			$.ajax(
    			{
    		    	type: "POST",
    		        url: url,
    		        data: $("#form_filtro").serialize(), // serializes the form's elements.
    		        success: function(data)
    		        {
    		        	var filas="";
    		        	table.destroy();
    		        	
    		        	$("#productos tr").remove();
        		        $.each( data, function( key, item )
            	    	{
        		        	filas+='<tr>';
							filas+='<td>'+item.producto_sku+'</td>';
							filas+='<td>'+item.producto_name+'</td>';
							filas+='<td>'+item.producto_type+'</td>';

							filas+='<td>';
							filas+='<ul style="padding: 0" class="tag-list">';
							filas+='<li><a href="" class="href_colores"><i class="fa fa-tag"></i> '+item.color_name+'</a></li>';
			    	    	filas+='</ul>';
			    	    	filas+='</td>';

			    	    	filas+='<td>';
							filas+='<ul style="padding: 0" class="tag-list">';
							filas+='<li><a href="" class="href_colores"><i class="fa fa-tag"></i> '+item.material_name+'</a></li>';
			    	    	filas+='</ul>';
			    	    	filas+='</td>';

			    	    	filas+='<td>';
							filas+='<ul style="padding: 0" class="tag-list">';
							if(item.categoria!=undefined)
							{
								$.each( item.categoria, function( key, item )
				    	    	{
									filas+='<li><a href="" class="href_colores"><i class="fa fa-tag"></i> '+item+'</a></li>';
				    	    	});
							}
			    	    	filas+='</ul>';
			    	    	filas+='</td>';
							
							filas+='<td>$ '+item.producto_price_public+'</td>';
							filas+='<td><div class="infont col-md-1 col-sm-1"><a href="editar_producto.php?id='+item.producto_id+'"><i class="fa fa-pencil"></i></a></div><div class="infont col-md-1 col-sm-1"><a href="#" onClick="borrar_producto('+item.producto_id+');"><i class="fa fa-trash-o"></i></a></div></td>';
    		        		filas+='</tr>';
            	    	});
        		        $("#productos").append(filas);
    		        	
    		        	setTimeout(function(){
    		        		table=$('#tabla_productos').DataTable({
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
	    		                ],"language": {
	    		                    "url": "../js/plugins/dataTables/Spanish.json"
	    		            	}
	
	    		            });
    		        	}, 1000);
    				}
    			});            		
            });

        	$("#color").chosen();
        	$("#tipo").chosen();
        	$("#material").chosen();
        	$("#categoria").chosen();
            
        });

        function borrar_producto(producto_id)
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
			        	alert("El Producto ha sido borrado"); // show response from the php script.
			        	var url="index.php";
			    		$(location).attr("href", url);
					}
				});
        	}
        }

    </script>


<?php
    include $pathProy.'footer.php';
?>