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
    Permission::permitAtLeast(EROLE_STUDENT);
    
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
        <?php include '../head.php' ?>
    </head>
    <body>
        <?php include '../header.php' ?>
        <?php include '../burger-menu.php' ?>
        
        <section id="main-container">
            <h1><?php echo $club_name ?></h1>
            <p><?php echo $club_desc ?></p>
            <h2>Administratorzy</h2>
            <ul>
                <?php
                    $result = mysqli_query($dbConn, "SELECT * FROM users u INNER JOIN user_club_relations r ON(u.user_id = r.user_id) WHERE club_id='".$club_id."' AND relation='".ECLUBROLE_ADMIN."'");
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<li><a href="../profile?profile_id='.$row['user_id'].'">'.$row['user_first'].' '.$row['user_last'].'</a></li>';
                    }
                ?>
            </ul>
            <h2>Moderatorzy</h2>
            <ul>
                <?php
                    $result = mysqli_query($dbConn, "SELECT * FROM users u INNER JOIN user_club_relations r ON(u.user_id = r.user_id) WHERE club_id='".$club_id."' AND relation='".ECLUBROLE_MODERATOR."'");
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<li><a href="../profile?profile_id='.$row['user_id'].'">'.$row['user_first'].' '.$row['user_last'].'</a></li>';
                    }
                ?>
            </ul>
            <h2>Członkowie</h2>
            <ul>
                <?php
                    $result = mysqli_query($dbConn, "SELECT * FROM users u INNER JOIN user_club_relations r ON(u.user_id = r.user_id) WHERE club_id='".$club_id."' AND relation='".ECLUBROLE_MEMBER."'");
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<li><a href="../profile?profile_id='.$row['user_id'].'">'.$row['user_first'].' '.$row['user_last'].'</a></li>';
                    }
                ?>
            </ul>
            <h2>Oczekujący na przyjęcie</h2>
            <ul>
                <?php
                    $result = mysqli_query($dbConn, "SELECT * FROM users u INNER JOIN user_club_relations r ON(u.user_id = r.user_id) WHERE club_id='".$club_id."' AND relation='".ECLUBROLE_PENDING."'");
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<li><a href="../profile?profile_id='.$row['user_id'].'">'.$row['user_first'].' '.$row['user_last'].'</a></li>';
                    }
                ?>
            </ul>
        </section>
        
        <?php include $root_path.'footer.php' ?>
    </body>
</html>