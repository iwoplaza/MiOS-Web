<?php

$dbConn = mysqli_connect("localhost:3306", "reader", "reader");

/* check connection */
if (mysqli_connect_errno()) {
   	header("Location: ../signup?error=".mysqli_connect_error());
    exit();
}