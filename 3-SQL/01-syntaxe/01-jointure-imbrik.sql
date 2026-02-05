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
SELECT prenom FROM abonne WHERE id_abonne IN 
    (SELECT id_abonne FROM emprunt WHERE date_rendu IS NULL);
+--------+
| prenom |
+--------+
| Benoit |
| Chloe  |
+--------+
-- EXERCICE 2 : Nous aimerions connaitre le(s) n° des livres empruntés par Chloé
SELECT id_livre FROM emprunt WHERE id_abonne IN 
    (SELECT id_abonne FROM abonne WHERE prenom = "Chloe");
+----------+
| id_livre |
+----------+
|      100 |
|      105 |
|      101 |
+----------+
-- EXERCICE 3: Affichez les prénoms des abonnés ayant emprunté un livre le 07/12/2016.
SELECT prenom FROM abonne WHERE id_abonne IN 
    (SELECT id_abonne FROM emprunt WHERE date_sortie = "2016-12-07");
+-----------+
| prenom    |
+-----------+
| Guillaume |
| Benoit    |
+-----------+
-- EXERCICE 4: combien de livre Guillaume a emprunté à la bibliotheque ?
SELECT COUNT(*) AS emprunt_guillaume FROM emprunt WHERE id_abonne IN 
    (SELECT id_abonne FROM abonne WHERE prenom = "Guillaume");
+-------------------+
| emprunt_guillaume |
+-------------------+
|                 2 |
+-------------------+
-- EXERCICE 5: Affichez la liste des abonnés ayant déjà emprunté un livre d'Alphonse Daudet
SELECT prenom FROM abonne WHERE id_abonne IN 
    (SELECT id_abonne FROM emprunt WHERE id_livre IN 
        (SELECT id_livre FROM livre WHERE auteur = "alphonse daudet"));
+--------+
| prenom |
+--------+
| Laura  |
+--------+
-- EXERCICE 6: Nous aimerions connaitre les titres des livres que Chloe a emprunté à la bibliotheque.
SELECT titre FROM livre WHERE id_livre IN 
    (SELECT id_livre FROM emprunt WHERE id_abonne IN 
        (SELECT id_abonne FROM abonne WHERE prenom = "Chloe"));
+-------------------------+
| titre                   |
+-------------------------+
| Une vie                 |
| Les Trois Mousquetaires |
| Bel-Ami                 |
+-------------------------+
-- EXERCICE 7: Nous aimerions connaitre les titres des livres que Chloe n'a pas emprunté à la bibliotheque.
SELECT titre FROM livre WHERE id_livre NOT IN 
    (SELECT id_livre FROM emprunt WHERE id_abonne IN 
        (SELECT id_abonne FROM abonne WHERE prenom = "Chloe"));
+-----------------+
| titre           |
+-----------------+
| Le pere Goriot  |
| Le Petit chose  |
| La Reine Margot |
+-----------------+
-- EXERCICE 8: Nous aimerions connaitre les titres des livres que Chloe a emprunté à la bibliotheque ET qui n'ont pas été rendu.
SELECT titre FROM livre WHERE id_livre IN 
    (SELECT id_livre FROM emprunt WHERE date_rendu IS NULL AND id_abonne IN 
        (SELECT id_abonne FROM abonne WHERE prenom = "Chloe"));

SELECT titre FROM livre WHERE id_livre IN 
    (SELECT id_livre FROM emprunt WHERE id_abonne IN 
        (SELECT id_abonne FROM abonne WHERE prenom = "Chloe")
          AND date_rendu IS NULL );
+-------------------------+
| titre                   |
+-------------------------+
| Les Trois Mousquetaires |
| Bel-Ami                 |
+-------------------------+
       
-- EXERCICE 9 :  Qui a emprunté le plus de livre à la bibliotheque ?
SELECT prenom FROM abonne WHERE id_abonne =
  (SELECT id_abonne FROM emprunt GROUP BY id_abonne ORDER BY COUNT(*) DESC LIMIT 1);
  -- Ci dessus, j'utilise un GROUP BY qui me permet d'appliquer une fonction d'agrégation par bloc sur chaque id_abonne, même si je décide de ne pas afficher le resultat de l'agrégation, je peux m'en servir dans ma requête comme ici dans le ORDER BY 

  -- Petit soucis avec cette requête, elle n'est pas capable de me sortir plusieurs prénoms s'il y a plusieurs personnes égalité en nombre d'emprunts 
+--------+
| prenom |
+--------+
| Benoit |
+--------+


-- Ci dessous la représentation de ce qu'aurait donné le resultat de fonction d'agrégation en affichant le COUNT(*)
  SELECT id_abonne, COUNT(*) FROM emprunt GROUP BY id_abonne ORDER BY COUNT(*) DESC;
+-----------+----------+
| id_abonne | COUNT(*) |
+-----------+----------+
|         2 |        3 |
|         3 |        3 |
|         1 |        2 |
|         4 |        1 |
+-----------+----------+


