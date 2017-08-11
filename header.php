<header>
    <?php
        //Display content appropriete for the user's state.
        if(!isset($_SESSION['user_uid'])) {
            echo    '<form action="'.$root_path.'signup" method="get">
                        <button type="submit" class="btn-small">Stwórz konto</button>
                    </form>'.
                    '<form action="'.$root_path.'login" method="get">
                        <button type="submit" class="btn-small">Zaloguj się</button>
                    </form>';
        }else{
            echo '<div id="burger"><span></span><span></span><span></span></div>';
            echo '<p>'.$_SESSION['user_first'].' '.$_SESSION['user_last'].'</p>';
            echo '<nav><ul>
                <li><a href="'.$root_path.'">STRONA GŁÓWNA</a></li>
                <li><a href="'.$root_path.'">O NAS</a></li>
            </ul></nav>';
            echo    '<form action="'.$root_path.'includes/logout.inc.php" method="post">
                        <input hidden name="root" value="'.$root_path.'">
                        <button type="submit" name="submit" class="btn-small">Wyloguj się</button>
                    </form>';
        }
    ?>
</header>