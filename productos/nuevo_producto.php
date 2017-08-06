<?php
    include $_SERVER['REDIRECT_PATH_CONFIG'].'/config.php';
    //include $pathProy.'login/session.php';
    require_once($_SERVER["REDIRECT_PATH_CONFIG"].'productos/models/class.Productos.php');
    require_once($_SERVER["REDIRECT_PATH_CONFIG"].'proveedores/models/class.Proveedores.php');
    include $pathProy.'/header.php';
    include $pathProy.'/menu.php';
?>
<link href="<?php echo $raizProy?>css/plugins/chosen/chosen.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/easy-autocomplete/easy-autocomplete.min.css" rel="stylesheet">
<link href="<?php echo $raizProy?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

<style>
#product_list
{
	display:none;
}
#div_conjunto
{
	display:none;
}
</style>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Nuevo Producto</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">Productos</a>
                </li>
                <li class="active">
                    <strong>Nuevo Producto</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="./index.php" class="btn btn-warning btn-xs"><i class="fa fa-arrow-left"></i> Regresar a listado</a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
		<form method="post" class="form-horizontal" action="/" id="form_productos" enctype="multipart/form-data">
			<input type="hidden" id="code" name="code" value="">
			
			<div class="form-group">
            <label class="col-sm-2 control-label">Tipo de Producto</label>
			<div class="col-sm-6" >
				<select data-placeholder="Selecciona el tipo de Producto" class="chosen-select" style="width:300px;" tabindex="4" id="tipo_producto" name="tipo_producto">
	            <option value="" data-abrev=""></option>
	            <option value="P" data-abrev="">Producto Unitario</option>
	            <option value="U" data-abrev="" selected>Producto Compuesto</option>	            
				</select>
			</div>
            </div>
            
            <div class="form-group"><label class="col-sm-2 control-label"></label>
			<div class="col-sm-6" >*Este campo define un producto que esta compuesto por uno a mas productos asociados, pero pueden seguir utilizados para la venta por separado.</div>
            </div>
			
			<div class="form-group"><label class="col-sm-2 control-label">Modelo</label>
			<div class="col-sm-6" ><input type="text" class="form-control" id="nombre" name="nombre" autocomplete=off></div>
            </div>
            <div class="form-group">
            <label class="col-sm-2 control-label">SKU</label>
			<div class="col-sm-4 ">
			<input type="text" class="form-control" id="sku" name="sku" readonly>
			</div>
			<label class="col-sm-1 control-label">Manual</label>
			<div class="col-sm-1 ">
			<input type="checkbox" name="manual" id="manual" value="">
			</div>
            </div>
            <div id="div_principal">
            		
			<div class="form-group">
            <label class="col-sm-2 control-label">Medida</label>
			<div class="col-sm-6 "><input type="text" class="form-control" id="medida" name="medida"></div>
			</div>
            <div class="form-group"><label class="col-sm-2 control-label">Descripci&oacute;n</label>
			<div class="col-sm-6" ><textarea class="form-control" id="descripcion" name="descripcion"></textarea></div>
            </div>
            
            <div class="form-group"><label class="col-sm-2 control-label">Descripci&oacute;n Corta</label>
			<div class="col-sm-6" >
			<input type="text" class="form-control" id="descripcionC" name="descripcionC" autocomplete="off">
            </div>
            </div>
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Categorias</label>
			<div class="col-sm-6" >
				<select data-placeholder="Selecciona una categoria" class="chosen-select" multiple style="width:300px;" tabindex="4" id="categoria" name="categoria[]">
	            <option value=""></option>
	            <?php 
	            $productos=new Productos();
	            
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
            </div>
            
            <div id="div_variantes">
	           	<div class="form-group">
	           	<label class="col-sm-2 control-label">Productos Variantes</label>
	           	<div class="col-sm-6" ><input type="text" class="form-control" id="productoV" name="productoV"></div>
	           	</div>
	           	
	           	<div class="form-group">
	           	<div class="col-sm-2" ></div>
	           	<div class="col-sm-6" >
	           	<div id="product_list_variante" class="ibox-content">
	           	
	           	<table class="table table-striped">
	           	<thead>
					<tr>
						<td></td>
						<td>SKU</td>
						<td>Nombre</td>
						<td></td>
					</tr>
				</thead>
	           	<tbody id="products_table_variante">
	           	
	           	</tbody>
	           	</table>
	           </div>
	           </div>
	           </div>
            
            
            </div>
           </div>
            
            <div id="div_producto_padre" style="display:none;">
            <div class="form-group">
	           	<label class="col-sm-2 control-label">Producto Principal</label>
	           	<div class="col-sm-6" ><input type="text" class="form-control" id="producto_padre" name="producto_padre"></div>
	           	</div>
	        </div>
	        
            <input type="hidden" class="form-control" id="producto_padre_id" name="producto_padre_id" value="0">
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Proveedor</label>
			<div class="col-sm-6" >
				<select data-placeholder="Selecciona un proveedor" class="chosen-select" style="width:300px;" tabindex="4" id="proveedor" name="proveedor">
	            <option value="" data-name=""></option>
	            <?php 
	            $proveedor=new Proveedor();
	            
	            $result=$proveedor->getProveedores();
	            
	            $list="";
	            foreach($result as $r)
	            {
	            	$list.='<option value="'.$r['proveedor_id'].'" data-name="'.$r['proveedor_nombre'].'">'.$r['proveedor_nombre'].'</option>';
	            }
	            
	            echo $list;
	            
	            ?>
				</select>
			</div>
            </div>
            <div id="div_variacion">
            
             <div class="form-group">
            <label class="col-sm-2 control-label">Version(es)</label>
			<div class="col-sm-6" >
				<select data-placeholder="Selecciona una versión" class="chosen-select" style="width:300px;" tabindex="4" id="version" name="version">
	            <option value="" data-abrev=""></option>
	            <?php 
	            $productos=new Productos();
	            
	            $result=$productos->GetVersions();
	            
	            $list="";
	            foreach($result as $r)
	            {
	            	$list.='<option value="'.$r['version_id'].'" data-abrev="'.$r['version_abrev'].'">'.$r['version_name'].'</option>';
	            }
	            
	            echo $list;
	            
	            ?>
				</select>
			</div>
            </div>
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Color(es)</label>
			<div class="col-sm-6" >
				<select data-placeholder="Selecciona un color" class="chosen-select" style="width:300px;" tabindex="4" id="color" name="color">
	            <option value="" data-abrev=""></option>
	            <?php 
	            $productos=new Productos();
	            
	            $result=$productos->GetColors();
	            
	            $list="";
	            foreach($result as $r)
	            {
	            	$list.='<option value="'.$r['color_id'].'" data-abrev="'.$r['color_abrev'].'">'.$r['color_name'].'</option>';
	            }
	            
	            echo $list;
	            
	            ?>
				</select>
			</div>
            </div>
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Material(es)</label>
			<div class="col-sm-6" >
				<select data-placeholder="Selecciona un material" class="chosen-select" style="width:300px;" tabindex="4" id="material" name="material">
	            <option value="" data-abrev=></option>
	            <?php 
	            $productos=new Productos();
	            
	            $result=$productos->GetMaterials();
	            
	            $list="";
	            foreach($result as $r)
	            {
	            	$list.='<option value="'.$r['material_id'].'" data-abrev="'.$r['material_abrev'].'">'.$r['material_name'].'</option>';
	            }
	            
	            echo $list;
	            
	            ?>
				</select>
			</div>
            </div>
           
            
            <div class="col-lg-11">
			<div class="panel panel-default">
            <div class="panel-heading">
            <label class="control-label">Precio Lista</label>
			</div>
            <div class="panel-body">
            	
            <div class="form-group">
            <label class="col-sm-2 control-label">Precio</label>
			<div class="col-sm-2 ">
			<div class="input-group m-b">
			<span class="input-group-addon">$</span>
			<input type="text" class="form-control" id="precioU" name="precioU" onkeypress="return validateNumber(event)">
			</div>
			</div>
			<div class="col-sm-5 ">
			<div class="input-group m-b">
			<span class="input-group-addon" style="font-size:13px !important;"><label class="control-label">Precio con Descuento</label></span>
			<span class="input-group-addon">-$</span>
			<input type="text" class="form-control" id="precioUD" name="precioUD" readonly="readonly">
			
			</div>
			</div>
            </div>
            
            <div class="form-group">
           	<label class="col-sm-2 control-label">Porcentaje de Descuento</label>
           	<div class="col-sm-2 ">
           	<div class="input-group m-b">
           	<input class="form-control discount" id="descuento" name="descuento[]" value="" type="text" onkeypress="return validateNumber(event)">
           	<span class="input-group-addon">%</span>
           	</div>
           	</div>
			<div class="col-md-1">                            
                            <button class="btn btn-primary btn-xs" id="agregarDescuento" value="" placeholder="Descuento" type="button"><i class="fa fa-plus"></i></button>
                        </div>    
            </div>
            
            <div id="newDiscount"></div>
            
            
            </div>
			</div>
            </div>
            
            
            <div class="col-lg-11">
			<div class="panel panel-default">
            <div class="panel-heading">
            <label class="control-label">Precio Público</label>
			</div>
            <div class="panel-body">
            
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Porcentaje de Utilidad</label>
			<div class="col-sm-2">
			<div class="input-group m-b">
			<input type="text" class="form-control" id="precioPUP" name="precioPUP" onkeypress="return validateCantidad(event)" value="65">
			<span class="input-group-addon">%</span>
			</div>			
			</div>
			
			<div class="col-sm-5">
			<div class="input-group m-b">
			<span class="input-group-addon" style="font-size:13px !important;"><label class="control-label">Venta Público</label></span>
			<span class="input-group-addon">$</span>
			<input type="text" class="form-control" id="precioP" name="precioP" onkeypress="return validateCantidad(event)">
			</div>
			</div>
			
			
            </div>
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Venta Público con Descuento</label>
            <div class="col-sm-2 ">
            <div class="input-group m-b">
			 <span class="input-group-addon">-$</span>
			 <input type="text" class="form-control" id="precioPD" name="precioPD" onkeypress="return validateCantidad(event)" readonly="readonly">
			 </div>
			 </div>
            </div>            
            
            
            <div class="form-group">
           	<label class="col-sm-2 control-label">Porcentaje de Descuento</label>
           	<div class="col-sm-2 ">
           	 <div class="input-group m-b">
           	<input class="form-control discountP" id="descuentoP" name="descuentoP[]" value="" type="text" onkeypress="return validateNumber(event)">
           	<span class="input-group-addon">%</span>
           	</div>
           	</div>
			<div class="col-md-1">                            
                            <button class="btn btn-primary btn-xs" id="agregarDescuentoP" value="" placeholder="Descuento" type="button"><i class="fa fa-plus"></i></button>
                        </div>    
            </div>
            <div id="newDiscountP"></div>
            
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Precio Público Minímo</label>
            
            <div class="col-sm-3">
			<div class="input-group m-b">
			<input type="text" class="form-control" id="precioPMM" name="precioPMM" onkeypress="return validateCantidad(event)" value="25">
			<span class="input-group-addon">%</span>
			</div>			
			</div>
            
			<div class="col-sm-3">
			<div class="input-group m-b">
			<span class="input-group-addon">$</span>
			<input type="text" class="form-control" id="precioPM" name="precioPM" onkeypress="return validateCantidad(event)">
			</div>
			</div>
            </div>
            
             </div>
			</div>
            </div>
            
            </div>
            
            
            
            
            <div class="form-group"><label class="col-sm-2 control-label">Imagenes</label>
			<div class="col-sm-4" >
			<input name="upload[]" type="file" id="upload" accept='image/*'/>
			</div>
			<div class="col-sm-2" >
			<button class="btn btn-primary btn-xs add_more" id="agregarImg" value="" placeholder="Imagen" type="button"><i class="fa fa-plus"></i></button>
			</div>
            </div>
            
            <div id="newImage"></div>
            
            <div id="div_check_conjunto">
            <div class="form-group">
            <label class="col-sm-2 control-label">Conjunto</label>
			<div class="col-sm-1">
				<input type="checkbox" name="conjunto" id="conjunto" value="1">
			</div>
			<div class="col-sm-6 ">
				 * Son productos que conforman otro y pueden ser vendidos por separado
			</div>
            </div>
            </div>
			<div id="div_conjunto" style="display:none;">
	           	<div class="form-group">
	           	<label class="col-sm-2 control-label">Productos</label>
	           	<div class="col-sm-6" ><input type="text" class="form-control" id="producto" name="producto"></div>
	           	</div>
	           	
	           	<div class="form-group">
	           	<div class="col-sm-2" ></div>
	           	<div class="col-sm-6" >
	           	<div id="product_list" class="ibox-content">
	           	
	           	<table class="table table-striped">
	           	<thead>
					<tr>
						<td></td>
						<td>Cantidad</td>
						<td>SKU</td>
						<td>Nombre</td>
						<td></td>
					</tr>
				</thead>
	           	<tbody id="products_table">
	           	
	           	</tbody>
	           	</table>
	           </div>
	           </div>
	           </div>
            </div>
            
            <div class="form-group">
			<div class="col-sm-6 col-sm-offset-2" align="right"><br>
			<button class="btn btn-danger btn-xs" id="cancelar" type="button">Cancelar</button>&nbsp;&nbsp;&nbsp;&nbsp;
			<button class="btn btn-primary btn-xs" id="guardar" type="button">Guardar Producto</button>
			</div>
			</div>
        </form>
	</div>

<script src="<?php echo $raizProy?>js/plugins/toastr/toastr.min.js"></script>

<script src="<?php echo $raizProy?>js/plugins/chosen/chosen.jquery.js"></script>
<script src="<?php echo $raizProy?>js/plugins/easy-autocomplete/jquery.easy-autocomplete.min.js"></script>
<script src="<?php echo $raizProy?>productos/js/productos.js"></script>
<script src="<?php echo $raizProy?>js/plugins/sweetalert/sweetalert.min.js"></script>  

<?php
    include $pathProy.'footer.php';
?>