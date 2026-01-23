CREATE DATABASE bibliotheque;
USE bibliotheque;

CREATE TABLE abonne (
  id_abonne INT(3) NOT NULL AUTO_INCREMENT,
  prenom VARCHAR(15) NOT NULL,
  PRIMARY KEY (id_abonne)
) ENGINE=InnoDB ;

INSERT INTO abonne (id_abonne, prenom) VALUES
(1, 'Guillaume'),
(2, 'Benoit'),
(3, 'Chloe'),
(4, 'Laura');


CREATE TABLE livre (
  id_livre INT(3) NOT NULL AUTO_INCREMENT,
  auteur VARCHAR(25) NOT NULL,
  titre VARCHAR(30) NOT NULL,
  PRIMARY KEY (id_livre)
) ENGINE=InnoDB ;

INSERT INTO livre (id_livre, auteur, titre) VALUES
(100, 'GUY DE MAUPASSANT', 'Une vie'),
(101, 'GUY DE MAUPASSANT', 'Bel-Ami '),
(102, 'HONORE DE BALZAC', 'Le pere Goriot'),
(103, 'ALPHONSE DAUDET', 'Le Petit chose'),
(104, 'ALEXANDRE DUMAS', 'La Reine Margot'),
(105, 'ALEXANDRE DUMAS', 'Les Trois Mousquetaires');

CREATE TABLE emprunt (
  id_emprunt INT(3) NOT NULL AUTO_INCREMENT,
  id_livre INT(3) DEFAULT NULL,
  id_abonne INT(3) DEFAULT NULL,
  date_sortie DATE NOT NULL,
  date_rendu DATE DEFAULT NULL,
  PRIMARY KEY  (id_emprunt)
) ENGINE=InnoDB ;

INSERT INTO emprunt (id_emprunt, id_livre, id_abonne, date_sortie, date_rendu) VALUES
(1, 100, 1, '2016-12-07', '2016-12-11'),
(2, 101, 2, '2016-12-07', '2016-12-18'),
(3, 100, 3, '2016-12-11', '2016-12-19'),
(4, 103, 4, '2016-12-12', '2016-12-22'),
(5, 104, 1, '2016-12-15', '2016-12-30'),
(6, 105, 2, '2017-01-02', '2017-01-15'),
(7, 105, 3, '2017-02-15', NULL),
(8, 100, 2, '2017-02-20', NULL);



-- Quels sont les id_livre des livres qui n'ont pas été rendu à la bibliothèque ? 
SELECT id_livre FROM emprunt WHERE date_rendu IS NULL;
+----------+
| id_livre |
+----------+
|      105 |
|      100 |
+----------+

-- Quels sont les titres des livres 100 et 105 ? 
SELECT titre FROM livre WHERE id_livre = 100 OR id_livre = 105;
SELECT titre FROM livre WHERE id_livre IN (100,105);
+-------------------------+
| titre                   |
+-------------------------+
| Une vie                 |
| Les Trois Mousquetaires |
+-------------------------+


-- Maintenant, j'aimerai connaître le titre de ces deux livres ? Comment faire ? 
-- 2 possibilités : 
    -- Requêtes imbriquées 
    -- Requêtes en jointure 

----------------------------------------------------------------
----------------------------------------------------------------
------ REQUETES IMBRIQUEES SUR PLUSIEURS TABLES ----------------
----------------------------------------------------------------
----------------------------------------------------------------

-- Quels sont les titres des livres qui n'ont pas été rendu à la bibliothèque ? 
-- L'information des titres est présente, sur la table livre
-- L'information "non rendu" est présente sur la table emprunt
-- Je vais devoir transiter de l'une à l'autre ! 
-- Pour ça, il me faudra toujours un champ commun, parfait, ici, nous avons une relation entre nos tables, donc emprunt possède en tant que Foreign Key, les id des tables abonne et livre, ce qui va me permettre de passer d'une table à l'autre 
-- Une requête imbriquée c'est quoi ? C'est une requête qui contient elle même une seconde (ou plus) autre requête
-- On a besoin du résultat de la deuxième requête pour mener à bien la première requête 

SELECT titre FROM livre WHERE id_livre IN 
    (SELECT id_livre FROM emprunt WHERE date_rendu IS NULL);
+-------------------------+
| titre                   |
+-------------------------+
| Une vie                 |
| Les Trois Mousquetaires |
+-------------------------+

