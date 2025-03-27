<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "crudtest";


$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
  die('Sorry we failed connect:' . mysqli_connect_error());
}

if (isset($_GET['delete'])) {
  $sno = $_GET['delete'];
  $sql = "DELETE FROM `tbl_user` WHERE `tbl_user`.`user_Id` = $sno";
  $result = mysqli_query($conn, $sql);

  echo "<script>
     alert('we delete the record successfully')
      window.location.href='listing.php'
  </script>";
}
