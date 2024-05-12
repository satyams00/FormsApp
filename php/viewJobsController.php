<?php
include_once("../Job/Job.php");
include("../Job/ValidateJobDetails.php");

$jobs = new Job();
$res = $jobs->viewJobs();

extract($_POST);

if(isset($_POST['response'])){
    $data = "
<thead class='table-active '>
    <th>S. No.</th>
    <th>title</th>
    <th>post</th>
    <th>reg_date</th>
    <th>end_date</th>
    <th>min_age</th>
    <th>max_age</th>
    <th>min_height</th>
    <th>Job location</th>
    <th>Exam center</th>
    <th>Min 10%</th>
    <th>Min 12%</th>
    <th>Exam Date</th>
    <th>Job Description</th>
    <th>Applied Count</th>
    <th>updated_at</th>
    <th>Edit</th>
    <th>Delete</th>
    <th>View</th>
</thead>
<tbody>";


if($res->num_rows > 0){
    $cnt=1;
    while($row = $res->fetch_assoc()){
        $data .= "
        <tr id='tRow' value=".$row['id'].">
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
            <td>". $row['minimum_highschool_percentage'] ."</td>
            <td>". $row['minimum_intermediate_percentage'] ."</td>
            <td>". $row['exam_date'] ."</td>
            <td>". $row['job_description'] ."</td>
            <td>". $row['jobCount'] ."</td>
            <td>". $row['updated_at'] ."</td>
            <td><button class='btn btn-success' data-bs-toggle='modal' data-bs-target='#editJob' name='edit' onclick='editJobs(".$row['id'].")' >Edit</button>
            </td>
            <td>
                <input type='submit' name='delete' class='btn btn-danger' value='Delete' onclick='deleteJob(". $row['id'] .")'>
            </td>
            <td><button class='btn btn-primary' name='view'><a href='jobApplied.php?id=". $row['id'] ."' class='text-decoration-none text-white'>View</a></button></td>
        </tr>
        ";
    }
}

$data .= "</tbody>";

echo $data;

}


if(isset($_POST["edit_id"])){
    $res = $jobs->selectJob($_POST['edit_id']);
    if(!$res){
        exit();
    }
    $response = array();
    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            $response = $row;
        }
    }
    else{
        $response['status'] = 200;
        $response['message'] = 'Data not found';
    }
    echo json_encode($response);
}
else{
    $response['status'] = 200;
    $response['message'] = 'Invalid request';
}


if(isset($_POST['job_id'])){
    $jid = $_POST['job_id'];
    $data = new ValidateJobDetails();
    $job_row = new Job();
    if(($data->isEmpty()===false) && ($data->validData()===true)){
        $updateQuery = $job_row->updateJob($jid); 
        // echo "<script>alert('Job updated successfully')</script>";
        echo "done";
    }
    else if(($data->isEmpty()===false) && ($data->validData()!==true)){
        $err= array();
        $err = $data->validData();
        echo json_encode($err);
        
    }
    else if(($data->isEmpty()!==false) && ($data->validData()===true)){
        $err = array_merge($data->isEmpty());
        echo json_encode($err);
    }
    else{
        $err = array_merge($data->isEmpty(),$data->validData());
        echo json_encode($err);
    }
        
}



if(isset($_POST['delete_id'])){
    $del_id = $_POST['delete_id'];
    $jobs = new Job();
    $res = $jobs->deleteJob($del_id);
    if(!$res){
        echo json_encode(array('status'=> '200','message'=> 'Invalid Request'));
    }
}






?>