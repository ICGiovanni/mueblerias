<?php

require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/connection/class.Connection.php');

class Ventas {
    
    private $connect;
	
    function __construct()
    {
        $c=new Connection();
        $this->connect=$c->db;
        $this->name_table = 'ventas';
    }
    
    /*
     * $status;  2=> pagado
     * $entregado; 0 => por entregar, 1 => entregado
     * $tipoVenta; 1=>venta, 2=>apartado
     * 
     * regresa false si no se realizo el registro, true y el idVenta cuando el registro fue correcto
     */
    public function nuevaVenta($infoVenta, $status = 2, $entregado = 0, $tipoVenta = 1){
        
        $subtotal = $infoVenta['punto_venta']['Subtotal'];
        $iva = $infoVenta['punto_venta']['IVA'];



        
        $infoCliente = isset($infoVenta['punto_venta']['cliente']) ? $infoVenta['punto_venta']['cliente'] : null;
                
        if($infoCliente){
            $clienteId = isset($infoCliente['cliente_id']) ? $infoCliente['cliente_id'] : 0;

            $dirEnvio = isset($infoCliente['cliente_direccion_id_envio']) ? $infoCliente['cliente_direccion_id_envio'] : 0;
            $dirFactura =  isset($infoCliente['cliente_direccion_id_fact']) ? $infoCliente['cliente_direccion_id_fact'] : 0;

            if($dirFactura!=0){
                $total =  $infoVenta['punto_venta']['Total'];
            }else{
                $total =  $infoVenta['punto_venta']['Subtotal'];
            }

            if($dirEnvio!=0){
                $total += $infoVenta['punto_venta']['envio']['costo_envio'];
            }

            $sql = "   INSERT INTO ventas (venta_id, fecha_creacion, monto, sucursal_id, id_cliente, venta_flete_id, cliente_direccion_id, venta_estatus_id, venta_entrega, venta_tipo, factura_generada, fecha_entrega) 
                        VALUES (0, NOW(), $total, 1, $clienteId, $dirEnvio, $dirFactura, $status, $entregado, $tipoVenta, 0, NOW())";

            $statement=$this->connect->prepare($sql);

            $statement->execute();   

            return $ventaId =  $this->connect->lastInsertId(); 
        }    
        else{
            return "informacion de cliente insuficiente";
        }

        
    }
    
    public function productosVenta($productos, $idVenta){
                         
        $prodRegistro = array();
        
        foreach($productos as $producto){
            $sql = "   INSERT INTO ventas_productos (ventas_productos_id, venta_id, producto_id, producto_sku, producto_name, cantidad, precio, subtotal, producto_imagen, iva) 
                            VALUES (0, $idVenta, ".$producto['ID'].", '".$producto['SKU']."', '".$producto['Modelo']."', ".$producto['Cantidad'].", ".$producto['Precio'].", ".$producto['Subtotal']." , '".$producto['Imagen']."', ".$producto['Subtotal']." )";

            $statement=$this->connect->prepare($sql);

            $statement->execute();   
            $bdid = $this->connect->lastInsertId(); 
            $prodRegistro[] = array('ID'=>$producto['ID'], 'BDID'=>$bdid);
        }
        
        return $prodRegistro;        
        
    }
    
    public function pagosVenta($pagos, $idVenta){
                         
        $pagosRegistro = array();

        foreach(end($pagos) as $pago){

            $sql = "   INSERT INTO ventas_pagos (ventas_pagos_id, general_forma_de_pago_id, monto, referencia, fecha, venta_id) 
                       VALUES (0, ".$pago['pago_metodo_id'].", ".$pago['monto'].", '".$pago['referencia']."', NOW(), $idVenta)";

            $statement=$this->connect->prepare($sql);

            $statement->execute();   
            $bdid = $this->connect->lastInsertId();
            $pagosRegistro[] = array('monto'=>$pago['monto'], 'BDPAGOID'=>$bdid);
        }
        
        return $pagosRegistro;        
        
    }
    
    public function obtenerVentas($entrega = 0, $idVenta = 0){
        
        $sql="SELECT * FROM ".$this->name_table."                 
                 WHERE venta_tipo = 1";
        
        if($entrega!=0)
        {
        	$sql.=" AND venta_entrega = " .$entrega;
        }
        
        if($idVenta != 0){
            $sql .= " AND venta_id = ".$idVenta;
        }
                                		
        $statement=$this->connect->prepare($sql);        

        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    
    public function obtenerApartados($idVenta = 0, $vigencia = 1){
        
        $sql="SELECT * FROM ".$this->name_table."                 
                WHERE venta_tipo = 2 " ;
        
        if($vigencia == 1){
            $sql .= " AND fecha_creacion >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
        }else{
            
            $sql .= " AND fecha_creacion < DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
        }
        
        if($idVenta != 0){
            $sql .= " AND venta_id = ".$idVenta;
        }                                                

        //echo $sql;
        $statement=$this->connect->prepare($sql);        

        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    
    public function obtenerProductosVenta($idVenta){
        
        $sql="SELECT * FROM ventas_productos WHERE venta_id = ".$idVenta;
        
        $statement=$this->connect->prepare($sql);        

        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
        
    }
    
    
    public function getSucursal($idSucursal){
        
        $sql="SELECT sucursal_id, sucursal_name, sucursal_abrev FROM inv_sucursales WHERE sucursal_id=".$idSucursal;

        $statement=$this->connect->prepare($sql);        

        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

        return $result[0]['sucursal_name'];
    }
    
    public function getEstatusVenta($idEstatus){
        
        $sql="SELECT ventas_estatus_nombre FROM ventas_estatus  WHERE ventas_estatus_id=".$idEstatus;

        $statement=$this->connect->prepare($sql);        

        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

        return $result[0]['ventas_estatus_nombre'];
    }
    
    public function getPagosVenta($idVenta){
        
        $sql="SELECT * FROM ventas_pagos LEFT JOIN general_formas_de_pago USING(general_forma_de_pago_id) WHERE venta_id=".$idVenta;

        $statement=$this->connect->prepare($sql);        

        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    
    
    public function getAddress($adress_id){
        $sql="SELECT    cliente_direccion_calle,
                        cliente_direccion_numero_ext,
                        cliente_direccion_numero_int,                                                                        
                        cliente_direccion_rfc,
                        cliente_direccion_razon_social,
                        cliente_direccion_entre_calles
                FROM cliente_direccion
                WHERE cliente_direccion_id = ".$adress_id;

        $statement=$this->connect->prepare($sql);        

        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        
    }
}
