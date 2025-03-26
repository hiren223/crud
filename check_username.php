<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "crudtest";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Database Connection failed: " . $conn->connect_error);
}


if (isset($_POST['username'])) {
    $username = trim($_POST['username']);

    $sql = "SELECT * FROM tbl_user WHERE BINARY username = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("SQL Error: " . $conn->error); 
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        die("Query execution failed: " . $stmt->error); 
    }

    if ($result->num_rows > 0) {
        echo "<span style='color:green;'>Username is available</span>";
    } else {
        echo "<span style='color:red;'>Username is not available</span>";
    }

    $stmt->close();
}

$conn->close();
