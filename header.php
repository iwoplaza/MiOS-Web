<header>
    <?php
        include_once 'includes/init.inc.php';
        include_once 'includes/dbh.inc.php';
    
        //Display content appropriete for the user's state.
        if(!isset($_SESSION['user_uid'])) {
            //What the viewer sees when he's not logged in
            echo    '<form action="'.$root_path.'signup" method="get">
                        <button type="submit" class="btn-small">Stwórz konto</button>
                    </form>'.
                    '<form action="'.$root_path.'login" method="get">
                        <button type="submit" class="btn-small">Zaloguj się</button>
                    </form>';
        }else{
            //LOGGED IN
            echo '<div id="burger"><span></span><span></span><span></span></div>';
            echo '<p><a href="'.$root_path.'profile?profile_id='.$_SESSION['user_id'].'">'.$_SESSION['user_first'].' '.$_SESSION['user_last'].'</a></p>';

            echo    '<form action="'.$root_path.'exec/logout.php" method="post">
                        <input hidden name="root" value="'.$root_path.'">
                        <button type="submit" name="submit" class="btn-small">Wyloguj się</button>
                    </form>';
            
            //Notifications
            echo '<div class="header-icon" id="notifications_toggler"><img src="'.$root_path.'img/notification_icon.png">';
            echo '<div class="dropdown-nibble"><span></span><div>Brak powiadomień</div></div>';
            echo '</div>';
            
            //Direct Messages
            echo '<div class="header-icon" id="messages_toggler"><img src="'.$root_path.'img/message_icon.png">';
            echo '<div class="dropdown-nibble"><span></span><div>Brak wiadomości</div></div>';
            echo '</div>';
        }
    ?>
</header>
<div id="jumbotron"></div>