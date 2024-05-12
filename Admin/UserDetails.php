<?php
include_once("../Connection.php");
include_once("../logout.php");


class userDetails extends Connection{
    public $row;
    public $id;
    public function __construct($id){
        parent::__construct();
        $this->id = $id;
    }
    public function fetchDetails(){
        $sql = "SELECT * FROM `users` WHERE id ='$this->id'";
        $res = $this->conn->query($sql);
        if(!$res){
            throw new Exception("Query failed.");
        }
        $this->row = $res->fetch_assoc();
        return $this->row;
        // print_r($this->row);
    }

}

try{
    $uid = $_SESSION['id'];
    $admin = new userDetails($uid);
    $admin = $admin->fetchDetails();
    // echo $uid;
    if(!$uid){
        throw new Exception("<script>alert('You have to login first')</script>");
    }

}
catch(Exception $e){
    echo $e->getMessage();
    echo "<script>window.location.href='../login.php'</script>";
}








