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
            <h1>Panel zarządzania</h1>
            <?php 
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
            <form id="create-club" method="post" action="../includes/update-club.inc.php">
                <?php echo '<input name="club_name" placeholder="Nazwa" required value="'.$club_name.'">'; ?>
                <select name="club_type" placeholder="Typ" required >
                    <?php
                        foreach($CLUBTYPE_NAMES as $key => $value) {
                            echo '<option value ="'.$key.'" ';
                            if($key == $club_type)
                                echo 'selected';
                            echo '>'.$value.'</option>';
                        }
                    ?>
                </select>
                <?php echo '<textarea name="club_desc" placeholder="Opis" rows="5" cols="20" required>'.$club_desc.'</textarea>' ?>
                <button type="submit" name="submit">Zatwierdź zmiany</button>
                <?php echo '<input hidden name="club_id" value="'.$club_id.'">' ?>
            </form>
            <form method="post" action="../includes/delete-club.inc.php">
                <button type="submit" name="submit">Usuń kółko</button>
                <?php echo "<input hidden name='club_id' value='".$club_id."'>" ?>
            </form>
        </section>
        
        <?php include '../footer.php' ?>
    </body>
</html>