<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crudtest"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['preferenceId']; 
    $perfname = $_POST['preference[]']; 

    if (!isset($_POST['preference']) || count($_POST['preference']) < 3) {
        die("Please select at least 3 skills.");
    }

    $skills = $_POST['preference'];

    $stmt = $conn->prepare("INSERT INTO tbl_pref_master (preferenceId, preferenceName) VALUES ($user_id, $perfname)");

    foreach ($skills as $skill) {
        $stmt->bind_param("is", $user_id, $skill);
        $stmt->execute();
    }

    echo "Skills saved successfully!";
    $stmt->close();
}

$conn->close();
