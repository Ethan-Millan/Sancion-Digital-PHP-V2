<?php

class Database{
    private $host = DB_HOST;
    private $db_name = DB_NAME;
    private $db_user = DB_USER;
    private $db_password = DB_PASSWORD;
    private $conn;

    public function connect(){
        $this->conn = null;
        try{
                //DNS de conexión
                $dns = "mysql:host=" . $this->host . ";dbname=" . $this->db_name;
                $this->conn = new PDO($dns, $this->db_user, $this->db_password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e){
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
        
    }

}