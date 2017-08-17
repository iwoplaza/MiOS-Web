<?php
    session_start();

    define('EROLE_GUEST', 0);
    define('EROLE_STUDENT', 1);
    define('EROLE_TEACHER', 2);
    define('EROLE_MODERATOR', 3);
    define('EROLE_ADMINISTRATOR', 4);

    define('ECLUBTYPE_SPORT', 0);
    define('ECLUBTYPE_INTEREST', 1);
    define('ECLUBTYPE_ACTIVITY', 2);
    define('ECLUBTYPE_LEARNING', 3);

    define('ECLUBROLE_BANNED', -1);
    define('ECLUBROLE_PENDING', 0);
    define('ECLUBROLE_MEMBER', 1);
    define('ECLUBROLE_MODERATOR', 2);
    define('ECLUBROLE_ADMIN', 3);

    $CLUBTYPE_NAMES = array(
        0 => 'Sport',
        1 => 'Zainteresowanie',
        2 => 'Aktywność',
        3 => 'Nauczanie'
    );
?>