<?php
include "dbconnect.php";

if (isset($_POST['submit'])) {
  $id = $_POST['userId'];
  $name = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];
  $preference = $_POST['preference'];

  // Handle file upload
  $image = $_FILES['file']['tmp_name'];
  $imageName = $_FILES['file']['name'];

  // If a new image is uploaded
  if ($imageName) {
    move_uploaded_file($image, "uploads/" . $imageName);
    $profileImage = "uploads/" . $imageName;
  } else {
    // Keep existing image
    $sql = "SELECT profile_image FROM tbl_user WHERE userId=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $profileImage = $row['profile_image'];
  }

  // Update user data
  $sql = "UPDATE tbl_user SET userName=?, password=?, email=?, profile_image=? WHERE userId=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssssi", $name, $password, $email, $profileImage, $id);

  if ($stmt->execute()) {
    echo "<script>
            alert('Record updated successfully');
            window.location.href='listing.php';
        </script>";
  } else {
    echo "<script>
            alert('Update failed');
            window.location.href='listing.php';
        </script>";
  }
}
?>