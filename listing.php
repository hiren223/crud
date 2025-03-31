<?php include "insert.php" ?>
<?php include "delete.php" ?>
<?php include "update_data.php"; ?>


<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Listing Page</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style type="text/css">
        .heading11 {
            FONT-SIZE: 30px;
            COLOR: #0a2892;
            FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif;
            TEXT-DECORATION: none
        }
        .pagination
        {
        border-radius:4px;
        display:inline-block;
        margin:20px
        0;
        padding-left:0;
        }
        .pagination>li:first-child>a,
        .pagination>li:first-child>span
        {
        border-bottom-left-radius:4px;
        border-top-left-radius:4px;
        margin-left:0;
        color:#B5533E;
        }
        .pagination>li>a,
        .pagination>li>span
        {
        background-color:#fff;
        border:1px
        solid
        #ddd;
        color:#337ab7;
        float:left;
        line-height:1.42857;
        margin-left:-1px;
        padding:6px
        12px;
        position:
        relative;
        text-decoration:
        none;
        }
        .pagination>li
        {
        display:inline;
        }
        .pagination
        a{
        text-decoration:none !important;
        }
        .pagination>li:last-child>a, .pagination>li:last-child >span{
        border-bottom-right-radius:4px;
        border-top-right-radius:4px;
        } 
        .text-end{
            text-align: end !important;
            
        }
        </style>
</head>

<body bgcolor="#FFF8E8" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    <!--title START-->
    <table width="100%" border="0" cellspacing="10" cellpadding="5" align="center">
        <tr>
            <td align="center" valign="middle" bgcolor="#FFF3D7" style="border-bottom: 1px solid #FFE29F;"><B>
                    <SPAN class=heading11>Sample Test Project </SPAN><SPAN class=heading2></SPAN><BR>
                </B></td>
        </tr>
    </table>
    <!--title END-->
    <!--body START-->
  <?php
include "dbconnect.php";


$searchInput = isset($_GET['searchInput']) ? mysqli_real_escape_string($conn, trim($_GET['searchInput'])) : '';
$selectedCategory = isset($_GET['category']) ? mysqli_real_escape_string($conn, trim($_GET['category'])) : '';

$limit = 5; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$start = ($page - 1) * $limit;


$sql = "SELECT u.user_Id, u.userName, u.password, u.emailAddress, u.profile_image, 
       GROUP_CONCAT(DISTINCT p.preferenceName SEPARATOR ', ') AS preferences
       FROM tbl_user u
       LEFT JOIN tbl_preferences tp ON u.user_Id = tp.userId
       LEFT JOIN tbl_pref_master p ON tp.preferenceId = p.preferenceId
       WHERE 1";


if (!empty($searchInput)) {
    $sql .= " AND u.userName LIKE '%$searchInput%'";
}


if (!empty($selectedCategory)) {
    $sql .= " AND p.preferenceName = '$selectedCategory'";
}

$sql .= " GROUP BY u.user_Id LIMIT $start, $limit";

$result = mysqli_query($conn, $sql);
if (!$result) {
    die("SQL Error: " . mysqli_error($conn));
}
?>

<!-- Search Form -->
 <table width="100%"  border="0" cellspacing="10" cellpadding="5" align="center">
<form method="GET">
   <tr>
		<td align="left"><div style=" color: #a75314;font-family: Verdana,Arial,Helvetica,sans-serif;font-size: 12px;">Search : </div>
      <input type="text" size="35" id="searchInput" name="searchInput" value="<?= htmlspecialchars($searchInput) ?>" placeholder="Search Username"> 
      <select id="filter" name="category">
        <option value="">--Select Preference--</option>
        <?php
              $pref_sql = "SELECT DISTINCT preferenceName FROM `tbl_pref_master`";
              $pref_result = mysqli_query($conn, $pref_sql);
              while ($row = mysqli_fetch_assoc($pref_result)) {
                  $selected = ($selectedCategory == $row['preferenceName']) ? "selected" : "";
                  echo '<option value="' . $row['preferenceName'] . '" ' . $selected . '>' . $row['preferenceName'] . '</option>';
              }
              ?>
      </select>
      <input type="submit" value="Search" name="Submit"></td>
		<td align="right"><a href="add.php">ADD NEW RECORD</a></td>
		</tr>
