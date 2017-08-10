<?php

$dbConn = mysqli_connect("192.168.0.103:3306", "reader", "reader", "mios");
mysqli_set_charset($dbConn, 'utf8');

/* check connection */
if (mysqli_connect_errno()) {
   	header("Location: ../signup?error=".mysqli_connect_error());
    exit();
}

function verifySession() {
}

function endSession() {
    session_start();
    session_unset();
    session_destroy();
}