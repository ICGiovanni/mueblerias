<?php session_start();

$response['result'] = false;

if(isset($_SESSION['punto_venta']) && is_array($_SESSION['punto_venta'])){
    $sesionVenta = $_SESSION;
    
    echo "<pre>";
        print_r($sesionVenta);
    echo "</pre>";
}
else{
    echo json_encode($response);
}

?>