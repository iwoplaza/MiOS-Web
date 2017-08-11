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
    
    if(!isset($_GET['profile_id'])) {
        header("Location: ".$root_path);
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
        <?php include '../head.php' ?>
    </head>
    <body>
        <?php include '../header.php' ?>
        <?php include '../burger-menu.php' ?>
        
        <section id="main-container">
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
        </section>
        
        <?php include $root_path.'footer.php' ?>
    </body>
</html>