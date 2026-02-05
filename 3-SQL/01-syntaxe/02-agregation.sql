-----------------------------------------------------------------
-----------------------------------------------------------------
-------- Fonctions d'agrégation ---------------------------------
-----------------------------------------------------------------
-----------------------------------------------------------------


-- Qu'est ce qu'une fonction d'agrégation : C'est une fonction applique un calcul sur un jeu de résultat
                    -- Sa particularité est qu'elle ne nous retourne qu'une seule ligne de résultat (elle aura vérifié et écrasé toutes les lignes pour appliquer son calcul et ne sortir que le résultat)


-- SUM() pour avoir la somme d'un champ sur un jeu de résultat
-- AVG() pour la moyenne d'un champ sur un jeu de résultat
-- COUNT() pour compter le nombre de ligne d'un jeu de résultat
-- MIN() & MAX() qui nous retourne la valeur minimale ou maximale d'un champ sur une selection 

CREATE DATABASE entreprise2;
USE entreprise2;

-- Création d'une table employes dans la base entreprise
CREATE TABLE IF NOT EXISTS employes (
  id_employes int(3) NOT NULL AUTO_INCREMENT,
  prenom varchar(20) DEFAULT NULL,
  nom varchar(20) DEFAULT NULL,
  sexe enum('m','f') NOT NULL,
  service varchar(30) DEFAULT NULL,
  date_embauche date DEFAULT NULL,
  salaire float DEFAULT NULL,
  PRIMARY KEY (id_employes)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

-- Insertions dans la table employes 
INSERT INTO employes (id_employes, prenom, nom, sexe, service, date_embauche, salaire) VALUES
(350, 'Jean-pierre', 'Laborde', 'm', 'direction', '2010-12-09', 5000),
(388, 'Clement', 'Gallet', 'm', 'commercial', '2010-12-15', 2300),
(415, 'Thomas', 'Winter', 'm', 'commercial', '2011-05-03', 3550),
(417, 'Chloe', 'Dubar', 'f', 'production', '2011-09-05', 1900),
(491, 'Elodie', 'Fellier', 'f', 'secretariat', '2011-11-22', 1600),
(509, 'Fabrice', 'Grand', 'm', 'comptabilite', '2011-12-30', 2900),
(547, 'Melanie', 'Collier', 'f', 'commercial', '2012-01-08', 3100),
(592, 'Laura', 'Blanchet', 'f', 'direction', '2012-05-09', 4500),
(627, 'Guillaume', 'Miller', 'm', 'commercial', '2012-07-02', 1900),
(655, 'Celine', 'Perrin', 'f', 'commercial', '2012-09-10', 2700),
(699, 'Julien', 'Cottet', 'm', 'secretariat', '2013-01-05', 1390),
(701, 'Mathieu', 'Vignal', 'm', 'informatique', '2013-04-03', 2500),
(739, 'Thierry', 'Desprez', 'm', 'secretariat', '2013-07-17', 1500),
(780, 'Amandine', 'Thoyer', 'f', 'communication', '2014-01-23', 2100),
(802, 'Damien', 'Durand', 'm', 'informatique', '2014-07-05', 2250),
(854, 'Daniel', 'Chevel', 'm', 'informatique', '2015-09-28', 3100),
(876, 'Nathalie', 'Martin', 'f', 'juridique', '2016-01-12', 3550),
(900, 'Benoit', 'Lagarde', 'm', 'production', '2016-06-03', 2550),
(933, 'Emilie', 'Sennard', 'f', 'commercial', '2017-01-11', 1800),
(990, 'Stephanie', 'Lafaye', 'f', 'assistant', '2017-03-01', 1775);

-- La somme de tous les salaires de l'entreprise : 
SELECT SUM(salaire) FROM employes;
+--------------+
| SUM(salaire) |
+--------------+
|        51965 |
+--------------+

SELECT SUM(salaire) AS masse_salariale FROM employes;
+-----------------+
| masse_salariale |
+-----------------+
|           51965 |
+-----------------+

-- La fonction d'agrégation passe sur toutes les lignes d'un résultat pour y appliquer son calcul
-- Et elle n'en ressort qu'un résultat d'une ligne
-- SELECT * FROM employes
+-------------+-------------+----------+------+---------------+---------------+---------+
| id_employes | prenom      | nom      | sexe | service       | date_embauche | salaire |
+-------------+-------------+----------+------+---------------+---------------+---------+
|         350 | Jean-pierre | Laborde  | m    | direction     | 2010-12-09    |    5000 |
|         388 | Clement     | Gallet   | m    | commercial    | 2010-12-15    |    2300 |
|         415 | Thomas      | Winter   | m    | commercial    | 2011-05-03    |    3550 |
|         417 | Chloe       | Dubar    | f    | production    | 2011-09-05    |    1900 |
|         491 | Elodie      | Fellier  | f    | secretariat   | 2011-11-22    |    1600 |
|         509 | Fabrice     | Grand    | m    | comptabilite  | 2011-12-30    |    2900 |
|         547 | Melanie     | Collier  | f    | commercial    | 2012-01-08    |    3100 |
|         592 | Laura       | Blanchet | f    | direction     | 2012-05-09    |    4500 |
|         627 | Guillaume   | Miller   | m    | commercial    | 2012-07-02    |    1900 |
|         655 | Celine      | Perrin   | f    | commercial    | 2012-09-10    |    2700 |
|         699 | Julien      | Cottet   | m    | secretariat   | 2013-01-05    |    1390 |
|         701 | Mathieu     | Vignal   | m    | informatique  | 2013-04-03    |    2500 |
|         739 | Thierry     | Desprez  | m    | secretariat   | 2013-07-17    |    1500 |
|         780 | Amandine    | Thoyer   | f    | communication | 2014-01-23    |    2100 |
|         802 | Damien      | Durand   | m    | informatique  | 2014-07-05    |    2250 |
|         854 | Daniel      | Chevel   | m    | informatique  | 2015-09-28    |    3100 |
|         876 | Nathalie    | Martin   | f    | juridique     | 2016-01-12    |    3550 |
|         900 | Benoit      | Lagarde  | m    | production    | 2016-06-03    |    2550 |
|         933 | Emilie      | Sennard  | f    | commercial    | 2017-01-11    |    1800 |
|         990 | Stephanie   | Lafaye   | f    | assistant     | 2017-03-01    |    1775 |
+-------------+-------------+----------+------+---------------+---------------+---------+

-- Affichage du salaire moyen de l'entreprise 
SELECT AVG(salaire) AS salaire_moyen FROM employes;
+---------------+
| salaire_moyen |
+---------------+
|       2598.25 |
+---------------+

-- Le nombre d'employés dans l'entreprise 
SELECT COUNT(*) AS nbr_employes FROM employes;
+--------------+
| nbr_employes |
+--------------+
|           20 |
+--------------+

SELECT COUNT(service) AS nbr_employes FROM employes;
+--------------+
| nbr_employes |
+--------------+
|           19 |
+--------------+

-- Attention à l'utilisation de COUNT(), on l'utilise généralement avec * entre ses parenthèses, comme ça on s'assure de compter toutes les lignes sans exception d'un jeu de résultat
-- Par contre, si l'on mets autre chose que * dans les parenthèses (un champ), si jamais ce champ a pour valeur NULL sur certains enregistrement, les lignes ne seront pas comptabilisées ! 

-- Pour être sûr de tout compter, on mettra toujours COUNT(*), et si jamais on ne veut compter que certaines lignes, alors on rajoute une condition WHERE 


-- Salaire minimum 
SELECT MIN(salaire) FROM employes;
+--------------+
| MIN(salaire) |
+--------------+
|         1390 |
+--------------+

-- Salaire maximum
SELECT MAX(salaire) FROM employes;
+--------------+
| MAX(salaire) |
+--------------+
|         5000 |
+--------------+


-- Affichez le salaire minimum ainsi que le prenom de l'employé ayant ce salaire 
SELECT prenom, MIN(salaire) FROM employes;
+-------------+--------------+
| prenom      | MIN(salaire) |
+-------------+--------------+
| Jean-pierre |         1390 |
+-------------+--------------+
-- ERREUR ICI ! Pas d'erreur de syntaxe dans notre version de MySQL mais le résultat est incohérent
-- Pourquoi ? Ici on récupère bien le MIN(salaire), donc le résultat de l'application de la fonction d'agrégation, mais à côté, le prénom ne correspond pas
-- C'est dû à la limite du fonctionnement des agregations de ne pouvoir sortir qu'une seule ligne de résultat
-- Donc, elle sort, son résultat et à côté, le premier prénom qu'elle trouve dans la table, sans qu'il n'y est de lien entre les deux !  

-- Plusieurs possibilités 
    -- Requête imbriquée 
-- SELECT prenom, salaire FROM employes WHERE salaire = 1390;
SELECT prenom, salaire FROM employes WHERE salaire = (SELECT MIN(salaire) FROM employes);

    -- On aurait pu le faire avec un LIMIT associé à un ORDER BY sur le salaire 
SELECT prenom, salaire FROM employes ORDER BY salaire LIMIT 1;
+--------+---------+
| prenom | salaire |
+--------+---------+
| Julien |    1390 |
+--------+---------+

-----------------------------------------------------------------------------------
-- GROUP BY à utiliser avec nos agrégations : 
    -- GROUP BY nous permet de regrouper des enregistrements selon un ou plusieurs champs 

-- Quel est le nombre d'employés par service ? 

    -- Ci dessous, le nombre d'employés total, mais j'aimerai avoir le nombre d'employés "par service"
SELECT COUNT(*) AS nbr_employes FROM employes;
+--------------+
| nbr_employes |
+--------------+
|           20 |
+--------------+

SELECT service, COUNT(*) AS nbr_employes FROM employes GROUP BY service;
    -- Avec GROUP BY il est possible de nous renvoyer le resultat d'une agrégation en regroupant par un champ, ici le COUNT pour chaque service 
    -- En quelques sortes, chaque "bloc" de service est extrait du résultat du base et la fonction d'agrégation s'applique sur chaque bloc séparément
+---------------+--------------+
| service       | nbr_employes |
+---------------+--------------+
| direction     |            2 |
| commercial    |            6 |
| production    |            2 |
| secretariat   |            3 |
| comptabilite  |            1 |
| informatique  |            3 |
| communication |            1 |
| juridique     |            1 |
| assistant     |            1 |
+---------------+--------------+


SELECT * FROM employes ORDER BY service;
+-------------+-------------+----------+------+---------------+---------------+---------+
| id_employes | prenom      | nom      | sexe | service       | date_embauche | salaire |
+-------------+-------------+----------+------+---------------+---------------+---------+

|         990 | Stephanie   | Lafaye   | f    | assistant     | 2017-03-01    |    1775 |  -- COUNT s'applique sur ce bloc

|         388 | Clement     | Gallet   | m    | commercial    | 2010-12-15    |    2300 | -- Puis celui ci
|         415 | Thomas      | Winter   | m    | commercial    | 2011-05-03    |    3550 |
|         547 | Melanie     | Collier  | f    | commercial    | 2012-01-08    |    3100 |
|         627 | Guillaume   | Miller   | m    | commercial    | 2012-07-02    |    1900 |
|         655 | Celine      | Perrin   | f    | commercial    | 2012-09-10    |    2700 |
|         933 | Emilie      | Sennard  | f    | commercial    | 2017-01-11    |    1800 |

|         780 | Amandine    | Thoyer   | f    | communication | 2014-01-23    |    2100 | -- Encore ici

|         509 | Fabrice     | Grand    | m    | comptabilite  | 2011-12-30    |    2900 | -- Ici aussi

|         350 | Jean-pierre | Laborde  | m    | direction     | 2010-12-09    |    5000 | -- etc, sur chaque bloc
|         592 | Laura       | Blanchet | f    | direction     | 2012-05-09    |    4500 |

|         701 | Mathieu     | Vignal   | m    | informatique  | 2013-04-03    |    2500 |
|         802 | Damien      | Durand   | m    | informatique  | 2014-07-05    |    2250 |
|         854 | Daniel      | Chevel   | m    | informatique  | 2015-09-28    |    3100 |

|         876 | Nathalie    | Martin   | f    | juridique     | 2016-01-12    |    3550 |

|         417 | Chloe       | Dubar    | f    | production    | 2011-09-05    |    1900 |
|         900 | Benoit      | Lagarde  | m    | production    | 2016-06-03    |    2550 |

|         491 | Elodie      | Fellier  | f    | secretariat   | 2011-11-22    |    1600 |
|         699 | Julien      | Cottet   | m    | secretariat   | 2013-01-05    |    1390 |
|         739 | Thierry     | Desprez  | m    | secretariat   | 2013-07-17    |    1500 |
+-------------+-------------+----------+------+---------------+---------------+---------+



-- Il est possible de mettre une condition au travers d'une agrégation gérée avec un GROUP BY, grâce à "HAVING" (ayant)
-- Nombre d'employés par service, pour les services ayant plus de 2 employés 
SELECT service, COUNT(*) AS nbr_employes FROM employes GROUP BY service HAVING COUNT(*) > 2;
+--------------+--------------+
| service      | nbr_employes |
+--------------+--------------+
| commercial   |            6 |
| secretariat  |            3 |
| informatique |            3 |
+--------------+--------------+

Table : employes 
| id_employes | prenom      | nom      | sexe | service       | date_embauche | salaire |


-- 4 -- Afficher le nombre de personne ayant un n° id_employes commençant par le chiffre 5.	
SELECT COUNT(*) AS nbr_id_5 FROM employes WHERE id_employes LIKE "5%";
+----------+
| nbr_id_5 |
+----------+
|        3 |
+----------+
-- SELECT prenom FROM employes WHERE prenom LIKE "%ie";

-- 5 -- Afficher le nombre de commerciaux.
SELECT COUNT(*) AS nbr_commerciaux FROM employes WHERE service = "commercial";
+-----------------+
| nbr_commerciaux |
+-----------------+
|               6 |
+-----------------+
-- 6 -- Afficher le salaire moyen des informaticiens 
SELECT ROUND(AVG(salaire)) AS salaire_moyen_info FROM employes WHERE service = "informatique";
+--------------------+
| salaire_moyen_info |
+--------------------+
|               2617 |
+--------------------+
-- 8 -- Afficher le coût des commerciaux sur 1 année.	
SELECT SUM(salaire * 12) AS cout_commerciaux_annuel FROM employes WHERE service = "commercial"; 	
+-------------------------+
| cout_commerciaux_annuel |
+-------------------------+
|                  184200 |
+-------------------------+
-- 9 -- Afficher le salaire moyen par service.
SELECT service, ROUND(AVG(salaire)) AS salaire_moyen FROM employes GROUP BY service;
+---------------+---------------+
| service       | salaire_moyen |
+---------------+---------------+
| direction     |          4750 |
| commercial    |          2558 |
| production    |          2225 |
| secretariat   |          1497 |
| comptabilite  |          2900 |
| informatique  |          2617 |
| communication |          2100 |
| juridique     |          3550 |
| assistant     |          1775 |
+---------------+---------------+
-- 10 -- Afficher le nombre de recrutement sur l'année 2010 
SELECT COUNT(*) AS nbr_recrutement FROM employes WHERE YEAR(date_embauche) = 2010;
SELECT COUNT(*) AS nbr_recrutement FROM employes WHERE date_embauche BETWEEN "2010-01-01" AND "2010-12-31";
SELECT COUNT(*) AS nbr_recrutement FROM employes WHERE date_embauche LIKE "2010%";
+-----------------+
| nbr_recrutement |
+-----------------+
|               2 |
+-----------------+
-- SELECT YEAR(date_embauche) FROM employes;
-- 11 -- Afficher le salaire moyen appliqué lors des recrutements sur la période allant de 2015 a 2017
SELECT AVG(salaire) AS salaire_moyen FROM employes WHERE YEAR(date_embauche) BETWEEN 2015 AND 2017;
+---------------+
| salaire_moyen |
+---------------+
|          2555 |
+---------------+
-- 12 -- Afficher le nombre de service différent 
SELECT COUNT(DISTINCT service) AS nbr_service FROM employes;
-- DISTINCT nous permet d'éliminer les doublons, on récupère donc chaque service distinct
+-------------+
| nbr_service |
+-------------+
|           9 |
+-------------+
-- SELECT DISTINCT service FROM employes;
-- 14 -- Afficher conjointement le nombre d'homme et de femme dans l'entreprise
SELECT sexe, COUNT(*) AS nbr_h_f FROM employes GROUP BY sexe;
+------+---------+
| sexe | nbr_h_f |
+------+---------+
| m    |      11 |
| f    |       9 |
+------+---------+
-- SELECT prenom, sexe FROM employes ORDER BY sexe;
+-------------+------+
| prenom      | sexe |
+-------------+------+
| Jean-pierre | m    |
| Clement     | m    |
| Thomas      | m    |
| Fabrice     | m    |
| Guillaume   | m    |
| Julien      | m    |
| Mathieu     | m    |
| Thierry     | m    |
| Damien      | m    |
| Daniel      | m    |
| Benoit      | m    |

| Chloe       | f    |
| Elodie      | f    |
| Melanie     | f    |
| Laura       | f    |
| Celine      | f    |
| Amandine    | f    |
| Nathalie    | f    |
| Emilie      | f    |
| Stephanie   | f    |
+-------------+------+


Table : employes 
| id_employes | prenom      | nom      | sexe | service       | date_embauche | salaire |