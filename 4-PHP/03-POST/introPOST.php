<?php



/*

Le protocole POST est l'un des deux principaux protocoles utilisés pour envoyer des données d'un navigateur web vers un serveur, l'autre étant GET. Contrairement à GET, qui envoie les données dans l'URL, POST les envoie dans le corps de la requête HTTP, ce qui permet de transmettre des informations plus volumineuses et plus sensibles de manière plus sécurisée.
Utilisation du protocole POST en PHP

    Transmission de données : Le protocole POST est principalement utilisé pour envoyer des données qui ne doivent pas être visibles dans l'URL ou qui contiennent beaucoup d'informations, comme :
        Formulaires contenant des informations personnelles (login, inscription, paiement).
        Téléchargement de fichiers.
        Soumission de données qui modifient un état sur le serveur (par exemple : création de compte, modification de profil, ajout d’un produit, etc.).

    Sécurisation des données :
        POST est privilégié pour l'envoi de données sensibles, car les informations ne sont pas affichées dans l'URL (contrairement à GET). Bien qu'elles ne soient pas chiffrées par défaut (sauf si un certificat SSL est utilisé), elles ne sont pas visibles par l'utilisateur dans la barre d'adresse, ce qui offre un certain degré de protection.
        C’est aussi préférable pour des données volumineuses, car il n’y a pas de limite stricte à la taille des données envoyées en POST (contrairement à GET qui est limité par la longueur maximale des URL).

        En PHP, lorsque vous utilisez un formulaire avec la méthode POST, vous accédez aux données soumises via la superglobale $_POST.

Points importants à noter avec POST

    Taille des données :
        Le protocole POST permet d’envoyer des données volumineuses. Par exemple, un formulaire avec de nombreux champs ou des fichiers peut être envoyé par POST sans les restrictions liées à la longueur des URL, qui limitent GET.
        Attention cependant à la limite de taille des données définie par le serveur (variable post_max_size dans php.ini).

    Visibilité des données :
        Avec POST, les données ne sont pas affichées dans l’URL, ce qui est un avantage en termes de sécurité pour des informations sensibles comme des mots de passe ou des numéros de carte bancaire. Toutefois, il faut toujours utiliser un protocole HTTPS pour protéger les données en transit.

    Côté serveur : $_POST :
        PHP reçoit et traite les données envoyées via POST en utilisant la superglobale $_POST, un tableau associatif contenant les valeurs des champs du formulaire (ex. $_POST['name']).
        
*/

// echo $_POST["name"];

// En PHP, nous n'avons pas de console log, donc il faut bien comprendre parfois quelles sont les informations que l'on manipule ???

// Pour ça, on utilisera deux instructions de vérification présentes dans le langage natif de PHP à savoir var_dump ou print_r

// Dans le cas d'un tableau array, var_dump va me retourner la totalité du contenu du array, c'est à dire je pourrais visualiser les clés et leurs valeurs, cela me permet de comprendre déjà ici dans le cas du formulaire, si mon formulaire est bien conçu et si j'en récupère les bonnes clés et valeurs 

var_dump($_POST);

// print_r($_POST);

// var_dump($_SERVER);

$content = "";


// Bonne manière de gérer un formulaire 
// D'abord première étape, faire la vérification de REQUEST_METHOD = POST cela permet de s'assurer que le formulaire est bien validé depuis notre propre serveur
// Deuxième étape, s'assurer que tous les champs que l'on manipulera plus tard, sont bien présents dans le POST 
    // Pourquoi ? Car une manipulation du html via l'inspecteur pourrait me priver d'accès à ces indices et induire des erreurs undefined par la suite 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"], $_POST["email"], $_POST["message"])) {

// Une fois la vérification faites, bonne pratique veut que je définisse des variables pour chacun des indices du POST
// Je peux en profiter pour appliquer des contrôles sur les saisies (dépendant du contexte, par exemple, une inscription, longueur de pseudo, format email, longueur password etc)

// Ici j'applique seulement un trim()  qui supprime les espaces accidentels en début et fin de chaine de caractères
    $nom = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    // echo $nom;
    // echo $email;
    // echo $message;

        $content = "
    <div class='card'>
        <div class='card-header bg-primary text-white'>
            <h5>Informations reçues</h5>
        </div>
        <div class='card-body'>
            <p><strong>Nom :</strong> $nom</p>
            <p><strong>Email :</strong> $email</p>
            <p><strong>Message :</strong> $message</p>
        </div>
    </div>";
}


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire avec POST</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1>Contactez-nous</h1>

                <form action="" method="post" class="mb-4">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>

                <?= $content ?>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>