<?php
session_start();

/* 

    EXERCICE GET : 
        Créer un tableau de gestion des utilisateurs back office 

            Etapes : 
                1 - Lancer l'instruction session_start(), cela vous donne accès à une superglobale nommée $_SESSION (c'est un array) qui peut stocker les données de votre choix et les transporter tout au long de la navigation 
                2 - Dans cette superglobale, à un indice [users], insérer des données fictives d'utilisateurs, par exemple, id, prenom, nom, email (cet array va représenter le retour d'une requête de selection en base de données)
                3 - Créer une base de page html pour créer un tableau html représentant les utilisateurs présents dans votre array session
                4 - Rajouter une colonne "actions" dans laquelle vous insérerez des boutons de votre choix pour les actions "Voir" "Modifier" "Supprimer"
                5 - Créer une communication de votre choix par GET via ces boutons pour amener sur une ou plusieurs autres pages pour chaque bouton
                6 - Une fois l'exercice terminé, lancer l'instruction session_destroy();


*/

// Initialisation du tableau d'utilisateurs
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [
        ['id' => 1, 'nom' => 'Dupont', 'email' => 'dupont@example.com'],
        ['id' => 2, 'nom' => 'Durand', 'email' => 'durand@example.com'],
        ['id' => 3, 'nom' => 'Martin', 'email' => 'martin@example.com'],
    ];
}
?>