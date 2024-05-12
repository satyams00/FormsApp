<?php
include_once("../Connection.php");


class ValidateApplication extends Connection{
    public function __construct($request){
        parent::__construct();
        $this->height= $request['height'];
        $this->highschool_percentage=$request['highschool_percentage'];
        $this->intermediate_percentage=$request['intermediate_percentage'];
        $this->prefered_job_location=$request['prefered_job_location'];
        $this->prefered_exam_center=$request['prefered_exam_center'];
        $this->address=$request['address'];
    }

    public function isValid($job_id){
        

        $sql = "SELECT * FROM `jobs` WHERE id='$job_id'";
        $res = $this->conn->query($sql);
        $job_row = $res->fetch_assoc();
        // print_r($job_row);

        // echo $job_row['minimum_height'];
        $err=[];
        if(empty($this->height)){
            $err['height'] = "Required";
        }
        else if($this->height < $job_row['minimum_height']){
            $err['height'] = "Height should be greater than or equal to ". $job_row['minimum_height'];
        }
        if(empty($this->highschool_percentage)){
            $err['highschool'] = "Required";
        }
        else if($this->highschool_percentage < $job_row['minimum_highschool_percentage']){
            $err['highschool'] = "Percentage should be greater than or equal to ". $job_row['minimum_highschool_percentage'];
        }
        if(empty($this->intermediate_percentage)){
            $err['intermediate'] = "Required";
        }
        else if($this->intermediate_percentage< $job_row['minimum_intermediate_percentage'] ){
            $err['intermediate'] = "Percentage should be greater than or equal to ". $job_row['minimum_intermediate_percentage'];
        }
        
        if(empty($this->prefered_job_location)){
            $err['job_location'] = "Required";
        }
        if(empty($this->prefered_exam_center)){
            $err['exam_center'] = "Required";
        }
        if(empty($this->address)){
            $err['address'] = "Required";
        }
        return count($err)==0?true:$err;
    }

    public function Age($user_id){
        $sql = "SELECT * FROM `users` WHERE id='$user_id'";
        $res =$this->conn->query($sql);
        $row = $res->fetch_assoc();
        $year=$row['dob'];
        $year = date_create($year);
        $year = date_format($year,"Y");
        $age = date("Y")-$year;

        return $age;
    }

    
}










?>