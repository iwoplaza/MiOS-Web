<?php
    $root_path = '/';
    
    include_once 'includes/init.inc.php';
    include_once 'includes/permit.inc.php';
?>

<div id="jumbotron">
    <h1>Witaj <?php echo $_SESSION['user_first'].' '.$_SESSION['user_last'] ?>!</h1>
</div>
<nav id="nav-tree"><ul>
    <li><a href="#">Pulpit</a></li>
</ul></nav>
<section id="main-container">
    <a href="clubs/" class="btn-large">Kółka zainteresowań</a>
    <?php
        if(Permission::permitAtLeast(EROLE_MODERATOR)) {
            echo '<a href="admin/verify-students.php" class="btn-large">Weryfikuj uczniów</a>';
        }
    ?>
    <form action="/exec/logout.php" method="post">
        <button type="submit" name="submit">Wyloguj się</button>
        <?php
            echo "<input hidden name='root' value='".$root_path."'>";
        ?>
    </form>
</section>