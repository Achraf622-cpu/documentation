# 📚 Projet Librairie

Ce projet est une application de gestion de librairie permettant d'ajouter, d'afficher, de mettre à jour, de supprimer des livres et d'effectuer d'autres opérations sur un stock de livres. Il utilise **PHP** pour la gestion côté serveur, **MySQL** pour la base de données et un peu de **CSS** pour le design.

## 🔌 Connexion à la base de données

### 🛠 Méthodes de connexion (OOP et procédural)

Dans le fichier `db.php`, j'ai utilisé les deux méthodes de connexion (OOP et procédural) afin de les tester, mais je vais finalement utiliser la méthode **OOP (Orientée Objet)** car elle est plus organisée et claire. Cette méthode permet de définir des classes et des méthodes, offrant plus de flexibilité.

- **OOP (Orienté Objet)** : Permet de structurer le code en utilisant des classes et des objets, ce qui améliore l'organisation et la réutilisation du code.
- **Procédural** : Fonctionne à base de fonctions et de structures de contrôle simples. Bien que cela fonctionne, c'est moins flexible et plus difficile à maintenir dans un projet complexe.

### 🔗 Connexion avec `require_once`

Pour connecter la base de données à d'autres pages, j'ai utilisé **`require_once`**. Cette méthode inclut le fichier de connexion une seule fois, ce qui évite des problèmes de redondance. Si un problème survient (par exemple, si le fichier n'est pas trouvé), une **erreur fatale** est affichée, empêchant la page de se charger.

Il existe également d'autres méthodes comme **`require`**, **`include`** et **`include_once`** :
- **`require`** : Inclut le fichier, mais sans s'assurer qu'il n'est inclus qu'une seule fois.
- **`include`** : Inclut le fichier, mais en cas d'erreur, un avertissement est affiché et la page continue de se charger.
- **`include_once`** : Comme `include`, mais s'assure que le fichier est inclus une seule fois.

## 📖 Affichage des livres

### 🔍 Utilisation de `fetch_assoc()` et `fetch_row()`

Pour afficher les livres de la base de données, j'ai utilisé **`fetch_assoc()`** et **`fetch_row()`** pour récupérer les données.

- **`fetch_assoc()`** : Cette méthode retourne les données sous forme de tableau associatif, où chaque élément est associé à une clé (par exemple `id`, `titre`, `auteur`, `category`).
    Exemple :
    ```php
    ['id' => 1, 'titre' => 'titre', 'auteur' => 'auteur', 'category' => 'category']
    ```
  Cela permet d'accéder facilement aux données via des noms de colonnes.

- **`fetch_row()`** : Cette méthode retourne les données sous forme de tableau indexé, où les colonnes sont accessibles via des indices numériques.
    Exemple :
    ```php
    [0 => 1, 1 => 'titre', 2 => 'auteur', 3 => 'category']
    ```

### 🔄 Utilisation de `fetch_array()`

J'ai également essayé d'utiliser **`fetch_array()`**, qui combine les fonctionnalités de **`fetch_assoc()`** et **`fetch_row()`**. Ce mode permet de choisir entre plusieurs options :
- **`MYSQL_ASSOC`** : Retourne un tableau associatif (comme `fetch_assoc()`).
- **`MYSQL_NUM`** : Retourne un tableau indexé (comme `fetch_row()`).
- **`MYSQL_BOTH`** : Retourne les deux formats (associatif et indexé), ce qui permet une plus grande flexibilité.

Cependant, j'ai lu que **`fetch_array()`** n'est plus recommandé dans les dernières mises à jour, donc j'ai décidé d'éviter cette méthode au profit des méthodes plus spécifiques.

### 🔄 Réinitialisation du pointeur avec `data_seek()`

Pour illustrer comment les deux méthodes de récupération des données fonctionnent, j'ai utilisé **`data_seek()`**. Cette méthode permet de réinitialiser le pointeur interne de l'ensemble de résultats. En réinitialisant le pointeur à `0`, je peux afficher les données selon les deux méthodes et montrer comment le pointeur se déplace.

## 🔑 Tableaux Associatifs vs Tableaux Indexés

- **Tableau Associatif** : Dans un tableau associatif, chaque élément est associé à une clé, ce qui rend l'accès aux données plus lisible. Par exemple :
    ```php
    ['id' => 1, 'titre' => 'titre', 'auteur' => 'auteur', 'category' => 'category']
    ```
  Cela permet de référencer les données de manière significative, ce qui est plus facile à comprendre.

- **Tableau Indexé** : Un tableau indexé utilise des indices numériques pour accéder aux éléments. Par exemple :
    ```php
    [0 => 1, 1 => 'titre', 2 => 'auteur', 3 => 'category']
    ```
  Bien que cette méthode soit simple, elle peut être moins lisible, surtout avec un grand nombre de colonnes. Il peut être difficile de se rappeler ce que chaque indice représente.

En général, **les tableaux associatifs** sont préférés pour leur lisibilité et leur clarté, car chaque élément est lié à un nom au lieu d'un indice numérique.

## 🛡 Envoi de données avec POST vs GET

J'ai utilisé la méthode **POST** pour récupérer les données du formulaire, car elle est plus sécurisée que la méthode **GET**. La méthode **GET** envoie les données dans l'URL, ce qui peut exposer des informations sensibles à l'utilisateur ou à d'autres personnes, et est principalement utilisée pour des recherches ou des informations publiques.

La méthode **POST**, en revanche, envoie les données dans le corps de la requête HTTP, ce qui les cache de l'URL et les rend plus sécurisées. Elle est donc plus appropriée pour envoyer des informations sensibles, comme des mots de passe ou des informations personnelles.

## 🔐 Préparation des Requêtes : Sécurité des Requêtes SQL

Avant, je ne savais pas exactement ce que faisait **`prepare()`**, mais maintenant je comprends que cette méthode est cruciale pour la sécurité de l'application. Les **requêtes préparées** aident à prévenir les attaques par **injection SQL** en préparant d'abord la structure de la requête avant d'ajouter les données utilisateurs. Cela permet au serveur de savoir à l'avance à quoi ressemble la structure de la requête, évitant ainsi l'exécution de code malveillant.

- **`prepare()`** : Cette méthode prépare la structure de la requête, en définissant à l'avance les paramètres de la requête sans y inclure encore les données utilisateur. Cela protège la requête contre les injections SQL.

## 🎯 Conclusion

Ce projet de gestion de librairie a été conçu avec un souci de sécurité et de lisibilité. L'utilisation de la méthode **OOP** pour la connexion à la base de données permet une meilleure organisation du code, et l'utilisation de méthodes de récupération des données comme **`fetch_assoc()`** et **`fetch_row()`** améliore la clarté et la flexibilité.

L'utilisation des **requêtes préparées** et de la méthode **POST** pour envoyer les données garantit une sécurité accrue pour les utilisateurs et leurs données.

## ⚙️ Technologies utilisées

- **PHP** : Langage de programmation utilisé pour gérer le côté serveur.
- **MySQL** : Base de données pour stocker les informations sur les livres.
- **HTML/CSS** : Utilisé pour structurer et styliser la page web.

## ✍️ Auteurs

- **[Votre Nom]** : Développeur principal
