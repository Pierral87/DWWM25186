
// Documentation MongoDB : https://www.mongodb.com/docs/

// Le langage de requête de MongoDB est basé sur JS et sa manipulation de fichiers Json, donc nous écrirons ce support de cours sur un fichier .js  pour profiter du code couleur de l'éditeur

// Concept d'organisation des éléments dans MongoDB
//  Base -> Collection -> Document

// La base est créée via l'interface graphique Compass ou autre (ou en général directement sur le tableau de bord de l'hébergeur)
// Ensuite on crée une collection, à l'intérieur de laquelle on insère des documents
// Créable également par la commande console : db.createCollection()   // La création à la main nous permet de définir certaines options sur la collection (voir doc)
// On peut créer un document sans créer une collection, elle sera automatiquement créée de toute façon

// Contrairement à un système de BDD Relationnelle, nous n'avons pas forcément besoin de fournir une structure à notre collection (les champs, leurs types), tout est libre et évolutif.
// La collection se contente de recevoir les documents que nous lui transmettons, peu importe leur structure
// Malgré tout, MongoDB peut forcer une structure via son système de validation de schéma

// Tout est faisable via MongoDB Compass (un peu comme PhpMyAdmin), il existe de nombreuses autres interfaces visuelles pour la manipulation de MongoDB et d'autres SGBD NoSQL

// On reprends notre base entreprise vu en MySQL, on l'export en JSON et la reimporte dans MongoDB ! 


// -----------------------------------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------------------------------
// ---------------------------- CHAPITRE 1: Les bases du langage de requête de MongoDB -----------------------------------------
// -----------------------------------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------------------------------


// ---------------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------------
// --  REQUETES D'INSERTION (On ajoute à la BDD) -----------------------------------------------
// ---------------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------------

// Pour manipuler la base entreprise dans MongoDB, j'ouvre le shell de MongoDB (c'est la console) et je sélectionne la base 
// use entreprise; 

// ATTENTION contrairement à MySQL, MongoDB est sensible à la casse !!! 
// MongoDB est aussi sensible aux types des éléments qu'on lui fournit, ce qui impacte ensuite les opérations possibles 

// On insère un nouvel employé dans la table, il faudra rafraichir Compass pour le voir 

// On dispose de deux fonctions d'insertion : 
    // insertOne() : Nous permet d'ajouter un document
    // insertMany() : Nous permet d'ajouter plusieurs documents d'un coup 

    db.employes.insertOne(
        {
            id_employes : 991,
            nom : "Lacaze",
            prenom : "Pierral",
            age : 38,
            service : "Web",
            salaire : 12000
        }
    )

    // On remarque ici que l'id mongoDB s'est auto généré 
    // Le système de génération d'id de MongoDB utilise un encodage hexadécimal contenant plusieurs informations notamment date/heure d'insertion, numéro d'insertion ce qui empêche toute possibilité de doublon d'id 

    // On insère plusieurs documents en fournissant un array 
    db.employes.insertMany(
        [
            {
                nom : "Sacquet",
                prenom : "Frodon",
                age : 45,
                service : "voyage"
            },
            {
                nom : "Legris",
                prenom : "Gandalf",
                age : 2450,
                service : "magique"
            }
        ]
    )


// ---------------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------------
// --  REQUETES DE SELECTION (On recherche dans la BDD) ----------------------------------------
// ---------------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------------

// Affichage d'un seul élément de notre collection 
db.employes.findOne();

// Affichage complet de toutes les données de la table 
db.employes.find();

// CONDITIONS / CRITERES : Selection avec une condition, équivalent au WHERE en MySQL 
// On fournit entre des {} les conditions que l'on souhaite appliquer 

// Affichage des employés du service informatique 
db.employes.find({service : "informatique"});
// C'est la même chose que SELECT * FROM employes WHERE service = "informatique";

