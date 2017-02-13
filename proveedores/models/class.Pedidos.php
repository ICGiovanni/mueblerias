<?php
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/connection/class.Connection.php');

class Pedidos {
    private $connect;
	
    function __construct()
    {
        $c=new Connection();
        $this->connect=$c->db;
        $this->name_table = 'pedidos';
    }

    
    public function getPedidos()
    {

        $sql="SELECT * FROM ".$this->name_table." 
                inner join productos_pedido using(pedido_id)
                inner join productos using(producto_id) 
                inner join colores using(color_id)
                inner join materiales using(material_id)
                inner join proveedores on pedidos.proveedor_id = proveedores.proveedor_id
                where pedidos.status = 1           
                group by pedido_id
                order by pedidos.fecha_entrega ASC, pedidos.pedido_id DESC";

        $statement=$this->connect->prepare($sql);
        //$statement->bindParam(':gasto_id', $idGasto, PDO::PARAM_STR);

        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
	
    public function deletePedido($data){
        $sql = "UPDATE pedidos 
		SET
		status = 0
		WHERE
		pedido_id = :pedido_id";
				
	$statement=$this->connect->prepare($sql);			
	$statement->bindParam(':pedido_id', $data['pedido_id'], PDO::PARAM_STR);	
        $statement->execute();
        
        return "deleted";
    }
    
    public function updatePedido($data){
       $sql = "UPDATE pedidos 
		SET
		stock = :stock,
                fecha_entrega = :fecha,
                costo_total = :costo,
                observaciones = :observaciones
		WHERE
		pedido_id = :pedido_id";
				
	$statement=$this->connect->prepare($sql);			
	$statement->bindParam(':pedido_id', $data['pedido_id'], PDO::PARAM_STR);	
        $statement->bindParam(':stock', $data['cantidad'], PDO::PARAM_STR);	
        $statement->bindParam(':fecha', $data['fecha'], PDO::PARAM_STR);	
        $statement->bindParam(':costo', $data['costo'], PDO::PARAM_STR);	
        $statement->bindParam(':observaciones', $data['observaciones'], PDO::PARAM_STR);	
        $statement->execute();
        
        return "updated";
    }
    
    public function savePedido($data){
        
        $sql = "   INSERT INTO pedidos (pedido_id, fecha_entrega, costo_total, observaciones, copia_mail, abastecido, proveedor_id, status, fecha_recordatorio, sucursal_id) 
                    VALUES (0, :fecha_entrega, 0, :observaciones, :email, 0, :proveedor_id, 1, :fecha_recordatorio, :sucursal_id )";

        $statement=$this->connect->prepare($sql);

        $prov =  base64_decode($data['proveedor']);
        $statement->bindParam(':fecha_entrega', $data['fechaEntrega'] ,PDO::PARAM_STR);                    
        $statement->bindParam(':observaciones',$data['observaciones'],PDO::PARAM_STR);
        $statement->bindParam(':email',$data['email'],PDO::PARAM_STR);        
        $statement->bindParam(':proveedor_id', $prov,PDO::PARAM_STR);
        $statement->bindParam(':fecha_recordatorio',$data['fechaRecordatorio'],PDO::PARAM_STR);
        $statement->bindParam(':sucursal_id',$data['sucursal'],PDO::PARAM_STR);

        $statement->execute();   
        $pedidoId =  $this->connect->lastInsertId();        
        
        foreach(json_decode($data['productos']) as $prod){
            if($prod!=0){
                
                $sql2 = "INSERT INTO productos_pedido (idProductoPedido, pedido_id, producto_id, stock) 
                        VALUES (0, ".$pedidoId.", ".$prod.", 1)";
                
                $statement=$this->connect->prepare($sql2);
                $statement->execute();  
            }    
        }        
        return "Saved";
    }
    
}