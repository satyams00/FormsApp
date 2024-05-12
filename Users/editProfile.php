<?php
include_once("../Users/functions/User.php");

// session_start();
error_reporting(0);

$user = new User();
$id = $_SESSION['id'];
$res = $user->selectUser($id);
$row = $res->fetch_assoc();
// print_r($row);

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
            <form action="../php/editProfileController.php" method="POST" enctype="multipart/form-data">
                <h3 class="text-center mb-3">Update Profile</h3>
                <div>First Name : <span class="text-danger">*</span><input type="text" class="form-control" name="firstname" value="<?php echo $row['firstname'] ?>" placeholder="Enter your first name"></div><span class="text-danger"><?php echo $_SESSION['err']['fname'],$_SESSION['required']['fname']; ?></span>
                <div>Middle Name : <input type="text" class="form-control" name="middlename" value="<?php echo $row['middlename'] ?>" placeholder="Enter your middle name"></div><span class="text-danger"><?php echo $_SESSION['err']['mname']; ?></span>
                <div>Last Name : <span class="text-danger">*</span><input type="text" class="form-control" name="lastname" value="<?php echo $row['lastname'] ?>" placeholder="Enter your last name"></div><span class="text-danger"><?php echo $_SESSION['err']['lname'],$_SESSION['required']['lname']; ?></span>
                <div>Email : <span class="text-danger">*</span><input type="text" class="form-control" name="email" value="<?php echo $row['email'] ?>"  placeholder="Enter your name"></div><span class="text-danger"><?php echo $_SESSION['err']['email'],$_SESSION['required']['email']; ?></span>
                <div>Phone : <span class="text-danger">*</span><input type="number" class="form-control" name="phone" value="<?php echo $row['phone'] ?>"  placeholder="Enter your phone number"></div><span class="text-danger"><?php echo $_SESSION['err']['phone'],$_SESSION['required']['phone']; ?></span>
                <div class="my-2">Gender : <span class="text-danger">* <?php echo $_SESSION['required']['gender']; ?></span> 
                    <input type="radio" name="gender" value="Male" <?php if($row['gender']=='Male'){echo "checked";} ?>> Male 
                    <input type="radio" name="gender" value="Female" <?php if($row['gender']=='Female'){echo "checked";} ?>> Female </div>
                <div>DOB : <span class="text-danger">*<?php echo $_SESSION['err']['dob'],$_SESSION['required']['dob']; ?></span><input type="date" class="form-control" name="dob" value="<?php echo $row['dob'] ?>" placeholder="Enter your Date of Birth"></div>
                <div class="mb-2"> <input type="hidden" class="form-control" name="password" value="<?php echo $row['password'] ?>" placeholder="Enter Password"></div>
                <div>Profile photo: <input type="file" name = "profileImg"></div>
                <div class="text-center pt-4"><input type="submit" class="btn btn-primary" value="Save" name="save"></div>
                
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