// PROJECTION : Affichage uniquement des champs que l'on souhaite 
// Affichage des prénoms uniquement, sur la sélection du service informatique (choix de la projection des données)
db.employes.find({service : "informatique"}, {prenom : 1} ); // ici j'indique que je veux uniquement le prénom, c'est le deuxieme param de la méthode find(), je mets 1 ou true
db.employes.find({service : "informatique"}, {prenom : 1, _id : 0} ); // Ici j'indique que je ne veux pas l'_id car il est toujours apparant, je lui mets 0 ou false

// EXERCICE : Tentez d'afficher la totalité des employés en affichant uniquement leur prénom et leur service 
db.employes.find({}, {prenom : 1, service : 1});
// Si je souhaite faire une selection de champs à afficher/récupérer, sans forcément appliquer des critères de recherche, je dois fournir malgré tout le premier argument attendu à la fonction find, à savoir les accolades de selection mais sans y insérer de conditions 

// EXERCICE : Même chose mais en affichant LA LISTE des services 
db.employes.find({}, {service : 1, _id : 0}); // Pas bon, on a juste le service pour chaque document 
// SELECT DISTINCT service FROM employes;  // En MySQL 

// En MongoDB distinct est une méthode différente de find();
db.employes.distinct("service");
// Cela nous renvoie un array avec la liste des services 

// EXERCICE : Affichage du nombre de service distinct 
db.employes.distinct("service").count(); // Ne fonctionne pas, count() fait partie des méthodes des jeux de résultats json


// Affichage du nombre de personnes dans le service informatique 
db.employes.find({service : "informatique"}).count(); // Ici un count() fonctionne sur une requête normale avec find(), c'est ce qu'on appelle un cursor modifier, c'est une fonction qui nous permet d'intéragir directement sur le résultat 

db.employes.distinct("service").length; // Ici on reste dans la syntaxe JS classique, on appelle length, propriété connue de tout array en js 

// OPERATEURS DE COMPARAISON 
// MongoDB possède tout un tas d'opérateur de comparaison qui nous permettent de manipuler nos requêtes en y appliquant des critères plus complexes 

// -- $eq    est égal
// -- $ne    est différent d'une valeur (not equal)
// -- $gt    est strictement supérieur à  (greater than) 
// -- $gte   est supérieur ou égal à (greather than/equal)
// -- $lt    est strictement inférieur à (lesser than)
// -- $lte   est inférieur ou égal à (lesser than/equal)
// -- $in    est égale à une des valeurs parmis une liste (in)
// -- $nin   est différent d'au moins des valeurs parmis une liste (not in)

// EXCLUSION 
// Tous les employés d'un service, sauf un, par exemple sauf le service commercial
db.employes.find({service : {$ne : "commercial"}});

// Les employés ayant un salaire supérieur à 3000 
db.employes.find({salaire : {$gt : 3000}}, {prenom : 1, nom : 1, service : 1, salaire : 1});
db.employes.find({salaire : {$gt : "3000"}}, {prenom : 1, nom : 1, service : 1, salaire : 1});
// Attention à nos types dans notre collection... les salaires en int ? en string ?  :(  

// Notion équivalente à BETWEEN ?
// On combine plus grand et plus petit que 
// Affichage des employés ayant été embauché entre 2015 et aujourd'hui 
db.employes.find({
    date_embauche : {
        $gte : "2015-01-01",
        $lte : "2026-03-20"
    }
});

// Attention ici aussi aux types ! On devrait avoir des objets Data 
db.employes.insertOne({
    nom : "John",
    prenom : "John",
    date_embauche : new Date()
});


// IN & NOT IN pour tester plusieurs valeurs 
// Affichage des employes des services commercial et comptabilite 
db.employes.find({
    service : { $in : ["commercial", "comptabilite"]}
});

// L'inverse avec les employés ne faisant pas parti ni de commercial ni de comptabilite 
db.employes.find({
    service : { $nin : ["commercial", "comptabilite"]}
});



