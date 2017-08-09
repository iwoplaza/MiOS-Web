<?php
//Starting the session.
session_start();

$root_path = $_POST['root'];

if(!isset($_POST['submit'])) {
    header('Location: '.$root_path);
    exit();
}

include 'dbh.inc.php';

$input_uid = mysqli_real_escape_string($dbConn, $_POST['username']);
$input_pwd = mysqli_real_escape_string($dbConn, $_POST['password']);

//Checking if the fields are empty. If yes, return to home and exit the script.
if(empty($input_uid) || empty($input_pwd)) {
    header('Location: '.$root_path."login/?error=empty");
    exit();
}

$sql = "SELECT * FROM users WHERE user_uid='".$input_uid."'";
$result = mysqli_query($dbConn, $sql);
if(mysqli_num_rows($result) < 1) {
    header('Location: '.$root_path."login/?error=invalid");
    exit();
}

if($row = mysqli_fetch_assoc($result)) {
    $passwordCheck = password_verify($input_pwd, $row['user_pwd']);
    if($passwordCheck == false) {
        header('Location: '.$root_path."login/?error=invalid");
        exit();
    }else if($passwordCheck == true) {
        //Logging in the user
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['user_uid'] = $row['user_uid'];
        $_SESSION['user_first'] = $row['user_first'];
        $_SESSION['user_last'] = $row['user_last'];
        $_SESSION['user_email'] = $row['user_email'];
        header('Location: '.$root_path."?login=success");
        exit();
    }
}