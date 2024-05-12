<?php
include_once("../Users/functions/User.php");
include_once("../Job/Job.php");
include_once("../Application/application.php");
include_once("../Application/ValidateApplication.php");


try{

    $user_id = $_GET['user_id'];
    $job_id = $_GET['job_id'];
    
    
    $user = new User();
    $res = $user->selectUser($user_id);
    $row = $res->fetch_assoc();
    
    
    $job = new Job();
    $res = $job->selectJob($job_id);
    $job_row = $res->fetch_assoc();

    
    $application = $job->getApplicationDetails($user_id,$job_id);
    $application_row = $application->fetch_assoc();
    if(strtolower($application_row['status']) != 'pending'){
        throw new Exception("<script>alert('Already Accepted or Rejected')</script>");
    }
    
    
    if(isset($_POST['Submit'])){
        $user_id = $_POST['user_id'];
        $job_id = $_POST['job_id'];
        
        $validData = new ValidateApplication($_REQUEST);
        $age= $validData->Age($user_id);
        // print_r($row);

        $min_age =$job_row['minimum_age'];

        if($age < $min_age){
            throw new Exception("<script>alert('You are not eligible for this job(Minimum age for this job is $min_age)')</script>");
        }
        
        if($validData->isValid($job_id) === true){
            $appli = new Application();
            $data = $appli->setData($_REQUEST,$user_id,$job_id);
            $res = $appli->updateData($user_id,$job_id);
            if(!$res){
                throw new Exception("<script>alert('Query failed');</script>");
            }

            echo "<script>alert('Job Updated successfully')</script>";
            echo "<script>window.location.href='../Users/viewJobs.php'</script>";
        }
        else{
            // print_r($validData->isValid($job_row));
            $_SESSION['error'] = $validData->isValid($job_id);
            echo "<script>window.history.back();</script>";
        }
    }
}
catch(Exception $e){
    echo $e->getMessage();
    echo "<script>window.location.href='../Users/viewJobs.php'</script>";
}


?>