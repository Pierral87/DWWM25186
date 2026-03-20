// -----------------------------------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------------------------------
// ---------------------------- CHAPITRE 4: INDEX ET PERFORMANCE ---------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------------------------------

// ---------------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------------
// ---------------------------------- INDEX ----------------------------------------------------
// ---------------------------------------------------------------------------------------------

// Les index sont des structures de données qui améliorent la vitesse de recherche dans une base de données en permettant un accès plus rapide aux données. 
// Ce sont en quelque sorte des sous tables qui permettent d'isoler certains champs afin de pouvoir effectuer une recherche rapide sur celle ci, pour ensuite recouper directement vers les documents concernés plutôt que de parcourir l'intégralité des données.

// Il existe différents types d'index : 

// 1 - Index Simple :
// Un index simple est créé sur un seul champ d'une collection. Il permet d'accélérer les requêtes de recherche basées sur ce champ. Par exemple, si on crée un index simple sur le champ "titre" d'une collection "produits" (contexte ecommerce), les recherches basées sur les titres seront plus rapides.

// 2 - Index Composé :
// Un index composé est créé sur plusieurs champs d'une collection. Particulièrement utile lorsque les conditions de nos requêtes concernent regulièrement plusieurs champs. 
// L'ordre des champs dans l'index composé est important, car il affecte l'efficacité de l'index.
// Dans un contexte ecommerce on pourrait supposer un index composé sur titre et prix 

// 3 - Index Géospatial :
// Les index géospatiaux sont utilisés pour les données basées sur des coordonnées géographiques (latitude et longitude). Ils permettent d'effectuer des requêtes de recherche spatiale, telles que la recherche des points à l'intérieur d'une certaine distance d'une position donnée.

// 4 - Index Texte :
// Les index texte sont conçus pour prendre en charge la recherche de texte intégral. Ils sont utiles pour les requêtes de recherche de texte dans des champs contenant des données non structurées comme des descriptions ou des commentaires.

// 5 - Index Hash :
// Un index de hachage est utilisé pour distribuer les données de manière uniforme entre les nœuds d'une grappe MongoDB. Il est principalement utile pour le sharding (partitionnement horizontal) de grandes collections.

// 6 - Index TTL (Time-To-Live) :
// Un index TTL permet de supprimer automatiquement les documents après un certain laps de temps. Cela peut être utile pour les données temporaires, comme les journaux, les sessions ou les messages.

// --------------------------------- Avantages des Index :

//     Amélioration des Performances de Recherche : Les index accélèrent les opérations de recherche en permettant à la base de données de localiser rapidement les documents correspondants sans avoir à parcourir toute la collection.

//     Optimisation des Requêtes : Les index permettent d'optimiser les requêtes en réduisant le nombre de documents à analyser. Cela peut considérablement réduire le temps de traitement des requêtes.

//     Support du Tri et des Opérations de Comparaison : Les index permettent également d'accélérer les opérations de tri et les comparaisons dans les requêtes.

///////////////////////     Meilleures Performances pour les Opérations de Jointure : Les index aident à améliorer les performances des opérations de jointure en permettant de localiser rapidement les documents liés.

//     Support des Opérations d'Aggrégation : Les index aident également à accélérer les opérations d'aggrégation en réduisant la quantité de données à analyser.

// ---------------------------------- Inconvénients des Index :

//     Espace Disque Additionnel : Les index occupent de l'espace disque supplémentaire. Plusieurs index peuvent augmenter considérablement la taille de la base de données.

//     Impact sur les Performances d'Écriture : L'ajout, la mise à jour ou la suppression de documents peut être plus lent lorsque des index sont présents, car les index doivent également être mis à jour.

//     Maintenance Nécessaire : Les index nécessitent une maintenance régulière pour rester efficaces. Si les index ne sont pas entretenus, ils peuvent devenir obsolètes et affecter les performances.

//     Choix Inapproprié d'Index : Un choix inapproprié d'index peut entraîner des performances médiocres plutôt qu'une amélioration. Les index doivent être choisis en fonction des requêtes les plus fréquentes.

