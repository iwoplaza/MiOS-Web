<?php $root_path = '../' ?>
<?php include $root_path.'includes/init.inc.php' ?>
<?php
    //If the user isn't logged in, return him HOME.
    if(!isset($_SESSION['user_uid']))
        header("Location: ".$root_path);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Załóż kółko - MiOS ZSTI</title>
        <?php include '../head.php' ?>
        <link rel="stylesheet" href="../css/clubs.css">
    </head>
    <body>
        <?php include '../header.php' ?>
        <?php include '../burger-menu.php' ?>
        
        <section id="main-container">
            <h1>Załóż kółko</h1>
            <form id="create-club" method="post" action="../exec/create-club.php">
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
        
        <?php include '../footer.php' ?>
    </body>
</html>