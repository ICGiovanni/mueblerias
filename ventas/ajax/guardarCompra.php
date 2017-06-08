<?php session_start();

require_once($_SERVER["REDIRECT_PATH_CONFIG"].'config.php');
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'ventas/models/class.Ventas.php');

$response['result'] = false;

if(isset($_SESSION['punto_venta']) && is_array($_SESSION['punto_venta'])){
    
    $insVentas = new Ventas();
    
    $sesionVenta = $_SESSION;

   
    $pagos = isset($sesionVenta['punto_venta']['pago']) ? $sesionVenta['punto_venta']['pago'] : null;
    
    $estatus = 1; //por pagar 
    if($pagos){
        $pagos = json_decode($pagos, true);

        $totalPago = 0;
        foreach($pagos['pagos'] as $pago){
            $totalPago += $pago['monto'];
        }

        if($sesionVenta['punto_venta']['Subtotal']>=$totalPago){
            $estatus = 1; //por pagar 
        }else{
            $estatus = 2; //pagado
        }
    }
    
    $idVenta = $insVentas->nuevaVenta($sesionVenta, $estatus);    
    
    if(is_numeric($idVenta)){
        
        $productos = isset($sesionVenta['punto_venta']['Productos']) ? $sesionVenta['punto_venta']['Productos'] : null;
        
        if($productos){
            
            $productosRegistrados = $insVentas->productosVenta($productos, $idVenta);
            
        }else{
            
            $productosRegistrados = "no se encuentran productos en la orden";
            
        }
        
        $pagosRegistrados = array();
        if($pagos){
            $pagosRegistrados = $insVentas->pagosVenta($pagos, $idVenta);
        }
                        
        $response['pagosRegistrados'] = $pagosRegistrados;
        $response['productosRegistrados'] = $productosRegistrados;
        $response['idVenta'] = $idVenta;
        $response['result'] = true;
    }else{
        $response['idVenta'] = $idVenta;
    }
                
}

echo json_encode($response);

?>