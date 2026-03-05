<?php

use ProjetTransfo\Classes\Database;
use ProjetTransfo\Classes\FormValidator;
use ProjetTransfo\Classes\SessionManager;
use ProjetTransfo\Classes\User;

require_once "vendor/autoload.php";

// On start la session
SessionManager::start();


$success = "";

// On vérifie si le form est bien soumis et valide 
if (FormValidator::isSubmited() && FormValidator::isValid()) {

    // On crée un User avec les valeurs venant du form
    $user = new User(FormValidator::getAllValues());
    // var_dump($user);

    // Si le user est valide
    if ($user->IsValid()) {
        // On l'enregistre dans la bdd
        Database::registerUser($user);
        $success = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php require_once("src/partials/_navbar.php"); ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1>Inscription</h1>

                <?php 
                // Les errors sont contenus dans la classe du User
                if (isset($user) && !empty($user->getErrors())): ?>
                    <div class="alert alert-danger">
                        <ul class="m-0">
                            <?php foreach ($user->getErrors() as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if ($success): ?>
                    <div class="alert alert-success">
                        <?= $success ?>
                    </div>
                <?php endif; ?>

                <form action="" method="post">
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo</label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="text" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </form>
            </div>
        </div>
        <?php
        echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>