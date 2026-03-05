<?php

namespace ProjetTransfo\Classes;

class FormValidator
{

    protected static $errors;

    public static function isSubmited()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            return true;
        } else {
            return false;
        }
    }

    public static function isValid()
    {
        if (isset($_POST["pseudo"], $_POST["email"], $_POST["password"])) {
            return true;
        } else {
            return false;
        }
    }

        public static function isLoginValid()
    {
        if (isset($_POST["pseudo"], $_POST["password"])) {
            return true;
        } else {
            return false;
        }
    }

    public static function getAllValues()
    {
        return $_POST;
    }

    public static function checkAll(User $user)
    {

        self::allRequired($user);
        self::emailCheck($user->getEmail());
        self::pseudoLength($user->getPseudo());
        self::passwordLength($user->getPassword());
        self::valuesTaken($user->getPseudo(), $user->getEmail());

        return self::$errors;
    }

    public static function allRequired($user)
    {

        if (empty($user->getPseudo()) || empty($user->getPassword()) || empty($user->getEmail())) {
            self::$errors[] =  "Tous les champs requis.";
        }
    }

    public static function emailCheck($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            self::$errors[] = "L'email n'est pas valide.";
        }
    }

    public static function pseudoLength($pseudo)
    {
        if (iconv_strlen($pseudo) < 4 || iconv_strlen($pseudo) > 20) {
            self::$errors[] = "Le pseudo doit faire entre 4 et 20 caractères";
        }
    }

    public static function passwordLength($password)
    {
        if (iconv_strlen($password) < 6) {
            self::$errors[] = "Le mot de passe doit faire au moins 6 caractères.";
        }
    }


    public static function valuesTaken($pseudo, $email)
    {
        if (Database::existCheck($pseudo, $email) == false) {
            self::$errors[] = "Ce pseudo ou email sont déjà pris";
        }
    }
}
