<?php 
namespace ProjetTransfo\Classes;


class SessionManager {

    public static function start() {
        session_start();
    }

    public static function setUser($user) {
        $_SESSION["connected_user"] = $user;
    }
}