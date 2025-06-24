<?php
// Assuming your database credentials
$servername = "localhost";
$username = "root";
$password = "19122004";
$dbname = "git";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get username and password from the form
$user = $_POST['username'];
$pass = $_POST['password'];

// SQL query to check if the username and password exist in the database
$sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
$result = $conn->query($sql);

// Check if the query returned any rows
if ($result->num_rows > 0) {
    // Redirect to the next page
    while($row = $result->fetch_assoc()) {
        $user_id = $row["user_id"];
    }
    setcookie('user_id', $user_id, time() + (86400 * 30), "/"); // 86400 = 1 day
    setcookie('username', $user, time() + (86400 * 30), "/"); // 86400 = 1 day
    setcookie('myservername', $servername, time() + (86400 * 30), "/"); // 86400 = 1 day
    setcookie('myusername', $username, time() + (86400 * 30), "/"); // 86400 = 1 day
    setcookie('mypassword', $password, time() + (86400 * 30), "/"); // 86400 = 1 day
    setcookie('mydb', $dbname, time() + (86400 * 30), "/"); // 86400 = 1 day
    setcookie('password', $pass, time() + (86400 * 30), "/"); // 86400 = 1 day
    header("Location: git-hub-rep.html");
    exit();
} else {
    echo "Invalid username or password";
}

$conn->close();
?>
