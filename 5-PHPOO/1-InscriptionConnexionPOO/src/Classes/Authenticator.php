<?php

namespace ProjetTransfo\Classes;

class Authenticator
{
    public static function accountExist($user)
    {
        if (!empty(Database::selectOneByPseudo($user->getPseudo()))) {
            return true;
        }
    }

    public static function checkPassword($userForm)
    {
        $userDB = Database::selectOneByPseudo($userForm->getPseudo());
        if (password_verify($userForm->getPassword(), $userDB->password)) {
            SessionManager::setUser($userDB);
            return true;
        }
    }
}
