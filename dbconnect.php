<?php
// connect database

$servername = "localhost";
$username = "root";
$password = "";
$database = "crudtest";


$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die('connection Failed' . mysqli_connect_error());
}

?>