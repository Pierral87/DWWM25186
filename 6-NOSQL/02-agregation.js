// -----------------------------------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------------------------------
// ---------------------------- CHAPITRE 2: Agrégation de données  -------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------------------------------


// ---------------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------------
// ---------------------------------- AGREGATION -----------------------------------------------
// ---------------------------------------------------------------------------------------------
// Les fonctions d'agrégation dans MongoDB sont des outils spéciaux pour trier, filtrer et calculer des données à partir de plusieurs éléments/documents. On les utilise pour répondre à des questions difficiles sur nos données, comme "quel est le salaire le plus bas ?" ou "combien de gens font telle chose ?". Contrairement aux opérations de requête traditionnelles, qui renvoient souvent des documents individuels, les agrégations permettent de traiter des ensembles de documents en appliquant une série d'opérations de traitement.
// Ces outils nous permettent de comprendre les données en extrayant des informations importantes sans avoir à tout parcourir manuellement.

// On utilise ce qu'on appelle un "pipeline" d'agrégation, c'est en gros une séquence ordonnée de plusieurs étapes de traitements, chaque étape effectue une opération spécifique et produit un résultat intermédiaire qui est transmis à l'étape suivante.

// On va manipuler ici non plus find()  mais aggregate()   avec une structure un peu différente, le but étant d'appliquer des traitements/calculs sur un ensemble d'élément avant d'afficher quoi que ce soit, par exemple des opérations mathématiques, des sommes, des moyennes, des valeurs min/max sur la totalité des valeurs d'un champ, etc 

/*  
db.employes.aggregate([
    // Filtrage des documents, application des critères avec l'opérateur $match
  { $match: {} },
    // Choix d'un opérateur d'agreg, souvent $group
  { $operateuragreg : {}}, 
    // ordonner les résultats
  { $sort: {}},
    // choisir quels sont les champs à projeter 
  { $project: {}} // pour la projection des champs 
]) 
et ensuite des cursors modifior tels que limit, skip, etc 
*/

// Affichage des employés et de leur salaire annuel 
db.employes.aggregate([
    {
        $project: {
            _id: 0,
            prenom: 1,
            nom: 1,
            service: 1,
            salaire_annuel: { $multiply: ["$salaire", 12] }
        }
    }
]);
// Mince mes salaires sont en string
db.employes.aggregate([
    {
        $project: {
            _id: 0,
            prenom: 1,
            nom: 1,
            service: 1,
            salaire_annuel: { $multiply: [{ $toDouble: "$salaire" }, 12] }
        }
    }
]);

// Ici l'opérateur $project permet simplement de définir la projection de mes champs
// On utilisera ensuite l'opérateur $multiply pour appliquer une multiplication à un champ spécifique

// La masse salariale annuelle de l'entreprise grâce à $sum
db.employes.aggregate([
    {
        $project: {
            _id: 0,
            salaire_annuel: { $multiply: [{ $toDouble: "$salaire" }, 12] }
        }
    },
    // Groupement pour calculer la somme des salaires annuels
    {
        $group: {
            _id: null, // Grouper tous les documents, cet _id va représenter grosso modo par quels champs sont regrouper mes éléments, ici aucun regroupement direct, ma requête concerne tous les documents
            masse_salariale: { $sum: "$salaire_annuel" } // Calculer la somme des salaires annuels
        }
    }
]);

// Affichage du salaire moyen de l'entreprise grâce à  $avg 
db.employes.aggregate([
    {
        $project: {
            _id: 0,
            salaire: { $toDouble: "$salaire" }
        }
    },
    {
        $group: {
            _id: null,
            salaireMoyen: { $avg: "$salaire" }
        }
    }
]);

// La même chose mais arrondie à l'entier grâce à $round
db.employes.aggregate([
    {
        $group: {
            _id: null,
            salaireMoyen: { $avg: { $toDouble: "$salaire" } }
        }
    },
    {
        $project: {
            _id: 0,
            salaireMoyenArrondi: { $round: ["$salaireMoyen"] }
        }
    }
]);

