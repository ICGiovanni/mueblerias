<?php session_start();
 
if(!isset($_SESSION['punto_venta'])){
    $_SESSION['punto_venta'] = array(
                                    "Subtotal"=>"",
                                    "IVA"=>"",
                                    "Total"=>"",
                                    "Productos"=>""            
                               );    
}

if($_POST){    
    extract($_POST);

    print_r($_POST);
    
    $cant = 0;
    foreach($_SESSION['punto_venta']['Productos'] as $k => $product){                        
        if($product['SKU']==$sku){
            $cant++;
            $_SESSION['punto_venta']['Productos'][$k]['Cantidad'] = $cantidad;
            $_SESSION['punto_venta']['Productos'][$k]['Precio'] = $precio;
            $_SESSION['punto_venta']['Productos'][$k]['Subtotal'] = $_SESSION['punto_venta']['Productos'][$k]['Cantidad'] * $precio;
        }
    }
                   
    if($cant==0){
        $producto = array(
                    "ID"=>$id,
                    "SKU"=>$sku,
                    "Modelo"=>$modelo,
                    "Color"=>$color,
                    "Material"=>$material,
                    "Proveedor"=>$proveedor,
                    "Imagen"=>$imagen,
                    "Cantidad"=>$cantidad,
                    "Precio"=>$precio,
                    "PrecioMin"=>$precio_min,
                    "Subtotal"=>($precio*$cantidad)
                );
        $_SESSION['punto_venta']['Productos'][] = $producto;     
    }
    
    $subtotal = '';
    foreach($_SESSION['punto_venta']['Productos'] as $prod){
        $subtotal = $subtotal + $prod['Subtotal'];
    }
    $iva = $subtotal*.16;
    $_SESSION['punto_venta']['Subtotal']= $subtotal;
    $_SESSION['punto_venta']['IVA']= $iva;
    $_SESSION['punto_venta']['Total']= $subtotal + $iva;
    
    
    
}
echo "<pre>";
    print_r($_SESSION);
echo "</pre>";    