<?php
require_once($_SERVER["REDIRECT_PATH_CONFIG"]."productos/models/class.Etiquetas.php");
require_once($_SERVER["REDIRECT_PATH_CONFIG"]."productos/models/class.Productos.php");

header("Content-Type: application/json;charset=utf-8");
$data=json_decode(file_get_contents('php://input'), true);

$etiquetas=new Etiquetas();
$productos=new Productos();

$posicion=$_REQUEST['pos'];
$posicion=$posicion-1;

$productosId = array();

for($i=1;$i<=$posicion;$i++)
{
	$productosId[]= array('id' =>'','name'=>'','sku'=>'','proveedor'=>'');
}


foreach($data as $d)
{
	$producto_id=$d['id'];
	$dataP=$productos->GetFeatureProduct($producto_id);
	$dataP=$dataP[0];
	$name=$dataP['producto_name'].' '.$dataP['color_name'].' '.$dataP['material_name'];
	$producto_sku=$dataP['producto_sku'];
	$proveedor=$dataP['proveedor_nombre'];
	
	for($i=0; $i<$d['cantidad'];$i++)
	{
		$productosId[]= array('id' =>$producto_id,'name'=>$name,'sku'=>$producto_sku,'proveedor'=>$proveedor);
	}
}

echo json_encode($etiquetas->GenerarEtiquetas($posicion, $productosId));