-- Ci dessous séparation par bloc grâce au GROUP BY
  +------------+----------+-----------+-------------+------------+
| id_emprunt | id_livre | id_abonne | date_sortie | date_rendu |
+------------+----------+-----------+-------------+------------+

|          1 |      100 |         1 | 2016-12-07  | 2016-12-11 |  abonne 1   =  2 emprunts
|          5 |      104 |         1 | 2016-12-15  | 2016-12-30 |

|          2 |      101 |         2 | 2016-12-07  | 2016-12-18 |  abonne 2 =  3 emprunts 
|          6 |      105 |         2 | 2017-01-02  | 2017-01-15 |
|          8 |      100 |         2 | 2017-02-20  | NULL       |

|          3 |      100 |         3 | 2016-12-11  | 2016-12-19 |  abonne 3 =  3 emprunts 
|          7 |      105 |         3 | 2017-02-15  | NULL       |
|          9 |      101 |         3 | 2026-01-23  | NULL       |

|          4 |      103 |         4 | 2016-12-12  | 2016-12-22 |  abonne 4 =  1 emprunt
+------------+----------+-----------+-------------+------------+


-- Ci dessous une requête me permettant de me sortir plusieurs prénoms s'ils sont à égalité dans le top du nbr d'emprunts 
SELECT prenom FROM abonne WHERE id_abonne IN
  (SELECT id_abonne FROM emprunt GROUP BY id_abonne HAVING COUNT(*) = 
      (SELECT MAX(nbr_emprunt) FROM (SELECT COUNT(*) AS nbr_emprunt FROM emprunt GROUP BY id_abonne) AS count));

      -- On fait face ici à la création d'une table temporaire par la requête : (SELECT COUNT(*) AS nbr_emprunt FROM emprunt GROUP BY id_abonne) AS count
      -- Cela va créer une table nommée count qui aura un nom de champ "nbr_emprunt" contenant les valeurs du count de chaque id_abonne
        -- Sur cette table temporaire on demande un MAX(nbr_emprunt) pour isoler quel est le nombre d'emprunt le plus élevé 
          -- On se sert de ce nombre d'emprunt le plus élevé comme condition HAVING pour notre GROUP BY de la seconde requête 

+--------+
| prenom |
+--------+
| Benoit |
| Chloe  |
+--------+

Table : count 
+-------------+
| nbr_emprunt |
+-------------+
|           2 |
|           3 |
|           3 |
|           1 |
+-------------+

-- SELECT MAX(nbr_emprunt) FROM count;

-- On peut le faire sans table temporaire avec la requête suivante :
-- On simule en gros la même chose, en récupérant la valeur la plus élevée d'emprunt grâce au ORDER BY DESC LIMIT 1 
SELECT prenom FROM abonne WHERE id_abonne IN 
  (SELECT id_abonne FROM emprunt GROUP BY id_abonne HAVING COUNT(*) = 
    (SELECT COUNT(*) FROM emprunt GROUP BY id_abonne ORDER BY COUNT(*) DESC LIMIT 1));
+--------+
| prenom |
+--------+
| Benoit |
| Chloe  |
+--------+



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

-- Grâce à la jointure, c'est OK ! 

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
SELECT titre, date_sortie, date_rendu 
FROM emprunt 
INNER JOIN livre ON emprunt.id_livre = livre.id_livre
WHERE auteur = "alphonse daudet";
+----------------+-------------+------------+
| titre          | date_sortie | date_rendu |
+----------------+-------------+------------+
| Le Petit chose | 2016-12-12  | 2016-12-22 |
+----------------+-------------+------------+
-- EXERCICE 2 : Qui a emprunté le livre "une vie" sur l'année 2016 
SELECT l.titre, ab.prenom, emp.date_sortie 
FROM emprunt emp 
JOIN abonne ab ON emp.id_abonne = ab.id_abonne 
JOIN livre l ON emp.id_livre = l.id_livre 
WHERE l.titre = "une vie" 
AND YEAR(emp.date_sortie) = 2016;
+---------+-----------+-------------+
| titre   | prenom    | date_sortie |
+---------+-----------+-------------+
| Une vie | Guillaume | 2016-12-07  |
| Une vie | Chloe     | 2016-12-11  |
+---------+-----------+-------------+
-- EXERCICE 3 : Nous aimerions connaitre le nombre de livre emprunté par chaque abonné 
SELECT abonne.prenom, COUNT(*) as nbr_emprunt 
FROM emprunt 
INNER JOIN abonne ON abonne.id_abonne = emprunt.id_abonne 
GROUP BY abonne.prenom;
+-----------+-----------------+
| prenom    | COUNT(id_livre) |
+-----------+-----------------+
| Guillaume |               2 |
| Benoit    |               3 |
| Chloe     |               3 |
| Laura     |               1 |
+-----------+-----------------+
-- EXERCICE 4 : Nous aimerions connaitre le nombre de livre emprunté à rendre par chaque abonné 
SELECT a.prenom, COUNT(*) AS livre_a_rendre 
FROM emprunt e  
JOIN abonne a ON e.id_abonne = a.id_abonne 
WHERE e.date_rendu IS NULL 
GROUP BY a.id_abonne;
+--------+----------------+
| prenom | livre_a_rendre |
+--------+----------------+
| Chloe  |              2 |
| Benoit |              1 |
+--------+----------------+
-- EXERCICE 5 : Qui (prenom) a emprunté Quoi (titre) et Quand (date_sortie) ?
SELECT a.prenom, l.titre, e.date_sortie 
FROM emprunt e 
JOIN abonne a ON e.id_abonne = a.id_abonne 
JOIN livre l ON e.id_livre = l.id_livre 
ORDER BY a.prenom;
+-----------+-------------------------+-------------+
| prenom    | titre                   | date_sortie |
+-----------+-------------------------+-------------+
| Benoit    | Bel-Ami                 | 2016-12-07  |
| Benoit    | Les Trois Mousquetaires | 2017-01-02  |
| Benoit    | Une vie                 | 2017-02-20  |
| Chloe     | Une vie                 | 2016-12-11  |
| Chloe     | Les Trois Mousquetaires | 2017-02-15  |
| Chloe     | Bel-Ami                 | 2026-01-23  |
| Guillaume | Une vie                 | 2016-12-07  |
| Guillaume | La Reine Margot         | 2016-12-15  |
| Laura     | Le Petit chose          | 2016-12-12  |
+-----------+-------------------------+-------------+

