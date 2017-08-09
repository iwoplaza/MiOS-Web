<?php $root_path = './' ?>
<?php include $root_path.'init.php' ?>

<!DOCTYPE html>
<html>
    <head>
        <title>MiOS ZSTI - Modernizacja i Organizacja Społeczeństwa ZSTI</title>
        <link rel="stylesheet" href="css/main.css">
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
        
        <?php
			include_once $root_path.'footer.php';
		?>
		
		<?php
            if(isset($_SESSION['user_uid'])) {
                include $root_path.'index_loggedin.php';
            }else{
                include $root_path.'index_loggedout.php';
            }
        ?>
		
		<script src="js/sidebar.js"></script>
    </body>
</html>