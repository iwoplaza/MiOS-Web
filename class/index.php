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
    
    //You can view a class profile if you're at least a student.
    if(!Permission::permitAtLeast(EROLE_STUDENT)) {
		header("Location: ../");
		exit();
	}
    
    if(!isset($_GET['class_id'])) {
        header("Location: ".$root_path);
        exit();
    }

    $class_id = mysqli_real_escape_string($dbConn, $_GET['class_id']);
    $result = mysqli_query($dbConn, "SELECT * FROM classes WHERE class_id='".$class_id."'");
    if(!$row = mysqli_fetch_assoc($result)) {
        header("Location: not-found.php?class_id=".$class_id);
        exit();
    }

    $class_number = $row['class_number'];
    $class_symbol = $row['class_symbol'];
    $class_name = $row['class_name'];
    $class_educator = $row['class_educator'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo 'Klasa '.$class_number.$class_symbol; ?> - MiOS ZSTI</title>
        <?php include '../elements/head.php' ?>
    </head>
    <body>
        <?php include '../elements/header.php' ?>
        <?php include '../elements/burger-menu.php' ?>
        
        <div id="jumbotron">
            <h1><?php echo 'Klasa '.$class_number.$class_symbol ?></h1>
        </div>
        <nav id="nav-tree"><ul>
            <li><a href="/">Pulpit</a></li>
            <li><a href="/classes">Klasy</a></li>
            <li><a href="#"><?php echo 'Klasa '.$class_number.$class_symbol ?></a></li>
        </ul></nav>
        <section id="main-container">
            <h1><?php echo 'Klasa '.$class_number.$class_symbol ?></h1>
            <h2>Uczniowie</h2>
            <ul>
                <?php 
                    $result = mysqli_query($dbConn, "SELECT * FROM users WHERE class_id='".$class_id."' AND user_role='".EROLE_STUDENT."'");
                    while($row = mysqli_fetch_assoc($result)) {
                        $user_id = $row['user_id'];
                        $user_first = $row['user_first'];
                        $user_last = $row['user_last'];
                        echo '<li><a href="../profile?profile_id='.$user_id.'">'.$user_first.' '.$user_last.'</a></li>';
                    }
                ?>
            </ul>
            <p>
                Wychowawca:
                <?php
                    $result = mysqli_query($dbConn, "SELECT * FROM users WHERE user_id='".$class_educator."'");
                    if($row = mysqli_fetch_assoc($result)) {
                        echo '<a href="../profile?profile_id='.$row['user_id'].'">'.$row['user_first'].' '.$row['user_last'].'</a>';
                    }
                ?>
            </p>
        </section>
        
        <?php include '../elements/footer.php' ?>
    </body>
</html>