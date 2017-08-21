<?php $root_path = '../' ?>
<?php
    include $root_path.'includes/init.inc.php';
    include $root_path.'includes/dbh.inc.php';
    include $root_path.'includes/permit.inc.php';

    //If the user isn't logged in, return him HOME.
    if(!isset($_SESSION['user_uid'])) {
        header("Location: ../");
        exit();
    }
    
    //You can view a person's profile if you're at least a student.
    if(!Permission::permitAtLeast(EROLE_STUDENT)) {
		header("Location: ../");
		exit();
	}
    
    if(!isset($_GET['profile_id'])) {
        header("Location: ../");
        exit();
    }

    $profile_id = mysqli_real_escape_string($dbConn, $_GET['profile_id']);
    $result = mysqli_query($dbConn, "SELECT * FROM users WHERE user_id='".$profile_id."'");
    if(!$row = mysqli_fetch_assoc($result)) {
        header("Location: not-found.php?profile_id=".$profile_id);
        exit();
    }

    $profile_first = $row['user_first'];
    $profile_last = $row['user_last'];
    $profile_email = $row['user_email'];
    $profile_class = $row['class_id'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $profile_first.' '.$profile_last ?> - MiOS ZSTI</title>
        <?php include '../elements/head.php' ?>
    </head>
    <body>
        <?php include '../elements/header.php' ?>
        <?php include '../elements/burger-menu.php' ?>
        
        <div id="jumbotron">
            <h1><?php echo $profile_first.' '.$profile_last ?></h1>
        </div>
        <nav id="nav-tree"><ul>
            <li><a href="/">Pulpit</a></li>
            <li><a href="#"><?php echo $profile_first.' '.$profile_last ?></a></li>
        </ul></nav>
        <section id="main-container">
            <div class="profile-icon">
                <?php
                    echo '<img src="'.$root_path.ProfileUtils::getProfilePictureURL($profile_id).'"></img>';
                    //If the user's the profile's owner, let him change the profile picture.
                    if($profile_id == $_SESSION['user_id']) {
                        echo '<div class="profile-icon-detail"><a href="change-picture.php?profile_id='.$profile_id.'">Zmień obrazek</a></div>';
                    }
                ?>
            </div>
            <h1><?php echo $profile_first.' '.$profile_last ?></h1>
            <?php
                
                if(!empty($profile_email)) {
                    echo "<li>Email: ".$profile_email."</li>";
                }
                if(!empty($profile_class)) {
                    $result = mysqli_query($dbConn, "SELECT * FROM classes WHERE class_id='".$profile_class."'");
                    if($row = mysqli_fetch_assoc($result)) {
                        $class_number = $row['class_number'];
                        $class_symbol = $row['class_symbol'];
                        $class_name = $row['class_name'];
                        echo '<li><a href="../class?class_id='.$profile_class.'">Klasa '.$class_number.$class_symbol.' - '.$class_name.'</a></li>';
                    }
                }
            ?>
            <?php
                if($profile_id == $_SESSION['user_id']) {
                    echo '<p><a href="edit.php?profile_id='.$profile_id.'">Edytuj profil</a></p>';
                }
            ?>
        </section>
        
        <?php include '../elements/footer.php' ?>
    </body>
</html>