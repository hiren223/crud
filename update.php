<?php include"update_data.php"; ?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Add/Edit Details</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style type="text/css">
        .heading11 {
            FONT-SIZE: 30px;
            COLOR: #0a2892;
            FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif;
            TEXT-DECORATION: none
        }
    </style>
</head>

<body bgcolor="#FFF8E8" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    <!--title START-->
    <table width="100%" border="0" cellspacing="10" cellpadding="5" align="center">
        <tr>
            <td align="center" valign="middle" bgcolor="#FFF3D7" style="border-bottom: 1px solid #FFE29F;"><B><SPAN
                        class=heading11>Sample Test Project </SPAN><SPAN class=heading2></SPAN><BR>
                </B></td>
        </tr>
    </table>
    <!--title END-->
    <!--body START-->
    <form action="update.php" method="post" enctype="multipart/form-data">
        <table width="100%" border="0" cellspacing="10" cellpadding="5" align="center">
            <tr>
                <td>
                    <table width="70%" border="0" align="center" class="heading6">
                        <tr align="center">
                            <td height="30" colspan="3" class="heading7">Add Details</td>
                        </tr>

                        <tr>

                            <td width="49%" align="right">User Name*</td>
                            <td width="4%" align="center">:</td>
                            <td width="47%" align="left"><input name="name" id="username" type="text" size="35"
                                    autocomplete="username" required value="<?php echo ($row['userName'])?$row['userName']:'';?>"></td>
                            <td> <input type="button" name="Checkbutton" id="checkAvailability"
                                    value="Check Availability" /><br />(ajax based functionality should be written)</td>
                            <td>
                                <span id="usernameResult"></span>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Password*</td>
                            <td align="center">:</td>
                            <td align="left"><input name="password" id="password" autocomplete="new-password"
                                    type="password" size="35" required value="<?php echo ($row['password'])?$row['password']:'';?>"></td>
                        </tr>
                        <tr>
                            <td align="right">Confirm Password*</td>
                            <td align="center">:</td>
                            <td align="left"><input name="cpassword" autocomplete="new-password" id="cpassword"
                                    type="password" size="35" required value="<?php echo ($row['password'])?$row['password']:'';?>"></td>
                        </tr>
                        <tr>
                            <td align="right">Email Address*</td>
                            <td align="center">:</td>
                            <td align="left"><input name="email" id="email" type="email" autocomplete="email" size="35"
                                    required value="<?php echo ($row['emailAddress'])?$row['emailAddress']:'';?>"></td>
                        </tr>
                        <tr>
                            <td align="right">Profile Image*</td>
                            <td align="center">:</td>
                            <td align="left"><input name="file" id="file" accept=" .jpeg, .jpg, .png"
                                    autocomplete="file" type="file" size="35" required value="<?php echo ($row['profile_image'])?$row['profile_image']:'';?>"></td>
                        </tr>
                        <tr>
                            <td align="right"></td>
                            <td align="center"></td>
                            <td align="left">(Jpeg,Jpg,Png, Max Limit:2MB)</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="hidden" name="user" id="user_id">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" align="left">
                                <table width="100%" border="0" cellspacing="2" cellpadding="2">
                                    (Please select minimum 3)
                            </td>
                            <td colspan="4" align="left">
                                <form action="update_data.php" id="skillsForm" method="post"
                                    onsubmit="return validatePreferences()">
                                    <?php
                                    include "dbconnect.php";

                                    $sql = "SELECT * FROM `tbl_pref_master`";
                                    $result = mysqli_query($conn, $sql);

                                    if (!$result) {
                                        die("SQL Error: " . mysqli_error($conn));
                                    }

                                    $columns = 4;
                                    $count = 0;
                                    ?>


                                    <table width="100%" cellspacing="2" class='heading4' cellpadding="2"
                                        style="background-color: #FFF2D5;">
                                        <tbody>
                                            <tr bgcolor="#FFF2D5" class="heading4">
                                                <?php
                                                while ($row = mysqli_fetch_assoc($result)) {

                                                    if ($count % $columns == 0 && $count != 0) {
                                                        echo "</tr><tr>";
                                                    }

                                                    echo "<td width='5%' style='color: #0A2892;'><strong>&nbsp;
                        <input  type='checkbox' name='preferenceName[]' value='" . $row['preferenceId'] . "' > </strong>  </td>
                      <td width='19%' value='" . $row['preferenceId'] . "'  style='font-weight: bold; '  <strong> " . $row['preferenceName'] . " </strong> </td>
                    ";
                                                    $count++;
                                                }


                                                while ($count % $columns != 0) {
                                                    echo "<td></td>";
                                                    $count++;
                                                }
                                                ?>
                                            </tr>
                                        </tbody>
                                    </table>
                            </td>
    </form>
    </td>
    </tr>
    <tr style="display: flex; justify-content:center;">
        <td align="left">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="left"><input type="submit" name="Submit" onsubmit="return validateForm();" value="Save">&nbsp;&nbsp;
            <input type="Reset" name="Reset" value="Reset">&nbsp;&nbsp;
            <input type="button" name="button" value="Clear" onClick="history.go(-1);">
        </td>
    </tr>
    </table>
    </tr>
    </table>
    </form>
    <!--body END-->
    <!--bottom START-->
    <table width="100%" border="0" cellspacing="10" cellpadding="5" align="center">
        <TR vAlign=bottom align=left>
            <TD colSpan=3 height=40><SPAN class=heading4>� Sample project </SPAN><SPAN class=heading3><B></B></SPAN>
            </TD>
        </TR>
    </table>
    <!--bottom END-->
</body>


<script>

    $(document).ready(function () {
        $("#checkAvailability").click(function () {
            var username = $("#username").val().trim();

            if (username == "") {
                $("#usernameResult").html("<span style='color:red;'>Please enter a username</span>");
                return;
            }

            $.ajax({
                url: "check_username.php",
                type: "POST",
                data: {
                    username: username
                },
                success: function (response) {
                    $("#usernameResult").html(response);
                }
            });
        });
    });

    function submitUpdate() {
        const form = document.getElementById('updateForm');
        const formData = new FormData(form);
        const user = Object.fromEntries(formData.entries());

        updateUser(user);
    }
</script>

<script>
    function validatePreferences() {
        var checkboxes = document.querySelectorAll('.preferenceCheckbox:checked');
        if (checkboxes.length < 3) {
            alert("Please select at least 3 preferences.");
            return false;
        }
        return true;
    }
</script>



</html>

