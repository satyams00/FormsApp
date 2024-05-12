<?php
include_once("../Connection.php");


class Application extends Connection{
    protected $height,$highschool_percentage,$intermediate_percentage,$prefered_job_location,$prefered_exam_center,$address,$user_id,$job_id;
    public function __construct(){
        parent::__construct();
    }
    public function setData($request,$user_id,$job_id){
        $this->height= $request['height'];
        $this->highschool_percentage=$request['highschool_percentage'];
        $this->intermediate_percentage=$request['intermediate_percentage'];
        $this->prefered_job_location=$request['prefered_job_location'];
        $this->prefered_exam_center=$request['prefered_exam_center'];
        $this->address=$request['address'];
        $this->user_id=$user_id;
        $this->job_id=$job_id;
    }

    public function insertData(){
        
        $sql = "INSERT INTO `applications`(`user_id`, `job_id`, `highschool_percentage`, `intermediate_percentage`, `address`, `height`, `prefered_job_location`, `prefered_exam_center`) VALUES ('$this->user_id','$this->job_id','$this->highschool_percentage','$this->intermediate_percentage','$this->address','$this->height','$this->prefered_job_location','$this->prefered_exam_center')";
        
        return $this->conn->query($sql);
    }

    public function updateData($uid,$jid){
        $sql = "UPDATE `applications` SET `highschool_percentage`='$this->highschool_percentage',`intermediate_percentage`='$this->intermediate_percentage',`address`='$this->address',`height`='$this->height',`prefered_job_location`='$this->prefered_job_location',`prefered_exam_center`='$this->prefered_exam_center' WHERE user_id = '$uid' AND job_id='$jid'";
        
        return $this->conn->query($sql);
    }

    public function getApplicationDetail(){
        $sql = "SELECT * FROM `applications` a INNER JOIN `users` u on u.id=a.user_id INNER JOIN `jobs` j on a.job_id=j.id WHERE a.status='Pending'";
        return $this->conn->query($sql);
    }

    public function acceptApplication($user_id,$job_id){
        $sql = "UPDATE `applications` SET status='Accepted' WHERE user_id='$user_id' AND job_id='$job_id'";
        return $this->conn->query($sql);
    }
    public function rejectApplication($user_id,$job_id){
        $sql = "UPDATE `applications` SET status='Rejected' WHERE user_id='$user_id' AND job_id='$job_id'";
        return $this->conn->query($sql);
    }

    public function checkJob($user_id,$job_id){
        $sql = "SELECT * from `applications` where user_id='$user_id' AND job_id='$job_id'";
        return $this->conn->query($sql);
    }

}



?>