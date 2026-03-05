<?php

namespace ProjetTransfo\Classes;

use PDO;

class Database
{

    protected static $pdo = null;

    private function __construct() {}

    public static function getDb()
    {
        if (self::$pdo === null) {
            self::$pdo = new PDO("mysql:host=" . Config::DB_HOST . ";dbname=" . Config::DB_NAME, Config::DB_USER, Config::DB_PASSWORD, Config::DB_OPTIONS);
        }
        return self::$pdo;
    }

    public static function registerUser($user)
    {
        $hashedPassword = password_hash($user->getPassword(), PASSWORD_ARGON2ID);
        $stmt = self::getDb()->prepare("INSERT INTO users (pseudo, email, password, created_at) VALUES (:pseudo, :email, :password, NOW())");
        $stmt->bindValue(":pseudo", $user->getPseudo(), PDO::PARAM_STR);
        $stmt->bindValue(":email", $user->getEmail(), PDO::PARAM_STR);
        $stmt->bindParam(":password", $hashedPassword, PDO::PARAM_STR);
        $stmt->execute();
    }

    public static function existCheck($pseudo, $email)
    {

        $stmt = self::getDb()->prepare("SELECT * FROM users WHERE pseudo = :pseudo");
        $stmt->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() != 0) return false;

        $stmt = self::getDb()->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() != 0) return false;

        return true;
    }

    public static function selectOneByPseudo($pseudo)
    {
         $stmt = self::getDb()->prepare("SELECT * FROM users WHERE pseudo = :pseudo");
        $stmt->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() == 1)  {
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
    }
}
