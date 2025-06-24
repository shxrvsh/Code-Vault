<?php
    if(isset($_COOKIE['myservername']) && isset($_COOKIE['myusername']) && isset($_COOKIE['username']) && isset($_COOKIE['password']) ){
        $myservername = $_COOKIE['myservername'];
        $myusername = $_COOKIE['myusername'];
        $mypassword = $_COOKIE['mypassword'];
        $mydb = $_COOKIE['mydb'];
        $username = $_COOKIE['username'];
        $user_id = $_COOKIE['user_id'];
        
        
        $conn = new mysqli($myservername, $myusername, $mypassword, $mydb);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT repo_id FROM repositories ORDER BY repo_id DESC LIMIT 1;";
        $result=$conn->query($sql);
        if($result->num_rows > 0){
            $row=$result->fetch_assoc();
            $repo_id=(int)$row["repo_id"];
            $repo_id=$repo_id+1;
            $repo_id=(string)$repo_id;  
        }
        else{
            $repo_id=101;
        }

        $repo_name=$_GET['repo_name'];
        $repo_code='//write your code here';
        $repo_url= 'url';

        $sql = "INSERT into repositories values($repo_id,\"$repo_name\",\"$repo_url\",$user_id,\"$repo_code\")";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
        echo "Error updating record: " . $conn->error;
        }
        
    } else {
        // Cookies not set or expired
        echo "Cookies not set or expired.";
    }
?>