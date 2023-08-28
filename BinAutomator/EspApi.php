<?php
// Database connection details
$host = "localhost";
$username = "root";
$password = "";
$dbName = "";

// Establish database connection
$connection = new mysqli($host, $username, $password, $dbName);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from POST request
    $metal = $_POST['Metal'];
    $organic = $_POST['Organic'];
    $plastic = $_POST['Plastic'];

    // Prepare and execute the INSERT query
    $query = "INSERT INTO `binautomator`(`Metal`, `Organic`, `Plastic`) VALUES (?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("sss", $metal, $organic, $plastic);

    if ($stmt->execute()) {
        $response = array("message" => "Data inserted successfully.");
    } else {
        $response = array("error" => "Error inserting data: " . $stmt->error);
    }

    // Close the prepared statement
    $stmt->close();
} else {
    $response = array("error" => "Invalid request method.");
}

// Close the database connection
$connection->close();

// Set response headers
header("Content-Type: application/json");
echo json_encode($response);
?>
