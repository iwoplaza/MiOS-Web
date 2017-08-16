<?php

include_once '../includes/init.inc.php';
include_once '../includes/dbh.inc.php';
include_once '../includes/permit.inc.php';

if(!isset($_POST['submit']) || !isset($_POST['club_id'])){
	header("Location: ../clubs?error=invalid");
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
Permission::permitAtLeast(EROLE_TEACHER);

/*
Checking if the user is the club's administrator.
*/
$sql = "SELECT * FROM user_club_relations WHERE user_id='".$_SESSION['user_id']."' AND club_id='".$club_id."' AND relation='".ECLUBROLE_ADMIN."'";
$result = mysqli_query($dbConn, $sql);

if(mysqli_num_rows($result) < 1) {
    header("Location: ../clubs?error=not-allowed");
    exit();
}

$sql = "UPDATE clubs SET club_name='".$club_name."', club_type='".$club_type."', club_desc='".$club_desc."' WHERE club_id='".$club_id."'";
mysqli_query($dbConn, $sql);

header("Location: ../club/manage.php?club_id=".$club_id."&success");
exit();

?>