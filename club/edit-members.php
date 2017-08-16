<?php $root_path = '../' ?>
<?php include $root_path.'includes/init.inc.php' ?>
<?php
    //If the user isn't logged in, return him HOME.
    if(!isset($_SESSION['user_uid']))
        header("Location: ".$root_path);
    
    //If the club wasn't specified, return HOME.
    if(!isset($_GET['club_id'])) {
        header("Location: ../clubs");
    }

	include_once '../includes/dbh.inc.php';
	$club_id = mysqli_real_escape_string($dbConn, $_GET['club_id']);
	$sql = "SELECT * FROM clubs WHERE club_id='".$club_id."'";
	$result = mysqli_query($dbConn, $sql);
	if($row = mysqli_fetch_assoc($result)) {
		$club_name = $row['club_name'];
		$club_type = $row['club_type'];
		$club_desc = $row['club_desc'];
	}else{
		header("Location: ../clubs");
	}

	function createUserListElement($user_id, $user_name) {
		echo '<li><a href="../profile?profile_id='.$user_id.'">'.$user_name.'</a></li>';
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Zarządzaj kółkiem - MiOS ZSTI</title>
        <?php include '../head.php' ?>
        <link rel="stylesheet" href="../css/clubs.css">
        
    </head>
    <body>
        <?php include '../header.php' ?>
        <?php include '../burger-menu.php' ?>
        
        <section id="main-container">
            <h1>Członkowie</h1>
            <h2>Administratorzy</h2>
            <ul class="user-list">
                <?php
                    $result = mysqli_query($dbConn, "SELECT * FROM users u INNER JOIN user_club_relations r ON(u.user_id = r.user_id) WHERE club_id='".$club_id."' AND relation='".ECLUBROLE_ADMIN."'");
                    while($row = mysqli_fetch_assoc($result)) {
                        createUserListElement($row['user_id'], $row['user_first'].' '.$row['user_last']);
                    }
                ?>
            </ul>
            <h2>Moderatorzy</h2>
            <ul class="user-list">
                <?php
                    $result = mysqli_query($dbConn, "SELECT * FROM users u INNER JOIN user_club_relations r ON(u.user_id = r.user_id) WHERE club_id='".$club_id."' AND relation='".ECLUBROLE_MODERATOR."'");
                    while($row = mysqli_fetch_assoc($result)) {
                        createUserListElement($row['user_id'], $row['user_first'].' '.$row['user_last']);
                    }
                ?>
            </ul>
            <h2>Członkowie</h2>
            <ul class="user-list">
                <?php
                    $result = mysqli_query($dbConn, "SELECT * FROM users u INNER JOIN user_club_relations r ON(u.user_id = r.user_id) WHERE club_id='".$club_id."' AND relation='".ECLUBROLE_MEMBER."'");
                    while($row = mysqli_fetch_assoc($result)) {
                        createUserListElement($row['user_id'], $row['user_first'].' '.$row['user_last']);
                    }
                ?>
            </ul>
            <h2>Oczekujący na przyjęcie</h2>
            <ul class="user-list">
                <?php
                    $result = mysqli_query($dbConn, "SELECT * FROM users u INNER JOIN user_club_relations r ON(u.user_id = r.user_id) WHERE club_id='".$club_id."' AND relation='".ECLUBROLE_PENDING."'");
                    while($row = mysqli_fetch_assoc($result)) {
                        createUserListElement($row['user_id'], $row['user_first'].' '.$row['user_last']);
                    }
                ?>
            </ul>
        </section>
        
        <?php include '../footer.php' ?>
    </body>
</html>