<?php
include_once("../logout.php");
include_once("../Application/application.php");
include_once("../Users/functions/User.php");


$user = new User();
if($user->verifyAdmin($_SESSION['id']) == 0 ){
    echo "<script>window.history.back();</script>";
}

$application = new Application();
$res = $application->getApplicationDetail();

// if(isset($_POST['accept'])){
//     $job_id = $_POST['job_id'];
//     $user_id = $_POST['user_id'];
//     $application->acceptApplication($user_id, $job_id);
//     echo "<script>window.location.href='../Admin/viewRequest.php';</script>";

// }
if(isset($_POST['reject'])){
    $job_id = $_POST['job_id'];
    $user_id = $_POST['user_id'];
    $application->rejectApplication($user_id, $job_id);
    echo "<script>window.location.href='../Admin/viewRequest.php';</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/2.0.4/css/dataTables.dataTables.css" rel="stylesheet">

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
                <a class="nav-link " href="viewUsers.php">View Users</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="createJob.php">Create Jobs</a>
                </li>
                <li class="nav-item">
                <a class="nav-link " href="viewJobs.php">View Jobs</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="viewRequest.php">View Request</a>
                </li>
            </ul>
            <form class="d-flex" method="POST">
                <input type="submit" name='logout' class="btn btn-danger" value="Logout" onclick='return confirm(`Are you sure ?`);'>
            </form>
            </div>
        </div>
        </nav>

        <button class="btn border btn-secondary" onclick="window.history.back();">Back</button>
        <div class="p-5">
        <h2 class="mb-5">Pending requests</h2>
            <table id="viewRequestTable" class="display" style="width:100%;">
                <div id="requestTable"></div>
            </table>
        </div>

    </div>
    
</body>
<script>
    


    $(document).ready(function () {
        readData();
    });
        function readData(){
       let res = 'res';
       $.ajax({
            url : '../php/viewRequestController.php',
            type : 'POST',
            data : {res:res},
            success :function(data,status){
                $('#viewRequestTable').html(data);
                new DataTable('#viewRequestTable');
            }
       }); 
    }

    function acceptRequest($job_id ,$user_id){
        let jid = $job_id;
        let uid =$user_id;
        let accept = 'accept';
        if(confirm('Are you sure?')){
            $.post('../php/viewRequestController.php',{
                accept:accept,
                jid:jid,
                uid:uid
            },function(data,status){
                // alert(status);
                readData();
            });
        }
    }
    function rejectRequest($job_id ,$user_id){
        let jid = $job_id;
        let uid =$user_id;
        let reject = 'reject';
        if(confirm('Are you sure?')){
            $.post('../php/viewRequestController.php',{
                reject:reject,
                jid:jid,
                uid:uid
            },function(data,status){
                readData();
            });
        }
    }


</script>

</html>