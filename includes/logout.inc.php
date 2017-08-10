<?php

if(isset($_POST['root']))
    $root_path = $_POST['root'];
else
    $root_path = "/";

if(isset($_POST['submit'])) {
    include_once '../includes/dbh.inc.php';
    endSession();
    header("Location: ../");
}

?>