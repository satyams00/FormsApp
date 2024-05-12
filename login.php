<?php

session_start();
error_reporting(0);

if($_SESSION['login']){
    echo "<script>window.history.forward();</script>";
}

if($_SESSION['signup']){
    echo "<script>alert('Account Created Successfully')</script>";
    unset($_SESSION['signup']);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container d-flex justify-content-center align-items-center mt-5">
    <div class="signupForm border rounded-2 bg-body-secondary p-4">
       <form action="php/login_action.php" method="post">
            <h3>Login form</h3> <br>
            <input type="email" class="form-control" name="email" placeholder="Email"> <br>
            <input type="password" class="form-control" name="password" placeholder="Password"> <br> 
            <input type="submit" class="w-100 my-2 btn btn-primary" name="submit" value="Submit"> <br>
            <div class="text-center">Don't have account <a href="signup.php" class="text-center">Signup here</a></div>
        </form>    
    </div>
</div>

</body>
</html>