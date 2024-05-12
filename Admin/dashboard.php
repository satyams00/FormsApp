<?php
include_once("UserDetails.php");
include_once("../logout.php");

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
    <link rel="stylesheet" href="css/viewUsers.css">

</head>
<body>
    <div class="">
        <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark border-bottom border-body"  data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link " href="ViewUsers.php">View Users</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="createJob.php">Create Jobs</a>
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
        <div class="container">
            <div class="row col-12">
                <div class="col-8">
                    <table class="table table-bordered my-5">
                        <tbody >
                            <tr><th>Name :</th><td><?php echo $admin['firstname'].' '.$admin['middlename'].' '.$admin['lastname']; ?></td></tr>
                            <tr><th>Phone :</th><td><?php echo $admin['phone']; ?></td></tr>
                            <tr><th>Email :</th><td><?php echo $admin['email']; ?></td></tr>
                            <tr><th>Gender :</th><td><?php echo $admin['gender']; ?></td></tr>
                            <tr><th>DOB :</th><td><?php echo $admin['dob']; ?></td></tr>
                        </tbody>
                    </table>
                    <form action="../Users/editProfile.php">
                        <div class="text-center"><button class="btn btn-primary" type="submit" name="edit">Edit</button></div>
                    </form>
                </div>
                <div class="col-4 my-5">
                    <img src="../img/<?php echo $admin['photo']; ?>" class="rounded-circle" alt="">
                </div>
            </div>
        </div>
        
    </div>
    
</body>
</html>