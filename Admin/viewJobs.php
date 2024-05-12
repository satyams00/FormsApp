<?php
include_once("../Job/Job.php");
include_once("../logout.php");
include_once("../Users/functions/User.php");

$jobs = new Job();
$res = $jobs->viewJobs();


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
    <link href="https://cdn.datatables.net/2.0.4/css/dataTables.dataTables.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src='https://code.jquery.com/jquery-3.7.1.js'></script>
    <script src='https://cdn.datatables.net/2.0.4/js/dataTables.js'></script>
</head>
<body >
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
                <a class="nav-link" href="createJob.php">Create Jobs</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="viewJobs.php">View Jobs</a>
                </li>
                <li class="nav-item">
                <a class="nav-link " href="viewRequest.php">View Request</a>
                </li>
            </ul>
            <form class="d-flex" method="POST">
                <input type="submit" name='logout' class="btn btn-danger" value="Logout" onclick='return checkLogout()'>
            </form>
            </div>
        </div>
    </nav>

    <button class="btn border btn-secondary" onclick="window.history.back();">Back</button>
    <div class="p-5">
        <h2 class="mb-5">All Jobs</h2>
        <table id='viewJobTable' class='display' style='width:100%; table-layout:fixed;'>
            <!-- <div id="jobTable"></div> -->
        </table>
    </div>




    <!-- Modal -->
    <!-- Update Job Form -->
    <div class="modal fade" id="editJob" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel"><h2>Edit Job</h2></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body bg-success-subtle">
            <div>
                <label for="title">Title</label> <span id="titleErr" class="text-danger">*</span><input type="text" id='title' class="form-control">
            </div>
            <div>
                <label for="post">Post</label> <span class="text-danger postErr">*</span><input type="text" id='post' class="form-control" >
            </div>
            <div>
                <label for="startRegistrationDate">Start Registration Date</label> <span class="text-danger start_reg_dateErr">*</span>
                <input type="date" class="form-control" id="startRegistrationDate">
            </div>
            <div>
                <label for="endRegistrationDate">Last Registration Date</label> <span class="text-danger end_reg_dateErr">*</span>
                <input type="date" class="form-control" id="endRegistrationDate">
            </div>
            <div>
                <label for="minimumAge">Minimum Age</label> <span class="text-danger min_ageErr">*</span>
                <input type="number" class="form-control" id="minimumAge">
            </div>
            <div>
                <label for="maximumAge">Maximum Age</label> <span class="text-danger max_ageErr">*</span>
                <input type="number" class="form-control" id="maximumAge">
            </div>
            <div>
                <label for="maximumHeight">Minimum Height</label> <span class="text-danger min_heightErr">*</span>
                <input type="number" class="form-control" id="minimumHeight">
            </div>
            <div>
                <label for="jobLocation">Job Locations</label> <span class="text-danger job_locationErr">*</span>
                <input type="text" class="form-control" id="jobLocation">
            </div>
            <div>
                <label for="examCenter">Exam Center</label> <span class="text-danger exam_centerErr">*</span>
                <input type="text" class="form-control" id="examCenter">
            </div>
            <div>
                <label for="minimumHighschoolPercentage">Minimum HighSchool Percentage</label> <span class="text-danger min_10Err">*</span>
                <input type="number" class="form-control" id="minimumHighschoolPercentage">
            </div>
            <div>
                <label for="minimumIntermediatePercentage">Minimum Intermediate Percentage</label> <span class="text-danger min_12Err">*</span>
                <input type="number" class="form-control" id="minimumIntermediatePercentage">
            </div>
            <div>
                <label for="examinationDate">Exam Date</label> <span class="text-danger exam_dateErr">*</span>
                <input type="date" class="form-control" id="examinationDate">
            </div>
            <div>
                <label for="jobDescription">Job description</label> <span class="text-danger JDErr">*</span>
                <input type="text" class="form-control" id="jobDescription">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="updateForm()">Save changes</button>
            <input type="hidden" id="job_id">
        </div>
        </div>
    </div>
    </div>


