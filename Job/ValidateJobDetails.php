<?php

class ValidateJobDetails extends Job{

    protected $empty;
    protected $error;

    public function __construct(){
        parent::__construct();
        $this->empty = [];
        $this->error = [];
    }
    public function isEmpty(){
        if(empty(($this->title))){
            $this->empty['title']="Required";
        }
        if(empty(($this->post))){
            $this->empty['post']="Required";
        }
        if(empty(($this->start_date))){
            $this->empty['start_date']="Required";
        }
        if(empty(($this->end_date))){
            $this->empty['end_date']="Required";
        }
        if(empty(($this->min_age))){
            $this->empty['min_age']="Required";
        }
        if(empty(($this->max_age))){
            $this->empty['max_age']="Required";
        }
        if(empty(($this->min_height))){
            $this->empty['min_height']="Required";
        }
        if(empty(($this->job_location))){
            $this->empty['job_location']="Required";
        }
        if(empty(($this->exam_center))){
            $this->empty['exam_center']="Required";
        }
        if(empty(($this->min_10))){
            $this->empty['min_10']="Required";
        }
        if(empty(($this->min_12))){
            $this->empty['min_12']="Required";
        }
        if(empty(($this->exam_date))){
            $this->empty['exam_date']="Required";
        }
        if(empty(($this->JD))){
            $this->empty['JD']="Required";
        }
        return count($this->empty)==0?false:$this->empty;
    }


    public function validData(){
        $startdateDiff = date_diff(date_create(date('Y-m-d')),date_create($this->start_date));
        if($startdateDiff->format('%R%a') < 0){
            $this->error['start_date'] = "Invalid date";
        }
        $enddateDiff = date_diff(date_create($this->start_date),date_create($this->end_date));
        if($enddateDiff->format('%R%a') < 0){
            $this->error['end_date'] = "Invalid date";
        }
        $examdateDiff = date_diff(date_create($this->end_date),date_create($this->exam_date));
        if(($examdateDiff->format('%R%a') < 0)){
            $this->error['exam_date'] = "Invalid date";
        }
        if(!is_numeric($this->min_age)){
            $this->error['min_age'] = "Age should be in integer";
        }
        
        if(!is_numeric($this->max_age)){
            $this->error['max_age'] = "Age should be in integer";
        }

        if($this->max_age < $this->min_age){
            $this->error['max_age'] = "Maximum age should be greater than minimum age";
        }

        if(!is_numeric($this->min_height)){
            $this->error['min_height'] = "Age should be in integer";
        }
        return count($this->error)==0?true:$this->error;
    }

}








?>