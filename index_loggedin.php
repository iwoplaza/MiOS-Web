<?php $root_path = '/' ?>

<section id="main-container">
    <h1>Witaj <?php echo $_SESSION['user_uid'] ?>!</h1>
    <form action="clubs/" method="get">
        <button type="submit">Kółka zainteresowań</button>
    </form>
    <form action="/includes/logout.inc.php" method="post">
        <button type="submit" name="submit">Wyloguj się</button>
        <?php
            echo "<input hidden name='root' value='".$root_path."'>";
        ?>
    </form>
</section>