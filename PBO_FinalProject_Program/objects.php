<?php
    function conn(){
        $server = "localhost";
        $user = "root";
        $password = "";
        $dbname = "pbo_db";
        $conn = mysqli_connect($server,$user,$password, $dbname);
        return $conn;
    }

    class User{
        var $username;
        var $name;
        var $password;
        var $email;
        var $institution;

        var $posted_jobs = array();

        function __construct($par1="",$par2="",$par3="",$par4="",$par5=""){
            $this->username = $par1;
            $this->name = $par2;
            $this->password = $par3;
            $this->email = $par4;
            $this->institution = $par5;

        }

        function fetchUser($un, $pass){
            $conn = conn();
            $this->getAllPostedJobs();
            $sql = "SELECT * FROM userr where username = '$un'";
            if($result = mysqli_query($conn,$sql) ){
                $row = $result->fetch_assoc();
                if( $pass == $row['password']){
                    $this->username = $row['username'];
                    $this->name = $row['name'];
                    $this->password = $row['password'];
                    $this->email = $row['email'];
                    $this->institution = $row['institution'];
                    return true;
                }
                
            }
            return false; 
        }

        function createUser(){
            $conn = conn();
            $sql = "SELECT * FROM userr where username = '$this->username'";
            if(mysqli_query($conn,$sql)->num_rows > 0) return false;
            
            $sql = "INSERT INTO userr VALUES ('$this->username','$this->name', '$this->password','$this->email','$this->institution')";
            if(mysqli_query($conn, $sql)) return true;
        }

        function editUser($edited){
            $conn = conn();
            $this->name = $edited->name;
            $this->password = $edited->password;
            $this->email = $edited->email;
            $this->institution = $edited->institution;
            $sql = "UPDATE userr SET name = '$this->name', password = '$this->password', email = '$this->email', institution = '$this->institution' WHERE username='$this->username'";
            if(mysqli_query($conn, $sql)) return true;
            return false;
        }

        function deleteUser(){
            $conn = conn();
            $sql = "DELETE FROM userr where username ='$this->username'";
            if(mysqli_query($conn,$sql)) return true;
            return false;
        }

        function createJob(&$job){
            $conn =conn();
            $sql = "INSERT INTO job VALUES ('id','$job->category','$job->description','$job->budget','$job->user_id','')";
            if(mysqli_query($conn, $sql)) {
                $this->getAllPostedJobs();
                return true;
            }
            return false;
        }

        function deleteJob($id){
            $conn = conn();
            $sql = "DELETE FROM job where id ='$id'";
            if(mysqli_query($conn,$sql)) {
                $this->getAllPostedJobs();
                return true;
            }
            return false;
        }

        function getAllPostedJobs(){
            $conn = conn();
            $sql = "SELECT * FROM job where user_id = '$this->username'";
            if($result = mysqli_query($conn,$sql)) {
                for($i = 0; $row = $result->fetch_assoc(); $i++){
                    $posted_jobs[$i] = new Job($row['id'], $row['category'],$row['desc'], $row['budget'], $row['user_id'],$row['fl_id']);
                }
            }
        }
        function getAllJobs(){
            $conn = conn();
            $arr=array();
            $sql = "SELECT * FROM job";
            if($result = mysqli_query($conn,$sql)) {
                for($i = 0; $row = $result->fetch_assoc(); $i++){
                    $arr[$i] = new Job($row['id'], $row['category'],$row['desc'], $row['budget'], $row['user_id'],$row['fl_id']);
                }
            }
            return $arr;
        }
    }

    class Job{
        var $id;
        var $category;
        var $description;
        var $budget;
        var $user_id;
        var $fl_id;

        function __construct($par1,$par2,$par3,$par4,$par5,$par6){
            $this->id = $par1;
            $this->category = $par2;
            $this->description = $par3;
            $this->budget = $par4;
            $this->user_id = $par5;
            $this->fl_id = $par6;
        }
    }

    class Freelancer{
        var $username;
        var $name;
        var $password;
        var $email;
        var $experience;
        var $taken_jobs = array();

        function __construct($par1="",$par2="",$par3="",$par4="",$par5=""){
            $this->username = $par1;
            $this->name = $par2;
            $this->password = $par3;
            $this->email = $par4;
            $this->experience = $par5;
        }

        function fetchFL($un, $pass){
            $conn = conn();
            $this->getAllTakenJobs();
            $sql = "SELECT * FROM freelancer where username = '$un'";
            if($result = mysqli_query($conn,$sql) ){
                $row = $result->fetch_assoc();
                if( $pass == $row['password']){
                    $this->username = $row['username'];
                    $this->name = $row['name'];
                    $this->password = $row['password'];
                    $this->email = $row['email'];
                    $this->experience = $row['experience'];
                    return true;
                }
                
            }
            return false; 
        }

        function createFL(){
            $conn = conn();
            $sql = "SELECT * FROM freelancer where username = '$this->username'";
            if(mysqli_query($conn,$sql)->num_rows > 0) return false;
            
            $sql = "INSERT INTO freelancer VALUES ('$this->username','$this->name', '$this->password','$this->email','$this->experience')";
            if(mysqli_query($conn, $sql)) return true;
        }

        function editFL($edited){
            $conn = conn();
            $this->name = $edited->name;
            $this->password = $edited->password;
            $this->email = $edited->email;
            $this->experience = $edited->experience;
            $sql = "UPDATE freelancer SET name = '$this->name', password = '$this->password', email = '$this->email', experience = '$this->experience' WHERE username='$this->username'";
            if(mysqli_query($conn, $sql)) return true;
            return false;
        }

        function deleteFL(){
            $conn = conn();
            $sql = "DELETE FROM freelancer where username ='$this->username'";
            if(mysqli_query($conn,$sql)) return true;
            return false;
        }

        function takeJob($id){
            $conn =conn();
            $sql = "UPDATE job SET fl_id = '$this->username' where id = '$id'";
            if(mysqli_query($conn, $sql)) {
                $this->getAllTakenJobs();
                return true;
            }
            return false;
        }

        function releaseJob($id){
            $conn = conn();
            $sql = "UPDATE job SET fl_id = '' where id = '$id'";
            if(mysqli_query($conn,$sql)) {
                $this->getAllTakenJobs();
                return true;
            }
            return false;
        }

        private function getAllTakenJobs(){
            $conn = conn();
            $sql = "SELECT * FROM job where fl_id = '$this->username'";
            if($result = mysqli_query($conn,$sql)) {
                for($i = 0; $row = $result->fetch_assoc(); $i++){
                    $taken_jobs[$i] = new Job($row['id'], $row['category'],$row['desc'], $row['budget'], $row['user_id'],$row['fl_id']);
                }
            }
        }
        function getAllJobs(){
            $conn = conn();
            $arr=array();
            $sql = "SELECT * FROM job";
            if($result = mysqli_query($conn,$sql)) {
                for($i = 0; $row = $result->fetch_assoc(); $i++){
                    $arr[$i] = new Job($row['id'], $row['category'],$row['desc'], $row['budget'], $row['user_id'],$row['fl_id']);
                }
            }
            return $arr;
        }
    }
?>