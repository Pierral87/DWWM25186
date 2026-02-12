<?php
session_start();

/* 

    EXERCICE GET : 
        Créer une page d'accueil de site ecommerce avec une liste de produit et page produit

            Etapes : 
                1 - Lancer l'instruction session_start(), cela vous donne accès à une superglobale nommée $_SESSION (c'est un array) qui peut stocker les données de votre choix et les transporter tout au long de la navigation 
                2 - Dans cette superglobale, à un indice [produits], insérer des données fictives dde produits, par exemple, id, nom, description, categorie, image (utilisez picsum pour générer des photos aléatoires) (cet array va représenter le retour d'une requête de selection en base de données)
                3 - Créer une base de page html pour créer un affichage de liste des produits représentant les produits présents dans votre array session
                4 - Rajouter un menu de votre choix permettant de choisir la catégorie de produits
                5 - Créer une communication de votre choix par GET via ce menu ou filtre pour n'afficher que les produits d'une certaine catégorie
                6 - Sur chaque affichage produit, créer un bouton qui amènera sur la fiche produit (autre page) pour n'avoir que ce produit là d'affiché (utilisation de GET ici aussi)
                7 - Une fois l'exercice terminé, lancer l'instruction session_destroy();


*/



// Initialisation du tableau de produits
// if (!isset($_SESSION['produits'])) {

// images par lorem picsum
    $_SESSION['produits'] = [
        ['id' => 1, 'nom' => 'Laptop', 'description' => 'Un puissant laptop.', 'categorie' => 'Electronique', 'image' => 'https://picsum.photos/300/200?nature'],
        ['id' => 2, 'nom' => 'T-shirt', 'description' => 'T-shirt en coton bio.', 'categorie' => 'Vêtements', 'image' => 'https://picsum.photos/300/200?dog'],
        ['id' => 3, 'nom' => 'Tablette', 'description' => 'Tablette légère et rapide.', 'categorie' => 'Electronique', 'image' => 'https://picsum.photos/300/200?computer'],
        ['id' => 4, 'nom' => 'Jeans', 'description' => 'Jean slim stretch.', 'categorie' => 'Vêtements', 'image' => 'https://picsum.photos/300/200?tv'],
    ];