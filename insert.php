<?php
include "skill.php";
include "dbconnect.php";

if (isset($_POST['Submit'])) {
  $name = $_POST['username'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  $email = $_POST['email'];
  $image = $_FILES['file']['tmp_name'];
  $imagename = $_FILES['file']['name'];
  $preferenceName = $_POST['preferenceName'];

  $destfill = 'photos/'.$imagename;
  move_uploaded_file($image, $destfill);

  if ($password !== $cpassword) {
    echo "<script>
            alert('Passwords do not match!');
            window.location.href='add.php';
        </script>";
    exit(); 
  }


  $hash = password_hash($password, PASSWORD_DEFAULT);

  $sql = "INSERT INTO `tbl_user` (`userName`, `password`, `confirm_password`, `emailAddress`, `profile_image`) 
            VALUES ('$name', '$hash', '$hash', '$email', '$destfill')";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    echo "<script>
            alert('Your note has been added');
            window.location.href='add.php';
        </script>";
  } else {
    echo "<script>
            alert('Your note has not been added');
            window.location.href='add.php';
        </script>";
  }
}
?>

