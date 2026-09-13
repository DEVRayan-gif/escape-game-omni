# OMNI – Protocole Zéro

Ce projet est un site web sur le thème d'un **escape game nocturne immersif**.
Il permet de découvrir le concept du jeu, consulter les infos pratiques, réserver une session et, côté administration, de gérer les inscriptions, les commentaires et les scores des équipes.

Le projet a été réalisé avec **HTML, CSS, JavaScript, PHP et MySQL** en utilisant une architecture structurée (MVC + MLD).

> Projet réalisé dans le cadre d'une SAE, **en groupe de 4 personnes**, en première année.

## Fonctionnalités du site

Le site contient plusieurs pages principales, accessibles publiquement, ainsi qu'un espace d'administration sécurisé.

### Page d'accueil

* Présentation du concept de l'escape game
* Compte à rebours immersif ("system shutdown")
* Décors et visuels du complexe (photos, pictogrammes)
* Interface visuelle et immersive, cohérente avec l'univers du jeu

### Page concept

* Présentation détaillée du scénario et de l'univers OMNI
* Mise en contexte du jeu (Tech'In Co, IA, protocole zéro)

### Page infos pratiques

* Règles du jeu (téléphone interdit, indices, travail d'équipe...)
* Durée, difficulté, nombre de joueurs maximum

### Page réservation / connexion

* Réservation d'une session de jeu
* Création de compte et connexion utilisateur

### Page admin *(accès restreint)*

* Interface d'administration sécurisée (connexion protégée via **.htaccess**)
* **Gestion des inscrits** : liste des participants, équipes, créneaux, ajout/modification/suppression
* **Gestion des commentaires** : modération des avis laissés par les joueurs (acceptation/refus)
* **Saisie des scores** : classement live des équipes selon leur temps réalisé
* C'est également ici que sont gérées les réservations des joueurs

## Technologies utilisées

* HTML5
* CSS3
* JavaScript
* PHP
* MySQL
* PHPMyAdmin
* Figma (maquettes et design du site)
* Architecture MVC
* Sécurisation de l'accès admin via .htaccess

## Architecture du projet

### MVC (Model – View – Controller)

Le projet suit l'architecture MVC :

* **Model** → gestion des données (base de données MySQL)
* **View** → interface utilisateur (HTML/CSS)
* **Controller** → logique du site (PHP, traitement des requêtes)

### MLD (Modèle Logique de Données)

La base de données a été conçue avec un MLD structuré, composé de **5 tables**, incluant notamment :

* Gestion des inscriptions et connexions
* Gestion des participants et équipes
* Gestion des commentaires
* Gestion des scores/résultats

## Objectif du projet

Ce projet a pour but de :

* améliorer mes compétences en développement web full-stack
* apprendre à manipuler une base de données MySQL
* structurer un projet avec une architecture MVC
* concevoir une base de données avec un MLD
* travailler en équipe sur un projet complet, de la conception à la réalisation
* organiser un projet propre et professionnel

## L'agence

En parallèle du site OMNI, un site **WordPress** a été réalisé pour présenter notre agence et son équipe.

Nous étions **4 membres** dans l'équipe, chacun avec un rôle spécifique :

* **2 développeurs front-end / back-end** (dont moi-même, développeur principal ayant géré la majeure partie du site, accompagné d'un collègue développeur qui m'a aidé sur certaines fonctionnalités)
* **1 maquettiste**, en charge de la conception des maquettes sur Figma
* **1 responsable communication**, en charge de la communication autour du projet

## Auteur

Projet réalisé par : Rayan Chraibi — développeur principal du site OMNI – Protocole Zéro

## Remarque

Ce projet est un **projet de groupe**, réalisé dans un cadre éducatif (SAE) d'apprentissage du développement web full-stack et de la gestion de bases de données.
