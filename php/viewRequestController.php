<?php
include_once("../Application/application.php");

$application = new Application();
$res = $application->getApplicationDetail();

// extract($_POST);

if(isset($_POST["res"])){

    $data = "<thead class='table-active'>
        <th>S. No.</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Gender</th>
        <th>DOB</th>
        <th>High School Percentage</th>
        <th>Intermediate Percentage</th>
        <th>Height</th>
        <th>Address</th>
        <th>Title</th>
        <th>Post</th>
        <th>Accept</th>
        <th>Reject</th>
        </thead>
        <tbody>";

    if($res->num_rows > 0){
        $cnt =1;
        while($row = $res->fetch_assoc()){
            $data .= "
            <tr>
            <td>". $cnt++ ."</td>
            <td>". $row['firstname'].' '.$row['middlename'].' '.$row['lastname'] ."</td>
            <td>". $row['email'] ."</td>
            <td>". $row['phone'] ."</td>
            <td>". $row['gender'] ."</td>
            <td>". $row['dob'] ."</td>
            <td>". $row['highschool_percentage'] ."</td>
            <td>". $row['intermediate_percentage'] ."</td>
            <td>". $row['height'] ."</td>
            <td>". $row['address'] ."</td>
            <td>". $row['title'] ."</td>
            <td>". $row['post'] ."</td>
            <td><input type='submit' class='btn btn-success' name='accept' onclick='acceptRequest(". $row['id']. ",". $row['user_id']. ");' value='Accept'> </td>
            <td><input type='submit' class='btn btn-danger' name='reject' onclick='rejectRequest(". $row['id']. ",". $row['user_id']. ");' value='Reject'></td>
            
        </tr>
            ";
        } 
    }
    $data .= "</tbody>";
    echo $data;
}


if(isset( $_POST["accept"])){
    $user_id = $_POST['uid'];
    $job_id = $_POST['jid'];
    $application->acceptApplication($user_id, $job_id);
}
if(isset( $_POST["reject"])){
    $user_id = $_POST['uid'];
    $job_id = $_POST['jid'];
    $application->rejectApplication($user_id, $job_id);
}




?>