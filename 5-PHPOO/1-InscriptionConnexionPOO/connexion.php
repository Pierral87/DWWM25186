<?php

use ProjetTransfo\Classes\Authenticator;
use ProjetTransfo\Classes\SessionManager;
use ProjetTransfo\Classes\FormValidator;
use ProjetTransfo\Classes\User;

require_once "vendor/autoload.php";

SessionManager::start();

$loginError = "";
$loginSuccess = ""; // Message de connexion réussie

if (FormValidator::isSubmited() && FormValidator::isLoginValid()) {


    $user = new User(FormValidator::getAllValues());

    if (Authenticator::accountExist($user)) {

        if (Authenticator::checkPassword($user)) {
            $loginSuccess = "Connexion réussie. Bienvenue, " . $user->getPseudo() . " !";
        } else {
            $loginError = "Pseudo ou mot de passe incorrect.";
        }
    } else {
        $loginError = "Pseudo ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php require_once("src/partials/_navbar.php"); ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1>Connexion</h1>

                <?php if ($loginError): ?>
                    <div class="alert alert-danger"><?= $loginError ?></div>
                <?php endif; ?>

                <?php if ($loginSuccess): ?>
                    <div class="alert alert-success"><?= $loginSuccess ?></div>
                <?php endif; ?>

                <form action="" method="post">
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo</label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </form>
            </div>
        </div>
        <?php var_dump($_SESSION); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>