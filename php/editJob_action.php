<?php
include("../Job/Job.php");
include("../Job/ValidateJobDetails.php");

error_reporting(0);


try{
    

    if(isset($_POST['Update'])){
        $jid = $_POST['jid'];
        $data = new ValidateJobDetails();
        $job_row = new Job();
        if(($data->isEmpty()===false) && ($data->validData()===true)){
            $updateQuery = $job_row->updateJob($jid); 
            if(!$updateQuery){
                throw new Exception("<script>alert('Update query failed')</script>");
            }
            echo "<script>alert('Job updated successfully')</script>";
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
    echo $e->getMessage();
}


?>

