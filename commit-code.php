<?php
    if(isset($_COOKIE['myservername']) && isset($_COOKIE['myusername']) && isset($_COOKIE['username']) && isset($_COOKIE['password']) && isset($_COOKIE['repo_id']) ){
        $myservername = $_COOKIE['myservername'];
        $myusername = $_COOKIE['myusername'];
        $mypassword = $_COOKIE['mypassword'];
        $mydb = $_COOKIE['mydb'];
        $username = $_COOKIE['username'];
        $user_id = $_COOKIE['user_id'];
        $repo_id = $_COOKIE['repo_id'];
        $repo_code= $_POST['repo_code'];
        
        $conn = new mysqli($myservername, $myusername, $mypassword, $mydb);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT commit_id FROM commits ORDER BY commit_id DESC LIMIT 1;";
        $result=$conn->query($sql);
        if($result->num_rows > 0){
            $row=$result->fetch_assoc();
            $commit_id=(int)$row["commit_id"];
            $commit_id=$commit_id+1;
            $commit_id=(string)$commit_id;  
        }
        else{
            $commit_id=101;
        }

        $review_id=$commit_id;
        $status= "";
        $comments="";
        $sql = "SELECT user_id FROM repositories where repo_id=$repo_id;";
        $result=$conn->query($sql);
        if($result->num_rows > 0){
            $row=$result->fetch_assoc();
            $owner_id=$row["user_id"]; 
        }
        else{
            //
        }

        $branch_name="null";
        $updated_code=$_POST["code"];
        $timestamp = date('Y-m-d H:i:s'); // Replace with your desired format
        $sql = "INSERT  into commits values($commit_id,$repo_id,$user_id,\"$branch_name\",\"$timestamp\",\"$repo_code\")";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
            //header('Set-Cookie: ' . "repo_id" . '=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/');
            header("Location: git-hub-rep.html");
        }
        else {
            
            
        }

        if($owner_id==$user_id){
            $sql = "UPDATE repositories set code=\"$repo_code\" where repo_id=$repo_id and user_id=$user_id";
            if ($conn->query($sql) === TRUE) {
                //echo "Record updated successfully";
                //header('Set-Cookie: ' . "repo_id" . '=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/');
                //header("Location: git-hub-rep.html");
            }
            $status="complete";
            $sql = "INSERT into reviews values(\"$review_id\",\"$commit_id\",\"$owner_id\",\"$status\",\"$comments\")";
            if ($conn->query($sql) === TRUE) {
                //echo "Record updated successfully";
                //header('Set-Cookie: ' . "repo_id" . '=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/');
                //header("Location: git-hub-rep.html");
            }
        }
        else{
            $status="pending";
            $sql = "INSERT into reviews values(\"$review_id\",\"$commit_id\",\"$owner_id\",\"$status\",\"$comments\")";
            if ($conn->query($sql) === TRUE) {
                //echo "Record updated successfully";
                //header('Set-Cookie: ' . "repo_id" . '=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/');
                //header("Location: git-hub-rep.html");
            }
        }
        
        
    } else {
        // Cookies not set or expired
        echo "Cookies not set or expired.";
    }
?>