<?php
include_once("../php/apply_action.php");
include_once("../logout.php");
include_once("../Users/functions/User.php");


$user = new User();
if($user->verifyUser($_SESSION['id']) == 0 ){
    echo "<script>window.history.back();</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    

    <button class="btn border btn-secondary" onclick="back();">Back</button>
    <div class="conatiner d-flex justify-content-center">
        <form action="../php/apply_action.php" class="w-50 border border-5 rounded-4 bg-dark-subtle p-3 my-5" method="POST">
            <h3 class="my-4 text-center">Apply Job</h3>
            <hr>
            <div class="mb-3 ">First name: <input type="text" name='fname' class="form-control" value="<?php echo $row['firstname'] ?>" disabled></div>
            <div class="mb-3 ">Middle name: <input type="text" name='mname' class="form-control" value="<?php echo $row['middlename'] ?>" disabled></div>
            <div class="mb-3 ">Last name: <input type="text" name='lname' class="form-control" value="<?php echo $row['lastname'] ?>" disabled></div>
            <div class="mb-3 ">Email: <input type="email" name='email' class="form-control" value="<?php echo $row['email'] ?>" disabled></div>
            <div class="mb-3 ">Phone: <input type="text" name='phone' class="form-control" value="<?php echo $row['phone'] ?>" disabled></div>
            <div class="mb-3 ">DOB: <input type="date" name='dob' class="form-control" value="<?php echo $row['dob'] ?>" disabled></div>
            <div class="mb-3 form-control bg-dark-subtle border-0 p-0">
                Gender: 
                <input class="form-check-input" type="radio" name="gender" value="M" <?php if($row['gender']=='Male') echo "checked"?> disabled> Male
                <input class="form-check-input" type="radio" name="gender" value="Female" <?php if($row['gender']=='F') echo "checked"?> disabled> Female
            </div>
            <div class="mb-3 ">Job title: <input type="text" name='lname' class="form-control" value="<?php echo $job_row['title'] ?>" disabled></div>
            <div class="mb-3 ">Job Post: <input type="text" name='lname' class="form-control" value="<?php echo $job_row['post'] ?>" disabled></div>
            <div class="mb-3 ">Height: <span class="text-danger">*<?php echo $_SESSION['error']['height'] ?></span> 
                <input type="number" name='height' class="form-control" placeholder="Height >= <?php echo $job_row['minimum_height'] ?>"></div>
            <div class="mb-3 ">High School Percentage: <span class="text-danger">*<?php echo $_SESSION['error']['highschool'] ?></span> 
                <input type="number" name='highschool_percentage' class="form-control" placeholder="Minimum Percentage : <?php echo $job_row['minimum_highschool_percentage'] ?>"></div>
            <div class="mb-3 ">Intermediate Percentage: <span class="text-danger">*<?php echo $_SESSION['error']['intermediate'] ?></span> 
                <input type="number" name='intermediate_percentage' class="form-control" placeholder="Minimum Percentage :  <?php echo $job_row['minimum_intermediate_percentage'] ?>"></div>
            <div class="mb-3 ">Prefered Job Location: <span class="text-danger">* <?php echo $_SESSION['error']['job_location'] ?> </span> 
                <select name="prefered_job_location" class="form-control">
                    <option value="" selected>Select</option>
                    <?php
                        $str = $job_row['job_location'];
                        $arr = explode(',',$str);
                        // print_r($arr);
                        foreach ($arr as $a){ ?>
                    <option value="<?php echo $a ?>"><?php echo $a; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3 ">Prefered exam center: <span class="text-danger">* <?php echo $_SESSION['error']['exam_center'] ?> </span> 
                <select name="prefered_exam_center" class="form-control">
                    <option value="" selected>Select</option>
                    <?php
                        $str = $job_row['exam_center'];
                        $arr = explode(',',$str);
                        // print_r($arr);
                        foreach ($arr as $a){ ?>
                    <option value="<?php echo $a ?>"><?php echo $a; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3 ">Address: <span class="text-danger">* <?php echo $_SESSION['error']['address'] ?> </span>
                <input type="text" name='address' class="form-control" ></div>
            <input type="hidden" name="user_id" value="<?php echo $_GET['user_id']; ?>">
            <input type="hidden" name="job_id" value="<?php echo $_GET['job_id']; ?>">
            <div class="text-center my-3"><input type="submit" class="btn btn-primary p-2" onclick="return confirm('Are you sure?');" value="Apply" name="Submit"></div>
            
        </form>
        <?php unset($_SESSION['error']); ?>
    </div>



</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    function back(){
        if(confirm('Are you sure?')){
            window.history.back();
        }
    }
</script>

</html>