// -----------------------------------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------------------------------
// ---------------------------- CHAPITRE 3: MANIPULATION DE TABLEAUX -----------------------------------------------------------
// -----------------------------------------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------------------------------------

// ---------------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------------
// ---------------------------------- TABLEAUX -------------------------------------------------
// ---------------------------------------------------------------------------------------------

// Dans le contexte de MongoDB, les tableaux sont utilisés pour stocker une collection ordonnée d'éléments dans un seul champ d'un document. Chaque élément du tableau peut être de différents types de données, y compris d'autres documents JSON

// Lorsque l'on stocke simplement une liste de données, on utilisera les [], définissant un simple array indexé numériquement
// Si on s'attend à avoir un tableau associatif, on utilisera plutôt les {} pour créer un nouveau document à l'intérieur d'un autre

// Insertion d'un nouvel employé avec de nouvelles données 

db.employes.insertOne({
    id_employes: "1000",
    prenom: "Shinji",
    nom: "Ikari",
    sexe: "m",
    date_embauche: "2023-08-18",
    salaire: "3000",
    service: "direction",
    adresse: {
        rue: "10 rue du Jinja",
        ville: "Tokyo",
        code_postal: "17500",
        pays: "Japon"
    },
    competences: {}
})

// Insertion dans competences : 
db.employes.updateOne(
    { id_employes: "1000" }, // Critère de sélection du document
    {
        $set: {
            "competences.langues": ["Français", "Japonais", "Anglais"]
        }
    }
)

// Pour ajouter ces nouveaux champs à tous les enregistrements sans impacter Tanaka
db.employes.updateMany(
    {
        adresse: { $exists: false },
        competences: { $exists: false }
    },
    {
        $set: {
            adresse: {
                rue: "",
                ville: "",
                code_postal: "",
                pays: ""
            },
            competences: {}
        }
    }
)


// ------------------- Fonctions et opérateurs de manipulation de tableaux ---------------------------------

// Ajout dans un tableau existant avec $push (ajoute à la fin)
db.employes.updateOne(
    { id_employes: "1000" }, // Critère de sélection du document
    {
        $push: {
            "competences.langues": "Coréen"
        }
    }
)

// Ajout dans un tableau uniquement si l'élément n'existe pas déjà avec $addToSet
db.employes.updateOne(
    { id_employes: "1000" }, // Critère de sélection du document
    {
        $addToSet: {
            "competences.langues": "Espagnol"
        }
    }
)

// Ajout de plusieurs éléments avec $each 
// Avec $push cela ajouterait un nouveau niveau d'array
db.employes.updateOne(
    { id_employes: "1000" }, // Critère de sélection du document
    {
        $addToSet: {
            "competences.langues": {
                $each: ["Allemand", "Italien", "Chinois"]
            }
        }
    }
)

// Suppression d'un élément d'un tableau grâce à $pull 
db.employes.updateOne(
    { id_employes: "1000" }, // Critère de sélection du document
    {
        $pull: {
            "competences.langues": "Français"
        }
    }
)

// Suppression du premier ou dernier élément d'un table grâce à $pop
db.employes.updateOne(
    { id_employes: "1000" }, // Critère de sélection du document
    {
        $pop: {
            "competences.langues": -1 // le premier
        }
    }
)

db.employes.updateOne(
    { id_employes: "1000" }, // Critère de sélection du document
    {
        $pop: {
            "competences.langues": 1 // le dernier
        }
    }
)

// Découper un tableau avec $slice
db.employes.updateOne(
    { id_employes: "1000" }, // Critère de sélection du document
    {
        $set: {
            "competences.langues": {
                $slice: 2
            }
        }
    }
)
//   Dans cet exemple, l'opération updateOne cible l'employé avec l'identifiant "1000" et utilise l'opérateur $set avec l'opérateur $slice pour s'assurer que le tableau "langues" du champ "competences" ne contient que les deux premières langues.

