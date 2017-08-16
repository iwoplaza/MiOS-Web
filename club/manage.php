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
            <h1>Panel zarządzania - <?php echo $club_name ?></h1>
            <?php echo '<a href="edit-basic.php?club_id='.$club_id.'">Edytuj podstawowe informacje</a>' ?>
            <?php echo '<a href="edit-members.php?club_id='.$club_id.'">Zarządzaj członkami</a>' ?>
        </section>
        
        <?php include '../footer.php' ?>
    </body>
</html>