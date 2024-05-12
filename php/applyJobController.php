<?php
include("../Users/functions/User.php");
include("../Job/Job.php");
include("../Application/application.php");
include_once("../Application/ValidateApplication.php");


$jobs = new Job();
$res = $jobs->selectAllJobs();

extract($_POST);
$id = $_SESSION['id'];

if(isset($_POST['read'])){
    $data = "
        <thead class='table-active'>
        <th>S. No.</th>
        <th>Title</th>
        <th>Post</th>
        <th>Registration_start</th>
        <th>Last date</th>
        <th>Minimum age</th>
        <th>Maximum age</th>
        <th>Minimum height</th>
        <th>Job location</th>
        <th>Exam Center</th>
        <th>Exam Date</th>
        <th>Minimum 10%</th>
        <th>Minimum 12%</th>
        <th>Job description</th>
        <th></th>
        </thead>
        <tbody>
    ";
    if($res->num_rows > 0){
        $cnt=1;
        $app = new Application();
        foreach($res->fetch_all(MYSQLI_ASSOC) as $row){
            
            $app_res = $app->checkJob($id,$row['id']);
            $data .= "<tr>
            <td>". $cnt++ ."</td>
            <td>". $row['title'] ."</td>
            <td>". $row['post'] ."</td>
            <td>". $row['registration_start'] ."</td>
            <td>". $row['registration_end'] ."</td>
            <td>". $row['minimum_age'] ."</td>
            <td>". $row['maximum_age'] ."</td>
            <td>". $row['minimum_height'] ."</td>
            <td>". $row['job_location'] ."</td>
            <td>". $row['exam_center'] ."</td>
            <td>". $row['exam_date'] ."</td>
            <td>". $row['minimum_highschool_percentage'] ."</td>
            <td>". $row['minimum_intermediate_percentage'] ."</td>
            <td>". $row['job_description'] ."</td>";
            if($app_res->num_rows==0){
                $data .="
                <td><button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#applyJob' onclick='applyJob(".$id.",".$row['id'].");'>Apply</button></td>";
            }else{
                $data .="
                <td><button class='btn btn-primary' disabled>Applied</button></td>";
            }

        }
        echo "</tbody>";
    }
    echo $data;
}




if(isset($_POST["apply"])){
    $userId = $_POST['uid'];
    $jobId = $_POST['jid']; 


    $res = $jobs->selectJob($jobId);
    $job_row = $res->fetch_assoc();
    
    $user = new User();
    $age_res = $user->selectUser($userId);


    $age_row = $age_res->fetch_assoc();
    $year=$age_row['dob'];
    $year = date_create($year);
    $year = date_format($year,"Y");
    $age = date("Y")-$year;

    $min_age =$job_row['minimum_age'];


    if($age >= $min_age){
        $res_arr=array();

        $user = new User();
        $job = new Job();

        $user_res = $user->selectUser($userId);
        $job_res = $job->selectJob($jobId);

        $userres_arr=array();
        $jobres_arr=array();
        if($user_res->num_rows > 0){
            while($row = $user_res->fetch_assoc()){
                $userres_arr = $row;
            }
        }
        if($job_res->num_rows > 0){
            while($row = $job_res->fetch_assoc()){
                $jobres_arr = $row;
            }
        }
        $res_arr = array_merge($userres_arr,$jobres_arr);
        echo json_encode( $res_arr );
    }
    else{
        echo 'false';
    }






    

}

if(isset($_POST['jobL'])){
    $str = $_POST['str'];
    $data = "<option value='' selected>Select</option>";
    $arr = explode(',',$str);
    for($i= 0;$i<count($arr);$i++){
        $data .= "<option value=".$arr[$i]." >".$arr[$i]."</option>";
    }
    echo $data;
}
if(isset($_POST['examC'])){
    $str = $_POST['str'];
    $data = "<option value='' selected>Select</option>";
    $arr = explode(',',$str);
    for($i= 0;$i<count($arr);$i++){
        $data .= "<option value=".$arr[$i]." >".$arr[$i]."</option>";
    }
    echo $data;
}


if(isset($_POST["confirm"])){
    $userid = $id;
    $jobid= $_POST['job_id'];
    $validData = new ValidateApplication($_REQUEST);
    
    if($validData->isValid($jobid) === true){
        $application = new Application();
        $data = $application->setData($_REQUEST,$userid,$jobid);
        $res = $application->insertData();
        if(!$res){
            echo "failed";
        }
        echo "done";
    }
    else{

        $obj = $validData->isValid($jobid);
        echo json_encode($obj);
        
        // echo "error";
    }
}



?>