<?php 
session_start();
date_default_timezone_set("Asia/Manila");
class Connection{
    private $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $db_name = 'sns2.0';
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->servername,$this->username,$this->password,$this->db_name);
        if($this->conn->connect_error){
            die($this->conn->connect_error);
        }else{
            return $this->conn;
        }
    }

}


?>