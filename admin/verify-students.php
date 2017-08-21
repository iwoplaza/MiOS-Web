<?php $root_path = '../' ?>
<?php
    include_once '../includes/init.inc.php';
    include_once '../includes/dbh.inc.php';
    include_once '../includes/permit.inc.php';
    
    //If the user isn't logged in, return him HOME.
    if(!isset($_SESSION['user_uid'])) {
        header("Location: ".$root_path);
        exit();
    }
    
    if(!Permission::permitAtLeast(EROLE_MODERATOR)) {
        header("Location: ../");
        exit();
    }

	function createUserListElement($user_id, $user_name) {
        global $root_path;
        global $club_id;
        
		echo '<li><a href="../profile?profile_id='.$user_id.'">';
        echo '<p>'.$user_name.'</p>';
        echo '<div class="profile-icon"><img src="'.$root_path.ProfileUtils::getProfilePictureURL($user_id).'"></img></div>';
        echo '</a>';
        
        echo '<form action="../exec/make-student.php" method="POST">
            <button class="btn-small" type="submit" name="submit">Remove</button>
            <input hidden name="user_id" value="'.$user_id.'">
        </form>';
        echo '<form action="../exec/make-student.php" method="POST">
            <button class="btn-small" type="submit" name="submit">Accept</button>
            <input hidden name="user_id" value="'.$user_id.'">
        </form>';
        
        echo '</li>';
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Weryfikuj uczniów - MiOS ZSTI</title>
        <?php include '../elements/head.php' ?>
    </head>
    <body>
        <?php include '../elements/header.php' ?>
        <?php include '../elements/burger-menu.php' ?>
        
        <div id="jumbotron">
            <h1>Weryfikuj uczniów</h1>
        </div>
        <nav id="nav-tree"><ul>
            <li><a href="/">Pulpit</a></li>
            <li><a href="#">Weryfikuj uczniów</a></li>
        </ul></nav>
        <section id="main-container">
            <h2>Oczekujący na weryfikacje</h2>
            <ul class="user-list">
                <?php
                    $result = mysqli_query($dbConn, "SELECT * FROM users WHERE user_role='".EROLE_GUEST."'");
                    while($row = mysqli_fetch_assoc($result)) {
                        createUserListElement($row['user_id'], $row['user_first'].' '.$row['user_last']);
                    }
                ?>
            </ul>
        </section>
        
        <?php include '../elements/footer.php' ?>
    </body>
</html>