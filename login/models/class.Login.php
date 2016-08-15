<?php

include $pathProy.'models/connection/class.Connection.php';

class Login {
	private $connect;
	
	function __construct()
	{
		$c=new Connection();
		$this->connect=$c->db;
	}
        
        public function auth($email, $password){
            

            $sql = "SELECT login_id, profile_id, email, firstName, lastName FROM inv_login WHERE email = :email AND password = :password AND status_id = 1";

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
        
        public function getUsers($typeUser){
            $sql = "SELECT * FROM inv_login 
                    INNER JOIN inv_profile USING (profile_id)
                    INNER JOIN inv_status USING (status_id)
                    WHERE collaborator=".$typeUser.
                    " ORDER by created_timestamp DESC";
            
            $statement = $this->connect->prepare($sql);                    

            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            return(!empty($result))?$result:false;
        }
        
        public function saveUser($data){
                        
            
            $sql = "   INSERT INTO inv_login (login_id, firstName, lastName, email, password, profile_id, collaborator, 
                            sucursal_id, address_id, salary, comision, birthdate, created_timestamp, modify_timestamp) 
                            VALUES (0, :firstName, :lastName, :email, :password, :profile_id, :collaborator,
                            :sucursal_id, :address_id, :salary, :comision, :birthdate, :created_timestamp, :modify_timestamp)";
            
            $statement=$this->connect->prepare($sql);

            $timestamp = time();
            $addressId = '1';            
            
            $date = new DateTime($data['fechaNacimiento']);
            $fechaNacimiento = $date->format('Y-m-d');
            
            $statement->bindParam(':firstName', $data['firstName'] ,PDO::PARAM_STR);            
            $statement->bindParam(':lastName',$data['lastName'],PDO::PARAM_STR);
            $statement->bindParam(':email',$data['email'],PDO::PARAM_STR);
            $statement->bindParam(':password',$data['password'],PDO::PARAM_STR);            
            $statement->bindParam(':profile_id',$data['perfil'],PDO::PARAM_STR);
            $statement->bindParam(':collaborator',$data['colaborador'],PDO::PARAM_INT);
            $statement->bindParam(':sucursal_id',$data['sucursal'],PDO::PARAM_INT);
            $statement->bindParam(':address_id',$addressId ,PDO::PARAM_INT);
            $statement->bindParam(':salary',$data['salario'],PDO::PARAM_NULL);
            $statement->bindParam(':comision',$data['comision'],PDO::PARAM_NULL);
            $statement->bindParam(':birthdate',$fechaNacimiento,PDO::PARAM_NULL);            
            $statement->bindParam(':created_timestamp', $timestamp,PDO::PARAM_NULL);
            $statement->bindParam(':modify_timestamp', $timestamp,PDO::PARAM_NULL);
            

            $statement->execute();            

            return $this->connect->lastInsertId();
        }
}