// Plusieurs conditions : AND 
// Il suffit de spécifier les critères de selection les uns après les autres 
// On veut les employés du service commercial ayant un salaire inférieur ou égal à 2000
db.employes.find({
    service: "commercial", 
    salaire: { $lte: "2000" }
});

// L'une ou l'autre d'un ensemble de conditions : OR 
// Affichage des employes des services commercial et comptabilite à nouveau
db.employes.find({
    $or: [
        { service: "commercial" },
        { service: "comptabilite" }
    ]
});

// EXERCICE : employes du service production ayant un salaire égal à 1900 ou 2300, VERIFIER vos résultats
db.employes.find({
    service: "production",
    $or: [
        { salaire: "1900" },
        { salaire: "2300" }
    ]
});

db.employes.find({
    service: "production",
    salaire: { $in: ["1900", "2300"] }
})



// Recherche de la valeur approchante par regex (expression regulière)  => Equivalent à LIKE en MySQL 
// Cela nous permet de rechercher une information sans l'écrire complètement 
// Affichage des prénoms commençant par la lettre "s"
db.employes.find({
    prenom: {
        $regex: "^s",
        $options: "i"  // Option "i" pour une recherche insensible à la casse
    }
});

// Affichage des prénoms finissant par les lettres "ie"
db.employes.find({
    prenom: {
        $regex: "ie$",
        $options: "i"  // Option "i" pour une recherche insensible à la casse
    }
});

// Affichage des prénoms contenant les lettres "ie" (début, fin, milieu)
db.employes.find({
    prenom: {
        $regex: "ie",
        $options: "i"  // Option "i" pour une recherche insensible à la casse
    }
});

// On a toujours besoin d'utiliser des recherches à valeur approchante, pour des champs de recherche de produits ou des filtres par exemple 


// CLASSEMENT DES RESULTATS avec sort()   --- équivalent à ORDER BY 

// Affichage des employes dans l'ordre alphabétique 
db.employes.find({}).sort({ nom: 1 });
// Par ordre alphabétique inversé 
db.employes.find({}).sort({ nom: -1 });

// Il est possible d'ordonner par plusieurs champs si jamais le premier a des valeurs similaires (par exemple à l'intérieur du bloc des 6 commerciaux, on veut ordonner ces 6 personnes en alphabétique par nom)
db.employes.find({}, {prenom : 1, nom : 1, service : 1}).sort({ service: 1, nom: 1 });

// On peut faire en sorte de renommer nos champs en manipulant la projection
db.employes.find({}, {nomComplet : {$concat: ["$nom", " ", "$prenom"]}, service : 1}).sort({ service: 1, nom: 1 });


// LIMITER UN NOMBRE DE RESULTAT avec limit() puis skip()

// Affichage des employes 3 par 3
db.employes.find({}).limit(3);

// skip() nous permet de sauter un certains nombre de résultat
db.employes.find({}).skip(3).limit(3);

db.employes.find({}).skip(6).limit(3);


// ---------------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------------
// --  REQUETES DE MODIFICATION (On modifie un ou plusieurs documents) -------------------------
// ---------------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------------

// Plusieurs fonctions sont disponibles 
// updateOne, updateMany, replaceOne

// updateOne pour modifier un seul document
//  on modifie le salaire d'un employe

// l'opérateur $set nous permet de modifier la valeur d'un champ 
db.employes.updateOne(
    { id_employes: 991 },
    { $set: { salaire: 2000 } }
)

// Plusieurs modifications sont possibles en une seule fois
db.employes.updateOne(
    { id_employes: 991 },
    {
        $set: {
            salaire: 2200,
            service: "web"
        }
    }
)

// updateMany pour modifier plusieurs documents en une seule opération
// On modifie plusieurs documents en changeant le service informatique par web
db.employes.updateMany(
    { service: "informatique" },
    { $set: { service: "web" } }
)

