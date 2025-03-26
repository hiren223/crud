<?php 

include "dbconnect.php";


if (isset($_POST['Submit'])) {
    // update quiry
    $name = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $file = $_POST['file'];
  $image = $_FILES['file']['tmp_name'];
  $imagename = $_FILES['file']['name'];

  // $preference= $_POST['preference'];

  $sql = "UPDATE `tbl_user` SET `userName` = '$name', `password` = '$password', `confirm_password`= '$password', `email`='$email', `profile_image`= '$imagename' WHERE `tbl_user`.`userName` = $name";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>
     alert('we updated the record successfully')
      window.location.href='add.php'
    </script>";
    } else {
        echo "<script>
     alert('we could not update.d the record successfully')
      window.location.href='add.php'
    </script>";
    }
}


?>


