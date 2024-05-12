<?php

class UserValidation{
    public function __construct($REQUEST){
        $this->fname = trim($REQUEST['firstname']);
        $this->mname = trim($REQUEST['middlename']);
        $this->lname = trim($REQUEST['lastname']);
        $this->email = trim($REQUEST['email']);
        $this->phone = trim($REQUEST['phone']);
        $this->gender = $REQUEST['gender'];
        $this->dob = $REQUEST['dob'];
        $this->pass = $REQUEST['password'];

    }
    public $req=[];
    public $err=[];
    public $userDetails=[];
    public function isEmpty(){
        if(empty(($this->fname))){
            $this->req['fname'] = 'required';
        }
        if(empty(($this->lname))){
            $this->req['lname'] = 'required';
        }
        if(empty(($this->email))){
            $this->req['email'] = 'required';
        }
        if(empty(($this->phone))){
            $this->req['phone'] = 'required';
        }
        if(empty(($this->gender))){
            $this->req['gender'] = 'required';
        }
        if(empty(($this->dob))){
            $this->req['dob'] = 'required';
        }
        if(empty(($this->pass))){
            $this->req['password'] = 'required';
        }
        return count($this->req)==0?false:$this->req;
    }

    public function check(){
        if(!preg_match('/\b^[a-z]+$/i',$this->fname)){
            $this->err['fname'] = "Enter valid first name";
        }
        if(!preg_match('/\b^[a-z]+$/i',$this->mname)){
            $this->err['mname'] = "Enter valid middle name";
        }
        if(!preg_match('/\b^[a-z]+$/i',$this->lname)){
            $this->err['lname'] = "Enter valid last name";
        }
        if(!filter_var($this->email,FILTER_VALIDATE_EMAIL)){
            $this->err['email'] = "Enter valid email address";
        }
        if(!preg_match('/\b(0|91)?[6-9]{1}[0-9]{9}$/', $this->phone)) {
            $this->err['phone'] = "Enter valid phone number";
        }
        $dateDiff = date_diff(date_create($this->dob), date_create(date('Y-m-d')));
        if($dateDiff->format('%R%a') < 0){
            $this->err['dob'] = "Enter valid Date of Birth";
        }
        return count($this->err)==0 ? false : $this->err;
    }

    public function getUserDetails(){
        if(count($this->req)==0 && count($this->err)==0){
            $this->userDetails['firstname'] = $this->fname;
            $this->userDetails['middlename'] = $this->mname;
            $this->userDetails['lastname'] = $this->lname;
            $this->userDetails['phone'] = $this->phone;
            $this->userDetails['email'] = $this->email;
            $this->userDetails['gender'] = $this->gender;
            $this->userDetails['dob'] = $this->dob;
            $this->userDetails['password'] = $this->pass;
        }
        return $this->userDetails;
    } 


    public function checkProfilePhoto($img){
        $target_dir = '../img/';
        $target_file = $target_dir.basename($img['profileImg']['name']);
        $img_extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($img['profileImg']['tmp_name']);
        if($check !== false){
            if(file_exists($target_file)){
                return "<script>alert('Sorry, File is already present....')</script>";
            }
            
            if($img['profileImg']['size'] > 500000){
                return "<script>alert('File is too big')</script>";
            }
            
            if($img_extension != 'jpg' && $img_extension != 'png' && $img_extension != 'jpeg'){
                return "<script>alert('Only jpg,jpeg and png are allowed')</script>";
            }
            
            
            if(move_uploaded_file( $img['profileImg']['tmp_name'], $target_file)){
                // return $img['profileImg']['name'];
                return true;
            }
            else{
                // return $this->err['photo'];
                return "<script>alert('Image is not uploaded')</script>";
                // return false;
            }
        }
        else{
            return "<script>alert('File is not image.')</script>";
            // return false;
        }
    }




}





?>