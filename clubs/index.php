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
        </section>
        
        <?php
			include_once $root_path.'footer.php';
		?>
		
		<script src="../js/sidebar.js"></script>
    </body>
</html>