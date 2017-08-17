<?php $root_path = '../' ?>
<?php
    include $root_path.'includes/init.inc.php';
    include_once '../includes/dbh.inc.php';
    include_once '../includes/permit.inc.php';
    
    //If the user isn't logged in, return him HOME.
    if(!isset($_SESSION['user_uid']))
        header("Location: ".$root_path);
    
    //If the club wasn't specified, return HOME.
    if(!isset($_GET['club_id'])) {
        header("Location: ../clubs");
    }

	
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
        global $root_path;
        global $club_id;
        
		echo '<li><a href="../profile?profile_id='.$user_id.'">';
        echo '<p>'.$user_name.'</p>';
        echo '<div class="profile-icon"><img src="'.$root_path.ProfileUtils::getProfilePictureURL($user_id).'"></img></div>';
        echo '</a>';
        //If you are the administrator/moderator of the club
        $relation = Permission::fetchClubRole($club_id);
        if(Permission::clubPermitAtLeast($club_id, ECLUBROLE_MODERATOR)) {
            echo '<form action="../exec/club-action.php" method="POST">
                <button class="btn-small" type="submit" name="submit">Remove</button>
                <input hidden name="action" value="remove">
                <input hidden name="club_id" value="'.$club_id.'">
                <input hidden name="user_id" value="'.$user_id.'">
            </form>';
        }
        echo '</li>';
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Zarządzaj kółkiem - MiOS ZSTI</title>
        <?php include '../elements/head.php' ?>
        <link rel="stylesheet" href="../css/clubs.css">
        
    </head>
    <body>
        <?php include '../elements/header.php' ?>
        <?php include '../elements/burger-menu.php' ?>
        
        <div id="jumbotron">
            <h1><?php echo $club_name ?></h1>
        </div>
        <nav id="nav-tree"><ul>
            <li><a href="/">Pulpit</a></li>
            <li><a href="/clubs">Kółka zainteresowań</a></li>
            <li><?php echo '<a href="/club?club_id='.$club_id.'">'.$club_name.'</a>' ?></li>
            <li><a href="#">Członkowie</a></li>
        </ul></nav>
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
        
        <?php include '../elements/footer.php' ?>
    </body>
</html>