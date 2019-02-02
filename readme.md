# EDT


## [IUT Paris Descartes](http://www.iut.parisdescartes.fr/)


## Présentation

Dans le cadre du module M5 nous avons dû concevoir le bureau virtuel d'un responsable d’Emploi Du Temps (EDT).
Pour réaliser ses emplois du temps, un responsable d'EDT obtient des informations de l'établissement sous forme de listes et
est en relation avec des responsables des matières.


### Ce qui est fourni :

- Une base de données de l’application, avec de premières données enregistrées dans les tables.


### Technologies utilisées :

- HTML 5
- JavaScript : ECMAScript 2018
- Jquery v3.3.1
- PHP v7.2
- Bootstrap v4.2.1 (.js + .css)

### Features:

- Affichage dynamique des modules, matières et périodes
- Interface utilisateur colorée permettant de différencier facilement les éléments du tableau
- Uniquement des appels AJAX
- Saisie des heures sur les matières
- Calcul des totaux à chaque changement d'heures sur l'emploi du temps
- Fonctionnalité "Glisser-Déposer" sur les heures
- Suppression des heures saisies
- Accès à l'application par le biai d'une connexion avec identifiant et mot de passe
- Déconnexion de l'utilisateur

### Installation 

1) Télécharger le repo au format .zip.

2) Extraire le projet dans le dossier dans votre serveur web. 


##### Ou alors :

- Pour cette étape veuillez vérifier si vous possédez [Git](https://git-scm.com/)


1) Copier le [lien](https://github.com/LPIOT-IUT-PARIS-DESCARTES/EDT) git du projet.

2) Placez vous dans le dossier de votre serveur web.

2 bis) Lancer une invite de commandes et exécuter la commande suivante :
```
git clone https://github.com/LPIOT-IUT-PARIS-DESCARTES/EDT.git
```
3) Lancer votre serveur web.

4) Dans votre gestionnaire de base de données :
- Créer une nouvelle base de données "proj".
- Importer le fichier proj.sql qui se trouve dans le dossier "resources", dans cette table.

5) Modifier le fichier \EDT\service\connectDB avec le login et le mot de passe de votre SGBD.

6) C'est terminé ! Le projet EDT est disponible sur votre serveur local et, est accessible par "/EDT".


## Versioning

Nous avons utilisés Git pour le versionning du projet.

## Authors

* [Ayaz ABDUL CADER](https://github.com/AyazBulls)
* [Nicolas GARNIER](https://github.com/mvestrotech)
* [Vincent Gusmini](https://github.com/VinceGusmini)
