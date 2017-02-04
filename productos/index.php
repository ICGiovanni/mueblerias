<?php
	include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
	require_once($_SERVER["REDIRECT_PATH_CONFIG"].'productos/models/class.Productos.php');
	require_once($_SERVER["REDIRECT_PATH_CONFIG"].'inventarios/models/class.Inventarios.php');
   // include $pathProy.'login/session.php';
    include $pathProy.'/header.php';
    include $pathProy.'/menu.php';
    
    $productos=new Productos();
    $inventarios=new Inventarios();
?>
<link href="<?php echo $raizProy?>css/plugins/chosen/chosen.css" rel="stylesheet">
<link href="<?=$raizProy?>css/plugins/footable/footable.core.css" rel="stylesheet">
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
								Modelo<input type="text" id="nombre" name="nombre" class="form-control"> 
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
										<button type="button" class="btn btn-warning btn-xs"  onclick="location.href = '.';" >Limpiar Filtros</button>
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
                        <th>Modelo</th>
                        <th>Tipo</th>
                        <th>Color</th>
                        <th>Material</th>
                        <th>Categoria</th>
                        <th align="center">Inventario</th>
                        <th>Acciones</th>                        
                    </tr>
                    </thead>
                    <tbody id="productos">
                    <?php
                    $producto=new Productos();
                    
                    $productos=$producto->GetDataProductsMainJson();
                    
                   	$productos=json_decode($productos);
                   	$tr="";
                    foreach($productos as $p)
                    {
                    	
                    	$producto_id=$p->producto_id;
                    	$nombre=$p->producto_name;
                    	$conjunto=$p->producto_conjunto;
                    	$tipo=$p->producto_type_name;
                    	$tipo_abbrev=$p->producto_type;
                    	$sku=$p->producto_sku;
                    	$description=$p->producto_description;
                    	$price_utilitarian=$p->producto_price_purchase;
                    	$price_public=$p->producto_price_public;
                    	
                    	                    	
                    	$color="";
                    	foreach($p->colores as $c)
                    	{
	                    	$color.='<ul style="padding: 0" class="tag-list">';
	                    	$color.='<li><a href="" class="href_colores"><i class="fa fa-tag"></i> '.$c->color_name.'</a></li>';
	                    	$color.='</ul>';
                    	}
                    	
                    	$material="";
                    	foreach($p->materiales as $m)
                    	{
	                    	$material.='<ul style="padding: 0" class="tag-list">';
	                    	$material.='<li><a href="" class="href_colores"><i class="fa fa-tag"></i> '.$m->material_name.'</a></li>';
	                    	$material.='</ul>';
                    	}
                    	
                    	$categorias=$producto->GetProductCategory($producto_id);
                    	
                    	$categoria='<ul style="padding: 0" class="tag-list">';
                    	foreach($categorias as $c)
                    	{
                    		$categoria.='<li><a href="" class="href_colores"><i class="fa fa-tag"></i> '.$c.'</a></li>';
                    	}
                    	$categoria.='</ul>';
                    	
                    	
                    	$tr.='<tr class="gradeX">';
                    	$tr.='<td align="center">'.$sku.'</td>';
                    	$tr.='<td>'.$nombre.'</td>';
                    	$tr.='<td align="center">'.$tipo.'</td>';
                    	$tr.='<td>'.$color.'</td>';
                    	$tr.='<td>'.$material.'</td>';
                    	$tr.='<td>'.$categoria.'</td>';
                    	
                    	if($tipo_abbrev=='P')
                    	{
                    		$stock=$inventarios->GetStockVariation($producto_id);                    		
                    	}
                    	else if($tipo_abbrev=='U') 
                    	{
                    		$stock=$inventarios->GetStockbySucursal($producto_id);
                    	}
                    	
                    	                    	
                    	if($stock>0 && $tipo_abbrev!='P')
                    	{
                    		$tr.='<td align="center"><a href="#" class="link_modal" data-toggle="modal" data-target="#modal_view" data-id="'.$producto_id.'"  id="open_modal">'.$stock.'</a></td>';
                    	}
                    	else if($stock>0 && $tipo_abbrev=='P')
                    	{
                    		$tr.='<td align="center"><a href="#" class="modal_variaciones_stock" data-toggle="modal" data-target="#modal_variaciones_stock" data-id="'.$producto_id.'" data-json=\''.json_encode($p->variaciones).'\' data-root="'.$nombre.'" id="open_modal">'.$stock.'</a></div>';
                    	}
                    	else
                    	{
                    		if(!$stock)
                    		{
                    			$stock=0;
                    		}
                    		$stock="-";
                    		$tr.='<td align="center">'.$stock.'</td>';
                    	}
                    	$tr.='<td>';
                    	
                    	if(isset($p->variaciones))
                    	{
                    		if(count($p->variaciones))
                    		{
                    			$tr.='<div class="infont col-md-1 col-sm-1"><a href="#" class="modal_variaciones" data-toggle="modal" data-target="#modal_variaciones" data-id="'.$producto_id.'" data-json=\''.json_encode($p->variaciones).'\' data-root="'.$nombre.'" id="open_modal"><i class="fa fa-list-ul"></i></a></div>';
                    		}
                    	}
                    	$tr.='<div class="infont col-md-1 col-sm-1"><a href="editar_producto.php?id='.$producto_id.'" title="Editar Producto"><i class="fa fa-pencil"></i></a></div><div class="infont col-md-1 col-sm-1"><a href="#" onClick="borrar_producto('.$producto_id.');" title="Borrar Producto"><i class="fa fa-trash-o"></i></a></div></td>';
                    	$tr.='</tr>';
                    	
                    }
                    
                    echo $tr;      
                    ?>
                   
                    </tbody>
                    <tfoot>
                    <tr>
                    	<th>SKU</th>
                        <th>Modelo</th>
                        <th>Tipo</th>
                        <th>Color</th>
                        <th>Material</th>
                        <th>Categoria</th>
                        <th>Inventario</th>
                        <th>Acciones</th>                        
                    </tr>
                    </tfoot>
                    </table>
                        </div>

                    </div>
                </div>
            </div>
            </div>
	</div>
	
	<div class="modal inmodal fade" id="modal_view" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding: 15px">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h3 class="modal-title">Stock por Sucursal</h3>
            </div>
            <div class="modal-body" style="padding-bottom: 0px !important; margin-bottom: -15px !important">    
               <div class="form-group">
	           	
	           	<div class="col-sm-12" >
	           	           	
	           	<table class="table table-striped">
	           	<thead>
					<tr>
						<td>Sucursal</td>
						<td>Cantidad</td>
					</tr>
				</thead>
	           	<tbody id="products_table_list">
	           	
	           	</tbody>
	           	</table>
	           
    
    </div>
               </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="modal_view" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding: 15px">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h3 class="modal-title">Stock por Sucursal</h3>
            </div>
            <div class="modal-body" style="padding-bottom: 0px !important; margin-bottom: -15px !important">    
               <div class="form-group">
	           	
	           	<div class="col-sm-12" >
	           	           	
	           	<table class="table table-striped">
	           	<thead>
					<tr>
						<td>Sucursal</td>
						<td>Cantidad</td>
					</tr>
				</thead>
	           	<tbody id="products_table_list">
	           	
	           	</tbody>
	           	</table>
	           
    
    </div>
               </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="modal_variaciones" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding: 15px">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h3 class="modal-title" id="title_variations">Variaciones</h3>
            </div>
            <div class="modal-body" style="padding-bottom: 0px !important; margin-bottom: -15px !important">
            <div class="ibox-content">
	           	<table class="footable table table-bordered dataTables-example toggle-square" data-filter="#filter" id="tabla_variaciones">
	           	<thead>
					<tr>
						<td>SKU</td>
						<td>Modelo</td>
						<td>Color</td>
						<td>Material</td>
						<td>Stock</td>
						<td data-hide="all" style="text-align:right;display: none;"></td>
						<td>Acciones</td>
					</tr>
				</thead>
	           	<tbody id="products_variable">
	           	
	           	</tbody>
	           	</table>
		   	</div>
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="modal_variaciones_stock" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding: 15px">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h3 class="modal-title" id="title_variations_stock">Variaciones</h3>
            </div>
            <div class="modal-body" style="padding-bottom: 0px !important; margin-bottom: -15px !important">
            <div class="ibox-content">
	           	<table class="footable table table-bordered dataTables-example toggle-square" data-filter="#filter" id="tabla_variaciones_stock">
	           	<thead>
					<tr>
						<td>SKU</td>
						<td>Modelo</td>
						<td>Color</td>
						<td>Material</td>
						<td>Stock</td>
						<td data-hide="all" style="text-align:right;display: none;"></td>
						<td>Acciones</td>
					</tr>
				</thead>
	           	<tbody id="products_variable_stock">
	           	
	           	</tbody>
	           	</table>
		   	</div>
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


	<script src="<?=$raizProy?>js/plugins/footable/footable.all.min.js"></script>
	
    <script src="<?php echo $raizProy?>js/plugins/dataTables/datatables.min.js"></script>
    
	<script src="<?php echo $raizProy?>js/plugins/chosen/chosen.jquery.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){


        	
        	var table=$('#tabla_productos').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [],
                "language": {
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
							filas+='<td align="center">'+item.producto_sku+'</td>';
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
							
							filas+='<td align="center">'+item.stock+'</td>';
							filas+='<td><div class="infont col-md-1 col-sm-1"><a href="editar_producto.php?id='+item.producto_id+'" title="Editar Producto"><i class="fa fa-pencil"></i></a></div><div class="infont col-md-1 col-sm-1"><a href="#" onClick="borrar_producto('+item.producto_id+');" title="Borrar Producto"><i class="fa fa-trash-o"></i></a></div></td>';
    		        		filas+='</tr>';
            	    	});
        		        $("#productos").append(filas);
    		        	
    		        	setTimeout(function(){
    		        		table=$('#tabla_productos').DataTable({
	    		                dom: '<"html5buttons"B>lTfgitp',
	    		                buttons: [],"language": {
	    		                    "url": "../js/plugins/dataTables/Spanish.json"
	    		            	}
	
	    		            });
    		        	}, 1000);
    				}
    			});            		
            });
	
            $("a.link_modal").click(function()
        	{
        		var id=$(this).data("id");
        		var action=$(this).data("action");
        			
        		$.getJSON( "../inventarios/inventario.php?t=is&id="+id, function( result )
        		{
        			var table="";
        			var tr='';
        			$.each(result, function(i, field)
        			{
        				tr+='<tr>';
        				tr+='<td>'+field.sucursal_name+'</td>';
        				tr+='<td>'+field.stock+'</td>';
        				tr+='</tr>';
        						
					});

        			$("#products_table_list").html(tr);
        		});
			});	
            

        	$("#color").chosen();
        	$("#tipo").chosen();
        	$("#material").chosen();
        	$("#categoria").chosen();

        	$("a.modal_variaciones").click(function()
        	{	
            	var root=$(this).data("root");
        		var json=$(this).data("json");
				
        		$("#title_variations").html(root);
        		
				var tr="";
        		$.each(json, function(i, field)
                {
                    var producto_id=field.producto_id;
					tr+='<tr>';
					tr+='<td>'+field.producto_sku+'</td>';
					tr+='<td>'+field.producto_name+'</td>';
					tr+='<td>'+field.color_name+'</td>';
					tr+='<td>'+field.material_name+'</td>';
					tr+='<td style="text-align:center;">';
					
					tr+='<label>'+field.stock+'</label>';
					
					tr+='</td>';

					
					tr+='<td style="display: none;">';
					var stock_sucursal="<b>Cantidad por Sucursal:</b><br>";
					var bandera=false;
					$.each(field.stock_sucursal, function(k,j)
			        {
						stock_sucursal+=j.sucursal_name+' <i class="fa fa-long-arrow-right"></i> '+j.stock;
						bandera=true;	
			        });

			        if(!bandera)
			        {
			        	stock_sucursal='No existe inventario';
			        }

			        tr+=stock_sucursal;
					tr+='</td>';
					
					tr+='<td>'+'<div class="infont col-md-1 col-sm-1"><a href="editar_producto.php?id='+producto_id+'" title="Editar Producto"><i class="fa fa-pencil"></i></a></div><div class="infont col-md-1 col-sm-1"><a href="#" onClick="borrar_producto('+producto_id+');" title="Borrar Producto"><i class="fa fa-trash-o"></i></a></div>'+'</td>';
					tr+='</tr>';
                });

        		$("#products_variable").html(tr);
        		
        		setTimeout(function(){
        		$('#tabla_variaciones').footable({
        			"paging": {
        				"enabled": true
        			},
        			"filtering": {
        				"enabled": true
        			},
        			"sorting": {
        				"enabled": true
        			}
        		});},500);
        	});


        	$("a.modal_variaciones_stock").click(function()
                	{	
                    	var root=$(this).data("root");
                		var json=$(this).data("json");
        				
                		$("#title_variations_stock").html(root);
                		
        				var tr="";
                		$.each(json, function(i, field)
                        {
                            var producto_id=field.producto_id;
        					tr+='<tr>';
        					tr+='<td>'+field.producto_sku+'</td>';
        					tr+='<td>'+field.producto_name+'</td>';
        					tr+='<td>'+field.color_name+'</td>';
        					tr+='<td>'+field.material_name+'</td>';
        					tr+='<td style="text-align:center;">';
        					
        					tr+='<label>'+field.stock+'</label>';
        					
        					tr+='</td>';

        					
        					tr+='<td style="display: none;">';
        					var stock_sucursal="<b>Cantidad por Sucursal:</b><br>";
        					var bandera=false;
        					$.each(field.stock_sucursal, function(k,j)
        			        {
        						stock_sucursal+=j.sucursal_name+' <i class="fa fa-long-arrow-right"></i> '+j.stock;
        						bandera=true;	
        			        });

        			        if(!bandera)
        			        {
        			        	stock_sucursal='No existe inventario';
        			        }

        			        tr+=stock_sucursal;
        					tr+='</td>';
        					
        					tr+='<td>'+'<div class="infont col-md-1 col-sm-1"><a href="editar_producto.php?id='+producto_id+'" title="Editar Producto"><i class="fa fa-pencil"></i></a></div><div class="infont col-md-1 col-sm-1"><a href="#" onClick="borrar_producto('+producto_id+');" title="Borrar Producto"><i class="fa fa-trash-o"></i></a></div>'+'</td>';
        					tr+='</tr>';
                        });

                		$("#products_variable_stock").html(tr);
                		
                		setTimeout(function(){
                		$('#tabla_variaciones_stock').footable({
                			"paging": {
                				"enabled": true
                			},
                			"filtering": {
                				"enabled": true
                			},
                			"sorting": {
                				"enabled": true
                			}
                		});},500);
                	});
            
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