</body>
<script>
    
    
    function checkLogout(){
        return confirm('Are you sure?');
    }

    $(document).ready(function(){
        readData();
    });
    function readData(){
        
        let response = "response";
        $.ajax({
            url : '../php/viewJobsController.php',
            type : 'POST',
            data : {response : response},
            success :function(data,status){
                $("#viewJobTable").html(data);
                new DataTable('#viewJobTable');
            }
        });
        
    }
    
    
    
    function editJobs($id){
        $('#job_id').val($id);
        let edit_id = $id;
        $.post('../php/viewJobsController.php',{
            edit_id:edit_id
        },function (data,status){
            let job = JSON.parse(data);
            $('#title').val(job.title);
            $('#post').val(job.post);
            $('#startRegistrationDate').val(job.registration_start);
            $('#endRegistrationDate').val(job.registration_end);
            $('#minimumAge').val(job.minimum_age);
            $('#maximumAge').val(job.maximum_age);
            $('#minimumHeight').val(job.minimum_height);
            $('#jobLocation').val(job.job_location);
            $('#examCenter').val(job.exam_center);
            $('#minimumHighschoolPercentage').val(job.minimum_highschool_percentage);
            $('#minimumIntermediatePercentage').val(job.minimum_intermediate_percentage);
            $('#examinationDate').val(job.exam_date);
            $('#jobDescription').val(job.job_description);
        });
    }


    function updateForm(){
        let job_id = $('#job_id').val();
        let title = $('#title').val();
        let post = $('#post').val();
        let start_reg_date = $('#startRegistrationDate').val();
        let end_reg_date = $('#endRegistrationDate').val();
        let minimum_age = $('#minimumAge').val();
        let maximum_age = $('#maximumAge').val();
        let minimum_height = $('#minimumHeight').val();
        let job_location = $('#jobLocation').val();
        let exam_center = $('#examCenter').val();
        let minimum_highschool_percentage = $('#minimumHighschoolPercentage').val();
        let minimum_intermediate_percentage = $('#minimumIntermediatePercentage').val();
        let exam_date = $('#examinationDate').val();
        let job_description = $('#jobDescription').val();

        $.post('../php/viewJobsController.php',{
            job_id:job_id,
            title:title,
            post:post,
            start_date:start_reg_date,
            end_date:end_reg_date,
            min_age:minimum_age,
            max_age:maximum_age,
            min_height:minimum_height,
            Job_location:job_location,
            exam_center:exam_center,
            min_10:minimum_highschool_percentage,
            min_12:minimum_intermediate_percentage,
            exam_date:exam_date,
            JD:job_description

        },function (data,status){
            // alert(data);
            if(data == 'done'){
                $('#editJob').modal('hide'); 
                readData();
            }
            else{
                $error =JSON.parse(data);
                $('#titleErr').html($error.title);
                $('.postErr').html($error.post);
                $('.start_reg_dateErr').html($error.start_date);
                $('.end_reg_dateErr').html($error.end_date);
                $('.min_ageErr').html($error.min_age);
                $('.max_ageErr').html($error.max_age);
                $('.min_heightErr').html($error.min_height);
                $('.job_locationErr').html($error.job_location);
                $('.exam_centerErr').html($error.exam_center);
                $('.min_10Err').html($error.min_10);
                $('.min_12Err').html($error.min_12);
                $('.exam_dateErr').html($error.exam_date);
                $('.JDErr').html($error.JD);
            }
            
        });
        
    }


    function deleteJob($id){
        let delete_id = $id;
        if(confirm('Are you sure?')){
            $.ajax({
                url : '../php/viewJobsController.php',
                type : "POST",
                data : {delete_id : delete_id},
                success :function(data,status){
                    readData();
                }
            })
        }
    }

</script>
</html>