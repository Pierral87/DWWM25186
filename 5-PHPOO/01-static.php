<?php

// Concept de l'orienté objet : C'est réfléchir la programmation d'une manière différente que le procédural (ligne par ligne)
//  L'orienté objet repose sur la séparation du code au travers des classes et des objets 




class User
{
    public $pseudo = "Inconnu"; // Ici des propriétés "normales" elles appartiennent à l'objet (une fois que l'objet existe ! (instancié avec un "new"))
    public $email;
    public $password;

    public static $role = "loggedoff"; // Ici une propriété "statique" elle appartient A LA CLASSE (et non pas à l'objet), c'est à dire qu'on peut s'en servir même si aucun objet User n'existe

    public function __construct($pseudo, $email, $password) {
        echo "<h2>ATTENTION PASSAGE DANS LE CONSTRUCT !!! CREATION D'UN OBJET USER !</h2>";
        echo "J'ai reçu les infos suivantes : $pseudo - $email - $password";
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->password = $password;
    }

    public function bonjour()
    {
        return "Bonjour, je m'appelle " . $this->pseudo; // ici $this fait référence à l'objet en cours d'utilisation
    }

    public static function isAdmin()
    {
        if (self::$role == "admin") { // self fait référence à la classe à l'intérieur d'elle même
            return "Je suis admin";
        } else {
            return "je suis pas admin";
        }
    }
}



$user = new User("Pierra", "pierra@mail.com", "azerty");

var_dump($user);
// // echo $user->pseudo;
// echo $user->bonjour();

// echo User::$role;   // Je peux appeler ces éléments même si un objet User n'existe pas car ils sont static (donc, appartiennent à la classe)
// echo User::isAdmin(); 


// Pourquoi on utiliserait du static ? Pour classer des fonctions/propriétés à l'intérieur d'un contexte particulier, par exemple des opérations en rapport au user à l'intérieur d'une classe User

// function isAdmin() {}

// function appliqueTva() {}

// class CalculTVA
// {
//     public static function appliqueTva() {}
// }


