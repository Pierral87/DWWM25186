<?php

/*

    EXERCICE POST :
            Formulaire inscription utilisateur : 

                Etapes : 
                    - 1 Initialiser la session en lançant l'instruction session_start()
                    - 2 Créer un formulaire POST pour une inscription utilisateur (pseudo, email, password, confirm password)
                    - 3 Controler ces informations reçues dans POST (taille pseudo, format email, longueur password et correspondance avec le confirm, vérifier si le pseudo n'est pas déjà pris)
                    - 4 Si tout est ok, crypter/hasher le mot de passe avec password_hash et l'insérer dans  $_SESSION['users'] puis afficher un message de confirmation d'inscription
                    - 5 Si pas ok, afficher des messages d'erreur en rapport avec les problèmes de saisies

*/ 


// session_start permet d'avoir accès à la globale $_SESSION
// C'est un tableau array qui va ici servir à simuler notre base de données ! 
// En gros, à chaque saisie de form, on va ajouter des informations dans ce array SESSION, pour etre capable de les récupérer sur l'exo 3 de connexion 
session_start();


// Ici je crée l'indice racine de la liste des users
$_SESSION["users"] = [];

var_dump($_SESSION);

// Ci dessous des exemples d'insertion de deux user
// ATTENTION, on ne veut pas insérer les user à la main comme ceci, on veut les insérer au travers de notre formulaire ! 
$_SESSION["users"][] = ["pseudo" => "Pierra", "email" => "pierra@mail.com", "password" => "passwordDePierra"];
$_SESSION["users"][] = ["pseudo" => "Alex", "email" => "alex@mail.com", "password" => "passwordDeAlex"];

var_dump($_SESSION);


// Le but : Avoir un formulaire d'inscription, vérifier les saisies en PHP, si les saisies sont bonnes, les insérer dans $_SESSION["users"][]  une fois que l'on aura quelques inscrits on pourra passer à l'exercice 3 de connexion 
