<?php

include "dbconnect.php";

if (isset($_POST[' user_Id'])) {
    // update quiry
    $srno = $_POST[' user_Id'];
    $imagename = $_FILES['file']['name'];
    $name = $_POST['name'];
    $eamil = $_POST['eamil'];
    $password = $_POST['password'];
    $pref = $_POST['preferenceName'];

    $sql = "UPDATE `tbl_user` SET `userName` = '$title', `password` = '$password', `emailAddressil`= '$email', `profile_image`='$imagename' WHERE `tbl_user`.`user_id` = $srno";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>
     alert('we updated the record successfully')
      window.location.href='add.php'
    </script>";
    } else {
        echo "<script>
     alert('we could not updated the record successfully')
      window.location.href='add.php'
    </script>";
    }
}

?>