--------------- EXERCICES EN REQUETES IMBRIQUEES --------------------------------------------
-- EXERCICE 1: Quels sont les prénoms des abonnés n'ayant pas rendu un livre à la bibliotheque.
-- EXERCICE 2 : Nous aimerions connaitre le(s) n° des livres empruntés par Chloé
-- EXERCICE 3: Affichez les prénoms des abonnés ayant emprunté un livre le 07/12/2016.
-- EXERCICE 4: combien de livre Guillaume a emprunté à la bibliotheque ?
-- EXERCICE 5: Affichez la liste des abonnés ayant déjà emprunté un livre d'Alphonse Daudet
-- EXERCICE 6: Nous aimerions connaitre les titres des livres que Chloe a emprunté à la bibliotheque.
-- EXERCICE 7: Nous aimerions connaitre les titres des livres que Chloe n'a pas emprunté à la bibliotheque.
-- EXERCICE 8: Nous aimerions connaitre les titres des livres que Chloe a emprunté à la bibliotheque ET qui n'ont pas été rendu.
-- EXERCICE 9 :  Qui a emprunté le plus de livre à la bibliotheque ?


----------------------------------------------------------------
----------------------------------------------------------------
------ REQUETES EN JOINTURE ------------------------------------
----------------------------------------------------------------
----------------------------------------------------------------

-- Une jointure est toujours possible dans le sens où, une imbriquée n'est capable d'afficher que les informations d'une seule table à la fois alors que la jointure peux tout afficher ! 

-- Avec des requêtes imbriquées on parcourt les tables les unes après les autres, en passant par le champ commun( PK et FK )
-- Avec des jointures on peut mélanger les champs de sorties, les tables, les conditions sans que cela pose problème 

-- Nous aimerions connaître les dates de sortie et les dates de rendu pour l'abonné Guillaume, en affichant les dates et aussi le prenom Guillaume à côté ! 
    -- En imbriquée ce n'est pas possible ! Car les infos des emprunts sont sur la table emprunt et l'info Guillaume est sur une table différente ! 

-- Grâce à la jointe, c'est OK ! 

-- Première syntaxe (pour la facilité)

SELECT prenom, date_sortie, date_rendu         -- Ce que je veux afficher
FROM emprunt, abonne                           -- Les tables dont j'ai besoin
WHERE prenom = "Guillaume"                     -- Ma condition du prenom Guillaume (les emprunts de Guillaume)
AND abonne.id_abonne = emprunt.id_abonne;      -- La création de la jointure, on indique au système les champs qui se correspondent (donc la PK d'un côté avec la FK de l'autre)

SELECT a.prenom, e.date_sortie, e.date_rendu         
FROM emprunt e, abonne a                        -- Je peux donner des alias à mes tables pour éviter d'avoir des prefixes trop long
WHERE a.prenom = "Guillaume"                        
AND a.id_abonne = e.id_abonne;                  -- Le préfixe, c'est le fait de nommer le nom de la table avant le nom du champ par exemple abonne.id_abonne   ou avec alias   a.id_abonne 
+-----------+-------------+------------+
| prenom    | date_sortie | date_rendu |
+-----------+-------------+------------+
| Guillaume | 2016-12-07  | 2016-12-11 |
| Guillaume | 2016-12-15  | 2016-12-30 |
+-----------+-------------+------------+


-- Autre syntaxe pour les jointures (on préfèrera celle ci par bonne pratique de code)
-- En utilisant INNER JOIN ou JOIN (c'est pareil)
-- Avec cette méthode, on joint les tables une par une 
SELECT a.prenom, e.date_sortie, e.date_rendu 
FROM emprunt e
JOIN abonne a ON e.id_abonne = a.id_abonne 
WHERE a.prenom = "Guillaume";

SELECT a.prenom, e.date_sortie, e.date_rendu 
FROM emprunt e
INNER JOIN abonne a ON e.id_abonne = a.id_abonne 
WHERE a.prenom = "Guillaume";
+-----------+-------------+------------+
| prenom    | date_sortie | date_rendu |
+-----------+-------------+------------+
| Guillaume | 2016-12-07  | 2016-12-11 |
| Guillaume | 2016-12-15  | 2016-12-30 |
+-----------+-------------+------------+

-- EXERCICE 1 : Nous aimerions connaitre les dates de sortie et les dates de rendu pour les livres écrit par Alphonse Daudet 
-- EXERCICE 2 : Qui a emprunté le livre "une vie" sur l'année 2016 
-- EXERCICE 3 : Nous aimerions connaitre le nombre de livre emprunté par chaque abonné 
-- EXERCICE 4 : Nous aimerions connaitre le nombre de livre emprunté à rendre par chaque abonné 
-- EXERCICE 5 : Qui (prenom) a emprunté Quoi (titre) et Quand (date_sortie) ?