// replaceOne pour remplacer un document existant par un autre
// Cela efface entièrement le document d'origine pour le remplacer par le document fourni
db.employes.replaceOne(
    { id_employes: 991 },
    {
        id_employes: 991,
        prenom: "Polo",
        nom: "Lac",
        service: "vente",
        salaire: 2500
    }
)
// Contrairement à MySQL et la fonction REPLACE(), comme MongoDB ne gère pas le système de relation et contraintes, cette opération n'est pas problématique

// On peut supprimer totalement un champ d'un document avec $unset 
db.employes.updateOne(
    { id_employes: 991 },
    { $unset: { salaire: "" } }
 );
// on $set pour l'y remettre
 db.employes.updateOne(
    { id_employes: 991 },
    { $set: { salaire: 1800 } }
 );

// On peut renommer simplement un champ sans en modifier sa valeur 
// On champ le nom du champ service par departement
db.employes.updateMany(
    {},
    { $rename: { service: "departement" } }
 );
 db.employes.updateMany(
    {},
    { $rename: { departement: "service" } }
 );

// On utilise aussi souvent l'opérateur de modification $currentDate pour mettre un champ sur la valeur de l'instant T  (pas utilisable facilement lors d'une insertion et selection, donc approprié aux updates)
 db.employes.updateOne(
    { id_employes: 991 },
    { $currentDate: { date_modification: true } }
 );

 db.employes.updateOne(
    { id_employes: 991 },
    { $currentDate: { date_embauche: true } }
 );

 // ---------------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------------
// --  REQUETES DE SUPPRESSION (On supprime un ou plusieurs documents) -------------------------
// ---------------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------------

// Deux fonctions concernent les suppressions : deleteOne(), deleteMany()
// Suppression de l'employé 991 
db.employes.deleteOne({ id_employes: 991 });

// Suppression de tous les employés ayant un id supérieur à 990 
db.employes.deleteMany({ id_employes: { $gt: 990 } });

// Suppression de tous les informaticiens sauf celui possédant l'id 701
db.employes.deleteMany({
    service: "informatique",
    id_employes: { $ne: 701 }
})

// Suppression de deux employés qui n'ont pas de point commun
db.employes.deleteMany({
    id_employes: { $in: [701, 630] }
})



// --------------------------------------------------------------------------
// --------------------------------------------------------------------------
// -- EXERCICES :
// --------------------------------------------------------------------------
// --------------------------------------------------------------------------

// -- 1 -- Afficher la profession de l'employé 547.
db.employes.find({ id_employes: "547" }, { _id: 0, service: 1 })
{   service: 'commercial' }

// -- 2 -- Afficher la date d'embauche d'Amandine.	
db.employes.find({ prenom: "Amandine" }, { _id: 0, date_embauche: 1 })
{ date_embauche : "2014-01-23" }

// -- 3 -- Afficher le nom de famille de Guillaume	
db.employes.find({ prenom: "Guillaume" }, { _id: 0, nom: 1 })
{ nom : "Miller" }

// -- 4 -- Afficher le nombre de personne ayant un n° id_employes commençant par le chiffre 5.	
db.employes.count({ id_employes: { $regex: "^5" } })
db.employes.count({ id_employes: /^5/ })
3

// -- 5 -- Afficher tous les employés du service commercial.
db.employes.find({ service: "commercial" })
// { id_employes : 388, prenom : Clement, nom : Gallet, sexe : m, service : commercial, date_embauche : 2010-12-15, salaire : 2300 }
// { id_employes : 415, prenom : Thomas, nom : Winter, sexe : m, service : commercial, date_embauche : 2011-05-03, salaire : 3550 }
// { id_employes : 547, prenom : Melanie, nom : Collier, sexe : f, service : commercial, date_embauche : 2012-01-08, salaire : 3100 }
// { id_employes : 627, prenom : Guillaume, nom : Miller, sexe : m, service : commercial, date_embauche : 2012-07-02, salaire : 1900 }
// { id_employes : 655, prenom : Celine, nom : Perrin, sexe : f, service : commercial, date_embauche : 2012-09-10, salaire : 2700 }
// { id_employes : 933, prenom : Emilie, nom : Sennard, sexe : f, service : commercial, date_embauche : 2017-01-11, salaire : 1800 }

