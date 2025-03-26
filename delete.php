<?php

include "dbconnect.php";

if (isset($_GET['delete'])) {
    $sno = $_GET['delete'];
    $sql = "DELETE FROM tbl_user WHERE `tbl_user`.`userName` = $sno";
    $result = mysqli_query($conn, $sql);

    echo "<script>
     alert('we delete the record successfully')
      window.location.href='crud.php'
    </script>";
}

?>