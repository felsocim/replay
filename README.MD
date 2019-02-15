# replay

Site de replay vidéo d'une chaîne de télévision.

## À propos

Dans le cadre d'un projet universitaire en cours de Bases de données et programmation Web, nous avons réalisé un site de replay de vidéos d'une chaîne de télévision. S'appuyant sur une base de données Oracle, le site permet aux utilisateurs de s'y inscrire puis naviguer parmi les vidéos disponibles, les lire, les ajouter aux favoris, etc. De plus, sur la base des préférences des utilisateurs, le site pourra leur proposer des suggestions de vidés à regarder directement sur le site ou via la newsletter.

[Le sujet du projet](doc/Sujet.pdf) contient le descriptif complet des fonctionnalités du site. Par ailleurs, dans le fichier [BDD.md](doc/BDD.md) se trouvent les détails du modèle de la base de données utilisée.

## Instructions générales de mise en place

Pour faire fonctionner le site, votre ordinateur doit disposer de :

- serveur de bases de données **Oracle**
- serveur Web **Apache** *version >2*
- **PHP** *version >5*

Après l'installation et la configuration de ces logiciels, il est nécessaire de créer la base de données du site en suivant les instructions au début du fichier [BDD.md](doc/BDD.md).

Puis, copier l'intégralité de l'arborescence avec tous les fichiers du projet dans un dossier sur votre serveur Web et y configurer un site (voir les instructions disponibles sur Internet).

Enfin, dans le fichier [config.php](shared/config.php) se trouvant dans le répertoire *config* du projet, les paramètres de vos serveurs Oracle et Apache (les adresses, le port, le nom de l'utilisateur de bases de données, etc.) sont à renseigner.

## Auteurs

[Marek Felsoci](mailto:marek.felsoci@etu.unistra.fr), étudiant à l'[Université de Strasbourg](http://www.unistra.fr).

## Licence

Ce projet est mis à disposition dans le domaine publique.
