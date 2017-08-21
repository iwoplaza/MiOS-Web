<?php $root_path = '../' ?>
<?php
    include_once $root_path.'includes/init.inc.php';
    include_once $root_path.'includes/dbh.inc.php';
    include_once $root_path.'includes/permit.inc.php';
    //If the user isn't logged in, return him HOME.
    if(!isset($_SESSION['user_uid']))
        header("Location: ".$root_path);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Kółka zainteresowań - MiOS ZSTI</title>
        <?php include '../elements/head.php' ?>
        <link rel="stylesheet" href="../css/clubs.css">
    </head>
    <body>
        <?php include '../elements/header.php' ?>
        <?php include '../elements/burger-menu.php' ?>
        
        <div id="jumbotron">
            <h1>Kółka zainteresowań</h1>
        </div>
        <nav id="nav-tree"><ul>
            <li><a href="/">Pulpit</a></li>
            <li><a href="#">Kółka zainteresowań</a></li>
        </ul></nav>
        <section id="main-container">
            <?php
                
                include 'toolbar.php';
            
                $sql = "SELECT * FROM clubs";
                $result = mysqli_query($dbConn, $sql);
                
                /*Iterating through each club*/
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='club-entry'><h2>".$row['club_name']."<h3>".$CLUBTYPE_NAMES[$row['club_type']]."</h3></h2><p>".$row['club_desc']."</p>";
                    $sql = "SELECT * FROM user_club_relations WHERE user_id='".$_SESSION['user_id']."' AND club_id='".$row['club_id']."'";
                    $relation = Permission::fetchClubRole($row['club_id']);
                    if($relation != Permission::$NOT_FOUND) {
                        if($relation < ECLUBROLE_ADMIN) {
                            echo "<form method='post' action='../exec/club-action.php'>
                                <button class='leave' type='submit'>Odejdź</button>
                                <input hidden name='action' value='leave'>
                                <input hidden name='club_id' value='".$row['club_id']."'>
                            </form>";
                            
                            if($relation == ECLUBROLE_PENDING) {
                                echo '<p class="waiting">Oczekiwanie na zatwierdzenie...</p>';
                            }
                        }
                        
                        if($relation == ECLUBROLE_MODERATOR || $relation == ECLUBROLE_ADMIN) {
                            echo "<a class='btn-small' href='../club/manage.php?club_id=".$row['club_id']."'>Zarządzaj</a>";
                        }
                    }else{
                        echo "<form method='post' action='../exec/club-action.php'>
                            <button class='join' type='submit'>Dołącz</button>
                            <input hidden name='action' value='join'>
                            <input hidden name='club_id' value='".$row['club_id']."'>
                        </form>";
                    }
                    
                    echo "<a id='more-info' class='btn-small' href='../club?club_id=".$row['club_id']."'>Więcej</a>";
                    
                    echo '</div>';
                }
            ?>
        </section>
        
        <?php include $root_path.'elements/footer.php' ?>
    </body>
</html>