<?php

namespace ProjetTransfo\Classes;

class User
{

    protected $pseudo;
    protected $email;
    protected $password;
    protected $errors;

    public function __construct($post)
    {
        $this->setPseudo(trim($post["pseudo"]));
        if (isset($post["email"])) $this->setEmail(trim($post["email"]));
        $this->setPassword(trim($post["password"]));

        $this->errors = FormValidator::checkAll($this);
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function IsValid()
    {
        if (empty($this->errors)) {
            return true;
        } else {
            return false;
        }
    }
}
