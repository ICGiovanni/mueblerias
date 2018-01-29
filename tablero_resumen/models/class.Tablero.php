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

    public function getGastosVsIngresos($fechaInicio, $fechaFinal, $sucursal_id){

      $arr = explode('/', $fechaInicio);
      $fechaInicio = $arr[2].'-'.$arr[1].'-'.$arr[0];

      $arr2 = explode('/', $fechaFinal);
      $fechaFinal = $arr2[2].'-'.$arr2[1].'-'.$arr2[0];

      $if_sucursal = "";
      if($sucursal_id!=0){
          $if_sucursal = " AND sucursal_id = '".$sucursal_id."'";
      }

        $sql = "SELECT
                  gastos_pagos_id as movimiento_id,
                  gastos_pagos_monto as movimiento_monto,
                  gastos_pagos_fecha as movimiento_fecha,
                  'Gasto' as movimiento_tipo,
                  gasto_categoria_desc as movimiento_concepto,
                  sucursal_id,
                  sucursal_name,
                  sucursal_abrev,
                  gastos_pagos_forma_de_pago_desc as metodo_pago
                FROM gastos_pagos
                INNER JOIN gastos USING (gasto_id)
                INNER JOIN inv_sucursales USING (sucursal_id)
                INNER JOIN gasto_categoria USING (gasto_categoria_id)
                INNER JOIN gastos_pagos_forma_de_pago USING (gastos_pagos_forma_de_pago_id)
                WHERE gastos_pagos_fecha BETWEEN '".$fechaInicio." 00:00:00' AND '".$fechaFinal." 00:00:00' ".$if_sucursal."
                UNION
                SELECT
                    ingreso_id as movimiento_id,
                    ingreso_monto as movimiento_monto,
                    ingreso_fecha as movimiento_fecha,
                    'Ingreso' as movimiento_tipo,
                    'Pago prestamo de nomina' as movimiento_concepto,
                    sucursal_id,
                    sucursal_name,
                    sucursal_abrev,
                    'Efectivo' as metodo_pago
                FROM ingresos
                INNER JOIN ingreso_gasto USING (ingreso_id)
                INNER JOIN gastos USING (gasto_id)
                INNER JOIN inv_sucursales USING (sucursal_id)
                WHERE ingreso_fecha BETWEEN '".$fechaInicio." 00:00:00' AND '".$fechaFinal." 00:00:00' ".$if_sucursal."
                UNION
                SELECT
                  ventas_pagos_id as movimiento_id,
                  ventas_pagos.monto as movimiento_monto,
                  fecha as movimiento_fecha,
                  'Ingreso' as movimiento_tipo,
                  'Venta' as movimiento_concepto,
                  sucursal_id,
                  sucursal_name,
                  sucursal_abrev,
                  general_forma_de_pago_desc as metodo_pago
                FROM ventas_pagos
                INNER JOIN ventas USING (venta_id)
                INNER JOIN inv_sucursales USING (sucursal_id)
                INNER JOIN general_formas_de_pago USING (general_forma_de_pago_id)
                WHERE fecha BETWEEN '".$fechaInicio." 00:00:00' AND '".$fechaFinal." 00:00:00' ".$if_sucursal."
                ORDER BY movimiento_fecha";
    //echo $sql;

        $statement=$this->connect->prepare($sql);

        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

}
