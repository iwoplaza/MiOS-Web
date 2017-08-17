<?php

include_once '../includes/init.inc.php';
include_once '../includes/dbh.inc.php';

$allowed_types = array('image/jpeg', 'image/jpg', 'image/png');
$max_size = 10000000;

if(!isset($_POST['submit']) || !isset($_POST['profile_id'])) {
    header("Location: ../error=invalid");
    exit();
}

$profile_id = mysqli_real_escape_string($dbConn, $_POST['profile_id']);

$file = $_FILES['profile-picture'];
print_r($file);
if($file['error'] != 0) {
    header("Location: ../profile/change-picture.php?error=file-error&profile_id=".$profile_id);
    exit();
}

$file_name = $file['name'];
$file_src = $file['tmp_name'];
$file_size = $file['size'];
$file_type = $file['type'];

if(!in_array($file_type, $allowed_types)) {
    header("Location: ../profile/change-picture.php?error=invalid-type&profile_id=".$profile_id);
    exit();
}

if($file_size > $max_size) {
    header("Location: ../profile/change-picture.php?error=too-big&profile_id=".$profile_id);
    exit();
}

$file_name_new = "profile-".$profile_id.".image";
$file_destination = "../uploads/profile-pictures/".$file_name_new;
    
move_uploaded_file($file_src, $file_destination);

header("Location: ../profile?success&profile_id=".$profile_id);
exit();