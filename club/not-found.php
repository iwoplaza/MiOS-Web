<?php $root_path = '../' ?>
<?php include $root_path.'includes/init.inc.php' ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Profil nie znaleziony - MiOS ZSTI</title>
        <?php include '../head.php' ?>
        <link rel="stylesheet" href="../css/clubs.css">
    </head>
    <body>
        <?php include '../header.php' ?>
        <?php include '../burger-menu.php' ?>
        
        <section id="main-container">
            <h1>Nie znaleziono klubu</h1>
            <p>
                Klub który próbujesz wyświetlić nie istnieje. Jeżeli jesteś pewien że dany klub powinien tu być, skontaktuj się z administratorami strony.
            </p>
        </section>
        
        <?php include $root_path.'footer.php' ?>
    </body>
</html>