// Avec le choix du nombre de décimale
db.employes.aggregate([
    {
        $group: {
            _id: null,
            salaireMoyen: { $avg: { $toDouble: "$salaire" } }
        }
    },
    {
        $project: {
            _id: 0,
            salaireMoyenArrondi: { $round: ["$salaireMoyen", 4] }
        }
    }
]);

// Affichage du salaire minimum de l'entreprise grâce à $min
db.employes.aggregate([
    {
        $group: {
            _id: null,
            salaireMin: { $min: { $toDouble: "$salaire" } }
        }
    }
]);

// Affichage du salaire maximum de l'entreprise grâce à $max 
db.employes.aggregate([
    {
        $group: {
            _id: null,
            salaireMax: { $max: { $toDouble: "$salaire" } }
        }
    }
]);

// Regrouper par un champ spécifique plutôt que "null" pour tous les enregistrements
// Nombre d'employés par service
db.employes.aggregate([
    {
        $group: {
            _id: "$service",
            nombreEmployes: { $sum: 1 } // Compte 1 à chaque enregistrement rencontré, cela fait +1 +1 +1 +1, on pourrait faire +2 en metant 2
        }
    }
])

db.employes.aggregate([
    {
        $group: {
            _id: "$service",
            nombreEmployes: { $count: {} }  // Compte le nombre total de documents dans chaque groupe
        }
    }
])

db.employes.aggregate([
    {
        $group: {
            _id: "$service",
            nombreEmployes: { $count: {} }
        }
    },
    {
        $sort: { _id: 1 }  // Trie les résultats par ordre alphabétique du champ _id (service)
    }
])


// Si je souhaite mettre une condition sur l'affichage des services ayant plus de 2 employés
db.employes.aggregate([
    {
        $group: {
            _id: "$service",
            nombreEmploye: { $count: {} }
        }
    },
    {
        $match: {
            nombreEmploye: { $gt: 2 }
        }
    },
    {
        $project: {
            service: "$_id",
            nombreEmploye: 1,
            _id: 0
        }
    },
    {
        $sort: { service: 1 }  // Trie les résultats par ordre alphabétique du champ _id (service)
    }
    ,
    {
      $limit: 5  // Limite le nombre de résultats renvoyés à 5
    }
])

// Et on pourrait encore ajouter un étage à notre pipeline avec un $limit, etc etc 

// Egalement il existe des opérateurs de manipulation de date (objetDate) avec $year, $month, $dayOfMonth
db.employes.aggregate([
    {
        $match: {
            id_employes: 991
        }
    },
    {
        $project: {
            prenom: 1,
            nom: 1,
            anneeEmbauche: { $year: "$date_embauche" },
            moisEmbauche: { $month: "$date_embauche" },
            jourEmbauche: { $dayOfMonth: "$date_embauche" }
        }
    }
])

// Rechercher des éléments en fonction de si un certain champ est bien présent grâce à : $exists

db.employes.aggregate([
    {
      $match: {
        date_modification: { $exists: true } // On sélectionne seulement si ce champs là existe dans le document ou inversement avec false
      }
    }
  ])

// --------------------------------------------------------------------------
// --------------------------------------------------------------------------
// -- EXERCICES :
// --------------------------------------------------------------------------
// --------------------------------------------------------------------------

// -- 1 -- Afficher le salaire moyen des informaticiens (+arrondi).
db.employes.aggregate([
    {
      $match: { service: "informatique" }
    },
    {
      $group: {
        _id: null,
        salaireMoyen: { $avg: { $toDouble: "$salaire" } }
      }
    },
    {
      $project: {
        _id: 0,
        salaireMoyenArrondi: { $round: ["$salaireMoyen", 2] }
      }
    }
  ])

