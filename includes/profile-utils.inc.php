<?php

include_once 'init.inc.php';
include_once 'dbh.inc.php';

class ProfileUtils {
    static function getProfilePictureURL($user_id) {
        global $root_path;
        $img_url = "uploads/profile-pictures/profile-".$user_id.".image";
        if(file_exists($root_path.$img_url))
            return $img_url;
        else
            return "img/default-profile-picture.png";
    }
}