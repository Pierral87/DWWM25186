<?php

/* 

Le protocole GET, fait partie du protocole HTTP (le système de communication entre un client et un serveur), il est utilisé pour récupérer des informations au travers de l'URL. 
On peut récupérer ces informations en PHP 

Lorsque l'on envoie une requête GET, le client envoie une demande au serveur pour récupérer des param spécifique 

Structure d'une requête GET : 
    www.adressedemapage.com?param1=value1&param2=value2&param3=value3

    Dans cette adresse, on remarque que l'adresse de la page se poursuit jusqu'au point d'interrogation "?" au delà de ce ? on retrouvera les params définis à être transmit par le GET  ci dessus 3 param, nommés param1, param2, param3 qui ont chacun leur propre valeur.

    Je pourrais ensuite poser des conditions sur ces params pour générer des traitements spécifiques ! 

    En PHP j'ai un outil qui me permet de récupérer ces params, c'est ce qu'on appelle une SUPERGLOBALE, celle ci, nommée $_GET, c'est un tableau array comme toutes les autres super globales

    Exemples d'application de GET en PHP 
        - Récupération de données d'un formulaire (ATTENTION, les formulaires sont tous en GET par défaut, mais on préfèrera toujours les manipuler via POST)
        - Transition d'éléments dans l'URL pour afficher des produits 
        - Transition d'éléments dans l'URL pour générer des actions, type interface de gestion (liste utilisateur : action voir, modifier, supprimer)
        - Filtre de tri d'une recherche

    Avant de lancer un quelconque traitement, je fais toujours en sorte de m'assurer que j'ai toutes les informations nécessaires.

    Si je dois vérifier un param "ref" dans l'url, je commence d'abord par tester la présence de ce param grâce à isset()

    La méthode GET est un outil fondamental pour intéragir avec des ressources web, que ce soit pour afficher des pages, envoyer des param de recherche, récupérer des données d'API.

    On considère que l'on utilise GET pour des actions de type "clic" sur un lien la plupart du temps 

*/



?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="introGET.php">Eshop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="introGET.php">Accueil</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Catégories
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="?cat=info">Informatique</a></li>
                            <li><a class="dropdown-item" href="?cat=emen">Electro-Menager</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="?cat=vet">Vêtements</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container pt-5">

    <?php var_dump($_GET) ?>
        <?php if (isset($_GET["cat"])) : ?> <h1>Liste des produits de la catégorie : <?= $_GET["cat"] ?></h1>
        <?php else : ?> <h1>Choisissez une catégorie</h1>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>