<?php

$dbConn = mysqli_connect("localhost:3307", "root", "", "mios");
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