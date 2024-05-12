<?php

session_start();
error_reporting(0);

if($_SESSION['login']){
    echo "<script>alert('Already Logged IN')</script>";
    echo "<script>window.history.back();</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    
    <div class="container d-flex justify-content-center align-items-center">
        <div class="form border bg-body-secondary rounded-2 p-4 w-25">
            <form action="php/signup_action.php" method="POST">
                <h3 class="text-center mb-3">SignUp Form</h3>
                <div>First Name : <span class="text-danger">*</span><input type="text" class="form-control" name="firstname" placeholder="Enter your first name"></div><span class="text-danger"><?php echo $_SESSION['err']['fname'],$_SESSION['required']['fname']; ?></span>
                <div>Middle Name : <input type="text" class="form-control" name="middlename" placeholder="Enter your middle name"></div><span class="text-danger"><?php echo $_SESSION['err']['mname']; ?></span>
                <div>Last Name : <span class="text-danger">*</span><input type="text" class="form-control" name="lastname" placeholder="Enter your last name"></div><span class="text-danger"><?php echo $_SESSION['err']['lname'],$_SESSION['required']['lname']; ?></span>
                <div>Email : <span class="text-danger">*</span><input type="text" class="form-control" name="email" placeholder="Enter your name"></div><span class="text-danger"><?php echo $_SESSION['err']['email'],$_SESSION['required']['email']; ?></span>
                <div>Phone : <span class="text-danger">*</span><input type="number" class="form-control" name="phone" placeholder="Enter your phone number"></div><span class="text-danger"><?php echo $_SESSION['err']['phone'],$_SESSION['required']['phone']; ?></span>
                <div class="my-2">Gender : <span class="text-danger">* <?php echo $_SESSION['required']['gender']; ?></span> <input type="radio" name="gender" value="Male"> Male 
                    <input type="radio" name="gender" value="Female"> Female </div>
                <div>DOB : <span class="text-danger">*<?php echo $_SESSION['err']['dob'],$_SESSION['required']['dob']; ?></span><input type="date" class="form-control" name="dob" placeholder="Enter your Date of Birth"></div>
                <div>Password : <span class="text-danger">* <?php echo $_SESSION['required']['password']; ?></span><input type="password" class="form-control" name="password" placeholder="Enter Password"></div>
                <div class="text-center pt-4"><input type="submit" class="btn btn-primary" value="Submit" name="submit"></div>
                Don't have acoount <a href="login.php">Click here</a>
            </form>
            <?php 
                unset($_SESSION['required']);
                unset($_SESSION['err']);
            ?>
        </div>
    </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>