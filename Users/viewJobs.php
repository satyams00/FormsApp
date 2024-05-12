<?php
include_once("../Job/Job.php");
include_once("../logout.php");
include_once("../Users/functions/User.php");
include_once("../Application/ValidateApplication.php");


$user = new User();
if($user->verifyUser($_SESSION['id']) == 0 ){
    echo "<script>window.history.back();</script>";
}


try{
    $jobs = new Job();
    $job_ids = $jobs->alreadyApplied($_SESSION["id"]);

    
    
    
}
catch(Exception $e){
    echo $e->getMessage();
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
                <a class="nav-link active " href="viewJobs.php">View Jobs</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="appliedFor.php">Applied For</a>
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
        <h3 class="mb-5">List of jobs </h3>
        <table id="viewJobsTable" class="display" style="width:100%;">
        </table>
    </div>
    


    <!-- apply -->
    <div class="modal fade" id="applyJob" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Apply Job</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname" class="form-control" disabled>
                </div>
                <div>
                    <label for="middlename">Middle Name</label>
                    <input type="text" id="middlename" class="form-control" disabled>
                </div>
                <div>
                    <label for="lastname">Last Name</label>
                    <input type="text" id="lastname" class="form-control" disabled>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control" disabled>
                </div>
                <div>
                    <label for="phone">Phone</label>
                    <input type="number" id="phone" class="form-control" disabled>
                </div>
                <div>
                    <label for="dob">DOB</label>
                    <input type="date" id="dob" class="form-control" disabled>
                </div>
                <div>
                    <label for="gender">Gender : </label>
                    <input type="radio" id="male" name="gender" value="M" disabled> Male
                    <input type="radio" id="female" name="gender" value="F" disabled> Female
                </div>
                <div>
                    <label for="jobTitle">Job Title</label>
                    <input type="text" id="jobTitle" class="form-control" disabled>
                </div>
                <div>
                    <label for="jobPost">Job Post</label>
                    <input type="text" id="jobPost" class="form-control" disabled>
                </div>
                <div>
                    <label for="height">Height </label> <span class="text-danger heightErr">*</span>
                    <input type="number" id="height" class="form-control" placeholder="Height">
                </div>
                <div>
                    <label for="highSchoolPercentage">High School Percentage </label> <span class="text-danger highschoolErr">*</span>
                    <input type="number" id="highSchoolPercentage" class="form-control"  placeholder="High School Percentage">
                </div>
                <div>
                    <label for="intermediatePercentage">Intermediate Percentage </label> <span class="text-danger intermediateErr">*</span>
                    <input type="number" id="intermediatePercentage" class="form-control"  placeholder="Intermediate Percentage">
                </div>
                
                <div>
                    <label for="preferedJobLocation">Perfered Job Location </label> <span class="text-danger jobLocErr">*</span>
                    <select name="preferedJobLocation" id="preferedJobLocation" class="form-control">
                        <option value="" selected>Select</option>
                    </select>
                </div>
                <div>
                    <label for="preferedExamCenter">Prefered Exam Center </label> <span class="text-danger examCenterErr">*</span>
                    <select name="preferedExamCenter" id="preferedExamCenter" class="form-control">
                        <option value="" selected>Select</option>
                    </select>
                </div>
                <div>
                    <label for="address">Address </label> <span class="text-danger addressErr">*</span>
                    <input type="text" id="address" class="form-control"  placeholder="Address">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="confirmApply();">Save changes</button>
                <input type="hidden" id="apply_id">
            </div>
            </div>
        </div>
    </div>


        
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    
    $(document).ready(function (){
        readData();
    });

    function readData(){
        let read = 'read';
        $.ajax({
            url : '../php/applyJobController.php',
            type : 'POST',
            data : {read : read},
            success : function (data,status){
                $('#viewJobsTable').html(data);
                new DataTable('#viewJobsTable');
            }
        });
    }

    
    function jobLoc($str){
        let jobL=true;
        let str = $str;
        $.post('../php/applyJobController.php',{
            jobL:jobL,
            str:str
        },function (data,status){
            $('#preferedJobLocation').html(data);
        });
    }

    function examCenter($str){
        let examC=true;
        let str = $str;
        $.post('../php/applyJobController.php',{
            examC:examC,
            str:str
        },function (data,status){
            $('#preferedExamCenter').html(data);
        });
    }

    

    function applyJob($uid,$jid){

        $('#apply_id').val($jid);
        let apply='apply';
        let uid=$uid;
        let jid=$jid;
        $.post('../php/applyJobController.php',{
            apply,apply,
            uid:uid,
            jid:jid
        },function (data,status){
            if(data !== 'false'){
                let res =JSON.parse(data);
                $('#firstname').val(res.firstname);
                $('#middlename').val(res.middlename);
                $('#lastname').val(res.lastname);
                $('#email').val(res.email);
                $('#phone').val(res.phone);
                $('#dob').val(res.dob);
                if(res.gender=='Male'){
                    $("#male").prop("checked", true);
                }else if(res.gender=='Female'){
                    $("#female").prop("checked", true);
                }
                $('#jobTitle').val(res.title);
                $('#jobPost').val(res.post);
                jobLoc(res.job_location);
                examCenter(res.exam_center);
            }else{
                alert("You are not eligible for this job");
                $('#applyJob').on('shown.bs.modal',()=>{
                    $('#applyJob').modal('hide');

                });
            }
        });
    }


    function confirmApply(){
        let confirm = "confirm";
        let job_id = $('#apply_id').val();
        let height = $('#height').val();
        let highSchoolPercentage = $('#highSchoolPercentage').val();
        let intermediatePercentage = $('#intermediatePercentage').val();
        let preferedJobLocation = $('#preferedJobLocation').val();
        let preferedExamCenter = $('#preferedExamCenter').val();
        let address = $('#address').val();
        // alert(address);
        $.post('../php/applyJobController.php',{
            confirm:confirm,
            job_id:job_id,
            height:height,
            highschool_percentage:highSchoolPercentage,
            intermediate_percentage:intermediatePercentage,
            prefered_job_location:preferedJobLocation,
            prefered_exam_center:preferedExamCenter,
            address:address
        },function(data,status){
            if(data == "done"){
                alert('Job submitted sucessfully');
                $('#applyJob').modal('hide');
                readData();
            }
            else if(data == 'failed'){
                alert('Query failed');
            }
            else{
                // alert('error');
                let error =JSON.parse(data);
                $('.heightErr').html(error.height);
                $('.highschoolErr').html(error.highschool);
                $('.intermediateErr').html(error.intermediate);
                $('.jobLocErr').html(error.job_location);
                $('.examCenterErr').html(error.exam_center);
                $('.addressErr').html(error.address);
                console.log(error);

            }
        });
    }



</script>
</html>