<?php
//session_start();
require_once($_SERVER["REDIRECT_PATH_CONFIG"].'models/connection/class.Connection.php');

class Proveedor {
    private $connect;
	
    function __construct()
    {
        $c=new Connection();
        $this->connect=$c->db;
        $this->name_table = 'proveedores';
    }

    public function insertProveedor($params)
    {
        $sql = "INSERT INTO ".$this->name_table." (proveedor_nombre)
                VALUES(:proveedor_nombre)";
        //print_r($params);
        //die();
        $statement=$this->connect->prepare($sql);
        $statement->bindParam(':proveedor_nombre', $params['proveedor_nombre'], PDO::PARAM_STR);
        $statement->execute();
        
        return $this->connect->lastInsertId();
    }
	
    public function editProveedor($params)
    {
        $sql = "UPDATE ".$this->name_table." SET 
                proveedor_nombre = :proveedor_nombre
        WHERE proveedor_id = :proveedor_id";

        $statement=$this->connect->prepare($sql);
        $statement->bindParam(':proveedor_id', $params['proveedor_id'], PDO::PARAM_STR);
        $statement->bindParam(':proveedor_nombre', $params['proveedor_nombre'], PDO::PARAM_STR);

        $statement->execute();
        return "updated";
    }
	
    public function getProveedores()
    {

        $sql="SELECT 
        proveedor_id,
        proveedor_nombre
        FROM ".$this->name_table." ORDER BY proveedor_nombre ASC";

        $statement=$this->connect->prepare($sql);
        //$statement->bindParam(':gasto_id', $idGasto, PDO::PARAM_STR);

        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
	
    public function getFilteredProveedores($params)
    {
        //print_r($params);

        $where = array();

        if(isset($params["filtro_nombre_activo"]) && $params["filtro_nombre_activo"] == 1){ 
                $where[]=" proveedor_nombre LIKE '%".$params["filtro_categoria_id"]."%'";
        }

        $str_where = "";
        if(!empty($where)){
            $str_where = "WHERE ".implode(" AND ",$where);
        }
        //echo $str_where;

        $sql="SELECT 
        proveedor_id,
        proveedor_nombre 
        FROM ".$this->name_table." ".$str_where." ORDER BY proveedor_nombre DESC";

        $statement=$this->connect->prepare($sql);        

        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
	
    public function getProveedor($proveedor_id)
    {
        $sql="SELECT 
        proveedor_id,
        proveedor_nombre, 
        telefono, 
        email,
        address_id
        FROM ".$this->name_table." WHERE proveedor_id = :proveedor_id";

        $statement=$this->connect->prepare($sql);
        $statement->bindParam(':proveedor_id', $proveedor_id, PDO::PARAM_STR);

        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    
    public function getProveedorPhone($proveedor_id)
    {
        $sql="SELECT *
        FROM proveedor_telefono left join inv_phone_type using(phone_type_id) WHERE proveedor_id = :proveedor_id";

        $statement=$this->connect->prepare($sql);
        $statement->bindParam(':proveedor_id', $proveedor_id, PDO::PARAM_STR);

        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    
    public function getProveedoresList()
    {

        $sql="SELECT 
        proveedor_id,
        proveedor_nombre, proveedor_nombre_fiscal, proveedor_representante, telefono, email, street, number, int_number, neighborhood, municipality, state, zip_code, address_id
        FROM ".$this->name_table." left JOIN inv_address USING (address_id) WHERE status=1   
        ORDER BY proveedor_nombre ASC";

        $statement=$this->connect->prepare($sql);
        //$statement->bindParam(':gasto_id', $idGasto, PDO::PARAM_STR);

        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    
    public function saveProveedor($data){
        
        $sqlDir = " INSERT INTO inv_address (address_id, street, number, int_number, neighborhood, municipality, zip_code, state)"
                    . " VALUES(0, :calle, :numExt, :numInt, :colonia, :municipio, :cp, :estado)";
            
        $statement=$this->connect->prepare($sqlDir);

        $statement->bindParam(':calle', $data['calle'] ,PDO::PARAM_STR);            
        $statement->bindParam(':numExt', $data['numExt'] ,PDO::PARAM_STR);            
        $statement->bindParam(':numInt', $data['numInt'] ,PDO::PARAM_STR);            
        $statement->bindParam(':colonia', $data['colonia'] ,PDO::PARAM_STR);            
        $statement->bindParam(':municipio', $data['municipio'] ,PDO::PARAM_STR);            
        $statement->bindParam(':cp', $data['cp'] ,PDO::PARAM_STR);            
        $statement->bindParam(':estado', $data['estado'] ,PDO::PARAM_STR);            


        $statement->execute();            
        $addressId =  $this->connect->lastInsertId();


        $sql = "   INSERT INTO proveedores (proveedor_id, proveedor_nombre, proveedor_nombre_fiscal, proveedor_representante, email, address_id) 
                    VALUES (0, :nombre, :fiscal, :representante, :email, ".$addressId.")";

        $statement=$this->connect->prepare($sql);

        $statement->bindParam(':nombre', $data['nombre'] ,PDO::PARAM_STR);                    
        $statement->bindParam(':fiscal', $data['nombreFiscal'] ,PDO::PARAM_STR);                    
        $statement->bindParam(':representante', $data['representante'] ,PDO::PARAM_STR);                    
        $statement->bindParam(':email',$data['email'],PDO::PARAM_STR);

        $statement->execute();            
        
        $idProveedor = $this->connect->lastInsertId();
                
        $tipos = json_decode($data['tipos']);
        foreach(json_decode($data['telefonos']) as $key => $value){
            echo $sqlProv = " INSERT INTO proveedor_telefono(id_telefono, proveedor_id, phone_type_id, number)
                        VALUES(0, ".$idProveedor.", ".$tipos[$key].", ".$value.")";

            $statement=$this->connect->prepare($sqlProv);
            $statement->execute();            

        }
        
        return $idProveedor;
    }
    
    public function updateProveedor($data){
        $sql = "UPDATE proveedores 
		SET
		proveedor_nombre = :nombre,
		telefono = :telefono,
                email = :email
		WHERE
		proveedor_id = :proveedor_id";
				
	$statement=$this->connect->prepare($sql);
		
	$statement->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
        $statement->bindParam(':telefono', $data['telefono'], PDO::PARAM_STR);
	$statement->bindParam(':email', $data['email'], PDO::PARAM_STR);
	$statement->bindParam(':proveedor_id', $data['proveedor_id'], PDO::PARAM_STR);	
        $statement->execute();
        
        if($data['address_id']!=''){
            $sqlDir = "UPDATE inv_address 
		SET
		street = :calle,
		number = :numExt,
                int_number = :numInt,
                neighborhood = :colonia,
                municipality = :municipio,
                zip_code = :cp,
                state = :estado               
		WHERE
		address_id = :address_id";
				
            $statementDir=$this->connect->prepare($sqlDir);
            
            $statementDir->bindParam(':calle', $data['calle'], PDO::PARAM_STR);
            $statementDir->bindParam(':numExt', $data['numExt'], PDO::PARAM_STR);
            $statementDir->bindParam(':numInt', $data['numInt'], PDO::PARAM_STR);
            $statementDir->bindParam(':colonia', $data['colonia'], PDO::PARAM_STR);	
            $statementDir->bindParam(':municipio', $data['municipio'], PDO::PARAM_STR);	
            $statementDir->bindParam(':cp', $data['cp'], PDO::PARAM_STR);	
            $statementDir->bindParam(':estado', $data['estado'], PDO::PARAM_STR);	
            $statementDir->bindParam(':address_id', $data['address_id'], PDO::PARAM_STR);	
            $statementDir->execute();

        }else{
            $sqlDir = " INSERT INTO inv_address (address_id, street, number, int_number, neighborhood, municipality, zip_code, state)"
                    . " VALUES(0, :calle, :numExt, :numInt, :colonia, :municipio, :cp, :estado)";
            
            $statement=$this->connect->prepare($sqlDir);

            $statement->bindParam(':calle', $data['calle'] ,PDO::PARAM_STR);            
            $statement->bindParam(':numExt', $data['numExt'] ,PDO::PARAM_STR);            
            $statement->bindParam(':numInt', $data['numInt'] ,PDO::PARAM_STR);            
            $statement->bindParam(':colonia', $data['colonia'] ,PDO::PARAM_STR);            
            $statement->bindParam(':municipio', $data['municipio'] ,PDO::PARAM_STR);            
            $statement->bindParam(':cp', $data['cp'] ,PDO::PARAM_STR);            
            $statement->bindParam(':estado', $data['estado'] ,PDO::PARAM_STR);            

            $statement->execute();            
            $addressId =  $this->connect->lastInsertId();
            
            $sql2 = "UPDATE proveedores 
		SET
		address_id = :address_id
		WHERE
		proveedor_id = :proveedor_id";
				
            $statement=$this->connect->prepare($sql2);
            $statement->bindParam(':address_id', $addressId, PDO::PARAM_INT);	
            $statement->bindParam(':proveedor_id', $data['proveedor_id'], PDO::PARAM_INT);
            $statement->execute();
        }        			        
        
        return "updated";
    }
    
    public function deleteProveedor($data){
        $sql = "UPDATE proveedores 
		SET
		status = 0
		WHERE
		proveedor_id = :proveedor_id";
				
	$statement=$this->connect->prepare($sql);			
	$statement->bindParam(':proveedor_id', $data['proveedor_id'], PDO::PARAM_STR);	
        $statement->execute();
        
        return "deleted";
    }
    
    public function GetDataProductProveedor($proveedor_id='')
    {
        $where = '';
        if($proveedor_id!=''){
            $where = " WHERE p.proveedor_id='$proveedor_id'";
        }
        $sql="SELECT p.producto_id,p.producto_name,p.producto_sku,
                        p.producto_price_purchase,p.producto_price_public,p.proveedor_id
                        FROM productos p".
                        $where.
                        " ORDER BY p.producto_id";

        $statement=$this->connect->prepare($sql);

        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

        return $result; 
    }
}