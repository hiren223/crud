<?php include "insert.php" ?>
<?php include "update.php" ?>
<?php include "delete.php" ?>

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
                    <SPANclass=heading11>Sample Test Project </SPANclass=heading11><SPAN class=heading2></SPAN><BR>
                </B></td>
        </tr>
    </table>
    <!--title END-->
    <!--body START-->
    <table width="100%" border="0" cellspacing="10" cellpadding="5" align="center">
        <tr>
            <td align="left">
                <div style=" color: #a75314;font-family: Verdana,Arial,Helvetica,sans-serif;font-size: 12px;">Search : </div><input type="text" size="35" name="textfield" value="Autocomplete"> <select id="filter">
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
                        <?php
                        $sql = "SELECT * FROM `tbl_user`";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr ><td>";
                            echo "<img src='" . $row['profile_image'] . "' width='50' height='50' alt='Profile'>";
                            echo "</td>
                <td> <a href='add.php' id='edit' class='edit'style='color: #0A2892;' >" . $row['userName'] . " </a></td>
                <td>" . $row['password'] . "</td>
                <td>" . $row['emailAddress'] . "</td>
                <td>" . $row['emailAddress'] . "</td>
                <td width='6%' colspan='2' align='center'><a href='' id='delete' class='delete'>DELETE</a></td>
                </tr>";
                        }
                        ?>
                    </tbody>
                </table>
                </tbody>
    </table>
    </td>
    </tr>
    <tr>
        <td>
            <ul class="pagination">
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
            </ul>
        </td>
    </tr>
    </table>
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
    document.addEventListener("DOMContentLoaded", () => {
        const edits = document.getElementsByClassName('edit');

        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit clicked");

                let tr = e.target.closest("tr"); 

                // if (!tr) return;

                let file = tr.getElementsByTagName("td")[0].innerText;
                let name = tr.getElementsByTagName("td")[1].innerText;
                let password = tr.getElementsByTagName("td")[2].innerText;
                let email = tr.getElementsByTagName("td")[3].innerText;
                let preference = tr.getElementsByTagName("td")[4].innerText;

                console.log(file, name, password, email, preference);

                file.value = file;
                name.value = name;
                password.value = password;
                email.value = email;
                preference.value = preference;
                
            });
        });
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", () => {
        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit");
                sno = e.target.id;
                if (confirm("You are sure delete the record")) {
                    console.log("yes");
                    window.location = `add.php?delete=${sno}`;
                } else {
                    console.log("no");
                }
            });
        })
    });
</script>

</html>