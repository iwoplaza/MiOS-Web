<?php

include_once 'init.inc.php';
include_once 'dbh.inc.php';

class Permission {
    static $NOT_FOUND = 'not-found';
    /*
        Fetches the current session's user's role.
    */
    static function fetchRole() {
        global $dbConn;
        $user_id = mysqli_real_escape_string($dbConn, $_SESSION['user_id']);

        //Fetching user's data from the database.
        $result = mysqli_query($dbConn, 'SELECT user_role FROM users WHERE user_id="'.$user_id.'"');
        if(!$row = mysqli_fetch_assoc($result))
            return null;

        if(!isset($row['user_role']))
            return null;

        return $row['user_role'];
    }

    /*
        void permit($role) - checks if the current session's user
        permission matches the one provided.
    */
    static function permit($role) {
        $user_role = Permission::fetchRole();

        //If the user's role is matching the one provided, return true.
        return $user_role == $role;
    }

    /*
        void permitAtLeast($role) - checks if the current session's user
        permission matches or is greater than the one provided.
    */
    static function permitAtLeast($role) {
        $user_role = Permission::fetchRole();

        //If the user's role is greater or equal to the one provided, return true.
        return $user_role >= $role;
    }
    
    /*
        void permitNot($role) - checks if the current session's user
        permission is different than the one provided.
    */
    static function permitNot($role) {
        $user_role = Permission::fetchRole();

        //If the user's role isn't matching the one provided, return true.
        return $user_role != $role;
    }
    
    /*
        Fetches the current session's user's club role.
    */
    static function fetchClubRole($club_id) {
        global $dbConn;
        $user_id = mysqli_real_escape_string($dbConn, $_SESSION['user_id']);

        //Fetching user's data from the database.
        $result = mysqli_query($dbConn, 'SELECT relation FROM user_club_relations WHERE user_id="'.$user_id.'" AND club_id="'.$club_id.'"');
        if(!$row = mysqli_fetch_assoc($result))
            return Permission::$NOT_FOUND;

        return $row['relation'];
    }
    
    static function clubPermit($club_id, $role) {
        $user_role = Permission::fetchClubRole($club_id);

        //If the user's role is matching the one provided, return true.
        return $user_role != Permission::$NOT_FOUND && $user_role == $role;
    }
    
    static function clubPermitAtLeast($club_id, $role) {
        $user_role = Permission::fetchClubRole($club_id);

        //If the user's role is greater or equal to the one provided, return true.
        return $user_role != Permission::$NOT_FOUND && $user_role >= $role;
    }
    
    static function clubPermitNot($club_id, $role) {
        $user_role = Permission::fetchClubRole($club_id);

        //If the user's role isn't matching the one provided, return true.
        return $user_role != Permission::$NOT_FOUND && $user_role != $role;
    }
}