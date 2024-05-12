<?php
include_once("../Users/functions/User.php");
include_once("../logout.php");


$users = new User();

if($users->verifyAdmin($_SESSION['id']) == 0 ){
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
    <link href="https://cdn.datatables.net/2.0.4/css/dataTables.dataTables.css" rel="stylesheet" >

    <script src='https://code.jquery.com/jquery-3.7.1.js'></script>
    <script src='https://cdn.datatables.net/2.0.4/js/dataTables.js'></script>

    
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
                <a class="nav-link " aria-current="page" href="dashboard.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="ViewUsers.php">View Users</a>
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
        <div class="p-5">
            <h2 class="mb-5">Users</h2>
            <table id="viewUserTable" class="display" style="width:100%">
                <thead class="table-active">
                    <tr>
                        <th scope='col'>S. No.</th>
                        <th scope='col'>id</th>
                        <th scope='col'>firstname</th>
                        <th scope='col'>middlename</th>
                        <th scope='col'>lastname</th>
                        <th scope='col'>email</th>
                        <th scope='col'>phone</th>
                        <th scope='col'>gender</th>
                        <th scope='col'>dob</th>
                        <th scope='col'>created_at</th>
                        <th scope='col'>Job Applied</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt=1;
                    foreach($users->selectQuery()->fetch_all(MYSQLI_ASSOC) as $row){ if(strtolower($row['role']) != 'admin'){
                      ?>
                        <tr>
                            <th scope='row'><?php echo  $cnt++ ?></th>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['firstname'] ?></td>
                            <td><?php echo $row['middlename'] ?></td>
                            <td><?php echo $row['lastname'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td><?php echo $row['phone'] ?></td>
                            <td><?php echo $row['gender'] ?></td>
                            <td><?php echo $row['dob'] ?></td>
                            <td><?php echo $row['created_at'] ?></td>
                            <td><?php if($row['user_id']){echo $row['jobCount'];}else echo 0; ?></td>
                        </tr>
                    <?php }} ?>
                </tbody>
            </table>


            </div>
    </div>
    
</body>
<script>new DataTable('#viewUserTable')</script>

</html>


