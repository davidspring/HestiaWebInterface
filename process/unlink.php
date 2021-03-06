<?php

/** 
*
* Hestia Web Interface
*
* Copyright (C) 2020 Carter Roeser <carter@cdgtech.one>
* https://cdgco.github.io/HestiaWebInterface
*
* Hestia Web Interface is free software: you can redistribute it and/or modify
* it under the terms of version 3 of the GNU General Public License as published 
* by the Free Software Foundation.
*
* Hestia Web Interface is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with Hestia Web Interface.  If not, see
* <https://github.com/cdgco/HestiaWebInterface/blob/master/LICENSE>.
*
*/

 session_start();
$configlocation = "../includes/";
if (file_exists( '../includes/config.php' )) { require( '../includes/includes.php'); }  else { header( 'Location: ../install' ); exit(); };
if(base64_decode($_SESSION['loggedin']) == 'true') {}
else { header('Location: ../login.php'); exit(); }

if(isset($profileenabled) && $profileenabled != 'true'){ header("Location: ../error-pages/403.html"); exit(); }

if($auth0) {

	$con=mysqli_connect($mysql_server,$mysql_uname,$mysql_pw,$mysql_db);
    $v1 = mysqli_real_escape_string($con, $username);
    $droprow= "DELETE FROM `" . $mysql_table . "auth0-users` WHERE `HWI_USER` = '".$v1."';";
    if (mysqli_query($con, $droprow)) { $a1 = '0'; } else { $a1 = mysqli_errno($con); }
    mysqli_close($con);
}
else {
    header( 'Location: ../index.php' ); exit();
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="../css/style.css" rel="stylesheet">
    </head>
    <body class="fix-header">
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> 
            </svg>
        </div>

        <form id="form" action="../profile.php" method="post">
            <?php 
            echo '<input type="hidden" name="a1" value="'.$a1.'">';
            ?>
        </form>
        <script type="text/javascript">
            document.getElementById('form').submit();
        </script>
    </body>
    <script src="../plugins/components/jquery/jquery.min.js"></script>
</html>