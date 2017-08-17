<?php $root_path = '../' ?>
<?php include $root_path.'includes/init.inc.php' ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Profil nie znaleziony - MiOS ZSTI</title>
        <?php include '../elements/head.php' ?>
        <link rel="stylesheet" href="../css/clubs.css">
    </head>
    <body>
        <?php include '../elements/header.php' ?>
        <?php include '../elements/burger-menu.php' ?>
        
        <div id="jumbotron">
            <h1>Nie znaleziono profilu użytkownika</h1>
        </div>
        <nav id="nav-tree"><ul>
            <li><a href="/">Pulpit</a></li>
            <li><a href="#">Nie znaleziono</a></li>
        </ul></nav>
        <section id="main-container">
            <p>
                Profil który próbujesz wyświetlić nie istnieje. Jeżeli jesteś pewien że dany profil powinien tu być, skontaktuj się z administratorami strony.
            </p>
        </section>
        
        <?php include '../elements/footer.php' ?>
    </body>
</html>