<?php

include_once '../includes/init.inc.php';
include_once '../includes/dbh.inc.php';
include_once '../includes/permit.inc.php';

if(!isset($_POST['user_id'])) {
    header("Location: ../");
    exit();
}

if(!Permission::permitAtLeast(EROLE_MODERATOR)) {
    header("Location: ../");
    exit();
}

$user_id = mysqli_real_escape_string($dbConn, $_POST['user_id']);
mysqli_query($dbConn, "UPDATE users SET user_role='".EROLE_STUDENT."' WHERE user_id='".$user_id."'");
header("Location: ../admin/verify-students.php");