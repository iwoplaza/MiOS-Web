<nav id="burger-menu">
    <ul>
        <?php echo '<li><a href="'.$root_path.'">Pulpit</a></li>'?>
        <?php echo '<li><a href="'.$root_path.'profile?profile_id='.$_SESSION['user_id'].'">Profil</a></li>'?>
        <?php echo '<li><a href="'.$root_path.'class?class_id='.$_SESSION['class_id'].'">Klasa</a></li>'?>
    </ul>
</nav>