// -- 6 -- Afficher le nombre de commerciaux.
db.employes.count({ service: "commercial" })
6

// -- 7 -- Afficher les 5 premiers employés après avoir classé leur nom de famille par ordre alphabétique. 
db.employes.find().sort({ nom: 1 }).limit(5)


// -- 8 -- Afficher le nombre de recrutement sur l'année 2010.	
db.employes.find({ date_embauche: { $regex: /^2010/ } }).count()
2
    // Si jamais on était en objetDate
db.employes.find({
        date_embauche: {
          $gte: new Date("2010-01-01"),
          $lte: new Date("2010-12-31")
        }
      }).count()

// -- 9 -- Afficher tous les employés sauf ceux du service production et secrétariat.
db.employes.find({
  service: { $nin: ["production", "secretariat"] }
})

// -- 10 -- Afficher les commerciaux ayant été recrutés avant 2012 de sexe masculin et gagnant un salaire supérieur a 2500 €
db.employes.find({
    service: "commercial",
    date_embauche: { $lt: "2012-01-01" },
    sexe: "m",
    salaire: { $gt: "2500" }
  })
//   { id_employes: '415', prenom: 'Thomas', nom: 'Winter', sexe: 'm', service: 'commercial',date_embauche: '2011-05-03',salaire: '3550'}
        // En objetDate
db.employes.find({
    service: "commercial",
    date_embauche: { $lt: new Date("2012-01-01") },
    sexe: "m",
    salaire: { $gt: "2500" }
  })
// -- 11 -- Qui a été embauché en dernier
db.employes.find().sort({ date_embauche: -1 }).limit(1)
// Stephanie Lafaye 

// -- 12 -- Afficher les informations sur l'employé du service commercial gagnant le salaire le plus élevé
db.employes.find({ service: "commercial" }).sort({ salaire: -1 }).limit(1)
//   { id_employes: '415', prenom: 'Thomas', nom: 'Winter', sexe: 'm', service: 'commercial',date_embauche: '2011-05-03',salaire: '3550'}

// -- 13 -- Afficher le prénom du comptable gagnant le meilleur salaire
db.employes.find({ service: "comptabilite" } , { prenom: 1, _id: 0 }).sort({ salaire: -1 }).limit(1)
// Fabrice

// -- 14 -- Afficher le prénom de l'informaticien ayant été recruté en premier
db.employes.find({ service: "informatique" }, { prenom: 1, _id: 0 }).sort({ date_embauche: 1 }).limit(1)
// { "prenom" : "Mathieu" }

// -- 15 -- Modifier à 2800 le salaire de l'employé 990
db.employes.updateOne({ id_employes: "990" }, { $set: { salaire: "2800" } })

// -- 16 -- Modifier le service de tous les employés masculins du service "secretariat" pour le mettre à "administration".
db.employes.updateMany({ service: "secretariat", sexe: "m" }, { $set: { service: "administration" } })

// -- 17 -- Modifier le service de l'employé avec l'ID 876 pour le mettre à "communication" et son salaire à 2800.
db.employes.updateOne({ id_employes: "876" }, { $set: { service: "communication", salaire: "2800" } })

// -- 18 -- Supprimer les employés du service administration
db.employes.deleteMany({ service: "administration" })

// -- 19 -- Supprimer tous les employés dont le nom commence par "D"
db.employes.deleteMany({ nom: { $regex: "^D" } })
db.employes.deleteMany({ nom: /^D/ })

// -- 20 -- Supprimer tous les employés féminins du service "secretariat" avec un salaire inférieur à 1600.
db.employes.deleteMany({ service: "secretariat", sexe: "f", salaire: { $lt: "1600" } })


