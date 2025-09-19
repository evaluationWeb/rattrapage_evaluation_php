# evaluation_php_correction

### Correction de l'évaluation PHP** 

**Pour la récupérer et la tester sur votre machine** :

- **1 Cloner le repository à la racine du serveur apache**
```sh
git clone https://github.com/evaluationWeb/rattrapage_evaluation_php.git
```

- **2 Création de la BDD** :
Utiliser le script SQL bdd.sql pour créer la base de données.

*Ce script va créer la base et ajouter des categories*.

- **3 Configurer le fichier env.php** :

Remplacer les valeurs avec vos paramètres de BDD.

- **4 Démarrer le projet** :
```sh
# Se déplacer dans le dossier 
cd rattrapage_evaluation_php

# démarrer le serveur PHP
php -S 127.0.0.1:8000

# dans le navigateur internet saisir l'url suivante 
http://127.0.0.1:8000
NB : Attention de bien être à la racine du dossier pour démarrer le serveur PHP
Et que la BDD soit créée et démarrée
```
