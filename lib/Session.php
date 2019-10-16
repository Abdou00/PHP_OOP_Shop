<?php

/**
 * Class Session
 */
class Session
{
    /**
     * Démarre la session
     */
    public static function init(){
        if (version_compare(phpversion(), '5.4.0', '<')) {
            if (session_id() == '') {
                session_start();
            }
        } else {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }
    }

    /**
     * Défini la clé de session
     * @param $key
     * @param $val
     */
    public static function set($key, $val){
        $_SESSION[$key] = $val;
    }

    /**
     * Récupère la clé de session
     * @param $key
     * @return bool|mixed
     */
    public static function get($key){
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    /**
     * Vérifie si la session est active
     */
    public static function checkSession(){
        self::init();
        if (self::get("adminlogin")== false) {
            self::destroy();
            header("Location:login.php");
        }
    }

    /**
     * Verifie si l'utilisateur est loggé
     */
    public static function checkLogin(){
        self::init();
        if (self::get("adminlogin")== true) {
            header("Location:dashboard.php");
        }
    }

    /**
     * Fonction de déconnexion
     */
    public static function destroy(){
        session_destroy();
        header("Location:login.php");
    }
}
