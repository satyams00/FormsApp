<?php
include_once("../Connection.php");
include_once("../Users/Functions/User.php");
include_once("../Users/Functions/UserValidation.php");




try{
    if(isset($_POST["submit"])){


        $checkUserValidation = new UserValidation($_REQUEST);
        if($checkUserValidation->isEmpty()){
            $_SESSION['required'] = $checkUserValidation->isEmpty();
            echo "<script>window.history.back();</script>";
            throw new Exception("<script>alert('All * fields are required.')</script>");
        }
        $checkDetails = $checkUserValidation->check();

        $userDetail = $checkUserValidation->getUserDetails();
     
        
        if($checkDetails === false){
            $user = new User();
            $user->setData($userDetail);
            $user->insertQuery();
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