<?php

$dbConn = mysqli_connect("localhost:3306", "root", "", "mios");
mysqli_set_charset($dbConn, 'utf8');

/* check connection */
if (mysqli_connect_errno()) {
   	header("Location: ../signup?error=".mysqli_connect_error());
    exit();
}