<?php
include "dbconnect.php";

if (isset($_POST['textfield']) && isset($_POST['category'])) {
    $query = trim($_POST['textfield']);
    $category = $_POST['category'];

   
    $allowedColumns = ['userName', 'emailAddress', 'preference'];
    if (!in_array($category, $allowedColumns)) {
        die("Invalid search category.");
    }

    
    if ($category == 'preference') {
        $sql = "SELECT u.profile_image, u.userName, u.emailAddress, 
                    GROUP_CONCAT(p.preferenceName SEPARATOR ', ') AS preferences
                FROM tbl_user u
                LEFT JOIN tbl_preferences tp ON u.user_Id = tp.userId
                LEFT JOIN tbl_pref_master p ON tp.preferenceId = p.preferenceId
                WHERE p.preferenceName LIKE ?
                GROUP BY u.user_Id";
    } else {
        $sql = "SELECT profile_image, userName, emailAddress FROM tbl_user WHERE $category LIKE ?";
    }

    $stmt = $conn->prepare($sql);
    $searchTerm = "%" . $query . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td><img src='uploads/" . $row['profile_image'] . "' width='50' height='50'></td>
                <td>" . $row['userName'] . "</td>
                <td>" . $row['emailAddress'] . "</td>
                <td>" . $row['preferences'] . "</td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No results found</td></tr>";
    }

    $stmt->close();
}
?>