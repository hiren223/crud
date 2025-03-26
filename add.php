<?php include "insert.php" ?>
<?php include "skill.php" ?>
<?php include "update.php" ?>
<!-- saved from url=(0022)http://internet.e-mail -->
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
    <form action="insert.php" method="post" enctype="multipart/form-data">
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
                            <td width="47%" align="left"><input name="username" name="usernameedit" id="username" type="text" size="35" onkeyup="checkUsername()" required></td>
                            <td> <input type="button" name="Checkbutton" id="checkAvailability" value="Check Availability" /><br />(ajax based functionality should be written)</td>
                            <td>
                                <span id="usernameResult"></span>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Password*</td>
                            <td align="center">:</td>
                            <td align="left"><input name="password" name="passwordedit" id="password" autocomplete="on" type="password" size="35" required></td>
                        </tr>
                        <tr>
                            <td align="right">Confirm Password*</td>
                            <td align="center">:</td>
                            <td align="left"><input name="cpassword" name="passwordedit" autocomplete="on" id="cpassword" type="password" size="35" required></td>
                        </tr>
                        <tr>
                            <td align="right">Email Address*</td>
                            <td align="center">:</td>
                            <td align="left"><input name="email" name="emailedit" id="email" type="email" size="35" required></td>
                        </tr>
                        <tr>
                            <td align="right">Profile Image*</td>
                            <td align="center">:</td>
                            <td align="left"><input name="file" name="fileedit" id="file" accept=" .jpeg, .jpg, .png" type="file" size="35" required></td>
                        </tr>
                        <tr>
                            <td align="right"></td>
                            <td align="center"></td>
                            <td align="left">(Jpeg,Jpg,Png, Max Limit:2MB)</td>
                        </tr>
                        <tr>
                            <td colspan="4" align="left">
                                <form action="skill.php" id="skillsForm" method="post">
                                    <table width="100%" border="0" cellspacing="2" cellpadding="2">
                                        (Please select minimum 3)
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM `tbl_pref_master`";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<tr  class='heading4' bgcolor=' #FFF2D5'><td width='0.6%'>";
                                                echo ' <strong>&nbsp;
                                                <input type="checkbox" name="preferences[]">
                                                </strong></td>
                                            <td width="16%"><strong color: #0A2892;>' . $row['preferenceName'] . '</strong></td>';
                                                echo "</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                        <!-- <tr bgcolor="#FFF2D5" class="heading4">
                                            <td width="5%"><strong>&nbsp;
                                                    <input type="checkbox" name="preferences[]">
                                                </strong></td>
                                            <td width="16%"><strong>C</strong></td>
                                            <td width="7%"><strong>&nbsp;
                                                    <input type="checkbox" name="preferences[]">
                                                </strong></td>
                                            <td width="19%"><strong>C++</strong></td>
                                            <td width="5%"><strong>&nbsp;
                                                    <input type="checkbox" name="preferences[]">
                                                </strong></td>
                                            <td width="23%"><strong>VB 5 </strong></td>
                                            <td width="5%"><strong>&nbsp;
                                                    <input type="checkbox" name="preferences[]">
                                                </strong></td>
                                            <td width="20%"><strong>VB 6 </strong></td>
                                        </tr>
                                        <tr bgcolor="#FFF2D5" class="heading4">
                                            <td><strong>&nbsp;
                                                    <input type="checkbox" name="preferences[]">
                                                </strong></td>
                                            <td><strong>Visual Studio.net </strong></td>
                                            <td><strong>&nbsp;
                                                    <input type="checkbox" name="preferences[]">
                                                </strong></td>
                                            <td><strong>ASP</strong></td>
                                            <td><strong>&nbsp;
                                                    <input type="checkbox" name="preferences[]">
                                                </strong></td>
                                            <td><strong>ASP.Net</strong></td>
                                            <td><strong>&nbsp;
                                                    <input type="checkbox" name="preferences[]">
                                                </strong></td>
                                            <td><strong>C#</strong></td>
                                        </tr>
                                        <tr bgcolor="#FFF2D5" class="heading4">
                                            <td><strong>&nbsp;
                                                    <input type="checkbox" name="preferences[]">
                                                </strong></td>
                                            <td><strong>Oracle</strong></td>
                                            <td><strong>&nbsp;
                                                    <input type="checkbox" name="preferences[]">
                                                </strong></td>
                                            <td><strong>PHP</strong></td>
                                            <td><strong>&nbsp;
                                                    <input type="checkbox" name="preferences[]">
                                                </strong></td>
                                            <td><strong>Java</strong></td>
                                            <td><strong>&nbsp;
                                                    <input type="checkbox" name="preferences[]">
                                                </strong></td>
                                            <td><strong>SQL Server</strong></td>
                                        </tr>
                                        <tr bgcolor="#FFF2D5" class="heading4">
                                            <td><strong>&nbsp;
                                                    <input type="checkbox" name="preferences[]">
                                                </strong></td>
                                            <td><strong>MySQL</strong></td>
                                            <td><strong>&nbsp;
                                                    <input type="checkbox" name="preferences[]">
                                                </strong></td>
                                            <td><strong>Sybase</strong></td>
                                            <td><strong>&nbsp;
                                                    <input type="checkbox" name="preferences[]">
                                                </strong></td>
                                            <td><strong>JSP</strong></td>
                                            <td><strong>&nbsp;
                                                    <input type="checkbox" name="preferences[]">
                                                </strong></td>
                                            <td><strong>PERL</strong></td>
                                        </tr>
                                        <tr bgcolor="#FFF2D5" class="heading4">
                                            <td><strong>&nbsp;
                                                    <input type="checkbox" name="preferences[]">
                                                </strong></td>
                                            <td><strong>Phython</strong></td>
                                            <td><strong>&nbsp;
                                                    <input type="checkbox" name="preferences[]">
                                                </strong></td>
                                            <td><strong>Cold Fusion</strong></td>
                                            <td><strong>&nbsp;
                                                    <input type="checkbox" name="preferences[]">
                                                </strong></td>
                                            <td><strong>Windows</strong></td>
                                            <td><strong>&nbsp;
                                                    <input type="checkbox" name="preferences[]">
                                                </strong></td>
                                            <td><strong>Linux</strong></td>
                                        </tr> -->
                                    </table>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td align="left">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="left"><input type="submit" name="Submit" onsubmit="return validateForm();" value="Save">&nbsp;&nbsp;
                                <input type="Reset" name="Reset" value="Reset">&nbsp;&nbsp;
                                <input type="button" name="button" value="Clear" onClick="history.go(-1);">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </form>
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
    
    $(document).ready(function() {
        $("#checkAvailability").click(function() {
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
                success: function(response) {
                    $("#usernameResult").html(response);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#skillsForm").submit(function(event) {
            if ($("input[name='preferences[]']:checked").length < 3) {
                event.preventDefault();
                $("#error").text("Please select at least 3 skills.");
            }
        });

        $("#clear").click(function() {
            $("input[name='preferences[]']").prop("checked", false);
            $("#error").text("");
        });
    });
</script>



</html>