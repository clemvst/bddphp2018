# bddphp2018
Project of a dynamic website in PHP/HTML


Authors : Iris Dumeur et Clémence Vast
DEPOT GIT DISPONIBLE : github/clemvst/bddphp2018

## Index.php
Contient le menu principal avec un formulaire. On choisit la BDD à importer parmi Clients, Eleves, Livres.
Donne également la possibilité d'effacer une base de données existante.
Lors de la soumission du formulaire, renvoie vers ajout_table.php 

## Ajout_table.php
Permet la création de la BDD. On peut ajouter les différentes tables en sélectionnant les fichiers CSV correspondants.
Connection à MYSQL (compatible sur linux et mac) pour la création et la modification de la base.
Boutons de retour disponibles.
Renvoie aux fichiers : 
saisi_main.php
requetes_sql.php
ajout_ligne.php
index.php

## Saisi_main.php
Permet de saisir de nouvelles données à la main. ou de les modifier.
Boutons de retour disponibles.

## Ajout_ligne.php
Permet d'ajouter de nouvelles données et d'update la table.
Boutons de retour disponibles.

## Requetes_sql.php
Est constitué des différentes requetes SQL imposées par le sujet du Projet. Les requetes et leurs resultats bruts sont affichés.
Boutons de retour disponibles.


