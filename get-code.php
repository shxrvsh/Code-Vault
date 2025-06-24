<?php
     if(isset($_COOKIE['myservername']) && isset($_COOKIE['myusername']) && isset($_COOKIE['username']) && isset($_COOKIE['password']) && isset($_COOKIE['repo_id']) ){
        $myservername = $_COOKIE['myservername'];
        $myusername = $_COOKIE['myusername'];
        $mypassword = $_COOKIE['mypassword'];
        $mydb = $_COOKIE['mydb'];
        $username = $_COOKIE['username'];
        $user_id = $_COOKIE['user_id'];
        $repo_id = $_COOKIE['repo_id'];
        
        $conn = new mysqli($myservername, $myusername, $mypassword, $mydb);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM repositories WHERE  repo_id ='$repo_id'";
        $result = $conn->query($sql);

        // Check if the query returned any rows
        $data=[];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $repo_code = $row["code"];
                $row_data = array('repo_code' => $repo_code);
                $data[]=$row_data;
            }
            echo json_encode($data);
        } else {
            echo "Invalid username or password";
        }
    } else {
        // Cookies not set or expired
        echo "Cookies not set or expired.";
    }
?>