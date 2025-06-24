<?php
    if(isset($_COOKIE['username'])) {
        $username = $_COOKIE['username'];
        $data = array('username' => $username);
        header('Content-Type: application/json');
        echo json_encode($data);
        // Now you can use $username and $password as needed
    } else {
        // Cookies not set or expired
        echo "Cookies not set or expired.";
    }

    /*$value1 = "Hello";
    $value2 = "World";
    $data = array("value1" => $value1, "value2" => $value2);
    echo json_encode($data);*/
// Check if the request method is GET
/*if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve values from the request (if needed)
    // Process the values (if needed)
    $result1 = "Processed value for param1"; // Example processing
    $result2 = "Processed value for param2"; // Example processing

    // Prepare the response
    $response = array(
        'result1' => $result1,
        'result2' => $result2
    );

    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Return an error response if the request method is not GET
    http_response_code(405); // Method Not Allowed
    echo "Method Not Allowed";
}*/


    
?>