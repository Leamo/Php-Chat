# Chat en PHP MVC Orienté Objet

## Caractéristiques :

L'application a été développée sur un serveur apache. 
Pour des questions de sécurité il est recommandé de faire pointer le vhost directement sur le dossier `public` de l'application.


Le dossier `Core` contient les classes réutilisables de l'application.

Le dossier `App` contient le code propre à l'application.

## Configuration : 

Après avoir importé la structure de la base de données située dans le fichier SQL à la racine du projet, veuillez créer le fichier `config/config.php` avec les informations de connection à la base de données en vous basant sur le fichier `config/config.php.example`