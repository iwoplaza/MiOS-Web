<?php

$dbConn = mysqli_connect("192.168.0.103:3306", "reader", "reader", "mios");

/* check connection */
if (mysqli_connect_errno()) {
   	header("Location: ../signup?error=".mysqli_connect_error());
    exit();
}