<?php $root_path = './' ?>
<?php include $root_path.'includes/init.inc.php' ?>

<!DOCTYPE html>
<html>
<head>
    <title>MiOS ZSTI - Modernizacja i Organizacja Społeczeństwa ZSTI</title>
    <?php include 'head.php' ?>
</head>
<body>
    <?php include 'header.php' ?>
    <?php include 'burger-menu.php' ?>
    
    <?php
        if(isset($_SESSION['user_uid'])) {
            include 'index_loggedin.php';
        }else{
            include 'index_loggedout.php';
        }
    ?>

    <?php include 'footer.php' ?>
</body>
</html>