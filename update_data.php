<?php
// include "update.php";
// session_start();


include "dbconnect.php";

  $hash = password_hash($password, PASSWORD_DEFAULT);

if (isset($_GET['user_Id'])) {
  $sql = "SELECT * FROM  `tbl_user` WHERE `user_id` = ".$_GET['user_Id'];
  //$stmt = $conn->prepare($sql);

  $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    $name = $row['userName'];
    $password = $row['password'];
    $cpassword = $row['confirm_password'];
    $email = $row['emailAddress'];
    $file = $row['profile_image'];
    
  }

  // if (isset($_GET['user_Id'])) {
  //   $sqlpref = "SELECT * FROM `tbl_preferences` WHERE `userId`=".$_GET['user_Id'];
  //   $resultpref = mysqli_query($conn, $sqlpref);
  //   $row = mysqli_fetch_assoc($resultpref);

  //   $pref = $row['preferenceId'];

  // }
  


if (isset($_POST['user_Id'])) {
$user_Id = $_POST['user_Id'];
  $name = ($_POST['name']);
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  $email =($_POST['email']);
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




  $sql = "UPDATE `tbl_user` SET `userName` = '$name',  `password`= '$password', `confirm_password` = '$cpassword', `emailAddress` = '$email', `profile_image`='$destfill' WHERE `tbl_user`.`user_id` = $user_Id";
  $stmt = $conn->prepare($sql);

  if (!$stmt) {
    die("SQL Error: " . $conn->error);
  }
  else{
    echo "success";
  }

 $stmt->bind_param("sssss", $name, $hash, $hash, $email, $destfill); 


  if ($stmt->execute()) {
    $userId = $stmt->insert_id; 

  
    $sqlPref = "UPDATE tbl_preferences SET `userId'='', `preferenceId`='$preferenceIds' 
    WHERE `preid`=$user_Id";
    $stmtPref = $conn->prepare($sqlPref);

    if (!$stmtPref) {
      die("Preference SQL Error: " . $conn->error);
    }else{
      echo "success";
    }

    foreach ($preferenceIds as $preferenceId) {
      $stmtPref->bind_param("ii", $userId, $preferenceId);
      $stmtPref->execute();
    }

    echo "<script>
                alert('record update successfully!');
                window.location.href='update.php';
              </script>";

    $stmtPref->close();
  } else {
    echo "<script>
                alert('Failed to update record');
                window.location.href='update.php';
              </script>";
  }

  $stmt->close();
  $conn->close();
}

?>
