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
        <title>Załóż kółko - MiOS ZSTI</title>
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
            <h1>Załóż kółko</h1>
            <form id="create-club" method="post" action="../includes/create-club.inc.php">
                <input name="club_name" placeholder="Nazwa" required>
                <select name="club_type" placeholder="Typ" required >
                    <?php
                        foreach($CLUBTYPE_NAMES as $key => $value) {
                            echo '<option value ="'.$key.'">'.$value.'</option>';
                        }
                    ?>
                </select>
                <textarea name="club_desc" placeholder="Opis" rows="5" cols="20" required></textarea>
                <button type="submit" name="submit">Załóż</button>
            </form>
        </section>
        
        <?php
			include_once $root_path.'footer.php';
		?>
		
		<script src="../js/sidebar.js"></script>
    </body>
</html>