// Employé 350
db.employes.updateOne({ id_employes: "350" }, { $addToSet: { "competences.langues": { $each: ["Français", "Anglais"] } } });
// Employé 388
db.employes.updateOne({ id_employes: "388" }, { $addToSet: { "competences.langues": { $each: ["Italien"] } } });
// Employé 415
db.employes.updateOne({ id_employes: "415" }, { $addToSet: { "competences.langues": { $each: ["Français", "Chinois", "Anglais", "Japonais"] } } });
// Employé 417
db.employes.updateOne({ id_employes: "417" }, { $addToSet: { "competences.langues": { $each: ["Allemand", "Français", "Chinois"] } } });
// Employé 491
db.employes.updateOne({ id_employes: "491" }, { $addToSet: { "competences.langues": { $each: ["Russe", "Arabe", "Anglais"] } } });
// Employé 509
db.employes.updateOne({ id_employes: "509" }, { $addToSet: { "competences.langues": { $each: ["Français", "Japonais", "Portugais", "Espagnol"] } } });
// Employé 547
db.employes.updateOne({ id_employes: "547" }, { $addToSet: { "competences.langues": { $each: ["Italien", "Français", "Chinois"] } } });
// Employé 592
db.employes.updateOne({ id_employes: "592" }, { $addToSet: { "competences.langues": { $each: ["Espagnol", "Russe", "Portugais"] } } });
// Employé 627
db.employes.updateOne({ id_employes: "627" }, { $addToSet: { "competences.langues": { $each: ["Anglais", "Japonais", "Arabe"] } } });
// Employé 655
db.employes.updateOne({ id_employes: "655" }, { $addToSet: { "competences.langues": { $each: ["Chinois", "Italien", "Espagnol"] } } });
// Employé 699
db.employes.updateOne({ id_employes: "699" }, { $addToSet: { "competences.langues": { $each: ["Français", "Russe", "Portugais"] } } });
// Employé 701
db.employes.updateOne({ id_employes: "701" }, { $addToSet: { "competences.langues": { $each: ["Français", "Anglais", "Japonais", "Chinois"] } } });
// Employé 739
db.employes.updateOne({ id_employes: "739" }, { $addToSet: { "competences.langues": { $each: ["Espagnol", "Italien"] } } });
// Employé 780
db.employes.updateOne({ id_employes: "780" }, { $addToSet: { "competences.langues": { $each: ["Russe", "Portugais", "Chinois"] } } });
// Employé 802
db.employes.updateOne({ id_employes: "802" }, { $addToSet: { "competences.langues": { $each: ["Anglais"] } } });
// Employé 854
db.employes.updateOne({ id_employes: "854" }, { $addToSet: { "competences.langues": { $each: ["Français", "Italien", "Chinois"] } } });
// Employé 876
db.employes.updateOne({ id_employes: "876" }, { $addToSet: { "competences.langues": { $each: ["Anglais", "Russe", "Portugais"] } } });
// Employé 900
db.employes.updateOne({ id_employes: "900" }, { $addToSet: { "competences.langues": { $each: ["Japonais", "Anglais"] } } });
// Employé 933
db.employes.updateOne({ id_employes: "933" }, { $addToSet: { "competences.langues": { $each: ["Chinois", "Italien", "Russe"] } } });
// Employé 990
db.employes.updateOne({ id_employes: "990" }, { $addToSet: { "competences.langues": { $each: ["Italien","Chinois","Portugais", "Anglais", "Français"] } } });


// Recherche dans un tableau grâce à $elemMatch
// Les employés qui parlent au moins une de ces langues
db.employes.find({
    "competences.langues": {
        $elemMatch: {
            $in: ["Français", "Anglais", "Espagnol"]
        }
    }
});

