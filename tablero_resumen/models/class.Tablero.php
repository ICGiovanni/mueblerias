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
        $fechaInicio = date("Y/d/m", strtotime($fechaInicio));
        $fechaFinal = date("Y/d/m", strtotime($fechaFinal));

        $sql="SELECT venta_id, fecha_creacion, costo_envio, detalle_envio, sucursal_id FROM ventas WHERE venta_flete_id != 0 AND fecha_creacion BETWEEN '".$fechaInicio." 00:00:00' AND '".$fechaFinal." 23:59:59'";

        $statement=$this->connect->prepare($sql);

        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }


}