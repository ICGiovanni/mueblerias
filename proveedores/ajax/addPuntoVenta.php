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
    
    $cant = 0;
    foreach($_SESSION['punto_venta']['Productos'] as $k => $product){                        
        if($product['SKU']==$sku){
            $cant++;
            $_SESSION['punto_venta']['Productos'][$k]['Cantidad'] = $_SESSION['punto_venta']['Productos'][$k]['Cantidad'] + $cant;
            $_SESSION['punto_venta']['Productos'][$k]['Subtotal'] = $_SESSION['punto_venta']['Productos'][$k]['Cantidad'] * $precio;
        }
    }
                   
    if($cant==0){
        $producto = array(
                    "SKU"=>$sku,
                    "Modelo"=>$modelo,
                    "Cantidad"=>$cantidad,
                    "Precio"=>$precio,
                    "Subtotal"=>($precio*$cantidad)
                );
        $_SESSION['punto_venta']['Productos'][] = $producto;     
    }
    
}
echo "<pre>";
    print_r($_SESSION);
echo "</pre>";    