<?php

include_once 'init.inc.php';
include_once 'dbh.inc.php';
include_once 'permit.inc.php';

if(!isset($_POST['submit']) || !isset($_POST['club_id'])){
    exit();
}

$club_id = mysqli_real_escape_string($dbConn, $_POST['club_id']);
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

mysqli_query($dbConn, "DELETE FROM clubs WHERE club_id='".$club_id."';");
mysqli_query($dbConn, "DELETE FROM user_club_relations WHERE user_id='".$_SESSION['user_id']."' AND club_id='".$club_id."'");

header("Location: ../clubs?success");
exit();

?>