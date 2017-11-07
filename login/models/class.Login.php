<?php
require_once $pathProy.'models/connection/class.Connection.php';

class Login {
	private $connect;
	
	function __construct()
	{
		$c=new Connection();
		$this->connect=$c->db;
	}
        
        public function auth($email, $password){
            

            $sql = "SELECT login_id, profile_id, email, firstName, lastName, url_image ,profile_name FROM inv_login 
                    INNER JOIN inv_profile USING (profile_id)
                    WHERE email = :email AND password = :password AND status_id = 1";

            $statement = $this->connect->prepare($sql);

            $password = $this->encodePassword($password, $email);

            $statement->bindParam(':email', $email, PDO::PARAM_STR);
            $statement->bindParam(':password', $password, PDO::PARAM_STR);

            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            return(!empty($result))?$result[0]:false;
                
        }
                
        public function encodePassword($password, $email){
            return base64_encode($this->encrypt($password,md5($email.$password)));
        }        
        
        function encrypt($value,$salt){
            $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
            $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
            return mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $salt, $value, MCRYPT_MODE_ECB, $iv);
        }
        
        public function pagesProfile($idProfile){
            $sql = "SELECT page FROM inv_profile_pages
                    where profile_id=".$idProfile;

            $statement = $this->connect->prepare($sql);

            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }
        
        public function checkMailRegistered($email){
            $sql = "SELECT login_id FROM inv_login WHERE email = :email";
            $statement = $this->connect->prepare($sql);
                    $statement->bindParam(':email', $email, PDO::PARAM_STR);

            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            return(!empty($result))?$result[0]:false;
            
        }
        
        public function getUsers($id = 0){
            $sql = "SELECT * FROM inv_login 
                    INNER JOIN inv_profile USING (profile_id)
                    INNER JOIN inv_status USING (status_id)                    
                    WHERE status_id!=99";
            
            if($id!=0){
                    $sql .= " and login_id=".$id;
            }
            $sql .= " ORDER by created_timestamp DESC";
            
            $statement = $this->connect->prepare($sql);                    

            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            return(!empty($result))?$result:false;
        }
        
        public function saveUser($data){
            
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
            
            
            $sql = "   INSERT INTO inv_login (login_id, firstName, lastName, secondLastName,  email, password, profile_id, collaborator, 
                            sucursal_id, address_id, salary, salary_periodicity, comision, birthdate, created_timestamp, modify_timestamp) 
                            VALUES (0, :firstName, :lastName, :secondLastName, :email, :password, :profile_id, :collaborator,
                            :sucursal_id, :address_id, :salary, :salary_periodicity, :comision, :birthdate, :created_timestamp, :modify_timestamp)";
            
            $statement=$this->connect->prepare($sql);

            $timestamp = time();                        
            $date = new DateTime($data['fechaNacimiento']);
            $fechaNacimiento = $date->format('Y-m-d');
            $password = $this->encodePassword($data['password'], $data['email']);
            $statement->bindParam(':firstName', $data['firstName'] ,PDO::PARAM_STR);            
            $statement->bindParam(':lastName',$data['lastName'],PDO::PARAM_STR);
            $statement->bindParam(':secondLastName',$data['secondLastName'],PDO::PARAM_STR);
            $statement->bindParam(':email',$data['email'],PDO::PARAM_STR);
            $statement->bindParam(':password',$password,PDO::PARAM_STR);            
            $statement->bindParam(':profile_id',$data['perfil'],PDO::PARAM_STR);
            $statement->bindParam(':collaborator',$data['colaborador'],PDO::PARAM_INT);
            $statement->bindParam(':sucursal_id',$data['sucursal'],PDO::PARAM_INT);
            $statement->bindParam(':address_id',$addressId ,PDO::PARAM_INT);
            $statement->bindParam(':salary',$data['salario'],PDO::PARAM_NULL);
            $statement->bindParam(':salary_periodicity',$data['periodicidad'],PDO::PARAM_NULL);
            $statement->bindParam(':comision',$data['comision'],PDO::PARAM_NULL);
            $statement->bindParam(':birthdate',$fechaNacimiento,PDO::PARAM_NULL);            
            $statement->bindParam(':created_timestamp', $timestamp,PDO::PARAM_NULL);
            $statement->bindParam(':modify_timestamp', $timestamp,PDO::PARAM_NULL);
            

            $statement->execute();            
                
            $loginId = $this->connect->lastInsertId();
            $tipos = json_decode($data['tipos']);
            foreach(json_decode($data['telefonos']) as $key => $value){
                $sqlDir = " INSERT INTO inv_login_phone_number(login_phone_number_id, login_id, phone_type_id, number)
                            VALUES(0, ".$loginId.", ".$tipos[$key].", ".$value.")";
            
                $statement=$this->connect->prepare($sqlDir);
                $statement->execute();            

                
            }
            
            return $loginId;
        }
        
        public function updateUser($data){
            
            
            $sql = "UPDATE inv_login SET firstName='".$data['firstName']."', lastName='".$data['lastName']."', 
                    secondLastName='".$data['secondLastName']."', email='".$data['email']."', profile_id=".$data['perfil'].", 
                    sucursal_id=".$data['sucursal'].", salary=".$data['salario'].", salary_periodicity=".$data['periodicidad'].", comision=".$data['comision']."
                    WHERE login_id = ".$data['idUser'];
            $statement = $this->connect->prepare($sql);                    

            $statement->execute();
            
            return $data['idUser'];
        }
        
        public function getProfiles(){
            
            $sql = "SELECT profile_id, profile_name FROM inv_profile";
            $statement = $this->connect->prepare($sql);                   

            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            return(!empty($result))?$result:false;
            
        }
        
        public function getSucursales(){
            
            $sql = "SELECT sucursal_id, sucursal_name FROM inv_sucursales";
            $statement = $this->connect->prepare($sql);                   

            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            return(!empty($result))?$result:false;
            
        }
        
        public function deleteUser($profile_id){
            $sql = "UPDATE inv_login SET status_id=99  WHERE login_id = ".$profile_id;
            $statement = $this->connect->prepare($sql);                    

            $statement->execute();
        }
        
        public function activeUser($loginId, $status){
            if($status!=1){
                $status=1;
            }
            else{
                $status=3;
            }
            $sql = "UPDATE inv_login SET status_id=".$status."  WHERE login_id = ".$loginId;
            $statement = $this->connect->prepare($sql);                    

            $statement->execute();
        }
        
        public function insertLastLogin($loginId){
            $timestamp = time();
            $sql = "UPDATE inv_login SET modify_timestamp=".$timestamp."  WHERE login_id = ".$loginId;
            $statement = $this->connect->prepare($sql);                    

            $statement->execute();
        }
        
        public function getAddress($addressId){
            
            $sql = "SELECT * FROM inv_address where address_id = ".$addressId;
            $statement = $this->connect->prepare($sql);                   

            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            return(!empty($result))?$result[0]:false;
            
        }
        
        public function getPhones($idUser){
            $sql = "select phone_type_id, number from inv_login_phone_number where login_id =".$idUser;
            $statement = $this->connect->prepare($sql);                   

            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            return(!empty($result))?$result:false;
            
        }

         public function getSucursal($id){
            
            $sql = "SELECT sucursal_name FROM inv_sucursales where sucursal_id='".$id."'";
            $statement = $this->connect->prepare($sql);                   

            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            return(!empty($result))?$result[0]['sucursal_name']:false;
            
        }
}

?>