</form>

<tr>
    <td colspan="2">

<table width="100%"  width="100%"  border="0" align="center" cellpadding="2" cellspacing="2" class="heading6" style="border:1px solid #FFE29F;">
   
<thead>
        <tr height="25">
            <th scope="col" width="11%" align="left" bgcolor="#FFF3D6" class="heading5">Profile Image ^</th>
            <th scope="col" width="11%" align="left" bgcolor="#FFF3D6" class="heading5">Username ^</th>
            <th scope="col" width="11%" align="left" bgcolor="#FFF3D6" class="heading5">Password</th>
            <th scope="col" width="16%" align="left" bgcolor="#FFF3D6" class="heading5">Email Address</th>
            <th scope="col" width="25%" align="left" bgcolor="#FFF3D6" class="heading5">Preferences</th>
            <th scope="col" colspan="2" align="left" bgcolor="#FFF3D6" class="heading5">Options</th>
        </tr>
    </thead>
    <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr bgcolor="#FFFFFF">
                    <td align="left"><img src="<?= $row['profile_image'] ?>" width="50" height="50"   alt="Profile"></td>
                    <td align="left"><a href="update.php?user_Id=<?= $row['user_Id'] ?>" style="color: #0A2892;" class="edit" data-bs-toggle="modal" data-bs-target="#editModal"><?= $row['userName'] ?></a></td>
                    <td align="left"><?= $row['password'] ?></td>
                    <td align="left"><?= $row['emailAddress'] ?></td>
                    <td align="left"><?= $row['preferences'] ?></td>
                    <td align="center" width="6%"><a href="#" class="delete" id="d<?= $row['user_Id'] ?>">DELETE</a></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" align="center">No results found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
</td>
</tr>
 </table>

<!-- Pagination -->
<?php
$total_query = "SELECT COUNT(DISTINCT u.user_Id) AS total FROM tbl_user u
LEFT JOIN tbl_preferences tp ON u.user_Id = tp.userId
LEFT JOIN tbl_pref_master p ON tp.preferenceId = p.preferenceId
WHERE 1";


if (!empty($searchInput)) {
    $total_query .= " AND u.userName LIKE '%$searchInput%'";
}
if (!empty($selectedCategory)) {
    $total_query .= " AND p.preferenceName = '$selectedCategory'";
}

$total_result = mysqli_query($conn, $total_query);
$total_rows = mysqli_fetch_assoc($total_result)['total'];
$total_pages = ceil($total_rows / $limit);
?>

        <tr  >
            <td>
                <ul class="pagination" style="margin-left: 29px;" >
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li><a href="?searchInput=<?= urlencode($searchInput) ?>&category=<?= urlencode($selectedCategory) ?>&page=<?= $i ?>" <?= ($i == $page) ?  : '' ?>><?= $i ?></a></li>
                    <?php endfor; ?>
                </ul>
            </td>
        </tr>

        <!--body END-->
        <!--bottom START-->
        <table width="100%" border="0" cellspacing="10" cellpadding="5" align="center">
            <TR vAlign=bottom align=left>
                <TD colSpan=3 height=40><SPAN class=heading4>� Sample project </SPAN><SPAN class=heading3><B></B></SPAN></TD>
            </TR>
        </table>
        <!--bottom END-->
</body>


<script>


edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) => {
            console.log("edit");
            tr = e.target.parentNode.parentNode;
            file = tr.getElementsByTagName("td")[0].innerText;
            name = tr.getElementsByTagName("td")[1].innerText;
            email = tr.getElementsByTagName("td")[2].innerText;
            password = tr.getElementsByTagName("td")[3].innerText;
            preferences = tr.getElementsByTagName("td")[4].innerText;
            console.log(file, name, password, email, preferences);
            
            file.value = file;
            name.value =name;
            password.value =password;
            email.value =email;
            preferences.value =preferences;
            // user_Id.value = e.target.id;
            console.log(e.target.id);
        });
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
            console.log("edit");
            sno = e.target.id.substr(1, );
            if (confirm("You are sure delete the record")) {
                console.log("yes");
                window.location = `listing.php?delete=${sno}`;
            } else {
                console.log("no");
            }
        });
    })


</script>


</html>