// Employés qui parlent au moins ces deux langues avec $all
db.employes.find({
    "competences.langues": {
        $all: ["Français", "Anglais"]
    }
});
// avec $and 
db.employes.find({
    $and: [
        { "competences.langues": "Français" },
        { "competences.langues": "Anglais" }
    ]
});

// Attention ici ne fonctionne pas, la deuxieme condition écrase la précédente
db.employes.find({
    "competences.langues": "Français",
    "competences.langues": "Anglais"
});

// Recherche en fonction de taille du tableau avec $size 
db.employes.find({
    "competences.langues": {
        $size: 1
    }
});

// Selection d'un élément à une position particulière de l'array grâce à $arrayElemAt
// Récupération de seulement la première langue de chaque employé
db.employes.find(
    {},
    {
      _id: 0,
      prenom: 1,
      nom: 1,
      premiereLangue: { $arrayElemAt: ["$competences.langues", 0] }
    }
  );



// --------------------------------------------------------------------------
// --------------------------------------------------------------------------
// -- EXERCICES :
// --------------------------------------------------------------------------
// --------------------------------------------------------------------------


// -- 1 -- Pour chaque employé, ajoutez une nouvelle compétence linguistique "Quebecois".
db.employes.updateMany(
    {},
    { $addToSet: { "competences.langues": "Quebecois" } }
  );
// -- 2 -- Sélectionnez les employés qui ont des compétences linguistiques comprenant à la fois "Français" et "Anglais", mais pas "Espagnol".
db.employes.find({
    "competences.langues": { $all: ["Français", "Anglais"], $nin: ["Espagnol"] }
  });
// -- 3 -- Sélectionnez les employés qui ont des compétences linguistiques "Japonais" et "Anglais", mais aucune autre langue.
db.employes.find({
    "competences.langues": { $all: ["Japonais", "Anglais"] },
    "competences.langues": { $size: 2 }
  });
// -- 4 -- Pour chaque employé, supprimez la dernière compétence linguistique de leur liste.
db.employes.updateMany(
    {},
    { $pop: { "competences.langues": 1 } }
  );
// -- 5 -- Sélectionnez les employés dont la première compétence linguistique est "Anglais".
db.employes.find({
    "competences.langues.0": "Anglais"
  });
// -- 6 -- Pour chaque employé masculin du service "communication", ajoutez la langue "Portugais" à leurs compétences.
db.employes.updateMany(
    {
      sexe: "m",
      service: "communication"
    },
    { $addToSet: { "competences.langues": "Portugais" } }
  );
// -- 7 -- Sélectionnez les employés masculins du service "commercial" qui ne parlent pas "Anglais".
db.employes.find({
    sexe: "m",
    service: "commercial",
    "competences.langues": { $nin: ["Anglais"] }
  });
// -- 8 -- Supprimez complètement la compétence linguistique "Français" de tous les employés.
db.employes.updateMany(
    {},
    { $pull: { "competences.langues": "Français" } }
  );
// -- 9 -- Sélectionnez tous les employés qui parlent "Anglais".
db.employes.find({
    "competences.langues": "Anglais"
  });
// -- 10 -- Ajoutez une nouvelle langue "Chinois" aux compétences des employés qui ont un salaire supérieur à 3000.
db.employes.updateMany(
    { salaire: { $gt: 3000 } },
    { $addToSet: { "competences.langues": "Chinois" } }
  );
// -- 11 -- Sélectionnez les employées femmes du service "commercial" qui parlent "Anglais".
db.employes.find({
    sexe: "f",
    service: "commercial",
    "competences.langues": "Anglais"
  });
// -- 12 -- Triez les employés par le nombre de langues qu'ils parlent, du plus grand au plus petit.
db.employes.aggregate([
    {
      $project: {
        _id: 0,
        prenom: 1,
        nom: 1,
        nbLangues: { $size: "$competences.langues" },
        competences: 1
      }
    },
    {
      $sort: { nbLangues: -1 }
    }
  ]);


