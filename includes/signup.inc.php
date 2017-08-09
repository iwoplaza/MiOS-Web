<?php

/*
Was this script ran via the submit button? If not, return to the SignUp page and exit the script.
*/
if(!isset($_POST['submit'])){
	header("Location: ../signup");
	exit();
}

include_once 'dbh.inc.php';

$input_uid = mysqli_real_escape_string($dbConn, $_POST['username']);
$input_pwd = mysqli_real_escape_string($dbConn, $_POST['password']);
$input_first = mysqli_real_escape_string($dbConn, $_POST['first']);
$input_last = mysqli_real_escape_string($dbConn, $_POST['last']);
$input_email = mysqli_real_escape_string($dbConn, $_POST['email']);

/*
Checking if by any chance the fields are empty.
If they are, return to the SignUp page with an error,
and exit the script.
*/
/*if(empty($input_uid) || empty($input_pwd) || empty($input_first) || empty($input_last) || empty($input_email)) {
	header("Location: ../signup?error=empty");
	exit();
}*/

/*
Checking if the email is valid.
*/
if(!filter_var($input_email, FILTER_VALIDATE_EMAIL)) {
	header("Location: ../signup?error=invalid-email");
	exit();
}

$sql = "SELECT * FROM users WHERE user_uid='".$input_uid."'";
$result = mysqli_query($dbConn, $sql);
if(mysqli_num_rows($result) > 0) {
	header("Location: ../signup?error=taken");
	exit();
}


//Hashing the password.
$hashedPwd = password_hash($input_pwd, PASSWORD_DEFAULT);
//Inserting the user into the database.
$sql = "INSERT INTO users (user_uid, user_pwd, user_first, user_last, user_email) VALUES ('"
	.$input_uid."', '".$hashedPwd."', '".$input_first."', '".$input_last."', '".$input_email."')";
mysqli_query($dbConn, $sql);
header("Location: ../signup?success");
exit();