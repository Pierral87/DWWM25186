<?php

/*

    EXERCICE POST :
            Formulaire connexion utilisateur : 

                Etapes : 
                    - 1 Initialiser la session en lançant l'instruction session_start()
                    - 2 Créer un formulaire POST pour une connexion utilisateur (pseudo, password)
                    - 3 Controler ces informations reçues dans POST pour un contexte de connexion, c'est à dire de vérifier si l'utilisateur existe bien, et dans un second temps de vérifier la correspondance du mot de passe saisi avec le mot de passe crypté via la fonction password_verify()
                    - 4 Si tout est ok, afficher un message à l'utilisateur et stocker dans $_SESSION['connected_user']  les informations de l'utilisateur actuellement connecté
                    - 5 Si pas ok, afficher un message d'erreur indiquant que la saisie est incorrecte

*/ 

session_start();
var_dump($_SESSION);

// session_destroy();
// session_unset();