<?php
include("../../Connection.php");



class LoginUser extends Connection{
    protected $email;
    protected $password;
    public function __construct($email,$password){
        parent::__construct();
        $this->email = $email;
        $this->password = $password;
    }
    public function ValidateLogin(){
        if($this->email==null || $this->password==null){
            throw new Exception("<script>alert('Email & Password both are requird')</script>");
        }
        $sql = $this->conn->prepare("SELECT * FROM `users` WHERE email=? AND password=?");
        $this->password= md5($this->password);
        $sql->bind_param("ss", $this->email, $this->password);
        $sql->execute();
        $result = $sql->get_result();
        return $result;
    }
}









?>