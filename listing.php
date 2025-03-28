<?php include "insert.php" ?>
<?php include "delete.php" ?>
<?php include "search.php" ?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Listing Page</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            let table = new DataTable('#myTable');
        });
    </script> -->
    <style type="text/css">
        <!--
        .heading11 {
            FONT-SIZE: 30px;
            COLOR: #0a2892;
            FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif;
            TEXT-DECORATION: none
        }
        -->
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
        display:
        inline;
        }
        .pagination
        a
        {
        text-decoration:
        none
        !important;
        }
        .pagination>
        li:last-child>a,
        .pagination>li:last-child
        >
        span
        {
        border-bottom-right-radius:
        4px;
        border-top-right-radius:
        4px;
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
    <table width="100%" border="0" cellspacing="10" cellpadding="5" align="center">
        <tr id="searchForm">
            <td align="left">
                <div style=" color: #a75314;font-family: Verdana,Arial,Helvetica,sans-serif;font-size: 12px;">Search : </div>
                <input type="text" size="35" id="searchInput" name="textfield" value="Autocomplete"> <select id="filter" name="category">
                    <?php
                    $sql = "SELECT * FROM `tbl_pref_master`";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option>' . $row['preferenceName'] . '</option>';
                    }
                    ?>
                </select> <input type="submit" value="Search" id="username" id="searchBtn" name="Submit">
            </td>
            <td align="right"><a href="add.php">ADD NEW RECORD</a></td>
        </tr>
        <tr>
            <td colspan="2">

                <?php
                include "dbconnect.php";

                $limit = 5;
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $start = ($page - 1) * $limit;

                // Query to count total records
                $count_query = "SELECT COUNT(*) AS total FROM tbl_user";
                $count_result = mysqli_query($conn, $count_query);
                $total_rows = mysqli_fetch_assoc($count_result)['total'];
                $total_pages = ceil($total_rows / $limit);

                // Fetch paginated results
                $sql = "SELECT u.user_Id, u.userName, u.password, u.emailAddress, u.profile_image, 
       COUNT(tp.preferenceId) AS preference_count,
       GROUP_CONCAT(p.preferenceName SEPARATOR ', ') AS preferences
FROM tbl_user u
LEFT JOIN tbl_preferences tp ON u.user_Id = tp.userId
LEFT JOIN tbl_pref_master p ON tp.preferenceId = p.preferenceId
GROUP BY u.user_Id
HAVING COUNT(tp.preferenceId) >= 3
LIMIT $start, $limit";

                $result = mysqli_query($conn, $sql);

                if (!$result) {
                    die("SQL Error: " . mysqli_error($conn));
                }
                ?>

                <table id="myTable" width="100%" border="0" align="center" cellpadding="2" cellspacing="2" class="heading6" style="border:1px solid #FFE29F;">
                    <thead>
                        <tr>
                            <th scope="col" width="11%" align="center" bgcolor="#FFF3D6" class="heading5">Profile Image</th>
                            <th scope="col" width="11%" align="center" bgcolor="#FFF3D6" class="heading5">Username</th>
                            <th scope="col" width="11%" align="center" bgcolor="#FFF3D6" class="heading5">Password</th>
                            <th scope="col" width="11%" align="center" bgcolor="#FFF3D6" class="heading5">Email Address</th>
                            <th scope="col" width="11%" align="center" bgcolor="#FFF3D6" class="heading5">Preferences</th>
                            <th scope="col" width="11%" align="center" bgcolor="#FFF3D6" class="heading5">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><img src="<?= $row['profile_image'] ?>" width="50" height="50" alt="Profile"></td>
                                <td><a href="add.php?user_Id=<?= $row['user_Id'] ?>" style="color: #0A2892;" class="edit"><?= $row['userName'] ?></a></td>
                                <td><?= $row['password'] ?></td>
                                <td><?= $row['emailAddress'] ?></td>
                                <td><?= $row['preferences'] ?></td>
                                <td><a href="#" class="delete" id="d<?= $row['user_Id'] ?>">DELETE</a></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <!-- Pagination -->
        <tr>
            <td>
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li><a href="?page=<?= $i ?>" <?= ($i == $page) ? '"' : '' ?>><?= $i ?></a></li>
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
    function updateUser(user) {

        user.action = 'update';

        fetch('your_php_file.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams(user)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);

                    location.reload();
                } else {
                    alert("Error: " + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    }



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