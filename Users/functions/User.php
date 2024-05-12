<?php
include_once("../Connection.php");


class User extends Connection{
    public $fname;
    public $mname;
    public $lname;
    public $email;
    public $phone;
    public $gender;
    public $dob;
    public $pass;
    public $profileImg;


    function __construct(){
        parent::__construct();
    }

    public function setData($userDetail){
        $this->fname = $userDetail["firstname"];
        $this->mname = $userDetail["middlename"];
        $this->lname = $userDetail["lastname"];
        $this->email = $userDetail["email"];
        $this->phone = $userDetail["phone"];
        $this->gender = $userDetail["gender"];
        $this->dob = $userDetail["dob"];
        $this->pass = $userDetail["password"];
        // $this->profileImg = $userDetail["profileImg"];
    }
    

    public function setImg($img){
        $this->profileImg = $img['profileImg']['name'];
    }

    public function insertQuery(){
        $sql = "SELECT * from users where (email='$this->email' OR phone='$this->phone')";
        $res = $this->conn->query($sql);
        if($res->num_rows >0){
            throw new Exception("<script>alert('Email/Phone already exists....')</script>");
        }

        $this->pass = md5($this->pass);

        $sql = "INSERT INTO `users`(firstname,middlename,lastname,email,phone,gender,dob,password) 
        VALUES('$this->fname','$this->mname','$this->lname','$this->email','$this->phone','$this->gender','$this->dob','$this->pass')";

        $res = $this->conn->query($sql);

        if($res){
            $_SESSION['signup']=true;
            header('location: ../login.php');
        }
    }

    public function updateQuery($id){
        $sql = "UPDATE `users` SET `firstname`='$this->fname',`middlename`='$this->mname',`lastname`='$this->lname',`gender`='$this->gender',`dob`='$this->dob',`photo`='$this->profileImg' WHERE id='$id'";
        return $this->conn->query($sql);
    }

    
    public function selectQuery(){
        $sql = "SELECT u.*,a.user_id,count(u.id) as jobCount FROM `users` u LEFT JOIN `applications` a ON u.id=a.user_id GROUP by id;";
        $res = $this->conn->query($sql);
        if(!$res){
            throw new Exception("Query failed");
        }
        return $res;
    }
    public function selectUser($id){
        $sql = "SELECT * FROM `users` WHERE id='$id';";
        $res = $this->conn->query($sql);
        if(!$res){
            throw new Exception("Query failed");
        }
        return $res;
    }
   
    public function chackUser($uid,$jid){
        $sql = "SELECT id from `applications` WHERE user_id='$uid' AND job_id='$jid'";
        return $this->conn->query($sql);
    }

    public function userLogout(){
        session_unset();
        session_destroy();

        echo "<script>alert('Logged out successfully')</script>";
        echo "<script>window.location.href='../login.php'</script>";
    }
    

    public function verifyAdmin($id){
        $sql = "SELECT * from `users` WHERE id='$id' AND role='admin'";
        $res = $this->conn->query($sql);
        return $res->num_rows;
    }
    public function verifyUser($id){
        $sql = "SELECT * from `users` WHERE id='$id' AND role='user'";
        $res = $this->conn->query($sql);
        return $res->num_rows;
    }



}


?>
