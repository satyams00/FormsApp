<?php
include_once("../Job/Job.php");
include_once("../Users/functions/User.php");
include_once("../Application/application.php");
include_once("../Application/ValidateApplication.php");


extract($_POST);
$user_id = $_SESSION['id'];

if(isset($_POST['read'])){
    $data = "
    <thead class='table-active'>
        <th>S. No.</th>
        <th>Title</th>
        <th>Post</th>
        <th>Exam Date</th>
        <th>Status</th>
        <th>Edit</th>
    </thead>
    <tbody>
    ";
    
    $jobs = new Job();
    $user_id = $user_id;

    $res = $jobs->getAppliedJob($user_id);

    if($res -> num_rows > 0){
        $cnt=1;
        while($row = $res->fetch_assoc()){
            $status = strtolower($row['status']);
            $statusClass = ($status=='accepted')?'text-success':($status=='rejected'?'text-danger':'text-warning');
            $flag = $status!='pending'?'disabled':'';
            $data .= 
            "<tr>
                <td>" .$cnt++. "</td>
                <td>" .$row['title']. "</td>
                <td>" .$row['post']. "</td>
                <td>" .$row['exam_date']. "</td>
                <td class='".$statusClass."'>".$row['status']. "</td>
                <td><button type='button'  data-bs-toggle='modal' data-bs-target='#editJobApplication' onclick=editApplication(".$row['user_id'].",".$row['job_id'].") class='btn btn-primary' ".$flag." >Edit</button></td>
            </tr>";
        }
        $data .= "</tbody>";
    }
    echo $data;


}



if(isset($_POST['jobL'])){
    $user_id = $_POST['user_id'];
    $job_id = $_POST['job_id'];
    $str = $_POST['str'];

    $job = new Job();
    $get_details = $job->getApplicationDetails($user_id,$job_id);
    $row = $get_details->fetch_assoc();
    $loc = $row['prefered_job_location'];

    $data = "<option value='' >Select</option>";
    $arr = explode(',',$str);
    for($i= 0;$i<count($arr);$i++){
        $select = (trim($arr[$i])==$loc)?"selected":" ";
        $data .= "<option value=".$arr[$i]." ".$select.">".$arr[$i]."</option>";
    }
    echo $data;
}

if(isset($_POST['examC'])){
    $user_id = $_POST['user_id'];
    $job_id = $_POST['job_id'];
    $str = $_POST['str'];

    $job = new Job();
    $get_details = $job->getApplicationDetails($user_id,$job_id);
    $row = $get_details->fetch_assoc();
    $center = $row['prefered_exam_center'];


    $data = "<option value='' >Select</option>";
    $arr = explode(',',$str);
    for($i= 0;$i<count($arr);$i++){
        $select = (trim($arr[$i])==$center)?'selected':' ';
        $data .= "<option value=".$arr[$i]." ".$select.">".$arr[$i]."</option>";
    }
    echo $data;
}


if(isset($_POST["edit"])){
    $userId = $_POST['uid'];
    $jobId = $_POST['jid'];
    $res_arr=array();

    $user = new User();
    $job = new Job();

    $user_res = $user->selectUser($userId);
    $job_res = $job->selectJob($jobId);
    $get_details = $job->getApplicationDetails($userId,$jobId);

    $userres_arr=array();
    $jobres_arr=array();
    $details_arr=array();
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
    if($get_details->num_rows > 0){
        while($row = $get_details->fetch_assoc()){
            $details_arr = $row;
        }
    }
    $res_arr = array_merge($userres_arr,$jobres_arr);
    $res_arr = array_merge($res_arr,$details_arr);
    echo json_encode( $res_arr );

}


if(isset($_POST['apply'])){
    $job_id = $_POST['jobid'];
    $userid = $_SESSION['id'];
    $application = new Application();
    $app = new ValidateApplication($_POST);

    if($app->isValid($job_id) === true){
        $application->setData($_POST,$userid,$job_id);
        $res = $application->updateData($userid,$job_id);
        if($res){
            echo "updated";
        }
    }
    else{
        echo json_encode($app->isValid($job_id));
    }


}


?>