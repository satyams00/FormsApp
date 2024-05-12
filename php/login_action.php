<?php
include_once("../Connection.php");
include_once("../Users/login/LoginUser.php");



if(isset($_SESSION['signup'])){
    echo "<script>alert('Signup successfully')</script>";
    session_unset();
    echo "<script>window.location.href='../login.php'</script>";
}


try{
    if(isset($_POST['submit'])){
        $email = trim($_POST['email']);
        $pass = $_POST['password'] ;

        $loginUser = new LoginUser($email,$pass);
        

        $result = $loginUser->ValidateLogin();
        if($result->num_rows <= 0){
            throw new Exception("<script>alert('Incorrect Email/Password')</script>");
        }
        $row = $result->fetch_assoc();
        $_SESSION['login']=true;
        $_SESSION['id']=$row['id'];
        $_SESSION['role']=$row['role'];
        echo "<script>alert('Successfully Logged In')</script>";
        if(strtolower($row['role'])=='admin'){
            echo "<script>window.location.href='../Admin/dashboard.php'</script>";
        }else{
            echo "<script>window.location.href='../Users/dashboard.php'</script>";
        }

        
    }
}
catch(Exception $e){
    echo $e->getMessage();
    echo "<script>window.history.back();</script>";
}







?>