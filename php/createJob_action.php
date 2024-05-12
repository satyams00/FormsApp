<?php
include("../Job/Job.php");
include("../Job/ValidateJobDetails.php");


try{
    if(isset($_POST["Submit"])){
        $data = new ValidateJobDetails($_POST);
        if(($data->isEmpty()===false) && ($data->validData()===true)){
            $job = new Job();
            $res = $job->createJob();
            if(!$res){
                throw new Exception("Query failed");
            }
            echo "<script>alert('Job created successfully')</script>";
            echo "<script>window.location.href='../Admin/viewJobs.php'</script>";
        }
        else{
            $_SESSION['error'] = $data->validData();
            $_SESSION['empty'] = $data->isEmpty();
            echo "<script>window.history.back()</script>";
        }

    }
    
}
catch(Exception $e){
    echo "".$e->getMessage()."";
    echo "<script>window.history.back()</script>";

}









?>