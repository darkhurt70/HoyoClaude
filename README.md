# Mihoyo Collection - Projet TP Base de données

Application web PHP pour gérer une collection de personnages de jeux Mihoyo (Genshin Impact, Honkai Star Rail, Zenless Zone Zero).

## Fonctionnalités

- ✅ Afficher la liste des personnages
- ✅ Ajouter des personnages à la base de données
- ✅ Éditer un personnage
- ✅ Supprimer un personnage
- ✅ Gérer une authentification
- ✅ Gérer un journal de logs
- ✅ Gérer les données liées à un personnage (Element, Origin, UnitClass)
- ✅ Design simple et fonctionnel avec Materialize CSS

## Technologies utilisées

- PHP 8.0+
- MySQL/MariaDB
- Plates (moteur de templates)
- Materialize CSS
- Architecture MVC
- Pattern Repository (DAO)
- Services Layer

## Installation

### Prérequis

- PHP 8.0 ou supérieur
- MySQL 5.7+ ou MariaDB 10.3+
- Un serveur web (Apache, Nginx) ou XAMPP/WAMP
- Git (optionnel)

### Étapes d'installation

1. **Télécharger le projet**
   ```bash
   cd C:\xampp\htdocs\  # Ou votre dossier web
   ```
   Copiez le dossier du projet dans votre répertoire web

2. **Installer Plates (moteur de templates)**

   Téléchargez Plates v3.5 depuis : https://github.com/thephpleague/plates/archive/refs/tags/v3.5.0.zip

   Extrayez le contenu et placez le dossier `src` dans `Vendor/Plates/`

3. **Configurer la base de données**

   a. Créez la base de données MySQL :
   ```bash
   mysql -u root -p < database.sql
   ```

   Ou importez le fichier `database.sql` via phpMyAdmin

   b. Configurez vos identifiants de connexion :
   ```bash
   cp Config/dev_sample.ini Config/dev.ini
   ```

   Puis éditez `Config/dev.ini` avec vos paramètres :
   ```ini
   [DB]
   dsn = 'mysql:host=localhost;dbname=mihoyo_collection;charset=utf8'
   user = 'root'
   pass = 'votre_mot_de_passe'
   ```

4. **Accéder à l'application**

   Ouvrez votre navigateur et allez sur :
   ```
   http://localhost/Claude/
   ```

   (Remplacez "Claude" par le nom de votre dossier)

## Utilisation

### Connexion

Utilisateurs de test disponibles :

- **Username:** admin / **Password:** admin
- **Username:** test / **Password:** test

### Navigation

- **Accueil** : Liste de tous les personnages
- **Ajouter Personnage** : Formulaire pour créer un nouveau personnage
- **Ajouter Élément** : Ajouter un élément, origine ou classe
- **Logs** : Consulter l'historique des actions
- **Zone Protégée** : Page accessible uniquement si connecté

### Gestion des personnages

1. **Créer** : Cliquez sur "Ajouter Personnage", remplissez le formulaire
2. **Modifier** : Cliquez sur l'icône "edit" sur une carte de personnage
3. **Supprimer** : Cliquez sur l'icône "delete" (avec confirmation)

## Structure du projet

```
Claude/
├── Config/              # Configuration de l'application
├── Controllers/         # Contrôleurs MVC
│   └── Router/         # Système de routage
│       └── Route/      # Routes individuelles
├── Exceptions/         # Exceptions personnalisées
├── Helpers/            # Classes utilitaires
├── Models/             # Modèles et DAO
├── public/             # Ressources publiques
│   ├── css/           # Feuilles de style
│   └── img/           # Images
├── Services/           # Couche de services
├── Vendor/             # Dépendances externes (Plates)
├── Views/              # Templates de vues
├── logs/               # Fichiers de logs
├── index.php           # Point d'entrée
├── database.sql        # Script de création de la BDD
└── README.md           # Ce fichier
```

## Architecture

Le projet suit l'architecture **MVC** (Model-View-Controller) avec les ajouts suivants :

- **Services** : Logique métier et coordination des DAO
- **DAO (Data Access Object)** : Accès aux données
- **Router** : Gestion des routes et de la navigation
- **Routes protégées** : Authentification via sessions

### Flux de requête

```
index.php → Router → Route → Controller → Service → DAO → Database
                                    ↓
                                  View
```

## Sécurité

- Mots de passe hashés avec `password_hash()` (bcrypt)
- Requêtes préparées PDO (protection contre SQL injection)
- Échappement des données dans les vues
- Sessions avec timeout
- Routes protégées par authentification

## Logs

Les logs sont enregistrés automatiquement dans `logs/MIHOYO_MM_YYYY.log`

Ils capturent :
- Création, modification, suppression de personnages
- Connexions/déconnexions
- Erreurs

## Personnalisation

### Changer le jeu (Genshin → HSR → ZZZ)

Modifiez les données dans `database.sql` pour correspondre aux éléments du jeu choisi :
- Genshin Impact : Element, Weapon, Region
- Honkai Star Rail : CombatType, Path, N/A
- Zenless Zone Zero : Attribute, Speciality, Faction

## Troubleshooting

### Erreur "Aucun fichier de configuration trouvé"
→ Vérifiez que `Config/dev.ini` existe et contient les bonnes informations

### Erreur de connexion à la base de données
→ Vérifiez vos identifiants dans `Config/dev.ini`
→ Assurez-vous que MySQL est démarré

### Page blanche
→ Activez l'affichage des erreurs PHP :
```php
ini_set('display_errors', 1);
error_reporting(E_ALL);
```

### Plates non trouvé
→ Vérifiez que le dossier `Vendor/Plates/src` existe et contient les fichiers de Plates

## Auteur

Projet TP - Base de données & Application Web
Nicolas 'Lomens' Resin

## Licence

Projet éducatif - Libre d'utilisation pour l'apprentissage
