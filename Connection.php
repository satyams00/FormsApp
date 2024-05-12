<?php
session_start();
error_reporting(0);



class Connection{
    private  $hostName = "localhost";
    private  $userName = "root";
    private  $password = "";
    private  $dbName = "demo";
    protected $conn;
    protected function __construct(){
        $this->conn = new mysqli($this->hostName,$this->userName,$this->password,$this->dbName);

        try{
            if ($this->conn->connect_error) {
                throw new Exception("<script>alert('Datbase connection falied!!!')</script>");
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        
    }
}



?>