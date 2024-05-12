<?php
include_once("../Connection.php");
error_reporting(0);


class Job extends Connection{
    protected $title, $post, $start_date, $end_date, $min_age, $max_age, $min_height, $job_location, $exam_center, $min_10, $min_12, $exam_date, $JD;
     public function __construct(){
        parent::__construct();
        $this->title = $_REQUEST['title'];
        $this->post = $_REQUEST['post'];
        $this->start_date = $_REQUEST['start_date'];
        $this->end_date = $_REQUEST['end_date'];
        $this->min_age = $_REQUEST['min_age'];
        $this->max_age = $_REQUEST['max_age'];
        $this->min_height = $_REQUEST['min_height'];
        $this->job_location = $_REQUEST['Job_location'];
        $this->exam_center = $_REQUEST['exam_center'];
        $this->min_10 = $_REQUEST['min_10'];
        $this->min_12 = $_REQUEST['min_12'];
        $this->exam_date = $_REQUEST['exam_date'];
        $this->JD = $_REQUEST['JD'];
        
    }


    public function createJob(){

        $sql = "INSERT INTO `jobs`(title, post, registration_start, registration_end, minimum_age, maximum_age, minimum_height, job_location, exam_center, exam_date, minimum_highschool_percentage, minimum_intermediate_percentage, job_description) VALUES ('$this->title','$this->post','$this->start_date','$this->end_date','$this->min_age','$this->max_age','$this->min_height','$this->job_location','$this->exam_center','$this->exam_date','$this->min_10','$this->min_12','$this->JD')";
        
        return $this->conn->query($sql);
    }

    public function viewJobs(){
        $sql = "SELECT j.*,a.user_id,count(a.id) as jobCount FROM `jobs` j Left Join `applications` a on j.id=a.job_id group by id";
        $res = $this->conn->query($sql);
        return $res;
    }

    public function selectJob($jid){
        $sql = "SELECT * FROM `jobs` WHERE id='$jid'";
        $res = $this->conn->query($sql);
        return $res;
    }

    public function selectAllJobs(){
        $sql = "SELECT * FROM `jobs`";
        return $this->conn->query($sql);
        
    }
    public function alreadyApplied($uid){
        $sql2 = "SELECT job_id FROM `applications` WHERE user_id='$uid'";
        $res2 = $this->conn->query($sql2);
        $job_ids=[];
        while($row = $res2->fetch_assoc()){
            array_push($job_ids,$row['job_id']);
        }
        return $job_ids;
    }

    public function deleteJob($uid){
        $sql = "DELETE from `jobs` WHERE id='$uid'";
        $res = $this->conn->query($sql);
        return $res;
    }

    public function updateJob($jobid){
        $sql = "UPDATE `jobs` SET title='$this->title',post='$this->post',registration_start='$this->start_date',registration_end='$this->end_date',minimum_age='$this->min_age',maximum_age='$this->max_age',minimum_height='$this->min_height',job_location='$this->job_location',exam_center='$this->exam_center',exam_date='$this->exam_date',minimum_highschool_percentage='$this->min_10',minimum_intermediate_percentage='$this->min_12',job_description='$this->JD' WHERE id = '$jobid'";
        $res = $this->conn->query($sql);
        return $res;
    }


    public function getAppliedUsers($job_id){
        $sql = "SELECT * FROM `jobs` j INNER JOIN `applications` a on j.id=a.job_id
        INNER JOIN `users` u on a.user_id=u.id where a.job_id='$job_id'";
        return $this->conn->query($sql);
    }

    public function getAppliedJob($user_id){
        $sql = "SELECT * FROM `applications` a INNER JOIN `jobs` j ON a.job_id=j.id WHERE user_id='$user_id'";
        return $this->conn->query($sql);
    }

    public function getApplicationDetails($user_id,$job_id){
        $sql = "SELECT * FROM `applications` WHERE user_id='$user_id' AND job_id='$job_id'";
        return $this->conn->query($sql);
    }

    

}







?>