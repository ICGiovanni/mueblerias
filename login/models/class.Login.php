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
            

            $sql = "SELECT login_id, profile_id, email, firstName, lastName FROM `inv_login` WHERE email = :email AND password = :password AND status_id = 1";

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
        
}