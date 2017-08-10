<?php

include_once '../init.php';
include_once 'dbh.inc.php';

if(!isset($_POST['submit']) || !isset($_POST['club_id'])){
    exit();
}

$club_id = mysqli_real_escape_string($dbConn, $_POST['club_id']);
$club_name = mysqli_real_escape_string($dbConn, $_POST['club_name']);
$club_type = mysqli_real_escape_string($dbConn, $_POST['club_type']);
$club_desc = mysqli_real_escape_string($dbConn, $_POST['club_desc']);
verifySession();

/*
Checking if the user's role is TEACHER or more.
*/
$sql = "SELECT user_role FROM users WHERE user_id='".$_SESSION['user_id']."'";
$result = mysqli_query($dbConn, $sql);

if(!$row = mysqli_fetch_assoc($result)) {
    /*  The user has no information in the database, which is a a problem.
        Exiting the script */
    exit();
}

$user_role = $row['user_role'];
if(!isset($user_role)) {
    exit();
}

/*
Checking if the user is the club's administrator.
*/
$sql = "SELECT * FROM user_club_relations WHERE user_id='".$_SESSION['user_id']."' AND club_id='".$club_id."' AND relation='".ECLUBROLE_ADMIN."'";
$result = mysqli_query($dbConn, $sql);

if(mysqli_num_rows($result) < 1) {
    header("Location: ../clubs?error=not-allowed");
    exit();
}

mysqli_query($dbConn, "DELETE FROM clubs WHERE club_id='".$club_id."';");
mysqli_query($dbConn, "DELETE FROM user_club_relations WHERE user_id='".$_SESSION['user_id']."' AND club_id='".$club_id."'");

$sql = "UPDATE clubs SET club_name='".$club_name."', club_type='".$club_type."', club_desc='".$club_desc."' WHERE club_id='".$club_id."'";
mysqli_query($dbConn, $sql);

header("Location: ../clubs?success");
exit();

?>