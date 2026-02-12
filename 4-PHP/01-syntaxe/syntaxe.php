<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrainement PHP</title>
    <style>
        h2 {
            background-color: steelblue;
            color: white;
            padding: 20px;
        }

        .container {
            width: 1000px;
            border: 1px solid;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Entrainement PHP</h2>

        <!-- 
            Il est possible d'écrire de l'html dans un fichier.php
            En revanche, l'inverse n'est pas possible !
    -->

        <?php
        // ouverture de la balise PHP

        // Ceci est un commentaire sur une seule ligne
        # Ceci est un commentaire sur une seule ligne
        /*
        Commentaire
        sur
        plusieurs lignes.
    */


        // La doc officielle :
        // https://www.php.net/

        // Les bonnes pratiques et conventions d'écriture.
        //-------------------------------------------------
        // https://phptherightway.com // en anglais
        // https://eilgin.github.io/php-the-right-way/  // en fr

        // https://www.php-fig.org/psr/

        // Pour se tenir au courant :
        // https://www.reddit.com/r/PHP


        // SOMMAIRE :
        // --------------
        // 01 - Instruction d'affichage
        // 02 - Variables : déclaration / affectation / type
        // 03 - Concaténation
        // 04 - Guillemets et apostrophes
        // 05 - Constantes
        // 06 - Conditions & opérateurs de comparaison
        // 07 - Fonctions prédéfinies
        // 08 - Fonctions utilisateur
        // 09 - Boucles
        // 10 - Inclusions
        // 11 - Tableaux de données array
        // 12 - Classes & Objets

        echo '<h2>01 - Instruction d\'affichage</h2>';
        // echo est une instruction du langage permettant de générer un affichage.

        // /!\ ATTENTION Chaque instruction en PHP doit se terminer par un ;
        echo 'Bonjour';
        echo ' à tous';
        echo '<br>';

        print 'Nous sommes mardi<br>'; // autre instruction permettant de générer un affichage, quasiment similaire à echo
        // Nous utiliserons toujours echo dans le cadre du cours
        // Il est possible de faire la concaténation avec le point ou avec la virgule
        // print n'accepte pas la concaténation avec la virgule !

        echo '<h2>02 - Variables : déclaration / affectation / type</h2>';
        // Une variable est un espace nommé permettant de conserver une valeur.
        // Une variable se déclare avec le signe $
        // Caractères autorisés :  a-z A-Z 0-9 _
        // PHP est sensible à la casse (une minuscule n'est pas équivalent à une majuscule)
        // Une variable ne peut pas commencer par un chiffre !

        // gettype() est une fonction prédéfinie (déjà inscrite au langage) permettant de nous renvoyer une chaine de caractère représentant le type d'une variable.

        $a = 123;   // Déclaration de la variable nommée 'a' et affection de la valeur numérique 123
        echo $a;
        echo gettype($a); // Integer = un entier
        echo '<br>';

        $a = 1.5; // On change la valeur contenue dans la variable $a
        echo $a;
        echo gettype($a); // double ou float = chiffre décimal
        echo '<br>';

        $a = 'Une chaine';
        echo $a;
        echo gettype($a); // string = une chaine de caractères
        echo '<br>';

        $b = true;
        echo $b; // Nous renvoie 1  car true = 1 = existe  les booléens ne sont pas sensibles à la casse, true = TRUE, false = FALSE
        echo gettype($b); // boolean // vrai ou faux // 1 ou 0
        echo '<br>';

        // Il reste deux autres types que l'on verra sur des chapitres suivants (array/object)

        echo '<h2>03 - Concaténation</h2>';
        // la concaténation consiste à assembler des chaines de caractères (sous forme de texte ou comprisent dans des variables) les unes avec les autres.
        // caractère de concaténation : le point . (il est possible d'utiliser la virgule aussi, mais seulement avec echo)
        // le caractère de concaténation peut toujours se traduire par "suivi de"

        $x = 'Bonjour';
        $y = 'tout le monde';

        // Sans concaténation :
        echo $x;
        echo ' ';
        echo $y;
        echo '<br>';

        // Avec concaténation
        echo $x . ' ' . $y . '<br>';

        // Concaténation avec la virgule seulement avec echo
        echo $x, ' ', $y, '<br>';

        // Concaténation lors de l'affectation
        $prenom = 'Pierre';
        $prenom = 'Alexandre'; // cela écrase la valeur précédente 
        echo $prenom . '<br>'; // affiche Alexandre

        // Pour rajouter sans écraser :
        $prenom2 = 'Pierre';
        $prenom2 = $prenom2 . '-Alexandre';
        echo $prenom2 . '<br>';
        // Raccourci d'écriture
        $prenom3 = 'Pierre';
        $prenom3 .= '-Alexandre'; // avec le .= on rajoute sans écraser

        echo $prenom3 . '<br>';

        echo '<h2>04 - Guillemets et apostrophes</h2>';

        $x = 'Bonjour';
        $y = 'tout le monde';

        // Dans des guillemets, une variable est reconnue et donc, est interprétée
        // Dans les apostrophes, une variable ne sera pas reconnue et donc traitée comme du texte.

        echo "$x $y <br>";
        echo '$x $y <br>';

        echo '<h2>05 - Constantes</h2>';
        // Une constante comme une variable permet de conserver une valeur.
        // En revanche, comme son nom l'indique, cette valeur restera... constante! dans l'exécution du code et ne pourra pas être modifiée dans le code
        // Par convention d'écriture, une constante s'écrit en majuscule

        //déclaration et affectation :
        // define(SON_NOM, sa_valeur);
        define("URL", 'http://www.monsite.fr');
        echo URL . '<br>';

        define('PAYS', 'France');
        echo PAYS . '<br>';

        // define('PAYS', 'Espagne'); ERREUR Warning: Constant PAYS already defined in D:\xampp\htdocs\PHP1\01-entrainement.php on line 178
        // PAYS = 'Espagne'; Parse error: syntax error, unexpected token "=" in D:\xampp\htdocs\PHP1\01-entrainement.php on line 179
        // echo PAYS . '<br>';
        // Impossible de redéfinir une constante

        // Constantes magiques
        // déjà inscrites au langage
        // /!\ deux underscores avant et après

        echo __FILE__ . '<br>'; // le chemin absolu depuis le serveur vers ce fichier
        echo __LINE__ . '<br>'; // le numéro de ligne
        echo __DIR__ . '<br>';  // le chemin vers le dossier contenant ce fichier (attention, il n'y a pas le dernier / du chemin d'accès)

        echo '<h2>Exercice variables</h2>';

        //  ---------------------- EXERCICES ------------------------------------------------
        // -----------------------------------------------------------------------------------
        // -----------------------------------------------------------------------------------
        // -----------------------------------------------------------------------------------
        // -----------------------------------------------------------------------------------
        // Créer 3 variables et leur assigner respectivement les valeurs suivantes : bleu, blanc et rouge
        // Ensuite, il faut générer un affichage avec un seul echo pour obtenir :
        // bleu - blanc - rouge
        // Il est possible de gérer le tiret dans une variable également
        // Plusieurs façons sont possibles, n'hésitez pas à en chercher plusieurs



        echo '<h2>Opérateurs arithmétiques</h2>';

        $a = 10;
        $b = 5;

        // Addition :
        echo $a + $b . '<br>'; // affiche 15
        // Soustraction :
        echo $a - $b . '<br>'; // affiche 5
        // Multiplication :
        echo $a * $b . '<br>'; // affiche 50
        // Division :
        echo $a / $b . '<br>'; // affiche 2
        // Modulo : (le restant de la vision en terme d'entier)
        echo $a % $b . '<br>'; // affiche 0
        // Puissance :
        echo $a ** $b . '<br>'; // affiche 100 000


        // Opération / affectation
        $a += $b; // équivaut à écrire $a = $a + $b;
        $a -= $b; // équivaut à écrire $a = $a - $b;
        $a *= $b; // équivaut à écrire $a = $a * $b;
        $a /= $b; // équivaut à écrire $a = $a / $b;
        $a %= $b; // équivaut à écrire $a = $a % $b;
        $a **= $b; // équivaut à écrire $a = $a ** $b;


        echo '<h2>06 - Conditions & opérateurs de comparaison</h2>';



        // if / elseif / else
        $x = 10;
        $y = 5;
        $z = 2;

        if ($x > $y) { // si la valeur de x est strictement supérieure à la valeur de y
            echo 'vrai, la valeur de x est bien strictement supérieure à la valeur de y<br>';
        } else {
            echo 'faux<br>';
        }

        // plusieurs conditions obligatoires : AND => &&
        if ($x > $y && $y > $z) {
            echo 'OK pour les deux conditions<br>';
        } else {
            echo "L'une ou l'autre des conditions ou les deux sont fausses<br>";
        }

        // L'une ou l'autre d'un ensemble de conditions : OR => ||
        if ($x > $y || $y < $z) {
            // vrai  || faux
            echo 'Ok pour au moins une des conditions<br>';
        } else {
            echo 'Toutes les conditions sont fausses<br>';
        }

        // Seulement l'une ou l'autre des conditions, si les deux sont vérifiées, c'est refusé !
        if ($x > $y xor $y < $z) {
            // vraie    // fausse
            echo "Ok une seule et unique condition<br>";
        } else {
            echo "Toutes les conditions sont fausses ou toutes les conditions sont vraies<br>";
        }

        // if elseif else
        $x = 10;
        $y = 5;
        $z = 2;

        if ($x == 8) {  // si x est égal à 8
            echo 'Réponse 1<br>';
        } elseif ($x != 10) { // si x est différent de 10
            echo 'Réponse 2<br>';
        } elseif ($y == $z) { // si y est égal à z
            echo 'Réponse 3<br>';
        } else { // sinon
            // jamais de parenthese sur un else, car il représente toutes les autres possibilités sans exception
            echo 'Réponse 4<br>';  // Réponse 4 !
        }

        // testons avec x = 8


        // Comparaison stricte
        $a1 = 1; // 1 en type numérique
        echo gettype($a1);
        echo '<br>';
        $a2 = '1'; // 1 en type string
        echo gettype($a2);
        echo '<br>';

        // comparaison des valeurs uniquement
        if ($a1 == $a2) {
            echo 'OK, ces deux variables ont la meme valeur<br>';
        } else {
            echo 'Non, ces deux variables ont des valeurs différentes<br>';
        }


        // comparaison des valeurs ET du type : Comparaison stricte
        if ($a1 === $a2) {
            echo 'OK, ces deux variables ont la même valeur ET le même type<br>';
        } else {
            echo 'Non, ces deux variables ont des valeurs et/ou des types différents<br>';
        }

        /*
            Opérateurs de comparaison
            ------------------------------
            =       affectation (ce n'est pas un opérateur de comparaison, c'est une affectation)
            ==      est égal à
            !=      est différent de
            ===     est strictement égal à (valeur et type)
            !==     est strictement différent de (valeur et/ou type différent)
            >       strictement supérieur à
            >=      supérieur ou égal à
            <       strictement inférieur à
            <=      inférieur ou égal

        */

        // Autres possibilités de syntaxe pour les if
        if ($a1 === $a2) {
            echo 'Ok, ces deux variables ont la meme valeur et le même type<br>';
        }   // Si on ne veut pas gérer le else, il est possible de l'omettre

        if ($a1 === $a2)
            echo 'Ok, ces deux variables ont la même valeur et le même type <br>';
        else
            echo 'Non, ces deux variables ont des valeurs et/ou des types différents<br>';
        // Il est possible de ne pas mettre les accolades dans le cas où il n'y a qu'une seule instruction proposée !

        if ($a1 === $a2) :
            echo 'Ok, ces deux variables ont la même valeur et le même type<br>';
        else :
            echo 'Non, ces deux variables ont des valeurs et/ou des types différents<br>';
        endif;
        // avec des : au lieu des {} et on termine par le endif;

        // écriture ternaire
        // action (question) ? .... if .... : .... else ...
        echo ($a1 === $a2) ? 'Ok, ces deux variables ont la même valeur et le même type<br>' : 'Non, ces deux variables ont des valeurs et/ou des types différents<br>';
        //---
        echo ($a1 === $a2) ? 'vrai<br>' : 'faux<br>';


        // deux outils de controle :
        // isset() & empty()
        // isset() permet de savoir si une information (variable) existe
        // empty() permet de savoir si une information (variable) existe mais va aussi vérifier si la variable est vide.

        // isset()
        // - la variable existe : on obtient true
        // - la variable n'existe pas : on obtient false

        // empty()
        // - la variable n'existe pas : on obtient true
        // - la variable existe mais ne contient rien : on obtient true

        // - la variable existe et contient quelque chose : on obtient false

        $nom = "Bob";
        if (isset($nom)) { // si la variable $nom existe je rentre ici
            echo "La variable \$nom est bien définie<br>";
        } else { // si elle n'existe pas je tombe dans le else 
            echo "La variable \$nom n'existe pas<br>";
        }

        $password = "azerty";

        if (empty($password)) {
            echo "Attention, il faut absolument saisir le password!<br>";
        } else {
            echo "Tout va bien<br>";
        }


        // $pseudoForm = "Bruce";

        // Ici raccourci d'un if isset en ternaire, si $pseudoForm existe alors il sera affecté dans $pseudo, sinon ce sera la valeur "Pas de pseudo" qui sera insérée dans cette var
        $pseudo = $pseudoForm ?? "Pas de pseudo";

        echo "<hr>";
        echo $pseudo;

        // Valeurs considérées comme vide : 0, 0.0, false, FALSE, null, -0, '', "", tableau array vide 

        // isset() - très régulièrement utilisé pour vérifier que l'on reçoit bien les variables nommées de façon attendu par rapport à notre et qu'aucune n'est manquante
        // empty() - très régulièrement utilisé pour vérifier si un élément à saisi obligatoire ou un élément de vérification est vide ou au contraire n'est pas vide ! 


        echo '<h2>Conditions switch</h2>';
        // autre outil permettant de mettre en place des conditions

        // Avec une condition switch on donne un ensemble de cas (case) possibles

        $couleur = 'jaune';
        switch ($couleur) {
            case 'bleu':
                echo 'Vous aimez le bleu<br>';
                break;
            case 'rouge':
                echo 'Vous aimez le rouge<br>';
                break;
            case 'vert':
                echo 'Vous aimez le vert<br>';
                break;
            default: // équivalent au else
                echo "Vous n'aimez ni le bleu, ni le rouge, ni le vert.<br>";
                break; // break non obligatoire car la fin de l'accolade marquera la fin du cas par default
        }

        // EXERCICE : refaire cette condition avec if / elseif / else
        // ----------------------------------------- EXERCICES ---------------------------------
        // --------------------------------------------------------------------------------------
        // --------------------------------------------------------------------------------------
        // --------------------------------------------------------------------------------------
        // --------------------------------------------------------------------------------------

        echo '<h2>08 - Fonctions prédéfinies</h2>';

        // Inscrites au langage, le développeur ne fait que l'exécuter (comme le gettype vu plus haut)
        // https://www.php.net/manual/fr/indexes.functions.php
        // Pour utiliser une fonction, nous devons connaitre le nombre d'argument à fournir et dans quel ordre
        // Et surtout quelle sera la valeur de retour (la réponse) de la fonction

        // Quelques exemples :

        // Fonction date()
        // Permet d'afficher la date du jour notamment en choisissant le format attendu
        // Il est possible de gérer le format d'une autre date que celle du jour (en fournissant un argument facultatif)

        // https://www.php.net/manual/fr/function.date.php
        // https://www.php.net/manual/fr/datetime.format.php (pour voir les formats disponibles)

        date_default_timezone_set('Europe/Paris'); // permet de forcer le fuseau horaire concerné

        echo 'Nous sommes le : ' . date('d/m/Y') . ', et il est : ' . date('H:i:s') . '<hr>';

        echo 'Copyright &copy; ' . date('Y') . '<hr>';

        // Argument à fournir : une chaine de caractère représentant le format de date attendu
        // Valeur de retour : une chaine de caractère représentant la date au format demandé


        echo date('d/m/Y', strtotime('22-09-2008')) . '<hr>'; // strtotime permet de convertir en time stamp, une date indiquée

        // Fonctions de traitement de chaine de caractères

        // strlen() / iconv_strlen()
        // Fonction prédéfinie permettant de compter le nombre de caractère dans une chaine

        echo strlen('bôñjôùr') . '<br>';
        // /!\ strlen() compte en réalité le nombre d'octet (avec utf-8 les caractères spéciaux valent plus d'un octet)
        // Pour être sûr d'avoir la bonne taille, on va priviléger iconv_strlen(), cette fonction comptera au sens propre le nombre de caractère.

        // https://www.php.net/manual/fr/function.iconv-strlen
        // argument à fournir : 
        // la chaine que l'on veut compter

        // Valeur de retour :
        // Succès : un entier (int)
        // Echec : false

        echo iconv_strlen('bôñjôùr') . '<br>';


        $pseudo = 'admin';

        echo 'Taille de la chaine contenue dans la variable pseudo : ' . iconv_strlen($pseudo) . '<hr>';

        // Dans quel cas cela serai utile ?

        // On veut une taille entre 4 et 14 inclus
        // faire avec un && d'abord pour montrer l'erreur
        if (iconv_strlen($pseudo) < 4 || iconv_strlen($pseudo) > 14) {
            echo '<div style="background-color:red; color: white; padding:20px;">Attention, le pseudo doit avoir entre 4 et 14 caractères inclus !!! <br> Veuillez vérifiez vos saisies.</div><hr>';
        } else {
            echo '<div style="background-color:green; color: white; padding:20px;">Taille ok !</div><hr>';
        }

        //strpos()
        // https://www.php.net/manual/fr/function.strpos.php
        // permet de chercher une chaine dans une autre chaine
        // Valeurs de retour :
        // Succes : un entier (int) représentant la position
        // Echec : false (ça n'a pas été trouvé)

        $email = 'mail@mail.fr';
        echo 'position du caractère @ dans la chaine de la variable email : ' . strpos($email, '@') . '<br>';

        $email2 = 'hello';
        echo 'position du caractère @ dans la chaine de la variable email2 : ' . strpos($email2, '@') . '<br>';
        // Dans cette dernière instruction, strpos() n'affiche rien
        // en réalité on obtient false
        // Pour voir le false nous pouvons utiliser une instruction d'affichage améliorée :
        // var_dump() ou print_r()
        // Ces deux outils sont pour le développeur, ce sont des outils de debuggage

        var_dump(strpos($email2, '@')); // type / valeur (sur wamp nous avons des informations supplémentaires)

        // Ici on se sert du retour de la fonction strpos (qui nous retourne un integer ou false) pour savoir si il y a bien un @ dans la chaine et donc si notre email est valide
        // la fonction is_integer me retourne true si l'argument fourni est bien de type integer et false si ce n'est pas le cas.
        // si strpos m'a bien retourné un integer, is_integer me retourne true et donc je rentre dans le if, sinon dans le else.
        // Cependant, bonne pratique veut, qu'on isole dans le if, le cas d'erreur (et non pas le cas valide), donc pour inverser le fonctionnement de la fonction is_integer, on rajoute simplement un point d'exclamation devant le nom de la fonction !is_integer
        // Donc, !is_integer me retournera true si l'argument fourni n'est justement PAS un integer, la question qui est posée devient "Est ce que ce n'est PAS un integer ?"
        if (!is_integer(strpos($email, '@'))) {
            echo "l'email ne contient pas de @, probleme !<hr>";
        } else {
            echo "l'email est valide il contient bien un @<hr>";
        }


        echo '<hr>';

        // substr()
        // https://www.php.net/manual/fr/function.substr.php
        // Cette fonction permet de découper une chaine de caractère
        $phrase = 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. A ab quisquam accusantium animi ad modi eius qui, odio aperiam adipisci iure incidunt dolore voluptatem delectus ipsam suscipit. Mollitia, cumque commodi.';

        // substr(chaine, position_de_depart, nb_de_caractère)
        // substr(chaine, position_de_depart) // avec deux arguments uniquement, on récupère tout depuis la position de départ

        echo substr($phrase, 0, 56) . '... <a href="">Lire la suite</a><hr>';

        // str_replace()
        // https://www.php.net/manual/fr/function.str-replace
        // permet de remplacer un élément par un autre dans une chaine de caractère
        // Valeurs de retour :
        // Succes : un string ou array
        // Echec : false 

        $colonne = 'id_employe';
        echo ucfirst(str_replace('_', ' ', $colonne));
        // Ici je remplace les _ de $colonne par des espaces et ucfirst permet de passer la premirere lettre en majuscule 

        // Les fonctions de test 
        // is_int, is_array, is_bool, is_string, is_numeric 

        // str_replace permet de remplacer un carac par un autre dans une chaine 
        // preg_replace permet de remplacer plusieurs carac en fonction d'une expression regulière (regex) par un autre 

        // ucfirst() permet de mettre en majuscule la première lettre d'un string 


        echo '<h2>08 - Fonctions utilisateur</h2>';

        // déclarées et exécutées par le développeur

        separateur();   // Il est possible d'executer une fonction avant sa déclaration

        // Fonction toute simple permettant d'afficher 3<hr>
        // déclaration
        function separateur()
        {
            echo '<hr><hr><hr>';
        }

        // Exécution :
        separateur();
        separateur();

        // fonction avec argument (param / parametre / variable de réception)
        // fonction permettant de dire bonjour à l'utilisateur
        function dire_bonjour($qui)
        {
            return 'Bonjour ' . $qui . ', bienvenue sur notre site <hr>';
        }
        // return représente la réponse de la fonction

        // exécution
        // avec un return, c'est à nous d'appeler echo si l'on souhaite un affichage
        echo dire_bonjour('Pierre-Alex');
        echo dire_bonjour('Jack');
        $prenom = 'Jimmy';
        echo dire_bonjour($prenom);

        // fonction permettant de calculer le prix ttc
        function applique_tva($prix)
        {
            return 'Le montant ttc pour le prix ' . $prix . ' est de : ' . ($prix * 1.2) . ' €<hr>'; // pour une tva à 20%
        }

        echo applique_tva(1000);
        echo applique_tva(500);
        echo applique_tva(987987987987);


        // Exercice : refaire une fonction similaire (applique_tva_taux) permettant de choisir aussi le taux de tva à appliquer. 
        // Dans un second temps, faire en sorte que le taux soit facultatif à la saisie, c'est à dire par defaut 20% si l'utilisateur ne défini pas le param taux 

        // -------------------- EXERCICES ----------------------------------------------------------------------
        // ---------------------------------------------------------------------------------------------------------
        // ---------------------------------------------------------------------------------------------------------
        // ---------------------------------------------------------------------------------------------------------


        // fonction pour afficher la meteo
        function meteo($saison, $temperature)
        {
            $debut = 'Nous sommes en ' . $saison;
            $suite = ' et il fait ' . $temperature . ' degré(s)<hr>';

            return $debut . $suite;
        }

        separateur();

        echo meteo('été', 35);
        echo meteo('printemps', 21);
        echo meteo('hiver', 0);
        echo meteo('automne', 10);

        // EXERCICE : refaire cette fonction en gérant l'article "en" ou "au" selon la saison et le "s" sur degré selon la valeur de temperature.
        // -------------------- EXERCICES ----------------------------------------------------------------------
        // ---------------------------------------------------------------------------------------------------------
        // ---------------------------------------------------------------------------------------------------------
        // ---------------------------------------------------------------------------------------------------------





        // ENVIRONNEMENT (scope)
        // Global : le script complet
        // Local : à l'intérieur d'une fonction

        // L'existence d'une variable dépend de l'environnement où on la déclare
        // Une variable déclarée dans un espace local (dans les accolades de la déclaration d'une fonction), n'existe QUE dans cette fonction.

        separateur();

        $animal = 'chat'; // variable déclarée dans l'espace global
        echo $animal . '<br>';

        function foret()
        {
            $animal = 'chien'; // variable déclarée dans l'espace local
            return $animal;
        }

        echo $animal . '<br>';
        foret();
        echo $animal . '<br>';
        echo foret() . '<br>';
        echo $animal . '<br>';

        $pays = "France"; // variable déclarée dans l'espace global

        function affiche_pays()
        {
            global $pays; // avec le mot clé global, il est possible de récupérer une variable de l'espace global pour la ramener dans la fonction
            $pays = "Espagne";
        }

        echo $pays; // France (je n'ai pas encore exécuté ma fonction)

        affiche_pays(); // On lance la fonction affiche_pays donc la variable globale $pays se retrouve affecté de la valeur "Espagne" 

        echo $pays; // Affiche Espagne

        // phpinfo(); // toutes les informations sur notre version de PHP

        separateur();

        // Il est possible de typer les arguments d'une fonction ainsi que son return
        function identite(string|null $nom, int $age = 35, int $cp = 75000): string
        {
            return $nom . " a " . $age . "ans et habite dans le $cp<br>";
        }

        echo identite("Pierra", 37);
        // echo identite(150, "Bob"); ERREUR, il n'accepte pas Bob (string) 
        // Depuis PHP 8 on peut aussi appeler les arguments par leur nom, ce qui évite de tous les citer (surtout lorsque l'on a plusieurs arguments facultatifs et que l'on ne veut en renseigner qu'un seul ou certains)
        echo identite(nom: "lolo", cp: 47000);



        echo '<h2>09 - Structure itérative : Boucles</h2>';

        // Boucle for = boucle avec compteur numérique 
        // Besoin de 3 informations 
        // - Une valeur de départ (compteur)
        // - Une condition d'entrée
        // - Une incrémentation ou une décrémentation 

        // for(valeurDeDepart; condition ; incrementation) {}
        for ($i = 0; $i < 10; $i++) {
            echo $i . ' ';
        }

        separateur();
        // Boucle while = boucle en fonction d'une condition (pas forcément numérique)
        // while() {}
        $i = 0; // valeur de départ
        while ($i < 10) { // condition d'entrée
            echo $i . ' ';
            $i++; // incrémentation
        }

        separateur();
        // Il est possible de sortir d'une boucle avec le mot clé break;
        $i = 0;
        while ($i < 100) {
            echo $i . ' ';
            if ($i == 20) {
                break; // on sort de la boucle
            }
            $i++;
        }

        separateur();

        // Exercice...
        $i = 0;
        while ($i < 10) {
            echo $i . ' - ';
            $i++;
        }

        // -------------------- EXERCICES ----------------------------------------------------------------------
        // ---------------------------------------------------------------------------------------------------------
        // ---------------------------------------------------------------------------------------------------------
        // ---------------------------------------------------------------------------------------------------------
           // EXERCICE : Modifier cette boucle afin de ne pas avoir le dernier tiret d'affiché
        // Actuel : 0 - 1 - 2 - 3 - 4 - 5 - 6 - 7 - 8 - 9 -
        // Attendu : 0 - 1 - 2 - 3 - 4 - 5 - 6 - 7 - 8 - 9 

        
        // Exercice 1
        // Afficher des nombres allant de 1 à 100.

        // Exercice 2
        // Afficher des nombres allant de 1 à 100 avec le chiffre 50 en rouge.

        // Exercice 3
        // Afficher des nombres allant de 2000 à 1930.

        // Exercice 4
        // Afficher le titre suivant 10 fois : <h1>Titre à afficher 10 fois</h1>

        // Exercice 5
        // Afficher le titre suivant "<h1>Je m'affiche pour la Nème fois</h1>".
        // Remplacer le N avec la valeur de $i (tour de boucle).


        

        echo '<h2>10 - Tableaux de données ARRAY</h2>';
        // Array est un nouveau type de données 
        // Une variable de type array, nous permet de conserver un ensemble de valeur 
        // Un array c'est toujours composé de deux colonnes 
        // Une colonne représentant l'index/indice/id/key 
        // Une colonne représente la valeur associée à cet index 

        // Pour piocher dans un tableau array, on appelera toujours l'index pour récupérer la valeur

        // Déclaration d'un tableau array
        $tab_jours = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi');

        // Pour voir l'intégralité d'un tableau array, on ne peut pas utiliser echo
        // echo $tab_jours; // Erreur : Array to string conversion

        // Deux outils de controle pour vérifier le contenu des array, var_dump et print_r 
        // Ces deux outils nous permettent de visualiser les clés et les valeurs

        // var_dump();
        echo '<pre>';
        var_dump($tab_jours);
        echo '</pre>';
        // array(5) {
        //     [0]=>
        //     string(5) "lundi"
        //     [1]=>
        //     string(5) "mardi"
        //     [2]=>
        //     string(8) "mercredi"
        //     [3]=>
        //     string(5) "jeudi"
        //     [4]=>
        //     string(8) "vendredi"
        //   }

        // print_r()
        echo '<pre>';
        print_r($tab_jours);
        echo '</pre>';
        // Array
        // (
        //     [0] => lundi
        //     [1] => mardi
        //     [2] => mercredi
        //     [3] => jeudi
        //     [4] => vendredi
        // )

        // Il n'est pas possible d'afficher un tableau array complet avec un echo, en revanche, nous pouvons piocher dedans en appelant l'indice correspondant

        // EXERCICE : affichez "mercredi" en piochant dans le tableau array tab_jours
        echo $tab_jours[2] . '<br>';

        // Pour rajouter un ou des éléments en fin de tableau : array_push()
        // array_push(le_tableau, nouvelle_valeur)
        // array_push(le_tableau, nouvelle_valeur, autre_valeur, ...)
        array_push($tab_jours, 'samedi', 'dimanche');
        echo '<pre>';
        print_r($tab_jours);
        echo '</pre>';
        //  Array
        // (
        //     [0] => lundi
        //     [1] => mardi
        //     [2] => mercredi
        //     [3] => jeudi
        //     [4] => vendredi
        //     [5] => samedi
        //     [6] => dimanche
        // )

        // On dispose de array_unshift pour ajouter des elements en debut de tableau
        // on peut utiliser unset pour supprimer un élément d'un tableau array

        // Eventuellement pour ajouter un element en milieu de tableau indexé numériquement 
        // https://www.php.net/manual/fr/function.array-splice
        // $original = array('a', 'b', 'c', 'd', 'e');
        // $inserted = array('x'); // Pas forcément besoin que ce soit un array

        //Autres façons de déclarer un tableau
        $tab_mois = ['janvier', 'fevrier', 'mars', 'avril'];

        echo '<pre>';
        print_r($tab_mois);
        echo '</pre>';
        /*
        Array
        (
            [0] => janvier
            [1] => février
            [2] => mars
            [3] => avril
        )
        */

        // autres façons pour rajouter des éléments
        $tab_mois[] = 'mai';
        $tab_mois[] = 'juin';
        echo '<pre>';
        print_r($tab_mois);
        echo '</pre>';

        $tab_fruits[] = 'fraises'; // la première ligne crée le tableau
        $tab_fruits[] = 'pommes'; // Les lignes suivantes ajoutent des éléments
        $tab_fruits[] = 'poires';
        $tab_fruits[] = 'abricots';
        $tab_fruits[] = 'ananas';


        echo '<pre>';
        print_r($tab_fruits);
        echo '</pre>';

        // Pour connaitre la taille d'un tableau :
        // count() ou sizeof()
        echo 'Taille du tableau contenant les fruits : ' . count($tab_fruits) . '<br>';
        echo 'Taille du tableau contenant les fruits : ' . sizeof($tab_fruits) . '<br>';

        // Affichage du tableau tab_fruits dans une liste ul li
        echo '<ul>';
        $i = 0;
        while ($i < count($tab_fruits)) {
            echo '<li>' . $tab_fruits[$i] . '</li>';
            $i++;
        }
        echo '</ul>';

        separateur();

        echo '<ul>';
        for ($i = 0; $i < count($tab_jours); $i++) {
            echo '<li>' . $tab_jours[$i] . '</li>';
        }
        echo '</ul>';

        separateur();

        // Il est possible de choisir nous-même les index et aussi d'avoir des index en chaine de caractère
        $membre = array('pseudo' => 'Admin', 'email' => 'admin@mail.fr', 'age' => 35, 'date_inscription' => '2001-03-14');

        echo '<pre>';
        var_dump($membre);
        echo '</pre>';
        echo '<pre>';
        print_r($membre);
        echo '</pre>';

        //  Array
        // (
        //     [pseudo] => Admin
        //     [email] => admin@mail.fr
        //     [age] => 35
        //     [date_inscription] => 2001-03-14
        // )

        // Il est aussi possible de rajouter en choisissant l'indice
        $membre['ville'] = 'Paris';
        $membre['cp'] = 75000;
        $membre['adresse'] = '1, rue du truc';

        echo '<pre>';
        print_r($membre);
        echo '</pre>';

        // Pour piocher une seule information, on appelle l'indice en chaine de caractère
        echo $membre['pseudo'] . '<br>';

        // Sur ce dernier tableau, les index sont en toutes lettres, il n'est donc pas possible de faire une boucle avec for() ou while() car on ne peut pas récupérer l'indice en le représentant par le compteur $i

        // Boucle foreach spécifique aux tableaux array et aux objets
        // La boucle foreach permet de parcourir l'intégralité d'un tableau

        // Deux syntaxes possibles, l'une nous permettra de récupérer uniquement les valeurs contenu à chaque indice du tableau array, l'autre syntaxe nous permettra de récupérer aussi bien les valeurs, que les indices eux même
        separateur();

        foreach ($membre as $v) { // une seule variable après le mot clé obligatoire AS, cette variable reçoit la valeur en cours à chaque tour de boucle
            echo '- ' . $v . '<br>';
        }

        separateur();

        foreach ($membre as $ind => $v) { // deux variables séparées par la flèche des tableaux array (=>) après le mot clé obligatoire AS, la première variable ($ind) reçoit l'indice en cours et la deuxième ($v) reçoit la valeur en cours à chaque tour de boucle
            echo '- ' . $ind . ' : ' . $v . '<br>';
        }
        // l'intérêt de récupérer les indices n'est pas forcément pour les afficher, mais plutôt pour appliquer un traitement différent en fonction de l'indice
        // Par exemple, si je récupère une image, au lieu de faire un simple echo, il faudra que je fasse un echo avec une balise <img>
        // Ou bien, si je ne souhaite pas afficher certains indices je peux donc ajouter une condition pour les ignorer

        // Il est possible d'avoir un ou des tableaux dans un tableau
        // Tableau array multidimensionnel

        $panier = array('numero_produit' => array(14, 37, 54), 'prix' => array(35, 40.5, 84), 'quantite' => array(1, 3, 2), 'titre_produit' => array('pantalon', 'chaussettes', 'veste'));

        /*
        $panier = array(
                        'numero_produit' => array(
                                                    14, 
                                                    37, 
                                                    54), 
                        'prix' =>           array(
                                                    35, 
                                                    40.5, 
                                                    84), 
                        'quantite' =>       array(
                                                    1, 
                                                    3, 
                                                    2), 
                        'titre_produit' =>  array(
                                                    'pantalon', 
                                                    'chaussettes', 
                                                    'veste'));
        */

        echo '<pre>';
        print_r($panier);
        echo '</pre>';

        // Pour piocher dans un tableau array multi : succession de crochet pour passer dans les différents niveaux du tableau.
        echo $panier['titre_produit'][1] . '<br>';