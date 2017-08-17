<?php $root_path = '../' ?>
<?php
    include $root_path.'includes/init.inc.php';
    include $root_path.'includes/dbh.inc.php';
    include $root_path.'includes/permit.inc.php';

    //If the user isn't logged in, return him HOME.
    if(!isset($_SESSION['user_uid'])) {
        header("Location: ".$root_path);
        exit();
    }
    
    //You can view a person's profile if you're at least a student.
    if(!Permission::permitAtLeast(EROLE_STUDENT)) {
		header("Location: ../");
		exit();
	}
    
    if(!isset($_GET['club_id'])) {
        header("Location: ".$root_path);
        exit();
    }

    $club_id = mysqli_real_escape_string($dbConn, $_GET['club_id']);
    $result = mysqli_query($dbConn, "SELECT * FROM clubs WHERE club_id='".$club_id."'");
    if(!$row = mysqli_fetch_assoc($result)) {
        header("Location: not-found.php?club_id=".$club_id);
        exit();
    }

    $club_name = $row['club_name'];
    $club_type = $row['club_type'];
    $club_desc = $row['club_desc'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $club_name ?> - MiOS ZSTI</title>
        <?php include '../elements/head.php' ?>
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
            <li><a href="#"><?php echo $club_name ?></a></li>
        </ul></nav>
        <section id="main-container">
            <p><?php echo $club_desc ?></p>
            <?php echo '<a href="members.php?club_id='.$club_id.'">Członkowie</a>' ?>
        </section>
        
        <?php include '../elements/footer.php' ?>
    </body>
</html>