//     Complexité de Gestion : Plus il y a d'index, plus leur gestion peut devenir complexe. Il faut surveiller leur utilisation, la maintenance et les ajuster si nécessaire.


// CREATION D'UN INDEX 

// Index simple
db.employes.createIndex({ nom: 1 })

// L'utilisation de l'index est automatique
db.employes.find({ nom: "Laborde" })

// Index composé 
db.employes.createIndex({ nom: 1, prenom: 1 })
db.employes.find({ nom: "Laborde", prenom: "Jean-pierre" })
// On voit que l'index n'est pas utilisé ici

// Je vais créer une autre personne s'appellant Laborde
db.employes.insertOne(
    {
        id_employes : 1010,
        nom : "Laborde",
        prenom : "Pierral",
        age : 35,
        service : "Web",
        salaire : 1800
    }
);
// Dans ce cas là on remarque bien l'utilisation de l'index composé, dans d'autres contextes par exemple ecommerce, on pourrait choisir categorie et prix par exemple, si on cherche tous les pantalons, inférieur à 50€, double recherche, d'abord tous les pantalons, ensuite le prix


// Création d'un index texte

// En supposant que sur chaque document d'employés on aurait une description de chaque employé et on souhaiterait parfois faire des recherches à l'intérieur de ces textes : 
db.employes.createIndex({ description: "text" }) // on spécifie le champ description comme étant un index de type texte

// Une fois l'index texte créé, on peux utiliser l'opérateur $text pour effectuer des recherches de texte intégral. 
// Par exemple si on recherche le mot "expérience" dans la description 
db.employes.find({ $text: { $search: "expérience" } })
// On récupèrera tous les documents pour lequel la description contient le mot "expérience"


// Bonnes Pratiques :

//     Nettoyage des Index Inutiles : Montre comment supprimer les index inutiles pour éviter d'occuper de l'espace disque et ralentir les opérations d'écriture.

//     Maintenance des Index : Explique comment MongoDB gère automatiquement la mise à jour des index lors des opérations d'écriture. Cependant, aborde également les scénarios où une maintenance manuelle des index pourrait être nécessaire.


// ------------- Autres opérations d'index : 

// 1. Affichage des Index Existants :
// Pour afficher la liste des index existants dans une collection, getIndexes()
db.employes.getIndexes()

// 2. Suppression d'Index :
// Pour supprimer un index spécifique dans une collection, dropIndex()
db.employes.dropIndex({ nom: 1 })

// 3. Suppression de Tous les Index :
// Pour supprimer tous les index de la collection, dropIndexes()
db.employes.dropIndexes()

// 4. Désactivation Temporaire d'Index :
// Désactivation temporairement un index sans le supprimer complètement, unindex(). Utile pour tester les performances des requêtes sans l'influence d'un index spécifique
db.employes.unindex({ nom: 1 })


// On peut avoir plus d'informations sur le traitement de la requête avec explain()
db.employes.find({ nom: "Laborde" }).explain("executionStats")

// "queryPlanner" : Décrit le plan d'exécution de la requête. Elle indique quel index (s'il y en a) est choisi et comment les filtres sont appliqués.
// "winningPlan" : Plan d'exécution sélectionné par MongoDB pour la requête. Cela peut être un index ou une recherche de collection.
// "rejectedPlans" : Si MongoDB envisage plusieurs plans d'exécution, cette section les répertorie. Ils sont rejetés pour différentes raisons.
// "executionStats" : Fournit des statistiques sur la manière dont la requête a été exécutée, telles que le nombre de documents analysés, le temps d'exécution, etc.
// "nReturned" : Nombre de documents retournés par la requête.
// "totalKeysExamined" : Nombre total de clés d'index examinées.
// "totalDocsExamined" : Nombre total de documents examinés (s'il n'y a pas d'index utilisé).
// "executionTimeMillis" : Temps d'exécution de la requête en millisecondes.
// "indexName" : Si un index est utilisé, le nom de l'index sera indiqué.
// "indexBounds" : Si un index est utilisé, cette section affiche les valeurs limites de l'index utilisées dans la requête.


