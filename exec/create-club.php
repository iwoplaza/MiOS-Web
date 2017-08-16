<?php

include_once '../includes/init.inc.php';
include_once '../includes/dbh.inc.php';

if(!isset($_POST['submit'])){
    exit();
}

$club_name = mysqli_real_escape_string($dbConn, $_POST['club_name']);
$club_type = mysqli_real_escape_string($dbConn, $_POST['club_type']);
$club_desc = mysqli_real_escape_string($dbConn, $_POST['club_desc']);

if(empty($club_type)) {
    $club_type = 0;
}

/*
If some of the fields are empty, return an error message and
exit the script.
*/
if(empty($club_name) || empty($club_desc)) {
    header("Location: ../clubs/create-club.php?error=empty");
    exit();
}

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
If the role is lesser than the teacher, you have
no right to create a club.
*/
if($user_role < EROLE_TEACHER) {
    header("Location: ../clubs/create-club.php?error=not-allowed");
    exit();
}

/*
Checking if a club with a given name already exists by any chance.
*/
$sql = "SELECT * FROM clubs WHERE club_name='".$club_name."'";
$result = mysqli_query($sql);
if(mysqli_num_rows($result) > 0) {
    header("Location: ../clubs/create-club.php?error=name-taken");
    exit();
}

$sql = "INSERT INTO clubs (club_name, club_type, club_desc) VALUES ('".$club_name."', '".$club_type."', '".$club_desc."')";
mysqli_query($dbConn, $sql);
$sql = "SELECT club_id FROM clubs WHERE club_name='".$club_name."'";
$result = mysqli_query($dbConn, $sql);

if($row = mysqli_fetch_assoc($result)) {
    echo 'Row: '.$row['club_id'];
    $sql = "INSERT INTO user_club_relations (user_id, club_id, relation) VALUES ('".$_SESSION['user_id']."', '".$row['club_id']."', ".ECLUBROLE_ADMIN.")";
    mysqli_query($dbConn, $sql);
}else{
    header("Location: ../clubs?error=internal-error");
    exit();
}

header("Location: ../clubs?success");
exit();

?>