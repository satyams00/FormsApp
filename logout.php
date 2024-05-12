<?php
include_once("../Users/functions/User.php");

if(!isset($_SESSION["id"])){
    header("location: ../login.php");
}


if(isset($_POST["logout"])){
    $user = new User();
    $user->userLogout();
}



?>