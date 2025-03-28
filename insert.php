<?php
// include "update.php";
// session_start();


require_once "dbconnect.php";


function sanitizeInput($data)
{
  return htmlspecialchars(strip_tags(trim($data)));
}


function hashPassword($password)
{
  return password_hash($password, PASSWORD_DEFAULT);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name = sanitizeInput($_POST['username']);
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  $email = sanitizeInput($_POST['email']);
  $image = $_FILES['file']['tmp_name'];
  $imagename = $_FILES['file']['name'];
  $preferenceIds = isset($_POST['preferenceName']) ? $_POST['preferenceName'] : [];


  if (count($preferenceIds) < 3) {
    echo "<script>
                alert('You must select at least 3 preferences.');
                window.location.href='add.php';
              </script>";
    exit();
  }


  if (!empty($imagename)) {
    $destfill = 'photos/' . $imagename;
    move_uploaded_file($image, $destfill);
  } else {
    $destfill = null; 
  }

  if ($password !== $cpassword) {
    echo "<script>
                alert('Passwords do not match!');
                window.location.href='add.php';
              </script>";
    exit();
  }

  
  $hash = hashPassword($password);


  $sql = "INSERT INTO tbl_user (userName, password,confirm_password, emailAddress, profile_image) 
            VALUES (?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);

  if (!$stmt) {
    die("SQL Error: " . $conn->error);
  }

 $stmt->bind_param("sssss", $name, $hash, $hash, $email, $destfill); 


  if ($stmt->execute()) {
    $userId = $stmt->insert_id; 

  
    $sqlPref = "INSERT INTO tbl_preferences (userId, preferenceId) VALUES (?, ?)";
    $stmtPref = $conn->prepare($sqlPref);

    if (!$stmtPref) {
      die("Preference SQL Error: " . $conn->error);
    }

    foreach ($preferenceIds as $preferenceId) {
      $stmtPref->bind_param("ii", $userId, $preferenceId);
      $stmtPref->execute();
    }

    echo "<script>
                alert('record added successfully!');
                window.location.href='add.php';
              </script>";

    $stmtPref->close();
  } else {
    echo "<script>
                alert('Failed to add record');
                window.location.href='add.php';
              </script>";
  }

  $stmt->close();
  $conn->close();
}
