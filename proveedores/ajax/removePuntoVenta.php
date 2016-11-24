<?php session_start();

if($_POST){
    extract($_POST);    
    
    if($sku!=''){
        foreach($_SESSION['punto_venta']['Productos'] as $k => $product){                        
            if($product['SKU']==$sku){
                unset($_SESSION['punto_venta']['Productos'][$k]);
            }        
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
    if(isset($deleteAll)){
        unset($_SESSION['punto_venta']);
    }
}
?>