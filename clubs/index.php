<?php $root_path = '../' ?>
<?php include $root_path.'init.php' ?>
<?php
    //If the user isn't logged in, return him HOME.
    if(!isset($_SESSION['user_uid']))
        header("Location: ".$root_path);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Kółka zainteresowań - MiOS ZSTI</title>
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/clubs.css">
        <meta charset="utf-8" lang="pl">
    </head>
    <body>
        <?php
			include_once $root_path.'header.php';
		?>
        
        <?php
            if(isset($_SESSION['user_uid'])) {
                include $root_path.'sidemenu.php';
            }
        ?>
        
        <section id="main-container">
            <h1>Kółka zainteresowań</h1>
            <?php
                include_once $root_path.'includes/dbh.inc.php';
                include 'toolbar.php';
            
                $sql = "SELECT * FROM clubs";
                $result = mysqli_query($dbConn, $sql);
                
                /*Iterating through each club*/
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='club-entry'><h2>".$row['club_name']."<h3>".$CLUBTYPE_NAMES[$row['club_type']]."</h3></h2><p>".$row['club_desc']."</p>";
                    $sql = "SELECT * FROM user_club_relations WHERE user_id='".$_SESSION['user_id']."' AND club_id='".$row['club_id']."'";
                    $relationResult = mysqli_query($dbConn, $sql);
                    if($relationRow = mysqli_fetch_assoc($relationResult)) {
                        $relation = $relationRow['relation'];
                        if($relation < ECLUBROLE_ADMIN) {
                            echo "<form method='post' action='../includes/club-action.inc.php'>
                                <button class='leave' type='submit'>Odejdź</button>
                                <input hidden name='action' value='leave'>
                                <input hidden name='club_id' value='".$row['club_id']."'>
                            </form>
                            </div>";
                        }
                        
                        if($relation == ECLUBROLE_MODERATOR || $relation == ECLUBROLE_ADMIN) {
                            echo "<form method='get' action='manage.php'>
                                <button type='submit'>Zarządzaj</button>
                                <input hidden name='club_id' value='".$row['club_id']."'>
                            </form>
                            </div>";
                        }
                    }else{
                        echo "<form method='post' action='../includes/club-action.inc.php'>
                            <button class='join' type='submit'>Dołącz</button>
                            <input hidden name='action' value='join'>
                            <input hidden name='club_id' value='".$row['club_id']."'>
                        </form>
                        </div>";
                    }
                }
            ?>
        </section>
        
        <?php
			include_once $root_path.'footer.php';
		?>
		
		<script src="../js/sidebar.js"></script>
    </body>
</html>