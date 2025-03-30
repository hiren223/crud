<?php
include "dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['user_Id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $preferences = explode(', ', $_POST['preferences']); // Convert string to array

    // Update user details
    $sql = "UPDATE tbl_user 
            SET userName='$username', emailAddress='$email', password='$password' 
            WHERE user_Id='$userId'";

    if (mysqli_query($conn, $sql)) {
        // Delete existing preferences
        mysqli_query($conn, "DELETE FROM tbl_preferences WHERE userId='$userId'");

        // Insert new preferences
        foreach ($preferences as $prefName) {
            $prefQuery = "SELECT preferenceId FROM tbl_pref_master WHERE preferenceName='$prefName'";
            $prefResult = mysqli_query($conn, $prefQuery);
            if ($prefRow = mysqli_fetch_assoc($prefResult)) {
                $preferenceId = $prefRow['preferenceId'];
                mysqli_query($conn, "INSERT INTO tbl_preferences (userId, preferenceId) VALUES ('$userId', '$preferenceId')");
            }
        }

        echo json_encode(["success" => "User updated successfully"]);
    } else {
        echo json_encode(["error" => "Update failed"]);
    }
}
?>
