<?php
if(isset($_COOKIE['myservername']) && isset($_COOKIE['myusername']) && isset($_COOKIE['username']) && isset($_COOKIE['password']) && isset($_COOKIE['repo_id']) ){
    $myservername = $_COOKIE['myservername'];
    $myusername = $_COOKIE['myusername'];
    $mypassword = $_COOKIE['mypassword'];
    $mydb = $_COOKIE['mydb'];
    $username = $_COOKIE['username'];
    $user_id = $_COOKIE['user_id'];
    
    $conn = new mysqli($myservername, $myusername, $mypassword, $mydb);
    $commit_id=$_COOKIE["commit_id"];
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $status="reject";
    $sql = "UPDATE reviews set status=\"$status\" where commit_id=\"$commit_id\"";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        //header('Set-Cookie: ' . "repo_id" . '=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/');
        //header("Location: git-hub-rep.html");
    }
    header("Location: git-hub-pull.html");
} else {
    // Cookies not set or expired
    echo "Cookies not set or expired.";
}
?>