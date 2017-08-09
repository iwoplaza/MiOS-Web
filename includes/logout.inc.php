<?php

if(isset($_POST['root']))
    $root_path = $_POST['root'];
else
    $root_path = "/";

if(isset($_POST['submit'])) {
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../");
}

?>