<?php
/*
    This file is included in clubs/index.php. It contains code that displays the managing toolbar for clubs.
*/

verifySession();
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

if($user_role >= EROLE_TEACHER) {
    echo '
    <div id="club-toolbar">
        <a href="create-club.php">Załóż kółko</a>
    </div>';
}

?>