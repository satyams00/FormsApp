<?php
include_once("../Connection.php");
include_once("../Users/Functions/User.php");
include_once("../Users/Functions/UserValidation.php");
// error_reporting(E_ALL);



try{
    $id = $_SESSION['id'];
    if(isset($_POST["save"])){
        
        $checkUserValidation = new UserValidation($_REQUEST);
        if($checkUserValidation->isEmpty()){
            $_SESSION['required'] = $checkUserValidation->isEmpty();
            echo "<script>window.history.back();</script>";
            throw new Exception("<script>alert('All * fields are required.')</script>");
        }
        $checkDetails = $checkUserValidation->check();
        // echo $_FILES;
        $checkProfileImg = $checkUserValidation->checkProfilePhoto($_FILES);
        if($checkProfileImg !== true){
            throw new Exception($checkProfileImg);
        }
        
        $userDetail = $checkUserValidation->getUserDetails();
        
        if($checkDetails === false){
            $user = new User();
            $user->setData($userDetail);
            $user->setImg($_FILES);
            if($user->updateQuery($id)){
                echo "<script>alert('Profile updated successfully')</script>";
                echo "<script>window.history.go(-2);</script>";
            }

        }else{
            $_SESSION['err'] = $checkDetails;
            echo "<script>window.history.back();</script>";
        }

    
    }
}
catch(Exception $e){
    echo $e->getMessage();
    echo "<script>window.history.back();</script>";
}




?>