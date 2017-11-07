<?php
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/connection/class.Connection.php');

class Tablero
{
    private $connect;

    function __construct()
    {
        $c = new Connection();
        $this->connect = $c->db;
    }

    public function ingresosPorEnvio($fechaInicio, $fechaFinal){        

        $arr = explode('/', $fechaInicio);         
        $fechaInicio = $arr[2].'-'.$arr[1].'-'.$arr[0];

        $arr2 = explode('/', $fechaFinal);                 
        $fechaFinal = $arr2[2].'-'.$arr2[1].'-'.$arr2[0];        

        $sql="SELECT venta_id, fecha_creacion, costo_envio, detalle_envio, sucursal_id, fecha_entrega FROM ventas WHERE venta_flete_id != 0 AND fecha_creacion BETWEEN '".$fechaInicio." 00:00:00' AND '".$fechaFinal." 23:59:59'";

        $statement=$this->connect->prepare($sql);

        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }

    public function getInventarioSucursal($sucursal_id=0){        

        $sql="  SELECT * FROM inventario_productos 
                LEFT JOIN inv_sucursales USING (sucursal_id)
                LEFT JOIN productos USING (producto_id)";

        if($sucursal_id!=0){
            $sql .= ' WHERE sucursal_id = '.$sucursal_id;
        }

        $statement=$this->connect->prepare($sql);

        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

}