// -- 2 -- Afficher le coût des commerciaux sur une année.	
db.employes.aggregate([
    {
      $match: { service: "commercial" }
    },
    {
      $group: {
        _id: null,
        coutTotal: { $sum: { $multiply: [{ $toDouble: "$salaire" }, 12] } }
      }
    },
    {
      $project: {
        _id: 0,
        coutCommerciaux: "$coutTotal"
      }
    }
  ])

// -- 3 -- Afficher le salaire moyen par service. (nom du service + salaire moyen arrondi)
db.employes.aggregate([
    {
      $group: {
        _id: "$service",
        salaireMoyen: { $avg: { $toDouble: "$salaire" } }
      }
    },
    {
      $project: {
        _id: 0,
        service: "$_id",
        salaireMoyenArrondi: { $round: ["$salaireMoyen", 2] }
      }
    },
    {
      $sort: { service: 1 }
    }
  ])

// -- 4 -- Afficher le salaire moyen appliqué lors des recrutements sur la période allant de 2015 à 2017
db.employes.aggregate([
    {
      $match: {
        date_embauche: {
            $gte: "2015-01-01",
            $lt: "2018-01-01"            
        }
      }
    },
    {
      $group: {
        _id: null,
        salaireMoyen: { $avg: { $toDouble: "$salaire" } }
      }
    },
    {
      $project: {
        _id: 0,
        salaireMoyenArrondi: { $round: ["$salaireMoyen", 2] }
      }
    }
  ])
// -- 5 -- Afficher conjointement le nombre d'homme et de femme dans l'entreprise
db.employes.aggregate([
    {
      $group: {
        _id: "$sexe",
        count: { $sum: 1 }
      }
    },
    {
      $project: {
        _id: 0,
        sexe: "$_id",
        count: 1
      }
    }
  ])
// -- 6 -- Afficher le salaire maximum pour chaque sexe.
db.employes.aggregate([
    {
      $group: {
        _id: "$sexe",
        salaireMax: { $max: { $toInt: "$salaire" } }
      }
    },
    {
      $project: {
        _id: 0,
        sexe: "$_id",
        salaireMax: 1
      }
    }
  ])
// -- 7 -- Affichez le nombre d'employés embauchés chaque année.
db.employes.aggregate([
    {
      $group: {
        _id: { $year: { $toDate: "$date_embauche" } },
        nombreEmployes: { $sum: 1 }
      }
    },
    {
      $project: {
        _id: 0,
        annee: "$_id",
        nombreEmployes: 1
      }
    },
    {
      $sort: { annee: 1 }
    }
  ])
// -- 8 -- Affichez le total des salaires de tous les employés embauchés chaque année.
db.employes.aggregate([
    {
      $group: {
        _id: { $year: { $toDate: "$date_embauche" } },
        totalSalaires: { $sum: { $toDouble: "$salaire" } }
      }
    },
    {
      $project: {
        _id: 0,
        annee: "$_id",
        totalSalaires: 1
      }
    },
    {
      $sort: { annee: 1 }
    }
  ])
// -- 9 -- Affichez le nombre d'employés par sexe et par service.
db.employes.aggregate([
    {
      $group: {
        _id: { sexe: "$sexe", service: "$service" },
        nombreEmployes: { $sum: 1 }
      }
    },
    {
      $project: {
        _id: 0,
        sexe: "$_id.sexe",
        service: "$_id.service",
        nombreEmployes: 1
      }
    },
    {
      $sort: { sexe: 1, service: 1 }
    }
  ])
// -- 10 -- Affichez le nombre d'employés ayant un salaire supérieur à 3000 pour chaque service.
db.employes.aggregate([
    {
      $match: {
        salaire: { $gt: "3000" }
      }
    },
    {
      $group: {
        _id: "$service",
        nombreEmployes: { $sum: 1 }
      }
    },
    {
      $project: {
        _id: 0,
        service: "$_id",
        nombreEmployes: 1
      }
    }
  ])







