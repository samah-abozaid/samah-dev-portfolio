<?php
abstract class AbstractManager{
    
    
   protected PDO $db;

    public function __construct()
    {
      
        $host = "db.3wa.io";
        $port = "3306";
        $dbname = "samahabozaid_portfolio";

        $connexionString = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";

        $user = "samahabozaid";
        $password = "0090ee5530a6fe63bdb9556ba9405869";

        $this->db = new PDO(
            $connexionString,
            $user,
            $password
            );
   
    } 
   
 
}
?>