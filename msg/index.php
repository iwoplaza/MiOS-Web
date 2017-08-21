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
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Wiadomości - MiOS ZSTI</title>
        <?php include '../elements/head.php' ?>
    </head>
    <body>
        <?php include '../elements/header.php' ?>
        <?php include '../elements/burger-menu.php' ?>
        
        <div id="jumbotron">
            <h1>Wiadomości</h1>
        </div>
        <nav id="nav-tree"><ul>
            <li><a href="/">Pulpit</a></li>
            <li><a href="#">Wiadomości</a></li>
        </ul></nav>
        <section id="main-container">
            <div id="messenger-wrap">
                <div id="contact-list">
                    <ul>
                    <?php
                        $result = mysqli_query($dbConn, "SELECT * FROM users u INNER JOIN messages m ON(u.user_id = m.message_sender) WHERE user_id='".$_SESSION['user_id']."'");
        //$result = mysqli_query($dbConn, "SELECT * FROM users u INNER JOIN user_club_relations r ON(u.user_id = r.user_id) WHERE club_id='".$club_id."' AND relation='".ECLUBROLE_ADMIN."'");
                        while($row = mysqli_fetch_assoc($result)) {
                            echo 'User: '.$row['user_id'];
                        }
                    ?>
                    </ul>
                </div>
            </div>
        </section>
        
        <?php include '../elements/footer.php' ?>
    </body>
</html>