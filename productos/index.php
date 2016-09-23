<?php
	include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
	require_once($_SERVER["REDIRECT_PATH_CONFIG"].'productos/models/class.Productos.php');
   // include $pathProy.'login/session.php';
    include $pathProy.'/header.php';
    include $pathProy.'/menu.php';
?>
<<style>
a.href_colores{
pointer-events: none;
cursor: default;
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
                <a href="./nuevo_producto.php" class="btn btn-primary btn-xs">Nuevo Producto</a>
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
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tabla_productos">
                    <thead>
                    <tr>
                    	<th>SKU</th>
                        <th>Producto</th>
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
                    	$sku=$p['producto_sku'];
                    	$description=$p['producto_description'];
                    	$price_utilitarian=$p['producto_price_utilitarian'];
                    	$price_public=$p['producto_price_public'];
                    	
                    	$colores=$producto->GetProductColor($producto_id);
                    	
                    	$color='<ul style="padding: 0" class="tag-list">';
                    	foreach($colores as $c)
                    	{
                    		$color.='<li><a href="" class="href_colores"><i class="fa fa-tag"></i> '.$c.'</a></li>';
                    	}
                    	$color.='</ul>';
                    	
                    	$materiales=$producto->GetProductMaterial($producto_id);
                    	
                    	$material='<ul style="padding: 0" class="tag-list">';
                    	foreach($materiales as $m)
                    	{
                    		$material.='<li><a href="" class="href_colores"><i class="fa fa-tag"></i> '.$m.'</a></li>';
                    	}
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
                ],"language": {
                    "url": "../js/plugins/dataTables/Spanish.json"
            	}

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