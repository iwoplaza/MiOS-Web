<?php

include_once 'init.inc.php';
include_once 'dbh.inc.php';

class Permission {
    /*
        Fetches the current session's user's role.
    */
    static function fetchRole() {
        global $dbConn;
        $user_id = mysqli_real_escape_string($dbConn, $_SESSION['user_id']);

        //Fetching user's data from the database.
        $result = mysqli_query($dbConn, 'SELECT user_role FROM users WHERE user_id="'.$user_id.'"');
        if(!$row = mysqli_fetch_assoc($result)) {
            header("Location ../?error=not-allowed");
            exit();
        }

        if(!isset($row['user_role'])) {
            header("Location ../?error=not-allowed");
            exit();
        }

        return $row['user_role'];
    }

    /*
        void permit($role) - checks if the current session's user
        permission matches the one provided.
    */
    static function permit($role) {
        $user_role = Permission::fetchRole();

        //If the user's role isn't matching the one provided, exit out to HOME.
        if($user_role != $role) {
            header("Location ../?error=not-allowed");
            exit();
        }
    }

    /*
        void permitAtLeast($role) - checks if the current session's user
        permission matches or is greater than the one provided.
    */
    static function permitAtLeast($role) {
        $user_role = Permission::fetchRole();

        //If the user's role is lesser than the one provided, exit out to HOME.
        if($user_role < $role) {
            header("Location ../?error=not-allowed");
            exit();
        }
    }
    
    /*
        void permitNot($role) - checks if the current session's user
        permission is different than the one provided.
    */
    static function permitNot($role) {
        $user_role = Permission::fetchRole();

        //If the user's role is matching the one provided, exit out to HOME.
        if($user_role == $role) {
            header("Location ../?error=not-allowed");
            exit();
        }
    }
}