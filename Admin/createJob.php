<?php
include_once("../php/createJob_action.php");
include_once("../logout.php");
include_once("../Users/functions/User.php");
error_reporting(0);

$user = new User();
if($user->verifyAdmin($_SESSION['id']) == 0 ){
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
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark border-bottom border-body"  data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link " aria-current="page" href="dashboard.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link " href="ViewUsers.php">View Users</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="createJob.php">Create Jobs</a>
                </li>
                <li class="nav-item">
                <a class="nav-link " href="viewJobs.php">View Jobs</a>
                </li>
                <li class="nav-item">
                <a class="nav-link " href="viewRequest.php">View Request</a>
                </li>
            </ul>
            <form class="d-flex" method="POST">
                <input type="submit" name='logout' class="btn btn-danger" value="Logout" onclick="return confirm('Are you sure?');">
            </form>
            </div>
        </div>
    </nav>

    <button class="btn border btn-secondary" onclick="window.history.back();">Back</button>
    <div class="conatiner d-flex justify-content-center">
        <form action="../php/createJob_action.php" class="w-50 border border-5 rounded-4 bg-dark-subtle p-3 my-5" method="POST">
            <h3 class="my-4 text-center">Create Job</h3>
            <hr>
            <div class="mb-3 ">Title: <span class="text-danger">*<?php echo $_SESSION['empty']['title'] ?><input type="text" name='title' class="form-control" placeholder="Company Name"></div>
            <div class="mb-3">Post: <span class="text-danger">*<?php echo $_SESSION['empty']['post'] ?></span><input type="text" name='post' class="form-control" placeholder="Post Name"></div>
            <div class="mb-3">Registration start date: <span class="text-danger">*<?php echo $_SESSION['error']['start_date']?$_SESSION['error']['start_date']:$_SESSION['empty']['start_date'] ?></span> <input type="date" name='start_date' class="form-control"></div>
            <div class="mb-3">Registration end date: <span class="text-danger">*<?php echo $_SESSION['error']['end_date']?$_SESSION['error']['end_date']:$_SESSION['empty']['end_date'] ?></span> <input type="date" name='end_date' class="form-control"></div>
            <div class="mb-3">Minimum age: <span class="text-danger">*<?php echo $_SESSION['error']['min_age']?$_SESSION['error']['min_age']:$_SESSION['empty']['min_age'] ?></span> <input type="number" name='min_age' class="form-control" placeholder="Minimum age"></div>
            <div class="mb-3">Maximum age: <span class="text-danger">*<?php echo $_SESSION['error']['max_age']?$_SESSION['error']['max_age']:$_SESSION['empty']['max_age'] ?></span><input type="number" name='max_age' class="form-control" placeholder="Maximum age"></div>
            <div class="mb-3">Minimum height: <span class="text-danger">*<?php echo $_SESSION['error']['min_height']?$_SESSION['error']['min_height']:$_SESSION['empty']['min_height'] ?></span><input type="number" name='min_height' class="form-control" placeholder="Minimum height in foot"></div>
            <div class="mb-3">Job Locations: <span class="text-danger">*<?php echo $_SESSION['empty']['job_location'] ?></span> <input type="text" name='Job_location' class="form-control" placeholder="Enter job locations seperated by comma(,)"></div>
            <div class="mb-3">Exam Center: <span class="text-danger">*<?php echo $_SESSION['empty']['exam_center'] ?></span> <input type="text" name='exam_center' class="form-control" placeholder="Enter examination centers seperated by comma(,)"></div>
            <div class="mb-3">Minimum High School Percentage: <span class="text-danger">*<?php echo $_SESSION['empty']['min_10'] ?><input type="number" name='min_10' class="form-control" placeholder="Minimum 10%"></div>
            <div class="mb-3">Minimum Intermediate Percentage: <span class="text-danger">*<?php echo $_SESSION['empty']['min_12'] ?><input type="number" name='min_12' class="form-control" placeholder="Minimum 12%"></div>
            <div class="mb-3">Examination date: <span class="text-danger">*<?php echo $_SESSION['error']['exam_date']?$_SESSION['error']['exam_date']:$_SESSION['empty']['exam_date'] ?></span> <input type="date" name='exam_date' class="form-control"></div>
            <div class="mb-3">Job description : <span class="text-danger">*<?php echo $_SESSION['empty']['JD'] ?><textarea name="JD" class="form-control" id="JD" cols="30" rows="10" placeholder="Enter Job description......"></textarea></div>
            <div class="text-center my-3"><input type="submit" class="btn btn-primary p-2" value="Submit" name="Submit"></div>
            
        </form>
        
    </div>



</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>