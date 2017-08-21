<?php

include_once '../includes/init.inc.php';
include_once '../includes/dbh.inc.php';

//If the action is not specified, exit the script.
if(!isset($_POST['action'])) {
    header("Location: ../?club-error=none");
    exit();
}

$action = $_POST['action'];

/*
    Veryfing the session in case the user credentials are falsified.
*/
verifySession();

/*
    Is the action 'JOIN'? Alright then, let's try and join the user with the club.
*/
if($action == 'join') {
    if(isset($_POST['club_id'])) {
        $club_id = mysqli_real_escape_string($dbConn, $_POST['club_id']);
        $sql = "SELECT user_role FROM users WHERE user_id='".$_SESSION['user_id']."'";
        $result = mysqli_query($dbConn, $sql);
        echo '\n';
        
        if($row = mysqli_fetch_assoc($result)) {
            $user_role = $row['user_role'];
            echo "User's role: ".$user_role;
            //If the user is a student or more.
            if($user_role >= EROLE_STUDENT) {
                //Checking if a user-club relation already exists.
                $sql = "SELECT * FROM user_club_relations WHERE user_id='".$_SESSION['user_id']."' AND club_id='".$club_id."'";
                $result = mysqli_query($dbConn, $sql);
                if(mysqli_num_rows($result) > 0) {
                    //An entry already exists, let's evaluate the possibilies.
                    $relation = mysqli_fetch_assoc($result);
                    $club_role = $relation['relation'];
                    if($club_role == ECLUBROLE_BANNED) {
                        header("Location: ../?club-error=banned");
                        exit();
                    }else{
                        header("Location: ../clubs/?club-error=already-joined");
                        exit();
                    }
                }else{
                    //Let's make a relation.
                    $sql = "INSERT INTO user_club_relations (user_id, club_id, relation) VALUES ('".$_SESSION['user_id']."', '".$club_id."', '".ECLUBROLE_PENDING."')";
                    mysqli_query($dbConn, $sql);
                    header("Location: ../clubs/?success");
                    exit();
                }
            }else{
                header("Location: ../clubs/?club-error=not-a-student");
                exit();
            }
        }else{
            header("Location: ../?club-error=bad-session");
            exit();
        }
    }else{
        header("Location: ../?club-error=unknown-action");
        exit();
    }
}
/*
    Is the action 'LEAVE' then? Alright, let's try and seperate the user from the club.
*/
else if($action == 'leave') {
    if(!isset($_POST['club_id'])) {
        header("Location: ../?club-error=unknown-action");
        exit();
    }
    $club_id = mysqli_real_escape_string($dbConn, $_POST['club_id']);
    $sql = "DELETE FROM user_club_relations WHERE user_id=".$_SESSION['user_id']." AND club_id=".$club_id." AND relation<>".ECLUBROLE_BANNED." AND relation<>".ECLUBROLE_ADMIN;
    mysqli_query($dbConn, $sql);
    
    echo 'Leaving...'.$sql;
    header("Location: ../clubs");
    exit();
}
/*
    Is the action 'ACCEPT' then? Alright, let's try to accept the user into the club.
*/
else if($action == 'accept') {
    if(!isset($_POST['club_id']) || !isset($_POST['user_id'])) {
        header("Location: ../?club-error=unknown-action");
        exit();
    }
    $club_id = mysqli_real_escape_string($dbConn, $_POST['club_id']);
    $user_id = mysqli_real_escape_string($dbConn, $_POST['user_id']);
    $sql = "UPDATE user_club_relations SET relation='".ECLUBROLE_MEMBER."' WHERE user_id='".$user_id."' AND club_id='".$club_id."'";
    mysqli_query($dbConn, $sql);
    
    echo 'Accepting...'.$sql;
    header("Location: ../club/members.php?club_id=".$club_id);
    exit();
}
/*
    Is the action 'REMOVE' then? Alright, let's try and seperate the user from the club.
*/
else if($action == 'remove') {
    if(!isset($_POST['club_id']) || !isset($_POST['user_id'])) {
        header("Location: ../?club-error=unknown-action");
        exit();
    }
    $club_id = mysqli_real_escape_string($dbConn, $_POST['club_id']);
    $user_id = mysqli_real_escape_string($dbConn, $_POST['user_id']);
    $sql = "DELETE FROM user_club_relations WHERE user_id=".$user_id." AND club_id=".$club_id." AND relation<>".ECLUBROLE_BANNED." AND relation<>".ECLUBROLE_ADMIN;
    mysqli_query($dbConn, $sql);
    
    echo 'Removing user...'.$sql;
    header("Location: ../club/members.php?club_id=".$club_id);
    exit();
}
else{
    header("Location: ../?club-error=unknown-action");
    exit();
}

?>