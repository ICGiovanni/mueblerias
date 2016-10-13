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
                inner join productos using(producto_id) 
                inner join proveedores on pedidos.proveedor_id = proveedores.proveedor_id
                where pedidos.status = 1
                order by pedidos.fecha_entrega ASC";

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
        
        $sql = "   INSERT INTO pedidos (pedido_id, stock, fecha_entrega, costo_total, observaciones, copia_mail, abastecido, producto_id, proveedor_id, status) 
                    VALUES (0, :stock, :fecha, :costo, :observaciones, 0, 0, :producto_id, :proveedor_id, status)";

        $statement=$this->connect->prepare($sql);

        $statement->bindParam(':stock', $data['cantidad'] ,PDO::PARAM_STR);            
        $statement->bindParam(':fecha', $data['fecha'] ,PDO::PARAM_STR);            
        $statement->bindParam(':costo',$data['costo'],PDO::PARAM_STR);
        $statement->bindParam(':observaciones',$data['observaciones'],PDO::PARAM_STR);
        $statement->bindParam(':producto_id',$data['producto_id'],PDO::PARAM_STR);
        $statement->bindParam(':proveedor_id',$data['proveedor_id'],PDO::PARAM_STR);

        $statement->execute();            
        
        return "Saved";
    }
    
}