<?php $root_path = '/' ?>

<section id="main-container">
    <h1>Witaj <?php echo $_SESSION['user_first'].' '.$_SESSION['user_last'] ?>!</h1>
    <form action="clubs/" method="get">
        <button type="submit">Kółka zainteresowań</button>
    </form>
    <form action="/exec/logout.php" method="post">
        <button type="submit" name="submit">Wyloguj się</button>
        <?php
            echo "<input hidden name='root' value='".$root_path."'>";
        ?>
    </form>
</section>