----------------------------------------------------------------
----------------------------------------------------------------
------ REQUETES EN JOINTURE EXTERNE ----------------------------
----------------------------------------------------------------
----------------------------------------------------------------

-- Enregistrez-vous dans la table abonné 
INSERT INTO abonne (prenom) VALUES ("Pierralex");
SELECT * FROM abonne;
+-----------+-----------+
| id_abonne | prenom    |
+-----------+-----------+
|         1 | Guillaume |
|         2 | Benoit    |
|         3 | Chloe     |
|         4 | Laura     |
|         5 | Pierralex |
+-----------+-----------+

--Affichez tous les prenoms des abonnés SANS EXCEPTION ainsi que les id_livre qu'ils ont emprunté si c'est le cas 
SELECT a.prenom, e.id_livre  
FROM abonne a
JOIN emprunt e ON e.id_abonne = a.id_abonne
ORDER BY a.prenom;
-- Nous n'apparaissons pas dans ce résultat car nous sommes en train de faire une jointure INTERNE ! Dans une jointure interne, seule les valeurs ayant des correspondances dans l'autre table sont incluses
-- Pierralex n'ayant pas encore d'emprunt, n'est pas présent dans la table emprunt, la jointure interne ne le sort pas ! 
+-----------+----------+
| prenom    | id_livre |
+-----------+----------+
| Benoit    |      101 |
| Benoit    |      105 |
| Benoit    |      100 |
| Chloe     |      100 |
| Chloe     |      105 |
| Chloe     |      101 |
| Guillaume |      100 |
| Guillaume |      104 |
| Laura     |      103 |
+-----------+----------+


-- La solution pour ça, une jointure externe ! Voir schema sur la doc : https://sql.sh/cours/jointures

-- Je remplace mon JOIN ou INNER JOIN par un LEFT ou RIGHT JOIN

-- ATTENTION AU SENS DE LA JOINTURE 
-- Ici dans le cas d'un LEFT, c'est la table citée en premier qui sera incluse en entier (la table la plus à gauche de la ligne de jointure)
SELECT a.prenom, e.id_livre  
FROM abonne a LEFT JOIN emprunt e ON e.id_abonne = a.id_abonne
ORDER BY a.prenom;
+-----------+----------+
| prenom    | id_livre |
+-----------+----------+
| Benoit    |      100 |
| Benoit    |      105 |
| Benoit    |      101 |
| Chloe     |      101 |
| Chloe     |      105 |
| Chloe     |      100 |
| Guillaume |      104 |
| Guillaume |      100 |
| Laura     |      103 |
| Pierralex |     NULL |
+-----------+----------+

-- Ici dans le cas d'un RIGHT, c'est la table citée en dernier qui sera incluse en entièer (la table la plus à droite de la ligne de jointure)
-- C'est la table abonne qui est ramenée en entier (incluant Pierralex)
SELECT a.prenom, e.id_livre  
FROM emprunt e RIGHT JOIN abonne a ON e.id_abonne = a.id_abonne
ORDER BY a.prenom;

-- EXERCICE 1 : Affichez tous les livres sans exception puis les id_abonne ayant emprunté ces livres si c'est le cas
-- EXERCICE 2 : Affichez tous les prénoms des abonnés et s'ils ont fait des emprunts, affichez les id_livre, auteur et titre
-- EXERCICE 3 : Affichez tous les prénoms des abonnés et s'ils ont fait des emprunts, affichez les id_livre, auteur et titre ainsi que les livres non empruntés :)